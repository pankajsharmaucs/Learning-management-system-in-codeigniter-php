<?php 

$cid=$_SESSION['current_course_id'];
$courseCat=$this->Admin->get_course_data_by_id($cid,'course_data','slug','overview','offer_price','course_price','course_status'); 

if($courseCat[0]['course_status'] == 0){}
   else{ redirect(base_url('/teacher-dashboard?res=This Course is already for Approval'));  die(); }

 ?>