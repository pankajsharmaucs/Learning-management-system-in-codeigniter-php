
   <!-- =======wallet====== -->

                <div class="company_list_body ad_wallet_body wallet dashboard_body  p-xl-3 p-lg-3 p-md-3" id="desktopMainPannel_2">
                   <div class="row col-lg-12 col-12 ">
                       <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 d-flex justify-content-between align-items-center  p-0 flex-wrap">
                         <div class="company_list_tabs d-flex justify-content-start align-items-center text-center  flex-wrap">
                              <div class="m-1 px-2 py-1 f_15 rt_14 active" onclick="companyTableBtn(1)">Wallet Users</div>
                              <!-- <div class="m-1 px-2 py-1 f_15 rt_14" onclick="companyTableBtn(2)">Wallet User Balance</div> -->
                              <div class="m-1 px-2 py-1 f_15 rt_14" onclick="companyTableBtn(3)">Wallet User Request</div>
                              <div class="m-1 px-2 py-1 f_15 rt_14" onclick="companyTableBtn(4)">Slabs</div>
                            </div>

                            <div class="search d-flex justify-content-start align-items-center mt-2  flex-wrap m-1">
                          
                            </div>


                       </div>

                       <div class="col-xl-12 col-lg-12 bg_7 col-md-12 col-sm-12 col-12 d-flex justify-content-between align-items-center  p-0 flex-wrap ad_content_heading">
                         <div class="d-flex justify-content-start align-items-center text-center  flex-wrap">
                              <div class="m-1 px-2 py-1 f_18 fw_600 rounded f_15 rt_15">Wallet</div>
                            </div>
                       </div>

                       <!-- -table-1 -->
                      
                       <div class="col-12 table_content p-0" id="companyListTable_1">
                        <div class="table-responsive">

                          <table class="table w-100 text-center">
                           <thead>
                            <tr class="bg-white text-center">
                              <th scope="col">#</th>
                              <th scope="col">User Id.</th>
                              <th scope="col">Currency</th>
                              <th scope="col">Amount</th>
                              <!-- <th scope="col">Units</th> -->
                              <th scope="col">Date</th>
                              <th scope="col">Transactions</th>
                            </tr>
                          </thead>
                          <tbody>
                            
