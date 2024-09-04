    <!-- =======Support====== -->

                <div class="support_body dashboard_body p-xl-3 p-lg-3 p-md-3" id="desktopMainPannel_7">
                   <div class="support_body_1 row col-lg-12 col-12 ">
                    <h6 class="tc_2 f_14 fw_500 cp pt-2 pt-xl-0 pt-lg-0 pt-2 m-1 mb-2 pl-2 supportBackbtn"><i class="fas fa-arrow-left"></i> back to my order</h6>

                       <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 d-flex justify-content-between align-items-center  p-0 flex-wrap supportTopSection">
                         <div class="support_tabs d-flex justify-content-start align-items-center text-center  flex-wrap">
                              <div class="m-1 px-2 py-1 f_15 rt_14 active" onclick="supportBtn(1)">All</div>
                              <div class="m-1 px-2 py-1 f_15 rt_14" onclick="supportBtn(2)">Pending</div>
                              <div class="m-1 px-2 py-1 f_15 rt_14" onclick="supportBtn(3)">Completed</div>
                            </div>

                          


                       </div>
                      
                      <!-- new ticket -->
                   
                       <div class="col-xl-12 col-lg-12 bg_7 col-md-12 col-sm-12 col-12 d-flex justify-content-between align-items-center  p-0 flex-wrap supportHeading">
                         <div class=" d-flex justify-content-between w-100 align-items-center text-center  flex-wrap">
                              <div class="m-1 px-2 py-1 f_18 fw_600 rounded rt_15">Support</div>
                              
                            </div>
                       </div>



                       <div class="col-12 NewTicket" >

                         <form class="mt-3">
                        <div class="form-row">
                          <div class="form-group col-xl-3 col-lg-4 col-md-4">
                            <input type="text" class="w-100" id="" placeholder="Subject">
                          </div>
                          <div class="form-group col-xl-3 col-lg-4 col-md-4">
                            <input type="text" class="w-100" id="" placeholder="Phone">
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-xl-6 col-lg-8 col-md-8" style="position: relative;">
                           <i class="fas fa-caret-down" style="position: absolute;right: 12px;top:12px;color:#ccc"></i>
                           <select class="w-100" style="appearance: none;">
                              <option selected>Product...</option>
                              <option>...</option>
                            </select>
                          </div>
                        </div>
                       
                       
                        <div class="form-row">
                          <div class="form-group col-xl-6 col-lg-8 col-md-8 ">
                           <textarea class="w-100" id="exampleFormControlTextarea1" rows="3" placeholder="Message"></textarea>
                          </div>
                        </div>

                         <div class="form-row">
                          <div class="form-group col-xl-6 col-lg-12 col-md-4 " >
                            <label for="fileUpload">Upload file</label>
                             <input type="file" id="fileUpload">
                          
                          </div>
                        </div>
                        
                        
                        <button type="submit" class="bg_16 f_18 border-0 text-white px-2 py-1 rounded">Sign in</button>
                      </form>
                       </div>

                       <!-- view ticket -->

                       <h6 class="tc_2 f_14 fw_500 cp pt-2 pt-xl-0 pt-lg-0 pb-2 m-1 mb-2 pl-2 viewticketBackbtn"><i class="fas fa-arrow-left"></i> back to my order</h6>

                        <div class="col-xl-12 col-lg-12 bg_7 col-md-12 col-sm-12 col-12 d-flex justify-content-between align-items-center  p-0 flex-wrap viewTicketHeading">
                         <div class=" d-flex justify-content-between w-100 align-items-center text-center  flex-wrap">
                              <div class="m-1 px-2 py-1 f_18 fw_600 rounded rt_15">View Ticket</div>
                              
                            </div>
                       </div>

                       <div class="col-12  d-flex justify-content-center align-items-center" >
                         <div class="row py-2 viewTicket">
                           <div class="viewleft d-flex justify-content-center flex-wrap">
                             <div class="ml-3">
                               <img src="<?=base_url('assets/')?>user_dashboard_e/image/ticket.jpg" alt="" width="200px">
                             </div>
                             <div class="ml-4 py-2 viewRight">
                               <h6 class="fw_500 rt_14 f_15">Ticket Status: <span class="text-success">Open</span></h6>
                               <h6 class="fw_500 rt_14 f_15">Date: <span class="fw_300">12-Apr-2021</span></h6>
                               <h6 class="fw_500 rt_14 f_15">Phone No: <span class="fw_300">87547515234</span></h6>
                               <h6 class="fw_500 rt_14 f_15">Message: <span class="fw_300">Welcome </span></h6>
                               <h6></h6>
                               <h6></h6>
                               <h6></h6>
                               <h6></h6>
                             </div>
                           </div>
                         </div>
                       </div>

                       <!-- -table-1 -->
                      
                       <div class="col-12 support_content p-0" id="supportContent_1">
                        
                        <div class="d-flex justify-content-end align-items-center col-12 p-1"> 
                         <form class="wallet_user_balance_search d-flex justify-content-end align-items-center">
                             <input type="text" name="" class="mb-2 ml-1 py-1 pl-1 f_14" style="width: 120px;" placeholder="Search...">
                             <button class="border-0 bg_24 text-white ml-1 rounded mb-2 py-1 f_14" style="width: 50px;"><i class="fa fa-search"></i></button>
                           </form>

                         </div>
                         
                        <div class="table-responsive">

                          <table class="table w-100 text-center">
                           <thead>
                            <tr class="bg-white">
                              <th scope="col">#</th>
                              <th scope="col">Product Name</th>
                              <th scope="col">Subject</th>
                              <th scope="col">Date</th>
                              <th scope="col">Ticket Status</th>
                              <th scope="col">Action</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            
                            <tr >
                              
                              <th scope="row" class="align-middle">1</th>
                              
                              <td class="align-middle f_14 text-nowrap fw_600"><a href="" class="text-decoration-none">Track a Company</a>
                                <h6 class="f_11 tc_1 fw_300">(MANDOVI PELLETS LIMITED)</h6>
                                </td>
                              <td class="align-middle f_14 text-nowrap">India</td>
                              <td class="align-middle f_14 text-nowrap ">22</td>
                              <td class="align-middle f_14 text-nowrap text-success font-weight-bold">Active</td>
                              <td class="align-middle f_14 " id="viewTicketBtn">
                                <span class="bg_1 text-white p-1 px-2 rounded py-2 cp">View</span>
                              </td>
                              
                            </tr>
                         

                           <tr >
                              
                              <th scope="row" class="align-middle">1</th>
                              
                              <td class="align-middle f_14 text-nowrap fw_600"><a href="" class="text-decoration-none">Track a Company</a>
                                <h6 class="f_11 tc_1 fw_300">(MANDOVI PELLETS LIMITED)</h6>
                                </td>
                              <td class="align-middle f_14 text-nowrap">India</td>
                              <td class="align-middle f_14 text-nowrap ">22</td>
                              <td class="align-middle f_14 text-nowrap text-success font-weight-bold">Active</td>
                               <td class="align-middle f_14 " id="viewTicketBtn-2">
                                <span class="bg_1 text-white p-1 px-2 rounded py-2 cp">View</span>
                              </td>
                              
                            </tr>

                            <tr >
                              
                              <th scope="row" class="align-middle">1</th>
                              
                              <td class="align-middle f_14 text-nowrap fw_600"><a href="" class="text-decoration-none">Track a Company</a>
                                <h6 class="f_11 tc_1 fw_300">(MANDOVI PELLETS LIMITED)</h6>
                                </td>
                              <td class="align-middle f_14 text-nowrap">India</td>
                              <td class="align-middle f_14 text-nowrap ">22</td>
                              <td class="align-middle f_14 text-nowrap text-success font-weight-bold">Active</td>
                              <td class="align-middle f_14"><a href="" class="bg_1  text-decoration-none text-white p-1 px-2 rounded py-2">View</a></td>
                              
                            </tr>


                          </tbody>
                          </table>

                        </div>
                       </div>

                       <!-- -table-2 -->

                       <div class="col-12 support_content p-0" id="supportContent_2">
                        <div class="table-responsive">

                          <table class="table w-100 text-center">
                           <thead>
                            <tr class="bg-white">
                              <th scope="col">#</th>
                              <th scope="col">Product Name</th>
                              <th scope="col">Subject</th>
                              <th scope="col">Date</th>
                              <th scope="col">Ticket Status</th>
                              <th scope="col">Action</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            
                            <tr >
                              
                              <th scope="row" class="align-middle">2</th>
                              
                              <td class="align-middle f_14 text-nowrap fw_600"><a href="" class="text-decoration-none">Track a Company</a>
                                <h6 class="f_11 tc_1 fw_300">(MANDOVI PELLETS LIMITED)</h6>
                                </td>
                              <td class="align-middle f_14 text-nowrap">India</td>
                              <td class="align-middle f_14 text-nowrap ">22</td>
                              <td class="align-middle f_14 text-nowrap text-success font-weight-bold">Active</td>
                              <td class="align-middle f_14"><a href="" class="bg_1  text-decoration-none text-white p-1 px-2 rounded py-2">View</a></td>
                              
                            </tr>
                         

                           <tr >
                              
                              <th scope="row" class="align-middle">1</th>
                              
                              <td class="align-middle f_14 text-nowrap fw_600"><a href="" class="text-decoration-none">Track a Company</a>
                                <h6 class="f_11 tc_1 fw_300">(MANDOVI PELLETS LIMITED)</h6>
                                </td>
                              <td class="align-middle f_14 text-nowrap">India</td>
                              <td class="align-middle f_14 text-nowrap ">22</td>
                              <td class="align-middle f_14 text-nowrap text-success font-weight-bold">Active</td>
                              <td class="align-middle f_14"><a href="" class="bg_1  text-decoration-none text-white p-1 px-2 rounded py-2">View</a></td>
                              
                            </tr>

                            <tr >
                              
                              <th scope="row" class="align-middle">1</th>
                              
                              <td class="align-middle f_14 text-nowrap fw_600"><a href="" class="text-decoration-none">Track a Company</a>
                                <h6 class="f_11 tc_1 fw_300">(MANDOVI PELLETS LIMITED)</h6>
                                </td>
                              <td class="align-middle f_14 text-nowrap">India</td>
                              <td class="align-middle f_14 text-nowrap ">22</td>
                              <td class="align-middle f_14 text-nowrap text-success font-weight-bold">Active</td>
                              <td class="align-middle f_14"><a href="" class="bg_1  text-decoration-none text-white p-1 px-2 rounded py-2">View</a></td>
                              
                            </tr>
                            

                          </tbody>
                          </table>

                        </div>
                       </div>

                       <!-- table-3 -->

                       <div class="col-12 support_content p-0" id="supportContent_3">
                        <div class="table-responsive">

                          <table class="table w-100 text-center">
                           <thead>
                            <tr class="bg-white">
                              <th scope="col">#</th>
                              <th scope="col">Product Name</th>
                              <th scope="col">Subject</th>
                              <th scope="col">Date</th>
                              <th scope="col">Ticket Status</th>
                              <th scope="col">Action</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            
                            <tr >
                              
                              <th scope="row" class="align-middle">3</th>
                              
                              <td class="align-middle f_14 text-nowrap fw_600"><a href="" class="text-decoration-none">Track a Company</a>
                                <h6 class="f_11 tc_1 fw_300">(MANDOVI PELLETS LIMITED)</h6>
                                </td>
                              <td class="align-middle f_14 text-nowrap">India</td>
                              <td class="align-middle f_14 text-nowrap ">22</td>
                              <td class="align-middle f_14 text-nowrap text-success font-weight-bold">Active</td>
                              <td class="align-middle f_14"><a href="" class="bg_1  text-decoration-none text-white p-1 px-2 rounded py-2">View</a></td>
                              
                            </tr>
                         

                           <tr >
                              
                              <th scope="row" class="align-middle">1</th>
                              
                              <td class="align-middle f_14 text-nowrap fw_600"><a href="" class="text-decoration-none">Track a Company</a>
                                <h6 class="f_11 tc_1 fw_300">(MANDOVI PELLETS LIMITED)</h6>
                                </td>
                              <td class="align-middle f_14 text-nowrap">India</td>
                              <td class="align-middle f_14 text-nowrap ">22</td>
                              <td class="align-middle f_14 text-nowrap text-success font-weight-bold">Active</td>
                              <td class="align-middle f_14"><a href="" class="bg_1  text-decoration-none text-white p-1 px-2 rounded py-2">View</a></td>
                              
                            </tr>

                            <tr >
                              
                              <th scope="row" class="align-middle">1</th>
                              
                              <td class="align-middle f_14 text-nowrap fw_600"><a href="" class="text-decoration-none">Track a Company</a>
                                <h6 class="f_11 tc_1 fw_300">(MANDOVI PELLETS LIMITED)</h6>
                                </td>
                              <td class="align-middle f_14 text-nowrap">India</td>
                              <td class="align-middle f_14 text-nowrap ">22</td>
                              <td class="align-middle f_14 text-nowrap text-success font-weight-bold">Active</td>
                              <td class="align-middle f_14"><a href="" class="bg_1  text-decoration-none text-white p-1 px-2 rounded py-2">View</a></td>
                              
                            </tr>
                            

                          </tbody>
                          </table>

                        </div>
                       </div>

                       
                    </div>

                    


                   </div>


                   



                   