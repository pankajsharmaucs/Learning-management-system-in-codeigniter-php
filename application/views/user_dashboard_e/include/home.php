 <!-- =======dashboard_content====== -->

                <div class="dashboard_body p-xl-3 p-lg-3 p-md-3" id="desktopMainPannel_1">

                   <div class="row col-xl-12 col-lg-12 col-12">

                       <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-3 px-xl-2 px-xl-2 p-md-2 p-sm-2 p-0">
                           <div  class="dataBox d-flex justify-content-between dashboard_card bg-white p-3">

                            <div>
                            <h3 class="f_15 mb-4 fw_500 rt_15">Full company report</h3>
                            <h4 class="f_20 rt_20"><?= $fullComCount ?></h4>
                           
                             
                          </div>
                          <div class="d-flex align-items-center justify-content-center">
                            <div>
                              
                               <i class="fas fa-sticky-note f_20 tc_2"></i>
                             
                            </div>
                          </div> 
                           </div>
                       </div>

                       <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-3 px-xl-2 px-xl-2 p-md-2 p-sm-2 p-0">
                           <div class="dataBox d-flex justify-content-between dashboard_card bg-white p-3">
                            <div>
                            <h3 class="f_15 mb-4 fw_500 rt_15">Total Wallet Balance</h3>
                            <h4 class="f_20 rt_20"><?= $userWalletCount[0]['amount'].' '.$ctype ?></h4>
                             
                          </div>
                          <div class="d-flex align-items-center justify-content-center">
                            <div>
                                <i class="fas fa-wallet f_20 text-success"></i>
                              
                            </div>
                          </div> 
                           </div>
                       </div>
                          
                       <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-3 px-xl-2 px-xl-2 p-md-2 p-sm-2 p-0">
                           <div class=" dataBox d-flex justify-content-between dashboard_card bg-white p-3">
                            <div>
                            <h3 class="f_15 mb-4 fw_500 rt_15">Total Orders</h3>
                            <h4 class="f_20 rt_20"><?= $getAllOrdersCount ?></h4>
                             
                          </div>
                          <div class="d-flex align-items-center justify-content-center">
                            <div>
                                <i class="fas fa-box-open f_20 text-warning"></i>
                              
                            </div>
                          </div>  
                           </div>
                       </div>
                    </div>
                   </div>