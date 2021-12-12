<?php require ('db/config.php'); ?>
<?php require ('db/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>ShoppingCart.com-Index</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/style.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#myPage">ShoppingCart.com</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right" style="margin-right:80px;">
          <li><a href="#myPage">HOME</a></li>
          <li><a href="#shop">SHOP</a></li>
          <?php
              $result= mysqli_query($conn,"select *  from member where mem_id='$id_session'") or die (mysqli_error());
              while ($row= mysqli_fetch_array ($result) ){
              $id=$row['mem_id'];
          ?>
          <li><a href="" style="color: #ffffff;">Hi:<?php echo $row ['username']; ?></a></li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="background-color:#333;height: 50px;"><img src="profile/<?php echo $row ['profile'];?>" style="width:70px;height: 70px;margin-top: 0px;border-radius: 360px;margin-top: -30px;">
            <span class="caret" style="color: #ffffff;"></span></a>
            <ul class="dropdown-menu" style="background: #e3e3e3; border-radius: 5px;font-weight: bolder;">
              <li><a href="product/profile.php<?php echo '?mem_id='.$id; ?>">EditProfile</a></li>
              <li><a href="product/logout.php">LogOut</a></li>
            </ul>
          </li>
          <?php } ?>
      </ul>
    </div>
  </div>
</nav>
<br><br><br>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="slider.jpg" alt="New York" width="1200" height="700" style="min-height:577px;max-height:577px;">      
      </div>
    </div>
</div>
<div id="shop" class="container text-center">
    <h2 style="color:#000;">For Shop </h2>
    <p><em></em></p>
    <p></p>
    <br>
    <div class="row">
          <div class="col-sm-4" style="text-align:center;"></div>
          <?php 
          $result = mysqli_query($conn,"SELECT * FROM productmen");
          $num_rows = mysqli_num_rows($result);
          ?>                     
          <div class="col-sm-4" style="text-align:center;">
            <p class="text-center"><strong class="btn btn-success" style="border-radius:5px;background:#000;color:#ffffff;">Products <span style="background: red;border-radius: 5px; min-width: 100px;"><?php echo $num_rows; ?></span></strong></p><br>
            <a href="product/list.php">
              <img src="mensprofile.jpg" class="img-circle person" alt="Random Name" width="255" height="255" style="min-height:355px;min-width:200px;float:right;">
            </a>
          </div>
          <div class="col-sm-4" style="text-align:center;"></div>
    </div>
</div>
<!-- Footer -->
<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
      <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>
   © 2021 AllRight Reserved ShoppingCart.com
  </p> 
</footer>

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
  
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

    if (this.hash !== "") {

      event.preventDefault();

      var hash = this.hash;

      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        window.location.hash = hash;
      });
    } 
  });
})
</script>

</body>
</html>
