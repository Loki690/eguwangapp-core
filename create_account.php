<?php
  
  include('config.php');
  if(!isset($_SESSION)){
    session_start();
  }
  

// generate random senior citizen ID
$floor = FLOOR(RAND() * 401) + 100;
$id = $floor."-".rand(10,20);

$sid = $_GET['sid'];

// register senior citizen
if(isset($_POST['register-senior'])){

  $seniorcitizen_id = $_POST['seniorcitizen_id'];
  $first_name = $_POST['first_name'];
  $middle_name = $_POST['middle_name'];
  $last_name = $_POST['last_name'];
  $gender = $_POST['gender'];
  $birth_date = date('Y-m-d', strtotime(($_POST['birth_date'])));
  $contact_number = $_POST['contact_number'];
  $city = $_POST['city'];
  $barangay = $_POST['barangay'];
  $cluster = $_POST['cluster'];

  // adding image 
  $image = rand(1000, 1000000)."-".$_FILES['image']['name'];
  $image_loc = $_FILES['image']['tmp_name'];
  $folder = "uploads/";

  $new_file_name = strtolower($image);
  $final_file = str_replace(' ','-',$new_file_name);
  if(move_uploaded_file($image_loc, $folder.$final_file)){

    $sql = "INSERT INTO `seniors`(`seniorcitizen_id`, `first_name`, `middle_name`, `last_name`, `gender`, `contact_number`, `birth_date`, `city`, `barangay`, `cluster`, image) 
    VALUES ('$seniorcitizen_id','$first_name','$middle_name','$last_name','$gender','$contact_number','$birth_date','$city','$barangay','$cluster', '$final_file')";
  
    if($con->query($sql) === TRUE){
      ?>
       <script>
        alert('Senior Citizen Successfully Registered');
        window.location.href="create_account.php?sid=<?= $seniorcitizen_id ?>";
      </script>
      <?php
    }else { //die($con->error);
      echo "Error: ". $sql . "<br>". $con->error;       
    }
    $con->close();

  }

  

}

  $query = "SELECT * FROM `seniors` WHERE `seniorcitizen_id` = '$sid'";
  $senior = $con->query($query) or die($con->error);
  $result = $senior->fetch_assoc();


  if(isset($_POST['create'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $role = "user";
    $st = "registered";
    $at = "Active";

    $query = "INSERT INTO `users`(`seniorcitizen_id`, `username`, `password`, `role`, `status`, `active`) VALUES ('$sid','$user','$pass','$role','$st','$at')";

    if($con->query($query) === TRUE){
      ?>
       <script>
        alert('Successfully Registered');
        window.location.href="login.php?Registration Successfull";
      </script>
      <?php
    }else{
      $error = $con->error;  
    }
  }
  






?>

<!doctype html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>E-Guwang App</title>

	<!-- Bootstrap CSS-->
	<link rel="stylesheet" href="assets/modules/bootstrap-5.1.3/css/bootstrap.css">
	
	<!-- FontAwesome CSS-->
	<link rel="stylesheet" href="assets/modules/fontawesome6.1.1/css/all.css">
	<!-- Boxicons CSS-->
	<link rel="stylesheet" href="assets/modules/boxicons/css/boxicons.min.css">
	<!-- Apexcharts  CSS -->
	<link rel="stylesheet" href="assets/modules/apexcharts/apexcharts.css">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
	<!-- Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="css/css.css">
  
</head>
<body>
<header>
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
    <div class="container ">
      <a class="navbar-brand" href="#">
        <img src="img/logo.png" alt="" width="50" height="50" class="d-inline-block align-text-top">
      </a>
    
      <h3><strong class="px-3 header" style="color:#E94D1A;">E-GUWANG</strong> </h3>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
            <li class="nav-item">
           
            </li>
               <li class="nav navtext">
              
            <?php if(isset($_SESSION['UserLogin'])){?>
                <a href="senior-home.php" class="nav-link" style="color:#E94D1A;">Home</a>
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <?php echo $_SESSION['UserLogin']; ?>
                        </a>

                        <?php if($_SESSION['Role'] == "leader"){ ?>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a href="" class="dropdown-item">Profile</a>
                                    <a href="leader-dashboard.php" class="dropdown-item">Dasboard</a>
                                    <a href="logout.php" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                        <li class="nav navtext">
                        <?php }elseif($_SESSION['Role'] == "osca"){?>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a href="" class="dropdown-item">Profile</a>
                                        <a href="logout.php" class="dropdown-item">Logout</a>
                                    </div>
                        </li>
                        <li class="nav navtext">
                                <?php }else{ ?>
                                  
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a href="senior-profile.php" class="dropdown-item">Profile</a>
                                        <a href="senior-notification.php" class="dropdown-item">Notification</a>
                                        <a href="logout.php" class="dropdown-item">Logout</a>
                                </div>

                                <?php } ?>
                         </li>

                            <?php }else{ ?>
                            <li class="nav-item">
                            <h5><a href="index.php" class="nav-link"  style="color:#E94D1A;">Home</a> </h5>
                            </li>
                            <li class="nav-item">
                                <h5><a href="login.php" class="nav-link"  style="color:#E94D1A;">Login</a></h5>
                            </li>
                            <?php } ?>
            </ul>
        </div>
  </div>
  </nav>

</header>
<br><br><br>

  <div class="container py-5">
    <div class="row text-center text-white">
        <div class="col-lg-8 mx-auto">
            <h1 class="display-4">Create Account</h1>
            <p class="lead mb-0">Welcome <?= $result['first_name']." ".$result['last_name']; ?></p>
           
        </div>
    </div>
</div><!-- End -->


<div class="container">
    <div class="row">
     <div class="col-md-4"></div>
     <div class="col-md-4">
      <div class="row">
        <div class="col-md-12">
          <form action="" method="POST">
          <label for="username" class="form-label">Set Username 
            <?php if(!empty($error)){ ?>
              <span class="text-danger" class="invalid-feedback"><?= $error; ?></span>
              <?php } ?>
          </label>
          <input type="text" class="form-control" name="username" id="username" required >
          <div id="username" class="invalid-feedback">
   
          </div>
          <label for="password" class="form-label mt-2">Set Password</label>
          <input type="password" class="form-control" name="password" id="password" required>
        </div>
        <div class="col-md-12 mt-2">
          <button class="btn btn-primary" type="submit" name="create">Create Account
          </button>
        </div>
        </form>
      </div>
     </div>
     <div class="col-md-4"></div>
    </div>
</div>

  


  <div class="b-example-divider"></div>

<div class="container-fluid bg-white">
  <footer class="py-3 my-4">
    <ul class="nav justify-content-center border-bottom pb-5 mb-3">
      <li class="nav-item"><a href="#" class="nav-link px-2" style="font-size: 1rem;">Home</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2" style="font-size: 1rem;">Features</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2" style="font-size: 1rem;">About</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2"><i class="bi bi-facebook" style="font-size: 1rem;"></i></a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2"><i class="bi bi-linkedin" style="font-size: 1rem;"></i></i></a></li>
      
    </ul>
    <p class="text-center text-muted">&copy; 2022 E-GuwangApp</p>
  </footer>
</div>
  
	<!-- Preloader -->
	<div class="loader">
		<div class="spinner-border text-light" role="status">
			<span class="sr-only">Loading...</span>
		</div>
	</div>
	
	<!-- Loader -->
	<div class="loader-overlay"></div>

	<!-- General JS Scripts -->
	<script src="assets/js/atrana.js"></script>

	<!-- JS Libraies -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.16/dist/sweetalert2.all.min.js"></script>
	<script src="assets/modules/jquery/jquery.min.js"></script>
	<script src="assets/modules/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
	<script src="assets/modules/popper/popper.min.js"></script>

	<!-- Chart Js -->
	<script src="assets/modules/apexcharts/apexcharts.js"></script>
	<script src="assets/js/ui-apexcharts.js"></script>

    <!-- Template JS File -->
	<script src="assets/js/script.js"></script>
	<script src="assets/js/custom.js"></script>
	
 </body>
</html>