<?php
include('inc/header.php');
include('config/config.php');

$results_per_page = 4; // Number of records to display per page

// Get the current page number
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Get the search query
$searchQuery = isset($_GET['q']) ? $_GET['q'] : '';

// Calculate the offset
$offset = ($current_page - 1) * $results_per_page;

// Modify the SQL query to include search condition and pagination
$get_all_users = "SELECT * FROM user WHERE is_deleted = 1 ";
if (!empty($searchQuery)) {
  $get_all_users .= "AND (first_name LIKE '%$searchQuery%' OR last_name LIKE '%$searchQuery%' OR email LIKE '%$searchQuery%') ";
}

// Count total number of records
$count_query = "SELECT COUNT(*) AS total FROM user WHERE is_deleted = 1";
if (!empty($searchQuery)) {
  $count_query .= " AND (first_name LIKE '%$searchQuery%' OR last_name LIKE '%$searchQuery%' OR email LIKE '%$searchQuery%') ";
}
$count_result = mysqli_query($conn, $count_query);
$count_row = mysqli_fetch_assoc($count_result);
$total_records = $count_row['total'];

// Calculate total number of pages
$total_pages = ceil($total_records / $results_per_page);

// Add LIMIT to the main query for pagination
$get_all_users .= "LIMIT $offset, $results_per_page";

$res = mysqli_query($conn, $get_all_users);
?>

<div class="container-fluid">
  <div class="container">
    <h3 class="text-center text-white">Deleted Users</h3>
    <div class="d-flex justify-content-between ">
      <div>
        <a href="index.php" class="btn btn-info mb-2 pull-right">Home</a>
      </div>
      <div class="search-box d-flex">
        <input type="search" class="form-control" placeholder="By Name and Email.." id="searchInput">
        <button id="searchBtn" class="btn btn-info mb-2 pull-right ml-2"><i class="fa-solid fa-magnifying-glass"></i></button>
      </div>
    </div>
    <table class="table table-dark table-hover">
      <thead>
        <tr>
          <th>Sno</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Profile Image</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if (mysqli_num_rows($res) > 0) {
          while ($rs = mysqli_fetch_assoc($res)) { ?>

            <tr>
              <td><?php echo $rs['id']; ?></td>
              <td><?php echo $rs['first_name']; ?></td>
              <td><?php echo $rs['last_name']; ?></td>
              <td><?php echo $rs['email']; ?></td>
              <td><img src="img/<?php echo $rs['profile_picture']; ?>" alt="Profile Image" style="width:50px; height:50px;"></td>
              <td>

                <a href="javascript:void(0);" onclick="openPopup('<?php echo $rs['first_name']; ?>', '<?php echo $rs['last_name']; ?>', '<?php echo $rs['email']; ?>','<?php echo $rs['number']; ?>','<?php echo $rs['message']; ?>', '<?php echo $rs['profile_picture']; ?>','<?php echo $rs['id']; ?>','<?php echo $rs['is_deleted']; ?>');"><i class="fa-solid fa-eye"></i></a>

                <a href="javascript:void(0);" onclick="restoreFunction(<?php echo $rs['id']; ?>)"><i class="fa-solid fa-rotate-right"></i></a>
                <a href="javascript:void(0);" onclick="permentDlect(<?php echo $rs['id']; ?>)"><i class="fa-solid fa-trash"></i></a>
              </td>
            </tr>
          <?php }
        } else { ?>
          <tr>
            <td colspan="6" style="text-align: center;">No Data Found</td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <!-- Pagination -->
    <div class="d-flex justify-content-center ">
      <ul class="pagination">
        <!-- Previous button -->
        <li class="page-item <?php echo ($current_page == 1) ? 'disabled' : ''; ?>">
          <a class="page-link" href="?page=<?php echo ($current_page - 1) . (!empty($searchQuery) ? '&q=' . urlencode($searchQuery) : ''); ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>

        <!-- Pagination links -->
        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
          <li class="page-item <?php echo ($i == $current_page) ? 'active' : ''; ?>">
            <a class="page-link" href="?page=<?php echo $i . (!empty($searchQuery) ? '&q=' . urlencode($searchQuery) : ''); ?>"><?php echo $i; ?></a>
          </li>
        <?php endfor; ?>

        <!-- Next button -->
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
      <!-- Your form content goes here -->
    </form>
  </div>
</div>

<?php include_once('inc/footer.php'); ?>