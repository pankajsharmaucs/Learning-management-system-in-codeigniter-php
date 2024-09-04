  <nav class="sidebar sidebar-offcanvas teachercoursedashboardsidebar" id="sidebar">
  <ul class="" type="none">
    <li class="my-3 mx-3 f_16 fw_700">
      Plan your course
    </li>




<?php

$stepData=array('Basic Details','Image/Demo','Description','Content','Create Coupon');
$linkData=array('','create_course_dashboard','create_course_dashboard_media','create_course_dashboard_desc'
  ,'create_course_dashboard_cont','create_course_coupon');

$id=1;
  foreach ($stepData as $key ) {

    $link=$linkData[$id];

   if($createstep==$id){ 

      echo '<li class="nav-item active">
        <a class="nav-link d-flex" href="'.$link.'">
        <span class="icon mr-2">
          <i class="fas fa-check f_10"></i>
        </span>
        <span class="menu-title text-dark fw_400">'.$key.'</span>
      </a>
    </li>';

   }
         else{

          echo '<li class="nav-item ">
              <a class="nav-link d-flex" href="'.$link.'">
              <span class="icon mr-2">
              </span>
              <span class="menu-title text-dark fw_400">'.$key.'</span>
            </a>
          </li>';

         } 


$id++;  } 



 ?>
      
    

    
  </ul>
</nav>
