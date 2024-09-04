<?php

// var_dump($_SESSION);

$tbl1='company';
$tbl2='com_data';
$tbl3='directors';

$c_data=$this->admin->getWhere($tbl1,['cin'=>$cin]);


$v1='cin';
$v2='cid';
$v3='din';


$director_data=$this->admin->get_scrap_dir($cin);
$charge_data=$this->admin->get_charge_data($cin);

$act=$c_data[0]->activity;
$similar=$this->admin->getSimilarCompany($act);

$track_cost=$this->admin->getProductByName('Track a Company');
// ================get==country========================================
include('my_country.php');

// var_dump($track_cost); die();


?>

<?php if($c_data){ ?>

<div class="searchLoader2" id="searchLoader2" style="width:100%;height:100%;background:#FAFBFC;display:flex;justify-content: center;align-items: center;position: fixed;top:0;z-index:181881; background-position: center;">
   <div class="text-center">
   <img src="<?=base_url('assets/')?>home_e/images/loader/kreditaid_search_loader.gif"style="transition:2s" width="400px" class="ucs_it_logo">
   
   <div class="animate__animated animate__fadeInUp mt-lg-4 mt-2  col-12 ">
   	<div class="text-danger">KreditAid &nbsp;</div> <div class="loaderTxt">Fetching data & Analysing...</div> 
   </div>
   
   </div>
</div>

<?php } ?>

<!-- ----------------track company popup----------- -->

                   <!--edit user Modal -->
				   <div class="modal fade" id="Track" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content rounded-0" style=" background-color: #ECF4FF!important; padding:60px 0px;">
                        <div class="modal-header border-0" >
                          <h5 class="modal-title rt_17" id="exampleModalLongTitle ">You’ll be alerted whenever any event occurs:</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body track_popup d-flex justify-content-around flex-xl-nowrap flex-lg-nowrap flex-md-nowrap flex-wrap">
                          <div class=" f_13 col-md-6">
	                          <div><span><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt=""width="14px"> Change of Directors</span></div>
	                          <div><span><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt=""width="14px" class="mr-1">Filing of financials</span></div>
	                          <div><span><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt=""width="14px" class="mr-1">Registration of new loans</span></div>
	                          <div><span><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt=""width="14px" class="mr-1">Registration of Debentures</span></div>
	                          <div><span><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt=""width="14px" class="mr-1">Change of Company to LLP</span></div>
	                          <div><span><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt=""width="14px" class="mr-1">Satisfaction of loans</span></div>
	                          <div><span><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt=""width="14px" class="mr-1">Change of Address</span></div>
	                          <div><span><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt=""width="14px" class="mr-1">Application form for change of name</span></div>
	                          <div><span><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt=""width="14px" class="mr-1">Application for Conversion of <br>Public Company into Private Company</span></div>
	                          <div><span><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt=""width="14px" class="mr-1">Notice of the court or the company law board order</span></div>
	                          <div><span><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt=""width="14px" class="mr-1">Conversion of Public Company into Private Company or vice versa</span></div>
	                          
	                      </div>

	                      <div class="f_13 col-md-6">
	                      	  <div><span><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt=""width="14px" class="mr-1">Return of deposits</span></div>
	                          <div><span><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt=""width="14px" class="mr-1">Declaration of Solvency</span></div>
	                          <div><span><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt=""width="14px" class="mr-1">Changes in position of promoters and top ten shareholders</span></div>
	                          <div><span><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt=""width="14px" class="mr-1">Allotment of equity(ESOP, Fund raising, etc.)</span></div>
	                          <div><span><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt=""width="14px" class="mr-1">Return in respect of buy back of securities</span></div>
	                          <div><span><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt=""width="14px" class="mr-1">Letter of Offer</span></div>
	                          <div><span><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt=""width="14px" class="mr-1">Notice of consolidation, division, etc. or increase in share capital or </span></div>
	                          <div><span><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt=""width="14px" class="mr-1">increase in number of members</span></div>
	                          <div><span><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt=""width="14px" class="mr-1">Registration of Charge (New Secured Borrowings)</span></div>
	                      </div>
                          
                         <!--  <div class="addMoney text-center">
                            <h4 class="f_20 fw_400">Balance: <span class="fw_400 fw_300 text-success">253 &#8377;</span></h4>
                          </div> -->
                        </div>
                        <div class="modal-footer border-0 d-flex justify-content-around flex-wrap">
                        	<?php if($user_country=='India'){ ?>

                        	 <div class="f_20 fw_600">Price:- <?= $track_cost[0]["inr_price"] ?> INR</div>
                        	<?php } else{ ?>
                        	 <div class="f_20 fw_600">Price:-  <?= $track_cost[0]["usd_price"] ?> USD</div>
                        	<?php } ?>
                          
                         

                          <?php if($_SESSION['auth_user']){ ?>
                           <a href="<?=base_url()?>cart?cin=<?=$c_data[0]->cin?>&name=<?=$c_data[0]->name?>&cart_status=Track a Company"><div class="bg_17 text-white p-2 rounded cp rt_15 ">Continue</div>
                           </a>
                       <?php } else{ ?>
                           <div class="bg_17 text-white p-2 rounded cp rt_15 track_Company">Continue</div>
                       	   <?php } ?>
                        </div>
                      <!-- </form> -->
                      </div>
                    </div>
                  </div>
<!-- track company popUp End  -->

<!-- ===========================company info============================= -->

<section class="com_info">
	<div class="container-fluid p-0">
	<div class="container_event">
		<!-- <div class=" text-right company_info_mobile_sub_menu p-3">
				<i class="fas fa-chevron-down"></i>			
				</div> -->

	  <!-- <div class="container"> -->
		<div class="row ">

			
