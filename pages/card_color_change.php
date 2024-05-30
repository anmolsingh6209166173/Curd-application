<?php
include_once('inc/header.php');
include_once('config/config.php');

$results_per_page = 3; // Number of records per page

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
$counter = 0; // Initialize a counter variable

if (mysqli_num_rows($res) > 0) {
    while ($rs = mysqli_fetch_assoc($res)) {
        $counter++; // Increment the counter for each card
        
        // Generate a unique ID for each card
        $card_id = "card_" . $counter;

        // Define an array of background colors
        $background_colors = array("lightyellow","lightblue", "lightgreen", "lightpink",);

        // Calculate the index of the background color based on the counter
        $color_index = ($counter - 1) % count($background_colors);

        // Get the background color for the current card
        $background_color = $background_colors[$color_index];
?>
        <div class="col-lg-4">
            <div class="box1 box" id="<?php echo $card_id; ?>" style="background-color: <?php echo $background_color; ?>">
                <!-- Card content goes here -->
                <div class="content">
                <div class="image">
                  <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/CRUD/img/<?php echo $rs['profile_picture']; ?>" alt="Profile Image">
                </div>
                <div class="level">
                  <p><?php echo $rs['id']; ?></p>
                </div>
                <div class="text">
                  <p class="name"><?php echo $rs['first_name']; ?> <?php echo $rs['last_name']; ?></p>
                  <p class="job_title"> <a href="tel:+91<?php echo $rs['number']; ?>"><i class="fa-solid fa-phone"></i>+91 <?php echo $rs['number']; ?></a> </p>
                  <p class="job_title"> <a href="mailto:<?php echo $rs['email']; ?>"><i class="fa-solid fa-envelope"></i> <?php echo $rs['email']; ?></a> </p>
                  <p class="job_discription"><?php echo $rs['message']; ?></p>
                </div>

                <div class="button">
                  <div>
                    <button class="message" onclick="openPopup('<?php echo $rs['first_name']; ?>', '<?php echo $rs['last_name']; ?>', '<?php echo $rs['email']; ?>','<?php echo $rs['number']; ?>','<?php echo $rs['message']; ?>', '<?php echo $rs['profile_picture']; ?>','<?php echo $rs['id']; ?>');"> <i class="fa-solid fa-eye"></i></button>
                  </div>
                  <div>
                    <button class="connect" onclick="deleteUser(<?php echo $rs['id']; ?>)"><i class="fa-solid fa-trash"></i></button>
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
        <div class="text-danger h4 text-center">No data found</div>
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

  </div>
</div>

<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <form id="popupContent" method="post" enctype="multipart/form-data">
    </form>
  </div>
</div>
<?php include_once('inc/footer.php'); ?>