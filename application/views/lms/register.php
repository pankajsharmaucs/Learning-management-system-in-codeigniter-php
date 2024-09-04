<?php
// if(isset( $_SESSION['auth_unboxskills_student'] ) ){ 

//       // if($_SESSION['logType']=='signIn')
//       // {
//       //   header('location:'.base_url('/').'User_Dashboard?a=3');die;
//       // }
//       // if($_SESSION['logType']=='signUp')
//       // {
//       //   header('location:'.base_url('/').'User_Dashboard?a=1');die;
//       // }
   
//       echo "not Logged in";

// }else{

//       echo "not Logged in";

// }

?>


 <!-- ========login1=========== -->
<section class="login_section py-md-1 bgi_2">
<div class="container px-lg-5 p-0">
  <div class="row bs_1 frmBox1 animate__animated py-3">
    <div class="col-md-6 bg_9 login_contentColor rounded-left">
     <div class="login_left_content align-items-start pt-md-5 pt-2 d-flex h-100 justify-content-center">
       <div>
        <div class="text-center"><img src="<?=base_url('assets/lms/')?>img/Logo -unboxskills.png" alt="Logo unboxskills" width="100px"></div>
        <h1 class="text-white fw_400 f_32 rt_16 text-center py-2">Sign up as a <span id="loginTitle">Student</span></h1>
        <h2 class="text-white fw_300 f_16 rt_14 text-center">A world class education for anyone, anywhere. 100% free.</h2>
        <h3 class="text-white fw_300 f_16 rt_14 text-center lh_1">Join UnboxSkills to get personalized help with what you’re studying or to learn something completely new. We’ll save all of your progress.</h3>
       </div>
     </div>
    </div>

    <div class="col-md-6 bg-white px-lg-5 px-2 rounded-right">
      <div class="register d-flex justify-content-center">
   <form class="mainFrmBox">


        <input type="hidden" id="userType" value="student" >
        <input type="hidden" id="focusPoint" value="create" >

      <div class="changetype d-flex justify-content-center align-items-stretch  pb-2">
        <div class="student py-1 w-md-25 changetypeshow border rounded px-3 text-center cp" onclick="registertype('student')" id="btnstudent">Student</div>
        <div class="teacher pt-1 w-md-25  text-center border rounded px-3 cp" onclick="registertype('teacher')" id="btnteacher">Teacher</div>
      </div>
      
      <p class="subtitle rt_13 mt-2 f_14 text-secondary">Already have an account? <a href="<?=base_url(); ?>login"> Sign In</a></p>
      <p class="or text-secondary"><span>or</span></p>
      <!-- ===========student section================ -->
     <div class="signupSection" id="collapse1"> 
      <div class="email-register">
        <div class="form-row">
        <div class="form-group col-md-6 mb-0">
           <label for="name" class="mb-0 rt_14"> <b>Name</b></label>
          <input type="text" placeholder="Enter Name" id="SignName" class="w-100" required>
        </div>
        <div class="form-group col-md-6 mb-0">
           <label for="email" class="mb-0 rt_14"><b>Email</b></label>
          <input type="text" placeholder="Enter Email" id="SignEmail" class="w-100" required>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6 mb-0">
           <label for="mobile" class="mb-0 rt_14"> <b>Mobile No.</b></label>
          <input type="text" placeholder="Enter Mobile No" id="SignMobile" class="w-100" required>
        </div>
        <div class="form-group col-md-6 mb-0">
           <label for="psw" class="mb-0 rt_14"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" id="SignPassword" class="w-100" required>
        </div>
      </div>
    </div>

      
      <input type="hidden" id="studentToken" value="<?php echo $_SESSION['studentToken'] ?? '' ?>">
      <div class="button46 w-100 d-block border-0 mt-3 text-center regBtn1" onclick="getOtp()">Get OTP</div>
      
      <!-- <a class="forget-pass rt_14" href="#">Forgot password?</a> -->
    </div>


    <div class="col-md-12  text-center p-3">
          <h5 class="signErrorMsg animate__animated mt-lg-3 mt-1"></h5>
      </div>
   </form>



<!-- ==============OTP section============== -->

     <form class="otpFrmBox">
     
      <h2 class="subtitle rt_14 mt-2 f_24 text-primary">Enter Your OTP, Check Your Email Address.</h2>
   
    <div class="signupSection" > 
      <div class="email-register">
        <div class="form-row">
        
        <div class="form-group col-md-12 mb-0">
          <input type="text" placeholder="OTP here... " id="userOtp" class="w-100" >
        </div>

       <input type="hidden" id="otpToken" value="<?php echo $_SESSION['otpToken'] ?? '' ?>">


      </div>
    </div>
      
      <div class="button46 w-100 d-block border-0 mt-3  text-center" onclick="createAccount()"> Submit</div>
      <button class="button47 w-100 d-block border-0 mt-3">Resend OTP</button>
      <!-- <a class="forget-pass rt_14" href="#">Forgot password?</a> -->
    </div>

    <div class="col-md-12  text-center p-3">
          <h5 class="signErrorMsg animate__animated mt-lg-3 mt-1"></h5>
      </div>
   </form>



</div>
    </div>
  </div>
</div>
</section>