<!-- =================left side ===menu-==bar==desktop--==view=== -->

			<div class="col-xl-3 col-lg-4 col-md-4 col-sm-12 col-12  d-xl-flex d-lg-flex d-md-flex justify-content-xl-start justify-content-lg-start justify-content-md-start   pt-lg-2 pt-md-2 com_info_toggle_content" style="display: none; position: relative;width: 100%;">
				
				<div class="com_info_left f_15 text-left pl-lg-2 pl-md-3 pl-sm-1 ">
					
					<div class="lf ml-2"><span><a class=" basic_info active rt_12 mb-2">
						<img src="<?=base_url('assets/')?>home_e/images/info.png" alt="" height="20px" width="20px"> &nbsp;&nbsp;Basic Information</a></span></div>
					<div class="lf ml-2"><span><a class="director_info rt_12 mb-2">
						<img src="<?=base_url('assets/')?>home_e/images/director.png" alt="" height="20px" width="20px"> &nbsp;&nbsp;Company Directors</a></span></div>
					<div class="lf ml-2"><span><a class="charge_detail rt_12 mb-2" >
						<img src="<?=base_url('assets/')?>home_e/images/charge.png" alt="" height="20px" width="20px"> &nbsp;&nbsp;Charges Details</a></span></div>
					<div class="lf ml-2"><span><a class="financial_report rt_12 mb-2" ><img src="<?=base_url('assets/')?>home_e/images/svg/seo-report.svg" alt="" height="20px" width="20px"> &nbsp;&nbsp;Financial Report</a></span></div>

					<div class="lf ml-2"><span><a class="contact_detail rt_12 mb-2" ><img src="<?=base_url('assets/')?>home_e/images/contacts.png" alt="" height="20px" width="20px"> &nbsp;&nbsp;Contact Details</a></span></div>

<!-- ==========================My Cart section= pankaj============ -->
					
					<?php 
					if(isset($_SESSION['auth_user'])){ ?>
						<div class="d-flex">
									
							<div class="mt-1 ml-2 add_report_to_cartbtn  d-xl-block d-none" onclick="addTocart(`<?=$c_data[0]->cin?>'`,`'<?=$c_data[0]->name?>`,e)"><a href="<?=base_url()?>cart?cin=<?=$c_data[0]->cin?>&name=<?=$c_data[0]->name?>&cart_status=Full Company Report" class="bg_2 p-2 rounded text-white f_14 rt_12 ">Add  to Cart</a></div>
							
							
							<!-- <div class="mt-1 ml-2 track_this_companybtn d-xl-block d-none" data-toggle="modal" data-target="#PopUp"><span class="bg_4 p-2 rounded text-white f_14 rt_12 ">Track  company</span></div>	 -->
							<!-- <div class="mt-1 ml-2 track_this_companybtn d-xl-block d-none" data-toggle="modal" data-target="#Track"><span class="bg_4 p-2 rounded text-white f_14 rt_12 "><a href="<?=base_url()?>cart?cin=<?=$c_data[0]->cin?>&name=<?=$c_data[0]->name?>&cart_status=track_company">Track  company</a></span></div> -->

							<div class="mt-1 ml-2 track_this_companybtn d-xl-block d-none" data-toggle="modal" data-target="#Track"><span class="bg_4 p-2 rounded text-white f_14 rt_12 ">Track  company</span></div>


						</div>
					<?php }else{?>
						<div class="d-flex">
							
							<?php 
							
							 
							$name=str_replace(' ', '-', $c_data[0]->name);
							
								$in_cart = 0;
							  	if(isset($_SESSION) ){ 
					  	 		
					  	 			foreach ($_SESSION as $key) {
										if($key[0]['cin'] != null)
										{ 
											if($key[0]['cin']==$cin)
											{ 
										
												// 	// echo $in_cart;exit; 	
												$in_cart = 1;
												break;
											} 
										} 
									}
										  
								} 
							
								if($in_cart==1)
								{
									echo '<div class="mt-1 ml-2 track_this_companybtn d-xl-block d-none" onclick="login_to_cart1(`'.$cin.'`)">
									<span class="bg_2 p-2 rounded text-white f_14 rt_12 ">Checkout</span>
									</div>';
								}
								else
								{
							?>
							<!-- <a href="<?=base_url('/')?>addToCart/<?= $cin.'.'.$name ?>">
								<div class="mt-1 ml-2 track_this_companybtn d-xl-block d-none">
									<span class="bg_2 p-2 rounded text-white f_14 rt_12 ">Add Report to cart</span>
								</div>	
							</a> -->
							<div class="mt-1 ml-2 track_this_companybtn d-xl-block d-none" onclick="addToCartByLocalStorage('<?=$cin?>','<?=$name?>','Full Company Report')"">
								<span class="bg_2 p-2 rounded text-white f_14 rt_12 ">Add Report to cart</span>
							</div>
							<?php

								}
							?>
							
							
							<!-- <div class="mt-1 ml-2 track_this_companybtn d-xl-block d-none" onclick="login_to_cart('<?=  $cin ?>')">
								<span class="bg_2 p-2 rounded text-white f_14 rt_12 ">Add Report to cart</span>
							</div>	 -->
							<input type="hidden" name="" value="cart" id='cart_status'>
							<input type="hidden" name="" data-toggle="modal" data-target="#PopUp" id='triggerShowPopUp'>
							<input type="hidden" id="comp_name" value="<?=  $c_data[0]->name ?>">
							<input type="hidden" id="cin" value="<?=  $cin ?>">

							<!-- <div class="mt-1 ml-2 track_this_companybtn d-xl-block d-none" data-toggle="modal" data-target="#PopUp"><span class="bg_4 p-2 rounded text-white f_14 rt_12 ">Track  company</span></div> -->
							<div class="mt-1 ml-2 track_this_companybtn d-xl-block d-none" data-toggle="modal" data-target="#Track"><span class="bg_4 p-2 rounded text-white f_14 rt_12 ">Track  company</span></div>		
						</div>

					<?php } ?>
