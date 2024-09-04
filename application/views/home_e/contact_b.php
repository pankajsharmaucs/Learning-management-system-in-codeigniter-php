<?php 

// $password= Utils::hash('sha1', $this->input->post('password'), AUTH_SALT);
$password= Utils::hash('sha1', 'password', AUTH_SALT);

echo $password;

 ?>
<!-- ========================contact========================= -->

<section class="bgi_5">
  <div class="container pt-5">
    <div class="row pb-xl-4 pb-2">
      <div class="col-12">
         <div class="contact_content ">
              <h1 class="py-3 rt_20 fw_500 f_30 text-white">Get In Touch</h1>
              <p class="rt_14 f_15 fw_300 ">Feel free to ask your queries.</p>
            </div>
      </div>
         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pb-2 d-flex align-items-center">
          <div class="contact_left">
          
            <div class="contact_details">
              <div class="d-flex justify-content-start align-items-center mb-3">
                <div class="d-flex justify-content-center align-items-center"><img src="<?=base_url('assets/')?>home_e/images/svg/envelope.svg" alt="" height="20px" width="20px" ></div>
                <div class="ml-4 f_15 rt_14 fw_700 text-white" >kreditaid@support.com</div>
              </div>

              <div class="d-flex justify-content-start align-items-center mb-3">
                <div class="d-flex justify-content-center align-items-center"><img src="<?=base_url('assets/')?>home_e/images/svg/smartphone-call.svg" alt="" height="20px" width="20px"></div>
                <div class="ml-4 f_15 rt_14 fw_700 text-white" >1800-256-2564</div>
              </div>

              <div class="d-flex justify-content-start align-items-center mb-3">
                <div class="d-flex justify-content-center align-items-center"><img src="<?=base_url('assets/')?>home_e/images/svg/pin.svg" alt="" height="20px" width="20px"></div>
                <div class="ml-4 f_15 rt_14 fw_700 text-white" >india</div>
              </div>

              
            </div>
          </div>
         </div>
         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
          <div class="contact_right shadow p-5">
            <h2 class="rt_20 fw_500 f_25 pb-2">Ask  Something</h2>

            <form>
              <div class="form-row">
              <div class="form-group col-sm-6 col-12">
                <input type="text" class=" f_14 fw_400 w-100" id="exampleFormControlInput1" placeholder="Your Name" required>
              </div>
              <div class="form-group col-sm-6 col-12">
                <input type="email" class=" f_14 fw_400 w-100" id="exampleFormControlInput1" placeholder="Your Email" required>
              </div>

               <div class="form-group col-sm-6 col-12">
                <input type="text" class=" f_14 fw_400 w-100" id="exampleFormControlInput1" placeholder="Your Mobile Number" required>
              </div>

              <div class="form-group col-sm-6 col-12">
                 <select class=" f_14 fw_400 tc_1 w-100" id="exampleFormControlSelect1" style="position: relative;appearance :none">
                  <option>Country</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
                <i class="fas fa-angle-down tc_1" style="position: absolute;top:11px;right:13px;"></i>
              </div>

               <div class="form-group col-sm-6 col-12" style="position: relative;appearance :none">
                 <select class=" f_14 fw_400 tc_1 w-100" id="exampleFormControlSelect1" style="position: relative;appearance :none">
                  <option>City</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
                <i class="fas fa-angle-down tc_1" style="position: absolute;top:11px;right:13px;"></i>
              </div>

              <div class="form-group col-sm-6 col-12">
                <input type="text" class="w-100 f_14 fw_400" id="exampleFormControlInput1" placeholder="Company" required>
              </div>

             </div>
              <div class="form-group">
                <textarea class="w-100 f_14 fw_400" id="exampleFormControlTextarea1" placeholder="Message.." rows="3"></textarea>
              </div>
               <div class="form-group">
               <button class="bg_4  py-2 border-0 text-white shadow px-3 rounded">SEND</button>
              </div>
        </form>
     </div>
      </div>
      
    </div>
  </div>
</section>
