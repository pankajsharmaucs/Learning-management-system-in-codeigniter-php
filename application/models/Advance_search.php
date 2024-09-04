<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Front_model

 * @package        UCS
 * @category    Model
 * @param     ...
 * @return    ...
 *
 */
class Advance_search extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


// ===============Advance===search===




        public function filterAdvanceSearch($industry)
        {

            $r=[null];
          
            foreach($industry as $key => $value ){

                array_push($r, $value);
                   
            }               
                
        
             
                $this->db->select('*');
                $this->db->from('company'); 
                 
                    $this->db->where_in('activity', 'OTHERS');

               
                $this->db->limit(1);
                $query = $this->db->get();
                return $query->result_array();
        }

        

}