<!-- ==========================================Pankaj===code=== -->
				
                   <div class="advert  mt-xl-1 mt-lg-4 col-md-12  p-2 text-center">
					<img src="<?=base_url('assets/')?>home_e/images/home/business_ad.jpg" alt="img-fluid">
				   </div>
				

				</div>

<script>
	$(document).ready(function(){
		// var link_active=$(this).scrollTop();
		// if(link_active<100){
		// 	$('.com_info_left a').css('color','red');
		// }
		// else{
		// 	$('.com_info_left a').css('color','black');
		// }

		$('.com_info_left a').click(function(){
           $('.com_info_left a').css('color','#888');
			$(this).css('color','#000');
		});
	})
</script>

				
<script>
$(window).scroll(function()
{
	 var s=$(this).scrollTop();

	 var h=$(document).height(); 

	 var m=h-1100;

	//  console.log(m+'/'+h+'/'+s);

	 if(s >= m){ $('.com_info_left').hide(); } else{ $('.com_info_left').show(); }



	 if(s >= '100'){  $('.com_info_left').css('margin-top','-70px'); }else{ $('.com_info_left').css('margin-top','0px'); }



	




});
</script>

<script type="text/javascript">
	
	 $(".basic_info").click(function() {
	      $('html, body').animate({  scrollTop: $("#basic_info").offset().top }, 500);
	    });


	 $(".director_info").click(function() {
	      $('html, body').animate({  scrollTop: $("#director_info").offset().top }, 500);
	    });


	 $(".charge_detail").click(function() {
	      $('html, body').animate({  scrollTop: $("#charge_detail").offset().top }, 500);
	    });


	 $(".financial_report").click(function() {
	      $('html, body').animate({  scrollTop: $("#financial_report").offset().top }, 500);
	    });


	 $(".contact_detail").click(function() {
	      $('html, body').animate({  scrollTop: $("#contact_detail").offset().top }, 500);
	    });



</script>
                  <!-- Modal -->
							


						


			</div>

<!-- =============================Right==side===Company==data=and directors==data=== -->


			<div class="col-xl-9 col-lg-8 col-md-7 col-sm-12 col-12 ">
				<div class="com_info_right f_15 py-3 col-lg-10 col-lg-10 col-md-12 col-12" id="basic_info">
					<h2 class="rt_15 font-weight-bold text-danger">Overview</h2>
					<p class="fw_400 f_15 rt_12 text-dark"> <span class="font-weight-bold"><?= $c_data[0]->name ?></span> is a <?= $c_data[0]->class ?> incorporated on . It is classified as Company limited by Shares and is registered at Registrar of Companies, <?=  $c_data[0]->roc ?>. Its authorized share capital is Rs. <?= $c_data[0]->authourisedCapital ?> and its paid up capital is Rs. <?= $c_data[0]->paidUpCaiptal ?>. It is involved in Business Services.

						<br>

					<?= $c_data[0]->name ?> Annual General Meeting (AGM) was last held on <?= $c_data[0]->annual_filing ?> and as per records from Ministry of Corporate Affairs (MCA).

					<br>
                    
                    <br><b>Corporate Identification Number  (CIN) </b><br>
					<?= $c_data[0]->cin ?>
                       

                       <br>
					

					<?php if($c_data[0]->email ){  ?> <b>Email Address </b><br>
					<?= $c_data[0]->email ?>
				    <?php } ?>

				    <br>

					

					<?php if($c_data[0]->address){ ?><b>Registered Address </b><br>
					<?= $c_data[0]->address ?>  <?php echo str_replace('-', '', $c_data[0]->address2);  ?> </p>
				   <?php } ?>


