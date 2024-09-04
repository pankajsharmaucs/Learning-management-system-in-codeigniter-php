<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdvanceSearch_e extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('AdvanceSearchModel_e');
    }

    public function index($comp)
    {
       
        $raw=explode('.', $comp);

        $KeyWord = str_replace('%20',' ', $raw[0]);
        // echo $KeyWord;exit;
        $filterType = $raw[1];
        // echo $filterType;exit;
        $searchCountry = $row[2];

        $data['FilterKeyword'] = str_replace('%20',' ', $raw[0]);
        //=================fetch country start=====================
        $fetchCountry1 = $this->AdvanceSearchModel_e->fetchCountry();
        
        // $industry_type = $this->AdvaceSearchModel_e->fetchIndustryType();        

        if(count($fetchCountry1))
        {
            $data['country'] = $fetchCountry1;
        }
        else
        {
            $data['country'] = 'Country not Available';
        }
        //=================fetch country end=========================
        
        // ================================= fetch company with match input word start======================================================== 
        if($filterType=='Company_name')
        {
            $filterCompany = $this->AdvanceSearchModel_e->fetchCompany($KeyWord);
            // var_dump($filterCompany);exit;
            $data['rowCountF']=$filterCompany[1];
            $data['filterCompany'] = $filterCompany[0];
            $data['filterType'] = $filterType;
            // echo "<pre>";var_dump($filterCompany);exit;
        }
                
        //===================================fetch company with match input word end========================================================
        
        // ================================= fetch Director_name with match input word start======================================================== 
            if($filterType=='Director_name')
            {
                $filterCompany = $this->AdvanceSearchModel_e->fetchDirector($KeyWord);
                // var_dump($filterCompany);exit;
                $data['rowCountF']=$filterCompany[1];
                $data['filterDirector'] = $filterCompany[0];
                $data['filterType'] = $filterType;
            }
                        
        //===================================fetch Director_name with match input word end========================================================
         
        // ================================= fetch Director_name with match input word start======================================================== 
            if($filterType=='CIN')
            {
                $filterCompany = $this->AdvanceSearchModel_e->fetchCompanyByCin($KeyWord);
                // var_dump($filterCompany);exit;
                $data['rowCountF']=$filterCompany[1];
                
                $data['filterCompany'] = $filterCompany[0];
                $data['filterType'] = $filterType;
            }
                           
        //===================================fetch Director_name with match input word end========================================================

        // $this->load->view('home_e/Advance_search',$data);
        $d['title'] = 'Advance search | KreditAid';
        $this->load->view('home_e/header_b', $d, false);
        $this->load->view('home_e/Advance_search', $data, false);
        // $this->load->view('home_e/adv_search_b', $data, false);
        $this->load->view('home_e/footer_b', $d, false);

    }
    //===================================================fetch industry type from model========================================================= 
    // public function fetchIndustryType()
    // {
    //     $so = '';
    //     $industry = [
    //         'Agriculture','Business Services','Forestry','Monetary Intermediation','Farming of animals','Mixed Farming',
    //         'Advertising','Building Ships','Chemical Manufacture','Petroleum Extraction','Automobile','Auto Component','Banking','Cement','IT & ITES','Ecommerce',
    //         'Advertising','Trading','Construction','Others','Horticulture','Legal',
    //         'Dairy Products','Starches and Starch','Beverages','Tobacco Products','Textiles','Real estate',
    //         'Footware',
    //         'Wood Products','Paper Product','Iron & Steel','Rubber Products','Plastic Products','Glass Products','Machinery & Equipments','Special Purpose','Computing Machinery',
    //         'Electric Motors','Medical Appliances','Photographic Equipment','Railway and Tramway','Hotels','Air Transport','Telecommunications','Finance','Software Publishing','Wholesale Trade',
    //     ];
    //     foreach($industry as $inds)
    //     {
    //         $so.="<a href='directors?q=adas><div class='resultRow' > ".$inds."</div></a><br>";
    //     }
       
    //     $this->load->model('AdvanceSearchModel_e');
        
    //     $industry_type = $this->AdvanceSearchModel_e->getindustry();
        
    //     var_dump($industry_type); 
    //     echo $so;
    // }

    public function AdvFilterSearch()
    {
        $industryTypeFiletrVal = $this->input->post('industryTypeFiletrVal');

        $countryFilterVal = $this->input->post('countryFilterVal');

        $companyTypeFiletrVal = $this->input->post('companyTypeFiletrVal');

        $locationFiletrVal = $this->input->post('locationFiletrVal');

        $statusFiletrVal = $this->input->post('statusFiletrVal');
        
        $listedFiletrVal = $this->input->post('listedFiletrVal');
        
        $paidUpCap = $this->input->post('paidUpCap');
        
        $keywordVal = $this->input->post('keywordVal');
        
        $filterType = $this->input->post('filterType');
        
        if(!$keywordVal)
        {
            echo json_encode(['keyword'=>"input-serach-empty"]);exit;
        }

        $rocordPerPageInfo = $this->input->post('rocordPerPageInfo');
        // echo $rocordPerPageInfo;exit;
        // if(empty($rocordPerPageInfo)){$rocordPerPageInfo=12;}
        
        $page = $this->input->post('page');
        
        // echo "hellogfg das".$filterType;exit;
        if($filterType=='Company_name' || $filterType=='CIN')
        {


            $allFiltersFetchedData1 = $this->AdvanceSearchModel_e->fetchDataForAllFilters($filterType,$rocordPerPageInfo,$page,$industryTypeFiletrVal,$countryFilterVal,$companyTypeFiletrVal,$locationFiletrVal,$statusFiletrVal,$listedFiletrVal,$paidUpCap,$keywordVal);
   
            // var_dump($allFiltersFetchedData1);exit;
        
            $rowCount = $allFiltersFetchedData1[1];
            
            $allFiltersFetchedData = $allFiltersFetchedData1[0];
            
            $filteredFetched['rowCount'] = $rowCount;
            
            $filteredFetched['filterFetchData'] = $allFiltersFetchedData;
            
            echo json_encode($filteredFetched);
        }

        if($filterType=='Director_name')
        {
            // echo json_encode(['data'=>'director']);exit;
            $allFiltersFetchedData1 = $this->AdvanceSearchModel_e->fetchDirectorWithFilters($rocordPerPageInfo,$page,$industryTypeFiletrVal,$countryFilterVal,$companyTypeFiletrVal,$locationFiletrVal,$statusFiletrVal,$listedFiletrVal,$paidUpCap,$keywordVal);
            
            $rowCount = $allFiltersFetchedData1[1];
            // $rowCount = 1;
            $filteredFetched['filterFetchData'] = $allFiltersFetchedData1[0];
    //         $filteredFetchedDataInTable = '<tr class="">
    //         <th class="rt_13">Director Name</th> 
    //         <th class="rt_13">DIN</th>
            
    //         </tr>';// <th class="rt_13">Company Name</th>

    //         $tableRowIdDr = 1;
    //         foreach($allFiltersFetchedData1[0] as $k=>$v)
		  //   {
			 //    // <td class='active rt_11'>".$v['company_name']."</td>
				// $filteredFetchedDataInTable .= "<tr id='Dr_".$tableRowIdDr."' class='hideTr'>
				// <td><a href='".base_url('/')."Director_info/".$v['din']."' class='rt_11'>".$v['dirname']."</a></td>
				// <td class='rt_11'>".$v['din']."</td>
				
				// </tr>";
    //             $tableRowIdDr;							
		  //   }
    //         $gridRowId = 1;
    //         foreach($allFiltersFetchedData1[0] as $k=>$v)
		  //   {
			    
									
    //                 $filteredFetchedDataInGrid .= "<div id='gr_".$gridRowId."' class='col-xl-4 mb-3 col-lg-4 col-md-4 col-sm-6 col-12'>
    //                 <div class='card_grid shadow-sm p-3 border'>
    //                 <div class=''>
    //                     <div>
    //                          <span class='f_13 fw_500'>Director Name</span>
    //                     </div>
    //                     <div>
    //                          <span class='f_12 fw_300'><a href='".base_url('/')."Director_info/".$v['din']."' class='tc_4'>".$v['dirname']."</a></span>
    //                     </div>
    //                 </div>
    //                 <div class=''>
    //                     <div>
    //                            <span class='f_13 fw_500'>DIN</span>
    //                     </div>
    //                     <div>
    //                         <span class='f_12 fw_300'>".$v['din']."</span>
    //                     </div>
    //                 </div>
    //                 <div class=''>
                    
    //                 <div>
                        
    //                     </div>
    //                 </div>
    //                 </div>
    //                 </div>";		
		  //       // <span class='f_12 fw_300'>".$v['company_name']."</span><div>
    //                 //     <span class='f_13 fw_500'>Company Name</span>
    //                 // </div>
    //             ++$gridRowId;					
		  //   }
        
            $filteredFetched['rowCount'] = $rowCount;
            // $filteredFetched['inTableForm'] = $filteredFetchedDataInTable;
            // $filteredFetched['inGridForm'] = $filteredFetchedDataInGrid;
            echo json_encode($filteredFetched);exit;
            
            // var_dump($allFiltersFetchedData1);exit;    
        }
        // if($filterType=='CIN')
        // {
        //     echo "hello";
        // }
        
    }

    public function autoCompleteSearch()
    {
        // $d="yes"; 
        // 

        $skillData = array();

        $searchtype=$this->input->get_post('searchtype');
        $country=$this->input->get_post('country');
        $name=$this->input->get_post('name');

       

               $dbc=$this->load->model('AdvanceSearchModel_e');

        
                // $data['searchtype'] = $this->input->get_post('searchtype');
                // $data['country'] = $this->input->get_post('country');
                // $data['name'] = $this->input->get_post('name');

                
                $data['searchtype'] = 'Company_name';
                $data['country'] = 'india';
                $data['name'] = 'ACKNIT INDUSTRIES LIMITED';

          $row = $this->AdvanceSearchModel_e->autoCompleteSearch($data);

        //   var_dump($row); die();

            if($data['searchtype']=='Company_name')
            {
                
                if($row){ 
                    $o="";
                   foreach($row as $key){
                    $o.="<a href='company_info/".$key['cin']."'><div class='resultRow' >".$key['name']."</div></a>";
                    
                   }
                //    $o.="<a href='companies?q=".$data['name']."&type=".$data['searchtype']."&country=IN'><div class='resultRow2' > Show All </div></a>";
                   echo $o;
                    }
                    else{
                        echo "<div class='resultRow3' > No result Found </div>";
                    }

            }
            else if($data['searchtype']=='Director_name')
            {

                if($row){ 
                    $o="";
                   foreach($row as $key){
                    $o.="<a href='director/".$key['din']."'><div class='resultRow' >".$key['name']."</div></a>";
                   }
                   $o.="<a href='directors?q=".$data['name']."'><div class='resultRow2' > Show All </div></a>";
                   echo $o;
                    }
                    else{
                        echo "<div class='resultRow3' > No result Found </div>";
                    }
                
            }

            else if($data['searchtype']=='CIN')
            {

                    if($row){ 
                     $o="";
                        foreach($row as $key){
                         $o.="<a href='company/".$key['cin']."'><div class='resultRow' >".$key['cin']."</div></a>";
                        }
                    $o.="<a href='Cin/".$data['name']."'><div class='resultRow2' > Show All </div></a>";
                    echo $o;
                        }
                    else{
                        echo "<div class='resultRow3' > No result Found </div>";
                    }
                
            }



            

    }
}