<script>

var siteUrl = "<?=base_url()?>";

var filterType = "<?=$filterType?>";
// console.log(siteUrl);
</script>



<?php
$industry = [
				'Agriculture','Business Services','Forestry','Monetary Intermediation','Farming of animals','Mixed Farming',
				'Advertising','Building Ships','Chemical Manufacture','Petroleum Extraction','Automobile','Auto Component','Banking','Cement','IT & ITES','Ecommerce',
				'Advertising','Trading','Construction','Others','Horticulture','Legal',
				'Dairy Products','Starches and Starch','Beverages','Tobacco Products','Textiles','Real estate',
				'Footware',
				'Wood Products','Paper Product','Iron & Steel','Rubber Products','Plastic Products','Glass Products','Machinery & Equipments','Special Purpose','Computing Machinery',
				'Electric Motors','Medical Appliances','Photographic Equipment','Railway and Tramway','Hotels','Air Transport','Telecommunications','Finance','Software Publishing','Wholesale Trade',
			];
 
$city = [
			'Ahmedabad','ANDAMAN','Bangalore','Chandigarh','Chennai','Chhattisgarh','Coimbatore',
			'Cuttack','Delhi','Ernakulam','Goa','Gwalior','HimachalPradesh','Hyderabad','Jaipur',
			'Jammu','Jharkhand','Kanpur','Kolkata','Mumbai','Patna','oC-Coimbatore','Pondicherry','Pune',
			'Shillong','Uttarakhand','Vijayawada',
]; 

$status = [
			'Active','Active in Progress','Amalgamated',
			'Captured','Converted to LLP and Dissolved','Dormant',
			'Dormant under section 455','INACTIVE','Liquidated',
			'Not available for E-filing','Strike Off',
			'Under Liquidation','Under Process of Striking Off'
		];
?>
<!-- ====================search=======================  -->
<section class="bg_8">
	<div class="container-fluid bg-white desktop_search_panel">
		<div class="container">
			<div class="row">

