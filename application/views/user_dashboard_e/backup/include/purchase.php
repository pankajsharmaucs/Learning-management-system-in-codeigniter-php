    <!-- =======Purchase history====== -->

                <div class="purchase_history_body dashboard_body p-xl-3 p-lg-3 p-md-3" id="desktopMainPannel_4">
                   <div class="purchase_history_body_1 row col-lg-12 col-12 ">
                       <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 d-flex justify-content-between align-items-center  p-0 flex-wrap">
                         <div class="purchase_history_tabs d-flex justify-content-start align-items-center text-center  flex-wrap">
                              <div class="m-1 px-2 py-1 f_15 rt_14 active" onclick="purchaseHistoryBtn(1)">All</div>
                              <div class="m-1 px-2 py-1 f_15 rt_14" onclick="purchaseHistoryBtn(2)">In Progress</div>
                              <div class="m-1 px-2 py-1 f_15 rt_14" onclick="purchaseHistoryBtn(3)">Completed</div>
                            </div>

                            <!-- <div class="search d-flex justify-content-start align-items-center mt-2  flex-wrap m-1">
                             <form>
                             <input type="date" name="" class="mb-2 py-1 pl-1 f_14" style="width: 120px;" placeholder="Enter From Date">
                             <input type="date" name="" class="mb-2 py-1 pl-1 f_14" style="width: 120px;" placeholder="Enter To Date">
                             <button class="border-0 bg_11 text-white rounded mb-2 py-1 f_14" style="width: 50px;">Reset</button>
                           </form>
                            </div> -->


                       </div>

                       <div class="col-xl-12 col-lg-12 bg_7 col-md-12 col-sm-12 col-12 d-flex justify-content-between align-items-center  p-0 flex-wrap">
                         <div class=" d-flex justify-content-between w-100 align-items-center text-center  flex-wrap">
                              <div class="m-1 px-2 py-1 f_18 fw_600 font-weight-bold rounded rt_15">Purchase History</div>
                              <div class="m-1 px-2 py-1 f_13 fw_600 rounded rt_12">Wallet Balance: <span class="pr-1" style="border-right: 2px solid #999">0</span>
                               Total Purchase: <span>0</span>
                              </div>
                            </div>
                       </div>

                       <!-- -table-1 -->
                      
                       <div class="col-12 purchase_history_content p-0" id="purchaseHistoryContent_1">
                        <div class="table-responsive">

                          <table class="table w-100 text-center">
                           <tdead>
                            <tr class="bg-white">
                              <!-- <td scope="col">Sno.</td> -->
                              <td scope="col">Order ID</td>
                              <td scope="col">Product Name</td>
                              <td scope="col">Country</td>
                              <!-- <td scope="col">Quantity</th> -->
                              <td scope="col" class="text-nowrap">Total Cost</td>
                              <td scope="col" class="text-nowrap">Order Date</td>
                              <td scope="col">Status</td>

                            </tr>
                          </thead>
                          <tbody>
                            
<?php 
  if($getAllPurchase){
    $id=1;

   foreach($getAllPurchase as $key ) { 
    
    $product_name=$key['category'];
    $code=$key['country_code'];
    $all_cost=$this->admin->getProductByName($product_name);


if($country == 'India'){ $c=0; $cost=$all_cost[0]['inr_price']; }
else{ $cost=$all_cost[0]['usd_price']; $c=1;}

$d=$key['date'];

$odate = date("d-M-Y", strtotime($d));

?>
                            <tr >
                              
                              <!-- <td scope="row align-middle"><?= $id ?></th> -->
                              <td class="align-middle f_14 text-nowrap"><?= $key['id'] ?></td>
                              <td class="align-middle f_14 text-nowrap fw_600"><?= $key['category'] ?>
                                <h6 class="f_11 tc_1 fw_300">(<?= $key['name'] ?>)</h6>
                                </td>
                              <td class="align-middle f_14 text-nowrap">India</td>
                              <!-- <td class="align-middle f_14 text-nowrap">6 Units</td> -->
                              <td class="align-middle f_14">
                                <?= $cost ?> <?= $ctype  ?>
                              </td>
                              <td class="align-middle f_14"><?= $odate ?></td>
                              <td class="align-middle f_14 text-danger"><?= $key['product_status'] ?></td>

                            </tr>
<?php $id++; } } ?>


                          </tbody>
                          </table>

                        </div>
                       </div>

<!-- ================In progress==purchasing===== -->

                       <!-- -table-2 -->

                       <div class="col-12 purchase_history_content p-0" id="purchaseHistoryContent_2">
                        <div class="table-responsive">

