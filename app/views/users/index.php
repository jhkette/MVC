<?php require APPROOT . '/views/inc/header.php'; ?>
 <?php flash('post_message'); ?>
  <div class="row mb-3">
    <div class="col-md-6">
      <h1>Users</h1>
    </div>
    
  </div>
  <?php foreach($data['users'] as $user) : ?>
    <div class="card card-body mb-3">
      <h4 class="card-title"><?php echo $user->name; ?></h4>
      <p>User since:<?php echo $user->created_at; ?></p>
      <a href="<?php echo URLROOT; ?>/users/show/<?php echo $user->id; ?>" class="btn btn-dark">More</a>
    </div>
  <?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>