<?php
include('header.php');
include('session.php');
include('config.php');

if(isset($_SESSION['Role']) && $_SESSION['Role'] == "osca"){
  $user = $_SESSION['UserLogin'];

}elseif(isset($_SESSION['Role']) && $_SESSION['Role'] == "leader"){
  $user = $_SESSION['UserLogin'];
    
}elseif(isset($_SESSION['Role']) && $_SESSION['Role'] == "barangay"){
  $user = $_SESSION['UserLogin'];

}elseif(isset($_SESSION['Role']) && $_SESSION['Role'] == "dswd"){
    $user = $_SESSION['UserLogin'];
}else{
  echo '<script language="javascript">';
  echo 'alert("Access Denied!");';
  echo 'window.location="index.php";';
  echo '</script>';
}
$id = $_GET['ID'];

// showing senior information 

      $sql = "SELECT * FROM seniors WHERE id = '$id' ";
      $senior = $con->query($sql) or die ($con->error);
      $row = $senior->fetch_assoc();



// updating senior name
      if(isset($_POST['editname'])){
        
        $id = $_GET['ID'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
      
        $sql = "UPDATE seniors SET first_name = '$first_name', middle_name = '$middle_name', last_name = '$last_name' WHERE id = '$id' ";
      
          if ($con->query($sql) === TRUE) {
            ?>
            <script>
              alert('Updated Successfully!');
              window.location.href="senior-details.php?ID=<?php echo $row['id']; ?>";
            </script>

              <?php
          } else {
            echo '<script language="javascript">';
            echo 'alert("Access Denied!");';
            echo '</script>';
          }
        $con->close();

      }

      // updating senior infromation by osca/leader
      if(isset($_POST['editinfo'])){
        $id = $_GET['ID'];
        $gender = $_POST['gender'];
        $birth_date = date('Y-m-d', strtotime(($_POST['birth_date'])));
        $contact_number = $_POST['contact_number'];
        $city = $_POST['city'];
        $barangay = $_POST['barangay'];
        $cluster = $_POST['cluster'];
      
      
        $query = "UPDATE `seniors` SET `gender`='$gender',`contact_number`='$contact_number',`birth_date`='$birth_date',`city`='$city',`barangay`='$barangay',`cluster`='$cluster'  WHERE id = '$id'";
      
          if ($con->query($query) === TRUE) {
            ?>
            <script>
              alert('Updated Successfully!');
              window.location.href="senior-details.php?ID=<?php echo $row['id']; ?>";
            </script>
              <?php

          } else {
            echo '<script language="javascript">';
            echo 'alert("Error");';
            echo '</script>';
          }
        $con->close();

      }

      // updating remittance mode
      if(isset($_POST['select'])){

        $id = $_GET['ID'];
        $remittance_mode = $_POST['remittance_mode'];
      
        $sql = "UPDATE seniors SET `remittance_mode`='$remittance_mode' WHERE id = '$id' ";
      
          if ($con->query($sql) === TRUE) {
            ?>
            <script>
              alert('Updated Successfully!');
              window.location.href="senior-details.php?ID=<?php echo $row['id']; ?>";
            </script>

              <?php
          } else {
            echo '<script language="javascript">';
            echo 'alert("Access Denied!");';
            echo '</script>';
          }
        $con->close();

      }

      // add senior to roster
      if(isset($_POST['add-to-rosters'])){

        $senior_id = $_POST['senior_id'];
        $seniorcitizen_id = $_POST['seniorcitizen_id'];
        $gender = $_POST['gender'];
        $birth_date = date('Y-m-d', strtotime(($_POST['birth_date'])));
        $contact_number = $_POST['contact_number'];
        $city = $_POST['city'];
        $barangay = $_POST['barangay'];
        $cluster = $_POST['cluster'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];

          $sql = "INSERT INTO `rosters`(`seniors_id`, `seniorcitizen_id`, `first_name`, `middle_name`, `last_name`, `gender`, `birth_date`, `city`, `barangay`, `cluster`, `contact_number`)
           VALUES ('$senior_id','$seniorcitizen_id','$first_name','$middle_name','$last_name','$gender','$birth_date','$city','$barangay','$cluster','$contact_number')";
        
          if($con->query($sql) === TRUE){
            ?>
             <script>
              alert('Added to Roster List');
              window.location.href="senior-details.php?ID=<?php echo $row['id']; ?>";
            </script>
            <?php
          }else { //die($con->error);
            ?>
             <script>
              alert('Senior has already added to roster');
            </script>
            <?php
          }
          $con->close();
      
        }      
        // upload birth cert
        if(isset($_POST['birth_cert'])){
          $id = $_GET['ID'];
          // $birth_cert = $_POST['birth_cert'];

          $birth_cert = rand(1000, 1000000)."-".$_FILES['birth_cert']['name'];
          $image_loc = $_FILES['birth_cert']['tmp_name'];
          $folder = "uploads/";

          $new_file_name = strtolower($birth_cert);
          $final_file = str_replace(' ','-',$new_file_name);

          if(move_uploaded_file($image_loc, $folder.$final_file)){
          $sql = "INSERT INTO `senior_req`(`senior_id`, `birth_cert`) VALUES ('$id', '$final_file')";

          if($con->query($sql) === TRUE){
            ?>
             <script>
              alert('Uploaded Successful');
              window.location.href="senior-details.php?ID=<?php echo $row['id']; ?>";
            </script>
            <?php
          }
        }
      }
      // upload valid id
      if(isset($_POST['valid_id'])){
        $id = $_GET['ID'];
        // $birth_cert = $_POST['birth_cert'];

        $valid_id = rand(1000, 1000000)."-".$_FILES['valid_id']['name'];
        $image_loc = $_FILES['valid_id']['tmp_name'];
        $folder = "uploads/";

        $new_file_name = strtolower($valid_id);
        $final_file = str_replace(' ','-',$new_file_name);

        if(move_uploaded_file($image_loc, $folder.$final_file)){

        $sql = "UPDATE `senior_req` SET `valid_id`='$final_file' WHERE `senior_id` = $id ";

        if($con->query($sql) === TRUE){
          ?>
           <script>
            alert('Uploaded Successful');
            window.location.href="senior-details.php?ID=<?php echo $row['id']; ?>";
          </script>
          <?php
        }
      }
    }
    // upload barangay cert
    if(isset($_POST['brgy_cert'])){

      $id = $_GET['ID'];

      $brgy_cert = rand(1000, 1000000)."-".$_FILES['brgy_cert']['name'];
      $image_loc = $_FILES['brgy_cert']['tmp_name'];
      $folder = "uploads/";

      $new_file_name = strtolower($brgy_cert);
      $final_file = str_replace(' ','-',$new_file_name);

      if(move_uploaded_file($image_loc, $folder.$final_file)){

    $sql = "UPDATE `senior_req` SET `brgy_cert`='$final_file' WHERE `senior_id` = $id ";

      if($con->query($sql) === TRUE){
        ?>
         <script>
          alert('Uploaded Successful');
          window.location.href="senior-details.php?ID=<?php echo $row['id']; ?>";
        </script>
        <?php
      }else{
        echo $con->error;
      }
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
        <?php if(isset($_SESSION['UserLogin'])){?>

          <?php if($_SESSION['Role'] == "barangay"){ ?>
          <li>
            <a href="barangay-dashboard.php">
              <i class='bx bxs-dashboard icon' ></i>Dashboard
            </a>
				  </li>
          <li>

            <a href="osca-senior-list.php">
              <i class='bx bxs-meh-blank icon'></i> 
              Seniors 
            </a>
				  </li>
          <li>
              <a href="rosters-list.php" class="active">
               <i class='bx bxs-meh-blank icon'></i> 
                    Roster List
              </a>
			      </li>
          <?php }elseif ($_SESSION['Role'] == "leader"){?>

            <li>
              <a href="leader-dashboard.php" class="">
               <i class='bx bxs-dashboard icon' ></i>Dashboard
              </a>
		        </li>
            <li>
              <a href="osca-senior-list.php" class="active">
               <i class='bx bxs-meh-blank icon'></i> 
                    Seniors 
              </a>
			      </li>
            <li>
              <a href="rosters-list.php" class="">
               <i class='bx bxs-meh-blank icon'></i> 
                    Roster List
              </a>
			      </li>

          <?php }elseif ($_SESSION['Role'] == "dswd"){?>

            <li>
              <a href="dswd-dashboard.php" class="">
               <i class='bx bxs-dashboard icon' ></i>Dashboard
              </a>
		        </li>
            <!-- <li>
              <a href="osca-senior-list.php" >
               <i class='bx bxs-meh-blank icon'></i> 
                    Seniors 
              </a>
			      </li> -->
            <li>
              <a href="rosters-list.php" class="active">
               <i class='bx bxs-meh-blank icon'></i> 
                    Roster List
              </a>
			      </li>

            <?php }elseif ($_SESSION['Role'] == "osca"){?>

              <li>
              <a href="osca-dashboard.php" class="">
               <i class='bx bxs-dashboard icon' ></i>Dashboard
              </a>
		        </li>
            
            <li>
              <a href="osca-senior-list.php" class="active">
               <i class='bx bxs-dashboard icon' ></i>Seniors
              </a>
		        </li>

            <?php }?>
            
          <?php } ?>
            </ul>
        </div>

       </div> 
	 </div>
	</div><!-- End Sidebar-->

  <div class="content-start transition">
      <div class="container-fluid dashboard">
        <div class="content-header">
          <h1>Senior Citizen Information </h1>
       </div>

      <div class="row">
      <div class="col-md-4 bg-primary">
      <div class="d-flex flex-column align-items-center text-center p-3 py-5">
        <img class="rounded-circle mt-5 mb-2" width="200px" height="200px" src="uploads/<?php echo $row['image']; ?>">
      </div>
      </div>
      <div class="col-md-8 bg-white">
      <div class="mt-5 px-4">
            <div>
                <h4 class=""><?php echo $row['first_name']; ?></h4>
              <p>First Name</p>
            </div>
              <div>
                <h4 class=""><?php echo $row['middle_name']; ?></h4>
              <p>Middle Name</p>
            </div>
            <div>
                <h4 class=""><?php echo $row['last_name']; ?></h4>
              <p>Last Name</p>
            </div>
            <div>
                <h5 class=""><?php echo $row['seniorcitizen_id']; ?></h5>
              <p>Senior Citizen ID</p>
            </div>
            </div>
            <?php if(isset($_SESSION['UserLogin'])){?>
              <?php if($_SESSION['Role'] == "osca"){ ?>
            <div class="col-md-12">
                <a href="" class="nav-link navtext text-primary" data-bs-toggle="modal" data-bs-target="#editname">
                  <button class="btn btn-primary w-100">Edit</button>
                </a>
            </div>
            
            <?php }elseif($_SESSION['Role'] == "leader"){ 
              ?>
              <!-- //display if senior is already added to rosters -->
              <?php  ?>
              <div class="col-md-12">
                <a href="" class="nav-link" data-bs-toggle="modal" data-bs-target="#register">
               <button class="btn btn-primary w-100">Add to Rosters</button>
                </a>
            </div>

              <?php }else{

              } ?>
            <?php } ?>
            
      </div>
      
      <div class="col-md-6 px-5 mt-4 bg-white">
      <div class="content-header pt-3">
          <h1>Information</h1>
       </div>
            <div class="vstack gap-3">
              <div>
                <h5>
                Gender : <?php echo $row['gender']; ?>
              </h5>
            </div>
            <div>
                <h5>
                Birth Date : <?php echo $row['birth_date']; ?>
              </h5>
            </div>
            <div>
                <h5>
               Contact NO. : <?php echo $row['contact_number']; ?>
              </h5>
            </div>
            <div>
                <h5>
                City : <?php echo $row['city']; ?>
              </h5>
            </div>
            <div>
                <h5>
                Barangay : <?php echo $row['barangay']; ?>
              </h5>
            </div>
            <div>
                <h5>
                Cluster : <?php echo $row['cluster']; ?>
              </h5>
            </div>
            </div>
            <div class="pe-5">
                <a href="edit" class="" data-bs-toggle="modal" data-bs-target="#editinfo" >
                  <button class="btn btn-primary text-white w-100">Edit</button>
                </a>
            </div>
      </div>

      <?php if(isset($_SESSION['UserLogin'])){?>
              <?php if($_SESSION['Role'] ){ 
                //== "leader"
                ?>
            <div class="col-md-6 px-3 mt-4">
              <div class="card bg-white">
              <div class="pt-2 mb-3 pb-3 text-center">
              <div class="content-header">
                  <h1>Remittance Mode</h1>
              </div>
                <form action="" method="POST">
                  <span>
                      <img src="img/gcashlogo.png" alt="" height="100">
                    </span>
                  <div class="form-check form-check-inline ">
                  <input class="form-check-input" type="radio" name="remittance_mode" id="inlineRadio1" value="Gcash" required>
                  <label class="form-check-label" for="inlineRadio1"></label>
                  </div>
                  <span class="px-2">
                      <img src="img/landbank.png" alt="" height="50">
                    </span>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="remittance_mode" id="inlineRadio2" value="Land Bank" required>
                    <label class="form-check-label" for="inlineRadio2"></label>
                  </div>
                  <span class="px-2">
                      <img src="img/pesocash.jpg" alt="" height="50">
                    </span>
                  <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="remittance_mode" id="inlineRadio3" value="Physical" required checked>
                  <label class="form-check-label" for="inlineRadio3"></label>
                </div>

                <div class="ms-auto px-5 mt-5">
                  <button type="submit" name="select" class="btn btn-outline-primary btn-lg">Select</button>
              </div>
                </form>
                <div>
                <h5 class="mt-5">
                Remittance Mode: <?php echo $row['remittance_mode']; ?>
              </h5>
            </div>
              </div>
              </div>
          </div>
          <?php } ?>

          <?php } ?>

          <div class="col-12 pt-4 mb-3">
            <div class="vstack gap-3 card bg-white">
            <div class="content-header px-4 pt-3">
                  <h1>Requirements</h1>
              </div>
            <?php 
            // showing senior requirements 

            $sql_req = "SELECT * FROM `senior_req` WHERE senior_id = '$id' ";
            $senior_req = $con->query($sql_req) or die($con->error);
            $row_req = $senior_req->fetch_assoc();

           
            ?>
            <div class="px-5 hstack gap-5">
            <div class="">
            <div>
                <h2>
                  <span>
                  <i class="bi bi-1-circle"></i>
                  </span>
                </h2>
              </div>
              <form action="" method="POST" enctype="multipart/form-data">
                <label for="birth_cert" class="form-label">Birth Certificate</label>
                <input type="file" class="form-control" name="birth_cert" id="birth_cert" required>
                <button class="btn btn-primary mt-2 text-white" type="submit" name="birth_cert">Upload</button>
              </form>
              <div class="user-image mb-3 text-start mt-3">
                  <div style="width: 150px; height: 100px;background: #cccccc; margin: 0 auto">
                  <img src="uploads/<?php echo $row_req['birth_cert'] ?>" alt="img" style="width: 150px; height: 100px;background: #cccccc; margin: 0 auto">
                  </div>
                </div>
            </div>
            <div class="">
            <div>
                <h2>
                  <span>
                  <i class="bi bi-2-circle"></i>
                  </span>
                </h2>
              </div>
              <form action="" method="POST" enctype="multipart/form-data">
                  <label for="valid_id" class="form-label">Valid ID</label>
                  <input type="file" class="form-control" name="valid_id" id="valid_id" required>
                  <button class="btn btn-primary mt-2 text-white" type="submit" name="valid_id">Upload</button>
                </form>
                <div class="user-image mb-3 text-start mt-3">
                  <div style="width: 150px; height: 100px;background: #cccccc; margin: 0 auto">
                  <img src="uploads/<?php echo $row_req['valid_id'] ?>" alt="img" style="width: 150px; height: 100px;background: #cccccc; margin: 0 auto">
                  </div>
                </div>
            </div>
            <div class="">
              <div>
                <h2>
                  <span>
                  <i class="bi bi-3-circle"></i>
                  </span>
                </h2>
              </div>
              <form action="" method="POST" enctype="multipart/form-data">
                  <label for="brgy_cert" class="form-label">Barangay Certificate</label>
                  <input type="file" class="form-control" name="brgy_cert" id="brgy_cert" required>
                  <button class="btn btn-primary mt-2 text-white" type="submit" name="brgy_cert">Upload</button>
                </form>
                <div class="user-image mb-3 text-start mt-3">
                  <div style="width: 150px; height: 100px;background: #cccccc; margin: 0 auto">
                  <img src="uploads/<?php echo $row_req['brgy_cert'] ?>" alt="img" style="width: 150px; height: 100px;background: #cccccc; margin: 0 auto">
                  <p></p>
                  </div>
                 
                </div>
            </div>
            </div>
            <!-- <div class="ms-auto px-5 hstack gap-3">
              
                <button class="btn btn-primary text-white">Edit</button>
                <button class="btn btn-secondary text-white"data-bs-toggle="modal" data-bs-target="#upload-requirements" >Upload</button>
            </div> -->
            </div>
            </div>


    </div>

  </div> <!-- End Container -->
</div><!-- End Content -->




<!-- Modal for edit name -->
<div class="modal fade" id="editname" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<form action="" method="POST">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <label for="first_name" class="form-label">First Name</label>
              <input type="text" name="first_name" class="form-control" id="first_name" value="<?php echo $row['first_name']; ?>">
            </div>
            <div class="col-md-12">
              <label for="middle_name" class="form-label">Middle Name </label>
              <input type="text" name="middle_name" class="form-control" id="middle_name" value="<?php echo $row['middle_name'];?>">
            </div>
            <div class="col-md-12 mt-2 mb-4">
              <label for="last_name" class="form-label">Last Name</label>
              <input type="text" name="last_name" class="form-control" id="last_name" value="<?php echo $row['last_name']; ?>">
            </div>
          </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
          <button type="" class="btn btn-primary text-white" name="editname">Save changes</button>
        </div>
    </div>
  </div>
</form>
</div>


<!-- Modal for edit information-->
<div class="modal fade" id="editinfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<form action="" method="POST">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div class="container">
          <div class="row g-2">
            <div class="col-md-6">
            <label for="gender" class="form-label">Gender</label>
                         <select class="form-select" id="gender" name="gender">
                           <option value="">Choose...</option>
                           <option value="Male" <?php echo($row['gender'] == "Male")? 'selected' : ''; ?> >Male</option>
                           <option value="Female"  <?php echo($row['gender'] == "Female")? 'selected' : ''; ?> >Female</option>
                         </select>
            </div>

            <div class="col-md-6">
              <label for="birth_date" class="form-label">Birth Date </label>
                  <input type="date" class="form-control" id="birth_date" name="birth_date" placeholder="" value="<?php echo $row['birth_date'] ?>">
            </div>
            <div class="col-md-12">
            <label for="contact_number" class="form-label">Contact Number</label>
                  <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="11 Digit number " value="<?php echo $row['contact_number'] ?>">
            </div>
            <div class="col-md-6 mt-2 mb-4">
            <label for="city" class="form-label">City</label>
                       <select class="form-select" id="city" name="city">
                         <option value="Davao City" <?php echo($row['city'] == "Davao City")? 'selected' : ''; ?> >Davao City</option>
                         <option value="Digos City"  <?php echo($row['city'] == "Digos City")? 'selected' : ''; ?>>Digos City</option>
                         <option value="Mati City"  <?php echo($row['city'] == "Mati City")? 'selected' : ''; ?>>Mati City</option>
                       </select>
            </div>
            <div class="col-md-6 mt-2 mb-4">
            <label for="barangay" class="form-label">Barangay</label>
                       <select class="form-select" id="barangay" name="barangay" >
                         <option value="Toril Proper" <?php echo($row['barangay'] == "Toril Proper")? 'selected' : ''; ?> >Toril Proper</option>
                         <option value="Dalio" <?php echo($row['barangay'] == "Dalio")? 'selected' : ''; ?> >Dalio</option>
                         <option value="Lizada" <?php echo($row['barangay'] == "Lizada")? 'selected' : ''; ?> >Lizada</option>
                         <option value="Bato" <?php echo($row['barangay'] == "Bato")? 'selected' : ''; ?> >Bato</option>
                       </select>
            </div>
            <div class="col-md-12">
            <label for="cluster" class="form-label">Cluster</label>
                      <select class="form-select" id="cluster" name="cluster" required>
                      <option value="1" <?php echo($row['cluster'] == "1")? 'selected' : ''; ?> >Cluster 1</option>
                      <option value="2" <?php echo($row['cluster'] == "2")? 'selected' : ''; ?> >Cluster 2</option>
                      <option value="3" <?php echo($row['cluster'] == "3")? 'selected' : ''; ?> >Cluster 3</option>
                      <option value="4" <?php echo($row['cluster'] == "4")? 'selected' : ''; ?> >Cluster 4</option>
                      <option value="5" <?php echo($row['cluster'] == "5")? 'selected' : ''; ?> >Cluster 5</option>
                      <option value="6" <?php echo($row['cluster'] == "6")? 'selected' : ''; ?> >Cluster 6</option>
                      <option value="7" <?php echo($row['cluster'] == "7")? 'selected' : ''; ?> >Cluster 7</option>
                      <option value="8" <?php echo($row['cluster'] == "8")? 'selected' : ''; ?> >Cluster 8</option>
                      <option value="9" <?php echo($row['cluster'] == "9")? 'selected' : ''; ?> >Cluster 9</option>
                      <option value="10" <?php echo($row['cluster'] == "10")? 'selected' : ''; ?> >Cluster 10</option>
                      </select>
            </div>
            <!-- <div class="col-md-12">
            <label for="remittance_mode" class="form-label">Remittance Mode</label>
                      <select class="form-select" id="remittance_mode" name="remittance_mode">
                      <option value=" ">Choose...</option>
                      <option value="GCash" <?php // echo($row['remittance_mode'] == "gcash")? 'selected' : ''; ?> >GCash</option>
                      <option value="Land Bank" <?php // echo($row['remittance_mode'] == "bank")? 'selected' : ''; ?> >Bank LandBank </option>
                      <option value="Physical" <?php //echo($row['remittance_mode'] == "pysical")? 'selected' : ''; ?> >Physical Distribution</option>
                      </select>
            </div> -->
          </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
          <button type="" class="btn btn-primary text-white" name="editinfo">Save changes</button>
        </div>
    </div>
  </div>
</form>
</div>

<!-- Modal for add to rosterlist-->
<div class="modal fade" id="register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<form action="" method="POST"  enctype="multipart/form-data" >
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div class="container">
          <div class="row">
              <input type="hidden" name="seniorcitizen_id" class="form-control" id="seniorcitizen_id" value="<?php echo $row['seniorcitizen_id']; ?>">
              <input type="hidden" name="gender" class="form-control" id="gender" value="<?php echo $row['gender']; ?>">
              <input type="hidden" name="birth_date" class="form-control" id="birth_date" value="<?php echo $row['birth_date']; ?>">
              <input type="hidden" name="contact_number" class="form-control" id="contact_number" value="<?php echo $row['contact_number']; ?>">
              <input type="hidden" name="city" class="form-control" id="city" value="<?php echo $row['city']; ?>">
              <input type="hidden" name="barangay" class="form-control" id="barangay" value="<?php echo $row['barangay']; ?>">
              <input type="hidden" name="cluster" class="form-control" id="cluster" value="<?php echo $row['cluster']; ?>">
              <input type="hidden" name="senior_id" class="form-control" id="senior_id" value="<?php echo $row['id']; ?>">
          </div>
          <div class="row">
            <div class="col-md-12">
              <label for="first_name" class="form-label">First Name</label>
              <input type="text" name="first_name" class="form-control" id="first_name" value="<?php echo $row['first_name']; ?>">
            </div>
            <div class="col-md-12">
              <label for="middle_name" class="form-label">Middle Name </label>
              <input type="text" name="middle_name" class="form-control" id="middle_name" value="<?php echo $row['middle_name'];?>">
            </div>
            <div class="col-md-12 mt-2 mb-4">
              <label for="last_name" class="form-label">Last Name</label>
              <input type="text" name="last_name" class="form-control" id="last_name" value="<?php echo $row['last_name']; ?>">
            </div>
          </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
          <button type="" class="btn btn-primary text-white" name="add-to-rosters">Add</button>
        </div>
    </div>
  </div>
</form>
</div>
<!-- Upload Requirements -->
<div class="modal fade" id="upload-requirements" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-12">
                      <label for="birt_cert" class="form-label">Birth Certificate</label>
                    
                      <input type="file" class="form-control" name="birt_cert" id="birt_cert" required>
                    </div>
                    <div class="col-md-12 mt-3">
                      <label for="mobile_number" class="form-label">Valid ID</label>
                     
                      <input type="file" class="form-control" name="valid_id" id="valid_id" required>
                    </div>
                    <div class="col-md-12 mt-3">
                      <label for="address" class="form-label">Barangay Certificate</label>
                      <input type="file" class="form-control" name="brgy_cert" id="brgy_cert" required>
                    </div>
                  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="requirements">Register</button>
      </div>
    </div> 
    </form>
  </div>
</div>


<?php 
 include('footer.php')
?>

