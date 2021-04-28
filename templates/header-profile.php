<?php include('header.php');
  include 'config.php';

  error_reporting(0);

  session_start();
?>
<div class="jumbotron">
      <div class="bg-dark">
          <div class = "row">
              <div class="col-12 col-sm-6 text-white">
                  <?php echo '<h3>Hello '.$_SESSION['user'].'</h3>' ?>
                  <h6>Here to listen to music ? LOL best of luck with that as this website doesn't play shit</h6>
              </div>
              <div class="col-12 col-sm">
              </div>
          </div>
      </div>
  </div>