<!-- =========================mobile==view==popup==button===== -->
					<div>
						<div class="d-flex">
							<?php if(isset($_SESSION['auth_user'])){ ?>
								<!-- <div class="mt-1 ml-2 add_report_to_cartbtn  d-xl-none d-block" onclick="addTocart(<?=$_SESSION['customer_id'].','.$c_data[0]->cin?>)"><a href="<?=base_url()?>User_Dashboard?a=3" class="bg_2 p-2 rounded text-white f_14 rt_12 ">Add  to Cart</a></div>
								<div class="mt-1 ml-2 track_this_companybtn d-xl-none d-block" data-toggle="modal" data-target="#Track"><span class="bg_4 p-2 rounded text-white f_14 rt_12 ">Track  company</span></div>	 -->
								
								<div class="mt-1 ml-2 add_report_to_cartbtn  d-xl-none d-block" onclick="addTocart(`<?=$c_data[0]->cin?>'`,`'<?=$c_data[0]->name?>`,e)"><a href="<?=base_url()?>cart?cin=<?=$c_data[0]->cin?>&name=<?=$c_data[0]->name?>&cart_status=Full Company Report" class="bg_2 p-2 rounded text-white f_14 rt_12 ">Add  to Cart</a></div>
					
								<!-- <div class="mt-1 ml-2 track_this_companybtn d-xl-none d-block" data-toggle="modal" data-target="#Track"><span class="bg_4 p-2 rounded text-white f_14 rt_12 "><a href="<?=base_url()?>cart?cin=<?=$c_data[0]->cin?>&name=<?=$c_data[0]->name?>&cart_status=track_company">Track  company</a></span></div> -->

								<div class="mt-1 ml-2 track_this_companybtn d-xl-none d-block" data-toggle="modal" data-target="#Track"><span class="bg_4 p-2 rounded text-white f_14 rt_12 ">Track  company</span></div>


							<?php }else{ ?>


								<!-- <a href="<?=base_url('/')?>addToCart/<?= $cin.'.'.$name ?>">
									<div class="mt-1 ml-2 track_this_companybtn d-xl-none d-block">
										<span class="bg_2 p-2 rounded text-white f_14 rt_12 ">Add  to cart</span>
									</div>	
								</a> -->



								<?php if($in_cart == 1)
								{
									echo '<div class="mt-1 ml-2 track_this_companybtn d-xl-none d-block" onclick="login_to_cart1(`'.$cin.'`)">
									<span class="bg_2 p-2 rounded text-white f_14 rt_12 ">Checkout</span>
									</div>';
								}
								else
								{
							?>
							<!-- <a href="<?=base_url('/')?>addToCart/<?= $cin.'.'.$name ?>">
								<div class="mt-1 ml-2 track_this_companybtn d-xl-none d-block">
									<span class="bg_2 p-2 rounded text-white f_14 rt_12 ">Add Report to cart</span>
								</div>	
							</a> -->
							<!-- d-xl-block -->
							<div class="mt-1 ml-2 track_this_companybtn  d-none d-xl-none d-block" onclick="addToCartByLocalStorage('<?=$cin?>','<?=$name?>','Full Company Report')">
								<span class="bg_2 p-2 rounded text-white f_14 rt_12 ">Add Report to cart</span>
							</div>
							<?php

								}
							?>



								<div class="mt-1 ml-2 track_this_companybtn d-xl-none d-block" data-toggle="modal" data-target="#Track"><span class="bg_4 p-2 rounded text-white f_14 rt_12 ">Track  company</span></div>


						   <?php } ?>	
						</div>
					</div>


				</div>

                  <div class="col-lg-10 col-lg-10 col-md-12 col-12 p-0 mt-lg-2 mt-2">
                	<!-- <img src="<?=base_url('assets/')?>home_e/images/adv-3.jpg" alt="img-fluid " class="w-100"> -->
                	<div class="adv-3 bgg_2 p-4 d-flex justify-content-between">
                		<div>
                		<h4 class="f_30 rt_14 text-white">Delivery better Speed faster</h4>
                		<p class="rt_10">Unlimited Colud, 225 SSD, Graphics Card</p>
                		<button class="px-xl-4 px-lg-4 px-2 rt_10 border-0 text-white text-uppercase f_14 fw_800 py-1 rounded shadow">Get Now</button>
                	    </div>
                	    <div>
                	    	 <img src="<?=base_url('assets/')?>home_e/images/home/lap.png" alt="img-fluid"  width="200px">
                	    </div>
                	</div>
                </div>

				<div class="com_detail shadow-sm col-lg-10 col-lg-10 col-md-12 col-12">
					
					<div><h6 class="rt_15 font-weight-bold f_20 py-3">Company Information</h6></div>
				<table class="w-100 mt-2 fw_400 table">
					<!-- <tr class="table_heading">
						<th class="rt_15 font-weight-bold">Company Information</th>
					</tr> -->
						
					    <tr>
							<td class="fw_900 font-weight-bold rt_11">CIN</td>
							<td class=" cin_number rt_11"><?= $c_data[0]->cin ?></td>							
						</tr>

						<tr class="">
				      <td class="rt_11">Company Name</td>
				      <td class="rt_11 font-weight-bold text-dark"><?= $c_data[0]->name ?></td>
				      
				    </tr>
				    <tr>
				      <td class="rt_11">Company Sub Category</td>
				      <td class="rt_11"><?= $c_data[0]->subCategory ?></td>
				     
				    </tr>
				    <tr>
				      <td class="rt_11">Class of Company</td>
				      <td class="rt_11"><?= $c_data[0]->class ?></td>
				     
				    </tr>
				    <tr>
				      <td class="rt_11">Company Status</td>
				      <?php if($c_data[0]->status =='-'){  ?>
				             	
				          <td class="text-danger font-weight-bold">N/A</td>

				      <?php } else{ ?>
				          <td class="status font-weight-bold"><?= $c_data[0]->status ?></td>

				      <?php } ?>				         	
				     
				    </tr>
				    <tr>
				      <td class="rt_11 ">Date of Incorporation</td>
				      <td class="rt_11 "><?= $c_data[0]->dateofincorporation ?></td>
				     
				    </tr>
				    <tr>
				      <td class="rt_11 ">Registrar of Companies</td>
				      <td class="rt_11 "><?= $c_data[0]->roc ?></td>
				     
				    </tr>

				    <tr>
				      <td class="rt_11 ">Age of Company </td>
				      <td class="rt_11 ">

				         <?php 				 

				           $date=explode('/', $c_data[0]->dateofincorporation);

							$d=$date[0];
							$m=$date[1];
							$y=$date[2];

							$date1 = $d.'-'.$m.'-'.$y;
							// $date1 ='06-01-1993';
							$date2 = date('d-m-Y');

							$diff = abs(strtotime($date2)-strtotime($date1));
                            $years = floor($diff / (365*60*60*24));
							$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
							$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
							echo  $years.' Years &nbsp;'. $months.' Month &nbsp;'. $days.' Days';

                              // echo $date2;
                      
                      ?>
				      </td>
				     
				    </tr>

				    <tr>
				      <td class="rt_11">Company Category</td>
				      <td class="rt_11"><?= $c_data[0]->category ?></td>
				     
				    </tr>
				    <tr>
				      <td class="rt_11">Activity</td>
				      <td class="rt_11"><?= $c_data[0]->activity ?></td>
				     
				    </tr>
					
				</table>
				</div>




               

				<div class="free_update bgg_1 my-2 col-lg-10 col-lg-10 col-md-12 col-12  p-3  mt-lg-4 mt-2">
					<div class="free_update_content">
						<span class="f_13 text-white rt_11">Follow and GET Updates for</span>
						<h2 class="  text-white"><?= $c_data[0]->name ?> </h2>
						<button class="bg-white border-0 px-3 py-1 rounded rt_15">Get Free Update</button>
					</div>
					<div class=" mt-3 d-flex flex-wrap">
						<div class="" style="width: 150px;"><i class="fas fa-check-circle text-white"></i> <a href="" class="tc_0 mr-3 text-white f_15 rt_12">Name of Change</a></div>
						<div style="width: 150px;"><i class="fas fa-check-circle text-white"></i> <a href="" class="tc_0 mr-3 text-white f_15 rt_12">Address Change</a></div>
						<div style="width: 150px;"><i class="fas fa-check-circle text-white"></i> <a href="" class="tc_0 mr-3 text-white f_15 rt_12">Director Change</a></div>
						<div style="width: 150px;"><i class="fas fa-check-circle text-white"></i> <a href="" class="tc_0 mr-3 text-white f_15 rt_12">Board Meetings</a></div>
					</div>
				</div>


