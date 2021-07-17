<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" data-toggle="collapse" class="navbar-toggle" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="index.php" class="navbar-brand">Ct&#8377l Budget</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="about_us.php">
              <div class="glyphicon glyphicon-info-sign"></div>
              About us
            </a>
          </li>
          <?php
            if(isset($_SESSION['email'])){
                ?>
          <li>
            <a href="change_password.php">
              <div class="glyphicon glyphicon-cog"></div>
              Change Password
            </a>
          </li>
          <li>
            <a href="logout_script.php">
              <div class="glyphicon glyphicon-log-in"></div>
              Logout
            </a>
          </li>
          <?php
            }else{
            ?>
          <li>
            <a href="signup.php">
              <div class="glyphicon glyphicon-user"></div>
              Sign up
            </a>
          </li>
          <li>
            <a href="login.php">
              <div class="glyphicon glyphicon-log-in"></div>
              Login
            </a>
          </li>
          <?php
            }
            ?>
        </ul>
      </div>
    </div>
  </div>