<?php if($allWallelData){ $id=1; foreach ($allWallelData as $key ) { ?>
                            <tr class="text-center">   
                              <th scope="row" class="align-middle"><?= $id ?></th>
                              <td class="f_14 text-nowrap align-middle"><?= $key['user_id'] ?></td>
                              <td class="f_14 text-nowrap align-middle"><?= $key['amount_type'] ?></td>
                              <td class="f_14 text-nowrap align-middle"> <?= $key['amount'] ?></td>
                              <td class="f_14 text-nowrap align-middle"><?= $key['datetime'] ?></td>
                              <td class="f_14 text-nowrap align-middle"><button class="bg_2 p-1 border-0 text-white rounded ad_wallet_btn px-2">View All</button></td>
                            </tr>
<?php $id++;} } ?>
                          

                          </tbody>
                          </table>
                           

                                <!-- pagination -->
                          
                          <div class="admin_dashboard_wallet_pagination col-12 bg-white p-2 text-center">
                            <span class="f_15 fw_300">Showing <span class="fw_500">1</span> to <span class="fw_500">10 of 33</span> entries</span>
                            <div class="d-flex justify-content-center mt-3">
                              <div>Last</div>
                              <div class="active">1</div>
                              <div>....</div>
                              <div>3</div>
                              <div>Next</div>
                            </div>
                          </div>

                        

                        </div>
                       </div>

                       <!-- -table-2 -->

                       <div class="col-12 table_content wallet_user_balance p-0 py-2" id="companyListTable_2">
                        <div class="d-flex justify-content-end align-items-center"> 
                         <form class="wallet_user_balance_search d-flex justify-content-end align-items-center">
                             <select class=" py-1 mb-2 ml-1 f_13 tc_1" style="height: 31px;">
                           <option>Show Entries</option>
                           <option>---</option>
                           <option>---</option>
                           <option>---</option>
                           <option>---</option>
                         </select>
                             <input type="text" name="" class="mb-2 ml-1 py-1 pl-1 f_14" style="width: 120px;" placeholder="Search...">
                             <button class="border-0 bg_24 text-white ml-1 rounded mb-2 py-1 f_14" style="width: 50px;"><i class="fa fa-search"></i></button>
                           </form>

                         </div>
                        <div class="table-responsive">
                          <table class="table w-100">
                           <thead>
                            <tr class="bg-white text-center">
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">Country</th>
                              <th scope="col">Wallet Balance</th>
                              <th scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                          <tr class="text-center">
                              <th scope="row" class="align-middle">2</th>
                              <td class="f_14 text-nowrap align-middle">TATA COFFEE LIMITED</td>
                              <td class="f_14 text-nowrap align-middle">abc@gmail.com</td>
                              <td class="f_14 text-nowrap align-middle">India</td>
                              <td class="f_14 text-nowrap align-middle">&#8377; 1245</td>
                              <td class="f_14 text-nowrap align-middle"><button class="bg_25 p-1 border-0 text-white rounded px-2 wallet_user_balance_view_btn">View</button></td>
                            </tr>
                             <tr class="text-center">
                              <th scope="row" class="align-middle">2</th>
                              <td class="f_14 text-nowrap align-middle">TATA COFFEE LIMITED</td>
                              <td class="f_14 text-nowrap align-middle">abc@gmail.com</td>
                              <td class="f_14 text-nowrap align-middle">India</td>
                              <td class="f_14 text-nowrap align-middle">&#8377; 1245</td>
                              <td class="f_14 text-nowrap align-middle"><button class="bg_25 p-1 border-0 text-white rounded px-2">View</button></td>
                            </tr>
                             <tr class="text-center">
                              <th scope="row" class="align-middle">2</th>
                              <td class="f_14 text-nowrap align-middle">TATA COFFEE LIMITED</td>
                              <td class="f_14 text-nowrap align-middle">abc@gmail.com</td>
                              <td class="f_14 text-nowrap align-middle">India</td>
                              <td class="f_14 text-nowrap align-middle">&#8377; 1245</td>
                              <td class="f_14 text-nowrap align-middle"><button class="bg_25 p-1 border-0 text-white rounded px-2">View</button></td>
                            </tr>
                             <tr class="text-center">
                              <th scope="row" class="align-middle">2</th>
                              <td class="f_14 text-nowrap align-middle">TATA COFFEE LIMITED</td>
                              <td class="f_14 text-nowrap align-middle">abc@gmail.com</td>
                              <td class="f_14 text-nowrap align-middle">India</td>
                              <td class="f_14 text-nowrap align-middle">&#8377; 1245</td>
                              <td class="f_14 text-nowrap align-middle"><button class="bg_25 p-1 border-0 text-white rounded px-2">View</button></td>
                            </tr>
                             <tr class="text-center">
                              <th scope="row" class="align-middle">2</th>
                              <td class="f_14 text-nowrap align-middle">TATA COFFEE LIMITED</td>
                              <td class="f_14 text-nowrap align-middle">abc@gmail.com</td>
                              <td class="f_14 text-nowrap align-middle">India</td>
                              <td class="f_14 text-nowrap align-middle">&#8377; 1245</td>
                              <td class="f_14 text-nowrap align-middle"><button class="bg_25 p-1 border-0 text-white rounded px-2">View</button></td>
                            </tr>
                          </tbody>
                          </table>



                                 <!-- pagination -->
                          
                          <div class="admin_dashboard_wallet_pagination col-12 bg-white p-2 text-center">
                            <span class="f_15 fw_300">Showing <span class="fw_500">1</span> to <span class="fw_500">10 of 33</span> entries</span>
                            <div class="d-flex justify-content-center mt-3">
                              <div>Last</div>
                              <div class="active">1</div>
                              <div>....</div>
                              <div>3</div>
                              <div>Next</div>
                            </div>
                          </div>

                        </div>
                       </div>

                       <!-- -table-2-1 -->

                       <!-- ========wallet user balance view========== -->

                       <div class="col-12 table_content p-0 py-2 wallet_user_balance_view">
                        
                        <span class="rt_13 f_13 pl-3 tc_2 cp wallet_user_view_back_btn pt-1"><img src="<?=base_url('assets/')?>admin_dashboard_e/svg/right-arrow.svg" width="20px" alt="icon" class="mr-1" style="transform: rotate(180deg);"> Back to Wallet User List</span>
                        
                        <div class="d-flex justify-content-between mt-3 align-items-center flex-wrap-reverse"> 
                         <div class="user_name pt-2">
                           <h5 class="f_18 rt_16 p-2 fw_600 tc_7">Name: Abxz</h5>
                         </div>
                         <div>
                          <button class="bg_24 border-0 p-1 text-white rounded px-2 rt_14 f_15">Download Wallet Status</button>
                         </div>
                         <form class="wallet_user_balance_search pt-2 d-flex justify-content-end align-items-center">
                             <select class=" py-1 mb-2 ml-1 f_13 tc_1" style="height: 31px;">
                           <option>Show Entries</option>
                           <option>---</option>
                           <option>---</option>
                           <option>---</option>
                           <option>---</option>
                         </select>
                             <input type="text" name="" class="mb-2 ml-1 py-1 pl-1 f_14" style="width: 120px;" placeholder="Search...">
                             <button class="border-0 bg_24 text-white ml-1 rounded mb-2 py-1 f_14" style="width: 50px;"><i class="fa fa-search"></i></button>
                           </form>

                         </div>
                        <div class="table-responsive">
                          <table class="table w-100">
                           <thead>
                            <tr class="bg-white text-center">
                              <th scope="col">#</th>
                              <th scope="col">Status</th>
                              <th scope="col">Units</th>
                              <th scope="col">Date</th>
                              <th scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                          <tr class="text-center">
                              <th scope="row" class="align-middle">2</th>
                              <td class="f_14 text-nowrap align-middle">Credit</td>
                              <td class="f_14 text-nowrap align-middle">500</td>
                              <td class="f_14 text-nowrap align-middle">30-03-2021</td>
                              <td class="f_14 text-nowrap align-middle"><button class="bg_25 p-1 border-0 text-white rounded px-2">View</button></td>
                            </tr>
                              <tr class="text-center">
                              <th scope="row" class="align-middle">2</th>
                              <td class="f_14 text-nowrap align-middle">Credit</td>
                              <td class="f_14 text-nowrap align-middle">500</td>
                              <td class="f_14 text-nowrap align-middle">30-03-2021</td>
                              <td class="f_14 text-nowrap align-middle"><button class="bg_25 p-1 border-0 text-white rounded px-2">View</button></td>
                            </tr>
                             <tr class="text-center">
                              <th scope="row" class="align-middle">2</th>
                              <td class="f_14 text-nowrap align-middle">Credit</td>
                              <td class="f_14 text-nowrap align-middle">500</td>
                              <td class="f_14 text-nowrap align-middle">30-03-2021</td>
                              <td class="f_14 text-nowrap align-middle"><button class="bg_25 p-1 border-0 text-white rounded px-2">View</button></td>
                            </tr>
                             <tr class="text-center">
                              <th scope="row" class="align-middle">2</th>
                              <td class="f_14 text-nowrap align-middle">Credit</td>
                              <td class="f_14 text-nowrap align-middle">500</td>
                              <td class="f_14 text-nowrap align-middle">30-03-2021</td>
                              <td class="f_14 text-nowrap align-middle"><button class="bg_25 p-1 border-0 text-white rounded px-2">View</button></td>
                            </tr>
                             <tr class="text-center">
                              <th scope="row" class="align-middle">2</th>
                              <td class="f_14 text-nowrap align-middle">Credit</td>
                              <td class="f_14 text-nowrap align-middle">500</td>
                              <td class="f_14 text-nowrap align-middle">30-03-2021</td>
                              <td class="f_14 text-nowrap align-middle"><button class="bg_25 p-1 border-0 text-white rounded px-2">View</button></td>
                            </tr>
                             <tr class="text-center">
                              <th scope="row" class="align-middle">2</th>
                              <td class="f_14 text-nowrap align-middle">Credit</td>
                              <td class="f_14 text-nowrap align-middle">500</td>
                              <td class="f_14 text-nowrap align-middle">30-03-2021</td>
                              <td class="f_14 text-nowrap align-middle"><button class="bg_25 p-1 border-0 text-white rounded px-2">View</button></td>
                            </tr>
                          </tbody>
                          </table>

                                 <!-- pagination -->
                          
                          <div class="admin_dashboard_wallet_pagination col-12 bg-white p-2 text-center">
                            <span class="f_15 fw_300">Showing <span class="fw_500">1</span> to <span class="fw_500">10 of 33</span> entries</span>
                            <div class="d-flex justify-content-center mt-3">
                              <div>Last</div>
                              <div class="active">1</div>
                              <div>....</div>
                              <div>3</div>
                              <div>Next</div>
                            </div>
                          </div>

                        </div>
                       </div>

