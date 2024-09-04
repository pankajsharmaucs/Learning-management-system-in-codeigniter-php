<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 * Controller Home
 *
 * @package   UCS
 * @category  Frontend
 * @param     ...
 * @return    ...
 *
 */


class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session','Custom','email'));
        $this->load->model('Common_model');
        if($this->session->userdata('logged_in')){
          $data['session_user']=$this->session->userdata('logged_in');
          $this->load->model('Data');
          if(!$this->Data->checkuser($data['session_user']['email'])){
             $this->logout();
           }
        }
    }

public function index()
    {
        $data['title'] = 'Online Course | UnboxSkills ';
        
        $this->load->view('lms/header', $data, false);
        $this->load->view('lms/index', $data );
        $this->load->view('lms/footer', $data, false);
   }


public function NotExist(){

       redirect(base_url());

}

public function faq()
    {
        $data['title'] = 'Kreditaid | Home';
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
            $data['Cart']=0;
            $id=$data['session_user']['id'];
            $this->load->model('Cart_model');
            if($this->Cart_model->getUserCartCount($id)){
               $data['Cart'] =$this->Cart_model->getUserCartCount($id);
           }
           $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
        $data['count']=count($data['notify']);
        }

        $this->load->view('inc/header', $data, false);
        $this->load->view('faq', $data, false);
        $this->load->view('inc/footer', $data, false);
    }

    public function home_2()
    {
        $data['title'] = 'Kreditaid | Home';
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
            $data['Cart']=0;
            $id=$data['session_user']['id'];
            $this->load->model('Cart_model');
            if($this->Cart_model->getUserCartCount($id)){
               $data['Cart'] =$this->Cart_model->getUserCartCount($id);
           }
           $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
        $data['count']=count($data['notify']);
        }

        $this->load->view('inc/header', $data, false);
        $this->load->view('home1', $data, false);
        $this->load->view('inc/footer', $data, false);
    }