<!-- ==========================Contry==list==&===Search bar================ -->
			  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
	             <div class=" search_res py-3 d-flex justify-content-between flex-wrap align-items-center">

	             	<div class="">
					<div class="search_content p-3 d-flex justify-content-center" >
					 <div class="">
					 	<form id="searchForm">
					 	 <select class="shadow-sm" id="countryFilter" onchange="changeCountry(this)">
							<?php //=$company_data['country']
							 
								if(count($country))
								{
									foreach($country as $k=>$v)
									{   
										$conutryArr = explode(' ' ,$v['name']);
										// $conutryFname = $conutryArr[0];
										if($v['sortname']=="IN")
										echo "<option value='".$v['sortname']."' selected>".$conutryArr[0].' '.$conutryArr[1]."</option>";
										else
										echo "<option value='".$v['sortname']."'>".$conutryArr[0].' '.$conutryArr[1]."</option>";

									}
								}
							?>  
					 	 	<!-- <option>Country</option>
					 	 	<option>Country</option>
					 	 	<option>Country</option>
					 	 	<option>Country</option> -->
					 	 </select>
					 	 <input type="search" name="" value="<?= $FilterKeyword??'' ?>" id="searchKeyword" class="search mb-2 shadow-sm" placeholder="Search">
					 	 <button>Search</button>
					 	</form>
					 </div>
					
					</div>

				</div>

	             	<div class="filter_grid d-flex">
	             	 <div class="tc_3 search_gridbtn">
	             	 	<i class="fas fa-th-large"></i> Grid
	             	 </div>
	             	 <div class="tc_2 ml-4 tc_1 search_listbtn">
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
	             	<form class="d-flex" id="searchFormMobile">
	             		<input type="text" name="" value="<?= $FilterKeyword??'' ?>" placeholder="Search..." class="pl-2 f_13" id="searchKeywordMobile">
	             		<button class="" type="submit"><img src="<?=base_url()?>assets/home_e/images/svg/loupe.svg" class="" alt="" height="20px" width="20px"></button>
	             	</form>
	             </div>

	           </div>
            </div>

			<div class="row">
			  <div class="search_rightcol-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-2">
	             <div class="search_right mobile_filters p-3 d-flex justify-content-around flex-wrap align-items-center bg-white">
	             	
	             	<?php if(isset($filterCompany)){ ?>
	             	<div class="filter filterBtn">
	             		<span class="f_14"><img src="<?=base_url()?>assets/home_e/images/svg/filter-results-button.svg" alt="" height="13px" width="13px" class="mr-2"> Filter</span>
	             	</div>
	             	<?php } ?>
	             	<!-- <input type="text" name="" id="searchInTable" class="form-control"> -->
	             	<!-- <div class="sort sortBtn" data-toggle="modal" data-target="#sortModel">
	             		<span class="f_15"><img src="<?=base_url()?>assets/home_e/images/svg/sort-2.svg" alt="" height="13px" width="13px" class="mr-2"> Sort </span>
	             	</div> 	 -->
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
        		<div class="mobile_sidebar_content_right bg_0 p-3" style="height: 100vh;overflow-y: auto;" id="mobileSidebarContent1">
        			<?php 
						$i=1;	 	
						foreach($industry as $indust)
						{
							echo '<div id="'.$indust.'"><input type="checkbox" name="myAllcheckBoxName" onchange="mobileFilter(`industry_type`,`'.$indust.'`,'.$i.')" id="industry_type'.$i.'" value="'.$indust.'" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">'.$indust.'</span></div>';
							$i++;
						}
					?>
        			<!-- <div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">Agree-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div> -->
        			
        		</div>

        		<div class="mobile_sidebar_content_right bg_0 p-3" id="mobileSidebarContent2">
        			<div id="Private"><input type="checkbox" name="myAllcheckBoxName" onchange="mobileFilter(`companyType`,`Private`,'1')"  id='companyType1' class="mt-2 mobile_sidebar_checkbox" value='Private'> <span class="ml-2 f_15 rt_13">Private</span></div>

        			<div id="Public"><input type="checkbox" name="myAllcheckBoxName" onchange="mobileFilter(`companyType`,`Public`,'2')"  id='companyType2'  class="mt-2 mobile_sidebar_checkbox" value='Public'> <span class="ml-2 f_15 rt_13">Public</span></div>	
        			<div id="Private(One Person Company)"><input type="checkbox" name="myAllcheckBoxName" onchange="mobileFilter(`companyType`,`Private(One Person Company)`,'3')"  id='companyType3'  class="mt-2 mobile_sidebar_checkbox" value='Private(One Person Company)'> <span class="ml-2 f_15 rt_13">Private(One Person Company)</span></div>	
        			<div id="Not For Profit"><input type="checkbox" name="myAllcheckBoxName"  onchange="mobileFilter(`companyType`,`Not For Profit`,'4')"  id='companyType4' class="mt-2 mobile_sidebar_checkbox" value='Not For Profit'> <span class="ml-2 f_15 rt_13">Not For Profit</span></div>	
        			<!-- <div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">Agree-2</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div> -->
        			
        		</div>

        		<div class="mobile_sidebar_content_right bg_0 p-3" style="height: 100vh;overflow-y: auto" id="mobileSidebarContent3">
        			<?php
        				$i=1;
						foreach($city as $val)
						{
							// echo "<option value='".$val."'>".$val."</option>";
							echo '<div id="'.$val.'"><input type="checkbox" onchange="mobileFilter(`cityFilter`,`'.$val.'`,'.$i.')" id="cityFilter'.$i.'" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox" value="'.$val.'"> <span class="ml-2 f_15 rt_13">'.$val.'</span></div>';
						   ++$i;
						}
					?>
        			<!-- <div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">Agree-3</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="myAllcheckBoxName" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div> -->
        			
        		</div>

        		<div class="mobile_sidebar_content_right bg_0 p-3" id="mobileSidebarContent4">
        			<?php 
        				$i=1;
        				foreach($status as $val)
						{
							// echo "<option value='".$val."'>".$val."</option>";
							echo '<div id="'.$val.'"><input type="checkbox"  value="'.$val.'" name="" onchange="mobileFilter(`statusFilter`,`'.$val.'`,'.$i.')" id="statusFilter'.$i.'" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">'.$val.'</span></div>';
							++$i;
						}
        			?>
        			<!-- <div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">Agree-4</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div> -->
        			
        		</div>

        		<div class="mobile_sidebar_content_right bg_0 p-3" id="mobileSidebarContent5">
        			<div id='Listed'><input type="checkbox" onchange="mobileFilter(`listFilter`,`Listed`,'1')" id="listFilter1" name="Listed" class="mt-2 mobile_sidebar_checkbox" value="Listed"> <span class="ml-2 f_15 rt_13">Listed</span></div>
        			<div id='Unlisted'><input type="checkbox" name="" onchange="mobileFilter(`listFilter`,`Unlisted`,'2')" id="listFilter2" class="mt-2 mobile_sidebar_checkbox" value='Unlisted'> <span class="ml-2 f_15 rt_13">Unlisted</span></div>
        			<!-- <div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div> -->
        			<!-- <div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">Agree-5</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div> -->
        			
        		</div>

        		<div class="mobile_sidebar_content_right bg_0 p-3" id="mobileSidebarContent6">
        			<div id="setPaidUpNotation"></div>
        			<input class="setPaidUpMin form-control" type="number" name="" placeholder="Minimum">
        			<br>
        			<input class="setPaidUpMax form-control" type="number" name="" placeholder="Maximum">
        			<br>
        			<button class="setPaidUpButton button_1 bg_4 py-1 px-5">Set Paid Up</button>
        			<!-- <div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">Agree-6</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div>
        			<div><input type="checkbox" name="" class="mt-2 mobile_sidebar_checkbox"> <span class="ml-2 f_15 rt_13">data-1</span></div> -->
        			
        		</div>



        	</div>

            <div class="mobile_sidebar_content_bottom bg_3 p-2 d-flex justify-content-start align-items-center" >
            	<div class="text-center">
            		<div>
            		 <span class="f_13 mobile_sidebar_checkbox_result">0&nbsp;&nbsp; Filter Selected</span>
            		</div>
            		 <button class="button_1 bg_4 py-1 px-5 applyFilter">Apply</button>
            	</div>
            	<div class="text-center">
            		 
            	</div>
            </div>

        </div>
	

	<!-- -------------------end----------------- -->

	
	<div class="container py-0 py-xl-3 py-md-2 py-lg-3">

		<div class="row">
			<?php if(isset($filterCompany)){ ?>
			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12  search_left_pannel">
				<form>
				<div class="search_left bg-white mr-2">
					<div class="search_content p-3">
					 
					 <div class="search_title fw_500 f_16 d-flex justify-content-between">
					  <div>Industry Type</div>
					  <div class="f_14" id="clearIndustryFilter">Clear <i class="fa fa-times f_12"></i></div>
					 </div>
					 
					 <div class="search_box pt-3">
					 	<!-- <input type="" name="" class="search w-100"  id="search" placeholder="Select Industry Type"> -->
						 <!-- <div   class="form-group col-xl-7 col-lg-7 col-md-7 searchInputBox"> -->
					        <!-- <input type="text" class="search w-100 heroRadio searchInputBox" autofocus  name="" placeholder="Select Industry Type" id="search"  required>-placeholder="Company Name" -->
						    <div class="searchResultBox">
									
						 	</div>
							 <select name="industry_type" id="industry_type">
							 <option value='' selected disabled>Select Industry Type</option>
							 <?php 
							 	
							 	foreach($industry as $indust)
								{
									echo "<option class='industryVal' value='".$indust."'>".$indust."</option>";
								}
							 ?>
							 </select>
						 <!-- </div> -->
					 </div>
					 
					 <div class="search_add mt-3 d-flex flex-wrap" id="industry_filter">
					 	<!-- <div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div> -->
					 </div>
					
					</div>
				</div>


				<div class="search_left bg-white mr-2 mt-2">
					<div class="search_content p-3">
					 
					 <div class="search_title fw_500 f_16 d-flex justify-content-between">
					  <div>Company Type</div>
					  <div class="f_14" onclick="closeAllCompFilter()">Clear <i class="fa fa-times f_12"></i></div>
					 </div>
					 
					 <div class="search_box pt-3">
					 	<!-- <input type="" name="" class="w-100" placeholder="Select Company Type"> -->
						 <select name="" id="CompanyType" onchange="setCompanyType(this)" class="select_prev">
							<option value="0" selected>Select Company Type</option>
							<option value="Private">Private</option>
							<option value="Public">Public</option>
							<option value="Private(One Person Company)">Private(One Person Company)</option>
							<option value="Not For Profit">Not For Profit</option>
						</select>
					 </div>
					 
					  <div class="search_add mt-3 d-flex flex-wrap" id="companyTypeFilter">
					 	<!-- <div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div> -->
					 </div>
					
					</div>
				</div>

				<div class="search_left bg-white mr-2 mt-2">
					<div class="search_content p-3">
					 
					 <div class="search_title fw_500 f_16 d-flex justify-content-between">
					  <div>Registrar of Company / Location</div>
					  <div class="f_14" onclick="closeAllCityFilter()">Clear <i class="fa fa-times f_12"></i></div>
					 </div>
					 
					 <div class="search_box pt-3">
					 	<!-- <input type="" name="" class="w-100" placeholder="Select Registrar of Company / Location Type"> -->
						 
						<select class="w-100" name="" id="cityFilter" onchange="setCity(this)">
						<option value='0' selected>Select City</option>
						<?php
							foreach($city as $val)
							{
								echo "<option value='".$val."'>".$val."</option>";
							}
						?>
						</select>		
					 </div>
					 
					  <div class="search_add mt-3 d-flex flex-wrap" id="citFilterTab">
					 	<!-- <div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div> -->
					 </div>
					
					</div>
				</div>

				
				<div class="search_left bg-white mr-2 mt-2">
                    <div class="search_content p-3">
                     
                     <div class="search_title fw_500 f_16 d-flex justify-content-between">
                      <div>Min/Max Capital</div>
                     </div>
                     
                     <div class="search_box pt-3 d-flex">
                        <input type="number" name="" class="w-50 mr-3" onblur="setPaidUp('minimum',this.value)" placeholder="Min Capital">
                        <input type="number" name="" class="w-50" onblur="setPaidUp('maximum',this.value)" placeholder="Max Capital">
                     </div>
                     
                    </div>
                </div>

				<div class="search_left bg-white mr-2 mt-2">
					<div class="search_content p-3">
					 
					 <div class="search_title fw_500 f_16 d-flex justify-content-between">
					  <div>Status</div>
					  <div class="f_14" onclick="closeAllStatusFilter()">Clear <i class="fa fa-times f_12"></i></div>
					 </div>
					 
					 <div class="search_box pt-3">
					 	<!-- <input type="" name="" class="w-100" placeholder="Select Status Type"> -->
						 
						<select class="w-100" name="" id="locationFilter" onchange="setStatus(this)">
						<option value='0' selected>Select Status</option>
						<?php
							foreach($status as $val)
							{
								echo "<option value='".$val."'>".$val."</option>";
							}
						?>
						</select>
					 </div>
					 
					  <div class="search_add mt-3 d-flex flex-wrap" id="statusFilterTab">
					 	<!-- <div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div> -->
					 </div>
					
					</div>
				</div>

				<div class="search_left bg-white mr-2 mt-2">
					<div class="search_content p-3">
					 
					 <div class="search_title fw_500 f_16 d-flex justify-content-between">
					  <div>Listed or Unlisted</div>
					  <div class="f_14" onclick="closeAllListFilter()">Clear <i class="fa fa-times f_12"></i></div>
					 </div>
					 
					 <div class="search_box pt-3">
					 	<!-- <input type="" name="" class="w-100" placeholder="Select Listed or Unlisted Type"> -->
						<select class="w-100" name="" id="" onchange="setList(this)">
						<option value='' selected>Select Status</option>
							<!-- <option value="" selected>Select Listed/Unlisted</option> -->
							<option value='Listed'>Listed</option>
							<option value='Unlisted'>Unlisted</option>
						</select>
						 
					 </div>
					 
					  <div class="search_add mt-3 d-flex flex-wrap" id='listFilterTab'>
					 	<!-- <div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div>
					 	<div><a href="" class="">Web Design</a> <i class="fa fa-times bg-white tc_2 rounded-circle p-1 ml-1"></i></div> -->
					 </div>
					
					</div>
				</div>

				

			</form>

			</div>
			<?php } ?>
			<div class="final_result_box  <?php if(isset($filterDirector)){echo "col-xl-12 col-lg-12";}else{echo "col-xl-8 col-lg-8";} ?> col-md-12 col-sm-12 col-12 p-xl-0 p-lg-0 mt-md-0 mt-2">
				<div class="search_right bg-white p-3 d-flex justify-content-between flex-wrap align-items-center">
					
                    <div>
	             	 <h3 class="f_18 fw_400 mt-2 rt_15" id='rowCount'>
	             	 	<?php 
						    $showDataInTbl='';

						 //  	if(isset($filterCompany))
						 //  	{
							// 	echo count($filterCompany);
							// 	$showDataInTbl = $filterCompany;
						 //  	}
							// else if(isset($filterDirector))
							// {
							// 	echo count($filterDirector);
							// 	$showDataInTbl = $filterDirector;
							// 	// var_dump($filterDirector);
							// }
							 echo $rowCountF;
							?>
	             	 	  Result Found </h3>
	             	</div>
                  
                  <div class="justify-content-xl-end d-flex flex-wrap  justify-content-start">

					<div class="search_sort text-right d-xl-inline d-lg-inline d-none">
					<div class="dropdown_sort d-none">
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

				  <div class="search_sort recordPerPageDropDown text-right ml-xl-2 ml-lg-2 ml-md-2 d-lg-inline d-none">
					<div class="dropdown_sort">
					 <div class="sort_wrap">
					  <span class="f_14">Show entries :</span>
					  <i class="fas fa-chevron-down ml-4 f_14"></i>
					   </div>
					  <div class="dropdown-content_sort recordPerPage text-center">
					   <div onclick="recordPerPage(12)">12</div>
					   <div onclick="recordPerPage(24)">24</div>
					   <div onclick="recordPerPage(36)">36</div>
					   <div onclick="recordPerPage(48)">48</div>
					   <div onclick="recordPerPage(60)">60</div>
					   <!-- <a href=""  onclick="recordPerPage(20)">20</a href="">
					   <a href=""  onclick="recordPerPage(30)">30</a href="">
					   <a href=""  onclick="recordPerPage(40)">40</a href="">
					   <a href=""  onclick="recordPerPage(50)">50</a href=""> -->
					  </div>
					</div>
				</div>
				<button id="resetFilterAll" class="border-0 px-2 py-1 text-white bg_2 rounded f_14 d-xl-block d-lg-block d-none">Reset Filter</button>
				<div class="search_sort text-right ml-xl-2 ml-lg-2 ml-md-2 d-md-inline d-xl-none d-lg-none ">
					<select class="f_14 py-1 px-3 tc_3" onchange="recordPerPage(this.value)">
						<option>Show entries</option>
						<option value='12'>12</option>
						<option value='24'>24</option>
						<option value='36'>36</option>
						<option value='48'>60</option>
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
             <div class="search_right  search_link bg-white mt-2 p-3 pb-2 search_list">
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

				<table class="w-100 mt-2" id="fetchDataShow" >
						<?php 
							
							// search Comapnay start at the load time
							if(isset($filterCompany))
							{
								echo '<tr class="">
								<th class="rt_13">Company Name</th>
								<th class="rt_13">CIN</th>
								<th class="rt_13">Status</th>		
								</tr>';
							  
							  	$showDataInTbl = $filterCompany;
							  	
							  	foreach($showDataInTbl as $k=>$v)
								{
									if($v['status']=='Active')
									{
										echo "<tr>
										<td><a href='".base_url('/')."Company_info/".$v['cin']."' class='rt_11'>".$v['name']."</a></td>
										<td class='rt_11'>".$v['cin']."</td>
										<td class='active rt_11'>".$v['status']."</td>
										</tr>";		
									}
									else
									{
										echo "<tr>
										<td><a href='".base_url('/')."Company_info/".$v['cin']."' class='rt_11'>".$v['name']."</a></td>
										<td class='rt_11'>".$v['cin']."</td>
										<td class='active rt_11 text-danger'>Inactive</td>
										</tr>";
									}
								}
							}
						  	else if(isset($filterDirector))
						 	{
								echo '<tr class="">
								<th class="rt_13">Director Name</th>
								<th class="rt_13">DIN</th>
									
								</tr>';//<th class="rt_13">Company Name</th>	
							  	// $showDataInTbl = ;
							  	foreach($filterDirector as $k=>$v)
								{
										echo "<tr>
										<td><a href='".base_url('/')."Director_info/".$v['din']."' class='rt_11'>".$v['dirname']."</a></td>
										<td class='rt_11'>".$v['din']."</td>
										
										</tr>";		
									// <td class='active rt_11'>".$v['company_name']."</td>
										
								}	
								
							}						  	
						  	// else if(0)
						  	// {

						  	// } 
							// foreach($showDataInTbl as $k=>$v)
							// {
							// 	if($v['status']=='Active')
							// 	{
							// 		echo "<tr>
							// 		<td><a href='' class='rt_11'>".$v['name']."</a></td>
							// 		<td class='rt_11'>".$v['cin']."</td>
							// 		<td class='active rt_11'>".$v['status']."</td>
							// 		</tr>";		
							// 	}
							// 	else
							// 	{
							// 		echo "<tr>
							// 		<td><a href='' class='rt_11'>".$v['name']."</a></td>
							// 		<td class='rt_11'>".$v['cin']."</td>
							// 		<td class='active rt_11 text-danger'>Inactive</td>
							// 		</tr>";
							// 	}
								
							// }
							// search Comapnay end at the load time
						?>

				</table>





				</div>
