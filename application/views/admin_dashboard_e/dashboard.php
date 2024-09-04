<?php 

include('admin_dashboard_function.php');

 ?>

<script type="text/javascript">

  var siteUrl = '<?=base_url('/')?>';

</script>

<!-- ==============================admin dashboard====================== -->
<section class="Dashboard">
    <div class="container-fluid  mb-xl-0 mb-0">


    <div class=" p-0 " id="ResponsiveContainer" >
        <div class="row Dashboard_wrapper">
            <!-- <div class="col-xl-2 col-lg-3 col-md-12 d-none d-xl-block d-lg-block col-sm-12 col-12 p-0"  style="position: fixed;height: 100%;width: ;z-index: 1;"> -->
              <div class="dashboard_left_main col-xl-2 col-lg-3 col-md-12 d-none d-xl-block d-lg-block col-sm-12 col-12 p-0">
               <div class="dashboard_left bg_2 h-100  d-flex justify-content-center">
                   <ul class="w-100 h-100 pt-4" type="none">

                       
                        <li class=" px-2 pl-xl-3 pl-lg-3  py-2 fw_500 active" onclick="desktopSideBarBtn(1)">
                          <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/dashboard.svg" alt="" width="18px" class="mr-1"> <span>Dashboard</span></li>

                        <li class=" px-2 pl-xl-3 pl-lg-3  py-2 fw_500" onclick="desktopSideBarBtn(2)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/wallet-2.svg" alt="" width="18px" class="mr-1"> <span>Wallet</span></li>

                        <li class=" px-2 pl-xl-3 pl-lg-3  py-2 fw_500" onclick="desktopSideBarBtn(3)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/user-4.svg" alt="" width="18px" class="mr-1"> <span>All Users</span></li>

                        <li class=" px-2 pl-xl-3 pl-lg-3  py-2 fw_500" onclick="desktopSideBarBtn(4)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/pie-chart-2.svg" alt="" width="18px" class="mr-1"> <span>Reports</span></li>

                        <li class=" px-2 pl-xl-3 pl-lg-3  py-2 fw_500" onclick="desktopSideBarBtn(5)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/sent.svg" alt="" width="18px" class="mr-1"> <span>Orders</span></li>

                        <li class=" px-2 pl-xl-3 pl-lg-3  py-2 fw_500" onclick="desktopSideBarBtn(6)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/bell.svg" alt="" width="18px" class="mr-1"> <span>Notification</span> <span class="bg-white tc_7 f_14 px-1 rounded">8</span></li>

                        <li class=" px-2 pl-xl-3 pl-lg-3  py-2 fw_500" onclick="desktopSideBarBtn(7)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/user-5.svg" alt="" width="18px" class="mr-1"> <span>Postpaid Users</span></li>

                        <li class=" px-2 pl-xl-3 pl-lg-3  py-2 fw_500 manage_website_btn"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/web-management.svg" alt="" width="18px" class="mr-1"> <span>Manage Website</span> <i class="fas fa-chevron-right ml-3 f_10"></i></li>
                        
                        <div class="ml-2 ad_subcontent">
                         <li class=" px-2 pl-xl-3 pl-lg-3 py-1 mt-1 fw_500" onclick="desktopSideBarBtn(8)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/settings.svg" alt="" width="15px" class="mr-1"> <span>Footer Setting</span></li>
                         <li class=" px-2 pl-xl-3 pl-lg-3  py-1 fw_500" onclick="desktopSideBarBtn(9)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/header.svg" alt="" width="15px" class="mr-1"> <span>Header Menu</span></li>
                         <li class=" px-2 pl-xl-3 pl-lg-3  py-1 fw_500" onclick="desktopSideBarBtn(10)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/footer.svg" alt="" width="15px" class="mr-1"> <span>Left Footer Menu</span></li>
                         <li class=" px-2 pl-xl-3 pl-lg-3  py-1 fw_500" onclick="desktopSideBarBtn(11)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/menu.svg" alt="" width="15px" class="mr-1"> <span>Right Footer Menu</span></li>
                         <li class=" px-2 pl-xl-3 pl-lg-3  py-1 fw_500" onclick="desktopSideBarBtn(12)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/social-media.svg" alt="" width="15px" class="mr-1"> <span>Social Media</span></li>
                         <li class=" px-2 pl-xl-3 pl-lg-3  py-1 fw_500" onclick="desktopSideBarBtn(13)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/open-box.svg" alt="" width="15px" class="mr-1"> <span>Product</span></li>
                         <li class=" px-2 pl-xl-3 pl-lg-3  py-1 fw_500" onclick="desktopSideBarBtn(14)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/address-book.svg" alt="" width="15px" class="mr-1"> <span>Contact Address</span></li>
                         <li class=" px-2 pl-xl-3 pl-lg-3  py-1 fw_500" onclick="desktopSideBarBtn(15)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/id-card.svg" alt="" width="15px" class="mr-1"> <span>Membership</span></li>
                         
                         

                         </div>

                         <li class=" px-2 pl-xl-3 pl-lg-3  py-2 fw_500" style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap;" onclick="desktopSideBarBtn(16)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/management.svg" alt="" width="18px" class="mr-1"> <span>Existing Report Validating</span></li>

                         <li class=" px-2 pl-xl-3 pl-lg-3  py-2 fw_500" onclick="desktopSideBarBtn(17)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/conversation.svg" alt="" width="18px" class="mr-1"> <span>Users Support</span></li>

                         <li class=" px-2 pl-xl-3 pl-lg-3  py-2 fw_500" onclick="desktopSideBarBtn(18)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/communicate.svg" alt="" width="18px" class="mr-1"> <span>Contact Us List</span></li>

                         <li class=" px-2 pl-xl-3 pl-lg-3  py-2 fw_500" onclick="desktopSideBarBtn(19)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/manual.svg" alt="" width="18px" class="mr-1"> <span>Offline Request</span></li>

                         <li class=" px-2 pl-xl-3 pl-lg-3  py-2 fw_500" onclick="desktopSideBarBtn(20)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/web-crawler.svg" alt="" width="18px" class="mr-1"> <span>Crawlers/Scrapers</span></li>

                         <li class=" px-2 pl-xl-3 pl-lg-3  py-2 fw_500" style="margin-bottom: 100px!important;" onclick="desktopSideBarBtn(21)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/black-settings-button.svg" alt="" width="18px" class="mr-1"> <span>Setting</span></li>



                   </ul>
               </div>
            </div>

           <!-- ========mobile sidebar=============== -->
            <div class="dashboard_mobile_sidebar w-100 h-100">
              
                   <div class=" col-12 dashboard_left bg_2 p-0 h-100">
                   
                   <div class=" dashboard_mobile_sidebar_close" style="position: absolute;right: 5px;z-index: 1000;">
                    <i class="fa fa-times pr-4 pt-3  text-white float-right"></i>
                   </div>

                   <svg style="transform: rotate(180deg);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#007580" fill-opacity="1" d="M0,96L48,90.7C96,85,192,75,288,64C384,53,480,43,576,58.7C672,75,768,117,864,149.3C960,181,1056,203,1152,197.3C1248,192,1344,160,1392,144L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                   </svg>
                   
                   <div class=" d-flex justify-content-around align-items-center w-100 p-2" style="margin-top: -10px;">
                     <div class="">
                      <img src="<?=base_url('assets/')?>admin_dashboard_e/image/user.png" alt="" width="50px" class="rounded-circle img-fluid">
                    </div>
                     <div class="ml-4 text-white f_20 fw_500">
                     <h6>Joe Doe</h6>
                     <!-- <h6>Client Id:1253</h6> -->
                     </div>

                     <div class="ml-4 text-white f_20 fw_500" >
                     <h6><a class="f_10 bg_21 text-white rounded p-2" href="">Logout</a></h6>
                     </div>
                     
                   </div>



                   <ul class="w-100 h-100 pt-2" type="none">

                        
                        <li class=" px-2 pl-4  py-2 fw_500 rt_14 active" onclick="desktopSideBarBtn(1)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/dashboard.svg" alt="" width="18px" class="mr-1"> Dashboard</li>
                        <li class=" px-2 pl-4  py-2 fw_500 rt_14" onclick="desktopSideBarBtn(2)"><img src="<?=base_url('assets/')?>admin_dashboard_e/svg/wallet-2.svg" alt="" width="18px" class="mr-1"> Wallet</li>
                        <li class=" px-2 pl-4  py-2 fw_500 rt_14" onclick="desktopSideBarBtn(3)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/user-4.svg" alt="" width="18px" class="mr-1"> All Users</li>
                        <li class=" px-2 pl-4  py-2 fw_500 rt_14" onclick="desktopSideBarBtn(4)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/pie-chart-2.svg" alt="" width="18px" class="mr-1">Reports</li>
                        <li class=" px-2 pl-4  py-2 fw_500 rt_14" onclick="desktopSideBarBtn(5)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/sent.svg" alt="" width="18px" class="mr-1"> Orders</li>
                        <li class=" px-2 pl-4  py-2 fw_500 rt_14" onclick="desktopSideBarBtn(6)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/bell.svg" alt="" width="18px" class="mr-1"> Notification <span class="bg-white tc_7 f_14 px-1 rounded">8</span></li>
                        <li class=" px-2 pl-4  py-2 fw_500 rt_14" onclick="desktopSideBarBtn(7)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/user-5.svg" alt="" width="18px" class="mr-1"> Postpaid Users</li>

                        <li class=" px-2 pl-4  py-2 fw_500 rt_14 manage_website_btn manage_website_btn_2"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/web-management.svg" alt="" width="18px" class="mr-1"> Manage Website <i class="fas fa-chevron-right ml-3 f_10"></i></li>
                        
                        <div class="ml-2 ad_subcontent">
                         <li class=" px-2 pl-4 pl-lg-3 py-0 mt-1 fw_500" onclick="desktopSideBarBtn(8)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/settings.svg" alt="" width="15px" class="mr-1"> Footer Setting</li>
                         <li class=" px-2 pl-4 pl-lg-3  py-0 fw_500" onclick="desktopSideBarBtn(9)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/header.svg" alt="" width="15px" class="mr-1"> Header Menu</li>
                         <li class=" px-2 pl-4 pl-lg-3  py-0 fw_500" onclick="desktopSideBarBtn(10)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/footer.svg" alt="" width="15px" class="mr-1"> Left Footer Menu</li>
                         <li class=" px-2 pl-4 pl-lg-3  py-0 fw_500" onclick="desktopSideBarBtn(11)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/menu.svg" alt="" width="15px" class="mr-1"> Right Footer Menu</li>
                         <li class=" px-2 pl-4 pl-lg-3  py-0 fw_500" onclick="desktopSideBarBtn(12)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/social-media.svg" alt="" width="15px" class="mr-1"> Social Media</li>
                         <li class=" px-2 pl-4 pl-lg-3  py-0 fw_500" onclick="desktopSideBarBtn(13)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/open-box.svg" alt="" width="15px" class="mr-1"> Product</li>
                         <li class=" px-2 pl-4 pl-lg-3  py-0 fw_500" onclick="desktopSideBarBtn(14)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/address-book.svg" alt="" width="15px" class="mr-1"> Contact Address</li>
                         <li class=" px-2 pl-4 pl-lg-3  py-0 fw_500" onclick="desktopSideBarBtn(15)"> <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/id-card.svg" alt="" width="15px" class="mr-1"> Membership</li>
                         
                         

                         </div>
                   </ul>
               </div>
             </div>

            

            <!-- <div class="col-xl-10 col-lg-9 col-md-12 col-sm-12 col-12 p-0 bg_6 pl-lg-0 pl-xl-0 pl-md-0 pl-3">
             -->
            <div class="col-xl-8 col-lg-9 col-md-12 col-sm-12 col-12 p-0 bg_23 pl-lg-0 pl-xl-0 pl-md-0 pl-3 dashboard_right_main">

              
               <div class="d-flex flex-wrap justify-content-xl-between justify-content-lg-between align-items-center justify-content-between dashboard_right bg_23 p-3">
             
                 <!-- <div class="mt-2">-->
                 <!--  <h3 class="f_20 fw_400"> Home</h3>-->
                 <!--</div>-->
                 
                 <div class="d-flex">
                     <div class=" d-xl-block d-lg-block d-none">
                         <i class="fa fa-bars pt-1 cp " id="MenuSmall"></i>
                         <i class="fas fa-arrow-right pt-1 cp" id="MenuSmallClose"></i>
                     </div>
                     
                   <!--<h3 class=" fw_400 text-dark rt_20 ml-2"> Home</h3>-->
                 </div>

                 <div class="d-flex justify-content-center align-items-center ">
                    
                    <div class="dashboard_noti d-flex justify-content-center align-items-center mr-3">
                      <span class="f_9 text-white"></span>
                      <i class="far fa-bell"></i>

                    </div>
                    

                  </div>
                 </div>
               
             

               <?php include 'include/home.php'; ?>

                
               <?php include 'include/wallet.php'; ?>


               <?php include 'include/users.php'; ?>

               
               <?php include 'include/reports.php'; ?>


               <?php include 'include/orders.php'; ?>


               <?php include 'include/notification.php'; ?>


               <?php include 'include/postpaid.php'; ?>


               <?php include 'include/man-web/setting.php'; ?>


               <?php include 'include/man-web/header.php'; ?>
               

               <?php include 'include/man-web/footer.php'; ?>


               <?php include 'include/man-web/rightmenu.php'; ?>


               <?php include 'include/man-web/social.php'; ?>


               <?php include 'include/man-web/product.php'; ?>


               <?php include 'include/man-web/contact.php'; ?>


               <?php include 'include/man-web/membership.php'; ?>


               <?php include 'include/existreport.php'; ?>


               <?php include 'include/usersupport.php'; ?>

               

               



               </div>
                <div class="col-xl-2 col-lg-0  dashboard_adv">
        
        <img src="<?=base_url('assets/')?>admin_dashboard_e/image/adv-5.png" alt="" class="mr-1" style="position: fixed;right: 0;top:0;z-index: 1;top:85px;width:300px">
      </div>

            </div>


        </div>

    </div>
