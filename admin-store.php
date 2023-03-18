<?php

include('session.php');
include('config.php');

if(isset($_SESSION['Role']) && $_SESSION['Role'] == "admin"){
  $user = $_SESSION['UserLogin'];
  $session_id = $_SESSION['ID'];
}else{
  echo '<script language="javascript">';
  echo 'alert("Access Denied!");';
  echo 'window.location="index.php";';
  echo '</script>';
}

  $sql = "SELECT * FROM `stores`";
  $users = $con->query($sql) or die($con->error);

  require_once('class.php');
  $store->registerStore($_POST);

  function generateRandomPassword() {
    $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < 8; $i++) {
        $index = rand(0, $count - 1);
        $result .= mb_substr($chars, $index, 1);
    }

    return $result;
}

$password = generateRandomPassword();


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-Guwang App</title>

  	<!-- Bootstrap CSS-->
    <link rel="stylesheet" href="assets/modules/bootstrap-5.1.3/css/bootstrap.css">
	<!-- Style CSS -->
	<link rel="stylesheet" href="assets/css/style.css">
	<!-- FontAwesome CSS-->
	<link rel="stylesheet" href="assets/modules/fontawesome6.1.1/css/all.css">
	<!-- Boxicons CSS-->
	<link rel="stylesheet" href="assets/modules/boxicons/css/boxicons.min.css">
	<!-- Apexcharts  CSS -->
	<link rel="stylesheet" href="assets/modules/apexcharts/apexcharts.css">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css"/>
  
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.js"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <!-- General JS Scripts -->
	<script src="assets/js/atrana.js"></script>
  <script src="assets/modules/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
	<script src="assets/modules/popper/popper.min.js"></script>
  
    <!-- Template JS File -->
	<script src="assets/js/script.js"></script>
	<script src="assets/js/custom.js"></script>



</head>
<body>
<div class="topbar transition">
	<div class="bars">
		<button type="button" class="btn transition" id="sidebar-toggle">
			<i class="fa fa-bars"></i>
		</button>
	</div>
		<div class="menu">
			<ul>
				  <li class="nav-item dropdown">
          <?php
                  if(!isset($_SESSION)){
                    session_start();
                  }
                ?>
					<?php if(isset($_SESSION['UserLogin'])){?>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#logout">Logout</button>
				  </li>
			</ul>
			<?php } ?>
		</div>
	</div>

  <!--Sidebar-->
	<div class="sidebar transition overlay-scrollbars">
        <div class="sidebar-content"> 
        	<div id="sidebar">
			
			<!-- Logo -->
			<div class="logo">
					<h2 class="mb-0">E-Guwang</h2>
			</div>

            <ul class="side-menu">
                <li>
                  <a href="admin-dashboard.php">
                    <i class='bx bxs-dashboard icon' ></i>Dashboard
                  </a>
				        </li>
                <li>
                  <a href="users.php">
                    <i class='bx bxs-meh-blank icon'></i> 
                    Users
                  </a>
			        	</li>
                <li>
              <a href="admin-store.php" class="active">
               <i class='bx bxs-meh-blank icon'></i> 
                  Stores
              </a>
			      </li>
            </ul>
        </div>

       </div> 
	 </div><!-- End Sidebar--> 

   
  <div class="content-start transition">
      <div class="container-fluid dashboard">
        <div class="content-header">
          <h1><i class='bx bxs-dashboard icon' > </i> E-guwang Stores</h1>
          <p></p>
       </div>
      <div class="row card mt-3 bg-white">
        <div class="col-md-12 mt-3 d-flex">
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#store-register">Add Store <span><i class="bi bi-plus"></i></span></button>
        </div>
      <div class="table-responsive px-4 mt-4 pt-2">
<table class="table table-border table-striped table-hover">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Store Name</th>
        <th scope="col">Username</th>
        <th scope="col">Mobile Number</th>
        <th scope="col">Address</th>
        <th scope="col">Active</th>
        <th scope="col">Action </th>
    </tr>
    </thead>
    <tbody >
    <?php while($row = $users->fetch_assoc()){?>
    <tr class="">
    <td scope="row"><?= $row['id'] ?></td>
    <td scope="row"><?= $row['store_name'] ?></td>
    <td scope="row"><?= $row['username'] ?></td>
    <td scope="row"><?= $row['mobile_number'] ?></td>
    <td scope="row"><?= $row['address'] ?></td>
    <td scope="row">Active</td>
    <td scope="row"><a href="">Delete</a></td>
    </tr>
    <?php } ?>

    </tbody>

</table>

</div>

    </div>

  </div> <!-- End Container -->
</div><!-- End Content -->

<!-- Logout Modal -->
<div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Logout</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
       <div class="modal-body">
         <h4>
           Are you sure you want to Logout?
         </h4>
      </div>
      <div class="modal-footer">
      <form action="logout.php" method="POST">
           <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-primary text-white">Logout</button>
           </form>
      </div>
      </div>
  </div>
</div>

  <!-- Register Store -->
  <div class="modal fade" id="store-register" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Register Store</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-12">
                      <label for="store_name" class="form-label">Store Name</label>
                      <input type="text" class="form-control" name="store_name" id="store_name" required>
                    </div>
                    <div class="col-md-12 mt-2">
                      <label for="username" class="form-label">Set Username</label>
                      <input type="text" class="form-control" name="username" id="username" required>
                      <label for="password" class="form-label mt-2">Password</label>
                      <input type="text" class="form-control" name="password" id="password" value="<?= $password; ?>" required>
                    </div>
                    
                    <div class="col-md-12 mt-2">
                      <label for="mobile_number" class="form-label">Mobile Number</label>
                      <input type="number" class="form-control" name="mobile_number" id="mobile_number" min="1" required>
                    </div>
                    <div class="col-md-12 mt-2">
                      <label for="address" class="form-label">Address</label>
                      <input type="text" class="form-control" name="address" id="address" required>
                    </div>
                    <div class="user-image mb-3 text-start mt-3">
                      <div style="width: 150px; height: 100px; overflow: hidden; background: #cccccc; margin: 0 auto">
                      <img src="" alt="" class="figure-img img-fluid rounded" id="imgPlaceHolder">
                    </div>
                    </div>
                    <?php if(!empty($resMessage)){ ?>
                        <div class="alert <?php echo $resMessage['status']; ?>">
                          <?php $resMessage['message']; ?>
                        </div>
                      <?php } ?>
                    <div class="col-md-12 mt-2">
                      <label for="chooseFile" class="form-label">Profile</label>
                      <input type="file" class="form-control" name="image" id="chooseFile">
                    </div>
                  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="store-register">Register</button>
      </div>
    </div> 
    </form>
  </div>
</div>

</body>
	<!-- General JS Scripts -->
	<script src="assets/js/atrana.js"></script>
  <script src="assets/modules/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
	<script src="assets/modules/popper/popper.min.js"></script>
  
    <!-- Template JS File -->
	<script src="assets/js/script.js"></script>
	<script src="assets/js/custom.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $('table').DataTable();
    });
  </script>
</html>