<!-- ======================================================================= -->


				<div class="search_right mt-2 bg-white p-3 search_grid">
					<!-- <div class="search_card mb-3">
						asdfasf
					</div>
					<div class="search_card mb-3">
						asdfasf
					</div>
					<div class="search_card mb-3">
						asdfasf
					</div>
					<div class="search_card mb-3">
						asdfasf
					</div>
					<div class="search_card mb-3">
						asdfasf
					</div> -->
					<div class="row " id="search_gridInner">
			         
					  	<?php 
							// ==========================search Comapnay in grid at the load time===start=========================
							if(isset($filterCompany))
							{
							foreach($filterCompany as $k=>$v)
							{
								if($v['status']=='Active')
								{
									
									echo "<div class='col-xl-4 mb-3 col-lg-4 col-md-4 col-sm-6 col-12'>
										<div class='card_grid shadow-sm p-3 border'>
										<div class=''>
											<div>
									 			<span class='f_13 fw_500'>Company Name</span>
											</div>
									 		<div>
									 			<span class='f_12 fw_300'><a href='".base_url('/')."Company_info/".$v['cin']."' class='tc_4'>".$v['name']."</a></span>
											</div>
										</div>
										<div class=''>
                      						<div>
                      		 					<span class='f_13 fw_500'>CIN</span>
                      	    				</div>
                      	     				<div>
                      		 					<span class='f_12 fw_300'>".$v['cin']."</span>
                      	    				</div>
                      					</div>
										<div class=''>
										  <div>
											   <span class='f_13 fw_500'>Status</span>
										  </div>
										   <div>
											   <span class='f_12 fw_300 text-success'>Active</span>
											 </div>
									  	</div>
										</div>
										</div>";		
								}
								else
								{
									echo "<div class='col-xl-4 mb-3 col-lg-4 col-md-4 col-sm-6 col-12'>
									<div class='card_grid shadow-sm p-3 border'>
									<div class=''>
											<div>
									 			<span class='f_13 fw_500'>Company Name</span>
											</div>
									 		<div>
									 			<span class='f_12 fw_300'><a href='".base_url('/')."Company_info/".$v['cin']."' class='tc_4'>".$v['name']."</a></span>
											</div>
										</div>
										<div class=''>
                      						<div>
                      		 					<span class='f_13 fw_500'>CIN</span>
                      	    				</div>
                      	     				<div>
                      		 					<span class='f_12 fw_300'>".$v['cin']."</span>
                      	    				</div>
                      					</div>
										<div class=''>
                      						<div>
                      		 					<span class='f_13 fw_500'>Status</span>
                      	    				</div>
                      	     				<div>
                      		 					<span class='f_12 fw_300 text-danger'>Inactive</span>
                      	   					</div>
                      					</div>
										</div>
										</div>";
								}
								
							}
							}
							else if(isset($filterDirector))
							{
								foreach($filterDirector as $k=>$v)
								{
								echo "<div class='director_grid_box col-xl-4 mb-3 col-lg-4 col-md-4 col-sm-6 col-12'>
									<div class='card_grid  shadow-sm p-3 border'>
										<div class=''>
											<div>
									 			<span class='f_13 fw_500'>Director Name</span>
											</div>
									 		<div>
									 			<span class='f_12 fw_300'><a href='".base_url('/')."Director_info/".$v['din']."' class='tc_4'>".$v['dirname']."</a></span>
											</div>
										</div>
										<div class=''>
                      						<div>
                      		 					<span class='f_13 fw_500'>DIN</span>
                      	    				</div>
                      	     				<div>
                      		 					<span class='f_12 fw_300'>".$v['din']."</span>
                      	    				</div>
                      					</div>
										
										</div>
										</div>";

                                        // <div class=''>
                                        //   <div>
                                        //        <span class='f_13 fw_500'>Company Name</span>
                                        //   </div>
                                        //    <div>
                                        //        <span class='f_12 fw_300 '>".$v['company_name']."</span>
                                        //      </div>
                                        // </div>
								}		
							}
							// search Comapnay end at the load time
						?>  
                      	
                      	
                      	
						  
                      <!-- </div>
                     </div> -->
                      
                       <!-- <div class="col-xl-4 mb-3 col-lg-4 col-md-4 col-sm-6 col-12">
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
                      </div> -->
                     <!-- </div> -->

                     
	            	</div>
				</div>


