    <!-- =======Support====== -->

                <div class="support_body dashboard_body p-xl-3 p-lg-3 p-md-3" id="desktopMainPannel_7">
                   <div class="support_body_1 row col-lg-12 col-12 ">
                    <h6 class="tc_2 f_14 fw_500 cp pt-2 pt-xl-0 pt-lg-0 pt-2 m-1 mb-2 pl-2 supportBackbtn" onclick="supportBackbtn()"><i class="fas fa-arrow-left"></i> Back to my support</h6>

                       <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 d-flex justify-content-between align-items-center  p-0 flex-wrap supportTopSection">
                         <div class="support_tabs d-flex justify-content-start align-items-center text-center  flex-wrap">
                              <div class="m-1 px-2 py-1 f_15 rt_14 active" onclick="supportBtn(1)">All</div>
                              <div class="m-1 px-2 py-1 f_15 rt_14" onclick="supportBtn(2)">Open</div>
                              <div class="m-1 px-2 py-1 f_15 rt_14" onclick="supportBtn(3)">Closed</div>
                            </div>

                            <div class="search d-flex justify-content-start align-items-center mt-2  flex-wrap m-1">
                            
                             <button class="border-0 bg_11 text-white rounded mb-2 py-1 f_14 text-nowrap px-2 py-2 " 
                              onclick="openNewTicket();" >New Ticket</button>
                           
                            </div>


                       </div>
                      
<!--===========Create new ticket================== -->
                   
                      

                       <div class="col-12 NewTicket" >

                         

                         <div class="col-xl-12 col-lg-12 bg_7 col-md-12 col-sm-12 col-12 d-flex justify-content-between align-items-center  p-0 flex-wrap supportHeading">
                         <div class=" d-flex justify-content-between w-100 align-items-center text-center  flex-wrap">
                              <div class="m-1 px-2 py-1 f_25 font-weight-bold  text-dark rounded rt_15">Create new Support Ticket</div>
                              
                            </div>
                       </div>



                         <form class="mt-3">
                        <div class="form-row">
                          <div class="form-group col-xl-4 col-lg-4 col-md-12">
                            <label>Name</label>
                            <input type="text" class="w-100 bg-light text-dark"  readonly  value="<?= $fullname ?>">
                          </div>

                          <div class="form-group col-xl-4 col-lg-4 col-md-12">
                            <label>Email</label>
                            <input type="text" class="w-100 bg-light text-dark"  readonly  value="<?= $uemail ?>">
                          </div>

                           

                    <div class="form-group col-md-4">
                      <label>Priority</label>
                        <div class="" style="position: relative;">
                         <select class="w-100 form-control"  style="appearance: none;" id="ticketPriority" >
                            <option value="Low">Low </option>
                            <option value="Medium">Medium </option>
                            <option value="High">High </option>
                          </select>
                         <i class="fas fa-caret-down pr-3" style="position: absolute;right: 12px;top:12px;color:#ccc"></i>
                        </div>
                     </div>

                        <div class="form-group col-xl-12 col-lg-12 col-md-12">
                            <label>Subject</label>
                            <input type="text" id="ticketSubject" class="w-100" id="" placeholder="Subject">
                          </div>


                        </div>

                        

                       
                       
                       
                        <div class="form-row">
                          <div class="form-group col-xl-6 col-lg-8 col-md-8 ">
                          <label>Messege</label>
                           <textarea class="w-100" id="ticketmsg"  rows="3" placeholder="Message"></textarea>
                          </div>
                        </div>



                         <div class="form-row">
                          <div class="form-group col-xl-6 col-lg-12 col-md-4 " >
                            <label for="fileUpload">Attachment(Screenshot, image, pdf )</label>
                             <input type="file" id="fileUpload" onchange="changeticketfile()">
                             <div class="text-danger">* You can  upload only jpg, png, jpeg & pdf. </div>
                          
                           </div>
                         </div>

                         <div class=" ticketErrorBox ">
                              <strong><div class="ticketErrorMsg"></div></strong>
                          </div>
                        
                        
                        <button type="submit" id="createTicketBtn" class="bg_16 f_18 border-0 text-white px-2 py-1 rounded">Submit Ticket</button>

                        

                      </form>
                       </div>

 <!--============== view ticket===================== -->

                       <h6 class="tc_2 f_14 fw_500 cp pt-2 pt-xl-0 pt-lg-0 pb-2 m-1 mb-2 pl-2 viewticketBackbtn"><i class="fas fa-arrow-left"></i> Back to my support</h6>

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

