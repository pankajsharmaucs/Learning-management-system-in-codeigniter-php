<?php 


$uemail=$_SESSION['auth_user'];

$tbl1='users_e';

$c_data=$this->admin->getWhere($tbl1,['email'=>$uemail]);
$fullname=$c_data[0]->name;
$country=$c_data[0]->country;

$_SESSION['user_name']=$fullname;
$_SESSION['country']=$country;
// $uname=$fullname;




$cat1='Full Company Report';
$tbl2='orders';
$fullComCount=$this->admin->getFullCompOrders($uemail,$tbl2,$cat1);
 
$tbl3='user_wallet';
$userWalletCount=$this->admin->getUserWallet($uemail,$tbl3);


$getAllOrdersCount=$this->admin->getAllOrdersCount($uemail,$tbl2);


$getAllOrders=$this->admin->getAllOrders($uemail,$tbl2);

$getAllPurchase=$this->admin->getAllPurchase($uemail);


$getUserRechargeReq=$this->admin->getUserRechargeReq($uemail);



$amount_type=$userWalletCount[0]['amount_type'];

if($country == 'India' ) {
  $ctype='&#8377;';
  $SumofCart=$this->admin->getTotalCartInrCost($uemail);
  $sumofcart=$SumofCart[0]['cost'];
} 
  else{
   $ctype='USD'; 
   $SumofCart=$this->admin->getTotalCartUsdCost($uemail);
   $sumofcart=$SumofCart[0]['usd_cost'];
 }
$_SESSION['ctype']=$ctype;


// ===============Ticket===data===

$allTicket=$this->admin->getAllTicketbyUserid($uemail);
$openTicket=$this->admin->getOpenTicketbyUserid($uemail);
$closedTicket=$this->admin->getClosedTicketbyUserid($uemail);

// var_dump($userWalletCount[0]['amount_type']); die();


// var_dump($ctype); die();
 ?>




