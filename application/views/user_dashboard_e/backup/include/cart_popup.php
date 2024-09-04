<!-- ================Buy==single from cart===  -->

<input type="hidden" name="" id="buyNowTrigger" data-toggle="modal" data-target="#buyNow">
                  <!--buy now Modal -->
                  <div class="modal fade" id="buyNow" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content rounded-0" style=" background-color: #ECF4FF!important;">
                        <div class="modal-header border-0" >

                          <div class="d-flex align-items-center ">
                            <h5 class="modal-title rt_17" id="exampleModalLongTitle "><img src="<?=base_url('assets/user_dashboard_e/svg/wallet-3.svg')?>" width="30px" class="mr-2"> My Wallet</h5>
                          </div>
                          
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        
                        <div class="modal-body  d-flex justify-content-center align-items-center">
                          <div class="addMoney text-left col-12">
                          
                            <h4 class="f_20 fw_400 rt_15">Balance: 
                              <span class="fw_400 fw_300 text-success totalBalance">
                              <?=  $userWalletCount[0]['amount'].' '.$ctype ?>
                              </span>
                            </h4>

                            <h4 class="f_20 fw_400 rt_15 ">Report Cost: 
                              
                               <span class="fw_400 fw_300 text-primary ReportPrice">
                                <input type="text" name="" id="ReportPrice">
                              </span>
                              <span class="text-primary">
                                <?= $ctype ?>
                              </span>
                            </h4>

                            

                             <h4 class="f_20 fw_400 rt_15 ">Status:
                              <span class="amountNoticeByOneItem"></span>
                            </h4>

                            


                          </div>
                        </div>
                        
                        <!-- <div id='buyNowNotice' class="alert alert-success">sdasasa<div> -->
                        <div class="modal-footer border-0 d-flex justify-content-center">
                          <div class="bg_11 text-white p-2 rounded cp AddWalletBtn rt_15" data-toggle="modal" data-target="#AddRequest" data-dismiss="modal" aria-label="Close">Add Money to Wallet</div>
                          <div class="bg_17 text-white p-2 rounded cp rt_15 continueForOne">Continue &nbsp;<span id='buyNowLoader' class=""></span></div>
                        </div>
                        
                      </div>
                    </div>
                  </div>




<!--Buy All Report by cart button and model -->
   <input type="hidden" name="" id="MyWalletTrigger" data-toggle="modal" data-target="#MyWallet">

               <div class="modal fade" id="MyWallet" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content rounded-0" style=" background-color: #ECF4FF!important;">
                        <div class="modal-header border-0" >
                          <h5 class="modal-title rt_17" id="exampleModalLongTitle "><img src="<?=base_url('assets/user_dashboard_e/svg/wallet-3.svg')?>" width="30px" class="mr-2"> My Wallet</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body  d-flex justify-content-center align-items-center">
                          <div class="addMoney text-center">
                            <h4 class="f_20 fw_400 rt_15">Balance: 
                            <span class="fw_400 fw_300 text-success totalBalance">
                            <?= $wallet_data[0]['amount'].' '.$ctype  ?>
                            </span>
                          </h4>

                          <h4 class="f_20 fw_400 rt_15">Price: 
                            <span class="fw_400 fw_300 text-success totalBalance">
                            <?= $sumofcart.' '.$ctype  ?>
                            </span>
                          </h4>

                          </div>  
                        </div>
                        <div class="text-center">
                            <span class="text-danger amountNotice">
                              <?php 
                                if($wallet_data[0]['amount'] < $sumofcart){echo 'Insufficient Balance';} 
                              ?>
                            </span>  
                          </div>


                        <div class="modal-footer border-0 d-flex justify-content-center">
                          <div class="bg_11 text-white p-2 rounded cp AddWalletBtn rt_15 " data-toggle="modal" data-target="#AddRequest" data-dismiss="modal" aria-label="Close">Add Money to Wallet</div>

                          <?php if($wallet_data[0]['amount'] >= $sumofcart){ ?>
                            <div class="bg_17 text-white p-2 rounded cp rt_15 continueForAll">Continue &nbsp;<span id='buyNowLoader' class=""></span></div>
                          <?php } ?>

                         
                          </div>

                      </div>
                    </div>
                  </div>


