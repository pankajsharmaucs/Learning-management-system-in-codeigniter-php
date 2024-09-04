<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Front_model

 * @package		UCS
 * @category	Model
 * @param     ...
 * @return    ...
 *
 */
class Test_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }

   // create search indexing company names
   public function createindex()
   {
    $this->db->select('*');
    $query = $this->db->get('company');
    $data=$query->result_array();
    foreach ($data as $item) {
      // echo $item['name'];
      $sound="";
      if($item['name']!=null){
        $words=explode(" ",$item['name']);
        foreach($words as $word){
          
            $sound.=metaphone($word)." ";
          
        }
      }
      $id=$item['id'];
      $insert=array(
        'indexing'=>$sound
      );
      $this->db->where('id', $id);
      $this->db->update('company', $insert);

    }
   }




  //  search company results
  public function search()
  {
  
        $this->db->select('*');
        $query=$this->db->get('company');
        return $query->result_array();
        
  }

  // ------------------------------------------------------------------------

}