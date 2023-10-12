<div class="container fill py-5">
  <main>
      <div class="p-4 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
          <h1 class="display-5 fw-bold"><?php echo isset($_SESSION["name"])?"Welcome ".$_SESSION["name"]."!":"Hello stranger" ?></h1>
          <p class="col-12"><?php echo isset($_SESSION["name"])?"You are logged in as ".$data["username"].".":"In order to enjoy the full functionality please sign into your account or create a new one..."?></p>
          <?php
          if(!isset($_SESSION["name"])) echo "<a href='index.php?".(isset($_SESSION["name"])?"page=auth&method=logout":"page=auth")."' class='btn btn-primary btn-lg'>Sign In or Register!</a>";
          ?>
        </div>
      </div>
      <div class="row align-items-md-stretch">
        <div class="col-md-12">
          <?php if(isset($_SESSION["loggedin"])) echo $data["events"] ?>
        </div>
        <div class="col-12">
          <?php if(isset($_SESSION["loggedin"])) echo $data["sessions"] ?>
        </div>
        <div class="col-12">
          <?php if(isset($_SESSION["loggedin"])) echo $data["manager"] ?>
        </div>
      </div>
  </main>
</div>