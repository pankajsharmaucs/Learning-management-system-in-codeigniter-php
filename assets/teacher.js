







function CreateCourse1(){


        var coursetitle=$('#coursetitle').val();
        var courseCat=$('#courseCat').val();
        var courseSubCat=$('#courseSubCat').val();

        if(coursetitle == '' || courseCat == '' || courseSubCat == '' ){ 
        $('.CreateErrorBox').html('Please fill all fields'); return; }

        // alert(rating); return;

        formData = new FormData();
        formData.append('coursetitle', coursetitle);
        formData.append('courseCat', courseCat);
        formData.append('courseSubCat', courseSubCat);

        $.ajax({
        url: siteUrl+'lms/Teacher/CreateCourse1',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,                          

        success: function (data) {

        // alert(siteUrl+'teacher/create_course_dashboard'); return;

        if(data == 'Created' )
          {
            window.open(siteUrl+'teacher/create_course_dashboard','_self');
            return;
          }
        else if(data == 'already')
          {
            window.open(siteUrl+'teacher/create_course_dashboard','_self');
            return;
          }
        else{
              alert(data);
              return;       
          }                                                               
      }

    });

}



// ===============Course create step==2===

function CreateCourse2(){


        var coursePrice=$('#coursePrice').val();
        var offerPrice=$('#offerPrice').val();
        var slug=$('#slug').val();
        var courseOverview=$('#courseOverview').val();




        if(coursePrice == '' || offerPrice == '' || slug == '' ||  courseOverview == '' ){ 
        $('.CreateErrorBox').html('Please fill all fields'); return; }

        // alert(rating); return;

        formData = new FormData();
        formData.append('coursePrice', coursePrice);
        formData.append('offerPrice', offerPrice);
        formData.append('slug', slug);
        formData.append('courseOverview', courseOverview);

        $.ajax({
        url: siteUrl+'lms/Teacher/CreateCourse2',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,                          

        success: function (data) {

          // alert(data); die();

        if(data == 'Created' )
          {
            window.open(siteUrl+'teacher/create_course_dashboard_media','_self');
            return;
          }
        else if(data == 'already')
          {
            window.open(siteUrl+'teacher/create_course_dashboard_media','_self');
            return;
          }
        else{
              $('.CreateErrorBox').html(data); 
              return;       
          }                                                               
      }

    });

}
// =======================================


// ======================Sub Category==================
function getSubCat(){
        var courseCat=$('#courseCat').val();
        formData = new FormData();
        formData.append('courseCat', courseCat);
        $.ajax({
        url: siteUrl+'lms/Teacher/getSubCat',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,                          
        success: function (data) {
             $('#courseSubCat').html(data);
             // alert(data);
              return;                                                                         
      }
    });
}


function selectImage(n){
    var img=$('#mainImage'+n).val();
    var data=img.split('\\');
    var imgtxt=$('#mainImageTxt'+n).val(data[2]);


      formData = new FormData();
      formData.append('mainImage', $('#mainImage'+n)[0].files[0]); 
      formData.append('type', n); 

            $.ajax({
            url: siteUrl+'lms/Teacher/uploadCourseImage',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,                          
            success: function (data) {

              // alert(data); return;
            
                if(data=='updated'){              

                    $('.Notifiy'+n).html('Image Uploaded success');        
                    return;   

                }

              }
            });
}



function readURL(input,n) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
    $('#output'+n)
    .attr('src', e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
    }
}



function selectVideo(){
    var demoVideo=$('#demoVideo'+n).val();


      formData = new FormData();
      formData.append('video', $('#demoVideo'+n)[0].files[0]); 

            $.ajax({
            url: siteUrl+'lms/Teacher/selectVideo',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,                          
            success: function (data) {

              // alert(data); return;
            
                if(data=='updated'){              

                    $('.Notifiy'+n).html('Image Uploaded success');        
                    return;   
                }
              }
            });
}




// ===============Course create step==2===
var hightlight = [];

