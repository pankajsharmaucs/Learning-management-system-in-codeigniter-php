

	<main>
        <section class="login">
            <div class="container">
                <div class="row">
                    <div class="box col-md-7 col-sm-12 mx-auto">
                        <h1>Forgot Password</h1>
            <div class="success" style="display: none;">
        <div class="alert alert-dismissible alert-success">
            <strong>Well done! Password Updated Successfully !
            </strong>
        </div>
      </div>
                            <form class="row mt-5" action="" id="registerForm">
                                <div class="col-md-7 mx-auto">
                                    <label > Email <span style="color:red">*</span><span style="color:red" id="email_err"></span></label>
                                    <input type="email" name="email"  placeholder="Type Email" class="form-control" id="email">
                                </div>

                                <div class="col-md-7 mx-auto">
                                    <label>New Password <span style="color:red">*</span><span style="color:red" id="pass_err"></span></label>
                                    <input type="password" name="password" id="password" placeholder="Type New Password..." class="form-control ">
                                </div>
																<div class="col-md-7 mx-auto">
                                     <label>Confirm Password <span style="color:red">*</span><span style="color:red" id="cpass_err"></span></label>

                                     <input type="password" id="cpass"  placeholder="Type Confirm Password" class="form-control" name="cpass">

                                     <div id="matchPass1"></div>
                                 </div>
                                <div class="col-md-7 mx-auto">
                                    <button  type="button" class="form-control auth-pri" onclick="return new_password();">New Password <span id="loginLoader"></span> </button>
                                </div>

                            </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script type="text/javascript">
        function new_password()
  {
     var password=$("#password").val().trim();
		  var cpass=$("#cpass").val().trim();
     var email=$("#email").val().trim();
var pattern_email = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
			if(email=="")
			{
					$("#email_err").fadeIn().html("Please enter Email").css('color','red');
					setTimeout(function(){$("#email_err").html("&nbsp;");},3000);
					$("#email").focus();
					return false;
			}
			else if(!pattern_email.test(email))
				 {
					 $("#email_err").fadeIn().html("Please enter valid email");
					 setTimeout(function(){$("#email_err").html("&nbsp;");},5000)
					 $("#email").focus();
					 return false;
				 }
      if(password=="")
      {
          $("#pass_err").fadeIn().html("Please enter password").css('color','red');
          setTimeout(function(){$("#pass_err").html("&nbsp;");},3000);
          $("#password").focus();
          return false;
      }
			if(cpass=="")
      {
          $("#cpass_err").fadeIn().html("Please enter Confirm password").css('color','red');
          setTimeout(function(){$("#cpass_err").html("&nbsp;");},3000);
          $("#cpass").focus();
          return false;
      }
        if(password!=cpass){
        $('#matchPass1').html('Password Not match').css('color','red');
        return null
      }
      $.ajax({
        type:'post',
        cache:false,
        url:'<?php echo base_url('home/forgot_pass')?>',
        data:{
          email:email,
          password:password,
        },
        success:function(result)
        {
					console.log(result)
            if(result==1)
            {
               // $(".input_email").hide();
                $(".success").show();
              //  $(".failed").hide();
              window.location.href='<?php echo base_url('login')?>'
            }
            else
            {
                //$(".input_email").hide();
                $(".success").hide();
                $("#email_err").html("Email Id does not exit!");

            }
         //location.reload();
        }

      });
  }


    </script>