<!-- -table-1==all==ticket== -->
                      
                       <div class="col-12 support_content p-0" id="supportContent_1">
                        <div class="table-responsive">

                          <table class="table w-100 text-center">
                           <tdead>
                            <tr class="bg-white">
                              <td scope="col">Ticket Id</td>
                              <td scope="col">Subject</td>
                              <td scope="col">Priority</td>
                              <td scope="col">Ticket Status</td>
                              <td scope="col">View</td>
                              <td scope="col">Action</td>
                             
                            </tr>
                          </thead>
                          <tbody>

<?php 
  if($allTicket){$id=1;  foreach($allTicket as $key ) { 
?>
                            <tr>
                              
                              <td scope="row" class="align-middle"><?= $key['tid'] ?></td>
                              
                              <td class="align-middle f_14 text-nowrap fw_600"><a href="" class="text-decoration-none"><?= $key['subject'] ?></a>
                                </td>
                              <td class="align-middle f_14 text-nowrap "><?= $key['priority'] ?></td>
                                <?php if($key['ticket_status']==0){ ?>
                                  <td class="align-middle f_14 text-nowrap text-success font-weight-bold"> Open</td>
                               <?php }else{?>
                                <td class="align-middle f_14 text-nowrap text-danger font-weight-bold"> Closed</td>
                                <?php } ?>
                             
                              <td class="align-middle f_14 " id="viewTicketBtn">
                                <span class="bg_1 text-white p-1 px-2 rounded py-2 cp">View</span>
                              </td>
                              <td class="align-middle f_14 " id="viewTicketBtn">
                                <a href="CloseTicket/<?= $key['tid'] ?>"><span class="bg-danger text-white p-1 px-2 rounded py-2 cp">Close</span>
                              </td>

                              
                            </tr>
<?php $id++; } } ?>



                          </tbody>
                          </table>

                        </div>
                       </div>

<!-- -table-2 open===Tickets-->

                       <div class="col-12 support_content p-0" id="supportContent_2">
                        <div class="table-responsive">

                          <table class="table w-100 text-center">
                           <tdead>
                            <tr class="bg-white">
                               <td scope="col">Ticket Id</td>
                              <td scope="col">Subject</td>
                              <td scope="col">Priority</td>
                              <td scope="col">Ticket Status</td>
                              <td scope="col">View</td>
                              <td scope="col">Action</td>
                             
                            </tr>
                          </thead>
                          <tbody>
                            