public function scrapecount()
    {
                ini_set('max_execution_time', 0);
$company=$this->admin->getVal("SELECT count(id) FROM scrap_director");
 echo $company; exit;
    }
    public function about()
    {
        $data['title'] = 'Kreditaid | About';
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
            $data['Cart']=0;
            $id=$data['session_user']['id'];
            $this->load->model('Cart_model');
            if($this->Cart_model->getUserCartCount($id)){
               $data['Cart'] =$this->Cart_model->getUserCartCount($id);
           }
           $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
        $data['count']=count($data['notify']);
        }
        $this->load->view('inc/header', $data, false);
        $this->load->view('home/about', $data, false);
        $this->load->view('inc/footer', $data, false);

    }


    public function blogs()
    {
        $data['title'] = 'Kreditaid | Blogs';
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
            $data['Cart']=0;
            $id=$data['session_user']['id'];
            $this->load->model('Cart_model');
            if($this->Cart_model->getUserCartCount($id)){
               $data['Cart'] =$this->Cart_model->getUserCartCount($id);
           }
           $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
        $data['count']=count($data['notify']);
        }
        $data['get_blog']=$this->Common_model->GetData('blog');
        $this->load->view('inc/header', $data, false);
        $this->load->view('home/blogs', $data, false);
        $this->load->view('inc/footer', $data, false);

    }

    public function director($id)
    {
        $data['title'] = 'Kreditaid | Directors';
        // echo $id;
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
            $data['Cart']=0;
            $uid=$data['session_user']['id'];
            $this->load->model('Cart_model');
            if($this->Cart_model->getUserCartCount($uid)){
               $data['Cart'] =$this->Cart_model->getUserCartCount($uid);
           }
        }
        $this->load->model('Front_model');
        $data['Item'] = $this->Front_model->getDirectorById($id);
        // echo json_encode($data['Item']);
        $this->load->view('inc/header', $data, false);
        $this->load->view('home/directors', $data, false);
        $this->load->view('inc/footer', $data, false);
    }

    public function how_it_works()
    {
        $data['title'] = 'Kreditaid | How It Works';
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
            $data['Cart']=0;
            $id=$data['session_user']['id'];
            $this->load->model('Cart_model');
            if($this->Cart_model->getUserCartCount($id)){
               $data['Cart'] =$this->Cart_model->getUserCartCount($id);
           }
           $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
        $data['count']=count($data['notify']);
        }

        $this->load->view('inc/header', $data, false);
        $this->load->view('home/how_it_works', $data, false);
        $this->load->view('inc/footer', $data, false);

    }
    public function all_offerings()
    {
        $data['title'] = 'Kreditaid | All Offerings';
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
            $data['Cart']=0;
            $id=$data['session_user']['id'];
            $this->load->model('Cart_model');
            if($this->Cart_model->getUserCartCount($id)){
               $data['Cart'] =$this->Cart_model->getUserCartCount($id);
           }
           $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
        $data['count']=count($data['notify']);
        }

        $this->load->view('inc/header', $data, false);
        $this->load->view('home/all_offering', $data, false);
        $this->load->view('inc/footer', $data, false);

    }
    public function charges_search()
    {
        $data['title'] = 'Kreditaid | Charges Search';
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
            $data['Cart']=0;
            $id=$data['session_user']['id'];
            $this->load->model('Cart_model');
            if($this->Cart_model->getUserCartCount($id)){
               $data['Cart'] =$this->Cart_model->getUserCartCount($id);
           }
        }
        $this->load->view('inc/header', $data, false);
        $this->load->view('home/charges', $data, false);
        $this->load->view('inc/footer', $data, false);

    }
    public function directors()
    {
        $data['title'] = 'Kreditaid | Directors Search';
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
            $data['Cart']=0;
            $id=$data['session_user']['id'];
            $this->load->model('Cart_model');
            if($this->Cart_model->getUserCartCount($id)){
               $data['Cart'] =$this->Cart_model->getUserCartCount($id);
           }
        }
        $this->load->view('inc/header', $data, false);
        $this->load->view('home/search_directors', $data, false);
        $this->load->view('inc/footer', $data, false);

    }
   //  public function cert_and_docs()
   // {
   //     $data['title'] = 'Kreditaid | Certificate';
   //     if(@$this->session->userdata('logged_in')){
   //         $data['session_user']=$this->session->userdata('logged_in');
   //         $data['Cart']=0;
   //         $id=$data['session_user']['id'];
   //         $this->load->model('Cart_model');
   //         if($this->Cart_model->getUserCartCount($id)){
   //            $data['Cart'] =$this->Cart_model->getUserCartCount($id);
   //        }
   //        $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
   //     $data['count']=count($data['notify']);
   //     }
   //     $this->load->view('inc/header', $data, false);
   //     $this->load->view('home/cert_and_docs', $data, false);
   //     $this->load->view('inc/footer', $data, false);
   // }
   public function company_network()
   {
       $data['title'] = 'Kreditaid | Company Network';
       if(@$this->session->userdata('logged_in')){
           $data['session_user']=$this->session->userdata('logged_in');
           $data['Cart']=0;
           $id=$data['session_user']['id'];
           $this->load->model('Cart_model');
           if($this->Cart_model->getUserCartCount($id)){
              $data['Cart'] =$this->Cart_model->getUserCartCount($id);
          }
          $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
       $data['count']=count($data['notify']);
       }
       $this->load->view('inc/header', $data, false);
       $this->load->view('home/company_network', $data, false);
       $this->load->view('inc/footer', $data, false);
   }
   public function trademarks()
   {
       $data['title'] = 'Kreditaid | Trademarks';
       if(@$this->session->userdata('logged_in')){
           $data['session_user']=$this->session->userdata('logged_in');
           $data['Cart']=0;
           $id=$data['session_user']['id'];
           $this->load->model('Cart_model');
           if($this->Cart_model->getUserCartCount($id)){
              $data['Cart'] =$this->Cart_model->getUserCartCount($id);
          }
          $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
       $data['count']=count($data['notify']);
       }
       $this->load->view('inc/header', $data, false);
       $this->load->view('home/trademark', $data, false);
       $this->load->view('inc/footer', $data, false);
   }
   // public function detail_company_report()
   // {
   //     $data['title'] = 'Kreditaid | Detail Company';
   //     if(@$this->session->userdata('logged_in')){
   //         $data['session_user']=$this->session->userdata('logged_in');
   //         $data['Cart']=0;
   //         $id=$data['session_user']['id'];
   //         $this->load->model('Cart_model');
   //         if($this->Cart_model->getUserCartCount($id)){
   //            $data['Cart'] =$this->Cart_model->getUserCartCount($id);
   //        }
   //        $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
   //     $data['count']=count($data['notify']);
   //     }
   //     $this->load->view('inc/header', $data, false);
   //     $this->load->view('home/detail_company_report', $data, false);
   //     $this->load->view('inc/footer', $data, false);
   // }
   public function track_a_company()
   {
       $data['title'] = 'Kreditaid | Track a Company';
       if(@$this->session->userdata('logged_in')){
           $data['session_user']=$this->session->userdata('logged_in');
           $data['Cart']=0;
           $id=$data['session_user']['id'];
           $this->load->model('Cart_model');
           if($this->Cart_model->getUserCartCount($id)){
              $data['Cart'] =$this->Cart_model->getUserCartCount($id);
          }
          $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
       $data['count']=count($data['notify']);
       }
       $this->load->view('inc/header', $data, false);
       $this->load->view('home/track_a_company', $data, false);
       $this->load->view('inc/footer', $data, false);
   }
    public function blog($id)
    {
        $data['title'] = 'Kreditaid | Blogs ';
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
            $data['Cart']=0;
            $uid=$data['session_user']['id'];
            $this->load->model('Cart_model');
            if($this->Cart_model->getUserCartCount($uid)){
               $data['Cart'] =$this->Cart_model->getUserCartCount($uid);
           }
             $data['blog_view']=$this->Common_model->GetData('blog','',"id='".$id."'","",'','','1');
             $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$uid."' and status='0'");
          $data['count']=count($data['notify']);
        }
        $data['blog_view']=$this->Common_model->GetData('blog','',"id='".$id."'","",'','','1');
        $this->load->view('inc/header', $data, false);
        $this->load->view('home/blog_details', $data, false);
        $this->load->view('inc/footer', $data, false);

    }

    public function product_support()
        {
            $data['title'] = 'Kreditaid | Product Support';
            if(@$this->session->userdata('logged_in')){
                $data['session_user']=$this->session->userdata('logged_in');
                $data['Cart']=0;
                $id=$data['session_user']['id'];
                $this->load->model('Cart_model');
                if($this->Cart_model->getUserCartCount($id)){
                   $data['Cart'] =$this->Cart_model->getUserCartCount($id);
               }
               $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
            $data['count']=count($data['notify']);
            }
            $data['get_product']=$this->Common_model->GetData('product');
            $this->load->view('inc/header', $data, false);
            $this->load->view('home/product_support_form', $data, false);
            $this->load->view('inc/footer', $data, false);
        }
        public function offline_request()
            {
                $data['title'] = 'Kreditaid |Offline Request';
                if(@$this->session->userdata('logged_in')){
                    $data['session_user']=$this->session->userdata('logged_in');
                    $data['Cart']=0;
                    $id=$data['session_user']['id'];
                    $this->load->model('Cart_model');
                    if($this->Cart_model->getUserCartCount($id)){
                       $data['Cart'] =$this->Cart_model->getUserCartCount($id);
                   }
                   $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
                $data['count']=count($data['notify']);
                }
                $data['get_product']=$this->Common_model->GetData('product');
                $this->load->view('inc/header', $data, false);
                $this->load->view('offline_request', $data, false);
                $this->load->view('inc/footer', $data, false);
            }
    public function contact()
    {
        $data['title'] = 'Kreditaid | Contact Us';
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
            $data['Cart']=0;
            $id=$data['session_user']['id'];
            $this->load->model('Cart_model');
            if($this->Cart_model->getUserCartCount($id)){
               $data['Cart'] =$this->Cart_model->getUserCartCount($id);
           }
         $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
        $data['count']=count($data['notify']);

        }
         $data['get_contact']=$this->Common_model->GetData('contact_setting',"","");
        $this->load->view('inc/header', $data, false);
        $this->load->view('home/contact', $data, false);
        $this->load->view('inc/footer', $data, false);
    }

    public function privacy_policy()
    {
      $data['title'] = 'Kreditaid | Privacy Policy';
      if(@$this->session->userdata('logged_in')){
          $data['session_user']=$this->session->userdata('logged_in');
          $data['Cart']=0;
          $id=$data['session_user']['id'];
          $this->load->model('Cart_model');
          if($this->Cart_model->getUserCartCount($id)){
             $data['Cart'] =$this->Cart_model->getUserCartCount($id);
         }
       $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
      $data['count']=count($data['notify']);

      }
      $this->load->view('inc/header', $data, false);
      $this->load->view('home/privacy_policy', $data, false);
      $this->load->view('inc/footer', $data, false);
    }
    public function term_and_condition()
    {
      $data['title'] = 'Kreditaid | Privacy Policy';
      if(@$this->session->userdata('logged_in')){
          $data['session_user']=$this->session->userdata('logged_in');
          $data['Cart']=0;
          $id=$data['session_user']['id'];
          $this->load->model('Cart_model');
          if($this->Cart_model->getUserCartCount($id)){
             $data['Cart'] =$this->Cart_model->getUserCartCount($id);
         }
       $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
      $data['count']=count($data['notify']);

      }
      $this->load->view('inc/header', $data, false);
      $this->load->view('home/term_and_condition', $data, false);
      $this->load->view('inc/footer', $data, false);
    }

    public function login()
    {
        $data['title'] = 'Home';
        $this->load->view('inc/header', $data, false);
        $this->load->view('login', $data, false);
        $this->load->view('inc/footer', $data, false);

    }

 public function otp($id)
    {
        $data['title'] = 'Home';
        $data['user_id'] = $id;
        $this->load->view('inc/header', $data, false);
        $this->load->view('otp', $data, false);
        $this->load->view('inc/footer', $data, false);

    }

     public function captcha()
    {
      $this->load->helper('captcha');
      $vals = array(
        'word'          => 'Random word',
        'img_path'      => './captcha/',
        'img_url'       => 'http://example.com/captcha/',
        'font_path'     => './path/to/fonts/texb.ttf',
        'img_width'     => '150',
        'img_height'    => 30,
        'expiration'    => 7200,
        'word_length'   => 8,
        'font_size'     => 16,
        'img_id'        => 'Imageid',
        'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

        // White background and border, black text and red grid
        'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
        )
);