<!-- table-3  user wallet request  -->

                       <div class="col-12 table_content p-0 py-2 wallet_user_request" id="companyListTable_3">
                        <!-- <div class="d-flex justify-content-end align-items-center"> 
                         <form class=" wallet_user_balance_search d-flex justify-content-end align-items-center">
                             <select class=" py-1 mb-2 ml-1 f_13 tc_1" style="height: 31px;">
                           <option>Show Entries</option>
                           <option>---</option>
                           <option>---</option>
                           <option>---</option>
                           <option>---</option>
                         </select>
                             <input type="text" name="" class="mb-2 ml-1 py-1 pl-1 f_14" style="width: 120px;" placeholder="Search...">
                             <button class="border-0 bg_24 text-white ml-1 rounded mb-2 py-1 f_14" style="width: 50px;"><i class="fa fa-search"></i></button>
                           </form>
                         </div> -->
                        <div class="table-responsive">
                          <table class="table w-100">
                           <thead>
                            <tr class="bg-white text-center">
                              <th scope="col">#</th>
                              <th scope="col">Email</th>
                              <th scope="col">Currency</th>
                              <th scope="col">Request Balance</th>
                              <th scope="col">Date</th>
                              <th scope="col">Status</th>
                              <th scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            
<?php if($getWalletUserReq){ $id=1; foreach ($getWalletUserReq as $key ) { ?>

                     <tr class="text-center">
                        <th scope="row" class="align-middle"><?= $id ?></th>
                        <td class="f_14 text-nowrap align-middle"><?= $key['user_id'] ?></td>
                        <td class="f_14 text-nowrap align-middle"><?= $key['amount_type'] ?></td>
                        <td class="f_14 text-nowrap align-middle"> <?= $key['amount'] ?></td>
                        <td class="f_14 text-nowrap align-middle"><?= $key['created'] ?></td>
                        <td class="f_14 text-nowrap align-middle">
                          <?php
                          if($key['status']==0){ echo "Pending";}else{ echo "Approved";}
                         ?></td>
                        <td class="f_14 text-nowrap align-middle"><button class="bg_2 p-1 border-0 text-white rounded ad_wallet_btn px-2">Approve</button></td>
                    </tr>
<?php $id++;} } ?>

                          </tbody>
                          </table>
                        </div>

                              <!-- pagination -->
                          
                          <div class="admin_dashboard_wallet_pagination col-12 bg-white p-2 text-center">
                            <span class="f_15 fw_300">Showing <span class="fw_500">1</span> to <span class="fw_500">10 of 33</span> entries</span>
                            <div class="d-flex justify-content-center mt-3">
                              <div>Last</div>
                              <div class="active">1</div>
                              <div>....</div>
                              <div>3</div>
                              <div>Next</div>
                            </div>
                          </div>

                       </div>

                      

                       <!-- -table-4 -->

                      

                       <div class="col-12 table_content p-0 py-2 slabs" id="companyListTable_4">