<?php 
  if($openTicket){$id=1;  foreach($openTicket as $key ) { 
?>
                  <tr>
                    
                    <td scope="row" class="align-middle"><?= $key['tid'] ?></td>
                    
                    <td class="align-middle f_14 text-nowrap fw_600"><a href="" class="text-decoration-none"><?= $key['subject'] ?></a>
                      </td>
                    <td class="align-middle f_14 text-nowrap "><?= $key['priority'] ?></td>
                      <?php if($key['ticket_status']==0){ ?>
                        <td class="align-middle f_14 text-nowrap text-success font-weight-bold"> Open</td>
                     <?php }else{?>
                      <td class="align-middle f_14 text-nowrap text-danger font-weight-bold"> Closed</td>
                      <?php } ?>
                   
                    <td class="align-middle f_14 " id="viewTicketBtn">
                      <span class="bg_1 text-white p-1 px-2 rounded py-2 cp">View</span>
                    </td>
                    <td class="align-middle f_14 " id="viewTicketBtn">
                      <a href="CloseTicket/<?= $key['tid'] ?>"><span class="bg-danger text-white p-1 px-2 rounded py-2 cp">Close</span>
                    </td>

                    
                  </tr>
<?php $id++; } } ?>
        
                            

                          </tbody>
                          </table>

                        </div>
                       </div>

                       <!-- table-3 -->

                       <div class="col-12 support_content p-0" id="supportContent_3">
                        <div class="table-responsive">

                          <table class="table w-100 text-center">
                           <tdead>
                            <tr class="bg-white">
                               <td scope="col">Ticket Id</td>
                              <td scope="col">Subject</td>
                              <td scope="col">Priority</td>
                              <td scope="col">Ticket Status</td>
                              <td scope="col">View</td>
                              <td scope="col">Action</td>
                             
                            </tr>
                          </thead>
                          <tbody>
                            
<?php 
  if($closedTicket){$id=1;  foreach($closedTicket as $key ) { 
?>
                  <tr>
                    
                    <td scope="row" class="align-middle"><?= $key['tid'] ?></td>
                    
                    <td class="align-middle f_14 text-nowrap fw_600"><a href="" class="text-decoration-none"><?= $key['subject'] ?></a>
                      </td>
                    <td class="align-middle f_14 text-nowrap "><?= $key['priority'] ?></td>
                      <?php if($key['ticket_status']==0){ ?>
                        <td class="align-middle f_14 text-nowrap text-success font-weight-bold"> Open</td>
                     <?php }else{?>
                      <td class="align-middle f_14 text-nowrap text-danger font-weight-bold"> Closed</td>
                      <?php } ?>
                   
                    <td class="align-middle f_14 " id="viewTicketBtn">
                      <span class="bg_1 text-white p-1 px-2 rounded py-2 cp">View</span>
                    </td>
                    <td class="align-middle f_14 " id="viewTicketBtn">
                      <a href="OpenTicket/<?= $key['tid'] ?>"><span class="bg-success text-white p-1 px-2 rounded py-2 cp">
                      Re-Open</span>
                    </td>

                    
                  </tr>
<?php $id++; } } ?>
                         

                          </tbody>
                          </table>

                        </div>
                       </div>

                       
                    </div>

                    


                   </div>


                   

<!-- =================Support==popup====model pankaj -->

<input type="hidden" name="" id="supportPopupBtn" data-toggle="modal" data-target="#supportPopup">
                  <!--buy now Modal -->
                  <div class="modal fade" id="supportPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content rounded-0" style=" background-color: #ECF4FF!important;">
                        <div class="modal-header border-0" >

                          <div class="d-flex align-items-center ">
                            <h5 class="modal-title rt_17" id="exampleModalLongTitle "><img src="<?=base_url('assets/user_dashboard_e/svg/support.svg')?>" width="30px" class="mr-2"> Support Ticket </h5>
                          </div>
                          
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        
                        <div class="modal-body  d-flex justify-content-center align-items-center">
                          <div class="addMoney text-center col-12">
                          
                                       <h4 class="f_20 fw_400 rt_15 supportResult"> </h4>

                          </div>
                        </div>
                        
                        <!-- <div id='buyNowNotice' class="alert alert-success">sdasasa<div> -->
                      <div class=" p-2 justify-content-center " id="supportFooter">
                       <div class="bg_11 mr-2 mb-2 text-white p-2 rounded cp  rt_15" onclick="supportBackbtn()">View Open Tickets</div>
                        <div class="bg-danger mb-2 text-white p-2 rounded cp rt_15" onclick="supportBackbtn()" >All Tickets</div>
                      </div>

                      </div>
                    </div>
                  </div>


                   