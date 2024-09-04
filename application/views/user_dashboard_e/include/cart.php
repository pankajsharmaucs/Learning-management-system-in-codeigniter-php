<!-- =======cart ====== -->

                <div class="cart_body dashboard_body p-xl-3 p-lg-3 p-md-3" id="desktopMainPannel_3">
                   <div class="row col-lg-12 col-12 ">
                       <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 d-flex justify-content-between align-items-center  p-0 flex-wrap">
                         <div class="cart_tabs d-flex justify-content-start align-items-center text-center  flex-wrap">
                              <!-- <div class="m-1 px-2 py-1 bg_13 text-white rounded f_15 rt_14">Remove All</div> -->
                              <!-- <div class ="m-1 px-2 py-1 bg_11 text-white rounded f_15 rt_14">Purchase by wallet</div> -->
                            </div>
<!-- 
                            <div class="search d-flex justify-content-start align-items-center mt-2  flex-wrap m-1">
                             <form>
                             <input type="date" name="" class="mb-2 py-1 pl-1 f_14" style="width: 120px;" placeholder="Enter From Date">
                             <input type="date" name="" class="mb-2 py-1 pl-1 f_14" style="width: 120px;" placeholder="Enter To Date">
                             <button class="border-0 bg_11 text-white rounded mb-2 py-1 f_14" style="width: 50px;">Reset</button>
                           </form>
                            </div> -->


                       </div>

                        <div class="col-xl-12 col-lg-12 bg_7 col-md-12 col-sm-12 col-12 d-flex justify-content-between align-items-center  p-0 flex-wrap">
                         <div class="d-flex justify-content-start align-items-center text-center  flex-wrap">
                              <div class="m-1 px-2 py-1 f_18  font-weight-bold fw_600 rounded f_15 rt_18">My Cart</div>
                            </div>
                       </div>

                       <!-- -table-1 -->
                      
                       <div class="col-12 p-0 m-1">
                        <div class="table-responsive">

                          <table class="table w-100">
                           <thead>
                            <tr class="bg-white text-center">
                              <td scope="col">Sno.</td>
                              <td scope="col">Product Name</td>
                              <td scope="col">Country</td>
                              <!-- <th scope="col">Quantity</th> -->
                              <td scope="col">Total Cost</td>
                              <td scope="col">Actions</td>
                              <td scope="col">Remove</td>
                            </tr>
                          </thead>
                          <tbody class="cartItem">

<?php 
  
  
  $totalCost = 0;
  $code='';
  $wallet_amount=0;
  $getAllCartData=$this->admin->getAllCartData($uemail,$tbl2,'cart');
  
  if($getAllCartData){ $id=1; foreach ($getAllCartData as $key ) {
    
    $product_name=$key['category'];
    $code=$key['country_code'];
    $all_cost=$this->admin->getProductByName($product_name);

if($country == 'India'){ $c=0; $cost=$all_cost[0]['inr_price']; }
else{ $cost=$all_cost[0]['usd_price']; $c=1;}

$totalCost +=$cost; 

?>

                             <tr class="text-center">
                               
                              <th scope="row" class="align-middle"><?= $id ?></th>
                              <td class="f_14 text-nowrap fw_600"><?= $key['category'] ?>
                                <h6 class="f_11 tc_1 fw_300">(<?= $key['name'] ?>)</h6>
                                </td>
                              <td class="f_14 text-nowrap">India</td>
                              <!-- <td class="f_14 text-nowrap">1</td> -->
                              <td class="f_14 text-nowrap"> <?= $cost ?> <?= $ctype  ?></td>
<!-- ====================================================================================== -->

                                <td class="f_14 text-nowrap"> 
                                <div class="mr-2 pt-2" style="cursor:pointer" onclick="buyNow('<?=$key['id']?>','<?= $cost ?>')"> <!-- data-toggle="modal" data-target="#buyNow"-->
                                 <span class="bg_17  text-decoration-none text-white py-2 px-2 rounded text-nowrap">Buy Now</span>
                                </div>
                              </td>


                                <td class="f_14 text-nowrap"> 
                                <div class="pt-2 cp" onclick="removeFromCart('<?=$key['id']?>')">
                                 <span class="bg_13 text-decoration-none  text-white py-2 px-2 rounded"><i class="fa fa-times"></i></span>
                                </div>
                                </td>



                              <!-- <td class="f_14 d-flex justify-content-center align-middle align-items-center">
                                 <div class="mr-2 pt-2">
                                 <a href="" class="bg_17  text-decoration-none text-white py-2 px-2 rounded text-nowrap">Buy Now</a>
                                </div>
                                <div class="mr-2 pt-2">
                                 <a href="" class="bg_20  text-decoration-none text-white py-2 px-2 rounded text-nowrap">Save for later</a>
                                </div>
                                <div class="pt-2">
                                 <a href="" class="bg_13 text-decoration-none  text-white py-2 px-2 rounded"><i class="fa fa-times"></i></a>
                                </div>
                              </td> -->


                            </tr>
<?php $id++; } ?>

          <tr>
            <td  colspan="6" class="mb-4 mt-2 text-center f_15 rt_14"> <span class="w-100 bg_18   text-decoration-none text-white py-2  px-2 rounded text-nowrap cp" data-toggle="modal" data-target="#MyWallet">Buy All Reports</span>
          </td>
            
          </tr>


<?php } else{ ?>

<tr>
  <td colspan="6" class="mb-4 mt-2 text-center f_15 rt_14"> <span class="w-100 bg-danger   text-decoration-none text-white py-2 px-2 rounded text-nowrap cp" >Cart is empty </span>
                        </td>
</tr>
<?php } ?>                    

                          </tbody>
                          </table>


                        </div>

                        

                       </div>
                       
                    </div>

<!-- =====================Save for==later====== -->
<?php  
$wallet_data = $this->admin->getWalletData($uemail,'user_wallet',$code);

?>
<input type="hidden" name="" id='walletAmount' value='<?php 
                              if($code=='IN')
                                echo $wallet_data[0]['amount'];
                              else
                                echo $wallet_data[0]['usdamount']; 
                            ?>'>

<!-- ================================================= -->



                   </div>




<?php include('cart_popup.php'); ?>