<!-- =================Directors=========data=============== -->

                <div class="dir_report com_detail shadow-sm col-lg-10 col-lg-10 col-md-12 col-12 mt-lg-4 mt-2" id="director_info">
					<div><h6 class="rt_15 font-weight-bold text-dark f_20 py-3">Director Details</h6></div>
				<table class="w-100 mt-2 mb-2">
					<!-- <tr class="table_heading">
						<th class="rt_15 font-weight-bold text-dark">Director Details</th>
					</tr> -->
						
					    <tr>
							<td class="fw_900 font-weight-bold rt_11">DIN</td>
							<td class="fw_900 font-weight-bold rt_11">Director Name</td>
							<td class="fw_900 font-weight-bold rt_11">Designation</td>
							<td class="fw_900 font-weight-bold rt_11">Date of Appointment</td>
							
						</tr>

            <?php if($director_data){ foreach ($director_data as $key) { ?>
					<tr class="">
				      <td><a href="../Director_info/<?= $key['din'] ?>" class="rt_11 tc_2 fw_400 "><?= $key['din'] ?></a></td>
				      <td><a href="../Director_info/<?= $key['din'] ?>" class="rt_11 tc_2 fw_400 "><?= $key['name'] ?></a></td>
				      <td class="rt_11 fw_400 "><?= $key['designation'] ?></td>
				      <td class="rt_11 fw_400 "><?= $key['date_of_joining'] ?></td>
				    </tr>
            <?php } }else{ ?>

            	<tr class="">
				      <td colspan="4"> <h6 class="font-weight-bold text-danger"> No  data Found!</h6></td>
				    </tr>

            <?php } ?>

				    
					
				</table>
				</div>

<!-- ====================Charges==data====================== -->

				<div class="dir_report com_detail shadow-sm col-lg-10 col-lg-10 col-md-12 col-12  mt-lg-4 mt-2" id="charge_detail">
										<div><h6 class="rt_15 font-weight-bold text-success f_20 py-3">Charge Details</h6></div>

				<table class="w-100 mt-2 mb-2">
					<!-- <tr class="table_heading text-nowrap">
						<th class="rt_15 font-weight-bold text-success">Charge Details</th>
					</tr> -->
						
					    <tr>
							<td class="fw_900 font-weight-bold rt_11 text-nowrap">Charge Id</td>
							<td class="fw_900 font-weight-bold rt_11 text-nowrap">Creation Date</td>
							<td class="fw_900 font-weight-bold rt_11 text-nowrap">Modification Date</td>
							<td class="fw_900 font-weight-bold rt_11 text-nowrap">Closure Date</td>
							<td class="fw_900 font-weight-bold rt_11 text-nowrap">Assets Under Charge</td>
							<td class="fw_900 font-weight-bold rt_11 text-nowrap">Amount</td>
							<td class="fw_900 font-weight-bold rt_11 text-nowrap">Charge Holder</td>
							
						</tr>

						<?php if($charge_data){ foreach ($charge_data as $key) { ?>
					 <tr >
							<td class="fw_400 text-nowrap font-weight-bold  rt_10"><?= $key['charge_id'] ?></td>
							<td class="fw_400 text-nowrap  rt_11"><?= $key['Creation_Date'] ?></td>
							<td class="fw_400 text-nowrap  rt_11"><?= $key['Modification_Date'] ?></td>
							<td class="fw_400 text-nowrap  rt_11"><?= $key['Closure_Date'] ?></td>
							<td class="fw_400   rt_11"><?= $key['Assets_Under_Charge'] ?></td>
							<td class="fw_400 text-nowrap  rt_11 text-success"><?= $key['Amount'] ?></td>
							<td class="fw_400   rt_11"><?= $key['Charge_Holder'] ?></td>
							
						</tr>

            <?php } }else{ ?>

            	<tr class="">
				      <td colspan="7"> <h6 class="font-weight-bold text-danger"> No  data Found!</h6></td>
				    </tr>

            <?php } ?>

					
				</table>
				</div>
