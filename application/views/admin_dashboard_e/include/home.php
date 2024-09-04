 <!-- =======dashboard_content====== -->

                <div class="dashboard_body p-xl-3 p-lg-3 p-md-3" id="desktopMainPannel_1">

                   <div class="row col-xl-12 col-lg-12 col-12 ">
                    
                    <div class="col-12 my-2">
                      <h4 class="f_20 rt_17 pt-2">Overview</h4>
                    </div>

                       <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-xl-1 mb-lg-1 mb-md-1 mb-sm-1 mb-2 px-xl-2 px-xl-2 p-md-2 p-sm-2 p-0">
                           <div class="d-flex justify-content-between dashboard_card bg-white p-3">

                            <div>
                            <h3 class="f_13 mb-4 fw_500 rt_15">Total Companies</h3>
                            <h4 class="f_20 rt_20"><?= $comp_count ?></h4>
                           
                             
                          </div>
                          <div class="d-flex align-items-center justify-content-center">
                            <div>
                              
                               <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/office-building.svg" width="20px" alt="">
                             
                            </div>
                          </div> 
                           </div>
                       </div>

                       <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-xl-1 mb-lg-1 mb-md-1 mb-sm-1 mb-2 px-xl-2 px-xl-2 p-md-2 p-sm-2 p-0">
                           <div class="d-flex justify-content-between dashboard_card bg-white p-3">
                            <div>
                            <h3 class="f_13 mb-4 fw_500 rt_15">Total Sales</h3>
                            <h4 class="f_20 rt_20"><?= $sales_count ?></h4>
                             
                          </div>
                          <div class="d-flex align-items-center justify-content-center">
                            <div>
                              
                                <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/sales.svg" width="20px" alt="">
                              
                              
                            </div>
                          </div> 
                           </div>
                       </div>

                       <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-xl-1 mb-lg-1 mb-md-1 mb-sm-1 mb-2 px-xl-2 px-xl-2 p-md-2 p-sm-2 p-0">
                           <div class="d-flex justify-content-between dashboard_card bg-white p-3">
                            <div>
                            <h3 class="f_13 mb-4 fw_500 rt_15">Total INR Revenue</h3>
                            <h4 class="f_20 rt_20">&#8377; <?= $inrRevenue ?></h4>
                             
                          </div>
                          <div class="d-flex align-items-center justify-content-center">
                            <div>
                              
                             

                               <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/business-and-finance.svg" width="20px" alt="icon">
                              
                            </div>
                          </div> 
                           </div>
                       </div>
                       <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-xl-1 mb-lg-1 mb-md-1 mb-sm-1 mb-2 px-xl-2 px-xl-2 p-md-2 p-sm-2 p-0">
                           <div class="d-flex justify-content-between dashboard_card bg-white p-3">
                            <div>
                            <h3 class="f_13 mb-4 fw_500 rt_15">Total USD Revenue</h3>
                            <h4 class="f_20 rt_20">&#36; <?= $usdRevenue ?></h4>
                             
                          </div>
                          <div class="d-flex align-items-center justify-content-center">
                            <div>
                              
                             

                               <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/sales-2.svg" width="20px" alt="icon">
                              
                            </div>
                          </div> 
                           </div>
                       </div>
                          
                       

                       <div class="col-12 my-2">
                      <h4 class="f_20 rt_17 pt-2">Orders</h4>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-xl-1 mb-lg-1 mb-md-1 mb-sm-1 mb-2 px-xl-2 px-xl-2 p-md-2 p-sm-2 p-0">
                           <div class="d-flex justify-content-between dashboard_card bg-white p-3">
                            <div>
                            <h3 class="f_13 mb-4 fw_500 rt_15">Total Orders</h3>
                            <h4 class="f_20 rt_20"><?= $getAllOrders ?></h4>
                             
                          </div>
                          <div class="d-flex align-items-center justify-content-center">
                            <div>
                              
                             

                               <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/box-2.svg" width="20px" alt="">
                              
                            </div>
                          </div> 
                           </div>
                       </div>

                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-xl-1 mb-lg-1 mb-md-1 mb-sm-1 mb-2 px-xl-2 px-xl-2 p-md-2 p-sm-2 p-0">
                           <div class="d-flex justify-content-between dashboard_card bg-white p-3">
                            <div>
                            <h3 class="f_13 mb-4 fw_500 rt_15">Today Orders</h3>
                            <h4 class="f_20 rt_20"><?= $getTodayOrders ?></h4>
                             
                          </div>
                          <div class="d-flex align-items-center justify-content-center">
                            <div>
                              
                               <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/calendar-1.svg" width="20px" alt="">
                              
                            </div>
                          </div> 
                           </div>
                       </div>


                       <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-xl-1 mb-lg-1 mb-md-1 mb-sm-1 mb-2 px-xl-2 px-xl-2 p-md-2 p-sm-2 p-0">
                           <div class="d-flex justify-content-between dashboard_card bg-white p-3">
                            <div>
                            <h3 class="f_13 mb-4 fw_500 rt_15">All Clients</h3>
                            <h4 class="f_20 rt_20"><?= $getClientsCount ?></h4>
                             
                          </div>
                          <div class="d-flex align-items-center justify-content-center">
                            <div>
                              
                             

                               <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/group.svg" width="20px" alt="icon">
                              
                            </div>
                          </div> 
                           </div>
                       </div>

                       <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-xl-1 mb-lg-1 mb-md-1 mb-sm-1 mb-2 px-xl-2 px-xl-2 p-md-2 p-sm-2 p-0">
                           <div class="d-flex justify-content-between dashboard_card bg-white p-3">
                            <div>
                            <h3 class="f_13 mb-4 fw_500 rt_15">Production Emp.</h3>
                            <h4 class="f_20 rt_20"><?= $getEmpCount ?></h4>
                             
                          </div>
                          <div class="d-flex align-items-center justify-content-center">
                            <div>
                              
                             

                               <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/user-2.svg" width="20px" alt="icon">
                              
                            </div>
                          </div> 
                           </div>
                       </div>


                       <div class="col-12 my-2">
                      <h4 class="f_20 rt_17 pt-2">Users Data</h4>
                    </div>


                       <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-xl-1 mb-lg-1 mb-md-1 mb-sm-1 mb-2 px-xl-2 px-xl-2 p-md-2 p-sm-2 p-0">
                           <div class="d-flex justify-content-between dashboard_card bg-white p-3">
                            <div>
                            <h3 class="f_13 mb-4 fw_500 rt_15">Charges</h3>
                            <h4 class="f_20 rt_20"><?= $getChargesCount ?></h4>
                             
                          </div>
                          <div class="d-flex align-items-center justify-content-center">
                            <div>
                              
                             

                               <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/wedding-cost.svg" width="20px" alt="icon">
                              
                            </div>
                          </div> 
                           </div>
                       </div>

                       <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-xl-1 mb-lg-1 mb-md-1 mb-sm-1 mb-2 px-xl-2 px-xl-2 p-md-2 p-sm-2 p-0">
                           <div class="d-flex justify-content-between dashboard_card bg-white p-3">
                            <div>
                            <h3 class="f_13 mb-4 fw_500 rt_15">Full Company </h3>
                            <h4 class="f_20 rt_20"><?= $getFullComReportCount ?></h4>
                             
                          </div>
                          <div class="d-flex align-items-center justify-content-center">
                            <div>
                              
                             

                               <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/pie-chart.svg" width="20px" alt="icon">
                              
                            </div>
                          </div> 
                           </div>
                       </div>

                       <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-xl-1 mb-lg-1 mb-md-1 mb-sm-1 mb-2 px-xl-2 px-xl-2 p-md-2 p-sm-2 p-0">
                           <div class="d-flex justify-content-between dashboard_card bg-white p-3">
                            <div>
                            <h3 class="f_13 mb-4 fw_500 rt_15">Track Company</h3>
                            <h4 class="f_20 rt_20"><?= $gettrackCount ?></h4>
                             
                          </div>
                          <div class="d-flex align-items-center justify-content-center">
                            <div>
                              
                             

                               <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/track.svg" width="20px" alt="icon">
                              
                            </div>
                          </div> 
                           </div><!-- fill="#03506F" -->
                       </div>

                       <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-xl-1 mb-lg-1 mb-md-1 mb-sm-1 mb-2 px-xl-2 px-xl-2 p-md-2 p-sm-2 p-0">
                           <div class="d-flex justify-content-between dashboard_card bg-white p-3">
                            <div>
                            <h3 class="f_13 mb-4 fw_500 rt_15">Enq. Tickets</h3>
                            <h4 class="f_20 rt_20"><?= $getTicketCounts ?></h4>
                             
                          </div>
                          <div class="d-flex align-items-center justify-content-center">
                            <div>
                              
                             

                               <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/file.svg" width="20px" alt="icon">
                              
                            </div>
                          </div> 
                           </div>
                       </div>

                       

                       <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-xl-1 mb-lg-1 mb-md-1 mb-sm-1 mb-2 px-xl-2 px-xl-2 p-md-2 p-sm-2 p-0">
                           <div class="d-flex justify-content-between dashboard_card bg-white p-3">
                            <div>
                            <h3 class="f_13 mb-4 fw_500 rt_15">Wallet User</h3>
                            <h4 class="f_20 rt_20"><?= $getWalletUserCount ?></h4>
                             
                          </div>
                          <div class="d-flex align-items-center justify-content-center">
                            <div>
                              
                             

                               <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/wallet-4.svg" width="20px" alt="icon">
                              
                            </div>
                          </div> 
                           </div>
                       </div>

                       <!-- <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-xl-1 mb-lg-1 mb-md-1 mb-sm-1 mb-2 px-xl-2 px-xl-2 p-md-2 p-sm-2 p-0">
                           <div class="d-flex justify-content-between dashboard_card bg-white p-3">
                            <div>
                            <h3 class="f_13 mb-4 fw_500 rt_15">User Wallet Users</h3>
                            <h4 class="f_20 rt_20">23423</h4>
                             
                          </div>
                          <div class="d-flex align-items-center justify-content-center">
                            <div>
                              
                             

                               <img src="<?=base_url('assets/')?>admin_dashboard_e/svg/sales-2.svg" width="20px" alt="icon">
                              
                            </div>
                          </div> 
                           </div>
                       </div> -->
                       <!-- ================End==== -->
                    </div>
                   </div>