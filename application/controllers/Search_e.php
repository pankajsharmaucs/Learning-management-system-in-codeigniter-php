<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Controller Search
 *
 * @package   UCS
 * @category  Search
 *
 */

class Search_e extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }


 // ===================Get==all==country==dropdwon==list=====
    public function all_country()
    {

       // echo 'controller'; die();

               $dbc=$this->load->model('Search_home_e');
                $data['country'] = $this->input->get_post('country');

          $row = $this->Search_home_e->get_all_country();
          // var_dump($row); die();
           
                if($row){ 
                    $o="";
                    $id=1;
                   foreach($row as $key){
                    $o.="<div class='countryResultRow'  id='dropCountry".$id."' onclick='chooseCountry2(".$id.");'>
                                    <h4 class='mr-2 pt-2'>".$key['name']." </h4>
                                    <img src='".base_url('/assets/home_e/flags/').strtolower($key['sortname']).".png' > 
                                    <input type='hidden' id='cname".$id."' value='".$key['name']."' >
                                    <input type='hidden' id='sortname".$id."' value='".$key['sortname']."' >
                                   </div>";
                   $id++;}
                   // $o.="<a href='companies?q=".$data['name']."&type=".$data['searchtype']."&country=IN'><div class='resultRow2' > Show All </div></a>";
                   echo $o;
                    }
                    else{
                        echo "<div class='resultRow3' > No result Found </div>";
                    }
    }


     // ===================Auto==countrySearch=======
    public function countrySearch()
    {

        $country=$this->input->get_post('country');
       // echo $country; die();
               $dbc=$this->load->model('Search_home_e');
                $data['country'] = $this->input->get_post('country');

          $row = $this->Search_home_e->autoSearchCountry($data);
          // var_dump($row); die();
           
                if($row){ 
                    $o="";
                    $id=1;
                   foreach($row as $key){
                    $o.="<div class='countryResultRow countryResultRow2'  id='keyPressCountry".$id."'  onclick='chooseCountry(".$id.");'>
                                    <h4 class='mr-2 pt-2'>".$key['name']." </h4>
                                    <img src='".base_url('/assets/home_e/flags/').strtolower($key['sortname']).".png'> 
                                    <input type='hidden' id='cname".$id."' value='".$key['name']."' >
                                    <input type='hidden' id='sortname".$id."' value='".$key['sortname']."' >
                                  </div>";
                   $id++;}
                   // $o.="<a href='companies?q=".$data['name']."&type=".$data['searchtype']."&country=IN'><div class='resultRow2' > Show All </div></a>";
                   
                   $count=count($row);

                  $array = array("data" => $o, "count" => $count);

                 echo json_encode($array);

                   // echo $count;



                    }
                    else{
                        echo "<div class='resultRow3' > No result Found </div>";
                    }
    }



    // ===============End==country===search=====

    // ===================Auto==search=======
    public function autoCompleteSearch()
    {
        // $d="yes"; 
        // 
        // $skillData = array();
        $searchtype=$this->input->get_post('searchtype');
        $country=$this->input->get_post('country');
        $name=$this->input->get_post('name');

               $dbc=$this->load->model('Search_home_e');
        
                $data['searchtype'] = $this->input->get_post('searchtype');
                $data['country'] = $this->input->get_post('country');
                $data['name'] = $this->input->get_post('name');

          $row = $this->Search_home_e->autoCompleteSearch($data);
        //   var_dump($row); die();
           
                if($row){ 
                   //  $o="";
                   // foreach($row as $key){
                   //  $o.="<a href='Company_info/".$key['cin']."'><div class='resultRow' >".$key['name']."</div></a>";
                   // }
                   // $o.="<a href='Advance_search/".$data['name'].".".$data['searchtype'].".IN'><div class='resultRow2' > Show All </div></a>";
                   // echo $o;


                     echo json_encode(['data'=> $row]);


            //         }
            //         else{
            //             echo "<div class='resultRow3' > No result Found </div>";
            //         }
            // }
            // else if($data['searchtype']=='Director_name')
            // {

            //     if($row){ 
            //        //  $o="";
            //        // foreach($row as $key){
            //        //  $o.="<a href='Director_info/".$key['din']."'><div class='resultRow' >".$key['name']."</div></a>";
            //        // }
            //        // $o.="<a href='Director_search/".$data['name'].".".$data['searchtype'].".IN'><div class='resultRow2' > Show All </div></a>";
            //        // echo $o;


            //         echo json_encode(['data'=> $row]);

            //         }
            //         else{
            //             echo "<div class='resultRow3' > No result Found </div>";
            //         }
                
            // }

            // else if($data['searchtype']=='CIN')
            // {

            //         if($row){ 
            //          $o="";
            //             foreach($row as $key){
            //              $o.="<a href='Company_info/".$key['cin']."'><div class='resultRow' >".$key['cin']."</div></a>";
            //             }
            //         $o.="<a href='Advance_search/".$data['name'].".".$data['searchtype'].".IN'><div class='resultRow2' > Show All </div></a>";
            //         echo $o;
            //             }
            //         else{
            //             echo "<div class='resultRow3' > No result Found </div>";
            //         }
                
            // }


          
          
       }

    }






}

?>