   <!-- =======company list====== -->

                <div class="company_list_body dashboard_body p-xl-3 p-lg-3 p-md-3" id="desktopMainPannel_2">
                   <div class="row col-lg-12 col-12 ">
                       <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 d-flex justify-content-between align-items-center  p-0 flex-wrap">
                         <div class="company_list_tabs d-flex justify-content-start align-items-center text-center  flex-wrap">
                              <div class="m-1 px-2 py-1 f_15 rt_14 active" onclick="companyTableBtn(1)">All</div>
                              <div class="m-1 px-2 py-1 f_15 rt_14" onclick="companyTableBtn(2)">Full Company Report</div>
                              <div class="m-1 px-2 py-1 f_15 rt_14" onclick="companyTableBtn(3)">Track Company</div>
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
                         <div class="d-flex justify-content-start align-items-center text-center  flex-wrap">
                              <div class="m-1 px-2 py-1 f_18 fw_600 font-weight-bold rounded f_15 rt_15">Company List</div>
                            </div>
                       </div>

                       <!-- -table-1 -->
<!-- ==============================Get==all==order==data=== -->
                       <div class="col-12 table_content p-0" id="companyListTable_1">
                        <div class="table-responsive">

                          <table class="table w-100 text-center">
                           <thead>
                            <tr class="bg-white text-center">
                              <!-- <th scope="col">#</th> -->
                              <td scope="col ">Order ID</td>
                              <td scope="col">Name</td>
                              <td scope="col">Status</td>
                              <td scope="col">Order Date</td>
                              <td scope="col">Process</td>
                            </tr>
                          </thead>
                          <tbody>

                        <?php  if($getAllOrders){ $id=1; foreach ($getAllOrders as $key ) { ?>
                           
                            <tr class="text-center">
                              <!-- <th scope="row" class="align-middle"><?= $id ?></th> -->
                              <td class="f_14 text-nowrap align-middle"><?= $key['id'] ?></td>
                              <td class="f_14 text-nowrap align-middle"><?= $key['name'] ?></td>
                              <td class="f_14 text-success font-weight-bold align-middle " 
                              style="text-transform:capitalize!important;" ><?=  $key['status']?></td>
                              <td class="f_14 text-nowrap align-middle " ><?= $key['date'] ?></td>
                              <td class="f_14 text-dark font-weight-bold  align-middle"><?= $key['product_status'] ?></td>
                            </tr>

                        <?php $id++; } } ?>



                          </tbody>
                          </table>

                        </div>
                       </div>
<!-- ==============================Get==all==order==data=== -->

                       <!-- -table-2 -->

<!-- ======================Full==company===reports================= -->

       <div class="col-12 table_content p-0" id="companyListTable_2">
        <div class="table-responsive">
          <table class="table w-100">
           <thead>
            <tr class="bg-white text-center">
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Order ID</th>
              <th scope="col">Status</th>
              <th scope="col">Order Date</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>

          <?php 
            $getOrderDataByCat=$this->admin->getOrderDataByCat($uemail,'orders','Full Company Report'); 
            if($getOrderDataByCat){ $id=1; foreach ($getOrderDataByCat as $key ) {
          ?>
                      <tr class="text-center">
                        <th scope="row" class="align-middle"><?= $id ?></th>
                        <td class="f_14 text-nowrap align-middle"><?= $key['name'] ?></td>
                        <td class="f_14 text-nowrap align-middle"><?= $key['id'] ?></td>
                        <td class="f_14 text-nowrap align-middle"style="text-transform:capitalize!important;" ><?= $key['status']?></td>
                        <td class="f_14 text-nowrap align-middle"><?= $key['date'] ?></td>
                        <td class="f_14 text-nowrap align-middle"><?= $key['product_status'] ?></td>
                      </tr>

          <?php $id++; } } ?>

                    </tbody>
                    </table>
                  </div>
                 </div>
<!-- ===============================================End==of==full==company==reports==pankaj== -->



<!-- =======================Get==all==tracking company===data===pankaj==== -->
                       <!-- table-3 -->

                       <div class="col-12 table_content p-0" id="companyListTable_3">
                        <div class="table-responsive">
                          <table class="table w-100">
                           <thead>
                            <tr class="bg-white text-center">
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Order ID</th>
                              <th scope="col">Status</th>
                              <th scope="col">Order Date</th>
                              <th scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
      $getOrderDataByCat=$this->admin->getOrderDataByCat($uemail,'orders','Track a Company'); 
      if($getOrderDataByCat){ $id=1; foreach ($getOrderDataByCat as $key ) {
    ?>
                <tr class="text-center">
                  <th scope="row" class="align-middle"><?= $id ?></th>
                  <td class="f_14 text-nowrap align-middle"><?= $key['name'] ?></td>
                  <td class="f_14 text-nowrap align-middle"><?= $key['id'] ?></td>
                  <td class="f_14 text-nowrap align-middle" style="text-transform:capitalize!important;" ><?= $key['status']?></td>
                  <td class="f_14 text-nowrap align-middle"><?= $key['date'] ?></td>
                  <td class="f_14 text-nowrap align-middle"><?= $key['product_status'] ?></td>
                </tr>

    <?php $id++; } } ?>
                          </tbody>
                          </table>
                        </div>
                       </div>

<!-- =======================Get==all==tracking company===data===pankaj==== -->


                       
                    </div>
                   </div>