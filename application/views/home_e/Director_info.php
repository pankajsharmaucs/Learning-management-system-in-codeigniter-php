
<?php

$tbl1='company';
$tbl2='scrap_dir';

$d_data=$this->admin->getWhere($tbl2,['din'=>$din]);

$din=$d_data[0]->din;

$comp_data=$this->admin->getCompanyDirectorJoin($din);

// var_dump($data); 

?>


<section class="bg_6 py-5">
	<div class="container">
		<div class="row ">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="director_about p-3 shadow-sm border bg-white">
				<h1 class="f_23 rt_18">About</h1>
				<p class="rt_14 tc_1"><?= $d_data[0]->name ?> is registered with Ministry of Corporate Affairs (MCA). The DIN is <?= $d_data[0]->din ?>. Following is the current and past directorship holdings.</p>
			</div>
		</div>
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-xl-3 mt-lg-3 mt-md-3 mt-2">
			<div class="director_about p-3 shadow-sm border bg-white p-3"style="overflow-x: auto;" >
				<h1 class="f_23 rt_18 mb-2">Companies Associated With</h1>
				
				<div class="table-responsive ">
				  <table class="table company_associated table-striped">
				    <thead class="">
					    <tr>
					      <th scope="col" class=" rt_15">Company</th>
					      <th scope="col" class=" rt_15">Designation</th>
					      <th scope="col" class="text-nowrap rt_15">Date Of Appointment</th>
					      
					    </tr>
					  </thead>
					  <tbody>
					    
					    <?php foreach ($comp_data as $k ) { 

					         $cin=$k['cin'];
					         $designation=$k['designation'];
					         $doj=$k['date_of_joining'];

					           $allcomp=$this->admin->getAllCompanyByCin($cin);
					            foreach ($allcomp as $all ) { 

					     ?>
					    <tr>
					      <th scope="row"><a href="../Company_info/<?= $all['cin'] ?>" class="f_15 rt_14 fw_500"><?= $all['name'] ?></a></th>
					      <td class="rt_14"><?= $designation ?></td>
					      <td class="rt_14"><?= $doj ?></td>
					    </tr>

					<?php } }?>

					    
					   
					  </tbody>
				  </table>
				 </div>
                    
	     </div>
		</div>
		</div>
	</div>
</section>