<table class="table w-100 text-center">
 <tdead>
  <tr class="bg-white">
    <!-- <td scope="col">#</th> -->
    <td scope="col">Order ID</th>
    <td scope="col">Product Name</th>
    <td scope="col">Country</th>
    <!-- <td scope="col">Quantity</th> -->
    <td scope="col" class="text-nowrap">Total Cost</th>
    <td scope="col" class="text-nowrap">Order Date</th>
    <td scope="col">Status</th>

  </tr>
</thead>
<tbody>
                    
<?php 

$id=1;
$getPurchaseByStatus=$this->admin->getPurchaseByStatus($uemail,'In Progress');
  if($getPurchaseByStatus){ foreach($getPurchaseByStatus as $key ) { 
    
    $product_name=$key['category'];
    $code=$key['country_code'];
    $all_cost=$this->admin->getProductByName($product_name);

if($country == 'India'){ $c=0; $cost=$all_cost[0]['inr_price']; }
else{ $cost=$all_cost[0]['usd_price']; $c=1;}

$d=$key['date'];

$odate = date("d-M-Y", strtotime($d));

?>
                    <tr >
                      
                      <!-- <td scope="row align-middle"><?= $id ?></th> -->
                      <td class="align-middle f_14 text-nowrap"><?= $key['id'] ?></td>
                      <td class="align-middle f_14 text-nowrap fw_600"><?= $key['category'] ?>
                        <h6 class="f_11 tc_1 fw_300">(<?= $key['name'] ?>)</h6>
                        </td>
                      <td class="align-middle f_14 text-nowrap">India</td>
                      <!-- <td class="align-middle f_14 text-nowrap">6 Units</td> -->
                      <td class="align-middle f_14">
                                                       <?= $cost ?> <?= $ctype  ?>

                      </td>
                      <td class="align-middle f_14"><?= $odate ?></td>
                      <td class="align-middle f_14 text-danger"><?= $key['product_status'] ?></td>

                    </tr>
<?php $id++;} } ?>


</tbody>
</table>

                        </div>
                       </div>

<!-- =================Completed===purchased==== -->

                       <!-- table-3 -->

                       <div class="col-12 purchase_history_content p-0" id="purchaseHistoryContent_3">
                        <div class="table-responsive">

<table class="table w-100 text-center">
 <tdead>
  <tr class="bg-white">
    <!-- <td scope="col">#</th> -->
    <td scope="col">Order ID</th>
    <td scope="col">Product Name</th>
    <td scope="col">Country</th>
    <!-- <td scope="col">Quantity</th> -->
    <td scope="col" class="text-nowrap">Total Cost</th>
    <td scope="col" class="text-nowrap">Order Date</th>
    <td scope="col">Status</th>

  </tr>
</thead>
<tbody>
                    
<?php 

$id=1;
$getPurchaseByStatus=$this->admin->getPurchaseByStatus($uemail,'completed');
  if($getPurchaseByStatus){ foreach($getPurchaseByStatus as $key ) { 
    
    $product_name=$key['category'];
    $code=$key['country_code'];
    $all_cost=$this->admin->getProductByName($product_name);


if($country == 'India'){ $c=0; $cost=$all_cost[0]['inr_price']; }
else{ $cost=$all_cost[0]['usd_price']; $c=1;}

$d=$key['date'];

$odate = date("d-M-Y", strtotime($d));

?>
                    <tr >
                      
                      <!-- <td scope="row align-middle"><?= $id ?></th> -->
                      <td class="align-middle f_14 text-nowrap"><?= $key['id'] ?></td>
                      <td class="align-middle f_14 text-nowrap fw_600"><?= $key['category'] ?>
                        <h6 class="f_11 tc_1 fw_300">(<?= $key['name'] ?>)</h6>
                        </td>
                      <td class="align-middle f_14 text-nowrap">India</td>
                      <!-- <td class="align-middle f_14 text-nowrap">6 Units</td> -->
                      <td class="align-middle f_14">
                                                        <?= $cost ?> <?= $ctype  ?>

                      </td>
                      <td class="align-middle f_14"><?= $odate ?></td>
                      <td class="align-middle f_14 text-danger"><?= $key['product_status'] ?></td>

                    </tr>
<?php $id++;} } ?>


