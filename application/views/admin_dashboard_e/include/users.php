

<!-- =======All users ====== -->

                <div class="company_list_body ad_user_body dashboard_body p-xl-3 p-lg-3 p-md-3" id="desktopMainPannel_3">
                   <div class="row col-lg-12 col-12 ">
                      
                      <div class="col-xl-12 col-lg-12 bg_7 col-md-12 col-sm-12 col-12 d-flex justify-content-between align-items-center  p-0 flex-wrap">
                         <div class="d-flex justify-content-start align-items-center text-center  flex-wrap">
                              <div class="m-1 px-2 py-1 f_18 fw_600 rounded f_15 rt_18">All Users</div>
                            </div>
                       </div>

                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 d-flex justify-content-between align-items-center  p-0 flex-wrap">
                         <div class="all_users_tabs d-flex justify-content-start align-items-center text-center  flex-wrap">
                              <div class="m-1 px-2 py-1 f_15 rt_14 active" onclick="allUserBtn(1)">Clients / Prepaid Users</div>
                              <div class="m-1 px-2 py-1 f_15 rt_14" onclick="allUserBtn(2)">Production Users</div>
                              <div class="m-1 px-2 py-1 f_15 rt_14" onclick="allUserBtn(3)">Create Production Users</div>
                              <div class="m-1 px-2 py-1 f_15 rt_14" onclick="allUserBtn(4)">Create Admin</div>
                            </div>

                            <div class="search d-flex justify-content-start align-items-center mt-2  flex-wrap m-1">
                          
                            </div>


                       </div>

                      
                        

                       <!-- -table-1 -->
                      
                       <div class="col-12 p-0 m-1 allusers " id="alluserTable_1">
                         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-1 d-flex justify-content-between align-items-center  p-0 flex-wrap">
                         <div class="cart_tabs d-flex justify-content-start align-items-center text-center  flex-wrap">
                              <div class="m-1 px-2 py-1 bg_2 text-white rounded f_15 rt_14" data-toggle="modal" data-target="#AddUser">Add New User</div>
                              <!-- <div class ="m-1 px-2 py-1 bg_11 text-white rounded f_15 rt_14">Purchase by wallet</div> -->
                            </div>

                           <!--  <div class="search d-flex justify-content-start align-items-center mt-2  flex-wrap m-1">
                             <form>
                             <input type="date" name="" class="mb-2 py-1 pl-1 f_14" style="width: 120px;" placeholder="Enter From Date">
                             <input type="date" name="" class="mb-2 py-1 pl-1 f_14" style="width: 120px;" placeholder="Enter To Date">
                             <button class="border-0 bg_24 text-white rounded mb-2 py-1 f_14" style="width: 50px;">Reset</button>
                           </form>
                            </div> -->


                       </div>
                       
                       <!-- <div class="d-flex justify-content-end align-items-center col-12 p-1"> 
                         <form class="wallet_user_balance_search d-flex justify-content-end align-items-center">
                             <input type="text" name="" class="mb-2 ml-1 py-1 pl-1 f_14" style="width: 120px;" placeholder="Search...">
                             <button class="border-0 bg_24 text-white ml-1 rounded mb-2 py-1 f_14" style="width: 50px;"><i class="fa fa-search"></i></button>
                           </form>

                         </div> -->

                        <div class="table-responsive">

                          <table class="table w-100">
                           <thead>
                            <tr class="bg-white text-center">
                              <th scope="col">#</th>
                              <th scope="col">User ID</th>
                              <th scope="col">Full Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">Status</th>
                              <th scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>