<!-- ========add slabs========== -->
                             <!-- table-4-1 -->
                           
                          <div class="col-12  p-0 py-2 ">
                        <div class="d-flex justify-content-end align-items-center"> 
                          <button class="add_slabs_btn border-0 bg_24 text-white ml-1 rounded mb-2 py-1 f_14 px-2">Add Slabs</button>
                         </div>
                        <div class="table-responsive">
                          <table class="table w-100">
                           <thead>
                            <tr class="bg-white text-center">
                              <th scope="col">#</th>
                              <th scope="col">Credit Value</th>
                              <th scope="col">USD Credit Value</th>
                              <th scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>

<?php if($getCreditsvalue){ $id=1; foreach ($getCreditsvalue as $key ) { ?>
       
                             <tr class="text-center">
                              <th scope="row" class="align-middle"><?= $id ?></th>
                              <td class="f_14 text-nowrap align-middle"><?= $key['creditsvalue'] ?></td>
                              <td class="f_14 text-nowrap align-middle"><?= $key['usdcreditsvalue'] ?></td>
                              <td class="f_14 text-nowrap align-middle"><button class="bg_21 p-1 border-0 text-white rounded px-2 ad_edit_credit_btn">Edit</button></td>
                            </tr>
<?php $id++;} } ?>

                            

                          </tbody>
                          </table>
                        </div>

                       </div>



                        <div class="d-flex justify-content-end align-items-center"> 
                      
                         </div>
                        <div class="table-responsive d-none">
                          <table class="table w-100">
                           <thead>
                            <tr class="bg-white text-center">
                              <th scope="col">#</th>
                              <th scope="col">Slab</th>
                              <th scope="col">Credits</th>
                              <th scope="col">Amount</th>
                              <th scope="col">USD Amount</th>
                              <th scope="col">Discount</th>
                              <th scope="col">Status</th>
                              <th scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                             <tr class="text-center">
                              <th scope="row" class="align-middle">1</th>
                              <td class="f_14 text-nowrap align-middle">Slab 2</td>
                              <td class="f_14 text-nowrap align-middle">1000</td>
                              <td class="f_14 text-nowrap align-middle">12134</td>
                              <td class="f_14 text-nowrap align-middle">12134</td>
                              <td class="f_14 text-nowrap align-middle">10</td>
                              <td class="f_14 text-nowrap align-middle text-success">Active</td>
                              <!-- <td class="f_14 text-nowrap align-middle"><button class="bg_25 p-1 border-0 text-white rounded px-2 ad_wallet_user_request_btn">View</button></td> -->
                              <td class="f_14 d-flex justify-content-center align-middle align-items-center">
                                 <div class="mr-2 pt-2">
                                 <span href="" class="bg_21  text-decoration-none text-white py-2 px-2 rounded text-nowrap cp add_slabs_btn">Edit</span>
                                </div>
                                <div class="pt-2">
                                 <span href="" class="bg_13 text-decoration-none  text-white py-2 px-2 rounded cp"><i class="fa fa-times"></i></span>
                                </div>
                              </td>
                            </tr>
                            <tr class="text-center">
                              <th scope="row" class="align-middle">1</th>
                              <td class="f_14 text-nowrap align-middle">Slab 2</td>
                              <td class="f_14 text-nowrap align-middle">1000</td>
                              <td class="f_14 text-nowrap align-middle">12134</td>
                              <td class="f_14 text-nowrap align-middle">12134</td>
                              <td class="f_14 text-nowrap align-middle">10</td>
                              <td class="f_14 text-nowrap align-middle text-success">Active</td>
                              <!-- <td class="f_14 text-nowrap align-middle"><button class="bg_25 p-1 border-0 text-white rounded px-2 ad_wallet_user_request_btn">View</button></td> -->
                              <td class="f_14 d-flex justify-content-center align-middle align-items-center">
                                 <div class="mr-2 pt-2">
                                 <span href="" class="bg_21  text-decoration-none text-white py-2 px-2 rounded text-nowrap cp add_slabs_btn">Edit</span>
                                </div>
                                <div class="pt-2">
                                 <span href="" class="bg_13 text-decoration-none  text-white py-2 px-2 rounded cp"><i class="fa fa-times"></i></span>
                                </div>
                              </td>
                            </tr>
                            
                            <tr class="text-center">
                              <th scope="row" class="align-middle">1</th>
                              <td class="f_14 text-nowrap align-middle">Slab 2</td>
                              <td class="f_14 text-nowrap align-middle">1000</td>
                              <td class="f_14 text-nowrap align-middle">12134</td>
                              <td class="f_14 text-nowrap align-middle">12134</td>
                              <td class="f_14 text-nowrap align-middle">10</td>
                              <td class="f_14 text-nowrap align-middle text-success">Active</td>
                              <!-- <td class="f_14 text-nowrap align-middle"><button class="bg_25 p-1 border-0 text-white rounded px-2 ad_wallet_user_request_btn">View</button></td> -->
                              <td class="f_14 d-flex justify-content-center align-middle align-items-center">
                                 <div class="mr-2 pt-2">
                                 <span href="" class="bg_21  text-decoration-none text-white py-2 px-2 rounded text-nowrap cp add_slabs_btn">Edit</span>
                                </div>
                                <div class="pt-2">
                                 <span href="" class="bg_13 text-decoration-none  text-white py-2 px-2 rounded cp"><i class="fa fa-times"></i></span>
                                </div>
                              </td>
                            </tr>

                          </tbody>
                          </table>
                        </div>

                              <!-- pagination -->
                          
                         <!--  <div class="admin_dashboard_wallet_pagination col-12 bg-white p-2 text-center">
                            <span class="f_15 fw_300">Showing <span class="fw_500">1</span> to <span class="fw_500">10 of 33</span> entries</span>
                            <div class="d-flex justify-content-center mt-3">
                              <div>Last</div>
                              <div class="active">1</div>
                              <div>....</div>
                              <div>3</div>
                              <div>Next</div>
                            </div>
                          </div> -->

                       </div>
      
                    </div>
                   </div>



                   <!-- =======wallet view========= -->
            
                   <div class="ad_wallet_view py-2 pb-3">
                     <div class="col-xl-12 col-lg-12 bg_7 col-md-12 col-sm-12 col-12 d-flex justify-content-between align-items-center  p-0 flex-wrap">
                         <div class="d-flex justify-content-start align-items-center text-center  flex-wrap">
                              <div class="m-1 px-2 py-1 f_18 fw_600 rounded f_15 rt_15">Wallet User View</div>
                            </div>
                       </div>

                     <span class="rt_13 f_13 pl-3 tc_2 cp wallet_view_back_btn pt-1"><img src="<?=base_url('assets/')?>admin_dashboard_e/svg/right-arrow.svg" width="20px" alt="icon" class="mr-1" style="transform: rotate(180deg);"> Back to Wallet</span>

                     <div class="d-flex justify-content-center pt-3">
                        <div class="card_1 p-4 bg-white">
                             <div class="img text-center pb-3">
                               <img src="<?=base_url('assets/')?>admin_dashboard_e/image/profile.jpg" width="150px" alt="profile" class="rounded-circle">
                             </div>
                             <div class="">
                              <div>
                                <h4 class="f_15 fw_400">Order Id: <span class="fw_300 tc_1">aasdfasfabc</span></h4>
                                <h4 class="f_15 fw_400">Name: <span class="fw_300 tc_1">abc</span></h4>
                                <h4 class="f_15 fw_400">Transaction ID: <span class="fw_300 tc_1">abc</span></h4>
                              </div>
                               <div class="">
                                <h4 class="f_15 fw_400">Amount: <span class="fw_300 tc_1">abc</span></h4>
                                <h4 class="f_15 fw_400">Coin: <span class="fw_300 tc_1">abc</span></h4>
                                <h4 class="f_15 fw_400">Discount: <span class="fw_300 tc_1">abc</span></h4>
                               </div>
                             </div>
                        </div>
                     </div>

                    </div>



                    <!-- =======wallet user request view========= -->
            
                   <div class="ad_wallet_user_request_view py-2 pb-3">
                     <div class="col-xl-12 col-lg-12 bg_7 col-md-12 col-sm-12 col-12 d-flex justify-content-between align-items-center  p-0 flex-wrap">
                         <div class="d-flex justify-content-start align-items-center text-center  flex-wrap">
                              <div class="m-1 px-2 py-1 f_18 fw_600 rounded f_15 rt_15">Wallet User Request view</div>
                            </div>
                       </div>

                     <span class="rt_13 f_13 pl-3 tc_2 cp wallet_user_request_back_btn pt-1"><img src="<?=base_url('assets/')?>admin_dashboard_e/svg/right-arrow.svg" width="20px" alt="icon" class="mr-1" style="transform: rotate(180deg);"> Back to Wallet User Request</span>

                     <div class=" d-flex justify-content-center pt-3">
                        <div class="card_1 p-4 bg-white px-5">
                          <form>
                             <input type="text" name="" placeholder="Enter Amount" class="f_14 pl-2 mt-2" autofocus style="height: 34px" required>
                             <div class="mt-3">
                              <div class="">
                                <h4 class="f_15 fw_400 text-nowrap">Order Id: <span class="fw_300 tc_1 pl-1">aasdfasfabc</span></h4>
                                <h4 class="f_15 fw_400 text-nowrap">Name: <span class="fw_300 tc_1 pl-1">abc</span></h4>
                              </div>
                               <div class="">
                                <h4 class="f_15 fw_400 text-nowrap">Amount: <span class="fw_300 tc_1 pl-1">abc</span></h4>
                                <h4 class="f_15 fw_400 text-nowrap">Email: <span class="fw_300 tc_1 pl-1">abc</span></h4>
                                <h4 class="f_15 fw_400 text-nowrap">Approve Amount: <span class="fw_300 tc_1 pl-1">abc</span></h4>
                               </div>
                             </div>
                             <button class="px-2 p-1 bg_24 border-0 text-white rounded mt-3 f_15">Save</button>
                           </form>
                        </div>
                     </div>

                    </div>


                    <!-- =======Add slabs========= -->
            
                   <div class="ad_add_slabs py-2 pb-3">
                     <div class="col-xl-12 col-lg-12 bg_7 col-md-12 col-sm-12 col-12 d-flex justify-content-between align-items-center  p-0 flex-wrap">
                         <div class="d-flex justify-content-start align-items-center text-center  flex-wrap">
                              <div class="m-1 px-2 py-1 f_18 fw_600 rounded f_15 rt_15">Add Slabs</div>
                            </div>
                       </div>

                     <span class="rt_13 f_13 pl-3 tc_2 cp add_slabs_back_btn pt-1"><img src="<?=base_url('assets/')?>admin_dashboard_e/svg/right-arrow.svg" width="20px" alt="icon" class="mr-1" style="transform: rotate(180deg);"> Back to Slabs</span>

                     <div class=" d-flex justify-content-center pt-3">
                        <div class="card_1 p-4 bg-white px-5">
                          <form>
                            <div class="form-row">
                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                              <input type="text" name="" placeholder="Slab" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required>
                             </div>
                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                              <input type="text" name="" placeholder="Credits" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required>
                             </div>
                            </div>
                            <div class="form-row">
                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                              <input type="text" name="" placeholder="Amount" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required>
                             </div>
                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                              <input type="text" name="" placeholder="USD Amount" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required>
                             </div>
                            </div>
                            <div class="form-row">
                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                              <input type="text" name="" placeholder="Discount %" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required>
                             </div>
                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                              <input type="text" name="" placeholder="Start Date" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required>
                             </div>
                            </div>
                            <div class="form-row">
                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                              <input type="text" name="" placeholder="End Date" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required>
                             </div>
                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                              <select class="f_14 pl-2 mt-2 w-100" style="height: 34px">
                                <option>Status</option>
                                <option>Active</option>
                                <option>Inactive</option>
                              </select>
                             </div>
                            </div>
                             <button class="px-2 p-1 bg_24 border-0 text-white rounded mt-3 f_15">Save</button>
                           </form>
                        </div>
                     </div>

                    </div>


                    <!-- =======edit credit slabs========= -->
            
                   <div class="ad_edit_credit_slabs py-2 pb-3">
                     <div class="col-xl-12 col-lg-12 bg_7 col-md-12 col-sm-12 col-12 d-flex justify-content-between align-items-center  p-0 flex-wrap">
                         <div class="d-flex justify-content-start align-items-center text-center  flex-wrap">
                              <div class="m-1 px-2 py-1 f_18 fw_600 rounded f_15 rt_15">Edit Credit Slab</div>
                            </div>
                       </div>

                     <span class="rt_13 f_13 pl-3 tc_2 cp ad_edit_credit_back_btn pt-1"><img src="<?=base_url('assets/')?>admin_dashboard_e/svg/right-arrow.svg" width="20px" alt="icon" class="mr-1" style="transform: rotate(180deg);"> Back to Slabs</span>

                     <div class=" d-flex justify-content-center pt-3">
                        <div class="card_1 p-4 bg-white px-5">
                          <form>
                            <div class="form-row">
                             <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                              <input type="text" name="" placeholder="Credits Value" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required>
                             </div>
                             <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                              <input type="text" name="" placeholder="USD Credits Value" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required>
                             </div>
                            </div>
                          
                             <button class="px-2 p-1 bg_1 border-0 text-white rounded mt-3 f_15">Save</button>
                           </form>
                        </div>
                     </div>

                    </div>



                    