</tbody>
</table>

                        </div>
                       </div>

                       
                    </div>

                    <div class="purchase_history_body_2 row col-lg-12 col-12 d-none">
                      <div class="col-12 p-0">
                        <h6 class="tc_2 f_14 fw_500 cp pt-2 pt-xl-0 pt-lg-0 pt-2 m-1 mb-2 pl-2"><i class="fas fa-arrow-left"></i> back to my order</h6>
                      </div>
                       <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 d-flex justify-content-between align-items-center  p-0 flex-wrap">
                         <div class="purchase_history_tabs_inner d-flex justify-content-start align-items-center text-center  flex-wrap">
                              <div class="m-1 px-2 py-1 bg_15 text-white rounded ml-2 f_15 rt_14 py-2 px-2 my-2 my-xl-0 my-lg-0"><a href="" class="text-decoration-none text-white">Invoice</a></div>
                            </div>

                           


                       </div>

                      

                       <div class="col-xl-12 col-lg-12 bg_7 col-md-12 col-sm-12 col-12 d-flex justify-content-between align-items-center  p-0 flex-wrap">
                         <div class=" d-flex justify-content-start align-items-center text-center  flex-wrap">
                              <div class="m-1 px-2 py-1 f_18 fw_600 rounded f_15 rt_15">Order Description</div>
                            </div>
                       </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-xl-center justify-content-lg-center justify-content-start   p-0  m-1 p-1 mb-3 py-3 shadow-sm bg-white">
                         <div class="row col-xl-10 col-lg-10 col-12 mx-xl-auto mx-lg-auto ">
                           <div class="col-12 col-xl-6">
                             <div class="d-flex align-items-center mb-2">
                               <div class="fw_600 f_15 rt_14 text-nowrap">Order Id:</div>
                               <div class="ml-3 f_14 ">125485</div>
                             </div>

                             <div class="d-flex align-items-center mb-2">
                               <div class="fw_600 f_15 text-nowrap rt_14">Order Name:</div>
                               <div class="ml-3 f_14">Full Company Report</div>
                             </div>

                             <div class="d-flex align-items-center mb-2">
                               <div class="fw_600 f_15 text-nowrap rt_14">Quantify:</div>
                               <div class="ml-3 f_14">0</div>
                             </div>

                            
                           </div>
                           <div class="col-12 col-xl-6">
                             <div class="d-flex align-items-center mb-2">
                               <div class="fw_600 f_15 text-nowrap rt_14">Order Id:</div>
                               <div class="ml-3 f_14">125485</div>
                             </div>

                             <div class="d-flex align-items-center mb-2">
                               <div class="fw_600 f_15 text-nowrap rt_14">Order Name:</div>
                               <div class="ml-3 f_14">Full Company Report</div>
                             </div>

                             <div class="d-flex align-items-center mb-2">
                               <div class="fw_600 f_15 text-nowrap rt_14">Quantify:</div>
                               <div class="ml-3 f_14">0</div>
                             </div>
                           </div>
                         </div>
                       </div>

                       <!-- -table-1 -->
                       <div class="m-1 px-2 py-1 bg_16 text-white rounded f_15 rt_14 my-2 my-xl-0 my-lg-0 ml-2 py-2 px-2"><a href="" class="text-decoration-none text-white">Export</a></div>

                       <div class="col-xl-12 mt-3 col-lg-12 bg_7 col-md-12 col-sm-12 col-12 d-flex justify-content-between align-items-center  p-0 flex-wrap">
                         <div class=" d-flex justify-content-start align-items-center text-center  flex-wrap">
                              <div class="m-1 px-2 py-1 f_18 fw_600 rounded f_15 rt_15">Invoice Report List</div>
                            </div>
                       </div>
                      
                       <div class="col-12 p-0">
                        <div class="table-responsive">

                          <table class="table w-100 text-center">
                           <tdead>
                            <tr class="bg-white">
                              <td scope="col">#</th>
                              <td scope="col">Company Name</th>
                              <td scope="col">Status</th>
                              <td scope="col">Quantity</th>
                              <td scope="col">Cost</th>
                              <td scope="col">Action</th>
                              
                            </tr>
                          </thead>
                          <tbody>
                            
                            <tr >
                              
                              <td scope="row" class="align-middle">1</th>
                              
                              <td class="align-middle f_14 text-nowrap fw_600">Track a Company
                                <h6 class="f_11 tc_1 fw_300">(MANDOVI PELLETS LIMITED)</h6>
                                </td>
                              <td class="align-middle f_14 text-nowrap">active</td>
                              <td class="align-middle f_14 text-nowrap">1</td>
                              <td class="align-middle f_14 text-nowrap">6 Units</td>
                              <td class="align-middle f_14">In Progress</td>
                             
                            </tr>
                         

                           <tr >
                              
                              <td scope="row align-middle">1</th>
                              
                              <td class="align-middle f_14 text-nowrap fw_600">Track a Company
                                <h6 class="f_11 tc_1 fw_300">(MANDOVI PELLETS LIMITED)</h6>
                                </td>
                              <td class="align-middle f_14 text-nowrap">active</td>
                              <td class="align-middle f_14 text-nowrap">1</td>
                              <td class="align-middle f_14 text-nowrap">6 Units</td>
                              <td class="align-middle f_14">In Progress</td>
                             
                            </tr>

                            <tr >
                              
                              <td scope="row align-middle">1</th>
                              
                              <td class="align-middle f_14 text-nowrap fw_600">Track a Company
                                <h6 class="f_11 tc_1 fw_300">(MANDOVI PELLETS LIMITED)</h6>
                                </td>
                              <td class="align-middle f_14 text-nowrap">active</td>
                              <td class="align-middle f_14 text-nowrap">1</td>
                              <td class="align-middle f_14 text-nowrap">6 Units</td>
                              <td class="align-middle f_14">In Progress</td>
                             
                            </tr>

                            
                          </tbody>
                          </table>

                        </div>
                       </div>

                       <!-- -table-2 -->

                       <div class="col-12 purchase_history_content p-0" id="purchaseHistoryContent_2">
                        <div class="table-responsive">
                          <table class="table w-100 text-center">
                           <tdead>
                            <tr class="bg-white">
                              <td scope="col">#</th>
                              <td scope="col">Name</th>
                              <td scope="col">Order ID</th>
                              <td scope="col">Status</th>
                              <td scope="col">Order Date</th>
                              <td scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr >
                              <td scope="row align-middle">2</th>
                              <td class="align-middle f_14 text-nowrap">TATA COFFEE LIMITED</td>
                              <td class="align-middle f_14 text-nowrap">S1NuvsIG2j(Track a Company)</td>
                              <td class="align-middle f_14 text-nowrap">In Progress</td>
                              <td class="align-middle f_14 text-nowrap">2021-04-05 16:07:35</td>
                              <td class="align-middle f_14 text-nowrap">In Progress</td>
                            </tr>
                            <tr >
                              <td scope="row align-middle">2</th>
                              <td class="align-middle f_14 text-nowrap">TATA COFFEE LIMITED</td>
                              <td class="align-middle f_14 text-nowrap">S1NuvsIG2j(Track a Company)</td>
                              <td class="align-middle f_14 text-nowrap">In Progress</td>
                              <td class="align-middle f_14 text-nowrap">2021-04-05 16:07:35</td>
                              <td class="align-middle f_14 text-nowrap">In Progress</td>
                            </tr>
                            <tr >
                              <td scope="row align-middle">2</th>
                              <td class="align-middle f_14 text-nowrap">TATA COFFEE LIMITED</td>
                              <td class="align-middle f_14 text-nowrap">S1NuvsIG2j(Track a Company)</td>
                              <td class="align-middle f_14 text-nowrap">In Progress</td>
                              <td class="align-middle f_14 text-nowrap">2021-04-05 16:07:35</td>
                              <td class="align-middle f_14 text-nowrap">In Progress</td>
                            </tr>
                          </tbody>
                          </table>
                        </div>
                       </div>

                       <!-- table-3 -->

                       <div class="col-12 purchase_history_content p-0" id="purchaseHistoryContent_3">
                        <div class="table-responsive">
                          <table class="table w-100 text-center">
                           <tdead>
                            <tr class="bg-white">
                              <td scope="col">#</th>
                              <td scope="col">Name</th>
                              <td scope="col">Order ID</th>
                              <td scope="col">Status</th>
                              <td scope="col">Order Date</th>
                              <td scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr >
                              <td scope="row align-middle">3</th>
                              <td class="align-middle f_14 text-nowrap">TATA COFFEE LIMITED</td>
                              <td class="align-middle f_14 text-nowrap">S1NuvsIG2j(Track a Company)</td>
                              <td class="align-middle f_14 text-nowrap">In Progress</td>
                              <td class="align-middle f_14 text-nowrap">2021-04-05 16:07:35</td>
                              <td class="align-middle f_14 text-nowrap">In Progress</td>
                            </tr>
                            <tr >
                              <td scope="row align-middle">3</th>
                              <td class="align-middle f_14 text-nowrap">TATA COFFEE LIMITED</td>
                              <td class="align-middle f_14 text-nowrap">S1NuvsIG2j(Track a Company)</td>
                              <td class="align-middle f_14 text-nowrap">In Progress</td>
                              <td class="align-middle f_14 text-nowrap">2021-04-05 16:07:35</td>
                              <td class="align-middle f_14 text-nowrap">In Progress</td>
                            </tr>
                            <tr >
                              <td scope="row align-middle">3</th>
                              <td class="align-middle f_14 text-nowrap">TATA COFFEE LIMITED</td>
                              <td class="align-middle f_14 text-nowrap">S1NuvsIG2j(Track a Company)</td>
                              <td class="align-middle f_14 text-nowrap">In Progress</td>
                              <td class="align-middle f_14 text-nowrap">2021-04-05 16:07:35</td>
                              <td class="align-middle f_14 text-nowrap">In Progress</td>
                            </tr>
                          </tbody>
                          </table>
                        </div>
                       </div>

                       
                    </div>


                   </div>