<?php if($getAllusers){ $id=1; foreach ($getAllusers as $key ) { ?>

                             <tr class="text-center">
                               
                              <th scope="row" class="align-middle"><?= $id ?></th>
                              <td class="f_14 align-middle text-nowrap fw_600">271
                                
                                </td>
                              <td class="f_14 align-middle text-nowrap"><?= $key['name'] ?></td>
                              <td class="f_14 align-middle text-nowrap"><?= $key['email'] ?></td>
                              <td class="f_14 align-middle text-nowrap all_user_status">
                              <?php if($key['is_active']== 1 ){ ?>
                                   <span class="text-success"><b>Active</b></span>
                                <?php }else{ ?>
                                   <span class="text-danger"><b>Inactive</b></span>
                                <?php } ?>
                              </td>
                               <td class="f_14 d-flex justify-content-center align-middle align-items-center">
                                 <div class="mr-2 pt-2">
                                 <span href="" class="bg_16  text-decoration-none text-white py-2 px-2 rounded text-nowrap cp convert_postpaid_btn">Convert Postpaid</span>
                                </div>
                                <div class="mr-2 pt-2">
                                 <span href="" class="bg_15  text-decoration-none text-white py-2 px-2 rounded text-nowrap cp ">Password Reset</span>
                                </div>
                                <div class="pt-2">
                                 <span href="" class="bg_13 text-decoration-none  text-white py-2 px-2 rounded cp bg_21" data-toggle="modal" data-target="#EditUser">Edit</span>
                                </div>
                              </td>
                              
                            </tr>

<?php $id++;} } ?>

                           


                             <!-- <tr class="text-center">
                               
                              <th scope="row" class="align-middle"></th>
                              <td class="f_14 align-middle text-nowrap fw_600">
                                <h6 class="f_11 tc_1 fw_300"></h6>
                                </td>
                              <td class="f_14 align-middle text-nowrap"></td>
                              <td class="f_14 align-middle text-nowrap"></td>
                              <td class="f_14 align-middle text-nowrap"> </td>
                              <td class="f_14 align-middle">
                                
                              
                              </td>
                            </tr> -->


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


                       <!-- -table-2 -->
                      
                       <div class="col-12 p-0 m-1 allusers " id="alluserTable_2">
                        <div class="table-responsive">

                          <div class="d-flex justify-content-end align-items-center col-12 p-1"> 
                         <form class="wallet_user_balance_search d-flex justify-content-end align-items-center">
                             <input type="text" name="" class="mb-2 ml-1 py-1 pl-1 f_14" style="width: 120px;" placeholder="Search...">
                             <button class="border-0 bg_24 text-white ml-1 rounded mb-2 py-1 f_14" style="width: 50px;"><i class="fa fa-search"></i></button>
                           </form>

                         </div>

                          <table class="table w-100">
                           <thead>
                            <tr class="bg-white text-center">
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Assign Role</th>
                              <th scope="col">Email</th>
                              <th scope="col">Status</th>
                              <th scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>

