    <!-- =======Wallet====== -->

                <div class="wallet_body dashboard_body p-xl-3 p-lg-3 p-md-3" id="desktopMainPannel_5">
                   <div class="purchase_history_body_1 row col-lg-12 col-12 ">
                       <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 d-flex justify-content-between align-items-center  p-0 flex-wrap">
                         <div class="wallet_tabs  justify-content-start align-items-center text-center  flex-wrap">
                              <div class="m-1 py-1 f_15 rt_14 active bg-success text-white rounded cp py-2 px-2 walletRechargeBtn d-flex justify-content-around align-items-center" data-toggle="modal" data-target="#WalletAddRequest">
                                <img src="<?=base_url('assets/user_dashboard_e/svg/wallet2.svg')?>" width="20px">
                                 Recharge Wallet</div>
                              <p class="f_12">Send Request to KreditAid to add money </p>

                            </div>

                             <div class="m-1 px-2 py-1 f_20 fw_600  rounded rt_12"> Wallet Bal: <span class="text-success  f_20"> <?= $userWalletCount[0]['amount'].' '.$ctype ?> </span></div>



                       <div class="col-xl-12 col-lg-12 bg_7 col-md-12 col-sm-12 col-12 d-flex justify-content-between align-items-center  p-0 flex-wrap">
                         <div class=" d-flex justify-content-between w-100 align-items-center text-center  flex-wrap">
                              <div class="m-1 px-2 py-1 f_18 fw_600 rounded rt_15 font-weight-bold">My Recharge Requests</div>
                              <!-- <div class="m-1 px-2 py-1 f_13 fw_600 rounded rt_12">Wallet Balance: <span class="pr-1">0</span> -->
                               
                              </div>
                            </div>
                       </div>

                       <!-- -table-1 -->
                      
                       <div class="col-12  p-0" >
                        <div class="table-responsive">

                          <table class="table w-100 text-center">
                           <thead>
                            <tr class="bg-white">
                              <!-- <td scope="col">#</td> -->
                              <td scope="col">Transaction ID</td>
                              <td scope="col">Amount</td>
                              <!-- <td scope="col">Units</td> -->
                              <td scope="col">Recharge Date</td>
                              <td scope="col">Status</td>
                              
                            </tr>
                          </thead>
                          <tbody>
                                                     

<?php 
  $getUserRechargeReq=$this->admin->getUserRechargeReq($uemail,$tbl2,'cart');
  if($getUserRechargeReq){ $id=1; foreach ($getUserRechargeReq as $key ) {



    $d=$key['created'];
    $odate = date("d-M-Y", strtotime($d));



?>
                          <tr >
                              <!-- <td scope="row" class="align-middle"><?= $id ?></td>       -->
                              <td class="align-middle f_14 text-nowrap fw_600"><?= $key['id'] ?></td>
                              <td class="align-middle f_14 text-nowrap"><?= $key['amount'] ?> <?= $ctype ?></td>
                              <td class="align-middle f_14 text-nowrap"><?= $odate ?></td>
                              <td class="align-middle text-danger f_14"><?php
                              if($key['status']==0){ echo "Pending";}else{ echo "Deposited"; }?></td>
                        </tr>
<?php $id++; } } ?>





                          </tbody>
                          </table>


                        </div>
                       </div>
                    </div>

                   </div>











<!--wallet addmoney POPUP -->
                  <div class="modal fade" id="WalletAddRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content rounded-0" style=" background-color: #fff!important;">
                        <div class="modal-header border-0" >
                          <h5 class="modal-title rt_17" id="exampleModalLongTitle "><img src="<?=base_url('assets/user_dashboard_e/svg/add.svg')?>" width="30px" class="mr-2"> Send Money Request( in <?= $ctype  ?> )</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        
                        <form>
                        <div class="modal-body request_money">
                        <div class="alert alert-success" id="requestMoneyRes" style="display:none"></div>
                          <div class="form-row ">
                  <div class="col-12 mb-2">
                   <input type="text" name="" id="requestMoneyAmount" class="w-100 rt_14" placeholder="Enter Amount" required 
                   onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                  </div>
                            <div class="col-12">
                             <input type="text" name=""  id="requestMoneyComment" class="w-100 rt_14" placeholder="Additional Comment" required>
                            </div>
                           </div>
                         
                         <!--  <div class="addMoney text-center">
                            <h4 class="f_20 fw_400">Balance: <span class="fw_400 fw_300 text-success">253 &#8377;</span></h4>
                          </div> -->
                        </div>
                        <div class="modal-footer border-0 d-flex justify-content-center">
                          <button class=" border-0 bg_11 text-white p-2 rounded cp rt_15" id="sendMoneyRequest">Send Request</button>

                        </div>
                      </form>
                      </div>
                    </div>
                  </div>

                 