<?php
  
  include('config.php');

// generate random senior citizen ID
$floor = FLOOR(RAND() * 401) + 100;
$id = $floor;
// .rand(10,20);

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
  

    $sql = "INSERT INTO `seniors`(`seniorcitizen_id`, `first_name`, `middle_name`, `last_name`, `gender`, `contact_number`, `birth_date`, `city`, `barangay`, `cluster`, `image`) 
    VALUES ('$seniorcitizen_id','$first_name','$middle_name','$last_name','$gender','$contact_number','$birth_date','$city','$barangay','$cluster', '$final_file')";
  
    if($con->query($sql) === TRUE){

      move_uploaded_file($image_loc, $folder.$final_file);

     
      ?>
       <script>
        alert('Senior Citizen Successfully Registered');
        window.location.href="create_account.php?sid=<?= $seniorcitizen_id ?>";
      </script>
      <?php
    } else { //die($con->error);
      echo "Error: ". $sql . "<br>". $con->error;       
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

	<title>Registration</title>

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
            <h1 class="display-4">Registration</h1>
            <p class="lead mb-0">Register as Senior Citizen</p>
           
        </div>
    </div>
</div><!-- End -->


<div class="container">
    <div class="row">
      
      <div class="col-md-12 col-lg-12">
        <div class="card bg-white">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row g-2 px-3 mt-4">
              <div class="col-md-4 mb-4">
                <label for="seniorID" class="form-label">Senior Citizen ID</label>
                  <input type="text" class="form-control" id="seniorID" name="seniorcitizen_id" placeholder="" value="<?= $id; ?>" readonly>
              </div>
          
              <div class="row">
                <div class="col-md-4">
                  <label for="firstname" class="form-label">Fist Name</label>
                  <input type="text" class="form-control form-control-lg" id="firstName" name="first_name" placeholder=""  required>
                </div>
                <div class="col-md-4">
                  <label for="middlename" class="form-label">Middle Name</label>
                  <input type="text" class="form-control form-control-lg" id="middlename" name="middle_name" placeholder=""  required>
                </div>
                <div class="col-md-4">
                  <label for="lastname" class="form-label">Lastname Name</label>
                  <input type="text" class="form-control form-control-lg" id="lastname" name="last_name" placeholder="" required>
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-md-2">
                  <label for="gender" class="form-label">Gender</label>
                  <select class="form-select form-select-lg" id="gender" required name="gender">
                    <option value="">Choose...</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="contact_number" class="form-label">Contact Number</label>
                  <input type="text" class="form-control form-control-lg" id="contact_number" name="contact_number" placeholder="11 Digit number " required>
                </div>
                <div class="col-md-6">
                  <label for="birth_date" class="form-label">Birth Date</label>
                  <input type="date" class="form-control form-control-lg" id="birth_date" name="birth_date" placeholder="" required>
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-md-4">
                  <label for="city" class="form-label">City</label>
                  <select class="form-select form-select-lg" id="province" name="city" required>
                    <option value="">Choose...</option>
                    <option value="Davao City">Davao City</option>
                    
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="barangay" class="form-label">Barangay</label>
                  <select class="form-select form-select-lg" id="city" name="barangay" required>
                    <option value="">Choose...</option>
                    <option value="Toril">Toril Proper</option>
                    <option value="Dalio">Dalio</option>
                    <option value="Lizada">Lizada</option>
                    <option value="Bato">Bato</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="cluster" class="form-label">Cluster</label>
                  <select class="form-select form-select-lg" id="cluster" name="cluster" required>
                    <option value="">Choose...</option>
                    <option value="1">Cluster 1</option>
                    <option value="2">Cluster 2</option>
                    <option value="3">Cluster 3</option>
                    <option value="4">Cluster 4</option>
                    <option value="5">Cluster 5</option>
                    <option value="6">Cluster 6</option>
                    <option value="7">Cluster 7</option>
                    <option value="8">Cluster 8</option>
                    <option value="9">Cluster 9</option>
                    <option value="10">Cluster 10</option>
                  </select>
                </div>
                <div class="col-md-6 mt-3">
                  <label for="image" class="form-label">Photo</label>
                  <input type="file" class="form-control form-control-lg" name="image" id="image" required>
                </div>
                <div class="row">
                <div class="col-md-12 col-lg-12 mt-4">
                  <button class="btn btn-primary btn-lg w-100 mb-5" name="register-senior">Resgister</button>
                </div>
                </div>
              </div>
            </div>
          </form>
      </div>
      </div>
     
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