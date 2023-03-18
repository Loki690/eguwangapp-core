<?php
include('header.php');
include('session.php');
include('config.php');

if(isset($_SESSION['Role']) && $_SESSION['Role'] == "leader"){
  $user = $_SESSION['UserLogin'];
  $session_id = $_SESSION['ID'];
}else{
  echo '<script language="javascript">';
  echo 'alert("Access Denied!");';
  echo 'window.location="logout.php";';
  echo '</script>';
}

// senior count
$query = "SELECT COUNT(*) AS count FROM seniors";
$result = $con->query($query);
while($row = mysqli_fetch_assoc($result)){
	$output = $row['count'];
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
                  <a href="leader-dashboard.php" class="active">
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
									<i class="bx bxs-user icon icon-home bg-primary text-light"></i>
								</div>
								<div class="col-8">
									<h4>Seniors</h4>
									<h3> <?= $output ?> </h3>
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
								<i class="bx bxs-user icon icon-home bg-success text-light"></i>
								</div>
								<div class="col-8">
									<h4>Rosters</h4>
									<h3><?= $o ?></h3>
								</div>
							</div>
						</div>
					</div>
				</div>
    </div>

  </div> <!-- End Container -->
</div><!-- End Content -->






<?php
include('footer.php');
?>