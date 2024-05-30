<?php
include_once('config/config.php');

$results_per_page = 6; // Number of records per page

// Get the current page number
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Get the search query
$searchQuery = isset($_GET['q']) ? $_GET['q'] : '';

// Modify the SQL query to include search condition
$get_all_users = "SELECT * FROM user WHERE is_deleted = 0 ";
if (!empty($searchQuery)) {
  $get_all_users .= "AND (first_name LIKE '%$searchQuery%' OR last_name LIKE '%$searchQuery%' OR email LIKE '%$searchQuery%') ";
}

// Count total number of records
$count_query = "SELECT COUNT(*) AS total FROM user WHERE is_deleted = 0";
if (!empty($searchQuery)) {
  $count_query .= " AND (first_name LIKE '%$searchQuery%' OR last_name LIKE '%$searchQuery%' OR email LIKE '%$searchQuery%') ";
}
$count_result = mysqli_query($conn, $count_query);
$count_row = mysqli_fetch_assoc($count_result);
$total_records = $count_row['total'];

// Calculate total number of pages
$total_pages = ceil($total_records / $results_per_page);

// Calculate offset for pagination
$offset = ($current_page - 1) * $results_per_page;

// Modify the SQL query to include LIMIT for pagination
$get_all_users .= "LIMIT $offset, $results_per_page";

$res = mysqli_query($conn, $get_all_users);
?>

<div class="container-fluid">
  <div class="container">
    <h3 class="text-center text-dark">All Users</h3>
    <div class="d-flex justify-content-between">
      <div>
        <a href="index.php" class="btn btn-info mb-2 pull-right">Home</a>
        <a href="pages/add_new_user.php" class="btn btn-info mb-2 pull-right">Add New</a>
        <a href="all_delect_user.php" class="btn btn-info mb-2 pull-right">Deleted User</a>
      </div>
      <div class="search-box d-flex">
        <input type="search" class="form-control" placeholder="By Name and Email.." id="searchInput">
        <button id="searchBtn" class="btn btn-info mb-2 pull-right ml-2"><i class="fa-solid fa-magnifying-glass"></i></button>
      </div>
    </div>

    <div class="row">
      <?php
      if (mysqli_num_rows($res) > 0) {
        while ($rs = mysqli_fetch_assoc($res)) {
      ?>

          <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card-container">
              <div class="card">
                <!-- Add unique ID for each card -->
                <div class="card-front">
                  <!-- Front card content -->

                  <div class="profile-card js-profile-card">
                    <div class="profile-card__img">
                      <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/CRUD/img/<?php echo $rs['profile_picture']; ?>" alt="profile card">
                    </div>

                    <div class="profile-card-social">

                      <?php if (!empty($rs['facebook'])) : ?>
                        <a href="<?php echo $rs['facebook']; ?>" target="_blank" class="profile-card-social__item facebook">
                          <span class="icon-font">
                            <i class="fa-brands fa-facebook"></i>
                          </span>
                        </a>
                      <?php endif; ?>

                      <?php if (!empty($rs['twitter'])) : ?>
                        <a href="<?php echo $rs['twitter']; ?>" class="profile-card-social__item twitter" target="_blank">
                          <span class="icon-font">
                            <i class="fa-brands fa-square-x-twitter"></i>
                          </span>
                        </a>
                      <?php endif; ?>

                      <?php if (!empty($rs['instagram'])) : ?>
                        <a href="<?php echo $rs['instagram']; ?>" class="profile-card-social__item instagram" target="_blank">
                          <span class="icon-font">
                            <i class="fa-brands fa-instagram"></i>
                          </span>
                        </a>
                      <?php endif; ?>

                      <?php if (!empty($rs['twitter'])) : ?>
                        <a href="<?php echo $rs['twitter']; ?>" class="profile-card-social__item github" target="_blank">
                          <span class="icon-font">
                            <i class="fa-brands fa-square-x-twitter"></i>
                          </span>
                        </a>
                      <?php endif; ?>

                      <?php if (!empty($rs['whatsapp'])) : ?>
                        <a href="<?php echo $rs['whatsapp']; ?>" class="profile-card-social__item link" target="_blank">
                          <span class="icon-font">
                            <i class="fa-brands fa-whatsapp"></i>
                          </span>
                        </a>
                      <?php endif; ?>
                    </div>

                    <div class="profile-card__cnt js-profile-cnt">
                      <div class="profile-card__name"><?php echo $rs['first_name']; ?> <?php echo $rs['last_name']; ?></div>
                      <div class="profile-card-loc">
                        <span class="profile-card-loc__icon">
                          <i class="fa-solid fa-envelope"></i>
                        </span>

                        <span>
                          <a class="profile-card__txt" href="mailto:<?php echo $rs['email']; ?>"><?php echo $rs['email']; ?></a>
                        </span>
                      </div>
                      <div class="profile-card-loc">
                        <span class="profile-card-loc__icon">
                          <i class="fa-solid fa-phone"></i>
                        </span>

                        <span>
                          <a class="profile-card__txt" href="tel:+91 <?php echo $rs['number']; ?>">+91 <?php echo $rs['number']; ?></a>
                        </span>
                      </div>
                      <div class="messgae_box">
                        <?php echo $rs['message']; ?>
                      </div>


                      <div class="profile-card-ctr">
                        <button class="profile-card__button button--blue message" onclick="openPopup('<?php echo $rs['first_name']; ?>', '<?php echo $rs['last_name']; ?>', '<?php echo $rs['email']; ?>','<?php echo $rs['number']; ?>','<?php echo $rs['message']; ?>', '<?php echo $rs['profile_picture']; ?>','<?php echo $rs['facebook']; ?>','<?php echo $rs['instagram']; ?>','<?php echo $rs['twitter']; ?>','<?php echo $rs['linkedin']; ?>','<?php echo $rs['whatsapp']; ?>','<?php echo $rs['id']; ?>');"> <i class="fa-solid fa-eye"></i></button>
                        <button class="profile-card__button button--orange connect" onclick="deleteUser(<?php echo $rs['id']; ?>)"><i class="fa-solid fa-trash"></i></button>


                        <button class="profile-card__button button--blue flip-btn" onclick="generateQr(event, '<?php echo $rs['first_name']; ?>', '<?php echo $rs['last_name']; ?>', '<?php echo $rs['email']; ?>', '<?php echo $rs['number']; ?>', '<?php echo $rs['message']; ?>')">
                          <i class="fa-solid fa-qrcode"></i>
                        </button>

                      </div>
                    </div>
                  </div>


                  <!-- Profile card content here -->
                </div>
                <div class="card-back">
                  <!-- Back card content -->
                  <div class="wrapper text-center">
                    <div class="profile-card js-profile-card">
                      <div class="profile-card__img">
                        <!-- Profile card image -->
                        <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/CRUD/img/<?php echo $rs['profile_picture']; ?>" alt="profile card">
                      </div>
                      <div id="qrCode" class="d-flex justify-content-center"></div>
                      <button class="profile-card__button button--blue flip-back-btn mb-4"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        <?php
        }
      } else {
        ?>
        <div class="col-lg-12">
          <div class="text-danger h4 text-center ">No data found</div>
        </div>
      <?php
      }
      ?>
    </div>
    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3">
      <ul class="pagination">
        <li class="page-item <?php echo ($current_page == 1) ? 'disabled' : ''; ?>">
          <a class="page-link" href="?page=<?php echo ($current_page - 1) . (!empty($searchQuery) ? '&q=' . urlencode($searchQuery) : ''); ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
          <li class="page-item <?php echo ($i == $current_page) ? 'active' : ''; ?>">
            <a class="page-link" href="?page=<?php echo $i . (!empty($searchQuery) ? '&q=' . urlencode($searchQuery) : ''); ?>"><?php echo $i; ?></a>
          </li>
        <?php endfor; ?>
        <li class="page-item <?php echo ($current_page == $total_pages) ? 'disabled' : ''; ?>">
          <a class="page-link" href="?page=<?php echo ($current_page + 1) . (!empty($searchQuery) ? '&q=' . urlencode($searchQuery) : ''); ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </div>
    <!-- End Pagination -->
    <!-- Pagination -->

    <!-- End Pagination -->
  </div>
