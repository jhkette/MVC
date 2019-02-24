<?php require APPROOT . '/views/inc/header.php'; ?>

  <div class="row mb-3">
    <div class="col-md-6">
      <h1>Users</h1>
    </div>
    
  </div>
  
    <div class="card card-body mb-3">
      <h4 class="card-title"><?php echo $data['user']->name; ?></h4>
      <p>User since:<?php echo $data['user']->created_at; ?></p>
      <a href="<?php echo URLROOT; ?>/users/show/<?php echo $data['user']->id; ?>" class="btn btn-dark">More</a>
    </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
