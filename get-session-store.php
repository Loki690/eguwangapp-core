<?php
include('header.php');

require_once('class.php');

$storeDetails = $store->getUserData();
?>

<main>
  <div class="container-fluid bg-white">
    <div class="row">
      <div class="col-md-12">
        <div class="px-4 pt-5 my-5 text-center border-bottom">
          <h1 class="display-4 fw-bold text-primary">Welcome <?= $storeDetails['storeName'] ?></h1>
          <div class="col-lg-6 mx-auto">
            <p class="lead mb-4"><?= $storeDetails['storeName'] ?> Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit velit fugit unde quas animi ex adipisci fugiat distinctio praesentium nulla. Natus repellat odit nemo itaque! Blanditiis nisi aperiam eos totam.</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
              <a href="store-myproducts.php?id=<?= $storeDetails['id']; ?>"><button type="button" class="btn btn-primary btn-lg px-4 me-sm-3 text-white">Go to Dashboard</button>
              </a>
              <a data-bs-toggle="modal" data-bs-target="#store_logout"><button type="button" class="btn btn-danger btn-lg px-4 me-sm-3 text-white">Logout</button>
              </a>
            </div>

          </div>
          <!-- <div class="overflow-hidden" style="max-height: 30vh;">
            <div class="container px-5">
              <img src="uploads/<?= $storeDetails['image'] ?>" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="1000" height="500" loading="lazy">
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Modal -->
<div class="modal fade" id="store_logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Logout</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4>
          Are you sure you want to Logout?
        </h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="store-logout.php" method="POST">
          <button type="submit" class="btn btn-danger text-white">Logout</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
include('footer.php');
?>