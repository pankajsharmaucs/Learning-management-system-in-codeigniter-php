

<div class="change_password dashboard_body p-xl-3 p-lg-3 p-md-3" id="desktopMainPannel_9" style="display:none">
  <div class="profile_body_1 row col-lg-12 col-12 ">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 p-0 flex-wrap">
      <div class="row">

        <div class="col-md-6 text-center">
          <img src="<?=base_url('assets/')?>user_dashboard_e/svg/change_pass.svg" alt="" width="70%">
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 text-center  f_18 rt_15 fw_500 ">
          <span class="bg_7 p-2 d-block shadow-sm">Change Password</span>
          <div class="profile_img pt-3 bg-white shadow-sm d-flex justify-content-center pb-2">
            <div>
              <div id="validationChangePass" style="display:none"></div>
              <form id="changePasswordForm  " action="" method="post">
                <div class="form-group text-left">
                  <label for="">Old Password</label>
                  <input type="text" name="oldPassword" id="oldPassword" class="form-control">
                </div>
                <div class="form-group text-left">
                  <label for="">New Password</label>
                  <input type="text" name="newPassword" id="newdPassword" class="form-control">
                </div>
                <button id="changePassword" class="btn btn-success">Change Password</button>
              </form>
            </div>
          </div>
          
        </div>


      </div>
                        
    </div>
  </div>
</div>