</section>

<!--===== admin dashboard=== -->
<script type="text/javascript">
   $(document).ready(function(){
     $('.ad_wallet_btn').click(function(){
      $('.ad_wallet_body').hide();
      $('.ad_wallet_view').show();

     })
     $('.ad_wallet_view .wallet_view_back_btn').click(function(){
      $('.ad_wallet_body').show();
      $('.ad_wallet_view').hide();

     })

 // manage website menu

 $('.manage_website_btn').click(function(){
      $('.ad_subcontent').toggle();

     })
  

// wallet user balance
     $('.wallet_user_balance_view_btn').click(function(){
      $('.wallet_user_balance').hide();
      $('.wallet_user_balance_view').show();

     })

     $('.wallet_user_view_back_btn').click(function(){
      $('.wallet_user_balance_view').hide();
      $('.wallet_user_balance').show();

     })

// wallet user request
     $('.ad_wallet_user_request_btn').click(function(){
      $('.ad_wallet_body').hide();
      $('.ad_wallet_user_request_view').show();

     })

     $('.wallet_user_request_back_btn').click(function(){
       $('.ad_wallet_body').show();
      $('.ad_wallet_user_request_view').hide();

     })

     // slabs
     

      $('.add_slabs_btn').click(function(){
       $('.ad_wallet_body').hide();
      $('.ad_add_slabs').show();

     })

      $('.add_slabs_back_btn').click(function(){
       $('.ad_wallet_body').show();
      $('.ad_add_slabs').hide();

     })

      $('.ad_edit_credit_btn').click(function(){
       $('.ad_wallet_body').hide();
      $('.ad_edit_credit_slabs').show();

     })

       $('.ad_edit_credit_back_btn').click(function(){
       $('.ad_wallet_body').show();
      $('.ad_edit_credit_slabs').hide();

     })

    // all users

     $('.all_users_tabs div').click(function(){
           $('.all_users_tabs div').css({'background-color':'#fff','color':'#000'});
           $('.all_users_tabs div').removeClass('active');
           $(this).css({'background-color':'#007580','color':'#fff'});
    });
   
   $('.convert_postpaid_btn').click(function(){
           $('.convert_post').show();
           $('.ad_user_body').hide();
    });
   $('.ad_convert_postpaid_back_btn').click(function(){
           $('.convert_post').hide();
           $('.ad_user_body').show();
    });

   // reports

   
    $('.all_reports_tabs div').click(function(){
           $('.all_reports_tabs div').css({'background-color':'#fff','color':'#000'});
           $('.all_reports_tabs div').removeClass('active');
           $(this).css({'background-color':'#007580','color':'#fff'});
    });


     // orders

   
    $('.all_orders_tabs div').click(function(){
           $('.all_orders_tabs div').css({'background-color':'#fff','color':'#000'});
           $('.all_orders_tabs div').removeClass('active');
           $(this).css({'background-color':'#007580','color':'#fff'});
    });

    $('.order_view_btn').click(function(){
           $('.ad_orders_view').show();
           $('.ad_order_body').hide();
    });
    $('.orders_view_back_btn').click(function(){
           $('.ad_orders_view').hide();
           $('.ad_order_body').show();
    });

    // Notification

     $('.notification_view_btn').click(function(){
           $('.ad_notification_view').show();
           $('.ad_notification_body').hide();
    });
    $('.notification_view_back_btn').click(function(){
           $('.ad_notification_view').hide();
           $('.ad_notification_body').show();
    });

    // postpaid

   
    $('.all_postpaid_tabs div').click(function(){
           $('.all_postpaid_tabs div').css({'background-color':'#fff','color':'#000'});
           $('.all_postpaid_tabs div').removeClass('active');
           $(this).css({'background-color':'#007580','color':'#fff'});
    });

    $('.order_view_btn').click(function(){
           $('.ad_postpaid_view').show();
           $('.ad_order_body').hide();
    });
    $('.postpaid_view_back_btn').click(function(){
           $('.ad_postpaid_view').hide();
           $('.ad_order_body').show();
    });

    $('.postpaid_view_btn').click(function(){
           $('.ad_postpaidinvoice_view').show();
           $('.ad_postpaid_body').hide();
    });
    $('.postpaid_back_btn').click(function(){
           $('.ad_postpaidinvoice_view').hide();
           $('.ad_postpaid_body').show();
    });

    
    

    

   })