<!-- ===================Pagination======= -->

				<div class="search_right mt-2 bg-white p-3 d-flex justify-content-between align-items-start flex-wrap">
					<!-- <div class="pagination_1">
						<div class="">1</div>
						<div class="">2</div>
						<div class="">3</div>
						<div class="">...</div>
						<div class=""></div>
					</div> -->
					<!-- <div class=""> -->
						<!-- <span class="f_14 my-2">Showing 1 to 10 of 500 entries</span> -->
					<!-- </div> -->
					<nav aria-label="Page navigation">
				     	<ul class="pagination" id="pagination-link">
				     		<?php
				     		$page = ceil($rowCountF/12);
				     		// echo $page;		 
				     		if($page>1)
				     		{
				     		   for($i=0;$i<$page;++$i)
				     		   {
				     		   		if($i<($page-1))
				     		   		{
				     		   			// echo $i.'  ';
				     		   			echo '<li onclick="paginationTbl(12,'.($i*12).','.($i+1).')" class="page-item f_14"><a class="page-link" href="#">'.($i+1).'</a></li>';	
				     		   		}	
				     				else 
				     				{
				     					echo '<li onclick="paginationTbl(12,24,2)" class="page-item"><a class="page-link f_14" href="#">Next</a></li>';	
				     				}
				     				if($i>3)
				     				{
				     					echo '<li onclick="paginationTbl(12,24,2)" class="page-item"><a class="page-link f_14" href="#">Next</a></li>';
				     					break;
				     				}	
				     					
				     		   }
				     		}    
				     		?>
				    		<!-- <li onclick="paginationTbl(12,0,1)" class="page-item f_14"><a class="page-link" href="#">1</a></li>
				    		<li onclick="paginationTbl(12,24,2)" class="page-item f_14"><a class="page-link" href="#">2</a></li>
				    		<li onclick="paginationTbl(12,36,3)" class="page-item f_14"><a class="page-link" href="#">3</a></li>
				    		<li onclick="paginationTbl(12,48,4)" class="page-item f_14"><a class="page-link" href="#">4</a></li>
				    		<li onclick="paginationTbl(12,60,5)" class="page-item f_14"><a class="page-link" href="#">5</a></li> -->
				    		<!-- <li class="page-item f_14"><a class="page-link" href="#">2</a></li>
				    		<li class="page-item f_14"><a class="page-link" href="#">3</a></li> -->
				    		<!-- <li onclick="paginationTbl(12,24,2)" class="page-item"><a class="page-link f_14" href="#">Next</a></li> -->
				    		<!-- <li class="page-item">
				      		<a class="page-link f_14" href="#">Next</a>
				    		</li> -->
				  		</ul>
					</nav>
				</div>

                
                <div class="advance_result_loader">
                    <div>
                        <img src="<?=base_url('assets/')?>home_e/images/loader/final_result_logo.gif">
                    </div>
                </div>


			</div> 
            <!-- end of result fetch box=== -->
		</div>
	</div>
