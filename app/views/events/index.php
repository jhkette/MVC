<?php require APPROOT . '/views/inc/header.php'; ?>
 <?php flash('post_message'); ?>
  <div class="row mb-3">
    <div class="col-md-6">
      <h1>Posts</h1>
    </div>
    <div class="col-md-6">
      <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
        <i class="fa fa-pencil"></i> Add Post
      </a>
    </div>
  </div>
  <?php foreach($data['events'] as $event) : ?>
    <div class="card card-body mb-3">
      <h4 class="card-title"><?php echo $event->title; ?></h4>
     
      <p class="card-text"><?php echo $event->body; ?></p>
      <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $event->eventId; ?>" class="btn btn-dark">More</a>
    </div>
  <?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>
