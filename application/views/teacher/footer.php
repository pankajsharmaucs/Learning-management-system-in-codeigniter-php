


<!-- ============Teacher===js==== -->

  <script src="<?=base_url('assets/')?>teacher/js/teacher.js"></script>


  <script src="<?=base_url('assets/')?>teacher/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?=base_url('assets/')?>teacher/js/off-canvas.js"></script>
  <script src="<?=base_url('assets/')?>teacher/js/hoverable-collapse.js"></script>
  <script src="<?=base_url('assets/')?>teacher/js/template.js"></script>
  <script src="<?=base_url('assets/')?>teacher/js/dashboard.js"></script>
  <script src="<?=base_url('assets/')?>teacher/custome-js/jquery.richtext.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">
  
$( document ).ready(function() {
    setTimeout(function(){$('.preLoader1').hide();},1000);
});

</script>


 

  <script>
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



  <!-- ===============append what will you learn================ -->
<script type="text/javascript">


  //  $("#removewhatwill").click(function(){
  //   $(this).remove();
  // });
</script>


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

<script type="text/javascript">
  // ===========================accordion==============
  // $('.toggle1').click(function(e) {
  //       e.preventDefault();
  //       let $this = $(this);
  //           // $this.next().slideUp(350);
  //       if ($this.next().hasClass('show')) {
  //           $this.next().removeClass('show');
  //           $this.next().slideUp(350);

  //       } else {
  //           $this.parent().parent().find('li .inner').removeClass('show');
  //           $this.parent().parent().find('li .inner').slideUp(350);
  //           $this.next().toggleClass('show');
  //           $this.next().slideToggle(350);
  //       }
  // }); 
</script>


</body>
</html>