<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admin_dashboard extends CI_Model
{



		// ======================Get== all Company==count===
		   function getAllCompanyCount()
		        {
		            $this->db->select('id');
		            // $this->db->where('user_id', $user_id);
		            // $this->db->where('category', $cat);
		            // $this->db->limit(12);

		            $query = $this->db->get('company');
		            $data = $query->num_rows();
		            return $data;
		        }


// ======================Get== all Company==sales===
		   function getAllCompanySalesCount()
		        {
		            $this->db->select('id');
		            // $this->db->where('user_id', $user_id);
		            $this->db->where('status', 'paid');
		            // $this->db->limit(12);

		            $query = $this->db->get('orders');
		            $data = $query->num_rows();
		            return $data;
		        }


// ======================Get== all Company==revenu inr===
		   function getInrRevenue()
		        {
  	    	        	 $this->db->select_sum('cost');
		            	 // $this->db->select('cost');
		            	 $this->db->where('status', 'paid');
			            // $this->db->limit(12);

			            $query = $this->db->get('orders');
			            $data = $query->result_array();
			            return $data;
			     }

// ======================Get== all Company==revenu Usd===
		   function getUsdRevenue()
		        {
  	    	        	 $this->db->select_sum('usd_cost');
		            	 // $this->db->select('cost');
		            	 $this->db->where('status', 'paid');
			            // $this->db->limit(12);

			            $query = $this->db->get('orders');
			            $data = $query->result_array();
			            return $data;
			     }
		        


// ======================Get== all Orders===
		   function getAllOrders()
		        {
  	    	        	  $this->db->select('id');
				            // $this->db->where('user_id', $user_id);
				            // $this->db->where('status', 'paid');
				            // $this->db->limit(12);

				            $query = $this->db->get('orders');
				            $data = $query->num_rows();
				            return $data;
			     }


// ======================Get== all Today Orders===
		   function getTodayOrders($cdate)
		        {   

		        	$this->db->select('date');
		            $query = $this->db->get('orders');
		            $data = $query->result_array();
                    $c=0;
		            foreach ($data as $key ) 
		               {
		            	$d=date("y-m-d", strtotime($key['date']));
		            	if($d == $cdate) { $c++;}
		               }
				     return $c;
			     }



// ======================Get== all Cleints counts===
		   function getClientsCount()
		        {
		         	$this->db->select('id');
		            $query = $this->db->get('users_e');
		            $data = $query->num_rows();
		            return $data;
			     }


// ======================Get== Production Employee counts===
		   function getEmpCount()
		        {
		         	$this->db->select('id');
					$this->db->where('usergroup', 'PU');
		            $query = $this->db->get('admin');
		            $data = $query->num_rows();
		            return $data;
			     }

// ===========Charges==count===

  function getChargesCount()
        {
            $this->db->select('id');
            // $this->db->where('category', 'Full Company Report');
            $query = $this->db->get(' charges');
            $data = $query->num_rows();
            return $data;
        }


// ===========Full==company===repoert==count===

  function getFullComReportCount()
        {
            $this->db->select('id');
            $this->db->where('category', 'Full Company Report');
            $query = $this->db->get('orders');
            $data = $query->num_rows();
            return $data;
        }

 // ===========Track company===report==count===
  function gettrackCount()
        {
            $this->db->select('id');
            $this->db->where('category', 'Track a Company');
            $query = $this->db->get('orders');
            $data = $query->num_rows();
            return $data;
        }



 // ===========Support Tickets ==count===
  function getTicketCounts()
        {
            $this->db->select('id');
            // $this->db->where('category', 'Track a Company');
            $query = $this->db->get('users_support');
            $data = $query->num_rows();
            return $data;
        }




 // ===========Support Tickets ==count===
  function getWalletUserCount()
        {
            $this->db->select('id');
            // $this->db->where('category', 'Track a Company');
            $query = $this->db->get('user_wallet');
            $data = $query->num_rows();
            return $data;
        }


// ================================Wallet===section=====================================
    
		    // ==========All==wallet ==user====
		         function getWalletUserData()
			        {
			            $this->db->select('*');
			            // $this->db->where('category', 'Track a Company');
			            $query = $this->db->get('user_wallet');
				        $data = $query->result_array();
			            return $data;
			        }

		 // ==========All==wallet ==user==request====
		         function getWalletUserReq()
			        {
			            $this->db->select('*');
			            // $this->db->where('category', 'Track a Company');
			            $query = $this->db->get('user_recharge_req');
				        $data = $query->result_array();
			            return $data;
			        }

	   // ==========All==Slabs==request====
		         function getCreditsvalue()
			        {
			            $this->db->select('*');
			            // $this->db->where('category', 'Track a Company');
			            $query = $this->db->get('creditsvalue');
				        $data = $query->result_array();
			            return $data;
			        }

// ====================User===data==================
			         function  getAllusers()
			        {
			            $this->db->select('*');
			            // $this->db->where('category', 'Track a Company');
			            $query = $this->db->get('users_e');
				        $data = $query->result_array();
			            return $data;
			        }


// ====================Production ===User===data==================
			         function  getProductionUsers()
			        {
			            $this->db->select('*');
			            $this->db->where('usergroup', 'PU');
			            $query = $this->db->get('admin');
				        $data = $query->result_array();
			            return $data;
			        }

			        // ============Check===email===exist===

			           function  getExistProductionUsers($email)
			        {
			            $this->db->select('*');
			            $this->db->where('usergroup', 'PU');
			            $this->db->where('email', $email);
			            $query = $this->db->get('admin');
				        $data = $query->result_array();
			            return $data;
			        }

             function  createProductionUser()
			        {
			            $this->db->select('*');
			            $this->db->where('usergroup', 'PU');
			            $query = $this->db->get('admin');
				        $data = $query->result_array();
			            return $data;
			        }





}