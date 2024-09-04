<?php
session_start();



if(isset($_SESSION['studentToken']) and $_SESSION['auth_login_unboxskills_student']  
  and $_SESSION['temp_course_id']){}else{  header('location:login');die(); }



$key="rzp_test_0dcG27OpJPoh8r";
$cid=$_SESSION['temp_course_id']; 

$courseExist=$this->admin->course_purchased_status($cid,$_SESSION['auth_login_unboxskills_student']);

if($courseExist){  
  unset($_SESSION['temp_course_id']);  header('location:student/my_course?response=already');die();  }
else{

$data=$this->admin->get_course_data_by_id($cid,'course_data','offer_price','instructor_id');

     if(!$_SESSION['coupon_course_price']){

      $offer_price=$data[0]['offer_price'];
      $_SESSION['temp_instructor_id']=$data[0]['instructor_id'];
      $price=(int)$offer_price;
      $amount=$price*100;

     }else{
  
        $_SESSION['temp_instructor_id']=$data[0]['instructor_id'];
        $price=(int)$_SESSION['coupon_course_price'];
        $amount=$price*100;
      }

      
  }

$_SESSION['temp_offer_price']=(int)$data[0]['offer_price'];

// var_dump($_SESSION); die();




?>
<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?= $title ?></title>
    <link rel="icon" href="image/logo.PNG" type="image/png" sizes="16x16">
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="css/student.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <style type="text/css">
    #cert{ transition: .5s; }
    #cert:hover{ transform: translateY(-10)!important; }
    .razorpay-payment-button{ padding:20px 30px;
    background:linear-gradient(90deg,#FB641B,#FB641B);margin-left: 10%;
    border-radius: 12px; border:none;letter-spacing: 1px;box-shadow:0px 20px 20px rgba(0,0,0,.3);
    border-radius: 0px;cursor: pointer;color: #fff; font-weight: bold; transition: .2s;}
    .razorpay-payment-button:active{ transform: scale(.90); box-shadow: 0px 10px 10px rgba(0,0,0,.1); }
    .btn2{padding:20px 30px;
    background:linear-gradient(90deg,#fff,#fff);
    border-radius: 12px; border:none;letter-spacing: 1px;box-shadow:0px 20px 20px rgba(0,0,0,.3);
    border-radius: 0px;cursor: pointer;color: #111; font-weight: bold; transition: .2s;}
    .btn2:active{ transform: scale(.90); box-shadow: 0px 10px 10px rgba(0,0,0,.1); }
    html{ overflow-x: hidden; }
    </style>
    <script type="text/javascript">
    
    function pay(){
    $('.razorpay-payment-button').trigger('click');
    }
    </script>
  </head>
  <body onload="pay();" style="overflow-x:hidden;">

    <?php include('popUp.php'); ?>

    <div class="container-fluid p-0" style="background:linear-gradient(90deg,#fff,#fff); height: 100vh;">
      <div class="row">
        <div class="col-12 col-lg-12 text-center">
          <?php if($amount) { ?>
          
          <div style="width: 100%; justify-content: center; display: flex;margin-top: 0%;">
            <div>
              <img src="<?=base_url('assets/lms/')?>img/Logo -unboxskills.png" width="200px" class="img-fluid">
            </div>
            <!--  <div class="col-lg-12 mt-lg-4 mt-2">
              <img src="image/other/payment.png" width="300px" class="img-fluid">
            </div>
            -->
          </div>
          <div style="width: 100%; justify-content: center; display: flex;margin-top: 10%;">
            
            <a href="<?=base_url('/')?>login"><button class="btn2">Back</button></a>
            
            <form action="<?=base_url('/')?>paymentControll" method="POST">
              <script
              src="https://checkout.razorpay.com/v1/checkout.js"
              data-key="<?= $key?>" // Enter the Test API Key ID generated from Dashboard → Settings → API Keys
              data-amount="<?= $amount ?>" // Amount is in currency subunits. Default currency is INR. Hence, 29935 refers to 29935 paise or INR 299.35.
              data-currency="INR"//You can accept international payments by changing the currency code. Contact our Support Team to enable International for your account
              data-buttontext="PAY NOW"
              data-name="Unbox Skills  "
              data-description="Unbox Skills Payment Portal"
              data-image="<?=base_url('assets/lms/')?>img/Logo -unboxskills.png"
              data-prefill.name="Your Name Here"
              data-prefill.email="Example@example.com"
              data-theme.color="#40419e"
              ></script>
              <input type="hidden" custom="Hidden Element" name="hidden">
              <input type="hidden"  name="price" value="<?= $amount?>">
              <input type="hidden"  name="payment_Mode" value="Online">
            </form>
            
          </div>
          
          <?php } ?>
        </div>
      </div>
    </div>
    
    </script>
  </body>
</html>