</script>



<!-- ====user dashboard==== -->

<script type="text/javascript">
    $(document).ready(function(){
     $('.dashboard_menu_icon').click(function(){
       // $('.dashboard_mobile_sidebar').toggleClass('show');
       $('.dashboard_mobile_sidebar').addClass('show');
       // $('.dashboard_mobile_sidebar').removeClass('show');

    })
     $('.dashboard_mobile_sidebar_close').click(function(){
       $('.dashboard_mobile_sidebar').removeClass('show');

    })
     

     $('.dashboard_left ul li').click(function(){
           $('.dashboard_left ul li').css({'background-color':'','color':'#fff'});
           $('.dashboard_left ul li').removeClass('active');
           $(this).css({'background-color':'#007580','color':'#fff'});
           $('.dashboard_mobile_sidebar').removeClass('show');
    });

     

     $('.manage_website_btn_2').click(function(){
          
           $('.dashboard_mobile_sidebar').addClass('show');
    });

     

      $('.company_list_tabs div').click(function(){
           $('.company_list_tabs div').css({'background-color':'#fff','color':'#000'});
           $('.company_list_tabs div').removeClass('active');
           $(this).css({'background-color':'#007580','color':'#fff'});
    });

      $('.purchase_history_tabs div').click(function(){
           $('.purchase_history_tabs div').css({'background-color':'#fff','color':'#000'});
           $('.purchase_history_tabs div').removeClass('active');
           $(this).css({'background-color':'#007580','color':'#fff'});
    });

      $('.support_tabs div').click(function(){
           $('.support_tabs div').css({'background-color':'#fff','color':'#000'});
           $('.support_tabs div').removeClass('active');
           $(this).css({'background-color':'#007580','color':'#fff'});
    });

    
      $('#DashboardNewTicket').click(function(){
    
      
           $('.NewTicket').css({'display':'block'});
           $('.supportBackbtn').css({'display':'block'});
           
           $('#supportContent_1,#supportContent_2,#supportContent_3').css({'display':'none'});
           $('.supportTopSection div, .supportTopSection div button').hide();
           
           
    });

      $('.supportBackbtn').click(function(){
      
           $('.NewTicket').css({'display':'none'});
           $('.supportBackbtn').css({'display':'none'});

           
           $('#supportContent_1').css({'display':'block'});
           $('.supportTopSection div, .supportTopSection div button').show();
           
    });

    // extra large screen
    var Width=$('#ResponsiveContainer').width();
     if(Width>2000){
      
      $('#ResponsiveContainer').addClass('container');
     }
     else{
      
      $('#ResponsiveContainer').removeClass('container');
     }
    
    })


      $('#viewTicketBtn').click(function(){
      
          $('#supportContent_1,#supportContent_2,#supportContent_3').css({'display':'none'});
           $('.supportTopSection div, .supportTopSection div button,.supportHeading div div').hide();
           $('.viewticketBackbtn,.viewTicketHeading div div,.viewTicket div').show();
           
    });

      $('.viewticketBackbtn').click(function(){
        
              $('.viewticketBackbtn,.viewTicketHeading div div,.viewTicket div').hide();
             $('.supportBackbtn').css({'display':'none'});

             
             $('#supportContent_1').css({'display':'block'});
             $('.supportTopSection div, .supportTopSection div button').show();
             
      });


   // dashboard card section my-wallet pop-up

      $('.AddWalletBtn').click(function(){
        
             // $('#MyWallet').css('display','none');
             // $('.modal-backdrop').css('display','none');
             $('.modal-backdrop').hide();

             
      });
      


  



  function desktopSideBarBtn(n){

   $('.dashboard_body').css('display','none');
   $('#desktopMainPannel_'+n).css('display','block');
   }

  function companyTableBtn(n){

   $('.table_content').css('display','none');
   $('#companyListTable_'+n).css('display','block');
   }

  function purchaseHistoryBtn(n){
    $('.purchase_history_content').css('display','none');
   $('#purchaseHistoryContent_'+n).css('display','block');
  }


  function supportBtn(n){
    $('.support_content').css('display','none');
   $('#supportContent_'+n).css('display','block');
  }
 

     function allUserBtn(n){
      $('.allusers').css('display','none');
     $('#alluserTable_'+n).css('display','block');
    }
     

   function reportsBtn(n){
      $('.reports').css('display','none');
     $('#reports_'+n).css('display','block');
    }   


    function ordersBtn(n){
      $('.orders').css('display','none');
     $('#orders_'+n).css('display','block');
    } 

     function postpaidBtn(n){
      $('.postpaid').css('display','none');
     $('#postpaid_'+n).css('display','block');
    }   



    </script>



<!-- =================end================== -->

<?php
 include('admin_popup.php');
 ?>