<!-- ========================Add money==to==Wallet==form==== -->
                
                 <!--addmoney Modal -->
                  <div class="modal fade" id="AddRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content rounded-0" style=" background-color: #ECF4FF!important;">
                        <div class="modal-header border-0" >
                          <h5 class="modal-title rt_17" id="exampleModalLongTitle "><img src="<?=base_url('assets/user_dashboard_e/svg/add.svg')?>" width="30px" class="mr-2">Send Money Request to admin

                          </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        
                        <form>
                        <div class="modal-body request_money">
                        <div id="requestMoneyResp" class="alert alert-danger" style='display:none'></div>
                          <div class="form-row ">
                            <div class="col-12 mb-2">
                              <label>
                             <?php if($country == 'India'){echo 'Money amount in INR'; }else{ echo 'Money amount in USD';} ?> 
                           </label>
                             <input type="text" name="" class="w-100 rt_14" id="addMoneyAmount" placeholder="Enter Money" required onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                            </div>
                            <div class="col-12">
                             <input type="text" name="" class="w-100 rt_14" id="addMoneyComment" placeholder="Message" required>
                            </div>
                           </div>
                         
                         <!--  <div class="addMoney text-center">
                            <h4 class="f_20 fw_400">Balance: <span class="fw_400 fw_300 text-success">253 &#8377;</span></h4>
                          </div> -->
                        </div>
                        <div class="modal-footer border-0 d-flex justify-content-center">
                          <button class=" border-0 bg_11 text-white p-2 rounded cp rt_15 addMoneyRequest">Send Request</button>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>



                   

<!-- ====================payment==Confirmation===Popup=============== -->
<input type="hidden" name="" id="PaidPopupTrgger" data-toggle="modal" data-target="#PaidPopup">
                  <!--buy now Modal -->
                  <div class="modal fade" id="PaidPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content rounded-0" style=" background-color: #ECF4FF!important;">
                        <div class="modal-header border-0" >

                          <div class="d-flex align-items-center ">
                            <h5 class="modal-title rt_17" id="exampleModalLongTitle "><img src="<?=base_url('assets/user_dashboard_e/svg/wallet-3.svg')?>" width="30px" class="mr-2"> Transaction Status</h5>
                          </div>
                          
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        
                        <div class="modal-body  d-flex justify-content-center align-items-center">
                          <div class="addMoney text-center col-12">
                          
                            
                            

                             <h4 class="f_20 fw_400 rt_15 "> Report Payment Successfully, Our Team will send your Report within 12hrs.</h4>

                            


                          </div>
                        </div>
                        
                        <!-- <div id='buyNowNotice' class="alert alert-success">sdasasa<div> -->
                        <!-- <div class="modal-footer border-0 d-flex justify-content-center">
                          <a href="<?= base_url('/')?>User_Dashboard?a=2"><div class="bg_11 text-white p-2 rounded cp  rt_15">Check Report List</div></a>
                          <a href="<?= base_url('/')?>User_Dashboard?a=5"><div class="bg_17 text-white p-2 rounded cp rt_15 ">My Wallet &nbsp;</div></a>
                        </div> -->
                      </div>
                    </div>
                  </div>



<input type="hidden" name="" id="removeCartId" >

<!-- ====================Remove Confirm Popup=============== -->
<input type="hidden" name="" id="removePopupBtn" data-toggle="modal" data-target="#removePopup">
                  <!--buy now Modal -->
                  <div class="modal fade" id="removePopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content rounded-0" style=" background-color: #ECF4FF!important;">
                        <div class="modal-header border-0" >

                          <div class="d-flex align-items-center ">
                            <h5 class="modal-title rt_17" id="exampleModalLongTitle "><img src="<?=base_url('assets/user_dashboard_e/svg/delete.svg')?>" width="30px" class="mr-2"> Remove Confirmation</h5>
                          </div>
                          
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        
                        <div class="modal-body  d-flex justify-content-center align-items-center">
                          <div class="addMoney text-center col-12">
                          
                            
                            

                             <h4 class="f_20 fw_400 rt_15 "> Do You want to remove this from cart? </h4>

                            


                          </div>
                        </div>
                        
                        <!-- <div id='buyNowNotice' class="alert alert-success">sdasasa<div> -->
                        <div class="modal-footer border-0 d-flex justify-content-center">
                         <div class="bg_11 text-white p-2 rounded cp  rt_15" onclick="removeNow()">Yes, Confirm</div>
                          <div class="bg-danger text-white p-2 rounded cp rt_15" onclick="cancelremoveNow()" >Cancel</div>
                        </div>
                      </div>
                    </div>
                  </div>