<!-- ==================================End===of ==charge===data====== -->


<!-- ==============Financial=========reports================ -->

				<div class="fin_report com_detail shadow-sm col-lg-10 col-lg-10 col-md-12 col-12  mt-lg-4 mt-2" id="financial_report">

					<div class="table_heading p-2 d-flex  align-items-center">
						<div class="rt_15 font-weight-bold text-primary f_20">Financial Report</div>
						 
					</div>

					<table class="table ">
					

						<tr class="" >
				      <td class="rt_11 font-weight-bold">Balance Sheet</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt="" height="32px" width="32px"></a> </td>
				       <td class="text-nowrap rt_11 font-weight-bold">Profit & Loss</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt="" height="32px" width="32px"></a> </td>
				     
				      
				    </tr>
				    <tr class="">
				      <td class="rt_11">Paid-up Capital</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt="" height="32px" width="32px"></a> </td>
				       <td class="rt_11">Total Revenue (Turnover)</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt="" height="32px" width="32px"></a> </td>
				     
				      
				    </tr>
				   <tr class="">
				      <td class="rt_11">Reserves & Surplus</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt="" height="32px" width="32px"></a> </td>
				       <td class="rt_11">Employee Benefit Expenses</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt="" height="32px" width="32px"></a> </td>
				     
				      
				    </tr>
				    <tr class="">
				      <td class="rt_11">Short Term Borrowings</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt="" height="32px" width="32px"></a> </td>
				       <td class="rt_11">Finance Costs</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt="" height="32px" width="32px"></a> </td>
				     
				      
				    </tr>
				    <tr class="">
				      <td class="rt_11">Current Investments</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt="" height="32px" width="32px"></a> </td>
				       <td  class="rt_11">Depriciation</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt="" height="32px" width="32px"></a> </td>
				     
				      
				    </tr>
				    <tr class="">
				      <td class="rt_11">Inventories</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt="" height="32px" width="32px"></a> </td>
				       <td class="rt_11">Profit Before Tax</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt="" height="32px" width="32px"></a> </td>
				     
				      
				    </tr>
				    <tr class="">
				      <td class="rt_11">Trade Receivables</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt="" height="32px" width="32px"></a> </td>
				       <td class="rt_11">Profit After Tax</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt="" height="32px" width="32px"></a> </td>
				     
				      
				    </tr>
				    <tr class="">
				      <td class="rt_11">Cash and Bank Balances</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt="" height="32px" width="32px"></a> </td>
				       <!-- <td class="rt_11">Paid-up Capital</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/lock3.png" alt="" height="32px" width="32px"></a> </td> -->
				     
				      
				    </tr>

				    

					
				   
				</table>


				<div class="table_heading p-2 d-flex justify-content-between align-items-center ">
					<div class="rt_15 font-weight-bold text-primary f_20"></div>
						<div>
						 	
							<?php if(isset($_SESSION['auth_user'])){ ?>
				    			<div class=" bg_2  p-2 rounded text-white f_14 rt_12 " style="cursor: pointer;">
									<img src="<?=base_url('assets/')?>home_e/images/svg/shopping-cart.svg" class="text-white f" alt="" height="18px" width="18px"><a href="<?=base_url()?>cart?cin=<?=$c_data[0]->cin?>&name=<?=$c_data[0]->name?>&cart_status=Full Company Report" class="bg_2 p-2 rounded text-white f_14 rt_12 ">&nbsp; Purchase</a>
								</div>
							<?php }else{ ?>
				    			<div class=" bg_2  p-2 rounded text-white f_14 rt_12  purchaseLogout" style="cursor: pointer;">
									<img src="<?=base_url('assets/')?>home_e/images/svg/shopping-cart.svg" class="text-white f" alt="" height="18px" width="18px">&nbsp; Purchase
								</div>
							<?php } ?>	
						</div>		
					</div>
				</div>
<!-- ============================================End===of===finacial===report -->
			<!-- <div class="d-flex  col-md-12">
				    		<button class="btn btn-primary bt_1 rt_13 purchasebtn2" style="position: relative;left: 80px;">
				    		<img src="<?=base_url('assets/')?>home_e/images/svg/shopping-cart.svg" class="text-white f" alt="" height="18px" width="18px">&nbsp; Purchase</button>
					</div> -->

                
           <div class="con_detail com_detail shadow-sm col-lg-10 col-lg-10 col-md-12 col-12  mt-lg-4 mt-2" id="contact_detail">
					<!-- <div class="mt-2">dsfasf</div> -->
					
                  
                  <div class="row">
                  	<div class="col-xl-6 col-lg-6 col-md-12 col-12">
					<table class="w-100 mt-2">
					<tr class="table_heading">
						<th class="rt_15 text-nowrap text-info font-weight-bold">Contact  Details</th>
					</tr>
						
					    <tr>
							<td class="fw_900 font-weight-bold bg-white rt_11">Email</td>
							<td class="fw_900 font-weight-bold bg-white rt_11">Address</td>
							
							
						</tr>

						<tr class="">
				      <td class="rt_11"><?= $c_data[0]->email  ?></td>
				      <td class="rt_11"><?php echo str_replace('-', '',$c_data[0]->address.$c_data[0]->address2);  ?></td>
				     
				      
				    </tr>
				    <!-- <div>dsfaf</div> -->
				   
				   
				</table>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-12 col-12 pt-xl-5 pt-lg-5  pt-2">
				
                    <iframe src="https://maps.google.it/maps?q=<?php echo str_replace('-', '',$c_data[0]->address.$c_data[0]->address2);  ?>&output=embed" class="border-0 w-100"></iframe>
               
				</div>
		</div>
		</div>