$cap = create_captcha($vals);
echo $cap['image'];

 $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'font_path'     => 'system/fonts/texb.ttf',
            'img_width'     => '160',
            'img_height'    => 50,
            'word_length'   => 8,
            'font_size'     => 18
        );
        $captcha = create_captcha($config);

        // Unset previous captcha and set new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode', $captcha['word']);

        // Pass captcha image to view
        echo $captcha['image'];
         print_r($captcha);
    }
    public function register()
    {
       $data['get_country']=$this->Common_model->GetData('countries');
        $data['title'] = 'Home';
        $this->load->view('inc/header', $data, false);
        $this->load->view('register', $data, false);
        $this->load->view('inc/footer', $data, false);

    }
    public function reset_password()
    {
        $data['title'] = 'Home';
        $this->load->view('inc/header', $data, false);
        $this->load->view('reset_password', $data, false);
        $this->load->view('inc/footer', $data, false);

    }
    public function forgot_pass()
    {
         $email = $this->input->get_post('email');
         $password=$this->input->get_post('password');
        $get_email = $this->Common_model->GetData('users','',"email='".$email."'",'','','','1');
// echo json_encode($get_email);
        if(!empty($get_email))
        {

            $pass=Utils::hash('sha1',$password, AUTH_SALT);

            $data = array(
                       'password' =>$pass,
                       'lastlogin' =>date('Y-m-d'),
                        );

            $con="id='".$get_email->id."'";
            $this->Common_model->SaveData('users',$data, $con);
            $subject="Contact Form";
            $to=$email;
            $id="2";
            $view='emails/contact_form';
            // $this->Send_mail->send($id, $to, $view, $subject, $data);
            echo "1";
        exit();
  }

    }
    // public function recent_incorporations()
    // {
    //     $data['title'] = 'Recent Incorporations';
    //     if(@$this->session->userdata('logged_in')){
    //         $data['session_user']=$this->session->userdata('logged_in');
    //         $data['Cart']=0;
    //         $id=$data['session_user']['id'];
    //         $this->load->model('Cart_model');
    //         if($this->Cart_model->getUserCartCount($id)){
    //            $data['Cart'] =$this->Cart_model->getUserCartCount($id);
    //        }
    //        $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
    //     $data['count']=count($data['notify']);
    //     }
    //     $this->load->model('Extras_model');
    //     $data['state'] = $this->Extras_model->getStates();
    //     $data['industry'] = $this->Extras_model->getIndustry();
    //     $data['class'] = $this->Extras_model->getClass();
    //     $this->load->view('inc/header', $data, false);
    //     $this->load->view('home/recent_incorporations', $data, false);
    //     $this->load->view('inc/footer', $data, false);
    //
    // }
    //
    // public function new_incorporations()
    // {
    //     $data['title'] = 'New Incorporations';
    //     if(@$this->session->userdata('logged_in')){
    //         $data['session_user']=$this->session->userdata('logged_in');
    //         $data['Cart']=0;
    //         $id=$data['session_user']['id'];
    //         $this->load->model('Cart_model');
    //         if($this->Cart_model->getUserCartCount($id)){
    //            $data['Cart'] =$this->Cart_model->getUserCartCount($id);
    //        }
    //        $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
    //     $data['count']=count($data['notify']);
    //     }
    //     $this->load->model('Extras_model');
    //     $data['state'] = $this->Extras_model->getStates();
    //     $data['industry'] = $this->Extras_model->getIndustry();
    //     $data['class'] = $this->Extras_model->getClass();
    //
    //     $this->load->view('inc/header', $data, false);
    //     $this->load->view('home/new_incorporations', $data, false);
    //     $this->load->view('inc/footer', $data, false);
    //
    // }

    public function company3($id)
    {
        $data['title'] = 'Company Info';
        $uid='';
        $this->db->select('*');
        $this->db->where('cin',$id);
        $query_company=$this->db->get('company');
        $data['row']=$query_company->row_array();
        if($data['row']['mca_status']!=='Done'){
          $api_url=base_url().'api/basic/'.$id;
          $cmd='curl  -s "'.$api_url.'" > /dev/null &';
          shell_exec($cmd);
        }

        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
            $data['Cart']=0;
            $uid=$data['session_user']['id'];
            $this->load->model('Cart_model');
            if($this->Cart_model->getUserCartCount($uid)){
               $data['Cart'] =$this->Cart_model->getUserCartCount($uid);
           }
           $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$uid."' and status='0'");
           $sql= $this->db->last_query();
           $data['count']=count($data['notify']);
        }

        $data['get_cost']=$this->Common_model->get_single('product',"product_name='Full Company Report'");
        $sql1= $this->db->last_query();
        $data['get_credit']=$this->Common_model->get_single('creditsvalue',"id='1'");
        $sql2= $this->db->last_query();
        $data['get_users']=$this->Common_model->get_single('users',"id='".$uid."'");
        $this->load->model('Front_model');
        $this->load->model('Company_model');
        $this->load->model('Api_model');
        $data['docs']=$this->Api_model->documents($id);
        $sq3= $this->db->last_query();
       // $data['charges']=$this->Api_model->charges($id);
        $sql4= $this->db->last_query();
        $data['trademarks_count']=$this->Api_model->trademarks_count($id);
        $sql5= $this->db->last_query();
        $data['Item'] = $this->Company_model->getCompanyByCin($id);
        $sql6= $this->db->last_query();

        $data['MCA_Directors']=$this->admin->getRows('SELECT * FROM `scrap_dir` WHERE cin ="'.$id.'"');
        // echo $id;
    //   $data['MCA_Directors'] = $this->Front_model->getMCA_DirectorsByCompanyId($id);
             $sql7= $this->db->last_query();
        //$data['MCA_Charges'] = $this->Front_model->getMCA_ChargesByCompanyId($id);
          //   $sql8= $this->db->last_query();
        // echo json_encode($data['MCA_Charges']);
        // exit;
    //   $data['Directors'] = $this->Front_model->getDirectorsByCompanyId($data['Item']['id']);
          $sql9= $this->db->last_query();
        $data['Similar'] = $this->Front_model->getSimilarCompany($data['Item']['activity']);
             $sql10= $this->db->last_query();
       $data['total_company']= $this->Company_model->count_company();
             $sql11= $this->db->last_query();


       // echo $sql.'bhu'.$sql1.'bhu'.$sql2.'bhu'.$sql3.'bhu'.$sql4.'bhu'.$sql5.'bhu'.$sql6.'bhu'.$sql7.'bhu'.$sql8.'bhu'.$sql9.'bhu'.$sql10.'bhu'.$sql11;
      $this->load->view('inc/header', $data, false);
        $this->load->view('new_ui/basic_info', $data, false);
      $this->load->view('inc/footer', $data, false);

    }
 public function company($id)
    {
        $data['title'] = 'Company Info';

         $data['cinid'] = $id;
        $uid='';
        // $this->db->select('*');
        // $this->db->where('cin',$id);
        // $query_company=$this->db->get('company');
        // $data['row']=$query_company->row_array();
        // if($data['row']['mca_status']!=='Done'){
        //   $api_url=base_url().'api/basic/'.$id;
        //   $cmd='curl  -s "'.$api_url.'" > /dev/null &';
        //   shell_exec($cmd);
        // }
        $this->load->model('Front_model');
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
            $data['Cart']=0;
            $uid=$data['session_user']['id'];
            $this->load->model('Cart_model');
            if($this->Cart_model->getUserCartCount($uid)){
               $data['Cart'] =$this->Cart_model->getUserCartCount($uid);
           }
           $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$uid."' and status='0'");
            $sql= $this->db->last_query();
           $data['count']=count($data['notify']);
        }
        // $data['MCA_Directors']=$this->admin->getRows('SELECT * FROM `scrap_dir` WHERE cin ="'.$id.'"');
        $data['MCA_Directors']=$this->Front_model->getDirectorById_new($id);
        // echo json_encode($data['MCA_Directors']);
        // exit;
        $data['get_cost']=$this->Common_model->get_single('product',"product_name='Full Company Report'");
         $sql1= $this->db->last_query();
        $data['get_credit']=$this->Common_model->get_single('creditsvalue',"id='1'");
         $sql2= $this->db->last_query();
        $data['get_users']=$this->Common_model->get_single('users',"id='".$uid."'");
        $this->load->model('Front_model');
        $this->load->model('Company_model');
        $this->load->model('Api_model');
      //  $data['docs']=$this->Api_model->documents($id);
         $sq3= $this->db->last_query();
     //   $data['charges']=$this->Api_model->charges($id);
         $sql4= $this->db->last_query();
    //    $data['trademarks_count']=$this->Api_model->trademarks_count($id);
         $sql5= $this->db->last_query();
         $data['Item'] = $this->Company_model->getCompanyByCin($id);
         $sql6= $this->db->last_query();


        // echo $id;
    //    $data['MCA_Directors'] = $this->Front_model->getMCA_DirectorsByCompanyId($id);
             $sql7= $this->db->last_query();
    //    $data['MCA_Charges'] = $this->Front_model->getMCA_ChargesByCompanyId($id);
             $sql8= $this->db->last_query();
        // echo json_encode($data['MCA_Charges']);
        // exit;
     //  $data['Directors'] = $this->Front_model->getDirectorsByCompanyId($data['Item']['id']);
          $sql9= $this->db->last_query();
      // $data['Similar'] = $this->Front_model->getSimilarCompany($data['Item']['activity']);
             $sql10= $this->db->last_query();
      // $data['total_company']= $this->Company_model->count_company();
             $sql11= $this->db->last_query();


   //    echo $sql.'bhu'.$sql1.'bhu'.$sql2.'bhu'.$sql3.'bhu'.$sql4.'bhu'.$sql5.'bhu'.$sql6.'bhu'.$sql7.'bhu'.$sql8.'bhu'.$sql9.'bhu'.$sql10.'bhu'.$sql11;
      $this->load->view('inc/header', $data, false);
      $this->load->view('new_ui/basic_info2', $data, false);
      $this->load->view('inc/footer', $data, false);

    }
     public function company1()
    {
      $id= $this->input->get_post('id');
      $data['getid']= $id;

      $data['title'] = 'Company Info';
        $uid='';
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
            $data['Cart']=0;
            $uid=$data['session_user']['id'];
            $this->load->model('Cart_model');
            if($this->Cart_model->getUserCartCount($uid)){
               $data['Cart'] =$this->Cart_model->getUserCartCount($uid);
           }
           $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$uid."' and status='0'");
           $data['count']=count($data['notify']);
        }
       // $URN=$this->admin->getVal("SELECT URN FROM orders WHERE items = '".$data['getid']."'  and URN != '' LIMIT 1");
        $data['get_cost']=$this->Common_model->get_single('product',"product_name='Full Company Report'");
        $data['get_users']=$this->Common_model->get_single('users',"id='".$uid."'");
        $this->load->model('Front_model');
        $this->load->model('Company_model');
        $this->load->model('Api_model');
        $data['docs']=$this->Api_model->documents($id);
        $data['charges']=$this->Api_model->charges($id);
        $data['trademarks_count']=$this->Api_model->trademarks_count($id);

        $API_PATH='http://182.71.190.194:8081/CentralWebService/ConsumeAPIData.asmx/GetCompanySummary?companyID='.$id;
        @$json = file_get_contents($API_PATH);
        $data['obj'] = @json_decode($json,true);
        $json1 = @file_get_contents('http://182.71.190.194:8081/CentralWebService//ConsumeAPIData.asmx/CheckReportAvailableInCWS?CompanyID_IncorporationNo='.$id.'&NumberOfDays=30');
        if(@$json1){
        $data['obj1'] = json_decode($json1,true);
        }
      // echo json_encode($data['trademarks']);
      // exit;

       //print_r($obj['CompanyDetails'][0]['CIN']);
       //echo $obj['CompanyDetails']['CIN']; exit;
       //$data['obj'] = @json_decode($json,true);
       // $data['title'] = $data['Item']['name'];
       //$data['Directors'] = $this->Front_model->getDirectorsByCompanyId($data['Item']['id']);
       //$data['Similar'] = $this->Front_model->getSimilarCompany($data['Item']['activity']);
       //$data['total_company']= $this->Company_model->count_company();
        $this->load->view('inc/header', $data, false);
        $this->load->view('info1', $data, false);
        $this->load->view('inc/footer', $data, false);

    }

    public function companynetwork($id){
      $this->load->model('Front_model');
      $data['Company'] = $this->Front_model->getCompanyByCin($id);
      // $data['Directors'] = $this->Front_model->getDirectorsByCompanyId($id);
      $data['Directors'] = $this->Front_model->getDirectorsByCompanyId2($id);
      $data['network'] = $this->Front_model->getNetwork($data['Company']['id']);
      $this->load->view('home/network', $data, false);
    }

    public function director_network($id){
    $director=$this->Common_model->get_single('directors',"din='".$id."'");
    $get_company=$this->Common_model->GetData('company','name,cin',"id='".$id."'");

    $data=array(
      'director'=>$director,
     'get_company'=>$get_company,
    );
      $this->load->view('home/director_network', $data, false);
    }

    public function companies11()
    {
        $data['title'] = 'Search Companies';
        $data['type'] = $this->input->get('type');
        $data['search'] = $this->input->get('q');
        $data['pagename'] = 'Company-list';
        $uid='';
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
            $data['Cart']=0;
            $uid=$data['session_user']['id'];
            $this->load->model('Cart_model');
            if($this->Cart_model->getUserCartCount($uid)){
               $data['Cart'] =$this->Cart_model->getUserCartCount($uid);
           }
        }
        $this->load->model('Front_model');
        if(($data['type'] =='CIN')||$data['type'] =='Company_name'){
          if($this->Front_model->checkCIN($data['search'])){
            redirect(base_url("company/").$data['search']);
          }
        }
        if(($data['type'] =='Director_name')||($data['type'] =='DIN')){
          if($this->Front_model->checkDIN($data['search'])){
            redirect(base_url("director/").$data['search']);
          }
        }
        $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$uid."' and status='0'");
        $data['count']=count($data['notify']);
        $this->load->model('Front_model');
        $data['Rows'] = $this->Front_model->get_num_rows('company');
        $this->load->view('inc/header', $data, false);
        $this->load->view('list', $data, false);
        $this->load->view('inc/footer', $data, false);
    }
     public function companies()
    {
        $data['title'] = 'Search Companies';
        $data['type'] = $this->input->get('type');
        $data['search'] = $this->input->get('q');
        $data['country'] = $this->input->get('country');
        $data['country1'] = $this->admin->getRows('SELECT sortname,name FROM countries');
      //   echo $data['country'];exit;
        $data['pagename'] = 'Company-list';
        if($data['country'] == 'IN' || $data['country'] == ''){
        $uid='';
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
            $data['Cart']=0;
            $uid=$data['session_user']['id'];
            $this->load->model('Cart_model');
            if($this->Cart_model->getUserCartCount($uid)){
               $data['Cart'] =$this->Cart_model->getUserCartCount($uid);
           }
        }
        $this->load->model('Front_model');
        if(($data['type'] =='CIN')||$data['type'] =='Company_name'){
          if($this->Front_model->checkCIN($data['search'])){
            redirect(base_url("company/").$data['search']);
          }
        }
        if(($data['type'] =='Director_name')||($data['type'] =='DIN')){
          if($this->Front_model->checkDIN($data['search'])){
            redirect(base_url("director/").$data['search']);
          }
        }
        $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$uid."' and status='0'");
        $data['count']=count($data['notify']);
        $this->load->model('Front_model');
    //  $data['Rows'] = $this->Front_model->get_num_rows('company');
        $this->load->view('inc/header', $data, false);
        $this->load->view('list', $data, false);
        $this->load->view('inc/footer', $data, false);
      }else{
         if($data['search'] !=''){

      $st= str_replace(" ","",$data['search']);
      $data['json'] = @file_get_contents('http://103.108.220.175/CentralWebService/ConsumeAPIData.asmx/GetCompanyNameByCountryCode?Country='.$_GET['country'].'&CompanyName='.$st);

    //$data['json'] = @file_get_contents('http://182.71.190.194:8081/CentralWebService/ConsumeAPIData.asmx/GetCompanyNameByCountryCode?Country='.$_GET['country'].'&CompanyName='.$st);
        // echo 'http://182.71.190.194:8081/CentralWebService/ConsumeAPIData.asmx/GetCompanyNameByCountryCode?Country='.$_GET['country'].'&CompanyName='.$st;
/*
$ch = curl_init();
$data = http_build_query($dataArray);
$getUrl = 'http://182.71.190.194:8081/CentralWebService/ConsumeAPIData.asmx/GetCompanyNameByCountryCode?Country='.$_GET['country'].'&CompanyName='.$st;
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_URL, $getUrl);
curl_setopt($ch, CURLOPT_TIMEOUT, 80);

$response = curl_exec($ch);

if(curl_error($ch)){
  echo 'Request Error:' . curl_error($ch);
}
else
{
  echo $response;
}
*/
curl_close($ch);
}

        $this->load->view('inc/header', $data, false);
        $this->load->view('list1', $data, false);
        $this->load->view('inc/footer', $data, false);
      }
    }
   public function companies2()
    {
        $data['title'] = 'Search Companies';
        $data['type'] = $this->input->get('type');
        $data['search'] = $this->input->get('q');
        $data['country'] = $this->input->get('country');
       $data['country1']=$this->admin->getRows('SELECT sortname,name FROM countries');
      //   echo $data['country'];exit;
        $data['pagename'] = 'Company-list';
        if($data['country'] == 'IN' || $data['country'] == ''){
        $uid='';
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
            $data['Cart']=0;
            $uid=$data['session_user']['id'];
            $this->load->model('Cart_model');
            if($this->Cart_model->getUserCartCount($uid)){
               $data['Cart'] =$this->Cart_model->getUserCartCount($uid);
           }
        }
        $this->load->model('Front_model');
        if(($data['type'] =='CIN')||$data['type'] =='Company_name'){
          if($this->Front_model->checkCIN($data['search'])){
            redirect(base_url("company/").$data['search']);
          }
        }
        if(($data['type'] =='Director_name')||($data['type'] =='DIN')){
          if($this->Front_model->checkDIN($data['search'])){
            redirect(base_url("director/").$data['search']);
          }
        }
        $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$uid."' and status='0'");
        $data['count']=count($data['notify']);
        $this->load->model('Front_model');
    //    $data['Rows'] = $this->Front_model->get_num_rows('company');
        $this->load->view('inc/header', $data, false);
        $this->load->view('list', $data, false);
        $this->load->view('inc/footer', $data, false);
      }else{
         if($data['search'] !=''){
                      // $data['countryname']=$this->admin->getVal('SELECT name FROM countries where sortname= "'.$_GET['country'].'"');
        $st= str_replace(" ","",$data['search']);
                        $data['json'] = @file_get_contents('http://182.71.190.194:8081/CentralWebService/ConsumeAPIData.asmx/GetCompanyNameByCountryCode?Country='.$_GET['country'].'&CompanyName='.$st);
         }
      //   $data['country1']=$this->admin->getRows('SELECT sortname,name FROM countries');
//echo 'http://182.71.190.194:8081/CentralWebService/ConsumeAPIData.asmx/GetCompanyNameByCountryCode?Country='.$_GET['country'].'&CompanyName='.$st;
        $this->load->view('inc/header', $data, false);
        $this->load->view('list2', $data, false);
        $this->load->view('inc/footer', $data, false);
      }
    }



    public function charges()
    {
        $data['title'] = 'Search Companies';
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
            $data['Cart']=0;
            $id=$data['session_user']['id'];
            $this->load->model('Cart_model');
            if($this->Cart_model->getUserCartCount($id)){
               $data['Cart'] =$this->Cart_model->getUserCartCount($id);
           }
           $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
        $data['count']=count($data['notify']);
        }
        $data['search'] = $this->input->post('search');
        $data['type'] = $this->input->post('type');
        $this->load->model('Front_model');
        // $data['Rows'] = $this->Front_model->get_num_rows('charges');
        $this->load->view('inc/header', $data, false);
        $this->load->view('home/charges_list', $data, false);
        $this->load->view('inc/footer', $data, false);
    }

    public function listdata($i=0)
    {
        $this->load->model('Front_model');
        $data['table'] = $this->Front_model->getCompanyList($i);
        $this->load->view('table/list', $data);
        // echo json_encode($data['table']);
    }

    public function searchFiltered()
    {

        $this->load->model('Front_model');
        $data['table'] = $this->Front_model->getCompanyFiltered();
        $this->load->view('table/list', $data);
    }


    public function searchListFiltered($i=0)
     {
        $data['search1'] = $this->input->post('search');
         $data['pageNo']=$i;
        $this->load->model('Front_model');
        $data['table'] = $this->Front_model->getCompanyListFiltered($i);
        // echo json_encode($table);
        $this->load->view('table/list', $data);
        // echo $i;
    }
    public function charges_search_Filtered($i=0)
    {
        $this->load->model('Front_model');
        $data = $this->Front_model->getcharges_search_Filtered($i);
        $this->load->view('table/charges_search_list', $data);
    }


    public function filters(){
      $this->load->model('Extras_model');
      $data = array();
      // $data['city'] = $this->Extras_model->getDistictCity();
      // $data['status'] = $this->Extras_model->getDistictStatus();
      // $data['class'] = $this->Extras_model->getClass();
      $this->load->view('components/filters',$data);
    }

    public function charges_search_filters(){
      $this->load->model('Extras_model');
      $data['city'] = $this->Extras_model->getDistictCity();
      $data['status'] = $this->Extras_model->getDistictStatus();
      $this->load->view('components/charges_search_filters',$data);
    }

    public function network($id){

      $this->load->model('Front_model');
      $data['Directors'] = $this->Front_model->getDirectorsByCompanyId($id);
      $data['network'] = $this->Front_model->getNetwork($id);
      $data['Company'] = $this->Front_model->getCompanyByid($id);
      $this->load->view('components/network',$data);
    }
    public function networkData(){
      $id=$this->input->post('id');
      $data['id']=$id;
      $data['type']=$this->input->post('type');
      $node=$this->input->post('node');
      $this->load->model('Front_model');
      if($data['type']=='director'){
        $data['Companies'] = $this->Front_model->getCompanyByDin($id);
        // $data['Director'] = $this->Front_model->getDirectorByid($id);
      }
      if($data['type']=='company'){
        $data['Directors'] = $this->Front_model->getDirectorsByCompanyId2($id);
        $data['Company'] = $this->Front_model->getCompanyByid($id);
      }
      echo json_encode($data);
    }

    public function pdf_report($id)
    {

        $data['title']='Kreditaid Report';
        $data['id']=$id;
        $this->load->model('Report_model');
        $this->load->model('Company_model');
        $data['order']=$this->Report_model->getOrderTrackingId($id);
        $data['company']=$this->Company_model->getCompanyByCin($data['order']['items']);

        // echo json_encode($data);
        $this->load->view('admin/pdf_report', $data, false);
    }


    public function print(){
      $id=$this->input->get('id');

      // $data['id']=$id;
      $this->db->select('*');
      $this->db->where('tracking_id',$id);
      $this->db->limit(1);
      $query = $this->db->get('orders');
      $data['id']=$id;
      $data['order']= $query->row_array();
      $this->load->model('Report_model');
      $data['Chart']=$this->Report_model->getChartByTrackingId($id);
      $this->load->model('Company_model');
      $data['Item'] = $this->Company_model->getCompanyByCin($data['order']['items']);
      // echo json_encode($data['order']);
      if($data['order']['category']=="Existing Report" ||  $data['order']['category']=="Full Company Report"){

        if($data['order']['country_code']!=="IN"){

          $source_url='http://182.71.190.194:8081/CentralWebService/CentralWebService/ConsumeAPIData.asmx/GetReport_International?CompanyID='.$data['order']['items'];
        }else {
          // $source_url='http://182.71.190.194:8081/CentralWebService/ConsumeAPIData.asmx/GetIndianFullReport?InroporationNo='.$data['order']['items'];
          $source_url='http://103.108.220.175/CentralWebService/ConsumeAPIData.asmx/GetIndianFullReport?InroporationNo='.$data['order']['items'];

        }


        // $source_url='https://centralwebservice.azurewebsites.net/ConsumeAPIData.asmx/GetIndianFullReport?InroporationNo=L17110MH1973PLC019786';
        // $source_url='https://centralwebservice.azurewebsites.net/ConsumeAPIData.asmx/GetReport_International?CompanyID=FR002/X/79245081900026';

        $file=@file_get_contents($source_url);
        $data['company']=json_decode($file);
        // echo $data['company']->OrgMaster[0]->CompanyName;
        // echo json_encode($data);
        // $this->load->view('report/pdf_api', $data, false);
        $this->load->model('Front_model');
        $data['MCA_Directors'] = $this->Front_model->getMCA_DirectorsByCompanytrackingid($id);
        // echo $source_url;
        $this->load->view('report/pdf_report', $data, false);
      }else {
        if($data['order']['country_code']!=="IN"){
          // $source_url='https://centralwebservice.azurewebsites.net/ConsumeAPIData.asmx/GetReport_International?CompanyID='.$data['order']['items'];
          $source_url='http://182.71.190.194:8081/CentralWebService/ConsumeAPIData.asmx/GetReport_International?CompanyID='.$data['order']['items'];
          $file=@file_get_contents($source_url);
          $data['company']=json_decode($file);
          $this->load->view('report/pdf_report', $data, false);
        }

      }
        // echo json_encode($data);
    }
    public function print_report_inter(){


      // exit;
      $id=$this->input->get('id');

      // $data['id']=$id;
      $this->db->select('*');
      $this->db->where('tracking_id',$id);
      $this->db->limit(1);
      $query = $this->db->get('orders');
      $data['id']=$id;
      $data['order']= $query->row_array();
      $this->load->model('Report_model');
      $data['Chart']=$this->Report_model->getChartByTrackingId($id);
      // echo json_encode($data['order']);
      if($data['order']['category']=="Existing Report" ||  $data['order']['category']=="Full Company Report"){

        $data['order']['country_code']="UK";
        $data['order']['items']="FR002/X/09343667";
        if($data['order']['country_code']=="IN"){
          $source_url='http://182.71.190.194:8081/CentralWebService/ConsumeAPIData.asmx/GetIndianFullReport?InroporationNo='.$data['order']['items'];

          $file=@file_get_contents($source_url);
          $data['company']=json_decode($file);

          $this->load->model('Front_model');
          $data['MCA_Directors'] = $this->Front_model->getMCA_DirectorsByCompanytrackingid($id);
          $this->load->view('report/pdf_report', $data, false);
        }else {

          $source_url='http://182.71.190.194:8081/CentralWebService/ConsumeAPIData.asmx/GetReport_International?CompanyID='.$data['order']['items'];
          $file=@file_get_contents($source_url);
          $data['company']=json_decode($file);

          $this->load->model('Front_model');
          $data['MCA_Directors'] = $this->Front_model->getMCA_DirectorsByCompanytrackingid($id);
          $this->load->view('report/pdf_report_international', $data, false);
        }


      }else {
        if($data['order']['country_code']!=="IN"){
          $source_url='http://182.71.190.194:8081/CentralWebService/ConsumeAPIData.asmx/GetReport_International?CompanyID='.$data['order']['items'];
          $file=@file_get_contents($source_url);
          $data['company']=json_decode($file);
          $this->load->view('report/pdf_report', $data, false);
        }

      }
        // echo json_encode($data);
    }
    public function test_mail()
		{

			$this->load->library('email');
			$from_email = "250-103-211-217-27.webhostbox.net";
			$fromName="kreditaid - Unified Credit Solution PVT LTD";
			//$data=array();
			//$data['id']=$id;
			$message = "TEST";


      $config = Array(
              'protocol' => 'smtp',
              'smtp_host' => 'ssl://smtp.googlemail.com',
              'smtp_port' => 465,
              'smtp_user' => 'kreditaid900@gmail.com',
              'smtp_pass' => 'Rishinhr5',
              'mailtype'  => 'html',
              'charset'   => 'utf-8'
          );

			$this->email->initialize($config);
      $this->email->set_newline("\r\n");
			$this->email->from($from_email, $fromName);
			$this->email->to("amit.jhariya93@gmail.com");
			$this->email->subject("test Mail");
			$this->email->message("TEst MSG");

			if($msg=$this->email->send()){
					 echo $msg;
				 }
				 $fp = fopen('mail.txt', 'w');
				fwrite($fp,  $this->email->print_debugger());
				fclose($fp);
				 echo $this->email->print_debugger();
		}

    public function print_report_test(){


      // exit;
      $id=$this->input->get('id');

      // $data['id']=$id;
      $this->db->select('*');
      $this->db->where('tracking_id',$id);
      $this->db->limit(1);
      $query = $this->db->get('orders');
      $data['id']=$id;
      $data['order']= $query->row_array();
      $this->load->model('Report_model');
      $data['Chart']=$this->Report_model->getChartByTrackingId($id);
      // echo json_encode($data['order']);
      if($data['order']['category']=="Existing Report" ||  $data['order']['category']=="Full Company Report"){


        if($data['order']['country_code']=="IN"){
          $source_url='http://182.71.190.194:8081/CentralWebService/ConsumeAPIData.asmx/GetIndianFullReport?InroporationNo='.$data['order']['items'];
          $file=@file_get_contents($source_url);
          $data['company']=json_decode($file);

          $this->load->model('Front_model');
          $data['MCA_Directors'] = $this->Front_model->getMCA_DirectorsByCompanytrackingid($id);
          $this->load->view('report/pdf_report_test', $data, false);
        }else {

          $source_url='http://182.71.190.194:8081/CentralWebService/ConsumeAPIData.asmx/GetReport_International?CompanyID='.$data['order']['items'];
          $file=@file_get_contents($source_url);
          $data['company']=json_decode($file);

          $this->load->model('Front_model');
          $data['MCA_Directors'] = $this->Front_model->getMCA_DirectorsByCompanytrackingid($id);
          $this->load->view('report/pdf_report_international', $data, false);
        }


      }else {
        if($data['order']['country_code']!=="IN"){
          $source_url='http://182.71.190.194:8081/CentralWebService/ConsumeAPIData.asmx/GetReport_International?CompanyID='.$data['order']['items'];
          $file=@file_get_contents($source_url);
          $data['company']=json_decode($file);
          $this->load->view('report/pdf_report_test', $data, false);
        }

      }
        // echo json_encode($data);
    }

    public function print_report(){


      // exit;
      $id=$this->input->get('id');

      // $data['id']=$id;
      $this->db->select('*');
      $this->db->where('tracking_id',$id);
      $this->db->limit(1);
      $query = $this->db->get('orders');
      $data['id']=$id;
      $data['order']= $query->row_array();
      $this->load->model('Report_model');
      $data['Chart']=$this->Report_model->getChartByTrackingId($id);
      // echo json_encode($data['order']);
      if($data['order']['category']=="Existing Report" ||  $data['order']['category']=="Full Company Report"){


        if($data['order']['country_code']=="IN"){
          $source_url='http://182.71.190.194:8081/CentralWebService/ConsumeAPIData.asmx/GetIndianFullReport?InroporationNo='.$data['order']['items'];
          $file=@file_get_contents($source_url);
          $data['company']=json_decode($file);

          $this->load->model('Front_model');
          $data['MCA_Directors'] = $this->Front_model->getMCA_DirectorsByCompanytrackingid($id);
          $this->load->view('report/pdf_report', $data, false);
        }else {

          $source_url='http://182.71.190.194:8081/CentralWebService/ConsumeAPIData.asmx/GetReport_International?CompanyID='.$data['order']['items'];
          $file=@file_get_contents($source_url);
          $data['company']=json_decode($file);

          $this->load->model('Front_model');
          $data['MCA_Directors'] = $this->Front_model->getMCA_DirectorsByCompanytrackingid($id);
          $this->load->view('report/pdf_report_international', $data, false);
        }


      }else {
        if($data['order']['country_code']!=="IN"){
          $source_url='http://182.71.190.194:8081/CentralWebService/ConsumeAPIData.asmx/GetReport_International?CompanyID='.$data['order']['items'];
          $file=@file_get_contents($source_url);
          $data['company']=json_decode($file);
          $this->load->view('report/pdf_report', $data, false);
        }

      }
        // echo json_encode($data);
    }

    // else {
    //   $data['id']=$id;
    //   $local='upload/html/'.$id.'/data.html';
    //
    //
    //     $source_url='https://biucs.com/demo/upload/xbrl/'.$id.'/data.json';
    //
    //     $file=file_get_contents($source_url);
    //     $result=json_decode($file);
    //     foreach ($result->factList as $fact) {
    //       $name = explode(':', $fact[1]->name);
    //       $name=$name[1];
    //       $value=@$fact[2]->value;
    //       $date=@$fact[2]->endInstant;
    //       $start=@$fact[2]->start;
    //       $dimensions=@$fact[2]->dimensions;
    //
    //       $data[$name]['value'][]=$value;
    //       $data[$name]['end'][]=$date;
    //       $data[$name]['start'][]=$start;
    //       $data[$name]['dimensions'][]=$dimensions;
    //     }
    //
    //     if (file_exists($local)) {
    //       $data['html']=file_get_contents($local);
    //       $this->load->view('report/pdf2', $data, false);
    //     }else{
    //       $this->load->view('report/pdf3', $data, false);
    //     }
    // }

    public function logout()
    {
    $this->session->unset_userdata('logged_in');
    $this->session->sess_destroy();
    Utils::no_cache();
    redirect(base_url());
    }


    public function mydocuments()
    {   $data = array();
        $id=$this->input->get('id');
        $this->db->select('*');
        $this->db->where('tracking_id', $id);
        $query = $this->db->get('uploads');
        if ($query->num_rows() == 1) {
            $data['files']=$query->row_array();
        }
        echo $this->load->view('User/documents', $data, true);

    }
    public function testocr($id){
      $pdf_path = array();
      $this->load->model('Ocr_model');
      $this->db->select('*');
      $this->db->where('tracking_id', $id);
      $query=$this->db->get('orders');
      $data['status']="";
      $strEnc = array();
      if ($query->num_rows()>0) {
          $data['row']=$query->row_array();
          if ($data['row']['files']) {
              $data['files']=json_decode($data['row']['files']);
              $i=0;
              foreach ($data['files'] as $files) {
                  $tmp = explode('.', $files);
                  $file_extension = end($tmp);
                  if ($file_extension=="pdf") {
                      $pdf_path[]=$files;
                  }
              }
          }
    }
    foreach ($pdf_path as $pdf) {
    $PDF[]=$this->Ocr_model->getAttachment($id,$pdf);
    }
    echo json_encode($PDF);
  }

 public function ocrjson($cin){
    $array = array();
$array1 = array();

    $finaldata=$this->admin->getRows("SELECT * FROM `shareholding` WHERE `order_id` = 197 and tbl_col IN (1,2,3) ORDER BY tbl_row ASC
");
     $i=0;
echo $finaldata[1]->linetext;
// print_r($finaldata);

    foreach ($finaldata as $finaldatai) {
      $i++;
    //$array[]=$this->Ocr_model->getAttachment($id,$pdf);
    //{ "SNo": "1", "Name": "Harry", "NoOfShare": "112", "PercentageHolding": "2","IncorporationNo":"U51909KA2011PTC060489","ContactNo":"9926527002" },

      if($finaldatai->tbl_col =1){ if($finaldatai->tbl_col =1){ $name=$finaldatai->LineText;}else{ $name=''; }}else{ $name=''; }
      if($finaldatai->tbl_col =1){if($finaldatai->tbl_col =2){ $share=$finaldatai->LineText;}else{ $share=''; }}else{ $share=''; }
      if($finaldatai->tbl_col =1){if($finaldatai->tbl_col =3){ $persent=$finaldatai->LineText;}else{ $persent=''; }}else{ $persent=''; }
     $array = array(
            'SNo' =>$i,
            'Name'=>$name,
            'ShareHolding'=>$share,
            'PercentageHolding'=>$persent,
            'IncorporationNo'=>$finaldatai->cin,
            'ContactNo'=>$finaldatai->contact
              );

 $array1 = array(
            'SNo' =>$i,
            'Name'=>$finaldatai->LineText
            );
    }


      $i =0;
   $j = 0;

    foreach ($finaldata as $queryi1)
    {
        $i++;
        $j++;

        if($j==1)
        {

        }

     if($finaldatai->tbl_col =1){ $name=$finaldatai->LineText;}
      if($finaldatai->tbl_col =2){ $share=$finaldatai->LineText;}
      if($finaldatai->tbl_col =3){ $persent=$finaldatai->LineText;}

        if($j==3 || count($finaldata)==$i)
        {

          $array = array(
            'SNo' =>$i,
            'Name'=>$name,
            'ShareHolding'=>$share,
            'PercentageHolding'=>$persent,
            'IncorporationNo'=>$finaldatai->cin,
            'ContactNo'=>$finaldatai->contact
              );

           $j=0;
        }
      }

    echo json_encode($array1);
  }

  public function testsh()
  {
      echo json_encode($_POST['json']);
  }
  public function testshdata()
  {
      $url = "https://uat.kreditaid.com/home/testsh";
      $url="http://ec2-52-66-255-58.ap-south-1.compute.amazonaws.com:8080/CentralWebService/ConsumeSHData.asmx";
      $fields = array(
        'json' => '[ { "SNo": "1", "Name": "Harry", "NoOfShare": "112", "PercentageHolding": "2","IncorporationNo":"U51909KA2011PTC060489","ContactNo":"9926527002" }, { "SNo":"1", "Name":"Abhishek", "NoOfShare":"112", "PercentageHolding":"2","IncorporationNo":"U51909KA2011PTC060489","ContactNo":"9926527002"}]',
      );
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, count($fields));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

      $result = curl_exec($ch);

      curl_close($ch);
  }
 public function ocrjsondata()
  {
      $json = @file_get_contents('https://api.ocr.space/parse/imageurl?apikey=5a64d478-9c89-43d8-88e3-c65de9999580&url=http://test.kreditaid.com/test/aocpdf/4.pdf&language=eng&isOverlayRequired=true');
 $obj = json_decode($json,true);
 $temp = count($obj['ParsedResults'][3]['TextOverlay']['Lines']);

 //print_r($obj['ParsedResults'][3]['TextOverlay']['Lines']); exit;
 $array1=array();
    for ($i=0; $i<$temp; $i++) {
  $array1[] = array(
           'LineText' =>$obj['ParsedResults'][3]['TextOverlay']['Lines'][$i]['LineText'],
          // 'MaxHeight'=>$obj['ParsedResults'][0]['TextOverlay']['Lines'][$i]['MaxHeight'],
           'MinTop'=>$obj['ParsedResults'][3]['TextOverlay']['Lines'][$i]['MinTop'],
          // 'Words'=>$obj['ParsedResults'][0]['TextOverlay']['Lines'][$i]['Words'],
           //  'cin'=>$obj['ParsedResults'][0]['TextOverlay']['Lines'][23]['LineText'],
            // 'order_id'=>1,
            );


    }
     //echo $obj['ParsedResults'][0]['Overlay']['Lines'][23]['LineText'];

      // $insert = $this->admin->insert_multi('ocrdata', $array1);

       function cmp2($a1, $b1)
{
  if ($a1["MinTop"] == $b1["MinTop"]) {
        return 0;
    }
  return ($a1["MinTop"] < $b1["MinTop"]) ? -1 : 1;
}

usort($array1,"cmp2");
print_r($array1);
  }

  public function new_home()
  {
    $data['title'] = 'Kreditaid | About';
    if(@$this->session->userdata('logged_in')){
        $data['session_user']=$this->session->userdata('logged_in');
        $data['Cart']=0;
        $id=$data['session_user']['id'];
        $this->load->model('Cart_model');
        if($this->Cart_model->getUserCartCount($id)){
           $data['Cart'] =$this->Cart_model->getUserCartCount($id);
       }
       $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
    $data['count']=count($data['notify']);
    }
    $this->load->view('inc/new_header', $data, false);
    $this->load->view('home_new12', $data, false);
    $this->load->view('inc/new_footer', $data, false);
  }
  public function new_basicinfo()
  {
    $data['title'] = 'Basic Info';
    $uid='';
    $this->db->select('*');
    $this->db->where('cin',$id);
    $query_company=$this->db->get('company');
    $data['row']=$query_company->row_array();
    if($data['row']['mca_status']!=='Done'){
      $api_url='http://uat.kreditaid.com/api/basic/'.$id;
      $cmd='curl  -s "'.$api_url.'" > /dev/null &';
      shell_exec($cmd);
    }
    if(@$this->session->userdata('logged_in')){
        $data['session_user']=$this->session->userdata('logged_in');
        $data['Cart']=0;
        $uid=$data['session_user']['id'];
        $this->load->model('Cart_model');
        if($this->Cart_model->getUserCartCount($uid)){
           $data['Cart'] =$this->Cart_model->getUserCartCount($uid);
       }
       $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$uid."' and status='0'");
       $data['count']=count($data['notify']);
    }

    $data['get_cost']=$this->Common_model->get_single('product',"product_name='Full Company Report'");
    $data['get_credit']=$this->Common_model->get_single('creditsvalue',"id='1'");
    $data['get_users']=$this->Common_model->get_single('users',"id='".$uid."'");
    $this->load->model('Front_model');
    $this->load->model('Company_model');
    $this->load->model('Api_model');
    $data['docs']=$this->Api_model->documents($id);
    $data['charges']=$this->Api_model->charges($id);
    $data['trademarks_count']=$this->Api_model->trademarks_count($id);
    $data['Item'] = $this->Company_model->getCompanyByCin($id);
    // echo $id;
    $data['MCA_Directors'] = $this->Front_model->getMCA_DirectorsByCompanyId($id);
    // echo json_encode($data['MCA_Directors']);
    // exit;
    $data['Directors'] = $this->Front_model->getDirectorsByCompanyId($data['Item']['id']);
    $data['Similar'] = $this->Front_model->getSimilarCompany($data['Item']['activity']);
    $data['total_company']= $this->Company_model->count_company();
    $this->load->view('inc/new_header', $data, false);
    $this->load->view('new_ui/basic_info', $data, false);
    $this->load->view('inc/new_footer', $data, false);
  }
  public function PAS3()
 {
   $data['title'] = 'Kreditaid | MGT7';
   if(@$this->session->userdata('logged_in')){
       $data['session_user']=$this->session->userdata('logged_in');
       $data['Cart']=0;
       $id=$data['session_user']['id'];
       $this->load->model('Cart_model');
       if($this->Cart_model->getUserCartCount($id)){
          $data['Cart'] =$this->Cart_model->getUserCartCount($id);
      }
      $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
   $data['count']=count($data['notify']);
   }
   $this->load->view('inc/header', $data, false);
   $this->load->view('new_ui/pas3', $data, false);
   $this->load->view('inc/footer', $data, false);
 }
}