function CreateCourse3(){

var inputLen=0;
$(".hightlight").each(function(){
 hightlight.push($(this).val()+'_');
 inputLen++;
});


        var description=$('#description').val();

        if(description == '' || hightlight == ''  ){ 
        $('.CreateErrorBox').html('Please fill all fields'); return; }


        formData = new FormData();
        formData.append('hightlight', hightlight);
        formData.append('description', description);
        formData.append('inputLen', inputLen);

        $.ajax({
        url: siteUrl+'lms/Teacher/CreateCourse3',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,                          

        success: function (data) {

        if(data == 'Created' )
          {
             hightlight=[];
             window.open(siteUrl+'teacher/create_course_dashboard_cont','_self');
             return;
          }
          else{
               $('.CreateErrorBox').html(data); 
               return;       
             }                                                               
      }

    });

}
// =======================================


function addMoreInput1(){

var total_ht=$('#total_highlights').val();


var th=parseInt(total_ht)+1;



        $(".whatwillyoulear_content").append(`<div class="form-group col-md-12 mb-2" id="highlightBox${th}">
              <label for="coursetitle" class="fw_700">Content  ${th} </label>
              <div class="d-flex align-items-center justify-content-start">
              <input type="text" class="form-control w-100 rounded-0 form-control-sm 
              hightlight" id="coursetitle" placeholder="Enter Content..." value="">
              </div>
            </div>` );
 
$('#total_highlights').val(th);

// alert(th); return;

}




// ==============Section and Lecture add================

function getAllSection(){

        $.ajax({
        url: siteUrl+'lms/Teacher/allSectionData',
        type: 'POST',
        processData: false,
        contentType: false,                          

        success: function (data) {

                  if(data != ' ' )
                    {
                       $('#AllSectionBox').html(data); 
                       return;
                    }
                    else{
                      $('.CreateErrorBox').html('Please Add Section'); 
                      return;       
                   }                                                               
              }

        });
}






function addSection(){

  var sectionTitle=$('#sectionTitle').val();

     if(sectionTitle == '' ){ $('.CreateErrorBox').html('Please fill Section title'); return; }

        formData = new FormData();
        formData.append('sectionTitle', sectionTitle);

        $.ajax({
        url: siteUrl+'lms/Teacher/addSection',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,                          

        success: function (data) {

          // alert(data); return;
        getAllSection()

        if(data == 'Created' )
          {
             $('.CreateErrorBox').html('Section Added'); 
             return;
          }
          else{
               $('.CreateErrorBox').html(data); 
               return;       
             }                                                               
          }

        });
}




function openSec(n){
 
      if($('#sectionBox'+n).css('display') == 'none'){
          $('.sec_name').css('color','rgb(255, 255, 255)'); 
          $('.sectionIcon').css('transform','rotate(0deg)');           
          $('.sectionBox').hide(400);  
          $('#sectionBox'+n).slideToggle(); 
          $('#sec_name'+n).css('color','#fff'); 
          $('#sectionIcon'+n).css({'transform':'rotate(180deg)' ,'transition':'.5s' });
          return;
      }else{
          $('#sectionBox'+n).hide(400); 
          $('#sec_name'+n).css('color','rgb(255, 255, 255)'); 
          $('#sectionIcon'+n).css({'transform':'rotate(0deg)' , 'transition':'.5s'});
          return;
      }   
}









function editLec(n){
 
      if($('#lecturEditBox'+n).css('display') == 'none'){
          $('.lecturEditBox').hide(400);  
          $('#lecturEditBox'+n).slideToggle(); 
          return;
        }else{
          $('#lecturEditBox'+n).hide(400); 
          return;
        }   

}







// ================Change===file Type====

function fileTypeOpt(id){

      var fileType=$('#sectionBox'+id +' .fileType').val();
      $('.fileUploadeBox').hide();

      if(fileType=='vimeo'){
              $('#sectionBox'+id +' .vimeoLinkBox').show(); 
          }
        else if(fileType=='youtube'){
              $('#sectionBox'+id +' .youtubeLinkBox').show(); 
          }
        else if(fileType=='video'){
              $('#sectionBox'+id +' .videoFileBox').show(); 
          }
           else if(fileType=='pdf'){
              $('#sectionBox'+id +' .pdfFileBox').show(); 
          }

}







