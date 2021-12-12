<?php require ('../db/session.php'); ?>

<?php
require_once("db/dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
  case "add":
    if(!empty($_POST["quantity"])) {
      $productByCode = $db_handle->runQuery("SELECT * FROM product WHERE code='" . $_GET["code"] . "'");
      $itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'img_path'=>'product/'.$_POST["img_path"]));
      
      if(!empty($_SESSION["cart_item"])) {
        if(in_array($productByCode[0]["code"],$_SESSION["cart_item"])) {
          foreach($_SESSION["cart_item"] as $k => $v) {
              if($productByCode[0]["code"] == $k)
                $_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
          }
        } else {
          $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
        }
      } else {
        $_SESSION["cart_item"] = $itemArray;
      }
    }
  break;
}
}
?>
<!DOCTYPE html>

<html>
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>ShoppingCArt.Com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">

  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="list.css">
  <script src="../bootstrap/js/jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="raty/jquery.raty.js" type="text/javascript"></script>

 </head>
 <?php
$session_items = 0;
if(!empty($_SESSION["cart_item"])){
  $session_items = count($_SESSION["cart_item"]);
} 
?>
 <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" id="font" href="../index2.php" >ShoppingCart.com</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right" style="margin-right:80px;">
        <li>
          <style type="text/css">
            #keyword{border: #CCC 1px solid; border-radius: 4px; padding: 7px;background:url("demo-search-icon.png") no-repeat center right 7px;}
          </style>
        <form name="frmSearch" action="" method="post">
         <li style='text-align:right;margin:20px 0px;'><input type='text' name='search[keyword]' value="" id='keyword' maxlength='25'></li>
       </form>
     </li>
        <li class="font"><a href="../index2.php">HOME</a></li>
        <?php require ('../db/config.php'); ?>
  <?php
              $result= mysqli_query($conn,"select *  from member where mem_id='$id_session'") or die (mysqli_error());
              while ($row= mysqli_fetch_array ($result) ){
              $id=$row['mem_id'];
              ?>
      <li><a href="" style="color: #ffffff;">Hi:<?php echo $row ['username']; ?></a></li>
      <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="background-color:#333;height: 50px;"><img src="../profile/<?php echo $row ['profile'];?>" style="width:70px;height: 70px;margin-top: 0px;border-radius: 360px;margin-top: -30px;">
          <span class="caret" style="color: #ffffff;"></span></a>
          <ul class="dropdown-menu" style="background: #e3e3e3; border-radius: 5px;font-weight: bolder;">
            <li><a href="logout.php">LogOut</a></li>
          </ul>
        </li>
        <li class="font"><a href=""class="glyphicon glyphicon-shopping-cart"></a></li>
        <li class="font"><a href="shopping_cart.php" style="background:red;border-radius:360px;margin-top:15px;margin-right:10px;"><?php echo $session_items; ?></a></li>
        
      </ul>
    </div>
  </div>
</nav>
<br><br><br>
  <div class="txt-heading" style="text-align:left;color:#d5d5d5;"><a href="../index2.php" style="text-decoration:none;color:#33B6CB;margin-left:120px;">Home/</a> Products/ <a href="mens.php" style="color:#33B6CB;text-decoration: none;">Men's</a></div>

 <div class="container-fluid" style="width:90%;">
  <div class="row">
    <div class="col-sm-2" style="background-color:#e3e3e3;color:#428bca;">
            <?php }?>
    </div>
    <div class="col-sm-9" style="background-color:#e3e3e3;margin-left: 10px;">
      <div id="product-grid">
  <?php
  $product_array = $db_handle->runQuery("SELECT * FROM product ORDER BY id ASC");
  if (!empty($product_array)) { 
    foreach($product_array as $key=>$value){
  ?>
    <div class="product-item" style="background:#fff;">
      <form method="post" action="list.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
        <input type="hidden" name="img_path" value="mensproduct/<?php echo $product_array[$key]["image"]; ?>">
      <div class="product-image"><img style="max-height: 250px;max-width: 250px;" src="mensproduct/<?php echo $product_array[$key]["image"]; ?>"></div>
      <div><strong>TYPE:<?php echo $product_array[$key]["name"]; ?></strong></div>

      <div class="product-price"><?php echo $product_array[$key]["price"]. "$"; ?></div>
      <div><input class="form-control" style="float:left;max-width:25%;border-radius:360px;" type="text" name="quantity" value="1" size="2" />
   
    </script>
      <input type="submit" value="Add to cart" class="btn btn-primary" style="float:right;width:70%;border-radius:360px;" /></div>
      </form>
      //
      <div class="row">
<div class="col-sm-12">
<form id="ratingForm" method="POST">
<div class="form-group">
<h4>Rate this product</h4>
<button type="button" class="btn btn-warning btn-sm rateButton" aria-label="Left Align">
<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
</button>
<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
</button>
<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
</button>
<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
</button>
<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
</button>
<input type="hidden" class="form-control" id="rating" name="rating" value="1">
<input type="hidden" class="form-control" id="itemId" name="itemId" value="12345678">
</div>
<div class="form-group">
<label for="usr">Title*</label>
<input type="text" class="form-control" id="title" name="title" required>
</div>
<div class="form-group">
<label for="comment">Comment*</label>
<textarea class="form-control" rows="5" id="comment" name="comment" required></textarea>
</div>
<div class="form-group">
<button type="submit" class="btn btn-info" id="saveReview">Save Review</button> <button type="button" class="btn btn-info" id="cancelReview">Cancel</button>
</div>
</form>
</div>
</div>
      //
    </div>
  <?php
      }
  }
  ?>
    </div>
  </div>
</div>
</div>
 
      
  
<!-- footer -->
  <footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>© 2010 AllRight Reserved ShoppingCart.com</p> 
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