</div>





<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <form id="popupContent" method="post" enctype="multipart/form-data">
      <!-- Form content goes here -->
    </form>
  </div>
</div>

<script>
  // Define the generateQr function
  function generateQr(event, firstName, lastName, email, number, message) {
    var data = `Name: ${firstName} ${lastName}.\nEmail: ${email}.\nNumber: ${number}.\nAbout Us: ${message}.`;
    var encodedData = encodeURIComponent(data);
    var url = `https://quickchart.io/qr?text=${encodedData}&size=200`;
    var ifr = `<iframe src="${url}" height="200" width="200"></iframe>`;
    var cardContainer = event.target.closest('.card-container');
    var qrDiv = cardContainer.querySelector('.card-back #qrCode');

    qrDiv.innerHTML = ifr;
  }

  // Function to toggle flip class
  function toggleFlip(event) {
    var cardContainer = event.target.closest('.card-container');
    if (cardContainer) {
      cardContainer.classList.toggle('flipped');
    }
  }

  // Function to remove flip class
  function removeFlip(event) {
    var cardContainer = event.target.closest('.card-container');
    if (cardContainer) {
      cardContainer.classList.remove('flipped');
    }
  }

  // Attach event listeners
  document.querySelectorAll('.card-container').forEach(cardContainer => {
    const flipBtn = cardContainer.querySelector('.flip-btn');
    const flipBackBtn = cardContainer.querySelector('.flip-back-btn');

    if (flipBtn && flipBackBtn) {
      flipBtn.addEventListener('click', toggleFlip);
      flipBackBtn.addEventListener('click', removeFlip);
    } else {
      console.error('Error: One of the elements (flipBtn or flipBackBtn) was not found in', cardContainer);
    }
  });
</script>
