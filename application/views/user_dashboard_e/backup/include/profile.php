    <!-- =======profile====== -->

                <div class="profile_body dashboard_body p-xl-3 p-lg-3 p-md-3" id="desktopMainPannel_8">
                   <div class="profile_body_1 row col-lg-12 col-12 ">
                       <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 p-0 flex-wrap">
                        <div class="row">
                          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 text-center  f_18 rt_15 fw_500 ">
                           <span class="bg_7 p-2 d-block shadow-sm">Profile Information</span>
                           <div class="profile_img pt-3 bg-white shadow-sm d-flex justify-content-center pb-2">
                            <div>
                             <img src="<?=base_url('assets/')?>user_dashboard_e/image/profile.png" alt="" width="200px">
                             <div class="profile_content mt-3">
                               <h4 class="f_14 fw_400">Full Name : <span class="f_13 fw_300"><?= $c_data[0]->name ?></span></h4>
                               <h4 class="f_14 fw_400">Email id : <span class="f_13 fw_300"><?= $uemail ?></span></h4>
                               <h4 class="f_14 fw_400">Country : <span class="f_13 fw_300">
                                 <?= $c_data[0]->country_id ?>
                               </span></h4>
                               <!-- <h4 class="f_14 fw_400">Company Name : <span class="f_13 fw_300">Xyz company</span></h4> -->
                             </div>
                            </div>
                           </div>
                          </div>
                          <div class="col-md-6 col-12 ">
                           <div class="row">
                             <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12  f_18 rt_15 fw_500 ">
                           <span class="bg_7 p-2 d-block">Update Information</span>
                           <div class="profile_update pt-3 pb-3">
                            <div>
                              <form class="px-2" action="UpdateProfile" method="post">
                            <div class="form-row">
                              <div class="form-group col-xl-6 col-lg-6 col-md-6">
                                <input type="email" class="w-100"  id="" placeholder="Email Address" value="<?= $uemail ?>"
                                readonly >
                              </div>
                               <div class="form-group col-xl-6 col-lg-6 col-md-6"> 
                                <input type="text" class="w-100" id="" name="name" placeholder="Full Name" value="<?= $c_data[0]->name ?>">
                              </div>
                             
                              
                            </div>

                            <div class="form-row">
                              <div class="form-group col-xl-6 col-lg-6 col-md-6">

                                <!-- <input type="text" class="w-100" id="" name="name" placeholder="Full Name" > -->
                               
                                
                                   <div  style="position: relative;">
                                     <select class="w-100" name="country" required style="appearance: none;">
                                      <option value="<?= $c_data[0]->country ?>"><?= $c_data[0]->country ?></option>
                                      <option value="India">India</option>
                                      <option value="USA">USA</option>
                                    </select>

                                    <i class="fas fa-caret-down" style="position: absolute;right: 12px;top:12px;color:#ccc"></i>
                                   </div>

                              </div>

                              <div class="form-group col-xl-6 col-lg-6 col-md-6" style="position: relative;">
                               
                               <div  style="position: relative;">
                                     <select class="w-100" name="gender" required style="appearance: none;">
                                      <option value="<?= $c_data[0]->gender ?>"><?= $c_data[0]->gender ?></option>
                                      <option value="Male">Male</option>
                                      <option value="Female">Female</option>
                                      <option value="Other">Other</option>
                                    </select>

                                    <i class="fas fa-caret-down" style="position: absolute;right: 12px;top:12px;color:#ccc"></i>
                                   </div>

                            </div>

                           <!--  <div class="form-row">
                              <div class="form-group col-xl-6 col-lg-6 col-md-6">
                                <input type="text" class="w-100" id="" placeholder="Company Name">
                              </div>
                              <div class="form-group col-xl-6 col-lg-6 col-md-6">
                                <input type="text" class="w-100" id="" placeholder="Qualification">
                              </div>
                            </div>

                            <div class="form-row">
                              <div class="form-group col-xl-6 col-lg-6 col-md-6">
                                <input type="password" class="w-100" id="" placeholder="Current Password">
                              </div>
                              <div class="form-group col-xl-6 col-lg-6 col-md-6">
                                <input type="password" class="w-100" id="" placeholder="New Password">
                              </div>
                            </div>

                            <div class="form-row">
                              <div class="form-group col-xl-6 col-lg-6 col-md-6">
                                <input type="password" class="w-100" id="" placeholder="Confirm Password">
                              </div>
                              
                            </div> -->


                              <button type="submit" class="bg_15 border-0 text-white px-2 py-1 rounded mt-3">Update</button>
                            </form>
                            </div>
                           </div>
                          </div>
                         
                           </div>
                        
                          </div>
                        </div>
                       </div>

                                   
                    </div>
                  </div>

                    