<?php if($getProductionUsers){ $id=1; foreach ($getProductionUsers as $key ) { ?>
                            
                             <tr class="text-center">
                               
                              <th scope="row" class="align-middle"><?= $id ?></th>
                             
                              <td class="f_14 align-middle text-nowrap"><?= $key['username'] ?></td>
                              <td class="f_14 align-middle text-nowrap">
                                <?php 

                                 $assign = trim(str_replace('[','',$key['assign_to']));
                                 $assign = trim(str_replace(']','',$assign));
                                 $assign = trim(str_replace('"','',$assign));
                                 $assign = trim(str_replace(',',',<br>',$assign));
                                 echo $assign;
                                 

                                 ?>
                                  
                                </td>
                              <td class="f_14 align-middle text-nowrap"><?= $key['email'] ?></td>
                                   <td class="f_14 align-middle text-nowrap all_user_status">
                                      <?php if($key['is_active'] == 1 ){ ?>
                                           <span class="text-success"><b>Active</b></span>
                                        <?php }else{ ?>
                                           <span class="text-danger"><b>Inactive</b></span>
                                        <?php } ?>
                                  </td>
                               <td class="f_14 d-flex justify-content-center align-middle align-items-center">
                                 <div class="mr-2 pt-2">
                                 <span href="" class="bg_16  text-decoration-none text-white py-2 px-2 rounded text-nowrap cp " data-toggle="modal" data-target="#RoleAsign">Assign Role</span>
                                </div>
                                <div class="mr-2 pt-2">
                                 <span href="" class="bg_15  text-decoration-none text-white py-2 px-2 rounded text-nowrap cp ">Password Reset</span>
                                </div>
                              
                              </td>
                              
                            </tr>
<?php $id++;} } ?>




                          </tbody>
                          </table>
                        </div>
                       </div>


                        <!-- -table-3 -->
                      
                       <div class="col-12 p-0 m-1 allusers " id="alluserTable_3">
                        <div class="table-responsive">
                          <form >
                          <h4 class="text-center f_15 bg-white py-2">Assign Role to user</h4>
                          <div class="d-flex justify-content-around flex-wrap">
                            <div class="ml-3 my-2">
                              <div class="text-center">
                              <img src="<?=base_url('assets/admin_dashboard_e/svg/download-circular-button.svg')?>" width="30px" class="mr-2">
                              </div>
                              
                              <label class="box">Downloader
                                <input type="checkbox" checked="checked" name="role1" value="1" id="role1"
                                onclick="selectRole(1);" >
                                <span class="checkmark"></span>
                              </label>


                            </div>
                            <div class="ml-3 my-2">
                               <div class="text-center">
                              <img src="<?=base_url('assets/admin_dashboard_e/svg/businessman.svg')?>" width="30px" class="mr-2">
                              </div>
                             
                               <label class="box"> Data Analyst
                                <input type="checkbox" name="role2" value="0"  id="role2"
                                onclick="selectRole(2);">
                                <span class="checkmark"></span>
                              </label> 
                            </div>
                            <div class="ml-3 my-2">
                               <div class="text-center">
                              <img src="<?=base_url('assets/admin_dashboard_e/svg/analysis.svg')?>" width="30px" class="mr-2">
                              </div>
                             
                              <label class="box">Financial Analyst
                                <input type="checkbox"  name="role3"  value="0" id="role3"
                                onclick="selectRole(3);">
                                <span class="checkmark"></span>
                              </label>     
                            </div>
                          </div>
                           <div class=" d-flex justify-content-center pt-3">
                        <div class="card_1 col-12 p-4 bg-white px-5">
                            <div class="form-row">
                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                              <input type="text" name="" id="proUsername" placeholder="User Name" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required>
                             </div>
                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                              <input type="text" name="" id="proUserEmail" placeholder="Email" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required>
                             </div>
                            </div>
                            <div class="form-row">
                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                              <input type="text" name="" id="proUserpass" placeholder="Password" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required>
                             </div>
                             <!-- <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                              <input type="text" name="" id="proUsername" placeholder="Confirm Password" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required>
                             </div> -->
                            </div>
                            
                             <button class="px-2 p-1 bg_2 border-0 text-white rounded mt-3 f_15"
                             id="CreateProUser" >Create Production user</button>
                        </div>
                     </div>
                           </form>
                          
                        </div>
                       </div>


                       <!-- -table-4 -->
                      
                       <div class="col-12 p-0 m-1 allusers " id="alluserTable_4">
                        <div class="table-responsive">
                          
                           <div class=" d-flex justify-content-center pt-3">
                        <div class="card_1 p-4 bg-white px-5">
                          <form>
                            <div class="form-row">
                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                              <input type="text" name="" placeholder="User Name" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required>
                             </div>
                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                              <input type="text" name="" placeholder="Email" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required>
                             </div>
                            </div>
                            <div class="form-row">
                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                              <input type="text" name="" placeholder="Password" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required>
                             </div>
                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                              <input type="text" name="" placeholder="Confirm Password" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required>
                             </div>
                            </div>
                            
                             <button class="px-2 p-1 bg_4 border-0 text-white rounded mt-3 f_15">Create Admin</button>
                           </form>
                        </div>
                     </div>
                          
                        </div>
                       </div>


                       
                    </div>

                   </div>





                   <!--assign role model -->
                  <div class="modal fade" id="RoleAsign" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content rounded-0" style=" background-color: #ECF4FF!important;">
                        <div class="modal-header border-0" >
                          <h5 class="modal-title rt_17" id="exampleModalLongTitle "><img src="<?=base_url('assets/admin_dashboard_e/svg/role.svg')?>" width="30px" class="mr-2"> Role Assign to User</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body  d-flex justify-content-center align-items-center">
                          <!-- <div class="addMoney text-center">
                            <h4 class="f_20 fw_400 rt_15">Balance: <span class="fw_400 fw_300 text-success">253 &#8377;</span></h4>
                          </div> -->
                          <div class="d-flex justify-content-around flex-wrap">
                            <div class="ml-3 my-2">
                              <div class="text-center">
                              <img src="<?=base_url('assets/admin_dashboard_e/svg/download-circular-button.svg')?>" width="30px" class="mr-2">
                              </div>
                              
                              <label class="box">Downloader
                                <input type="checkbox" checked="checked">
                                <span class="checkmark"></span>
                              </label>


                            </div>
                            <div class="ml-3 my-2">
                               <div class="text-center">
                              <img src="<?=base_url('assets/admin_dashboard_e/svg/businessman.svg')?>" width="30px" class="mr-2">
                              </div>
                             
                               <label class="box">Data Analyst
                                <input type="checkbox" checked="checked">
                                <span class="checkmark"></span>
                              </label> 
                            </div>
                            <div class="ml-3 my-2">
                               <div class="text-center">
                              <img src="<?=base_url('assets/admin_dashboard_e/svg/analysis.svg')?>" width="30px" class="mr-2">
                              </div>
                             
                              <label class="box">Financial Analyst
                                <input type="checkbox" checked="checked">
                                <span class="checkmark"></span>
                              </label>     
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer border-0 d-flex justify-content-center">
                          <div class="bg_24 text-white p-2 rounded cp rt_15">Save</div>
                        </div>
                      </div>
                    </div>
                  </div>

                
                 <!--add user Modal -->
                  <div class="modal fade" id="AddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content rounded-0" style=" background-color: #ECF4FF!important;">
                        <div class="modal-header border-0" >
                          <h5 class="modal-title rt_17" id="exampleModalLongTitle "><img src="<?=base_url('assets/admin_dashboard_e/svg/follow.svg')?>" width="30px" class="mr-2"> Add User</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form>
                        <div class="modal-body request_money">
                          <div class="form-row ">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-2">
                             <input type="text" name="" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required placeholder="Full Name">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                             <input type="email" name="" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required placeholder="Email">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                             <input type="password" name="" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required placeholder="Password">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                             
                             <select class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px">
                               <option>Country</option>
                               <option>Country</option>
                               <option>Country</option>
                               <option>Country</option>
                             </select>
                            </div>

                           </div>
                         
                         <!--  <div class="addMoney text-center">
                            <h4 class="f_20 fw_400">Balance: <span class="fw_400 fw_300 text-success">253 &#8377;</span></h4>
                          </div> -->
                        </div>
                        <div class="modal-footer border-0 d-flex justify-content-center">
                          <div class="bg_24 text-white p-2 rounded cp rt_15">Submit</div>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>


                   <!--edit user Modal -->
                  <div class="modal fade" id="EditUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content rounded-0" style=" background-color: #ECF4FF!important;">
                        <div class="modal-header border-0" >
                          <h5 class="modal-title rt_17" id="exampleModalLongTitle "><img src="<?=base_url('assets/admin_dashboard_e/svg/user-3.svg')?>" width="30px" class="mr-2"> Edit User</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form>
                        <div class="modal-body request_money">
                          <div class="form-row ">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-2">
                             <input type="text" name="" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required placeholder="Full Name">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                             <input type="email" name="" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required placeholder="Email">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                             <input type="text" name="" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required placeholder="Add Credit">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                             
                             <select class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px">
                               <option>Country</option>
                               <option>Country</option>
                               <option>Country</option>
                               <option>Country</option>
                             </select>
                            </div>

                           </div>
                         
                         <!--  <div class="addMoney text-center">
                            <h4 class="f_20 fw_400">Balance: <span class="fw_400 fw_300 text-success">253 &#8377;</span></h4>
                          </div> -->
                        </div>
                        <div class="modal-footer border-0 d-flex justify-content-center">
                          <div class="bg_21 text-white p-2 rounded cp rt_15">Update</div>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>


                  <!-- =======convert postpaid========= -->
            
                   <div class="convert_post py-2 pb-3 d-none">
                     <div class="col-xl-12 col-lg-12 bg_7 col-md-12 col-sm-12 col-12 d-flex justify-content-between align-items-center  p-0 flex-wrap">
                         <div class="d-flex justify-content-start align-items-center text-center  flex-wrap">
                              <div class="m-1 px-2 py-1 f_18 fw_600 rounded f_15 rt_15">Convert Postpaid</div>
                            </div>
                       </div>

                     <span class="rt_13 f_13 pl-3 tc_2 cp ad_convert_postpaid_back_btn pt-1"><img src="<?=base_url('assets/')?>admin_dashboard_e/svg/right-arrow.svg" width="20px" alt="icon" class="mr-1" style="transform: rotate(180deg);"> Back to All Users</span>

                     <div class=" d-flex justify-content-center pt-3">
                        <div class="card_1 p-4 bg-white px-5">
                          <div class="card_1 p-4 bg-white px-5">
                          <form>
                            <div class="form-row">
                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                              <input type="text" name="" placeholder="Full Name" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required>
                             </div>
                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                              <input type="email" name="" placeholder="Email" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required>
                             </div>
                            </div>
                            <div class="form-row">
                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                              <input type="date" name="" placeholder="Start of Membership" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required>
                             </div>
                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                              <input type="date" name="" placeholder="End of Membership" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required>
                             </div>
                            </div>
                            <div class="form-row">
                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                               <select class="f_14 pl-2 mt-2 w-100" style="height: 34px">
                                <option>Max Report</option>
                                <option>Active</option>
                                <option>Inactive</option>
                              </select>
                             </div>
                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                               <select class="f_14 pl-2 mt-2 w-100" style="height: 34px">
                                <option>Max Number Of Report</option>
                                <option>Active</option>
                                <option>Inactive</option>
                              </select>
                             </div>
                            </div>
                            <div class="form-row">
                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                               <select class="f_14 pl-2 mt-2 w-100" style="height: 34px">
                                <option>Create Invoice on</option>
                                <option>Active</option>
                                <option>Inactive</option>
                              </select>
                             </div>
                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                               <select class="f_14 pl-2 mt-2 w-100" style="height: 34px">
                                <option>Purchase Status</option>
                                <option>Active</option>
                                <option>Inactive</option>
                              </select>
                             </div>
                            </div>

                            <div class="form-row">
                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                               <select class="f_14 pl-2 mt-2 w-100" style="height: 34px">
                                <option>Country</option>
                                <option>Active</option>
                                <option>Inactive</option>
                              </select>
                             </div>
                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                               <input type="text" name="" placeholder="Company Name" class="f_14 pl-2 mt-2 w-100" autofocus style="height: 34px" required>
                             </div>
                            </div>

                             <button class="px-2 p-1 bg_2 border-0 text-white rounded mt-3 f_15">Update Postpaid user</button>
                           </form>
                        </div>
                        </div>
                     </div>

                    </div>



                    

                   