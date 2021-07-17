<?php
    include './includes/common.php';
    if(isset($_SESSION['email'])){
        header('location:home.php');
    }
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        include './includes/bootstrap.php';
    ?>
  <!-- external css -->
  <link rel="stylesheet" href="css/style.css" />
  <title>Ct&#8377l Budget</title>

</head>

<body>
  <?php
    include './includes/header.php';
  ?>
  <div id="banner_image">
    <div id="banner_content">
      <div class="heading_primary">We help you control your Budget</div>
      <a href="login.php" class="btn btn-solid-my btn-lg active">Start Today</a>
    </div>
  </div>
<?php
  include './includes/footer.php';
?>
</body>
</html>