function triggerVideo(id){

    var fileType=$('#sectionBox'+id +' .fileType').val();

    // alert(fileType); return;


   if(fileType == 'video'){
      $('#sectionBox'+id +' .videoFile').trigger('click');  
   }else{
      $('#sectionBox'+id +' .pdfFile').trigger('click');
   }

}


function triggerVideo2(id){

    var fileType=$('#lecturEditBox'+id +' .fileType').val();

   if(fileType=='video'){
      $('#lecturEditBox'+id +' .videoFile').trigger('click');  
   }else{
      $('#lecturEditBox'+id +' .pdfFile').trigger('click');
   }

}





function addSecLecture(id){

    var lecTitle=$('#sectionBox'+id +' .lecTitle').val();
    var accessType=$('#sectionBox'+id +' .accessType').val();
    var fileType=$('#sectionBox'+id +' .fileType').val();
    var duration=$('#sectionBox'+id +' .duration').val();
    var section_id=$('#sectionBox'+id +' .section_id').val();

    var lecListBoxId='AllLectureDataBox'+id;


 // return;

    formData = new FormData();
      
            if(fileType=='vimeo'){
                  formData.append('link', $('#sectionBox'+id +' .vimeoLink').val()); 
              }
            else if(fileType=='youtube'){
                  formData.append('link', $('#sectionBox'+id +' .youtubeLink').val()); 
              }
            else if(fileType=='video'){
                  formData.append('file', $('#sectionBox'+id +' .videoFile')[0].files[0]); 
              }
            else{
                  formData.append('file', $('#sectionBox'+id +' .pdfFile')[0].files[0]); 
              }

              formData.append('lecTitle', lecTitle); 
              formData.append('accessType', accessType); 
              formData.append('fileType', fileType); 
              formData.append('duration', duration);
              formData.append('section_id', section_id);

              $.ajax({
              url: siteUrl+'lms/Teacher/addSectionLec',
              type: 'POST',
              data: formData,
              processData: false,
              contentType: false,                          

              success: function (data) {

                    // alert(data); return;

                    if(data == 'Created' )
                      {
                         getAllLectureList(section_id,lecListBoxId);
                         $('.lecBoxSuccess').html('Lecture Added Successfully'); 
                         $('.lecBoxError').html(''); 
                         return;
                      }
                    else{
                         $('.lecBoxSuccess').html(''); 
                         $('.lecBoxError').html(data); 
                         return;       
                       }                                                               
                }

              });

}





function getAllLectureList(section_id,lecListBoxId){

        formData = new FormData();
        formData.append('section_id', section_id);

        $.ajax({
        url: siteUrl+'lms/Teacher/getAllLectureList',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,                          

        success: function (data) {


          // alert(data); return;

                  if(data != ' ' )
                    {
                       $('#'+lecListBoxId).html(data); 
                       return;
                    }
                    else{
                      $('.CreateErrorBox').html('Please Add Section'); 
                      return;       
                   }                                                               
              }

        });
}









function fileTypeOpt2(id){

        var fileType=$('#lecturEditBox'+id +' .fileType2').val();
        $('.fileUploadeBox2').hide();


        // alert(fileType); return; 

  
        if(fileType=='vimeo'){
              $('#lecturEditBox'+id +' .vimeoLinkBox2').show(); 
          }
        else if(fileType=='youtube'){
              $('#lecturEditBox'+id +' .youtubeLinkBox2').show(); 
          }
        else if(fileType=='video'){
              $('#lecturEditBox'+id +' .videoFileBox2').show(); 
        }
        else if(fileType=='pdf'){
              $('#lecturEditBox'+id +' .pdfFileBox2').show(); 
        }
}



