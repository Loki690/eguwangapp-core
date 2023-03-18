<?php 
include('header.php');
include('config.php');
include('session.php');

if(isset($_SESSION['Role']) && $_SESSION['Role'] == "dswd"){
  $user = $_SESSION['UserLogin'];
  $session_id = $_SESSION['ID'];
}else{
  echo '<script language="javascript">';
  echo 'alert("Access Denied!");';
  echo 'window.location="index.php";';
  echo '</script>';
}

      $id = $_GET['ID'];

      $sql = "SELECT * FROM rosters WHERE id = '$id' ";
      $roster = $con->query($sql) or die ($con->error);
      $row = $roster->fetch_assoc();

      if(isset($_POST['register-user'])){

        $username = $_POST['username'];
        $seniorcitizen_id = $_POST['seniorcitizen_id'];
        $password = $_POST['password'];
        $status = $_POST['status'];
        $role = $_POST['role'];
        $active = "Active";

        $sql = "INSERT INTO `users` (`seniorcitizen_id`,`username`, `password`, `role`, `status`, `active`)
         VALUES ('$seniorcitizen_id','$username','$password','$role','$status', '$active')";

             if($con->query($sql) === TRUE){
              ?>
               <script>
                alert('Senior Citizen Successfully Registered');
                window.location.href="rosters-list.php?Registration Successfull";
              </script>
              <?php
            }else { //die($con->error);
            //   ?>
            //   <script>
               alert('Senior has already an account! ');
               window.location.href="rosters-list.php?Unsuccessfull";
            //  </script>
            
            //  <?php
             echo die($con->error);
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
          <a href="dswd-dashboard.php" class="active">
            <i class='bx bxs-dashboard icon' ></i>Dashboard
          </a>
		    </li>
        <li>
      <a href="rosters-list.php">
       <i class='bx bxs-meh-blank icon'></i> 
            Roster List
      </a>
			      </li>
            </ul>
           
        </div>

       </div> 
	 </div>
	</div><!-- End Sidebar-->

  
  <div class="content-start transition">
      <div class="container-fluid dashboard">
        <div class="content-header">
          <h1>Senior Account Registration</h1>
          <p></p>
       </div>
      <div class="row">

      <div class="col-12 pt-4 mb-3 text-center">
        <div class="card bg-white">
        <div class="hstack mt-5 mb-5">
              <div class="col-md-3 px-3">
              <div>
                <h5 class="display-6"><?php echo $row['first_name']; ?></h5>
              <p class="text-black">First Name</p>
            </div>
              </div>
            
              <div class="col-md-3">
              <div>
                <h5 class="display-6"><?php echo $row['middle_name']; ?></h5>
              <p class="text-black">Middle Name </p>
            </div>
              </div>
              <div class="col-md-3">
              <div>
                <h5 class="display-6"><?php echo $row['last_name']; ?></h5>
              <p class="text-black">Last Name</p>
            </div>
              </div>
              <div class="col-md-3">
              <div>
                <h5 class="display-7 mt-4"><?php echo $row['seniorcitizen_id']; ?></h5>
              <p class="text-black">Senior Citizen ID</p>
            </div>
              </div>
            </div>
            </div>
          </div>
      
          <div class="container-fluid card px-3 mb-5">
            <form action="" method="POST" enctype="multipart/form-data">
            <div class="row g-2 px-3 mt-4">
             
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                <div class="col-md-12">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="username" value="<?php echo $row['first_name'];?>" required>
                </div>
                <div class="col-md-12 mt-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="text" class="form-control form-control-lg" id="password" name="password" placeholder="password" value="<?php echo $row['seniorcitizen_id'] ?>" readonly>
                </div>
                <input type="hidden" name="role" id="role" value="user">
                <input type="hidden" name="status" id="role" value="registered">
                <input type="hidden" name="seniorcitizen_id" id="seniorcitizen_id" value="<?php echo $row['seniorcitizen_id']; ?>">
                <div class="row mt-5 mb-4">
                <div class="col-md-12 text-start ">
                  <button class="btn btn-primary btn-lg w-100 text-white" type="submit"  name="register-user">Resgister</button>
                </div>
              </div>
                </div>
                <div class="col-md-4">
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