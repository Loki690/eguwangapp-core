<?php
include('header.php');
include('session.php');
include('config.php');

if(isset($_SESSION['Role']) && $_SESSION['Role'] == "osca"){
  $user = $_SESSION['UserLogin'];
  $session_id = $_SESSION['ID'];
}else{
  echo '<script language="javascript">';
  echo 'alert("Access Denied!");';
  echo 'window.location="index.php";';
  echo '</script>';
}

// generate random senior citizen ID
$floor = FLOOR(RAND() * 401) + 100;
$id = $floor."-".rand(10,20);

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
        window.location.href="osca-dashboard.php?Registration Successfull";
      </script>
      <?php
    }else { //die($con->error);
      echo "Error: ". $sql . "<br>". $con->error;       
    }
    $con->close();

  }

    


}
?>

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
						<a class="nav-link" href="logout.php">
            <button class="btn btn-primary">Logout</button>
					</a>
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
					<a href="osca-dashboard.php" class="active">
						<i class='bx bxs-dashboard icon' ></i>Senior Registration
					</a>
				</li>
                <li>
					<a href="osca-senior-list.php">
						<i class='bx bxs-meh-blank icon'></i> 
						Seniors 
					</a>
				</li>
				
            </ul>
        </div>

       </div> 
	 </div>
	</div><!-- End Sidebar-->


  <div class="sidebar-overlay"></div>

<!--Content Start-->
<div class="content-start transition">
  <div class="container-fluid dashboard">
    <div class="content-header">
      <h1>Senior Citizen Registration</h1>
      <p></p>
    </div>
    <div class="row">
      
      <div class="col-md-12 col-lg-12">
        <div class="card bg-white">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row g-2 px-3 mt-4">
              <div class="col-md-4 mb-4">
                <label for="seniorID" class="form-label">Senior Citizen ID</label>
                  <input type="text" class="form-control" id="seniorID" name="seniorcitizen_id" placeholder="" value="<?php echo $id; ?>" readonly>
              </div>
          
              <div class="row">
                <div class="col-md-4">
                  <label for="firstname">Fist Name</label>
                  <input type="text" class="form-control form-control-lg" id="firstName" name="first_name" placeholder="" value="" required>
                </div>
                <div class="col-md-4">
                  <label for="middlename">Middle Name</label>
                  <input type="text" class="form-control form-control-lg" id="middlename" name="middle_name" placeholder="" value="" required>
                </div>
                <div class="col-md-4">
                  <label for="lastname">Lastname Name</label>
                  <input type="text" class="form-control form-control-lg" id="lastname" name="last_name" placeholder="" value="" required>
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
                  <input type="date" class="form-control form-control-lg" id="birth_date" name="birth_date" placeholder="" value="" required>
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-md-4">
                  <label for="city" class="form-label">City</label>
                  <select class="form-select form-select-lg" id="province" name="city" required>
                    <option value="">Choose...</option>
                    <option value="Davao City">Davao City</option>
                    <option value="Digos City">Digos City</option>
                    <option value="Mati City">Mati City</option>
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

  </div> <!-- End Container -->
</div><!-- End Content -->

<?php
include('footer.php');
?>