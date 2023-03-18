<?php
include('header.php');
include('session.php');
include('config.php');

if(isset($_SESSION['Role']) && $_SESSION['Role'] == "dswd"){
  $user = $_SESSION['UserLogin'];
  $session_id = $_SESSION['ID'];

}elseif(isset($_SESSION['Role']) && $_SESSION['Role'] == "barangay"){
  $user = $_SESSION['UserLogin'];
  $session_id = $_SESSION['ID'];
}else{
  echo '<script language="javascript">';
  echo 'alert("Access Denied!");';
  echo 'window.location="index.php";';
  echo '</script>';
}

if(isset($_POST['announcement'])){

  $title = $_POST['title'];
  $message = $_POST['message'];
  $user_name = $_POST['user_name'];
  $type = $_POST['type'];

  $sql = "INSERT INTO `announcements`(`user`, `title`, `message`, `type`) 
    VALUES ('$user_name','$title','$message','$type')";
    
    if($con->query($sql) === TRUE){
      ?>
       <script>
        alert('Announce Successfully');
        window.location.href="barangay-dashboard.php?Successful";
      </script>
      <?php
    }else { //die($con->error);
      echo "Error: ". $sql . "<br>". $con->error;
    }
    $con->close();

}
// create remittance 
if(isset($_POST['remittance'])) {

    $barangay = $_POST['barangay'];
    $cluster = $_POST['cluster'];
    $age = $_POST['age'];
    $amount = $_POST['amount'];
    $comment = $_POST['comment'];

    $sql = "INSERT INTO remittances (user, barangay, cluster, age, amount, comment) VALUES ('".$_SESSION['UserLogin']."','$barangay', '$cluster', '$age', '$amount', '$comment')";
    
    if ($con->query($sql) === TRUE) {
      ?>
      <script>
        alert('Send Successfully!');
        window.location.href="barangay-dashboard.php";
      </script>
        <?php
    } else {
        echo '<script language="javascript">';
        echo 'alert("Unsuccessful!");';
        echo 'window.location="dswd-dashboard.php";';
        echo '</script>';
    }
  $conn->close();
  }

  $query = "SELECT COUNT(*) AS count FROM users";
  $result = $con->query($query);
  while($row = mysqli_fetch_assoc($result)){
    $output = $row['count'];
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
          <a href="barangay-dashboard.php" class="active">
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
          <h1>Leader Dashboard</h1>
          <p></p>
       </div>
      <div class="row">

      <div class="col-md-6 col-lg-5">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
									<i class="bx bx-building icon icon-home bg-primary text-light"></i>
								</div>
								<div class="col-8">
									<h4>Seniors in Barangay</h4>
									<h3>100</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			
        <div class="col-md-6 col-lg-5">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
								<h1><i class="fa-sharp fa-solid fa-users fa-2xlg"></i></h1>
								</div>
								<div class="col-8">
									<h4>Rosters in Barangay</h4>
									<h3>100</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card">
						<div class="card-header hstack gap-4">
              <div class="">
              <h1><i class="bi bi-megaphone-fill "></i></h1>
                  </div>
							<div>
              <h2>Recent Announcements</h2>
              </div>
						</div>
						<div class="card-body pb-4">
							<div class="recent-message d-flex px-4 py-3">
								<!-- <div class="avatar avatar-lg">
									<img src="assets/images/message/4.jpg">
								</div> -->
								<div class="name ms-4">
									<h5 class="mb-1">Announcement number 1</h5>
									<h6 class="text-muted mb-0">@johnducky</h6>
								</div>
							</div>
							<div class="recent-message d-flex px-4 py-3">
								<!-- <div class="avatar avatar-lg">
									<img src="assets/images/message/5.jpg">
								</div> -->
								<div class="name ms-4">
									<h5 class="mb-1">lorem</h5>
									<h6 class="text-muted mb-0">@imdean</h6>
								</div>
							</div>
							<div class="recent-message d-flex px-4 py-3">
								<!-- <div class="avatar avatar-lg">
									<img src="assets/images/message/1.jpg">
								</div> -->
								<div class="name ms-4">
									<h5 class="mb-1">Ipsum</h5>
									<h6 class="text-muted mb-0">@Doejohn</h6>
								</div>
							</div>
							<div class="px-4">
								<button class='btn btn-block btn-lg btn-primary font-bold mt-3' data-bs-toggle="modal" data-bs-target="#create-announcement">Create new Announcement</button>
							</div>
						</div>
					</div>
				</div>
    </div>

  </div> <!-- End Container -->
</div><!-- End Content -->
  



<!-- Modal Create Announcement -->
<div class="modal fade" id="create-announcement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-primary fs-5" id="exampleModalLabel">Announcement </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data" class="container-fluid">
          <div class="row">
            <div class="col-md-12">
            <div class="form-floating mb-3">
            <?php if(isset($_SESSION['UserLogin'])){?>
                <input type="hidden" class="form-control" id="user_name" name="user_name" value="<?php echo $_SESSION['UserLogin']; ?>">
              <?php }?>
                <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
                <label for="title">Title</label>
              </div>
            </div>
            <div class="col-md-12">
            <div class="form-floating">
              <textarea class="form-control" placeholder="Text Here" name="message" id="message" rows="6" style="height: 120px" required></textarea>
              <label for="message">Type Text Here</label>
            </div>
            </div>
            <div class="col-md-12 mt-3">
              <label for="" class="form-label">Announcement Type</label>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="type" value="Remittance" checked>
              <label class="form-check-label" for="flexSwitchCheckDefault">Remittance</label>
            </div>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="type" value="Meeting">
              <label class="form-check-label" for="flexSwitchCheckChecked">Meeting</label>
            </div>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="type" value="Announcement">
              <label class="form-check-label" for="flexSwitchCheckChecked">Announcement</label>
            </div>
            </div>
          </div>
        </div>
        <div class="modal-footer mt-5">
          <button type="button" class="btn btn-danger btn-lg" data-bs-dismiss="modal">Discard</button>
          <button type="submit" name="announcement" class="btn btn-primary btn-lg text-white">Announce</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php
  include('footer.php');
?>