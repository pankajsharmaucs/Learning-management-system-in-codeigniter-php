

<section id="footer" class="bg_9 mt-0">
    <div class="container ">
    
      <div class="row pb-4 pt-xl-4 pt-4 ">
        <div class=" col-md-12 col-lg-9 col-xl-9 col-12 p-0">

        	<div class="row ml-xl-0 ml-lg-0 ml-md-0 ml-3">

        <div class="col-12 col-md-4 col-lg-4 col-xl-4 mb-3">
        <div class="mb-xl-2 m-2"><img src="<?=base_url('assets/')?>home_e/images/logo.png" alt="" height="50px" width="180px" style="filter:brightness(0) invert(1);"></div>
          <h4 class="rt_15 f_14 fw_300 tc_5">Established in 1991, Unified Credit Solutions (UCS), is a leading B2B credit management group specializing in Business Information Services, Receivables Management, Debt Collection, Para Legal Services & Claim Settlement Services.</h4>
          <!-- <ul class="list-unstyled quick-links mt-2">
            <li class=""><a href="" class="rt_12">Control</a></li>
            <li class=""><a href="" class="rt_12">Stablish & Efficancy</a></li>
            <li class=""><a href="" class="rt_12">Supporting By Expert</a></li>
            <li class=""><a href="" class="rt_12">Control</a></li>
          
          </ul> -->
        </div>

        <div class="col-6 col-md-4 col-lg-4 col-xl-4">
          <h5 class="rt_15">Quick Links</h5>
          <ul class="list-unstyled quick-links mt-2">
            <li class=""><a href="<?= $siteUrl ?>/Privacy" class="rt_12">Privacy Policy</a></li>
            <li class=""><a href="<?= $siteUrl ?>/Support" class="rt_12">Support</a></li>

            <!-- <li class=""><a href="" class="rt_12">Supporting By Expert</a></li> -->
            <!-- <li class=""><a href="" class="rt_12">Control</a></li> -->
          
          </ul>
          
        </div>
        <div class="col-6 col-md-4 col-lg-4 col-xl-4">
         <h5 class="rt_15">My Account</h5>
          <ul class="list-unstyled quick-links mt-2">
          
          
          <?php if(@$_SESSION['auth_user']){ ?>

            <li class=""><a href="<?=base_url('/')?>User_Dashboard?a=1" class="rt_12">Dashboard</a></li>
            <li class=""><a href="<?=base_url('/')?>User_Dashboard?a=2" class="rt_12">Company List</a></li>
            <li class=""><a href="<?=base_url('/')?>User_Dashboard?a=3" class="rt_12">My Cart</a></li>
            <li class=""><a href="<?=base_url('/')?>User_Dashboard?a=5" class="rt_12">Wallet</a></li>
            
              
            
          <?php }else { ?>

            <li class=""><a href="<?=base_url('/')?>Register" class="rt_12">Dashboard</a></li>
            <li class=""><a href="<?=base_url('/')?>Register" class="rt_12">Company List</a></li>
            <li class=""><a href="<?=base_url('/')?>Register" class="rt_12">My Cart</a></li>
            <li class=""><a href="<?=base_url('/')?>Register" class="rt_12">Wallet</a></li>
            
          <?php }?>
            
           
              
          
          </ul>
        </div>
        <!-- <div class="col-6 col-md-6 col-lg-3 col-xl-3">
          <h5 class="rt_15">Solution</h5>
          <ul class="list-unstyled quick-links mt-2">
            <li class=""><a href="" class="rt_12">Control</a></li>
            <li class=""><a href="" class="rt_12">Control</a></li>
            <li class=""><a href="" class="rt_12">Control</a></li>
            <li class=""><a href="" class="rt_12">Control</a></li>
          
          </ul>
        </div> -->
        
      </div>
  </div>
  
    <div class="col-xl-3 col-lg-3 col-md-6 col-12 ">
    	<div class="right_section bg_10">
    		<div class="d-flex justify-content-center  py-3 px-5 ">
          <ul class="list-unstyled quick-links mt-2">
            <li class=""><a href="tel:1-562-867-5309">1800-256-2564</a></li>
            <li class="mb-3 "><a href="mailto:support@kreditaid.com" class="tc_2 email">support@kreditaid.com</a></li>
            <li class="">India</li>
            
          
          </ul>
      </div>
        </div>

        <div class="newsletter mt-3 text-center">
		 <form class="d-flex justify-content-center">
			<input type="text" name="" class="f_13" placeholder="Enter Your Email">
			<button class="px-3 f_14">Subscribe</button>
		 </form>
	    </div>

      
        <div class="f_social_media mt-3 text-center" >
        	
        	<a href=""><i class="fab fa-facebook-square"></i></a>
        	<a href=""><i class="fab fa-linkedin"></i></a>
        	<a href=""><i class="fab fa-twitter"></i></a>
        	<a href=""><i class="fab fa-instagram"></i></a>
        	<a href=""><i class="fab fa-google"></i></a>
        </div>
    </div>
  </div>
  