<!-- =============================Similar===companies======== -->

<div class="con_detail com_detail shadow-sm col-lg-10 col-lg-10 col-md-12 col-12 mt-4">
      
         <h4 class="rt_15 text-nowrap text-info font-weight-bold f_20 pt-3">Similar Companies </h4>
          <div class="swiper-container">
		    <div class="swiper-wrapper">

<!-- ================================= -->

 <?php foreach ($similar as $key ) {  ?>

		      <div class="swiper-slide pb-5">
		      	 <div class="similar_company">
		      		<div class="card_grid2 bgg_4 shadow-sm p-3 border">

				<!-- ====================Simillar ==companies===data==== -->

                      	<div class="">
                      		<div>
                      		 <span class="f_13 fw_500 ">Company Name</span>
                      	    </div>
                      	     <div>
                      		 <span class="f_12 fw_300"><a href="../Company_info/<?= $key['cin'] ?>" target="_blank" class="tc_4"><?= $key['name'] ?></a></span>
                      	    </div>
                      	</div>

                      	<div class="">
                      		<div>
                      		 <span class="f_13 fw_500">CIN</span>
                      	    </div>
                      	     <div>
                      		 <span class="f_12 fw_300"><?= $key['cin'] ?></span>
                      	    </div>
                      	</div>

                      	<div class="">
                      		<div>
                      		 <span class="f_13 fw_500">Status</span>
                      	    </div>
                      	     <div>
                      		 <span class="f_12 fw_300 text-success"><?= $key['status'] ?></span>
                      	    </div>
                      	</div>
<!-- ================================================= -->

                      </div>
		      	</div>
		      </div>
		  <?php } ?>
<!-- ===========================end==of simillar==loop================== -->

		   

		    </div>
		    <!-- Add Pagination -->
		    <div class="swiper-pagination"></div>
		  </div>
        
      </div>






<!-- ====================Get==company==update======================================== -->

       <div class="con_detail com_detail shadow-sm col-lg-10 col-lg-10 col-md-12 col-12 mt-4 pb-3 mb-2" style="overflow: hidden;">
        <h4 class="rt_15 text-nowrap f_20 py-4 ml-2 " >Update Company Information </h4>
        <p class="f_15 ml-2 rt_14 text-dark">To refresh the company information provided on Directors,Paid up capital,Charges etc. Please click on the 'Update Company Information' button below to start the process.</p>
		<?php if(isset($_SESSION['auth_user'])){ ?>
        	<div class="mt-1 add_report_to_cartbtn ml-2" onclick="updateCompanyInfo('<?=$cin?>')"><span class="bg-primary p-2 rounded text-white f_14 rt_12 ">Update Company Information</span></div>
		<?php }else{?>
        	<div class="mt-1 add_report_to_cartbtn ml-2" data-toggle="modal" data-target="#addReportToCart" onclick="updateCompanyInfoLogOut('<?=$cin?>')"><span class="bg-primary p-2 rounded text-white f_14 rt_12 ">Update Company Information</span></div>
		<?php } ?>
     </div>







			</div>

		</div>
   

     


	</div>

</div>


</div>
</div>
</section>

<!-- Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
 -->



<!-- =======================end================== -->
  <script>
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 1,
      spaceBetween: 10,
      // init: false,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 20,
          loop:true
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 40,
          loop:true
        },
        1024: {
          slidesPerView: 2,
          spaceBetween: 40,
          loop:true
        },
         1200: {
          slidesPerView: 3,
          spaceBetween: 40,
          loop:true
        }
      }
    });
  </script>
<!-- -----------link-2 js---------- -->
<?php include 'link-2_b.php'; ?>





<!-- akib js popup -->

 <!-- ====================================gmail login/logout start============================================== -->
 <!--login code start -->
 <script>
 /*
    function onSignIn(googleUser) 
    {
        var profile = googleUser.getBasicProfile();
        userName = profile.getName();
        userImageUrl = profile.getImageUrl();
        userEmail = profile.getEmail();
        userIdByG = profile.getId();
        // console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
        // console.log('Name: ' + profile.getName());
        // console.log('Image URL: ' + profile.getImageUrl());
        // console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
        console.log('name:'+userName+', '+' userEmail:'+userEmail+' userId,'+userIdByG+' ,userImageLink:'+userImageUrl);
        if(userName && userEmail && userIdByG)
        {
            $.ajax(
            {
                type:'post',
                url:'loginByGmailAccount/afterLogin.php',
                data:{name:userName,userImage:userImageUrl,email:userEmail,userId:userIdByG},
                beforeSend:function()
                {

                },
                success:function(res)
                {
                    console.log(res);
                    if(res=="addInDB")
                    {
                        alert("user Added In DB");
                        console.log("user Added In DB");
                    }
                    else if(res=="notAdd")
                    {
                        alert("user Did Not Add In DB");
                        console.log("user  Did Not Add In DB");
                    }    
                }
            });
        }    
	}
*/	
</script>
<!--login code end -->

<!-- <a href="#" class="btn btn-danger m-3" onclick="signOut();">Sign out</a> -->

<!-- logout code start -->
<script>
/*
    function signOut() 
    {   
        var auth2 = gapi.auth2.getAuthInstance();
            // var revokeAllScopes = function() {
            //     gapi.auth2.getAuthInstance().disconnect();
            // }
            auth2.signOut().then(function () {
            //console.log('User signed out.');
            
            $.ajax(
            {
              type:'POST',
              url:'loginByGmailAccount/logout.php',
              data:{logout:'logout'},
              success:function(res)
              {

                alert(res); 
                console.log(res);
                //window.location.href = "";
                auth2.disconnect();
                // location.reload();
              }  
            });
        });
	}
*/	
 </script>
 <!-- logout code end -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>    -->
