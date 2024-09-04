<?php 

$course_category=$this->admin->get_course_category();

// var_dump($course_category); die();
 ?>



<section class="category_section bg_10 py-4">
	<div class="container">
		<div class=" row d-flex justify-content-start">

<?php if($course_category){ foreach ($course_category as $key ) { $cat_id=$key['cat_id']; ?>
			

<?php  

$cdata=$this->admin->get_course_data_by_cat_id($cat_id,'course_data','course_name','total_article','slug'
	,'course_img','course_id');
if($cdata){ ?>

			<div class="col-12 pl-md-0 my-2">
				<h2 class="f_25 rt_20 tc_3"><?= $key['name'] ?></h2>
			</div>
<?php

foreach ($cdata as $ckey ) { 
$name=$ckey['course_name']; 
$total_article=$ckey['total_article']; 
$course_img=$ckey['course_img']; 
$course_id=$ckey['course_id']; 
$slug=$ckey['slug']; 
$slug= str_replace(' ', '-', $slug); 

?>

				<div class="col-md-4 pl-md-0 mb-md-2 mb-2">
				   <a target="_blank" href="<?=base_url('course/')?><?= $slug ?>">
					<div class="category_content cp shadow d-flex align-items-center justify-content-start">
						<div class="icon" style="background-color: #0A77BB; overflow: hidden;">
							<img src="<?=base_url('assets/course_data/')?><?= $course_id ?>/<?= $course_img ?>" alt="<?= $name ?>" width="100%" height="100%" >
						</div>
						<div class="icon_content">
							<h3 class="f_18 rt_16 fw_500 mb-1 tc_3"><?= $name ?></h3>
							<h4 class="f_16 rt_14 fw_400 text-dark"><span  class="fw_500"><?= $total_article ?></span> Lessons</h4>
						</div>
					</div>
				  </a>
			   </div>
<?php } } ?>


<?php } } ?>

		</div>
	</div>
</section>