<?php
  include('header.php');
  include('config.php');
  if(!isset($_SESSION)){
    session_start();
  }
  
      $sql = "SELECT * FROM users WHERE id = '".$_SESSION['ID']."' ";
      $senior = $con->query($sql) or die ($con->error);
      $row = $senior->fetch_assoc();

      // showing remiitance mode of the senior form rosters list
      // $sql = "SELECT remittance_mode FROM rosters WHERE seniorcitizen_id = '".$row['seniorcitizen_id']."'";
      // $roster = $con->query($sql) or die ($con->error);
      // $result_mode = $roster->fetch_assoc();

      // showing senior information 
      $sql = "SELECT * FROM seniors WHERE seniorcitizen_id = '".$row['seniorcitizen_id']."' ";
      $roster = $con->query($sql) or die ($con->error);
      $row_roster = $roster->fetch_assoc();

      // fetching image from seniors table
      $sql_img = "SELECT `image` FROM  `seniors` WHERE `seniorcitizen_id` = '".$row['seniorcitizen_id']."'";
      $senior_img = $con->query($sql_img) or die ($con->error);
      $row_img = $senior_img->fetch_assoc();

  
    // updating remittance mode to rosters
    if(isset($_POST['select-remittance'])){

      $remittance_mode = $_POST['remittance_mode'];
      $sql = "UPDATE seniors SET `remittance_mode`='$remittance_mode' WHERE seniorcitizen_id = '".$row['seniorcitizen_id']."'";

        if ($con->query($sql) === TRUE) {
          ?>
          <script>

          Swal.fire(
            'Success',
            'You clicked the button!',
            'success'
          ).then(function(){
            window.location.href="senior-profile.php?ID=<?php echo $row['id']; ?>";
          })
          </script>
            <?php
        } else {
          echo '<script language="javascript">';
          echo 'alert("Error");';
          echo '</script>';
        }
      $con->close();

    }

    //updating username and pass
    if(isset($_POST['new_user&pass'])){
      $new_username = $_POST['new_username'];
      $new_password = $_POST['new_password'];

      $sql = "UPDATE `users` SET `username`='$new_username',`password`='$new_password' WHERE seniorcitizen_id = '".$row['seniorcitizen_id']."'";

      if ($con->query($sql) === TRUE) {
        ?>
        <script>
          alert('User and Password is Updated Successfully!');
          window.location.href="senior-profile.php?ID=<?php echo $row['id']; ?>";
        </script>
          <?php
      } else {
        echo '<script language="javascript">';
        echo 'alert("Error: username is already taken");';
        echo '</script>';
      }
    $con->close();
    }

    // generate senior QR code
    if(isset($_POST['generate-qr'])){
      $data = $_POST['myqrcode'];
      $width = '50';
      $height = '50';

      $url = "https://chart.googleapis.com/chart?cht=qr&chs={$width}x{$height}&chl={$data}";
      $result['img'] = $url;

    }
    //set bank info
    if(isset($_POST['set-bankinfo'])){

      $bankinfo = $_POST['bankinfo'];
      $sql = "UPDATE `seniors` SET `bankinfo` = '$bankinfo' WHERE seniorcitizen_id = '".$row['seniorcitizen_id']."'";
      if ($con->query($sql) === TRUE) {
        ?>
        <script>

        Swal.fire(
          'Success',
          'You clicked the button!',
          'success'
        ).then(function(){
          window.location.href="senior-profile.php?ID=<?php echo $row['id']; ?>";
        })
        </script>
          <?php
      }

    }
    //set gcash info
    if(isset($_POST['set-gcashinfo'])){

      $gcashinfo = $_POST['gcashinfo'];
      $sql = "UPDATE `seniors` SET `gcashinfo` = '$gcashinfo' WHERE seniorcitizen_id = '".$row['seniorcitizen_id']."'";
      if ($con->query($sql) === TRUE) {
        ?>
        <script>

        Swal.fire(
          'Success',
          'You clicked the button!',
          'success'
        ).then(function(){
          window.location.href="senior-profile.php?ID=<?php echo $row['id']; ?>";
        })
        </script>
          <?php
      }else{
        echo '<script language="javascript">';
        echo 'alert("Error");';
        echo '</script>';
      }

    }
include('notification-count.php');
?>