function updateSecLecture(id){

    var lecTitle=$('#lecturEditBox'+id +' .lecTitle2').val();
    var accessType=$('#lecturEditBox'+id +' .accessType2').val();
    var fileType=$('#lecturEditBox'+id +' .fileType2').val();
    var duration=$('#lecturEditBox'+id +' .duration2').val();
    var lec_id=$('#lecturEditBox'+id +' .lec_id').val();


    formData = new FormData();
      
        if(fileType=='vimeo'){
              formData.append('link', $('#lecturEditBox'+id +' .vimeoLink2').val()); 
          }
        else if(fileType=='youtube'){
              formData.append('link', $('#lecturEditBox'+id +' .youtubeLink2').val()); 
          }
        else if(fileType=='video'){
              formData.append('file', $('#lecturEditBox'+id +' .videoFile2')[0].files[0]); 
          }
        else{
              formData.append('file', $('#lecturEditBox'+id +' .pdfFile2')[0].files[0]); 
          }

              formData.append('lecTitle', lecTitle); 
              formData.append('accessType', accessType); 
              formData.append('fileType', fileType); 
              formData.append('duration', duration);
              formData.append('lec_id', lec_id);

              $.ajax({
              url: siteUrl+'lms/Teacher/updateSecLecture',
              type: 'POST',
              data: formData,
              processData: false,
              contentType: false,                          

              success: function (data) {

                    // alert(data); return;

                    if(data == 'Updated' )
                      {
                         $('.lecBoxSuccess').html('Lecture Added Successfully'); 
                         $('.lecBoxError').html(''); 
                         return;
                      }
                    else{
                         $('.lecBoxSuccess').html(''); 
                         $('.lecBoxError').html(data); 
                         return;       
                       }                                                               
                }

              });

}














function deleteSecListBox(sid){

 
    formData = new FormData();
    formData.append('sid', sid);

          $.ajax({
          url: siteUrl+'lms/Teacher/deleteSecBox',
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,                          

          success: function (data) {

            if(data == 'deleted' )
              {
                  getAllSection();

                 $('.CreateErrorBox').html('Section Deleted'); 
                 $('#secListBox'+n).remove(); 
                 return;
              }
            else{
                 $('.CreateErrorBox').html(data); 
                 return;       
               }                                                                
          }
    });


}



function deleteLec(n){
 

        formData = new FormData();
        formData.append('id', n);

        $.ajax({
        url: siteUrl+'lms/Teacher/deleteSecLec',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,                          

        success: function (data) {

          // getAllLectureList(section_id,lecListBoxId)

        if(data == 'deleted' )
          {
             $('.CreateErrorBox').html('Lecture Deleted'); 
             $('#lectureTab'+n).remove(); 
             $('#lecturEditBox'+n).remove(); 
             return;
          }
          else{
                 $('.CreateErrorBox').html(data); 
                 return;       
             }                                                               
          }

        });

}






// ============Add===coupon=====

function addCoupon(){
 
 // getAllCoupon(); return;

  var couponTitle=$('#couponTitle').val();
  var start_date=$('#start_date').val();
  var exp_date=$('#exp_date').val();
  var discount=$('#discount').val();

     if(couponTitle == '' || start_date == '' || exp_date == '' || discount == '' ){ 
      $('.CreateErrorBox').html('Please fill Coupon Code'); return; }

        formData = new FormData();
        formData.append('couponTitle', couponTitle);
        formData.append('start_date', start_date);
        formData.append('exp_date', exp_date);
        formData.append('discount', discount);

        $.ajax({
        url: siteUrl+'lms/Teacher/addCoupon',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,                          

        success: function (data) {

          // alert(data);          

        if(data == 'Created' )
          {

             getAllCoupon();
             $('.CreateErrorBox').html('Coupon Created'); 
             return;
          }
          else{
               $('.CreateErrorBox').html(data); 
               return;       
             }                                                               
          }

        });
}


// ==============get all Coupon================

function getAllCoupon(){

        $.ajax({
        url: siteUrl+'lms/Teacher/getAllCoupon',
        type: 'POST',
        processData: false,
        contentType: false,                          

        success: function (data) {

          // alert(data); return;
          
                  if(data != ' ' )
                    {
                       $('#allCouponCodeListBox').html(data); 
                       return;
                    }
                    else{
                      $('.CreateErrorBox').html('Please Add Some Coupons'); 
                      return;       
                   }                                                               
              }

        });
}




