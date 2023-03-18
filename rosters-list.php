<?php
include('session.php');
include('config.php');

if(isset($_SESSION['Role']) && $_SESSION['Role'] == "dswd"){
  $user = $_SESSION['UserLogin'];
}elseif(isset($_SESSION['Role']) && $_SESSION['Role'] == "leader"){
  $user = $_SESSION['UserLogin'];
}elseif(isset($_SESSION['Role']) && $_SESSION['Role'] == "barangay"){
  $user = $_SESSION['UserLogin'];
}else{
  echo '<script language="javascript">';
  echo 'alert("Access Denied!");';
  echo 'window.location="index.php";';
  echo '</script>';
}
  $sql = "SELECT * FROM rosters ORDER BY id DESC";
  $roster = $con->query($sql) or die ($con->error);
  // $row = $roster->fetch_assoc();


  // $sql_senior_view = "SELECT * FROM seniors WHERE seniorcitizen_id = '".$row['seniorcitizen_id']."' ";
  // $senior_view = $con->query($sql_senior_view) or die ($con->error);
  // $row_senior = $senior_view->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OSCA DASHBOARD</title>

  	<!-- Bootstrap CSS-->
	<link rel="stylesheet" href="assets/modules/bootstrap-5.1.3/css/bootstrap.css">
	<!-- Style CSS -->
	<link rel="stylesheet" href="assets/css/style.css">
	<!-- FontAwesome CSS-->
	<link rel="stylesheet" href="assets/modules/fontawesome6.1.1/css/all.css">
	<!-- Boxicons CSS-->
	<link rel="stylesheet" href="assets/modules/boxicons/css/boxicons.min.css">
	<!-- Apexcharts  CSS -->
	<link rel="stylesheet" href="assets/modules/apexcharts/apexcharts.css">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css"/>
  
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.js"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  
  
</head>
<body>

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
              <a href="osca-senior-list.php" >
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

          
            <?php }?>
          <?php } ?>
            </ul>
        </div>

       </div> 
	 </div>
	</div><!-- End Sidebar--> 


  <div class="sidebar-overlay"></div>

    <div class="content-start transition">
      <div class="container-fluid dashboard">
        <div class="content-header hstack g-3 mb-3">
        <div>
          <h1><i class="fa-sharp fa-solid fa-users fa-2xlg"></i></h1>
				</div>
        <div class="px-4">
        <h1>Roster List</h1>
        </div>
       </div>
      <div class="row">
        
        <div class="col-md-12 col-lg-12 mb-5">
          <div class="card bg-white pb-5">
          <div class="table-responsive px-4 mt-4 pt-2">

          <table class="table table-border table-striped table-hover">
            <thead>
              <tr>
              <th scope="col">Senior Citizen ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Middle Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Birth Date</th>
                <th scope="col">Gender</th>
                <th scope="col">Cluster</th>
                <th scope="col">Remittance Mode</th>
                <th scope="col">View</th>
                
                <?php if(isset($_SESSION['UserLogin'])){?>
                  <?php if($_SESSION['Role'] == "dswd"){ ?>
                    <th scope="col">Status</th>

                <?php }elseif ($_SESSION['Role'] == "leader"){?>

                  <th scope="col">Delete</th>
                  <?php } ?>
                <?php } ?>
               
               
              </tr>
            </thead>
            <tbody >
             <?php while($row = $roster->fetch_assoc()){?>
              
              <tr class="">
              <td scope="row"><?=  $row['seniorcitizen_id']; ?></td>
              <td scope="row"><?=  $row['first_name']; ?></td>
              <td scope="row"><?=  $row['middle_name']; ?></td>
              <td scope="row"><?=  $row['last_name']; ?></td>
              <td scope="row"><?=  $row['birth_date']; ?></td>
              <td scope="row"><?=  $row['gender']; ?></td>
              <td scope="row"><?=  $row['cluster']; ?></td>

              <?php 
                $sql_senior = "SELECT * FROM `seniors` WHERE `id` = '".$row['seniors_id']."'";
                $senior = $con->query($sql_senior) or die ($con->error);
                $senior_row = $senior->fetch_assoc();
              ?>
              
              <?php do{ ?>
                <td scope="row"><?= $senior_row['remittance_mode']; ?></td>
                <td scoppe="row"><a href="senior-details.php?ID=<?php echo $senior_row['id'];?>"class="nav-link text-primary">View</td>
               
                <?php }while($senior_row = $senior->fetch_assoc()) ?>
              
                <?php if(isset($_SESSION['UserLogin'])){?>

                  <?php if($_SESSION['Role'] == "dswd"){ ?>

                    <?php
                      $sql_user = "SELECT `status` FROM `users` WHERE `seniorcitizen_id` = '".$row['seniorcitizen_id']."'";
                      $users = $con->query($sql_user) or die ($con->error);
                      $user_row = $users->fetch_assoc();
                      ?>
                      
                 <?php if(isset($user_row['status']) =="registered"){ ?>
                  
                      <td scope="row"> <a href="" class="nav-link text-danger">Registered</a></td>
                  <?php }else{ ?>
                    <td scope="row"> <a href="register-account-senior.php?ID=<?php echo $row['id']; ?>" class="nav-link text-success">Register</a></td>
                    <?php } ?>

                <?php }elseif ($_SESSION['Role'] == "leader"){?>

                  <td scope="row"> <a href="delete-roster.php?ID=<?php echo $row['id']; ?>" class="nav-link text-danger" >Delete</a></td>

                  <?php } ?>

                <?php } ?>
               
               
              </tr>
              <?php }?> 
             
           
            </tbody>

          </table>

         
        </div>

        </div>
        </div>
     
    </div>

  </div> <!-- End Container -->
</div><!-- End Content -->


</body>
<script type="text/javascript">
    $(document).ready(function(){
      $('table').DataTable();
    });
  </script>
</html>