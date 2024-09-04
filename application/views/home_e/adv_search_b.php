<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
	 <meta charset="UTF-8">
	 <meta name="description" content="">
	 <meta name="keywords" content="">
	 <meta name="author" content="">
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- ---link----- -->
	 <?php include 'link_b.php'; ?>
	 <!-- ----end------ -->

</head>
<body>


<!-- ====================search======================= -->
<section class="bg_5 mb-2">
	<div class="container-fluid bg-white desktop_search_panel">
		<div class="container">
			<div class="row">
			  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
	             <div class=" search_res py-3 d-flex justify-content-between flex-wrap align-items-center">

	             	<div class="">
					<div class="search_content p-3 d-flex justify-content-center" >
					 <div class="">
					 	<form>
					 	 <select class="">
					 	 	<option>Country</option>
					 	 	<option>Country</option>
					 	 	<option>Country</option>
					 	 	<option>Country</option>
					 	 </select>
					 	 <input type="search" name="" class="search mb-2" placeholder="Search">
					 	 <button>Search</button>
					 	</form>
					 </div>
					
					</div>

				</div>

	             	<div class="filter_grid d-flex">
	             	 <div class="tc_3 search_gridbtn fw_400">
	             	 	<i class="fas fa-th-large"></i> Grid
	             	 </div>
	             	 <div class="tc_2 ml-4 tc_1 search_listbtn fw_400">
	             	 	<i class="fas fa-th-list"></i> List
	             	 </div>
	             	</div>


	             </div>

	           </div>
            </div>
        </div>
	</div>

	<!-- ---------mobile-filters------------------ -->
       
		


		<div class="container mobile_filters_section ">
			
			<div class="row">
			  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-2 px-3">
	             <div class="search_right mobile_search p-3 d-flex justify-content-around flex-wrap align-items-center bg-white">
	             	<form class="d-flex">
	             		<input type="text" name="" placeholder="Search..." class="pl-2 f_13">
	             		<button class=""><img src="assets/images/svg/loupe.svg" class="" alt="" height="20px" width="20px"></button>
	             	</form>
	             </div>

	           </div>
            </div>

			<div class="row">
			  <div class="search_rightcol-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-2">
	             <div class="search_right mobile_filters p-3 d-flex justify-content-around flex-wrap align-items-center bg-white">
	             	<div class="sort sortBtn" data-toggle="modal" data-target="#sortModel">
	             		<span class="f_15"><img src="assets/images/svg/sort-2.svg" alt="" height="13px" width="13px" class="mr-2"> Sort </span>
	             	</div>
	             	<div class="filter filterBtn">
	             		<span class="f_14"><img src="assets/images/svg/filter-results-button.svg" alt="" height="13px" width="13px" class="mr-2"> Filter</span>
	             	</div>
	             </div>

	           </div> 
            </div>
        </div>

        <!-- ------mobile_sidebar----- -->
        <div class="mobile_sidebar">
        	<div class="mobile_sidebar_header text-white bg_2 d-flex justify-content-between px-3 py-2">
        		<div>
        			<i class="mobile_sidebar_header_backbtn fas fa-arrow-left fa-sm"></i>&nbsp;&nbsp; <span class="f_15 text-white">Filters</span>
        		</div>
        		<div class="mobile_sidebar_clear_filter">
        			<span class="f_13">Clear filters</span>
        		</div>
        	</div>

        	<div class="mobile_sidebar_content d-flex justify-content-between">
        		<div class="mobile_sidebar_content_left bg_5 p-3 f_15">
        			<div class=""><span class="rt_13" onclick="showSidebarContent(1)" id="amo1">Industry Type</span></div>
        			<div><span class="rt_13" onclick="showSidebarContent(2)" id="amo2">Company Type</span></div>
        			<div><span  class="rt_13 text-nowrap" onclick="showSidebarContent(3)">Registrar of Company</span></div>
        			<div><span  class="rt_13" onclick="showSidebarContent(4)">Status</span></div>
        			<div><span class="rt_13 text-nowrap" onclick="showSidebarContent(5)">Listed or Unlisted</span></div>
        			<div><span  class="rt_13" onclick="showSidebarContent(6)">Paid Up Capital</span></div>

        		
        			
        		</div>
        		<div class="mobile_sidebar_content_right bg_0 p-3" id="mobileSidebarContent1">
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">Agree-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			
        		</div>

        		<div class="mobile_sidebar_content_right bg_0 p-3" id="mobileSidebarContent2">
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">Agree-2</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			
        		</div>

        		<div class="mobile_sidebar_content_right bg_0 p-3" id="mobileSidebarContent3">
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">Agree-3</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			
        		</div>

        		<div class="mobile_sidebar_content_right bg_0 p-3" id="mobileSidebarContent4">
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">Agree-4</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			
        		</div>

        		<div class="mobile_sidebar_content_right bg_0 p-3" id="mobileSidebarContent5">
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">Agree-5</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			
        		</div>

        		<div class="mobile_sidebar_content_right bg_0 p-3" id="mobileSidebarContent6">
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">Agree-6</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			
        		</div>



        	</div>

            <div class="mobile_sidebar_content_bottom bg_3 p-2 d-flex justify-content-around align-items-center" >
            	<div class="text-center">
            		 <span class="f_13 mobile_sidebar_checkbox_result">0&nbsp;&nbsp; Filter Selected</span>
            	</div>
            	<div class="text-center">
            		 <button class="button_1 bg_4 py-1 px-5">Apply</button>
            	</div>
            </div>

        </div>
	

	<!-- -------------------end----------------- -->



	 <!-- ------mobile_sort----- -->
	 <!-- Modal -->
		<div class="modal fade" id="sortModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered align-items-end d-flex justify-content-end" role="document">
		    <div class="modal-content">
		      
		      <div class="modal-body">
		       <div class="">
		        	<div class="mobile_sort_content p-2">
		        		<div class="mobile_sort_header border-bottom pb-1 f_15">
		        			<span class="">Sort By</span>
		        		</div>
		        		<div class="d-flex justify-content-between mt-1 f_14 fw_500 px-2">
		        			<span class="fw_400">A to Z</span>
		        			<input type="radio"  name="sort" value="sort">
		        		</div>
		        		<div class="d-flex justify-content-between mt-1 f_14 fw_500 px-2">
		        			<span class="fw_400">A to Z</span>
		        			<input type="radio"  name="sort" value="sort">
		        		</div>
		        		<div class="d-flex justify-content-between mt-1 f_14 fw_500 px-2">
		        			<span class="fw_400">A to Z</span>
		        			<input type="radio"  name="sort" value="sort">
		        		</div>
		        		<div class="d-flex justify-content-between mt-1 f_14 fw_500 px-2">
		        			<span class="fw_400">A to Z</span>
		        			<input type="radio"  name="sort" value="sort">
		        		</div>

		        	</div>
		        </div>
		      </div>
		     
		    </div>
		  </div>
		</div>
        <!-- <div class="mobile_sort" style="z-index: 20000">
        	<div class="mobile_sort_content p-2" style="z-index: 3000000">
        		<div class="mobile_sort_header border-bottom pb-1 f_15">
        			<span class="">Sort By</span>
        		</div>
        		<div class="d-flex justify-content-between mt-1 f_14 fw_500 px-2">
        			<span>A to Z</span>
        			<input type="radio"  name="sort" value="sort">
        		</div>
        		<div class="d-flex justify-content-between mt-1 f_14 fw_500 px-2">
        			<span>A to Z</span>
        			<input type="radio"  name="sort" value="sort">
        		</div>
        		<div class="d-flex justify-content-between mt-1 f_14 fw_500 px-2">
        			<span>A to Z</span>
        			<input type="radio"  name="sort" value="sort">
        		</div>
        		<div class="d-flex justify-content-between mt-1 f_14 fw_500 px-2">
        			<span>A to Z</span>
        			<input type="radio"  name="sort" value="sort">
        		</div>

        	</div>
        </div> -->
	

	<!-- -------------------end----------------- -->
	



	<div class="container py-0 py-xl-3 py-md-2 py-lg-3">

		<div class="row">
			
			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12  search_left_pannel">
				<form>
				<div class="search_left bg-white mr-2">
					<div class="search_content p-3">
					 
					 <div class="search_title fw_500 f_16 d-flex justify-content-between">
					  <div>Industry Type</div>
					  <div class="f_14">Clear <i class="fa fa-times f_12"></i></div>
					 </div>
					 
					 <div class="search_box pt-3">
					 	<input type="" name="" class="search w-100"  id="search" placeholder="Select Industry Type">
					 </div>
					 
					 <div class="search_add mt-3 d-flex flex-wrap">
					 	<div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 </div>
					
					</div>
				</div>


				<div class="search_left bg-white mr-2 mt-2">
					<div class="search_content p-3">
					 
					 <div class="search_title fw_500 f_16 d-flex justify-content-between">
					  <div>Company Type</div>
					  <div class="f_14">Clear <i class="fa fa-times f_12"></i></div>
					 </div>
					 
					 <div class="search_box pt-3">
					 	<input type="" name="" class="w-100" placeholder="Select Company Type">
					 </div>
					 
					  <div class="search_add mt-3 d-flex flex-wrap">
					 	<div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 </div>
					
					</div>
				</div>

				<div class="search_left bg-white mr-2 mt-2">
					<div class="search_content p-3">
					 
					 <div class="search_title fw_500 f_16 d-flex justify-content-between">
					  <div>Registrar of Company / Location</div>
					  <div class="f_14">Clear <i class="fa fa-times f_12"></i></div>
					 </div>
					 
					 <div class="search_box pt-3">
					 	<input type="" name="" class="w-100" placeholder="Select Registrar of Company / Location Type">
					 </div>
					 
					  <div class="search_add mt-3 d-flex flex-wrap">
					 	<div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 </div>
					
					</div>
				</div>

                <div class="search_left bg-white mr-2 mt-2">
                    <div class="search_content p-3">
                     
                     <div class="search_title fw_500 f_16 d-flex justify-content-between">
                      <div>Min/Max Capital</div>
                     </div>
                     
                     <div class="search_box pt-3 d-flex">
                        <input type="number" name="" class="w-50 mr-3" placeholder="Min Capital">
                        <input type="number" name="" class="w-50" placeholder="Max Capital">
                     </div>
                     
                    </div>
                </div>

				<div class="search_left bg-white mr-2 mt-2">
					<div class="search_content p-3">
					 
					 <div class="search_title fw_500 f_16 d-flex justify-content-between">
					  <div>Status</div>
					  <div class="f_14">Clear <i class="fa fa-times f_12"></i></div>
					 </div>
					 
					 <div class="search_box pt-3">
					 	<input type="" name="" class="w-100" placeholder="Select Status Type">
					 </div>
					 
					  <div class="search_add mt-3 d-flex flex-wrap">
					 	<div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 </div>
					
					</div>
				</div>

				<div class="search_left bg-white mr-2 mt-2">
					<div class="search_content p-3">
					 
					 <div class="search_title fw_500 f_16 d-flex justify-content-between">
					  <div>Listed or Unlisted</div>
					  <div class="f_14">Clear <i class="fa fa-times f_12"></i></div>
					 </div>
					 
					 <div class="search_box pt-3">
					 	<input type="" name="" class="w-100" placeholder="Select Listed or Unlisted Type">
					 </div>
					 
					  <div class="search_add mt-3 d-flex flex-wrap">
					 	<div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 </div>
					
					</div>
				</div>

				

			</form>

			</div>
			<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 p-xl-0 p-lg-0 mt-md-0 mt-2 ">

               

				<div class="search_right bg-white p-3 d-flex justify-content-between flex-wrap align-items-center">
					
                    <div>
	             	 <h3 class="f_18 fw_400 mt-2 rt_14">650 Result Found</h3>
	             	</div>
                  
                  <div class="justify-content-xl-end d-flex flex-wrap justify-content-start">

					<div class="search_sort text-right d-xl-inline d-lg-inline d-none">
					<div class="dropdown_sort">
					 <div class="sort_wrap">
					  <span class="f_14">Sort By :</span>
					  <i class="fas fa-chevron-down ml-4 f_14"></i>
					   </div>
					  <div class="dropdown-content_sort">
					   <a href="">A-Z</a href="">
					   <a href="">Z-A</a href="">
					   <a href="">0-9</a href="">
					   <a href="">9-0</a href="">
					  </div>
					</div>
				</div>

				 <!-- <select class="f_14 show_entry">
				    <option value="0" class="">Show entries: </option>
					  

				    <option value="1">10</option>
				    <option value="2">50</option>
				    <option value="3">100</option>
				  </select> -->

				  <div class="search_sort text-right ml-xl-2 ml-lg-2 ml-md-2 d-lg-inline d-none">
					<div class="dropdown_sort ">
					 <div class="sort_wrap">
					  <span class="f_14">Show entries :</span>
					  <i class="fas fa-chevron-down ml-4 f_14"></i>
					   </div>
					  <div class="dropdown-content_sort dropdown-content_entries">
					   <a href="">10</a href="">
					   <a href="">50</a href="">
					   <a href="">100</a href="">
					   <a href="">250</a href="">
					  </div>
					</div>
				</div>

				<div class="search_sort text-right ml-xl-2 ml-lg-2 ml-md-2 d-md-inline d-xl-none d-lg-none ">
					<select class="f_12 py-1 px-3 tc_3">
						<option>Show entries</option>
						<option>10</option>
						<option>20</option>
						<option>30</option>
						<option>40</option>
					</select>
				</div>


			  </div>
				</div>

                <div class="search_right bg-white p-2 mt-2 d-flex justify-content-end align-items-center px-3 d-inline d-xl-none d-lg-none">
                   <div class="filter_grid d-flex">
                     <div class="tc_3 search_gridbtn f_13">
                        <i class="fas fa-th-large "></i> Grid
                     </div>
                     <div class="tc_2 ml-4 tc_1 search_listbtn f_13">
                        <i class="fas fa-th-list"></i> List
                     </div>
                    </div>
               </div>


             <div class="search_right search_link bg-white mt-2 p-3 pb-2 search_list">
				<!-- <div class="search_sort text-right">
					<div class="dropdown_sort">
					 <div class="sort_wrap">
					  <span class="f_14">Sort</span>
					   <img src="assets/images/svg/sort.svg" alt="" height="15px" width="15px;">
					   </div>
					  <div class="dropdown-content_sort">
					   <a href="">A-Z</a href="">
					   <a href="">Z-A</a href="">
					   <a href="">0-9</a href="">
					   <a href="">9-0</a href="">
					  </div>
					</div>
				</div> -->

				<table class="w-100 mt-2">
					
						<tr class="">
							<th class="rt_13 f_14 tc_1">Company Name</th>
							<th class="rt_13 f_14 tc_1">Corporate Identification No</th>
							<th class="rt_13 f_14 tc_1">Status</th>
							
						</tr>
					
						<tr>
							<td><a href="" class="rt_11">WHITE ORGANIC AGRO LIMITED</a></td>
							<td class="rt_11">WHITE ORGANIC AGRO LIMITED</td>
							<td class="active rt_11">Active</td>
							
						</tr>
						<tr>
							<td><a href="" class="rt_11">WHITE ORGANIC AGRO LIMITED</a></td>
							<td class="rt_11">WHITE ORGANIC AGRO LIMITED</td>
							<td class="active rt_11">Active</td>
							
						</tr>
						<tr>
							<td><a href="" class="rt_11">WHITE ORGANIC AGRO LIMITED</a></td>
							<td class="rt_11">WHITE ORGANIC AGRO LIMITED</td>
							<td class="active rt_11">Active</td>
							
						</tr>
						<tr>
							<td><a href="" class="rt_11">WHITE ORGANIC AGRO LIMITED</a></td>
							<td class="rt_11">WHITE ORGANIC AGRO LIMITED</td>
							<td class="active rt_11">Active</td>
							
						</tr>

                        <tr>
                            <td><a href="" class="rt_11">WHITE ORGANIC AGRO LIMITED</a></td>
                            <td class="rt_11">WHITE ORGANIC AGRO LIMITED</td>
                            <td class="active rt_11">Active</td>
                            
                        </tr>

                        <tr>
                            <td><a href="" class="rt_11">WHITE ORGANIC AGRO LIMITED</a></td>
                            <td class="rt_11">WHITE ORGANIC AGRO LIMITED</td>
                            <td class="active rt_11">Active</td>
                            
                        </tr>
                        <tr>
                            <td><a href="" class="rt_11">WHITE ORGANIC AGRO LIMITED</a></td>
                            <td class="rt_11">WHITE ORGANIC AGRO LIMITED</td>
                            <td class="active rt_11">Active</td>
                            
                        </tr>
                        <tr>
                            <td><a href="" class="rt_11">WHITE ORGANIC AGRO LIMITED</a></td>
                            <td class="rt_11">WHITE ORGANIC AGRO LIMITED</td>
                            <td class="active rt_11">Active</td>
                            
                        </tr>
                        

					
				</table>


				</div>

				<div class="search_right mt-2 bg-white p-3 search_grid">
					
					<div class="row ">
			         <div class="col-xl-4 mb-3 col-lg-4 col-md-4 col-sm-6 col-12">
                      <div class="card_grid shadow-sm p-3 border">
                      	<div class="">
                      		<div>
                      		 <span class="f_13 fw_500 ">Company Name</span>
                      	    </div>
                      	     <div>
                      		 <span class="f_12 fw_300"><a href="" class="tc_4">WHITE ORGANIC AGRO LIMITED</a></span>
                      	    </div>
                      	</div>
                      	<div class="">
                      		<div>
                      		 <span class="f_13 fw_500">CIN</span>
                      	    </div>
                      	     <div>
                      		 <span class="f_12 fw_300">L01131KA1943PLC000833</span>
                      	    </div>
                      	</div>
                      	<div class="">
                      		<div>
                      		 <span class="f_13 fw_500">Status</span>
                      	    </div>
                      	     <div>
                      		 <span class="f_12 fw_300 text-success">Active</span>
                      	    </div>
                      	</div>
                      </div>
                     </div>
                      
                       <div class="col-xl-4 mb-3 col-lg-4 col-md-4 col-sm-6 col-12">
                      <div class="card_grid shadow-sm p-3 border">
                      	<div class="">
                      		<div>
                      		 <span class="f_13 fw_500">Company Name</span>
                      	    </div>
                      	     <div>
                      		 <span class="f_12 fw_300"><a href="" class="tc_4">WHITE ORGANIC AGRO LIMITED</a></span>
                      	    </div>
                      	</div>
                      	<div class="">
                      		<div>
                      		 <span class="f_13 fw_500">CIN</span>
                      	    </div>
                      	     <div>
                      		 <span class="f_12 fw_300">L01131KA1943PLC000833</span>
                      	    </div>
                      	</div>
                      	<div class="">
                      		<div>
                      		 <span class="f_13 fw_500">Status</span>
                      	    </div>
                      	     <div>
                      		 <span class="f_12 fw_300 text-success">Active</span>
                      	    </div>
                      	</div>
                      </div>
                     </div>
                     
                       <div class="col-xl-4 mb-3 col-lg-4 col-md-4 col-sm-6 col-12">
                      <div class="card_grid shadow-sm p-3 border">
                      	<div class="">
                      		<div>
                      		 <span class="f_13 fw_500">Company Name</span>
                      	    </div>
                      	     <div>
                      		 <span class="f_12 fw_300"><a href="" class="tc_4">WHITE ORGANIC AGRO LIMITED</a></span>
                      	    </div>
                      	</div>
                      	<div class="">
                      		<div>
                      		 <span class="f_13 fw_500">CIN</span>
                      	    </div>
                      	     <div>
                      		 <span class="f_12 fw_300">L01131KA1943PLC000833</span>
                      	    </div>
                      	</div>
                      	<div class="">
                      		<div>
                      		 <span class="f_13 fw_500">Status</span>
                      	    </div>
                      	     <div>
                      		 <span class="f_12 fw_300 text-success">Active</span>
                      	    </div>
                      	</div>
                      </div>
                     </div>

                       <div class="col-xl-4 mb-3 col-lg-4 col-md-4 col-sm-6 col-12">
                      <div class="card_grid shadow-sm p-3 border">
                      	<div class="">
                      		<div>
                      		 <span class="f_13 fw_500">Company Name</span>
                      	    </div>
                      	     <div>
                      		 <span class="f_12 fw_300"><a href="" class="tc_4">WHITE ORGANIC AGRO LIMITED</a></span>
                      	    </div>
                      	</div>
                      	<div class="">
                      		<div>
                      		 <span class="f_13 fw_500">CIN</span>
                      	    </div>
                      	     <div>
                      		 <span class="f_12 fw_300">L01131KA1943PLC000833</span>
                      	    </div>
                      	</div>
                      	<div class="">
                      		<div>
                      		 <span class="f_13 fw_500">Status</span>
                      	    </div>
                      	     <div>
                      		 <span class="f_12 fw_300 text-success">Active</span>
                      	    </div>
                      	</div>
                      </div>
                     </div>

                       <div class="col-xl-4 mb-3 col-lg-4 col-md-4 col-sm-6 col-12">
                      <div class="card_grid shadow-sm p-3 border">
                      	<div class="">
                      		<div>
                      		 <span class="f_13 fw_500">Company Name</span>
                      	    </div>
                      	     <div>
                      		 <span class="f_12 fw_300"><a href="" class="tc_4">WHITE ORGANIC AGRO LIMITED</a></span>
                      	    </div>
                      	</div>
                      	<div class="">
                      		<div>
                      		 <span class="f_13 fw_500">CIN</span>
                      	    </div>
                      	     <div>
                      		 <span class="f_12 fw_300">L01131KA1943PLC000833</span>
                      	    </div>
                      	</div>
                      	<div class="">
                      		<div>
                      		 <span class="f_13 fw_500">Status</span>
                      	    </div>
                      	     <div>
                      		 <span class="f_12 fw_300 text-success">Active</span>
                      	    </div>
                      	</div>
                      </div>
                     </div>

                      <div class="col-xl-4 mb-3 col-lg-4 col-md-4 col-sm-6 col-12">
                      <div class="card_grid shadow-sm p-3 border">
                      	<div class="">
                      		<div>
                      		 <span class="f_13 fw_500">Company Name</span>
                      	    </div>
                      	     <div>
                      		 <span class="f_12 fw_300"><a href="" class="tc_4">WHITE ORGANIC AGRO LIMITED</a></span>
                      	    </div>
                      	</div>
                      	<div class="">
                      		<div>
                      		 <span class="f_13 fw_500">CIN</span>
                      	    </div>
                      	     <div>
                      		 <span class="f_12 fw_300">L01131KA1943PLC000833</span>
                      	    </div>
                      	</div>
                      	<div class="">
                      		<div>
                      		 <span class="f_13 fw_500">Status</span>
                      	    </div>
                      	     <div>
                      		 <span class="f_12 fw_300 text-success">Active</span>
                      	    </div>
                      	</div>
                      </div>
                     </div>

                     
	            	</div>
				</div>



				<div class="search_right mt-2 bg-white p-3 d-flex justify-content-between align-items-start flex-wrap">
					
						<span class="f_14 my-2">Showing 1 to 10 of 500 entries</span>
					
					<nav aria-label="Page navigation" class="bg-white">
				     <ul class="pagination">
				    <li class="page-item disabled">
				      <a class="page-link f_14 rt_11" href="#" tabindex="-1">Previous</a>
				    </li>
				    <li class="page-item f_14 active"><a class="page-link rt_11 bg_2 text-white" href="#">1</a></li>
				    <li class="page-item f_14"><a class="page-link rt_11" href="#">2</a></li>
				    <li class="page-item f_14"><a class="page-link rt_11" href="#">3</a></li>
				    <li class="page-item">
				      <a class="page-link f_14 rt_11" href="#">Next</a>
				    </li>
				  </ul>
				</nav>
				</div>

			</div>
		</div>
	</div>
</section>


<!-- =====================end===================== -->

<!-- ===============footer========== -->

<?php include 'footer_b.php'; ?>

<!-- ===============end============== -->

<!-- -----------link-2 js---------- -->
<?php include 'link-2_b.php'; ?>


<script type="text/javascript">
    // adv search 


   $(document).ready(function() {
    $(".filterBtn").click(function(){
      // alert();
      $('.mobile_sidebar').addClass('mobile_sidebaropen');
    });
     $(".mobile_sidebar_header_backbtn").click(function(){
      
      $('.mobile_sidebar').removeClass('mobile_sidebaropen');

    // 

    });
     // $(".filterBtn").click(function(){
      
     //  $('.mobile_sort').toggleClass('mobile_sortopen');

   

});




 $(document).ready(function() {
    $(".search_gridbtn").click(function(){
      $(this).css('color','#2693FF');
      $(".search_listbtn").css('color','#676D7D');
      $('.search_grid').show();
      $('.search_list').hide();

    });

    $(".search_listbtn").click(function(){
       $(this).css('color','#2693FF');
       $(".search_gridbtn").css('color','#676D7D');
      $('.search_grid').hide();
      $('.search_list').show();

    });

</script>

</body>
</html>