<div class="privacypolicy d-flex justify-content-xl-between justify-content-lg-between justify-content-md-between justify-content-center align-items-center flex-wrap pb-2">
	<div class=" f_13">2021 UCS All Rights Reserved</div>
	
	<div class="">
		<a href="" class="f_13 mr-4">Privacy  Policy</a>
		<a href="" class="f_13 ">Terms of Use</a>
	</div>
	
</div>

</div>
</section>

<!-- To Show Cart Item -->
<script src="<?=base_url('assets/')?>home_e/js/showLocaleCart.js"></script>
<!-- To Show Cart Item -->

<!-- -----------link js---------- -->

<script src="<?=base_url('assets/')?>home_e/js/counter.js"></script>
<script src="<?=base_url('assets/')?>home_e/js/customjquery_b.js"></script>

<script src="<?=base_url('assets/')?>home_e/js/main_b.js"></script>
<script src="<?=base_url('assets/')?>home_e/js/wow.min.js"></script>
<script src="<?=base_url('assets/')?>home_e/js/home_search.js"></script>
<script src="<?=base_url('assets/')?>home_e/js/home_auto_search.js"></script>
<script src="<?=base_url('assets/')?>home_e/js/country_dropdown.js"></script>
<script src="<?=base_url('assets/')?>home_e/js/company_info.js"></script>
<script src="<?=base_url('assets/')?>home_e/js/signupup.js"></script>

<!-- =============Advance==search====== -->
<script src="<?=base_url('assets/')?>home_e/js/advance_search_dropDown.js"></script>


<script src="<?=base_url('assets/')?>home_e/js2/customjquery_b.js"></script>
<script src="<?=base_url('assets/')?>home_e/js2/form.js"></script>
<script src="<?=base_url('assets/')?>home_e/js2/home_search.js"></script>


<!-- ----------------bootstrap js--------------- -->


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

<!-- ---------end----------- -->


<!-- ------custome js--------- -->
 <script src="assets/js/main_b.js"></script>
 <script src="assets/js/customjquery_b.js"></script>

<!-- --------end----------- -->

<!-- -------jquery------- -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- --------end---------- -->


<!-- ---------wow js---------- -->
 <script type="text/javascript" scr="assets/js/wow.min.js"></script>
 <script src="assets/js/wow.min.js"></script>
<!-- --------end---------- -->

<!-- ---------counter js---------- -->
 <script src="assets/js/counter.js"></script>
<!-- --------end---------- -->




<!-- -----------wow-------
  -- -->
<script>
    wow = new WOW(
  
                      {
                      boxClass:     'wow',      // default
                      animateClass: 'animated', // default
                      offset:       0,          // default
                      mobile:       true,       // default
  

                      live:         true        // default
                    }
                    )
                    wow.init();
</script>


<!-- kreditaid=======Backtop==button -->

<div class="backTop" id="backTop" style="width:40px;height:40px;display:flex;justify-content: center;align-items: center;position: fixed;bottom:80px;right:10px; z-index:181881; background-position: center;cursor: pointer;">
     <img src="<?=base_url('assets/')?>home_e/images/up-arrow.png"style="transition:2s" width="40px" class="ucs_it_logo">
</div>



<!--Start of Tawk.to Script-->
<script type="text/javascript">


var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/606aa912f7ce182709371451/1f2ga8slm';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();


</script>


<!--End of Tawk.to Script-->


</body>
</html>