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
  $city = $_POST['city'];
  $brgy = $_POST['brgy'];

  $sql = "INSERT INTO `announcements`(`user`, `title`, `message`, `type`, `city`, `brgy`) 
    VALUES ('$user_name','$title','$message','$type', '$city', '$brgy')";
    
    if($con->query($sql) === TRUE){
      ?>
       <script>
        alert('Announce Successfully');
        window.location.href="dswd-dashboard.php?Successful";
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
    $city = $_POST['city'];
    $sql = "INSERT INTO remittances (user, city, barangay, cluster, age, amount, comment) VALUES ('".$_SESSION['UserLogin']."', '$city', '$barangay', '$cluster', '$age', '$amount', '$comment')";
    
    if ($con->query($sql) === TRUE) {
      ?>
      <script>
        alert('Send Successfully!');
        window.location.href="dswd-dashboard.php";
      </script>
        <?php
    } else {
        echo '<script language="javascript">';
        echo 'alert("Unsuccessful!");';
        echo 'window.location="dswd-dashboard.php";';
        echo '</script>';
    }
 
  }

  // senior count
$query = "SELECT COUNT(*) AS count FROM seniors";
$result = $con->query($query);
while($row = mysqli_fetch_assoc($result)){
	$output = $row['count'];
}

$us = "SELECT COUNT(*) AS count FROM users";
$u = $con->query($us);
while($row = mysqli_fetch_assoc($u)){
	$use = $row['count'];
}

// rosters count
$q = "SELECT COUNT(*) AS count FROM rosters";
$r = $con->query($q);
while($row = mysqli_fetch_assoc($r)){
	$o = $row['count'];
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
          <h1>DSWD Dashboard</h1>
          <p></p>
       </div>
      <div class="row">

      <div class="col-md-6 col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
                <h1><i class="fa-sharp fa-solid fa-users fa-2xlg"></i></h1>
								</div>
								<div class="col-8">
									<h4>Seniors</h4>
									<h3> <?= $output ?> </h3>
								</div>
							</div>
						</div>
					</div>
				</div>

        <div class="col-md-6 col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
								<h1><i class="fa-sharp fa-solid fa-users fa-2xlg"></i></h1>
								</div>
								<div class="col-8">
									<h4>Rosters</h4>
									<h3><?= $o ?></h3>
								</div>
							</div>
						</div>
					</div>
				</div>

        <div class="col-md-6 col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
								<i class="bx bxs-user icon icon-home bg-success text-light"></i>
								</div>
								<div class="col-8">
									<h4>Accounts</h4>
									<h3><?= $use ?></h3>
								</div>
							</div>
						</div>
					</div>
				</div>

        <div class="col-md-6 mt-3">
					<div class="card bg-white">
          <div class="text-center mt-3">
              <h1><i class="bi bi-send-fill"></i></i></h1>
            </div>
						<div class="">
							<div class="mt-1">
              <h2 class="text-center">Create Remittance</h2>
              </div>
						</div>
						<div class="card-body pb-4">
							<div class="px-4">
								<button class='btn btn-block btn-lg btn-primary font-bold mt-3' data-bs-toggle="modal" data-bs-target="#create-remittance">Send Remittance</button>
							</div>
						</div>
					</div>
				</div>
        
        <div class="col-md-6 mt-3">
					<div class="card bg-white d-flex justify-content-center">
            <div class="text-center mt-3">
              <h1><i class="bi bi-megaphone-fill"></i></h1>
            </div>
						<div class="">
							<div class="mt-1">
              <h2 class="text-center">Announcements</h2>
              </div>
						</div>
						<div class="card-body pb-4">
							<div class="px-4">
								<button class='btn btn-block btn-lg btn-primary font-bold mt-3' data-bs-toggle="modal" data-bs-target="#create-announcement">Create new Announcement</button>
							</div>
						</div>
					</div>
				</div>
    </div>

    </div>

  </div> <!-- End Container -->
</div><!-- End Content -->

<!-- Modal Create Announcement -->
<div class="modal fade" id="create-announcement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Announcement </h1>
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
            <div class="col-md-6 mt-2">
              <label for="city" class="form-label">City</label>
              <select name="city" id="city" class="form-select" required>
                <option value="All"  >All Cities</option>
                <option value="Davao City" selected >Davao City</option>
              </select>
            </div>  
            <div class="col-md-6 mt-2">
              <label for="brgy" class="form-label">Barangay</label>
              <select name="brgy" id="brgy" class="form-select" required>
                <option value="All" selected >All Barangays</option>
                <option value="Toril">Toril Proper</option>
                <option value="Dalio">Dalio</option>
                <option value="Lizada">Lizada</option>
                <option value="Bato">Bato</option>
              </select>
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

<!-- create report modal -->
<div class="modal fade " id="create-remittance" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" >
      <div class="modal-content" style=" width: 700px;
      background: white;">
        <div class="modal-header text-center">
          <h4 class="modal-title" id="exampleModalLabel">Remittance</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="">
                  <div class="container px-3">
                    <div class="row mt-3">
                    <div class="col-md-12 mb-2">
                      <label for="city" class="form-label">City</label>
                          <select class="form-select" aria-label="Default select example" name="city" id="city" required>
                            <option value = "all" >All City</option>
                            <option value = "Davao City" >Davao City</option>
                          </select>
                      </div>
                      <div class="col-md-12">
                      <label for="barangay" class="form-label">Barangay</label>
                          <select class="form-select" aria-label="Default select example" name="barangay" id="barangay" required>
                            <option value = "all" >All Barangay</option>
                            <option value="Bato">Bato</option>
                            <option value="Toril">Toril Proper</option>
                            <option value="Dalio">Dalio</option>
                            <option value="Lizada">Lizada</option>
                          </select>
                      </div>
                      <div class="col-md-6 mt-3">
                      <label for="cluster" class="form-label">Cluster</label>
                      <select class="form-select" id="cluster" name="cluster" required>
                      <option value="all">All Cluster</option>
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
                        <label for="age" class="form-label">Age</label>
                            <select class="form-select" aria-label="Default select example" name="age" id="age" required>
                              <option value="all">All Ages</option>
                              <option value="60-70">60-70</option>
                              <option value="70-80">70-80</option>
                              <option value="80-90">80-90</option>
                              <option value="90-100">90-100</option>
                            </select>
                      </div>
                      <div class="col-md-auto mt-3">
                        <label for="ammount" class="form-label">Amount</label>
                        <input type="number" class="form-control" name="amount" id="amount" placeholder="kwarta" required>
                      </div>
                    <div class="mb-3 mt-3"> 
                      <label for="comment" class="form-label">Comment</label>
                      <textarea class="form-control" id="comment" name="comment" rows="5" required placeholder="Type Anything Here"></textarea>
                    </div>
                  </div>
                </div>
              </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger btn-lg text-white" data-bs-dismiss="modal">Discard</button>
                  <button class="btn btn-primary w-25 btn-lg text-white" type="submit" name="remittance">Send</button> 
                </div>
            </form>
      </div>
    </div>
  </div>















<?php
  include('footer.php');
?>