</section>

<script type="text/javascript">
	// $("#searchInTable").on("keyup", function() {
 //    	var value = $(this).val().toLowerCase();
 //   		$("#fetchDataShow tr").filter(function() {
 //      		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
 //    	});
 //  	});
    // home sidebar content hide show
    // $('.mobile_sidebar_content_left').click(function(){
    // 	$('.mobile_sidebar_content_left div span').css('background-color','#eee');
    // 	// $(this).css('background-color','#aaa');
    // })
 function showSidebarContent(n){
   // $(this).parent().css('background-color','red');	 
   // $(this).css('color','red');
   $('.mobile_sidebar_content_right').css('display','none');
   $('#mobileSidebarContent'+n).css('display','block');

}


// ===========================reset filter start==============
$("#resetFilterAll").click(function()
{
	ary = localStorage.getItem('cart');
	localStorage.clear();
	localStorage.setItem('cart',ary);
    localStorage.setItem('keywordVal','<?= $FilterKeyword?>');
    localStorage.setItem('countryFilter',"IN");
    $("#industry_filter").html('');
    $("#companyTypeFilter").html('');
    $("#citFilterTab").html('');
    $("#statusFilterTab").html('');
    $("#listFilterTab").html('');
    fetchFilter();
});
// ===========================reset filter end==============


$(document).ready(function(){
    $(".mobile_sidebar_clear_filter").click(function(){
        $(".mobile_sidebar_checkbox").prop("checked", false);
        localStorage.clear();
        localStorage.setItem('keywordVal','<?= $FilterKeyword?>');
        localStorage.setItem('countryFilter',"IN");
        fetchFilter();  
        $('.mobile_sidebar_checkbox_result').text(`0 \u00A0 Filter Selected`);
   
});


    var $checkboxes = $('.mobile_sidebar_content_right input[type="checkbox"]');
        
    $checkboxes.change(function(){

        var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
        $('.mobile_sidebar_checkbox_result').text(`${countCheckedCheckboxes}\u00A0 Filter Selected`);
    });

});
</script>

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

