<?php session_start(); ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Let's make tea for Sawdays">

        <!-- CDNs -->
        
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <!-- Scripts -->
        <script src="assets/js/clock.js"></script>
        <script src="assets/js/new-person.js"></script>
        <script src="assets/js/open-modal.js"></script>

        <!-- Stylesheets -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link href="assets/stylesheets/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
 
    </head>

    <body onload="startTime()">

      <?php include('read-file.php');  ?>

      <div class="float-right info-bar">

          <br>
          <a href="#" data-toggle="modal" data-target="#teaListModal">
              <i class="fas fa-mug-hot"></i> <?php echo $count . " teamaker" . $plural ?>
          </a>
          <hr />
      </div>

      <div class="container">
          <div class="header">
              <div class="central">
                  <div id="txt"></div>
                  <h1>It's tea time!</h1>
                  <img src="assets/images/logo.png" alt="sawdays logo" style="width: 50%;">
              </div>
          </div>
      </div>

      <div class="tear central">
        <br><br><p></p>
      </div>

      <div class="grey">

        <div class="central empty-list">
          <br><br>
          <p>Add new teamakers by using the form below:</p>
        </div>
          
          <div class="central add-to-list">
            <form action="/add-to-list.php" method="post">
                <div class="form-group mx-sm-3 mb-2">
                    <label for="name" class="sr-only">Password</label>
                    <input type='text' name='name' id='name' placeholder='Type a name here!'>
                    <button type='submit' class='btn btn-secondary'>Add a teamaker! <i class="fas fa-utensil-spoon"></i></button>
                </div>
            </form>

            <?php

              // Show validation alerts and remove from session

              if(isset($_SESSION['error'])) {
                  echo "<br><div class='container'><div class='alert alert-danger'>";
                  echo "<p>" . $_SESSION['error'] . "</p></div></div>";

                  unset($_SESSION['error']);
              } elseif(isset($_SESSION['success'])) {
                  echo "<br><div class='container'><div class='alert alert-success'>";
                  echo "<p>" . $_SESSION['success'] . "</p></div></div>";

                  unset($_SESSION['success']);    
              }

              if($count <= 1) {
                  echo "<p>You don't have enough people to do a tea round yet! Make it yourself!!</p>";
              } else {
                  echo "<button type='submit' class='btn sawdays-purple' data-toggle='modal' data-target='#pickRandom'>Who's turn is it next???</button>";
              }

            ?>

          </div>

         </div>

<!-- Modal : list of teamakers -->
<div class="modal fade" id="teaListModal" tabindex="-1" role="dialog" aria-labelledby="teaListModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="teaListModalLabel"><i class="fas fa-mug-hot"></i> teamakers</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        if(isset($names)){
            foreach($names as $name) {
                echo "<p><i class='fas fa-utensil-spoon'></i> $name</p>";
            }
            echo "<a href='/clear-list.php'>Reset the list</a>";
        } else {
            echo "<p>Nobody is ready to step up to the task as teamaker... are you???</p>";
        }
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal : next round -->
<div class="modal fade" id="pickRandom" tabindex="-1" role="dialog" aria-labelledby="pickRandomLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pickRandomLabel">The next tea round shall be made by...</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body central">
        <?php
            echo "<h1>$whoIsMakingTea</h1>";
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn sawdays-purple" id="refreshPerson"  onClick="newPerson()">Refresh the page & pick somebody else!</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




</body>

</html>