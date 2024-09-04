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
class Company_info_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function updateComInfo($cin)
    {
        $message = "";
        $this->db->select('cin,user_id');
        $this->db->where('cin',$cin);
        $this->db->where('user_id',$_SESSION['auth_user']);
        $query = $this->db->get('update-info');
        $rowCount = $query->num_rows();
        if(!$rowCount)
        {
            
        
            $insert =array(
                'cin'=>$cin,
                'user_id'=>$_SESSION['auth_user'],
                'status'=>'Pending',
                'date'=>date("Y-m-d H:i:s"),
            );
        
            // $this->db->insert('update-info', $insert);
        
            if ($this->db->insert('update-info', $insert)) {
                $message='Success';
            } else {
                $message='Error';
            }

            return $message;
        }
        else
        {
            return "already_exist";
        }
        
    }
}


