<?php
class AdvanceSearchModel_e extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function fetchCountry()
    {
        // return "model data aadad";
        $this->db->select('sortname,name');
        // $this->db->limit(20);
        $this->db->order_by('name');
        $query = $this->db->get('countries');
        return $query->result_array();
    }

    public function fetchCompany($like)
    {
        // $data=[''];
        $this->db->select('name,status,cin');
        $this->db->limit(12);
        $this->db->like('name',$like,'after');
        // $this->db->order_by('name');
        $query = $this->db->get('company');
        $fetchData = $query->result_array();
        $rowCount = $this->getCompanyRecord($like);
        // return $this->db->last_query();
        
        $data=[$fetchData,$rowCount];
        
        return $data;
    }
    public function getCompanyRecord($like)
    {
        $this->db->select('name');
        $this->db->like('name',$like,'after');
        // $this->db->order_by('name');
        $query = $this->db->get('company');
        return $query->num_rows();
    }
    public function fetchDirector($like)
    {
        $this->db->select(' scrap_dir.name as dirname,scrap_dir.din');
        // $this->db->join('company', 'company.cin = scrap_dir.cin');
        // $this->db->where('din', $id);
        $this->db->limit(12);
        $this->db->like('scrap_dir.name', $like,'after');
        $query = $this->db->get('scrap_dir');
        // $str = $this->db->last_query();
        // return $str; 
        
        $fetchData = $query->result_array();
        $rowCount = $this->fetchDirectorRecord($like); 
        $data = [$fetchData,$rowCount];
        
        return $data;

    }

    public function fetchDirectorRecord($like)
    {
        $this->db->select(' scrap_dir.name as dirname');
        // $this->db->join('company', 'company.cin = scrap_dir.cin');
        // $this->db->where('din', $id);
        $this->db->like('scrap_dir.name', $like,'after');
        $query = $this->db->get('scrap_dir');
        
        // $str = $this->db->last_query();
        // return $str; 
        return $query->num_rows();
    }

    public function fetchCompanyByCin($like)
    {
        $this->db->select('name,status,cin');
        $this->db->limit(12);
        $this->db->like('cin',$like,'after');
        // $this->db->order_by('name');
        $query = $this->db->get('company');
        $fetchData = $query->result_array();
        $rowCount =$this->fetchCompanyByCinRecord($like);
        $data = [$fetchData,$rowCount];
        return $data;
        // return $this->db->last_query();
        // return $query->result_array();
    }

    public function fetchCompanyByCinRecord($like)
    {
        $this->db->select('name');
        
        $this->db->like('cin',$like,'after');
        // $this->db->order_by('name');
        $query = $this->db->get('company');
        
        return $query->num_rows();
    }
    // ==================================================Fetch All Filter Data start========================================================== 
    public function fetchDataForAllFilters($filterType,$rocordPerPageInfo=12,$page,$industryFilter='',$countryFilter='',$companyType,$locationFiletrVal,$statusFiletrVal,$listedFiletrVal,$paidUpCap,$keywordVal)
    {   
        // echo $rocordPerPageInfo;exit;
        $this->db->select('name,status,cin');
        
        if(!empty($industryFilter))
        {    
            $industryFilterArr = explode(',',$industryFilter);
            // $industryFilterArr = $industryFilter;   
            foreach($industryFilterArr as $key => $value) {
                if($key == 0) {
                    // $match = "MATCH (`activity`) AGAINST ('".$value."' IN BOOLEAN MODE)";
                    // $this->db->where($match); 
                    $this->db->like('activity', $value,'after');
                    } else {
                  $this->db->or_like('activity', $value);
                }
            }
            // $this->db->where_in('activity', $industryFilterArr);
        }
        
        if(!empty($companyType))
        {
            $companyFilterArr = explode(',',$companyType);
            
            $this->db->where_in('class', $companyFilterArr);
        }
        if(!empty($locationFiletrVal))
        {
            $locationFiletrArr = explode(',',$locationFiletrVal);
            $this->db->where_in('roc', $locationFiletrArr);
        }
        if(!empty($statusFiletrVal))
        {
            $statusFiletArr = explode(',',$statusFiletrVal);
            $this->db->where_in('status', $statusFiletArr);
        }
        if(!empty($listedFiletrVal))
        {
            $listedFiletArr = explode(',',$listedFiletrVal);
            $this->db->where_in('listedOrUnlisted', $listedFiletArr);
        }
        
        if(!empty($paidUpCap))
        {
            $paidUpCapArr = explode(',',$paidUpCap);
            $this->db->where('paidUpCaiptal >=', (int)$paidUpCapArr[0]);
            $this->db->where('paidUpCaiptal <=', (int)$paidUpCapArr[1]);
        }

        if(!empty($keywordVal))
        {
            if($filterType=='Company_name')
            $this->db->like('name',$keywordVal,'after');
            if($filterType=='CIN')
            $this->db->like('cin',$keywordVal,'after');
        }
        
        // $this->db->like('activity',$industryFilterArr);
        // $this->db->where('');
        // $this->db->limit(100);  

        $this->db->limit($rocordPerPageInfo,$page);
        // $this->db->order_by('name');
        $query = $this->db->get('company');
        // $str = $this->db->last_query();
        // return $str;
        $rowCount = $this->getRecord($filterType,$rocordPerPageInfo,$page,$industryFilter,$countryFilter,$companyType,$locationFiletrVal,$statusFiletrVal,$listedFiletrVal,$paidUpCap,$keywordVal); 
        $arr=$query->result_array();

        // $this->db->order_by('name');
        // $queryForNoPage = $this->db->get('company');
        // $rowCount1 = $queryForNoPage->num_rows();  
        // return $rowCount;
        $fetchedData = [$arr,$rowCount];
        return $fetchedData;
    }
    // ==================================================Fetch All Filter Data End========================================================== 


    public function getRecord($filterType,$rocordPerPageInfo,$page,$industryFilter='',$countryFilter='',$companyType,$locationFiletrVal,$statusFiletrVal,$listedFiletrVal,$paidUpCap,$keywordVal)
    {   
        
        $this->db->select('');
        
        if(!empty($industryFilter))
        {    
            $industryFilterArr = explode(',',$industryFilter);
            // $industryFilterArr = $industryFilter;   
            foreach($industryFilterArr as $key => $value) {
                if($key == 0) {
                    $this->db->like('activity', $value,'after');
                    } else {
                  $this->db->or_like('activity', $value);
                }
            }
        }
        
        if(!empty($companyType))
        {
            $companyFilterArr = explode(',',$companyType);
            
            $this->db->where_in('class', $companyFilterArr);
        }
        if(!empty($locationFiletrVal))
        {
            $locationFiletrArr = explode(',',$locationFiletrVal);
            $this->db->where_in('roc', $locationFiletrArr);
        }
        if(!empty($statusFiletrVal))
        {
            $statusFiletArr = explode(',',$statusFiletrVal);
            $this->db->where_in('status', $statusFiletArr);
        }
        if(!empty($listedFiletrVal))
        {
            $listedFiletArr = explode(',',$listedFiletrVal);
            $this->db->where_in('listedOrUnlisted', $listedFiletArr);
        }
        
        if(!empty($paidUpCap))
        {
            $paidUpCapArr = explode(',',$paidUpCap);
            $this->db->where('paidUpCaiptal >=', (int)$paidUpCapArr[0]);
            $this->db->where('paidUpCaiptal <=', (int)$paidUpCapArr[1]);
        }

        if(!empty($keywordVal))
        {
            if($filterType=='Company_name')
            $this->db->like('name',$keywordVal,'after');
            if($filterType=='CIN')
            $this->db->like('cin',$keywordVal,'after');
        }  
                
        // $this->db->order_by('name');
        $query = $this->db->get('company');
        $rowCount = $query->num_rows(); 
        // $str = $this->db->last_query();
        // return $str;
        return $rowCount;
        
    }

    public function fetchDirectorWithFilters($rocordPerPageInfo=12,$page,$industryFilter='',$countryFilter='',$companyType,$locationFiletrVal,$statusFiletrVal,$listedFiletrVal,$paidUpCap,$keywordVal)
    {
        // company.name as company_name,
        // $this->db->select(' scrap_dir.name as dirname,scrap_dir.din');
        $this->db->select('scrap_dir.name as dirname,scrap_dir.din');
        
        // $this->db->join('company', 'company.cin = scrap_dir.cin');
        // $this->db->where('din', $id);
        
        // echo $rocordPerPageInfo;exit;
        // $this->db->select('name,din,cin');
        
        // if(!empty($industryFilter))
        // {    
        //     $industryFilterArr = explode(',',$industryFilter);
        //     // $industryFilterArr = $industryFilter;   
        //     foreach($industryFilterArr as $key => $value) {
        //         if($key == 0) {
        //             $this->db->like ('company.activity', $value,'both',false);
        //             } else {
        //             $this->db->or_like('company.activity', $value);
        //         }
        //     }
        // }
               
        // if(!empty($companyType))
        // {
        //     $companyFilterArr = explode(',',$companyType);
                   
        //     $this->db->where_in('company.class', $companyFilterArr);
        // }
        // if(!empty($locationFiletrVal))
        // {
        //     $locationFiletrArr = explode(',',$locationFiletrVal);
        //     $this->db->where_in('company.roc', $locationFiletrArr);
        // }
        // if(!empty($statusFiletrVal))
        // {
        //     $statusFiletArr = explode(',',$statusFiletrVal);
        //     $this->db->where_in('company.status', $statusFiletArr);
        // }
        // if(!empty($listedFiletrVal))
        // {
        //     $listedFiletArr = explode(',',$listedFiletrVal);
        //     $this->db->where_in('company.listedOrUnlisted', $listedFiletArr);
        // }
               
        // if(!empty($paidUpCap))
        // {
        //     $paidUpCapArr = explode(',',$paidUpCap);
        //     $this->db->where('company.paidUpCaiptal >=', (int)$paidUpCapArr[0]);
        //     $this->db->where('company.paidUpCaiptal <=', (int)$paidUpCapArr[1]);
        // }
       
        if(!empty($keywordVal))
        {
            $this->db->like('scrap_dir.name',$keywordVal,'after');
        }
               
       
        $this->db->limit($rocordPerPageInfo,$page);
        // $this->db->order_by('scrap_dir.name');
        // $this->db->limit(20);
        // $this->db->like('scrap_dir.name', $like);
        $query = $this->db->get('scrap_dir');
        // $query = $this->db->get('company');
        
        // $str = $this->db->last_query();
        $rowCount = $this->getRecordDirector($keywordVal); 
        // return $str;
        $arr=$query->result_array();
       //    var_dump($str);exit;
        $fetchedData = [$arr,$rowCount];
        // var_dump($fetchedData);exit;
        return $fetchedData; 
    }
    public function getRecordDirector($keywordVal)
    {
        $query='';

        $this->db->select('');
        
        if(!empty($keywordVal))
        {
            $this->db->like('name',$keywordVal,'after');

            // $this->db->limit(100);

            $query = $this->db->get('scrap_dir');
        }
        
        
        $record = $query->num_rows();

        // $record = $this->db->last_query();

        return $record;

    }
    // / company name type search=====query==========================

    
    
    public function autoCompleteSearch($d)
    {
        // return $d['searchtype'];
        // die();
        


 // / company name type search=====query==========================

    if ($d['searchtype'] == 'Company_name') {
        $this->db->select(`cin`,`name`);
        $this->db->from('company');
        $this->db->like('name', $d['name'] ,'after');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result_array();

    }

    // ====================director type ==search====

    if ($d['searchtype'] == 'Director_name') {


        $this->db->select(`name`,`din`);
        $this->db->from('directors');
        $this->db->like('name', $d['name'] ,'after');
        $this->db->limit(5);
        $query = $this->db->get();
        // $query = $this->db->last_query();

        // return $query ; die();

        if($query){return $query->result_array();}

        else{

        $this->db->select(`cin`);
        $this->db->from('company');
        $this->db->like('name', $d['name'] ,'after');
        $this->db->join('com_data', 'company.cin = com_data.cin');
        $this->db->join('directors', 'com_data.cid = directors.din');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result_array();

    }
    

    }}

    // =================================serach indutry type start====================================
    public function getindustry()
    {
        $this->db->select('DISTINCT(activity)');
        $this->db->where('activity is NOT NULL', NULL, FALSE);
        $this->db->order_by('activity',"ASC");
      //  $this->db->limit(20);
        $query = $this->db->get('company');
        $data = $query->result_array();
        return $data;
    }
    // =================================serach indutry type end====================================
    
}