<!--Topbar -->
<div class="topbar transition bg-primary fixed-top pb-5">
	<div class="bars">
		<button type="button" class="btn transition" id="sidebar-toggle">
			<i class="fa fa-bars"></i>
		</button>
	</div>
		<div class="menu">
			<ul>
	
			<li class="nav-item">
					<a class="nav-link" href="senior-notification.php">
					   <i class="fa fa-bell size-icon-1" style="color: white;"></i>
						 <?php if($count == 0) {?>
					
						<?php }else{ ?>
							<span class="badge bg-danger notif"> 
							<?php echo $count; ?> 
						</span>
							<?php } ?>
					</a> 								  
				  </li>
			 
				  <li class="nav-item dropdown">
					<?php if(isset($_SESSION['UserLogin'])){?>
					<a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					  <img src="uploads/<?php echo $row_img['image'] ?>" alt="">
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="senior-profile.php"><i class="fa fa-user size-icon-1"></i> <span><?php echo $_SESSION['UserLogin'];?></span></a>
						<a class="dropdown-item" href="settings.html"><i class="fa fa-cog size-icon-1"></i> <span>Settings</span></a>
						<hr class="dropdown-divider">
						<a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out-alt  size-icon-1"></i> <span>Logout</span></a>
					</ul>
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
					<a href="senior-home.php" class="active">
						<i class='bx bxs-home icon' ></i> Home
					</a>
				</li>
        <li>
					<a href="senior-booklet.php">
					<i class='bx bxs-book-open icon'></i>
						Booklet
					</a>
				</li>
				<li>
					<a href="store-senior-index.php">
						<i class='bx bxs-store icon'></i> 
						Shop
					</a>
				</li>
            </ul>
        </div>

       </div> 
	 </div>
	</div><!-- End Sidebar-->
	<div class="sidebar-overlay"></div>

  <div class="content-start transition">
      <div class="container-fluid dashboard">
     
      <div class="col d-flex flex-column h-sm-100">
            <main class="row overflow-auto">
                    <div class="container-fluid rounded bg-white mt-5 mb-5">
                    <div class="row">
                <div class="col-md-3 bg-primary">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5 mb-2" width="180px" height="180px" src="uploads/<?php echo $row_img['image'] ?>">
                    <span class="font-weight-bold text-white"><?php echo $row_roster['first_name']." ".$row_roster['last_name'];?></span><span class="text-white"><strong><?php echo $row['seniorcitizen_id']; ?></strong></span><span> </span></div>
                    <div class="col-md-12 text-center mb-3 pe-2">
                      <label for="login-information" class="form-label header ">Login Information</label>
                    <input type="text" class="form-control" value="<?php echo $row['username'] ?>">
                    <input type="password" class="form-control mt-2" value="<?php echo $row['password']; ?>" placeholder="Password">
                   
                    </div>
                    <div class="pe-4">
                    <button class="btn btn-primary btn-md mt-2 text-white w-100 " data-bs-toggle="modal" data-bs-target="#setuser-pass">Edit</button>
                    </div>
                   
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right header">Profile Settings</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="form-label">First Name</label><input type="text" class="form-control" placeholder="First Name" value="<?php echo $row_roster['first_name']; ?>" readonly></div>
                            <div class="col-md-6"><label class="form-label">Middle Name</label><input type="text" class="form-control" value="<?php echo $row_roster['middle_name']; ?>" placeholder="Middle Name" readonly></div>
                            <div class="col-md-6 mt-2"><label class="form-label">Last Name</label><input type="text" class="form-control" value="<?php echo $row_roster['last_name']; ?>" placeholder="Last Name" readonly></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6"><label class="form-label">Gender</label><input type="text" class="form-control" placeholder="Male Or Female" value="<?php echo $row_roster['gender']; ?>" readonly></div>
                            <div class="col-md-6"><label class="form-label">Birth Date</label><input type="text" class="form-control" placeholder="" value="<?php echo $row_roster['birth_date']; ?>" readonly></div>
                            <div class="col-md-12 mt-2"><label class="form-label">City</label><input type="text" class="form-control" placeholder="" value="<?php echo $row_roster['city']; ?>" readonly></div>
                            <div class="col-md-12 mt-2"><label class="form-label">Barangay</label><input type="text" class="form-control" placeholder="" value="<?php echo $row_roster['barangay']; ?>" readonly></div>
                          
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6 mt-2"><label class="form-label">Cluster</label><input type="text" class="form-control" placeholder="Cluster" value="<?php echo $row_roster['cluster']; ?>" readonly></div>
                            <div class="col-md-6 mt-2"><label class="form-label">Contact Number</label><input type="text" class="form-control" value="<?php echo $row_roster['contact_number']; ?>" placeholder="Contact Number" readonly></div>
                            <!-- <div class="col-md-12 mt-5 pe-5">
                              <button class="btn btn-primary w-100 btn-md text-white" type="button">Edit</button>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 py-5">
                        <div class="col-md-12">
                        <div class="">
                      <div class="mb-3 pb-3 text-center">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right header">Remittance Mode</h4>
                        </div>
                        <form action="" method="POST" class="mt-4">
                          <div class="form-check form-check-inline ">
                          <input class="form-check-input" type="radio" name="remittance_mode" id="inlineRadio1" value="Gcash" required>
                          <label class="form-check-label" for="inlineRadio1">Gcash</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="remittance_mode" id="inlineRadio2" value="Land Bank" required>
                            <label class="form-check-label" for="inlineRadio2">Land Bank</label>
                          </div>
                          <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="remittance_mode" id="inlineRadio3" value="Physical" checked required>
                          <label class="form-check-label" for="inlineRadio3">Physical</label>
                        </div>

                        <div class="ms-auto px-5 mt-5">
                          <button type="submit" name="select-remittance" class="btn btn-outline-primary btn-md w-50">Select</button>
                      </div>
                        </form>
                        <div>
                        <!-- <p class="mt-5 text-start px-4">
                        Selected Mode: <?php echo $row_roster['remittance_mode'] ?>
                        </p> -->
                    </div>
                      </div>
                  </div>
                      </div>
                      <?php if($row_roster['remittance_mode'] == "Gcash") {?>
                      <div class="col-md-12 text-center mb-3">
                        <div>
                          <span><img src="img/logogcash.png" alt="" width="100"></span>
                          <p>Gcash Number: <?= $row_roster['gcashinfo'] ?></p>
                          <div>
                          <a href="" data-bs-toggle="modal" data-bs-target="#setgcashinfo">Set Information</a>
                          </div>
                        </div>
                      </div>
                      <?php }elseif($row_roster['remittance_mode'] == "Land Bank"){ ?>
                        <div class="col-md-12 text-center mb-3">
                        <div>
                          <span><img src="img/landbank.png" alt="" class="mb-3" width="100"></span>
                          <p>Bank Number: <?= $row_roster['bankinfo'] ?></p>
                          <div>
                          <a href="" data-bs-toggle="modal" data-bs-target="#setbankinfo">Set Information</a>
                          </div>
                        </div>
                      </div>
                        <?php }else{ ?>
                          <div class="col-md-12 text-center mb-3">
                        <div>
                          <span><h5>Physical Claiming</h></span>
                        </div>
                      </div>
                          <?php } ?>
                  
                        <div class="col-md-12 text-center">
                        <?php if(isset($result)){ ?>
                          <div class="mb-1">
                            <img src="<?php echo $result['img']; ?>" alt="OR Code" width="70%" height="70%">
                            <!-- <p class="text-center"><?php //echo $data; ?></p> -->
                        <?php } ?>
                          <form action="" method="POST">
                            <label for="qr"></label>
                            <input type="hidden" name="myqrcode"  id="qr" value="<?php echo "E-guwang ".$row_roster['first_name']." ".$row_roster['middle_name']." ". $row_roster['last_name']." ". $row_roster['seniorcitizen_id']; ?>">
                            <button  type="submit" name="generate-qr" class="btn btn-md btn-primary text-white">Generate My QR Code</button>
                          </form>
                      </div>
                    </div>
                </div>
            </div>
       
        </div>
      </main>
        </div> 
        </div>

     
       
 


    </div>

  </div> <!-- End Container -->
</div><!-- End Content -->


 <!-- Modal set user and pass-->
 <div class="modal fade" id="setuser-pass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Set New Username and Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" >
          <div class="row">
            <div class="col-12">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="new_username" placeholder="New Username" value="<?php echo $row['username'] ?>">
            </div>
            <div class="col-12 mt-3">
              <label for="password" class="form-label">Password</label>
              <input type="text" class="form-control" id="password" name="new_password" placeholder="New Password" value="<?php echo $row['password'] ?>">
            </div>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary text-white" name="new_user&pass">Save changes</button>
      </div>
    </div>
    </form>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="setbankinfo"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Set Information: <strong>LANDBANK</strong> </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <form action="" method="POST">
            <div class="col-md-12">
              
              <label for="bankinfo" class="mb-2">Bank Number</label>
              <input type="text" class="form-control" id="bankinfo" name="bankinfo" placeholder="************" required>

            </div>
        
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="set-bankinfo" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Gcash -->
<div class="modal fade" id="setgcashinfo"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Set Information: <strong>GCASH</strong> </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <form action="" method="POST">
            <div class="col-md-12">
              
              <label for="gcashinfo" class="mb-2">Mobile Number</label>
              <input type="number" class="form-control" id="gcashinfo" name="gcashinfo" placeholder="************" required>

            </div>
        
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="set-gcashinfo" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>





<?php
 include('footer.php');
?>