function editCouponCode(n){
 
      if($('#CouponCodeEditBox'+n).css('display') == 'none'){
          $('.CouponCodeEditBox').hide(400);  
          $('#CouponCodeEditBox'+n).slideToggle(); 
          return;
        }else{
          $('#CouponCodeEditBox'+n).hide(400); 
          return;
        }   

}


function updateCouponCode(id){

    var coupon_code=$('#CouponCodeEditBox'+id +' .coupon_code').val();
    var start_date=$('#CouponCodeEditBox'+id +' .start_date').val();
    var exp_date=$('#CouponCodeEditBox'+id +' .exp_date').val();
    var discount=$('#CouponCodeEditBox'+id +' .discount').val();


              formData = new FormData();
              formData.append('coupon_code', coupon_code); 
              formData.append('start_date', start_date); 
              formData.append('exp_date', exp_date); 
              formData.append('discount', discount);
              formData.append('coupon_id', id);

              $.ajax({
              url: siteUrl+'lms/Teacher/updateCouponCode',
              type: 'POST',
              data: formData,
              processData: false,
              contentType: false,                          

              success: function (data) {

                    // alert(data); return;

                    if(data == 'Updated' )
                      {
                         $('.couponSuccess').html('Coupon Updated Successfully'); 
                         $('.couponError').html(''); 
                         return;
                      }
                    else{
                         $('.couponSuccess').html(''); 
                         $('.couponError').html(data); 
                         return;       
                       }                                                               
                }

              });

}



function deleteCouponCode(coupon_id){

 
    formData = new FormData();
    formData.append('coupon_id', coupon_id);

          $.ajax({
          url: siteUrl+'lms/Teacher/deleteCouponCode',
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,                          

          success: function (data) {

            if(data == 'deleted' )
              {
                  // getAllCoupon();
                 $('.couponError').html('Coupon  Deleted'); 
                 $('#couponCodeTab'+coupon_id).remove(); 
                 return;
              }
            else{
                 $('.couponError').html(data); 
                 return;       
               }                                                                
          }
    });


}






function addAnnounc(){

  var course_id=$('#course_id').val();
  var content=$('#content').val();


  if( course_id == ''  || content == ''  ){ $('.announceError').html('Please fill all Fields'); return; }


    formData = new FormData();
    formData.append('course_id',  course_id);
    formData.append('content', content);
    formData.append('post_image', $('#post_image')[0].files[0]); 

    $.ajax({
    url: siteUrl+'lms/Teacher/addAnnounc',
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,                          

            success: function (data) {

                // alert(data); return;

                if(data=='Created'){

                  $('.announceError').html('Announcement Posted');                
                  return;

                }else{ $('.announceError').html(data); return; }       
                                                                         
            }
    });


}




function updateAnnounc(n){

  var posted_course_id=$('#posted_course_id'+n).val();
  var posted_content=$('#posted_content'+n).val();
  var posted_image=$('#posted_image'+n).val();

  if( posted_content == '' ){ $('.announceError').html('Please fill all Fields'); return; }

    formData = new FormData();
    formData.append('course_id',  posted_course_id);
    formData.append('content', posted_content);

    if(posted_image){
      formData.append('posted_image', $('#posted_image'+n)[0].files[0]); 
    }


    $.ajax({
    url: siteUrl+'lms/Teacher/updateAnnounc',
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,                          

            success: function (data) {

                // alert(data); return;

                if(data=='updated'){

                  location.reload();                
                  return;

                }else{ $('.announceError').html(data); return; }       
                                                                         
            }
    });


}





function deleteAnnounc(n){


  if( n == '' ){ $('.announceError').html('Please fill all Fields'); return; }

    formData = new FormData();
    formData.append('id',  n);
    

    $.ajax({

        url: siteUrl+'lms/Teacher/deleteAnnounc',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,                          

            success: function (data) {

              // alert(data); return;

                if(data=='deleted'){

                  $('#postedBox'+n).remove();               
                  return;

                }else{ $('.announceError').html(data); return; }       
                                                                         
            }
    });
}













// ================Enter==event=====


document.onkeydown = function(e) {


      if($('#focusPoint').val() == 'addSection' )
        {
            if (e.keyCode == '13') {
                  $( ".addSectionBtn" ).trigger('click');
              }
        }
       
}