<!-- ==============================================gmail login/logut end============================================================= -->

<!-- ==============================================fb login/logout start============================================================== -->
<!-- <div class="fb-login-button" data-width="" data-size="medium" data-button-type="login_with"  onlogin="checkLoginState();" data-layout="default" data-auto-logout-link="true" data-use-continue-as="true"></div> -->

<script>
/*
function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
    console.log('statusChangeCallback');
    console.log(response);                   // The current login status of the person.
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.
      testAPI();  
    } else {                                 // Not logged into your webpage or we are unable to tell.
    //   document.getElementById('status').innerHTML = 'Please log ' + 'into this webpage.';
      $(
      {
        type:'post',
        url:'facebookLogin/logout.php',
        data:{logout:'logout'},
        beforeSend:function()
        {
          
        },
        success:function(res)
        {
          console.log(res);
          console.log('you Are logged-Out');
          
          alert('you Are logged-Out');
        },
      });
    }
  }
  function checkLoginState() {               // Called when a person is finished with the Login Button.
    FB.getLoginStatus(function(response) {   // See the onlogin handler
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '147457133911749',      //App Id in curli braces
      cookie     : true,                     // Enable cookies to allow the server to access the session.
      xfbml      : true,                     // Parse social plugins on this webpage.
      version    : 'v10.0'           // Use this Graph API version for this call.
    });


    FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
      statusChangeCallback(response);        // Returns the login status.
    });
  };
 
  function testAPI() 
  {                      
    // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    
    console.log('Welcome!  Fetching your information.... ');
    
    FB.api('/me', {locale: 'en_US', fields: 'id,first_name,birthday,age_range,hometown,location,last_name,email,link,gender,locale,picture'}, function(response) 
    {

      // console.log('Successful login for: ' + response.name);
      
      document.getElementById('status').innerHTML ='<p>Thanks for logging in, ' + response.first_name + '!</p>';
      // isset($_POST['name']) && isset($_POST['userImage']) && isset($_POST['email']) && isset($_POST['userId']
      $.ajax(
      {
        type:'post',
        
        url:'facebookLogin/afterLogin.php',
        
        data:{
          'userId':response.id,
          
          'fName':response.first_name,

          'lName':response.last_name,

          'email':response.email,

          // 'hometown':response.hometown,

          // 'localtion':response.location,

          // 'age_range':response.age_range,

          // 'birthday':response.birthday,
          
          // 'link':response.link,

          // 'gender':response.gender,

          // 'locale':response.locale,

          // 'picture':response.picture,
        },
        beforeSend:function()
        {

        },
        success:function(res)
        {
          console.log(res);
          if('addInDB')
          {
            console.log(res);
            if(res=="addInDB")
            {
              alert("user Added In DB");
              console.log("user Added In DB");
            }
            else if(res=="notAdd")
            {
              alert("user Did Not Add In DB");
              console.log("user  Did Not Add In DB");
            }
          }
        }        
      });  

    //   document.getElementById('userData').innerHTML = '<h2>Facebook Profile Details</h2><p><b>FB ID:</b> '+response.id+'</p><p><b>Name:</b> '+response.first_name+' '+response.last_name+'</p><p><b>Email:</b> '+response.email+'</p><p><b>Gender:</b> '+response.gender+'</p><p><b>FB Profile:</b> <a target="_blank" href="'+response.link+'">click to view profile</a></p>';


    //   document.getElementById('userData').innerHTML = '<h2>Facebook Profile Details</h2><p><img src="'+response.picture.data.url+'"/></p><p><b>FB ID:</b> '+response.id+'</p><p><b>Name:</b> '+response.first_name+' '+response.last_name+'</p><p><b>Email:</b> '+response.email+'</p><p><b>Gender:</b> '+response.gender+'</p><p><b>FB Profile:</b> <a target="_blank" href="'+response.link+'">click to view profile</a></p>';
      //document.getElementById('userData').innerHTML = 'Thanks for logging in, ' + response.name + '!';
    });
  }


*/
</script>
<!-- <div id="status"></div>
<div id="userData"></div> -->
<!-- Load the JS SDK asynchronously -->
<!-- <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script> -->
<!-- ==============================================fb login/logout end=================================================================== -->


<!-- ====================payment==Confirmation===Popup=============== -->
<input type="hidden" name="" id="updateInfoBtn" data-toggle="modal" data-target="#updateInfoPopup">
                  <!--buy now Modal -->
                  <div class="modal fade" id="updateInfoPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content rounded-0" style=" background-color: #ECF4FF!important;">
                        <div class="modal-header border-0" >

                          <div class="d-flex align-items-center ">
                            <h5 class="modal-title rt_17" id="exampleModalLongTitle "><img src="<?=base_url('assets/home_e/images/svg/update.svg')?>" width="30px" class="mr-2">
                            Company Update Request</h5>
                          </div>
                          
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        
                        <div class="modal-body  d-flex justify-content-center align-items-center">
                          <div class="addMoney text-center col-12">
                          
                            
                            

                             <h4 class="f_20 fw_400 rt_15 updateInfoText font-weight-bold"> </h4>
                             <h4 class="f_15 fw_400 rt_15 ">Company information update will reflect with in 24hrs. <br>  Thank you</h4>

                            


                          </div>
                        </div>
                        
                        <!-- <div id='buyNowNotice' class="alert alert-success">sdasasa<div> -->
                        
                      </div>
                    </div>
                  </div>

</body>
</html>