<!-- ==============================dashboard====================== -->
<script>
var siteUrl = '<?=base_url('/')?>';
// console.log(siteUrl);
</script>
<section class="Dashboard">
    <div class="container-fluid  mb-xl-0 mb-0">


    <div class=" p-0 " id="ResponsiveContainer" >
        <div class="row Dashboard_wrapper">
            <!-- <div class="col-xl-2 col-lg-3 col-md-12 d-none d-xl-block d-lg-block col-sm-12 col-12 p-0"  style="position: fixed;height: 100%;width: ;z-index: 1;"> -->
              <div class="dashboard_left_main col-xl-2 col-lg-3 col-md-12 d-none d-xl-block d-lg-block col-sm-12 col-12 p-0">
               <div class="dashboard_left bg_2 h-100  d-flex justify-content-center">
                   <ul class="w-100 h-100 pt-4" type="none">

                       
                        <li id="tab1" class=" px-2 pl-xl-3 pl-lg-3  py-2 fw_500  tab1 active" onclick="desktopSideBarBtn(1)">
                          <img src="<?=base_url('assets/')?>user_dashboard_e/svg/dashboard.svg" alt="" width="18px" class="mr-1"> <span>Dashboard</span></li>

                        <li class=" px-2 pl-xl-3 pl-lg-3  py-2 fw_500 tab2" onclick="desktopSideBarBtn(2)"> <img src="<?=base_url('assets/')?>user_dashboard_e/svg/list.svg" alt="" width="18px" class="mr-1"> <span>Company List</span></li>

                        <li class=" px-2 pl-xl-3 pl-lg-3  py-2 fw_500 tab3" onclick="desktopSideBarBtn(3)"> <img src="<?=base_url('assets/')?>user_dashboard_e/svg/trolley.svg" alt="" width="18px" class="mr-1"> <span>Cart</span></li>

                        <li class=" px-2 pl-xl-3 pl-lg-3  py-2 fw_500 tab4" onclick="desktopSideBarBtn(4)"> <img src="<?=base_url('assets/')?>user_dashboard_e/svg/history.svg" alt="" width="18px" class="mr-1"> <span>Purchase History</span></li>

                        <li class=" px-2 pl-xl-3 pl-lg-3  py-2 fw_500 tab5" onclick="desktopSideBarBtn(5)"> <img src="<?=base_url('assets/')?>user_dashboard_e/svg/wallet-2.svg" alt="" width="18px" class="mr-1"> <span>Wallet</span></li>

                        <li class=" px-2 pl-xl-3 pl-lg-3  py-2 fw_500 tab6" onclick="desktopSideBarBtn(6)"> <img src="<?=base_url('assets/')?>user_dashboard_e/svg/bell.svg" alt="" width="18px" class="mr-1"> <span>Notification</span> <span class="bg-white tc_6 f_14 px-1 rounded">8</span></li>

                        <li class=" px-2 pl-xl-3 pl-lg-3  py-2 fw_500 tab7" onclick="desktopSideBarBtn(7)"> <img src="<?=base_url('assets/')?>user_dashboard_e/svg/technical-support.svg" alt="" width="18px" class="mr-1"> <span>Support</span></li>

                        <li class=" px-2 pl-xl-3 pl-lg-3  py-2 fw_500 tab8" onclick="desktopSideBarBtn(8)"> <img src="<?=base_url('assets/')?>user_dashboard_e/svg/management.svg" alt="" width="18px" class="mr-1"> <span>Profile Setting</span></li>

                        <li class=" px-2 pl-xl-3 pl-lg-3  py-2 fw_500 tab8" onclick="desktopSideBarBtn(9)"> <img src="<?=base_url('assets/')?>user_dashboard_e/svg/password.svg" alt="" width="18px" class="mr-1"> <span>Reset Password</span></li>
                   </ul>
               </div>
            </div>


           <!-- ========mobile sidebar=============== -->
            <div class="dashboard_mobile_sidebar w-100 h-100 ">
              
                   <div class=" col-12 dashboard_left bg_2 p-0 h-100">
                   
                   <div class=" dashboard_mobile_sidebar_close" style="position: absolute;right: 5px;z-index: 1000;">
                    <i class="fa fa-times pr-4 pt-3  text-white float-right"></i>
                   </div>

                   <svg style="transform: rotate(180deg);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0099ff" fill-opacity="1" d="M0,96L48,90.7C96,85,192,75,288,64C384,53,480,43,576,58.7C672,75,768,117,864,149.3C960,181,1056,203,1152,197.3C1248,192,1344,160,1392,144L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                   </svg>
                   
                   <div class=" d-flex justify-content-center align-items-center w-100 p-2" style="margin-top: -10px;">
                     <div class="text-center">
                      
                      <img src="<?=base_url('assets/')?>user_dashboard_e/image/user.png" alt="" width="50px" class="rounded-circle img-fluid">

                       <div class=" text-white f_20 fw_500">
                       <h6 class="mt-3"><?= $fullname ?></h6>
                       </div>

                    </div>

                    <!--<div class="usersearchBox pl-3">-->
                    <!--  <input type="text" name="" placeholder="Search Company" id="usersearchinput2">-->
                    <!--    <button onclick="SearchCompany2()" >Search</button>-->
                    <!--</div>-->
                     

                     
                   </div>

                     



                   <ul class="w-100 h-100 pt-2" type="none">

                        
                        <li class=" px-2 pl-4  py-2 fw_500 rt_14 active" onclick="desktopSideBarBtn(1)"> <img src="<?=base_url('assets/')?>user_dashboard_e/svg/dashboard.svg" alt="" width="18px" class="mr-1"> Dashboard</li>
                        <li class=" px-2 pl-4  py-2 fw_500 rt_14" onclick="desktopSideBarBtn(2)"><img src="<?=base_url('assets/')?>user_dashboard_e/svg/list.svg" alt="" width="18px" class="mr-1"> Company List</li>
                        <li class=" px-2 pl-4  py-2 fw_500 rt_14" onclick="desktopSideBarBtn(3)"> <img src="<?=base_url('assets/')?>user_dashboard_e/svg/trolley.svg" alt="" width="18px" class="mr-1"> Cart</li>
                        <li class=" px-2 pl-4  py-2 fw_500 rt_14" onclick="desktopSideBarBtn(4)"> <img src="<?=base_url('assets/')?>user_dashboard_e/svg/history.svg" alt="" width="18px" class="mr-1"> Purchase History</li>
                        <li class=" px-2 pl-4  py-2 fw_500 rt_14" onclick="desktopSideBarBtn(5)"> <img src="<?=base_url('assets/')?>user_dashboard_e/svg/wallet-2.svg" alt="" width="18px" class="mr-1"> Wallet</li>
                        <li class=" px-2 pl-4  py-2 fw_500 rt_14" onclick="desktopSideBarBtn(6)"> <img src="<?=base_url('assets/')?>user_dashboard_e/svg/bell.svg" alt="" width="18px" class="mr-1"> Notification <span class="bg-white tc_6 f_14 px-1 rounded">8</span></li>
                        <li class=" px-2 pl-4  py-2 fw_500 rt_14" onclick="desktopSideBarBtn(7)"> <img src="<?=base_url('assets/')?>user_dashboard_e/svg/technical-support.svg" alt="" width="18px" class="mr-1"> Support</li>
                        <li class=" px-2 pl-4  py-2 fw_500 rt_14" onclick="desktopSideBarBtn(8)"> <img src="<?=base_url('assets/')?>user_dashboard_e/svg/management.svg" alt="" width="18px" class="mr-1"> Profile Setting</li>
                        <li class=" px-2 pl-4  py-2 fw_500 rt_14" onclick="desktopSideBarBtn(9)"> <img src="<?=base_url('assets/')?>user_dashboard_e/svg/password.svg" alt="" width="18px" class="mr-1"> Reset Password</li>

                          <li class=" px-2 pl-4  py-2 fw_500 rt_14" onclick="window.open('<?= base_url('/Logout')?>','_self');" >
                         <img src="<?=base_url('assets/')?>user_dashboard_e/svg/logout.svg" alt="" width="18px" class="mr-1"> Logout
                       </li>

                   </ul>
               </div>
             </div>

            

            <!-- <div class="col-xl-10 col-lg-9 col-md-12 col-sm-12 col-12 p-0 bg_6 pl-lg-0 pl-xl-0 pl-md-0 pl-3">
             -->
            <div class="col-xl-8 col-lg-9 col-md-12 col-sm-12 col-12 p-0 bg_6 pl-lg-0 pl-xl-0 pl-md-0 pl-3 dashboard_right_main">
                <div class="usersearchBox pt-2 d-xl-none d-lg-none  d-block w-100 d-flex justify-content-center">
                    <div>
                      <input type="text" name="" class="f_14" placeholder="Search Company" id="usersearchinput2">
                        <button class="rounded f_14" onclick="SearchCompany2()" >Search</button>
                        </div>
                    </div>
               <div class="d-flex flex-wrap justify-content-xl-between justify-content-lg-between align-items-center justify-content-center dashboard_right bg_6 p-3">
             
                
                 <div class="d-flex">
                     <div class=" d-xl-block d-lg-block d-none">
                         <i class="fa fa-bars pt-1 cp " id="MenuSmall"></i>
                         <i class="fas fa-arrow-right pt-1 cp" id="MenuSmallClose"></i>
                     </div>
                     
                   <!--<h3 class=" fw_400 text-dark rt_20 ml-2"> Home</h3>-->
                 </div>
                 
                 
                 

                 <div class="d-flex justify-content-center align-items-center ">
                    
                    <div class="dashboard_cart d-flex justify-content-center align-items-center mr-3"
                    onclick="desktopSideBarBtn(6)">
                      <span class="f_9 text-white"></span>
                      <i class="far fa-bell"></i>

                    </div>
                    <div class="dashboard_noti d-flex justify-content-center align-items-center mr-3"
                    onclick="desktopSideBarBtn(3)">
                     
                      <span class="f_9 text-white"></span>
                      <i class="fas fa-shopping-cart"></i>
                      
                    </div>

                  </div>
                 </div>
               
             

               <?php include 'include/home.php'; ?>

                
               <?php include 'include/company_list.php'; ?>

                    
               <?php include 'include/cart.php'; ?>

               <?php include 'include/purchase.php'; ?>

               <?php include 'include/wallet.php'; ?>

               <?php include 'include/notification.php'; ?>

               <?php include 'include/support.php'; ?>
                         
               <?php include 'include/change_password.php'; ?>
               
               <?php include 'include/profile.php'; ?>    




               </div>
                <div class="col-xl-2 col-lg-0  dashboard_adv">
        
        <img src="<?=base_url('assets/')?>user_dashboard_e/image/adv-5.png" alt="" class="mr-1" style="position: fixed;right: 0;top:0;z-index: 1;top:85px;width:300px">
      </div>

            </div>


        </div>

    </div>
</section>





<!-- =================end================== -->


