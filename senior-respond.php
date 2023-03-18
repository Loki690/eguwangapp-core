<?php
include('header.php'
);
include('config.php');
if(!isset($_SESSION)){
  session_start();
}

  // type of user can access
  if(isset($_SESSION['Role']) && $_SESSION['Role'] == "user"){
    $user = $_SESSION['UserLogin'];
    $session_id = $_SESSION['ID'];
  }else{

    echo '<script language="javascript">';
    echo 'alert("Access Denied!");';
    echo 'window.location="index.php";';
    echo '</script>';

  }

    $id = $_GET['ID'];
  // get data form announcement
    $sql = "SELECT * FROM announcements WHERE id = '$id'";
    $annoucement = $con->query($sql) or die ($con->error);
    $row = $annoucement->fetch_assoc();

    // respond to announcement
    if(isset($_POST['respond'])){
      $id = $_GET['ID'];
      $user_id = $_POST['user_id'];
      $reponse = $_POST['response'];
      // $annoucement_id = ['announcement_id'];
      $sql = "INSERT INTO `announcement_responses`(`announcement_id`,`user_id`,`user_username`,`response`)
       VALUES ('$id','$user_id','".$_SESSION['UserLogin']."','$reponse')";
        if($con->query($sql) === TRUE){
          // ?>
          //  <script>
          //   window.location.href="senior-home.php?Successfull";
          // </script>
          // <?php
        }else { 
          die($con->error);
        }
    }

    $sql1 = "SELECT * FROM users WHERE id = '".$_SESSION['ID']."' ";
    $senior = $con->query($sql1) or die ($con->error);
    $row1 = $senior->fetch_assoc();

    $sql_img = "SELECT `image` FROM  `seniors` WHERE `seniorcitizen_id` = '".$row1['seniorcitizen_id']."'";
    $senior_img = $con->query($sql_img) or die ($con->error);
    $row_img = $senior_img->fetch_assoc();

    // update to cancel the response
    if(isset($_POST['res-cancel'])){
      
      $id = $_GET['ID'];
      // $cancel = "cancelled";

      $sql = "UPDATE `announcement_responses` 
      SET `iscancelled` = 1 
      WHERE `announcement_id` = '$id' ";

      if($con->query($sql) === TRUE){
        ?>
         <!-- <script>
          alert('Cancelled');
          window.location.href="senior-home.php?Successfull";
        </script> -->
        <?php
         header('senior-home.php?Successfull');
      }else { 
        die($con->error);
      }
    }

    if(isset($_POST['respond-another'])){
      
      $id = $_GET['ID'];
      // $cancel = "cancelled";

      $sql = "UPDATE `announcement_responses` 
      SET `iscancelled` = 0 
      WHERE `announcement_id` = '$id' ";

      if($con->query($sql) === TRUE){
        ?>
         <!-- <script>
          alert('Respond Successfull');
          window.location.href="senior-home.php?Successfull";
        </script> -->
        <?php

        header('senior-home.php?Successfull');
      }else { 
        die($con->error);
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

	<!--Content Start-->
	<div class="content-start transition mt-5">
		<div class="container-fluid dashboard">
			<div class="content-header">
				<h1> <span><i class='bx bxs-hand-up'></i></span> Response</h1>
				<p></p>
			</div>
			<div class="row">
      <div class="col-md-6 col-lg-12">
					<div class="card">
						<div class="card-header">
							<h2><?= $row['type'] ?></h2>
							<p>Posted by: <?= $row['user'] ?></p>
						</div>
						<div class="card-body pb-4">
							<div class="card-title text-black px-4"><?= $row['title'] ?></div>
							<div class="recent-message d-flex px-4 py-3">
								<div class="name ms">
									<h5 class="mb-1"><?= $row['message'] ?></h5>
								</div>
							</div>

							<?php 
                 $sql_response = "SELECT * FROM `announcement_responses` WHERE `announcement_id` = '".$row['id']."' AND `user_id` = '".$_SESSION['ID']."'";
                	$response = $con->query($sql_response) or die ($con->error);
                	$result = $response->fetch_assoc();
               ?>
							<?php if(isset($result['response']) == "responded"){?>

								<?php if($result['iscancelled'] == 1){ ?>

                  <form action="" method="POST">
                  <input type="hidden" value="<?php echo $session_id;?>" name="user_id">
                  <input type="hidden" value="responded" name="response">
                  <div class="px-3 col-md-6 col-sm-12 col-lg-12">
										
										<button type="submit" name="respond-another" class='btn btn-block btn-xl btn-primary btn-lg font-bold mt-3'>
											Respond</button>
										
									</div>
                  </form>

								<?php }else{ ?>

                  <form action="" method="POST">
										<button type="submit" name="res-cancel" id="res-cancel" class="btn btn-warning text-black btn-lg w-100"><i class="bi bi-check"></i>Cancel</button>
                  </form>

									<?php } ?>

							<?php }else{ ?>

                <form action="" method="POST">
                  <input type="hidden" value="<?php echo $session_id;?>" name="user_id">
                  <input type="hidden" value="responded" name="response">
                  <div class="px-3 col-md-6 col-sm-12 col-lg-12">
                   
                    <button type="submit" name="respond" class='btn btn-block btn-xl btn-primary btn-lg font-bold mt-3'>
                      Respond</button>
                   
                  </div>
                  </form>

							<?php } ?>
						</div>
					</div>
				</div>


		</div> <!-- End Container -->
	</div><!-- End Content -->
  
<?php
include('footer.php')
?>