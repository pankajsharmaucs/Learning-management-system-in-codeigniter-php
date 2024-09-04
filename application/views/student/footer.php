


<!-- ============Student===js==== -->

  <script src="<?=base_url('assets/')?>student/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?=base_url('assets/')?>student/js/off-canvas.js"></script>
  <script src="<?=base_url('assets/')?>student/js/hoverable-collapse.js"></script>
  <script src="<?=base_url('assets/')?>student/js/template.js"></script>
  <script src="<?=base_url('assets/')?>student/js/dashboard.js"></script>
  <script src="<?=base_url('assets/')?>lms/js/main.js"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js"></script>

  <script>



$(function() {
  $('.chart').easyPieChart({
    size: 40,
    barColor: "#FD7F23",
    scaleLength: 0,
    lineWidth: 3,
    trackColor: "#eee",
    lineCap: "circle",
    animate: 2000,
  });
});






	function manage_bigscreen(){
		var w = window.innerWidth;
	 if(w > 1600){	
      $('.page-body-wrapper').removeClass('container container-fluid');
      $('.page-body-wrapper').addClass('container');
	} 
	 else{
      $('.page-body-wrapper').removeClass('container-fluid container');
      $('.page-body-wrapper').addClass('container-fluid');
	} 
}
	manage_bigscreen();
  </script>

<!-- ================upload file=============== -->

<script type="text/javascript">
	

document.querySelector("html").classList.add('js');

var fileInput  = document.querySelector( ".input-file" ),  
    button     = document.querySelector( ".input-file-trigger" ),
    the_return = document.querySelector(".file-return");
      
button.addEventListener( "keydown", function( event ) {  
    if ( event.keyCode == 13 || event.keyCode == 32 ) {  
        fileInput.focus();  
    }  
});
button.addEventListener( "click", function( event ) {
   fileInput.focus();
   return false;
});  
fileInput.addEventListener( "change", function( event ) {  
    the_return.innerHTML = this.value;  
});  


</script>

<!-- ===================player============ -->
<script type="text/javascript">
   $("#PlayButton").click(function(){
    $('.video_payer_box').css('display','none');
      $("#video_1")[0].src += "?autoplay=1";
      // alert()
     });


   // ================desctiption================

   $('#studentShowmore').click(function (){
     
    $('.description').toggle(100,function(){
      // $('.showmore').text('less');
    });
    
})
    // ======================announcments=================
    $('#studentAnnouncShowmore').click(function (){
     
    $('.announcementsdescription').toggle(100,function(){
      // $('.showmore').text('less');
    });
     })  

   // ==================sidebar==hide=btn====================

    $('.studentSidebarClosed').click(function(){
      $('.playsidebarbox').hide();
      $('.studentSidebarOpen').show();
      $('.mycourseplayer').removeClass('col-lg-8');
      $('.mycourseplayer').addClass('col-lg-12');
    })
  // =====================sidebar==show=btn=================
    $('.studentSidebarOpenbtn').click(function(){
      $('.playsidebarbox').show();
      $('.studentSidebarOpen').hide();
      $('.mycourseplayer').removeClass('col-lg-12');
      $('.mycourseplayer').addClass('col-lg-8');
    })
    

</script>



</body>
</html>