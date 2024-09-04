<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Model
{
    #Start query for ajax data table================================================================
    private function _get_datatables_query($table,$column_order="",$column_search="",$order="")
    {

        $this->db->from($table);

        $i = 0;
        foreach ($column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {

                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($column_search) - 1 == $i) //last loop
                $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($order))
        {
            $order = $order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($table,$column_order,$column_search,$order,$where_col="",$where_in_array="",$where="")
    {

        $this->_get_datatables_query($table,$column_order,$column_search,$order);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        if($where_col && $where_in_array)
        {
            $this->db->where_in($where_col, $where_in_array);
        }
        if($where)
        {
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($table,$column_order,$column_search,$order,$where_col="",$where_in_array="",$where="")
    {
        $this->_get_datatables_query($table,$column_order,$column_search,$order);
        if($where_col && $where_in_array)
        {
            $this->db->where_in($where_col, $where_in_array);
        }
        if($where)
        {
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($table,$where_col="",$where_in_array="",$where="")
    {
        if($where_col && $where_in_array)
        {
            $this->db->where_in($where_col, $where_in_array);
        }
        if($where)
        {
            $this->db->where($where);
        }
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    #End query for ajax data table====================================================================



    public function insert_json_in_db($table,$json_data)
    {

        $array = json_decode($json_data);
        $this->db->insert($table, $array);
        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    function count_row($table,$where)
    {
        $this->db->where($where);
        $data = $this->db->get($table);
        $num = $data->num_rows();

        if($num)
        {
            return $num;
        }
        else
        {
            return false;
        }
    }


    function insert($table, $data)
    {
        $this->db->insert($table,$data);
        $num = $this->db->insert_id();
        if($num)
        {
            return $num;
        }
        else
        {
            return FALSE;
        }
    }

    function insert_multi_joson($table, $data)
    {
        $array = json_decode($data);
        $this->db->insert_batch($table,$array);
        $num = $this->db->insert_id();
        if($num)
        {
            return true;
        }
        else
        {
            return FALSE;
        }
    }
    function insert_multi($table, $data)
    {
        $this->db->insert_batch($table,$data);
        $num = $this->db->insert_id();
        if($num)
        {
            return true;
        }
        else
        {
            return FALSE;
        }
    }

    function getCustom($str_query)
    {
        $getdata = $this->db->query($str_query);
        $num = $getdata->num_rows();
        if($num> 0)
        {
            $arr=$getdata->result();
            foreach ($arr as $rows)
            {
            $data[] = $rows;
            }
            $getdata->free_result();
            return $data;}else{ return false;
        }
    }
    function  sociallink_insert($data)
    {
        // Inserting in Table(students) of Database(college)
        $this->db->insert('bf_social_link', $data);
    }



    function getSpecific($tablename, $cond1,$field,$cond2)
    {
        $this->db->where($cond1);
        $where=$field.'LIKE "%'.$cond2.'%"';
        $this->db->where($where);
        $getdata = $this->db->get($tablename);
        $num = $getdata->num_rows();
        if($num> 0)
        {
            $arr=$getdata->result();
            foreach ($arr as $rows)
            {
                    $data[] = $rows;
            }
            $getdata->free_result();
            return $data;
        }
        else
        {
            return false;
        }
    }

    function getNotIn($table,$array,$col)
    {
        $this->db->where_not_in($col, $array);
        $getdata = $this->db->get($table);
        $num = $getdata->num_rows();
        if($num> 0)
        {
            $arr=$getdata->result();
            foreach ($arr as $rows)
            {
                    $data[] = $rows;
            }
            $getdata->free_result();
            return $data;
        }
        else
        {
            return false;
        }

    }

    function getWhereNotIn($table,$array,$col,$where)
    {
        $this->db->where($where);
        $this->db->where_not_in($col, $array);
        $getdata = $this->db->get($table);
        $num = $getdata->num_rows();
        if($num> 0)
        {
            $arr=$getdata->result();
            foreach ($arr as $rows)
            {
                    $data[] = $rows;
            }
            $getdata->free_result();
            return $data;
        }
        else
        {
            return false;
        }

    }
    function getWhereIn($table,$array)
    {
        //$names = array('admin_uname', 'admin_pswd');
        $this->db->where_in('field', $array);
        $getdata = $this->db->get($table);
        $num = $getdata->num_rows();
        if($num> 0)
        {
            $arr=$getdata->result();
            foreach ($arr as $rows)
            {
                    $data[] = $rows;
            }
            $getdata->free_result();
            return $data;
        }
        else
        {
            return false;
        }

    }

    function getWhereLogin($table)
    {
        $names = array('admin_uname', 'admin_pswd');
        $this->db->where_in('field', $names);
        $getdata = $this->db->get($table);

        $num = $getdata->num_rows();
        if($num> 0)
        {
            $arr=$getdata->result();
            foreach ($arr as $rows)
            {
                    $data[] = $rows;
            }
            $getdata->free_result();
            return $data;
        }
        else
        {
            return false;
        }

    }

    function getWhere($table,$where)
    {
        $this->db->where($where);
        $getdata = $this->db->get($table);

        $num = $getdata->num_rows();
        if($num> 0)
        {
            $arr=$getdata->result();
            foreach ($arr as $rows)
            {
                    $data[] = $rows;
            }
            $getdata->free_result();
            return $data;
        }
        else
        {
            return false;
        }
    }
    
    function getAllWithNotEqual($table)
    {
        $this->db->where('role!=',1);
        $getdata = $this->db->get($table);

        $num = $getdata->num_rows();
        if($num> 0)
        {
            $arr=$getdata->result();
            foreach ($arr as $rows)
            {
                    $data[] = $rows;
            }
            $getdata->free_result();
            return $data;
        }
        else
        {
            return false;
        }
    }

    function getWhereWithOrderbyLimit($table,$where,$orderby,$ordertype,$limit)
    {
        $this->db->where($where);
        $this->db->order_by($orderby,$ordertype);
        $this->db->limit($limit);
        $getdata = $this->db->get($table);

        $num = $getdata->num_rows();
        if($num> 0)
        {
            $arr=$getdata->result();
            foreach ($arr as $rows)
            {
                    $data[] = $rows;
            }
            $getdata->free_result();
            return $data;
        }
        else
        {
            return false;
        }

    }
    function getAllWithOrderbyLimit($table,$orderby,$limit="")
    {
        $getdata = $this->db->get($table);
        $this->db->order_by($orderby,'desc');
        $this->db->limit(10);
        $num = $getdata->num_rows();
        if($num> 0)
        {
            $arr=$getdata->result();
            foreach ($arr as $rows)
            {
                    $data[] = $rows;
            }
            $getdata->free_result();
            return $data;
        }
        else
        {
            return false;
        }

    }
    function getWhereWithOrderby($table,$where,$orderby)
    {
        $this->db->where($where);
        $getdata = $this->db->get($table);
        $this->db->order_by($orderby,'desc');
        $num = $getdata->num_rows();
        if($num> 0)
        {
            $arr=$getdata->result();
            foreach ($arr as $rows)
            {
                    $data[] = $rows;
            }
            $getdata->free_result();
            return $data;
        }
        else
        {
            return false;
        }

    }
    //chart model
    function get_data()
    {
         $this->db->select('your_name');
        $this->db->from('bf_members');
        $query = $this->db->get();
       	return $query->result();
    }



    function getAll($table)
    {
        $data = $this->db->get($table);
        $get = $data->result();
        $num = $data->num_rows();
        if($num)
        {
            return $get;
        }
        else
        {
            return false;
        }
    }

    /*get all with limit star*/
    function getAllWithL($table,$limit,$offset)
    {
        $this->db->limit($limit, $offset);
        $data = $this->db->get($table);
        $get = $data->result();
        $num = $data->num_rows();

        if($num)
        {
            return $get;
        }
        else
        {
            return false;
        }
    }
    /*get all with limit end*/




    /*get data with where and limit*/
    function getWhereAndL($table,$where,$limit,$offset)
    {
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $getdata = $this->db->get($table);
        $num = $getdata->num_rows();
        if($num> 0)
        {
            $arr=$getdata->result();
            foreach ($arr as $rows)
            {
                    $data[] = $rows;
            }
            $getdata->free_result();
            return $data;
        }
        else
        {
            return false;
        }

    }
    /**/



    /*Get all in desc/asc order start*/
    function getAllWithOrder($table,$order_field,$order_type)
    {
        $data = $this->db->get($table);
        $this->db->order_by($order_field,$order_type);
        $get = $data->result();
        $num = $data->num_rows();
        if($num)
        {
            return $get;
        }
        else
        {
            return false;
        }
    }
    /*Get all in desc/asc order end*/

    /**/
    function getJoinTwoWithOL($tbl1,$tbl2 ,$field1,$field2,$order_field,$order_type,$limit,$offset)
    {
        $this->db->select($tbl1.'.*,'.$tbl2.'.user_name');
        $this->db->from($tbl1);
        $this->db->join($tbl2, $tbl1.'.'.$field1.'='.$tbl2.'.'.$field2);
        $this->db->order_by($tbl1.'.'.$order_field,$order_type);
        $this->db->limit($limit, $offset);
        $getdata  = $this->db->get();
        $num = $getdata->num_rows();
        if($num> 0)
        {
            $arr=$getdata->result();
            foreach ($arr as $rows)
            {
             $data[] = $rows;
            }
            $getdata->free_result();
            return $data;
        }
        else
        {
            return false;
        }
    }
/**/



    /*Get all with join Three table and with order start*/
    function getJoinTwoWithOrder($tbl1,$tbl2,$field1,$field2,$order_field,$order_type)
    {
        $this->db->select($tbl1.'.*,'.$tbl2.'.user_name');
        $this->db->from($tbl1);
        $this->db->join($tbl2, $tbl1.'.'.$field1.'='.$tbl2.'.'.$field2);
        //$this->db->join($tbl3, $tbl1.'.'.$field3.'='.$tbl3.'.'.$field4);
        $this->db->order_by($tbl1.'.'.$order_field,$order_type);
        $getdata  = $this->db->get();
        $num = $getdata->num_rows();
        if($num> 0)
        {
            $arr=$getdata->result();
            foreach ($arr as $rows)
            {
             $data[] = $rows;
            }
            $getdata->free_result();
            return $data;
        }
        else
        {
            return false;
        }
    }
   

    /*get all with join two and order and where start*/
    function getJTWithOW($tbl1,$tbl2,$field1,$field2,$order_field,$order_type,$where)
    {
        $this->db->select($tbl1.'.*,'.$tbl2.'.f_name');
        $this->db->from($tbl1);
        $this->db->join($tbl2, $tbl1.'.'.$field1.'='.$tbl2.'.'.$field2);
        $this->db->order_by($tbl1.'.'.$order_field,$order_type);
        $this->db->where($where);
        $getdata  = $this->db->get();
        $num = $getdata->num_rows();
        if($num> 0)
        {
            $arr=$getdata->result();
            foreach ($arr as $rows)
            {
             $data[] = $rows;
            }
            $getdata->free_result();
            return $data;
        }
        else
        {
            return false;
        }
     }
    /*get all with join two and order and where end*/

    /*get all with join two and order and where and limit start*/

    function getJTWithOLW($tbl1,$tbl2 ,$field1,$field2,$order_field,$order_type,$limit,$offset,$where)
    {
        $this->db->select($tbl1.'.*,'.$tbl2.'.f_name');
        $this->db->from($tbl1);
        $this->db->join($tbl2, $tbl1.'.'.$field1.'='.$tbl2.'.'.$field2);
         $this->db->order_by($tbl1.'.'.$order_field,$order_type);
        $this->db->limit($limit, $offset);
        $this->db->where($where);
        $getdata  = $this->db->get();
        $num = $getdata->num_rows();
        if($num> 0)
        {
            $arr=$getdata->result();
            foreach ($arr as $rows)
            {
             $data[] = $rows;
            }
            $getdata->free_result();
            return $data;
        }
        else
        {
            return false;
        }
    }
    /*get all with join two and order and where and limit end*/

    /*get all with join two and order and like start*/
    function getJTWithOLi($tbl1,$tbl2,$field1,$field2,$order_field,$order_type,$like_f,$like_txt)
    {
        $this->db->select($tbl1.'.*,'.$tbl2.'.f_name');
        $this->db->from($tbl1);
        $this->db->join($tbl2, $tbl1.'.'.$field1.'='.$tbl2.'.'.$field2);
        $this->db->order_by($tbl1.'.'.$order_field,$order_type);
        $this->db->like($like_f, $like_txt);
        //$this->db->where($where);
        $getdata  = $this->db->get();
        $num = $getdata->num_rows();
        if($num> 0)
        {
            $arr=$getdata->result();
            foreach ($arr as $rows)
            {
             $data[] = $rows;
            }
            $getdata->free_result();
            return $data;
        }
        else
        {
            return false;
        }
     }
    /*get all with join two and order and like end*/

    /*get all with join two and order and like and where start*/
    function getJTWithOLiW($tbl1,$tbl2,$field1,$field2,$order_field,$order_type,$like_f,$like_txt,$where)
    {
        $this->db->select($tbl1.'.*,'.$tbl2.'.f_name');
        $this->db->from($tbl1);
        $this->db->join($tbl2, $tbl1.'.'.$field1.'='.$tbl2.'.'.$field2);
        $this->db->order_by($tbl1.'.'.$order_field,$order_type);
        $this->db->like($like_f, $like_txt);
        $this->db->where($where);
        $getdata  = $this->db->get();
        $num = $getdata->num_rows();
        if($num> 0)
        {
            $arr=$getdata->result();
            foreach ($arr as $rows)
            {
             $data[] = $rows;
            }
            $getdata->free_result();
            return $data;
        }
        else
        {
            return false;
        }
     }
    /*get all with join two and order and like and where end*/


    function update($table,$where,$data)
    {
        $this->db->where($where );
        $update = $this->db->update($table,$data);

        if($update)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }


    function delete($table,$where)
    {
        $this->db->where($where);
        $this->db->limit('1');
        $del = $this->db->delete($table);
        if($del){
                return true;
        }else{
                return false;
        }
    }
    function deleteAll($table,$where)
    {
        $this->db->where($where);
        $del = $this->db->delete($table);
        if($del){
                return true;
        }else{
                return false;
        }
    }

    function getRows($str_query)
    {
        $result = $this->db->query($str_query);
        $numofrecords = $result->num_rows();
        if($numofrecords> 0)
        {
            return $result->result();
        }
        else
        {
            return false;
        }
    }
    function getRow($str_query)
    {
        $result = $this->db->query($str_query);
        $numofrecords = $result->num_rows();
        if($numofrecords> 0)
        {
            return $result->row();
        }
        else
        {
            return false;
        }
    }
    function getVal($str_query)
    {
        $result = $this->db->query($str_query);
        $numofrecords = $result->num_rows();
        if($numofrecords> 0)
        {
            foreach ($result->row() as $onefield)
            {
                return $onefield;
            }
        }
        else
        {
            return false;
        }
    }
    function fetchSetting($table,$array)
    {
        $arraydata=array();
        $this->db->where_in('field',$array);
        $getdata = $this->db->get($table);
        $data=$getdata->result();
        if(is_array($data) && count($data)>0)
        {
            foreach($data as $datai)
            {
                $arraydata[$datai->field]=$datai->value;
            }
        }
        return $arraydata;
    }






































// ==============Teacher===models=====

function get_teacher_data_course_id($teacher_id)
        {                          
                $this->db->select(`*`);
                $this->db->from('teacher');
                $this->db->where('teacher_id', $teacher_id);
                $query = $this->db->get();
                return $query->result_array();
       }


function get_course_by_teacher($teacher_id)
        {                          
                $this->db->select(`*`);
                $this->db->from('course_data');
                $this->db->where('instructor_id', $teacher_id);
                $query = $this->db->get();
                return $query->num_rows();
       }



    function createFirstCourse()
    { 
       
       // var_dump($_SESSION['auth_email']); die(); 
        if($_SESSION['auth_teacher_email'] and $_SESSION['login_token'])
        {
         
            $auth_email=$_SESSION['auth_teacher_email'];

            $this->db->select(`id`);
            $this->db->from('teacher');
            $this->db->where('email', $auth_email);
            $query = $this->db->get();  


                if($query->num_rows() == 1)
                {
                    $this->db->where('email', $auth_email );
                    $this->db->update('teacher',array('first_login' => 1 ));
                    return true;
            
             }else{return 'Invalid User'; die();}
           
        
        }else{return 'Invalid User'; die();}
         
            
   }




function get_teacher_data($email)
        {                          
                $this->db->select(`*`);
                $this->db->from('teacher');
                $this->db->where('email', $email);
                $query = $this->db->get();
                return $query->result_array();
       }


function get_teacher_course_data($status,$email)
        {                          
                $this->db->select(`*`);
                $this->db->from('course_data');
                $this->db->where('course_status', $status);
                $this->db->where('instructor_id', $email);
                $query = $this->db->get();
                return $query->result_array();
       }




function CreateCourse1($data)
  { 
       
        if($_SESSION['auth_teacher_id'] and $_SESSION['login_token'])
        {
            extract($data);

            $teacher_id=$_SESSION['auth_teacher_id'];

            $slug=trim(str_replace('&', 'and', $data['coursetitle'])); 
            $slug=trim(str_replace(',', ' ', $slug));
            $slug=trim(str_replace(':', ' ', $slug));


            $this->db->select(`id`);
            $this->db->from('course_data');
            $this->db->where('instructor_id', $teacher_id);
            $this->db->where('course_name', $coursetitle);
            $query = $this->db->get(); 


        if($query->num_rows() <= 0)
         {

            $this->db->select(`id`);
            $this->db->from('course_data');
            $this->db->order_by("id ", "desc");
            $query = $this->db->get(); 
            $lastId = $query->result_array();
            $lastId=$lastId[0]['id'];

            $rid=rand(1,999);
            $id=$lastId+1;
           
            $cid='us_course_'.$id.$rid;

            date_default_timezone_set('Asia/Kolkata');
            $reg_date =  date('d-M-Y');


            $this->db->set(['instructor_id'=>$teacher_id, 'cat_id'=>$data['courseCat'],'sub_id'=>$data['courseSubCat']
             ,'course_id'=>$cid,'course_name'=>$data['coursetitle'],'slug'=>$slug, 'updoaded_date'=>$reg_date]);

            $res=$this->db->insert('course_data');

            if($res){  
                     $_SESSION['current_course_id']=$cid;
                     $_SESSION['current_course_name']=$data['coursetitle']; 
                     echo "Created"; die(); }else{ echo "failed"; die(); }
                    
        }else{ $data=$query->result_array();
               $cid=$data[0]['course_id'];
               $course_name=$data[0]['course_name'];
               $_SESSION['current_course_id']=$cid;
               $_SESSION['current_course_name']=$course_name; 
               echo 'already'; die();}
                           
        }else{echo 'Invalid User'; die();}
         
            
 }



function CreateCourse2($data)
  { 
       
        if($_SESSION['auth_teacher_id'] and $_SESSION['login_token'])
        {
            extract($data);
            $teacher_id=$_SESSION['auth_teacher_id'];

            $slug=$data['slug']; 

            $course_id=$_SESSION['current_course_id'];

            $this->db->select(`id`);
            $this->db->from('course_data');
            $this->db->where('course_id', $course_id);
            $query = $this->db->get(); 


        if($query->num_rows() >= 1 )
         {
            date_default_timezone_set('Asia/Kolkata');
            $reg_date =  date('d-M-Y');


            $this->db->where('course_id', $course_id );
            $res=$this->db->update('course_data',
                       array('overview' => $data['courseOverview'],
                             'slug' => $slug,
                             'course_price' => $data['coursePrice'],
                             'offer_price' => $data['offerPrice']
                  ));
            
            if($res){ echo "Created"; die(); }else{ echo "failed to save"; die(); }
                    
        }else{ echo 'invalid Course'; die();}
                           
        }else{echo 'Invalid User'; die();}
         
            
 }



function CreateCourse3($data)
  { 
       
        if($_SESSION['auth_teacher_id'] and $_SESSION['login_token'])
        {
            extract($data);
            $teacher_id=$_SESSION['auth_teacher_id'];
            $course_id=$_SESSION['current_course_id'];



            $this->db->select(`id`);
            $this->db->from('course_data');
            $this->db->where('course_id', $course_id);
            $query = $this->db->get(); 


            if($query->num_rows() >= 1 )
             {
                $this->db->where('course_id', $course_id );
                $res=$this->db->update('course_data',array('description' => $data['description'] ));

                if($res){

                    $hightlight= $data['hightlight'];
                    $hightlight=explode('_,', $hightlight);
                    $hightlight=str_replace('_','',$hightlight);

                       // var_dump($hightlight); die();
                       $this->db->where('course_id', $course_id );
                       $this->db->where('teacher_id', $teacher_id );
                       $this->db->delete('course_highlight');
                        

                    $id=0;
                    foreach ($hightlight as $key ) {
                        if(!empty($key)){
                            $this->db->set(['course_id'=>$course_id,'teacher_id'=>$teacher_id,'description'=>$key ]);
                            $res=$this->db->insert('course_highlight');
                        }                        
                    $id++;}
         
                        echo "Created";      
                        die();
                  
                  }else{ echo "failed to save"; die(); }
                        
            }else{ echo 'invalid Course'; die();}
                               
        }else{echo 'Invalid User'; die();}
         
            
 }







function addSection($data)
  { 
       
        if($_SESSION['auth_teacher_id'] and $_SESSION['login_token'])
        {
            extract($data);
            $teacher_id=$_SESSION['auth_teacher_id'];
            $course_id=$_SESSION['current_course_id'];


            $this->db->select(`id`);
            $this->db->from('course_data');
            $this->db->where('course_id', $course_id);
            $query = $this->db->get(); 


            if($query->num_rows() >= 1 )
             {
                $this->db->select(`id`);
                $this->db->from('course_content');
                $this->db->where('course_id', $course_id);
                $this->db->where('section_name', $data['sectionTitle']);
                $query = $this->db->get(); 

                if($query->num_rows() <= 0 )
                 {
                    $this->db->select(`id`);
                    $this->db->from('course_content');
                    $this->db->order_by("id ", "desc");
                    $query = $this->db->get(); 
                    $lastId = $query->result_array();
                    $lastId=$lastId[0]['id'];

                    $rid=rand(1,999);
                    $id='sec_'.$lastId+1;

                    // echo $id; die();                   

                    $this->db->set(['course_id'=>$course_id,'section_id'=>$id,'section_name'=>$data['sectionTitle'] ]);
                    $res=$this->db->insert('course_content');

                    if($res){ echo "Created"; die(); }else{ echo "Failed to save"; die(); }
                  
                  }else{ echo "Section Already Exist"; die(); }
                        
            }else{ echo 'Invalid Course'; die();}
                               
        }else{echo 'Invalid User'; die();}
         
            
 }



function deleteSecBox($section_id,$table){

    if($_SESSION['auth_teacher_id'] and $_SESSION['login_token'])
        { 

            $teacher_id=$_SESSION['auth_teacher_id'];
            $cid=$_SESSION['current_course_id'];

    $section_id='sec_'.$section_id;
    $sidFolder=md5($section_id);

    $getLec=$this->Admin->get_section_lec($cid,'course_content_lecture',$section_id); 

    if($getLec){
          foreach ($getLec as $key ) {

                $lec_id=$key['lec_id'];

                $path='assets/course_data/'.$cid.'/'.$sidFolder.'/'.$lec_id;
                unlink($path.'/'.$key['v_link']);

                $this->db->where('course_id', $cid );
                $this->db->where('section_id', $section_id );
                $this->db->where('teacher_id', $teacher_id );
                $this->db->where('lec_id', $lec_id );
                $delete=$this->db->delete('course_content_lecture');

                $path2='assets/course_data/'.$cid.'/'.$sidFolder.'/'.$lec_id;
                rmdir($path2);

          }
    }


             $secDir='assets/course_data/'.$cid.'/'.$sidFolder;

             rmdir($secDir);

             $this->db->where('section_id', $section_id );
             $delete=$this->db->delete($table);

            
             if($delete){ echo "deleted"; die();}else{ echo "Failed"; die();}

        }else{ echo "Invalid User"; die(); }

}


function deleteSecLec($id,$table){

    if($_SESSION['auth_teacher_id'] and $_SESSION['login_token'])
        {
        
        $teacher_id=$_SESSION['auth_teacher_id'];
        $cid=$_SESSION['current_course_id'];

        $this->db->select(`section_id`);
        $this->db->where('course_id', $cid );
        $this->db->where('teacher_id', $teacher_id );
        $this->db->where('id', $id );
        $this->db->from($table);
        $query = $this->db->get(); 
        $lec_data = $query->result_array();


        if($lec_data){

                $sidFolder=md5($lec_data[0]['section_id']);

                $lec_id=$lec_data[0]['lec_id'];

                $path='assets/course_data/'.$cid.'/'.$sidFolder.'/'.$lec_id;
                unlink($path.'/'.$lec_data[0]['v_link']);

                $path2='assets/course_data/'.$cid.'/'.$sidFolder.'/'.$lec_id;
                rmdir($path2);

                $this->db->where('course_id', $cid );
                $this->db->where('section_id', $lec_data[0]['section_id'] );
                $this->db->where('teacher_id', $teacher_id );
                $this->db->where('lec_id', $lec_id );
                $delete=$this->db->delete('course_content_lecture');

                if($delete){ echo "deleted"; die(); }else{ echo "Failed"; die(); }


             }else{ echo "Invalid Lecture "; die(); }

            

        }else{ echo "Invalid User"; die(); }

}




function deleteAnnounc($id){

    if($_SESSION['auth_teacher_id'] and $_SESSION['login_token'])
        {
        
        $teacher_id=$_SESSION['auth_teacher_id'];
        
        $this->db->where('id', $id );
        $this->db->where('instructor_id', $teacher_id );
        $delete=$this->db->delete('teacher_course_announce');

        if($delete){ echo "deleted"; die(); }else{ echo "Failed"; die(); }

        }else{ echo "Invalid User"; die(); }

}






function uploadCourseImage($data)
  { 
        extract($data);

        if($_SESSION['auth_teacher_id'] and $_SESSION['login_token'])
        {
            $course_id=$_SESSION['current_course_id'];

            $ext=$data['ext'];
                     
            $image_tmp=$data['image_tmp'];
            $path='assets/course_data/'.$course_id;
            // $path2=base_url().'course_data/'.$course_id.'/'.$image;


           if( $data['type'] == 1 ){ 
                $image='main.'.$ext; 
                $this->db->where('course_id', $course_id );
                $res=$this->db->update('course_data',array('course_img' => $image ));
            }
           else if( $data['type'] == 2 ){ 
                $image='cover.'.$ext; 
                $this->db->where('course_id', $course_id );
                $res=$this->db->update('course_data',array('course_bg_img' => $image ));
            }
           else if( $data['type'] == 3 ){ 
                $image='cert.'.$ext;
                $this->db->where('course_id', $course_id );
                $res=$this->db->update('course_data',array('demo_cert_img' => $image )); 
            }
                        
            if($res){
                     if(!is_dir($path)){mkdir($path,0777,TRUE);}  

                      if(move_uploaded_file($image_tmp, "$path/$image")){
                         echo  "updated"; die(); 
                      }else{ echo "failed to save"; die(); 
                  }
             }
                    
        }else{ echo 'invalid Course'; die();}
                           
         
            
 }




function addAnnounc($data)
  { 
        extract($data);

        if($_SESSION['auth_teacher_id'] and $_SESSION['login_token'])
        {


        $this->db->select(`id`);
        $this->db->where('course_id', $data['course_id'] );
        $this->db->where('instructor_id', $_SESSION['auth_teacher_id'] );
        $this->db->where('content', $data['content'] );
        $this->db->from('teacher_course_announce');
        $query = $this->db->get(); 
        $a_data = $query->num_rows();

        if(!$a_data){

                $ext=$data['ext'];

                $image_tmp=$data['image_tmp'];

                $image='post.'.$ext;

                $path='assets/course_data/'.$data['course_id'].'/announcement';

                $this->db->set([
                'instructor_id'=>$_SESSION['auth_teacher_id'],
                'course_id'=>$data['course_id'],
                'post_image'=>$image,
                'content'=>$data['content'],
                ]);
                $res=$this->db->insert('teacher_course_announce');


                if($res){
                    if(!is_dir($path)){mkdir($path,0777,TRUE);}  

                    if(move_uploaded_file($image_tmp, "$path/$image")){
                    echo  "Created"; die(); 
                    }else{ echo "failed to save"; die(); }
                }  

        }else{ echo "Duplicate Post content in this course"; die(); }    
                                              
        }else{ echo 'invalid Course'; die();}       
 }






function updateAnnounc($data)
  { 
        extract($data);

        if($_SESSION['auth_teacher_id'] and $_SESSION['login_token'])
        {

            if($data['image_tmp']){

                $image_tmp=$data['image_tmp'];
                $ext=$data['ext'];

                $image='post.'.$ext;

                $path='assets/course_data/'.$data['course_id'].'/announcement';

                $this->db->where('course_id', $data['course_id'] );
                $res=$this->db->update('teacher_course_announce',array(
                    'post_image' => $image,
                    'content' => $data['content'],
                )); 

                    if($res){
                        if(!is_dir($path)){mkdir($path,0777,TRUE);}  

                        if(move_uploaded_file($image_tmp, "$path/$image")){
                        echo  "updated"; die(); 
                        }else{ echo "failed to save"; die(); 
                        }
                    }


            }else{ 

                $this->db->where('course_id', $data['course_id'] );
                $res=$this->db->update('teacher_course_announce',array('content' => $data['content'],)); 
    
                if($res){echo  "updated"; die();} else{ echo "failed to save"; die(); }
             }

            
                    
        }else{ echo 'invalid Course'; die();}
                           
         
            
 }





function get_section_lec($cid,$table,$section_id)
  { 
       
        if($_SESSION['auth_teacher_id'] and $_SESSION['login_token'])
        {
            $teacher_id=$_SESSION['auth_teacher_id'];
            $course_id=$_SESSION['current_course_id'];

            $this->db->select(`*`);
            $this->db->from($table);
            $this->db->where('course_id', $course_id);
            $this->db->where('section_id', $section_id);
            $this->db->where('teacher_id', $teacher_id);
            $query = $this->db->get(); 
            return $query->result_array();

         }
}





function addSectionLec($data)
  { 
       
      if($_SESSION['auth_teacher_id'] and $_SESSION['login_token'])
         {

         extract($data);

         $duration=preg_replace("/[^0-9]/", "",   $data['duration']);

         // var_dump($duration); die();

        // if(is_numeric($data['duration'])){}else{ echo "Duration should be in minutes"; die();}

        if( !empty($data['lecTitle'])  and !empty($data['accessType'])  and !empty($data['fileType'])  and 
        !empty($duration) )
        {

        $teacher_id=$_SESSION['auth_teacher_id'];
        $course_id=$_SESSION['current_course_id'];

        $this->db->select(`id`);
        $this->db->from('course_content_lecture');
        $this->db->where('course_id', $course_id);
        $this->db->where('section_id', $data['section_id']);
        $this->db->where('teacher_id', $teacher_id);
        $this->db->where('lecture_name', $data['lecTitle']);
        $lecData = $this->db->get(); 

// var_dump($data['lecTitle']); die();

     if($lecData->num_rows() <= 0 )
       {

        $this->db->select('id');
        $this->db->from('course_content_lecture');
        $this->db->order_by("id ", "desc");
        $lastLecId = $this->db->get(); 
        $lastLecId=$lastLecId->result_array();

        if($lastLecId[0]['id'] > 0){ $l=$lastLecId[0]['id']+1; $lec_id='lec_'.$l;}
        else{ $l=1; $lec_id='lec_'.$l;}

        if(empty($data['image'])){

        if($data['fileType']=='youtube'){
            parse_str( parse_url( $data['link'], PHP_URL_QUERY ), $link );
            $link=$link['v'];    
        }
        else if($data['fileType']=='vimeo'){
            $link=(int) substr(parse_url($data['link'], PHP_URL_PATH), 1);
        }

if(empty($link)){ echo "Invalid Link"; die(); }

          $this->db->set(['lec_id'=>$lec_id,'course_id'=>$course_id,'section_id'=>$data['section_id'],
            'teacher_id'=>$teacher_id 
            ,'lecture_name'=>$data['lecTitle'] ,'content_type'=>$data['fileType'] ,'v_link'=>$link 
            ,'access_type'=>$data['accessType'] ,'duration'=>$duration 
            ]);
          $res=$this->db->insert('course_content_lecture');

    }else{

            if($data['fileType'] == 'video'){ $image='main.mp4'; }
            if($data['fileType'] == 'pdf'){ $image='main.pdf'; }

        $this->db->set(['lec_id'=>$lec_id,'course_id'=>$course_id,'section_id'=>$data['section_id']
            ,'teacher_id'=>$teacher_id,'lecture_name'=>$data['lecTitle'] ,'content_type'=>$data['fileType'] 
            ,'v_link'=>$image,'access_type'=>$data['accessType'] ,'duration'=>$duration 
        ]);
        $res=$this->db->insert('course_content_lecture');
    }


// var_dump($res); die();

         if($res){
              if(!empty($image)){
                    $sec_id=md5($data['section_id']);
                         $path='assets/course_data/'.$course_id.'/'.$sec_id.'/'.$lec_id;
                             if(!is_dir($path)){mkdir($path,0777,TRUE);} 
                                if(move_uploaded_file($data['image_tmp'], "$path/$image")){
                                   echo "Created"; die();
                            }else{  echo "Failed to save "; die(); }
                        }else{ echo "Created"; die(); }
            }else{ echo "Failed to save "; die(); }
          }else{ echo "This Lecture already Exist in this section"; die(); }
        }else{ echo "Please fill all Fields"; die(); }

        
    
    }else{ echo "invalid user"; die(); }

}





function updateSecLecture($data)
  { 
       
      if($_SESSION['auth_teacher_id'] and $_SESSION['login_token'])
         {

        extract($data);

        // var_dump($data); die();

    if( !empty($data['lecTitle'])  and !empty($data['accessType'])  and !empty($data['fileType'])  and 
        !empty($data['duration']) and !empty($data['duration'])   )
        {

        $teacher_id=$_SESSION['auth_teacher_id'];
        $course_id=$_SESSION['current_course_id'];

        $this->db->select(`id`);
        $this->db->from('course_content_lecture');
        $this->db->where('course_id', $course_id);
        $this->db->where('id', $data['lec_id']);
        $this->db->where('teacher_id', $teacher_id);
        $lecData = $this->db->get();

// var_dump($lecData); die();

if($lecData->num_rows() >= 1 )
       {

        $this->db->select('id');
        $this->db->from('course_content_lecture');
        $this->db->order_by("id ", "desc");
        $lastLecId = $this->db->get(); 
        $lastLecId=$lastLecId->result_array();

        if($lastLecId[0]['id'] > 0){ $l=$lastLecId[0]['id']+1; $lec_id='lec_'.$l;}
        else{ $l=1; $lec_id='lec_'.$l;}

if(empty($data['image'])){

        if($data['fileType']=='youtube'){
            parse_str( parse_url( $data['link'], PHP_URL_QUERY ), $link );
            $link=$link['v'];    
        }
        else if($data['fileType']=='vimeo'){
            $link=(int) substr(parse_url($data['link'], PHP_URL_PATH), 1);
        }

        if(empty($link)){ echo "Invalid Link"; die(); }

          $this->db->where('course_id', $course_id );
          $this->db->where('id', $data['lec_id'] );
          $this->db->where('teacher_id', $teacher_id );
          $res=$this->db->update('course_content_lecture',array(
            'lecture_name' => $data['lecTitle'],
            'content_type' => $data['fileType'],
            'v_link' => $link,
            'access_type' => $data['accessType'],
            'duration' => $data['duration'],
          )); 

    }else{

 if($data['fileType']=='video'){ $image='main.mp4'; }
 if($data['fileType']=='pdf'){ $image='main.pdf'; }

          $this->db->where('course_id', $course_id );
          $this->db->where('id', $data['lec_id'] );
          $this->db->where('teacher_id', $teacher_id );
          $res=$this->db->update('course_content_lecture',array(
            'lecture_name' => $data['lecTitle'],
            'content_type' => $data['fileType'],
            'v_link' => $image,
            'access_type' => $data['accessType'],
            'duration' => $data['duration'],
          )); 
    }



         if($res){
              if(!empty($image)){

                $this->db->select('lec_id,section_id');
                $this->db->where('course_id', $course_id);
                $this->db->where('id', $data['lec_id']);
                $this->db->where('teacher_id', $teacher_id);
                $this->db->from('course_content_lecture');
                $lec_id = $this->db->get();
                $lec_id=$lec_id->result_array();


                 $sid=$lec_id[0]['section_id'];
                 $lec_id=$lec_id[0]['lec_id'];


                    $sec_id=md5($section_id);
                    $path='assets/course_data/'.$course_id.'/'.$sec_id.'/'.$lec_id;
                    if(!is_dir($path)){mkdir($path,0777,TRUE);} 
                    if(move_uploaded_file($data['image_tmp'], "$path/$image")){

                    echo "Updated"; die();} else{  echo "Failed to save 1"; die(); }

                }else{ echo "Updated"; die(); }
              }else{ echo "Failed to save 2"; die(); }
          }else{ echo "This Lecture Not Exist in this section"; die(); }
        }else{ echo "Please fill all Fields"; die(); }

        
    
    }else{ echo "invalid user"; die(); }

}


// ======================Coupon=======

function addCoupon($data)
  { 
       
        if($_SESSION['auth_teacher_id'] and $_SESSION['login_token'])
        {
            extract($data);
            $teacher_id=$_SESSION['auth_teacher_id'];
            $course_id=$_SESSION['current_course_id'];


            $this->db->select(`id`);
            $this->db->from('course_coupon');
            $this->db->where('coupon_code', $data['couponTitle']);
            $this->db->where('course_id', $course_id);
            $this->db->where('teacher_id', $teacher_id);
            $query = $this->db->get(); 


            if($query->num_rows() <= 0 )
             {
               
                    $this->db->select(`id`);
                    $this->db->from('course_coupon');
                    $this->db->order_by("id ", "desc");
                    $query = $this->db->get(); 
                    $lastId = $query->result_array();
                    $lastId=$lastId[0]['id'];

                    $rid=rand(1,999);
                    $id='coupon_id'.$lastId+1+$rid;

                    // echo $id; die();                   

                    $this->db->set(['coupon_id'=>$id,'course_id'=>$course_id,'teacher_id'=>$teacher_id,
                        'coupon_code'=>$data['couponTitle'],'start_date'=>$data['start_date']
                        ,'exp_date'=>$data['exp_date'],'discount'=>$data['discount']   ]);
                    $res=$this->db->insert('course_coupon');

                    if($res){ echo "Created"; die(); }else{ echo "Failed to save"; die(); }
                  
            }else{ echo "Coupon Code  Already Exist"; die(); }
                        
                               
        }else{echo 'Invalid User'; die();}
         
}


function getAllCoupon()
  { 
       
     if($_SESSION['auth_teacher_id'] and $_SESSION['login_token'])
        {
            $teacher_id=$_SESSION['auth_teacher_id'];
            $course_id=$_SESSION['current_course_id'];

            $this->db->select(`*`);
            $this->db->from('course_coupon');
            $this->db->where('course_id', $course_id);
            $this->db->where('teacher_id', $teacher_id);
            $query = $this->db->get(); 
            return $query->result_array();

         }
 }




function updateCouponCode($data)
  { 
       
     if($_SESSION['auth_teacher_id'] and $_SESSION['login_token'])
        {


            $teacher_id=$_SESSION['auth_teacher_id'];
            $course_id=$_SESSION['current_course_id'];

            extract($data);

            $this->db->where('id', $data['coupon_id'] );
            $res=$this->db->update('course_coupon',array(
                'course_id' => $course_id,
                'teacher_id' => $teacher_id,
                'coupon_code' => $data['coupon_code'],
                'start_date' => $data['start_date'],
                'exp_date' => $data['exp_date'],
                'discount' => $data['discount'],
                 )); 

            if($res){ echo "Updated"; die(); }else{ echo "Failed to update"; die(); }

         }
 }




function deleteCouponCode($coupon_id,$table){

    if($_SESSION['auth_teacher_id'] and $_SESSION['login_token'])
        {
        
            $teacher_id=$_SESSION['auth_teacher_id'];
            $cid=$_SESSION['current_course_id'];

            $this->db->where('course_id', $cid );
            $this->db->where('teacher_id', $teacher_id );
            $this->db->where('id', $coupon_id );
            $delete=$this->db->delete('course_coupon');

            if($delete){ echo "deleted"; die(); }else{ echo "Failed"; die(); }
   
        }else{ echo "Invalid User"; die(); }

}








function sentCoursetoAdmin()
  { 
       
     if($_SESSION['auth_teacher_id'] and $_SESSION['login_token'])
        {

            $teacher_id=$_SESSION['auth_teacher_id'];
            $course_id=$_SESSION['current_course_id'];

            $this->db->where('course_id', $course_id);
            $this->db->where('instructor_id', $teacher_id);
            $res=$this->db->update('course_data',array( 'course_status' => 1 )); 
            
            

            if($res){ unlink($_SESSION['current_course_id']);
            redirect(base_url('/teacher-dashboard?res=publised'));  die(); }
            else{  redirect(base_url('/teacher/create_course_coupon?res=publish Failed'));  die(); }

         }
 }





function get_purchased_course()
  { 
       
     if($_SESSION['auth_teacher_id'] and $_SESSION['login_token'])
        {
            $teacher_id=$_SESSION['auth_teacher_id'];
            $course_id=$_SESSION['current_course_id'];

            $this->db->select(`*`);
            $this->db->from('course_payment');
            $this->db->where('instructor_id', $teacher_id);
            $query = $this->db->get(); 
            return $query->result_array();

         }
 }


function get_total_purchased_course_by_cid($cid)
  { 
       
            $this->db->select('id');
            $this->db->from('course_payment');
            $this->db->where('course_id', $cid);
            $query = $this->db->get(); 
            return $query->num_rows();

 }


function get_total_sum_purchased_course()
  { 
       
     if($_SESSION['auth_teacher_id'] and $_SESSION['login_token'])
        {
            $teacher_id=$_SESSION['auth_teacher_id'];
            $course_id=$_SESSION['current_course_id'];

            $this->db->select_sum('amount');
            $this->db->from('course_payment');
            $this->db->where('instructor_id', $teacher_id);
            $query = $this->db->get(); 
            return $query->result_array();

         }
 }

 function get_total_sum_publised_course()
  { 
       
     if($_SESSION['auth_teacher_id'] and $_SESSION['login_token'])
        {
            $teacher_id=$_SESSION['auth_teacher_id'];
            $course_id=$_SESSION['current_course_id'];

            $this->db->select('id');
            $this->db->from('course_data');
            $this->db->where('instructor_id', $teacher_id);
            $this->db->where('course_status',2);
            $query = $this->db->get(); 
            return $query->num_rows();

         }
 }




// ==================================End of Teacher==================

























// ===================Student===Model====



function get_student_course($sid)
        {                          
                $this->db->select(`*`);
                $this->db->from('course_payment');
                $this->db->where('student_email', $sid);
                $query = $this->db->get();
                return $query->result_array();
       }





function get_course_track($sid,$cid)
        {                          
                $this->db->select(`*`);
                $this->db->from('course_tracker');
                $this->db->where('student_id', $sid);
                $this->db->where('course_id', $cid);
                $query = $this->db->get();
                return $query->result_array();
       }




 function createNotes($data)
    { 

        if($_SESSION['auth_unboxskills_student_email'] and $_SESSION['c_course_id'])
        {
            extract($data);

            date_default_timezone_set('Asia/Kolkata');
            $reg_date =  date('d-M-Y');

            $cid=$_SESSION['c_course_id'];
            $sid=$_SESSION['auth_unboxskills_student_email'];

            $this->db->select(`id`);
            $this->db->from('student_course_note');
            $this->db->where('student_id', $sid);
            $this->db->where('course_id', $cid);
            $this->db->where('topic', $data['currentTopic']);
            $this->db->where('note', $data['MyNotes']);
            $query = $this->db->get();  


            if($query->num_rows() <= 0)
            {


                $this->db->set([ 'student_id'=>$sid     ,'course_id'=>$cid
                                ,'topic'=>$data['currentTopic'] ,'note'=>$data['MyNotes']
                                ,'create_date'=>$reg_date ]);

                $this->db->insert('student_course_note');
                $res =  $this->db->insert_id();

                // var_dump($res); die();

                if($res > 0){ return "inserted"; die(); }else{ return "Access Denied"; die(); }
            
            }else{return ' This Note of that Topic is Already exist'; die();}
           
        
        }else{ return 'invalid'; die(); }
         
            
   }




 function createRating($data)
    { 

        if($_SESSION['auth_unboxskills_student_email'] and $_SESSION['c_course_id'])
        {
            extract($data);

            date_default_timezone_set('Asia/Kolkata');
            $reg_date =  date('d-M-Y');

            $rating=$data['rating'];
            $cid=$_SESSION['c_course_id'];
            $sid=$_SESSION['auth_unboxskills_student_email'];



            $this->db->select(`id`);
            $this->db->from('course_rating_data');
            $this->db->where('student_id', $sid);
            $this->db->where('course_id', $cid);
            $query = $this->db->get();  


            if($query->num_rows() <= 0)
            {

                $this->db->set([ 'student_id'=>$sid , 'course_id'=>$cid
                                ,'rating'=>$rating ,'rate_date'=>$reg_date ]);

                $this->db->insert('course_rating_data');
                $res =  $this->db->insert_id();

                if($res > 0){ return "inserted"; die(); }else{ return "Access Denied"; die(); }
            
            }else{return 'Already Rated'; die();}
           
        
        }else{ return 'invalid'; die(); }
         
            
   }




 function courseTracking($data)
    { 

        if($_SESSION['auth_unboxskills_student_email'] and $_SESSION['c_course_id'])
        {
            extract($data);

            date_default_timezone_set('Asia/Kolkata');
            $reg_date =  date('d-M-Y');

            $sec_id=$data['sec_id'];
            $lec_id=$data['lec_id'];
            $cid=$_SESSION['c_course_id'];
            $sid=$_SESSION['auth_unboxskills_student_email'];



            $this->db->select(`id`);
            $this->db->from('course_tracker');
            $this->db->where('student_id', $sid);
            $this->db->where('course_id', $cid);
            $this->db->where('sec_id', $sec_id);
            $this->db->where('lec_id', $lec_id);
            $query = $this->db->get();  


            if($query->num_rows() <= 0)
            {

                $this->db->set([ 'student_id'=>$sid , 'course_id'=>$cid
                                ,'sec_id'=>$sec_id ,'lec_id'=>$lec_id ]);

                $this->db->insert('course_tracker');
                $res =  $this->db->insert_id();

                if($res > 0){ return "inserted"; die(); }else{ return "Access Denied"; die(); }
            
            }else{return 'Already'; die();}
           
        
        }else{ return 'invalid'; die(); }
         
            
   }


public function getTotalLecture($cid)
  { 


            $this->db->select(`id`);
            $this->db->from('course_content_lecture');
            $this->db->where('course_id', $cid);
            $query = $this->db->get();  

            return $query->num_rows(); die();
          
  }



public function CompleteLec()
  { 
            $cid=$_SESSION['c_course_id'];
            $sid=$_SESSION['auth_unboxskills_student_email'];

            $this->db->select(`id`);
            $this->db->from('course_tracker');
            $this->db->where('student_id', $sid);
            $this->db->where('course_id', $cid);
            $query = $this->db->get();  

            return $query->num_rows(); die();
  }









 function get_all_notes_course($cid,$sid)
    { 

            $this->db->select(`*`);
            $this->db->from('student_course_note');
            $this->db->where('course_id', $cid);
            $this->db->where('student_id', $sid);
            $query = $this->db->get();       

            if($query->num_rows() != 0)
            {
                return $query->result_array(); die();
            }
            else
            {
                return false; die();
            }
   }



 function ratingStatus($cid,$sid)
    { 

            $this->db->select(`id`);
            $this->db->from('course_rating_data');
            $this->db->where('course_id', $cid);
            $this->db->where('student_id', $sid);
            $query = $this->db->get();       

            return $query->num_rows(); die();
   }





 function get_all_anounce_tid($tid)
    { 

            $this->db->select(`*`);
            $this->db->from('teacher_course_announce');
            $this->db->where('instructor_id', $tid);
            $this->db->order_by("id ", "desc");
            $query = $this->db->get();       

            if($query->num_rows() != 0)
            {
                return $query->result_array(); die();
            }
            else
            {
                return false; die();
            }
    }






 function get_all_anounce($cid,$tid)
    { 

            $this->db->select(`*`);
            $this->db->from('teacher_course_announce');
            $this->db->where('course_id', $cid);
            $this->db->where('instructor_id', $tid);
            $this->db->order_by("id ", "desc");
            $query = $this->db->get();       

            if($query->num_rows() != 0)
            {
                return $query->result_array(); die();
            }
            else
            {
                return false; die();
            }
    }





 function get_course_by_tid($tid)
    { 

            $this->db->select(`*`);
            $this->db->from('course_data');
            $this->db->where('instructor_id', $tid);
            $this->db->order_by("id ", "desc");
            $query = $this->db->get();       

            if($query->num_rows() != 0)
            {
                return $query->result_array(); die();
            }
            else
            {
                return false; die();
            }
    }






// =============================Home page Models ==============================================


function verify_coupon_code($data)
      {        
                extract($data);

                $this->db->select('start_date,exp_date,discount');
                $this->db->from('course_coupon');
                $this->db->where('coupon_code',$data['couponCode']);
                $this->db->where('course_id',$data['course_id']);
                $this->db->where('teacher_id',$data['teacher_id']);
                $query = $this->db->get(); 
                return $query->result_array();
      }


function get_course_coupon($cid,$teacher_id)
      {        
                $this->db->select('discount');
                $this->db->from('course_coupon');
                $this->db->where('course_id',$cid);
                $this->db->where('teacher_id',$teacher_id);
                $query = $this->db->get(); 
                return $query->result_array();
      }


function total_Course_Download($cid)
      {        
                $this->db->select('id');
                $this->db->from('course_payment');
                $this->db->where('course_id',$cid);
                $query = $this->db->get(); 
                return $query->num_rows();
      }



 function get_course_category()
    {
           $this->db->select('*');
           $this->db->from('course_category');
           $query = $this->db->get();
           return $query->result_array();
    }


 function getSubCat($cat_id)
{
           $this->db->select('*');
           $this->db->from('sub_cat');
           $this->db->where('cat_id',$cat_id);
           $query = $this->db->get();
           $res=$query->result_array();

           // var_dump($res); die();

           if($res){

             $output='';
             foreach ($res as $key ) { 
                $sub_id=$key['sub_id'];
                $name=$key['name'];
                $output.='<option value="'.$sub_id.'">'.$name.'</option>';
             }

             return $output; die();


           }
           


}


 function get_course_data_by_cat_id($cat_id,$table,...$data)
    {
       
           foreach ($data as $key ) {
           $this->db->select($key);
            }

           $this->db->from($table);
           $this->db->where('cat_id', $cat_id);
           $query = $this->db->get();
           return $query->result_array();
    }






 function get_course_data_by_id($cid,$table,...$data)
    {
       
           foreach ($data as $key ) {
           $this->db->select($key);
            }

           $this->db->from($table);
           $this->db->where('course_id', $cid);
           $query = $this->db->get();
           return $query->result_array();
    }



 function course_purchased_status($cid,$sid)
    { 

            $this->db->select(`student_id`);
            $this->db->from('course_payment');
            $this->db->where('course_id', $cid);
            $this->db->where('student_email', $sid);
            $query = $this->db->get();       

            if($query->num_rows() != 0)
            {
                return true; die();
            }
            else
            {
                return false; die();
            }
   }






 function purchase_course($data)
    { 

        extract($data);

        if($_SESSION['auth_unboxskills_student_email'] and $_SESSION['temp_course_id'])
        {
            date_default_timezone_set('Asia/Kolkata');
            $reg_date =  date('d-M-Y');


            $this->db->set([ 'course_id'=>$data['cid'],'student_email'=>$data['sid']
                ,'instructor_id'=>$_SESSION['temp_instructor_id'],'amount'=>$data['price']
                ,'offer_amount'=>$_SESSION['temp_offer_price'],'pay_id'=>$data['pay_id'],
                'mode'=>$data['mode'],'pay_date'=>$reg_date ]);
            $this->db->insert('course_payment');

            $res =  $this->db->insert_id();


            // var_dump($res); die();
            

            if($res > 0){ return "inserted"; die(); }else{ return "failed"; die(); }
        }else{

            return 'invalid'; die();
        }
         
            
   }





 function get_popular_course()
    {
       $this->db->select(`*`);
       $this->db->order_by("flow_id", "asc");
       $this->db->from('popular_course');
       $query = $this->db->get();
       return $query->result_array();
    }



 function get_data_by_id($table,$cid)
    {

       $cid=$cid['cid'];

       $this->db->select('course_name,slug,sub_id,course_img,sub_id,total_star,total_rating,
                            total_downloads,course_price,offer_price');
       $this->db->from($table);
       $this->db->where('course_id', $cid);
       // $query = $this->db->limit(6);
       $query = $this->db->get();
       // $query = $this->db->last_query();
       return $query->result_array();
    }



 function get_data_by_slug($table,$slug)
    {

       $this->db->select(`*`);
       $this->db->from($table);
       $this->db->where('slug', $slug);
       $this->db->where('course_status', 2);
       $query = $this->db->get();       


       return $query->result_array();

    }



 function get_course_rating_count($course_id)
    {

       $this->db->select(`id`);
       $this->db->from('course_rating_data');
       $this->db->where('course_id', $course_id);
       $query = $this->db->get();       
       return $query->num_rows();
    }

 function get_course_rating_sum($course_id)
    {
       $this->db->select_sum('rating');
       $this->db->from('course_rating_data');
       $this->db->where('course_id', $course_id);
       $query = $this->db->get();       
       return $query->result_array();

    }


 function get_all_course_data($cid)
    {
            $this->db->select('*');
            $this->db->from('course_data as a'); 
            $this->db->join('course_highlight as b', 'b.course_id=a.course_id', 'left');
            $this->db->join('course_req as c', 'c.course_id=a.course_id', 'left');
            $this->db->where('a.course_id',$cid);
            // $this->db->order_by('c.track_title','asc');         
            $query = $this->db->get(); 
               
             if($query->num_rows() != 0)
                {
                    return $query->result_array();
                }
             else
                {
                    return false;
                }

    }



 function get_all_course()
    {
            $this->db->select('*');
            $this->db->from('course_data'); 
            $query = $this->db->get(); 
               
             if($query->num_rows() != 0)
                {
                    return $query->result_array();
                }
             else
                {
                    return false;
                }

    }







 function get_all_course_data2($cid,$tid)
    {
            $this->db->select('*');
            $this->db->from('course_data as a'); 
            $this->db->join('instructor as b', 'b.instructor_id=a.instructor_id', 'left');
            $this->db->where('a.course_id',$cid);
            // $this->db->order_by('c.track_title','asc');         
            $query = $this->db->get(); 
               
             if($query->num_rows() != 0)
                {
                    return $query->result_array();
                }
             else
                {
                    return false;
                }

    }





 function get_course_content($cid)
    {
               $this->db->select(`*`);
               $this->db->from('course_content');
               $this->db->where('course_id', $cid);
               $query = $this->db->get();       

             if($query->num_rows() != 0)
                {
                    return $query->result_array();
                }
             else
                {
                    return false;
                }
   }


 function get_section_lecture($course_id,$section_id)
    {
               $this->db->select(`*`);
               $this->db->from('course_content_lecture');
               $this->db->where('course_id', $course_id);
               $this->db->where('section_id', $section_id);
               $query = $this->db->get();       

             if($query->num_rows() != 0)
                {
                    return $query->result_array();
                }
             else
                {
                    return false;
                }
   }
























 function get_scrap_dir($cin)
    {
       $this->db->select(`*`);
       $this->db->from('scrap_dir');
       $this->db->where('cin', $cin);
       // $query = $this->db->limit(5);
       $query = $this->db->get();
       // $query = $this->db->last_query();

       return $query->result_array();
    }


 function get_charge_data($cin)
    {
       $this->db->select(`*`);
       $this->db->from('charges');
       $this->db->where('cin', $cin);
       // $query = $this->db->limit(5);
       $query = $this->db->get();
       // $query = $this->db->last_query();

       return $query->result_array();
    }


    // =============Get===Simillar ===Company
    
 function getSimilarCompany($id)
        {
            $this->db->select('cin,name,roc,status,class');
            $this->db->like('activity', $id);
            $this->db->limit(12);
            $query = $this->db->get('company');
            $data = $query->result_array();
            return $data;
        }

// =====================================================

 function getCompanyDirectorJoin($din)
        {
            $this->db->select('cin,date_of_joining,designation');
            $this->db->where('din', $din);
            // $this->db->limit(12);

            $query = $this->db->get('scrap_dir');
            $data = $query->result_array();
            return $data;
        }
// =================================Get==all--companies===where==cin===

         function getAllCompanyByCin($cin)
        {
            $this->db->select('cin,name');
            $this->db->like('cin', $cin);
            // $this->db->limit(12);
            $query = $this->db->get('company');
            $data = $query->result_array();
            return $data;
        }

// ======================Get==full==company==reports===
         function getFullCompOrders($user_id,$tbl,$cat)
        {
            $this->db->select('id');
            $this->db->where('user_id', $user_id);
            $this->db->where('category', $cat);
            $this->db->where('status', 'paid');
            // $this->db->limit(12);

            $query = $this->db->get($tbl);
            $data = $query->num_rows();
            return $data;
        }


// ======================Get==User wallet balance pankaj===
         function getUserWallet($user_id,$tbl)
        {
            $this->db->select('amount,amount_type');
            $this->db->where('user_id', $user_id);
            // $this->db->where('category', $cat);
            // $this->db->limit(12);

            $query = $this->db->get($tbl);
            $data = $query->result_array();
            return $data;
        }



// ======================Get==All Orders pankaj===
         function getAllOrdersCount($user_id,$tbl)
        {
            $this->db->select('id');
            $this->db->where('user_id', $user_id);
            // $this->db->where('category', $cat);
            // $this->db->limit(12);

            $query = $this->db->get($tbl);
            $data = $query->num_rows();
            return $data;
        }



// ======================Get==all Orders pankaj===
         function getAllOrders($user_id,$tbl)
        {
            $this->db->select('*');
            $this->db->where('user_id', $user_id);
            $this->db->where('status', 'paid');
            $this->db->order_by('id', "desc");

            $query = $this->db->get($tbl);

            $data = $query->result_array();
            return $data;
        }

// ======================Get==all full company report pankaj===
         function getOrderDataByCat($user_id,$tbl,$cat)
        {
            $this->db->select('*');
            $this->db->where('user_id', $user_id);
            $this->db->where('category', $cat);
            $this->db->where('status', 'paid');
            $this->db->order_by('id', "desc");
            $query = $this->db->get($tbl);
            $data = $query->result_array();
            return $data;
        }

// ======================Get==all cart item pankaj===

         function getAllCartData($user_id,$tbl,$status)
        {
            $this->db->select('*');
            $this->db->where('user_id', $user_id);
            $this->db->where('status', $status);
            $this->db->where('cart_stage',0);

            $query = $this->db->get($tbl);
            $data = $query->result_array();
            return $data;
        }

         function getCartById($user_id,$id)
        {
            $this->db->select('cost,usd_cost');
            $this->db->where('user_id', $user_id);
            $this->db->where('id', $id);

            $query = $this->db->get('orders');
            $data = $query->result_array();
            return $data;
        }


// ======================Get==all cart item pankaj===

         function getAllSaveData($user_id,$tbl,$status)
        {
            $this->db->select('*');
            $this->db->where('user_id', $user_id);
            $this->db->where('status', $status);
            $this->db->where('cart_stage',1);

            $query = $this->db->get($tbl);
            $data = $query->result_array();
            return $data;
        }







// ======================Get==all product by product name pankaj===
  function getProductByName($product_name)
        {
            $this->db->select('inr_price,usd_price');
            $this->db->where('product_name', $product_name);

            $query = $this->db->get('product');
            $data = $query->result_array();
            return $data;
        }


// ======================Get==all Purchase History items===
  function getAllPurchase($user_id)
        {
            $this->db->select('*');
            $this->db->where('status', 'paid');
            $this->db->where('user_id', $user_id);
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get('orders');
            $data= $query->result_array();
            return $data;

        }


// ======================Get== Purchase by status===
  function getPurchaseByStatus($user_id,$product_status)
        {
            $this->db->select('*');
            $this->db->where('status', 'paid');
            $this->db->where('user_id', $user_id);
            $this->db->where('product_status', $product_status);
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get('orders');
            $data= $query->result_array();
            return $data;

        }




// ======================Get== Purchase by status===
  function getUserRechargeReq($user_id)
        {
            $this->db->select('*');
            $this->db->where('user_id', $user_id);
            // $this->db->where('status', $status);
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get('user_recharge_req');
            $data= $query->result_array();
            return $data;

        }


// ===================================================================


    // ==============user_wallet data=========================
    public function getWalletData($uemail,$tbl,$cod)
    {
        if($cod=='IN')
        $this->db->select('amount');
        else
        $this->db->select('usdamount');
        $this->db->where('user_id', $uemail);
        // $this->db->where('status', $status);
        // $this->db->order_by('id', 'DESC');
        $query = $this->db->get('user_wallet');
        $data= $query->result_array();
        return $data;
    }




// ======================Get== Purchase by status===
  function getAllCountry()
        {
            $this->db->select('*');
            // $this->db->where('user_id', $user_id);
            // $this->db->where('status', $status);
            // $this->db->order_by('id', 'ASC');
            $query = $this->db->get('countries');
            $data= $query->result_array();
            return $data;

        }

// ============Total==cart==cost====user==pankaj===
        function getTotalCartInrCost($user_id)
                {
                         $this->db->select_sum('cost');
                         $this->db->where('status', 'cart');
                         $query = $this->db->get('orders');
                        $data = $query->result_array();
                        return $data;
                 }
        function getTotalCartUsdCost($user_id)
                {
                         $this->db->select_sum('usd_cost');
                         $this->db->where('status', 'cart');
                         $query = $this->db->get('orders');
                         $data = $query->result_array();
                         return $data;
                 } 


// ==========================Ticket===data=====pankaj===
             function getAllTicketbyUserid($user_id)
                {
                         $this->db->select('*');
                         $this->db->where('user_id', $user_id);
                         $query = $this->db->get('users_support');
                         $data = $query->result_array();
                         return $data;
                 }

        function getOpenTicketbyUserid($user_id)
                {
                         $this->db->select('*');
                         $this->db->where('user_id', $user_id);
                         $this->db->where('ticket_status', 0);
                        $query = $this->db->get('users_support');
                        $data = $query->result_array();
                        return $data;
                 }

        function getClosedTicketbyUserid($user_id)
                {
                         $this->db->select('*');
                         $this->db->where('user_id', $user_id);
                         $this->db->where('ticket_status', 1);
                        $query = $this->db->get('users_support');
                        $data = $query->result_array();
                        return $data;
                 }



}