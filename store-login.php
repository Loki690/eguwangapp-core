<?php
  include('header.php');
  require_once('class.php');

  $store->storeLogin();
  
?>

<main>
  <div class="container">
    <div class="row d-flex justify-content-center">

      <div class="col-md-6 mt-5">
        <form action="" method="POST">
          <div class="text-center">
            <img class="mb-4 align-center" src="img/logo.png" alt="" width="100" height="100">
            <h1 class="h3 mb-3 fw-normal">Store Login</h1>
          </div>
          <div class="ps-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control form-control-lg" name="username" id="username" placeholder="username" required>
          </div>
          <div class="mt-4 ps-3">
            <label for="password" class="form-label" >Password</label>
            <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="password" required>
          </div>
          <button class="w-100 btn btn-lg btn-primary mt-4" type="submit" name="login-store">Login</button>
          <p class="mt-5 mb-3 text-muted text-center">&copy; 2022-eguwangapp</p>
        </form>
      </div>
    </div>
  </div>
</main>




<?php
 include('footer.php');
?>