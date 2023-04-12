<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Register page
*/

class Register extends MY_Controller
{

 	public function index()
 	{
 		$uid = $this->session->userdata('uid');

		if (!empty($uid))
		{
			redirect();
		}

 		$this->load->model('admin/Custom_model','custom_model');
 		$language = $this->uri->segments[1];
 		$post_data = $this->input->post();
            $created_on = date("Y/m/d h:i:s");


 		if ( !empty($post_data) )
 		{

                  if(!empty($post_data['type']) && !empty($post_data['entity_name']) && !empty($post_data['cr_number']) && !empty($post_data['city']) && !empty($post_data['state'])  && !empty($post_data['phone']) && !empty($post_data['email']) && !empty($post_data['vat_number']) && !empty($post_data['bank_name']) && !empty($post_data['iban']) && !empty($post_data['password']) && !empty($post_data['first_name']) )
                  {


                        $new_member_insert_data=array();

                        $entity_name = trim($post_data['entity_name']);
                        $first_name = trim($post_data['first_name']);
                        $type = trim($post_data['type']);
                        $cr_number = trim($post_data['cr_number']);
                        $street_name = trim($post_data['street_name']);
                        $building_no = trim($post_data['building_no']);
                        $city = trim($post_data['city']);
                        $state = trim($post_data['state']);
                        $postal_code = trim($post_data['postal_code']);
                        $country = trim($post_data['country']);
                        $phone = trim($post_data['phone']);
                        $email = trim($post_data['email']);
                        $vat_number = trim($post_data['vat_number']);
                        $bank_name = trim($post_data['bank_name']);
                        $iban = trim($post_data['iban']);
                        $password = $post_data['password'];

                        if(is_numeric($cr_number)==False)
                        {
                              echo 'invalid_crnumber'; die;
                        }
                        // echo "<pre>";
                        // print_r($post_data);
                        // print_r($new_member_insert_data);
                        // die;
                        if(!empty($entity_name)) $new_member_insert_data['entity_name']  = $entity_name;
                        if(!empty($first_name)) $new_member_insert_data['first_name']  = $first_name;

                        if(!empty($type)) $new_member_insert_data['type']  = $type;

                        if(!empty($cr_number)) $new_member_insert_data['username']  = $cr_number;

                        if(!empty($street_name)) $new_member_insert_data['street_name']  = $street_name;

                        if(!empty($building_no)) $new_member_insert_data['building_no']  = $building_no;

                        if(!empty($city)) $new_member_insert_data['city']  = $city;

                        if(!empty($state)) $new_member_insert_data['state']  = $state;

                        if(!empty($postal_code)) $new_member_insert_data['postal_code']  = $postal_code;

                        if(!empty($country)) $new_member_insert_data['country']  ="Saudi Arabia";

                        if(!empty($phone)) $new_member_insert_data['phone']  = $phone;

                        if(!empty($email)) $new_member_insert_data['email']  = $email;

                        if(!empty($vat_number)) $new_member_insert_data['vat_number']  = $vat_number;

                        if(!empty($bank_name)) $new_member_insert_data['bank_name']  = $bank_name;

                        if(!empty($iban)) $new_member_insert_data['iban']  = $iban;

                        if(!empty($password)) $new_member_insert_data['password']  = password_hash($password, PASSWORD_BCRYPT);

                        if(!empty($new_member_insert_data))
                        {
                              if($type!='buyer')
                              {
                                    // comment this code becaus client said set all seller expire date to 2022-12-31
                                    // $footer_content=$this->custom_model->my_where("footer_content","default_period",array('id' => '1'));
                                    // if(!empty($footer_content))
                                    // {
                                    //     $default_period='+'.$footer_content[0]['default_period'];
                                    // }else{
                                    //     $default_period='+1 month';
                                    // }
                                    $new_member_insert_data['group_id']=5;
                                    $subs_start_date=date("Y-m-d");
                                    // $subs_end_date = date("Y-m-d", strtotime($subs_start_date.$default_period));
                                    $subs_end_date='2022-12-31';
                                     $new_member_insert_data['subs_start_date']=$subs_start_date;
                                     $new_member_insert_data['subs_end_date']=$subs_end_date;
                                     $new_member_insert_data['subs_status']='trial';
                              }
                              $new_member_insert_data['created_on']=$created_on;
                              $new_member_insert_data['social']='normal';
                              $new_member_insert_data['source']='web';
                              $new_member_insert_data['active']=1;
                              $new_member_insert_data['is_email_verify']=0;
                              $new_member_insert_data['newsletter']=1;
                              $new_member_insert_data['logo']='user_chat.png';
                              // $new_member_insert_data['username']=$email;
                              $new_member_insert_data['ip_address']=$this->return_ip_address();

            			$this->load->model('User_model');
                              // echo "<pre>";
                              // print_r($post_data);
                              // print_r($new_member_insert_data);
                              // die;
            			$query = $this->User_model->create_member($new_member_insert_data);

            			if($query == 'username')
            			{
            				echo('cr_number');
            			}
            			elseif ($query == 'phone')
            			{
            				echo('phone');
            			}elseif ($query == 'email')
                              {
                                    echo('email');
                                    // echo('cr_number');
                              }
            			else
            			{
            			   $data = array(
            					'user_name' => $first_name,
            					'reg_phone' => $phone,
            					'uid' => $query,
            					'email' => $email,
            					'is_logged_in' => true
            				);

                                    if($type!='buyer')
                                    {
                                          $data['username']=$cr_number;
                                          $data['user_id']=$query;
                                          $data['group_id']=5;
                                          $data['identity']='vendor';
                                          $gorup_data['user_id']=$query;
                                          $gorup_data['group_id']=5;
            		                $this->custom_model->my_insert($gorup_data,'admin_users_groups');
                                    }

                                    if(isset($post_data['remember_me']) && $post_data['remember_me']=='on')
                                    {
                                          $this->set_remember_me($cr_number,$password);
                                    }else{
                                          $this->set_remember_me('','');
                                    }

            			   // $this->session->set_userdata($data);
            			   $content = unserialize($this->session->userdata('content'));

                  			if (!empty($content))
                   			{
                  				$content=serialize($content);

                  				$cart_data= array('meta_key' => 'cart', 'content' =>$content);
                  				$cart_data['user_id'] = $data['uid'];
                  				$this->custom_model->my_insert($cart_data,'my_cart');
                  			}
                                    // echo 	$this->input->post('reg_first_name');
                                    // echo $this->input->post('email');
                                    // die;
                                    // $uniqid=uniqid();
                                    $link = base_url().$language."/login/email_verify/".en_de_crypt($query);
                                    $this->load->library("email_template");
                                    if($language=='en')
                                    {
                                          $message=$this->email_template->wecom_email_en($first_name,$link);
                                          // $message =registration_content($first_name,$link);
                                          $subject="Welcome!";
                                    }else{
                                          $message=$this->email_template->wecom_email_ar($first_name,$link);
                                          $subject="مرحبا!";
                                    }
                                    $emails=$email;
                                    $this->load->library("email_cilib");
                                    $this->email_cilib->send_welcome($emails,$subject,$message);
                                    if($type!='buyer')
                                    {
                                          //this for suppler
                  				echo "success1";
                                    }else{
                                          echo "success";
                                    }
            			}
                        }
                  }
                  $this->virtual_account($post_data);
 		}
 		else
 		{
                  $remember_arr=$this->get_remember_me();
                  $remember_c='';
                  if(!empty($remember_arr['remember_user_name']) && !empty($remember_arr['remember_password']) )
                  {
                        $remember_c='checked';
                  }
                  $this->mViewData['remember_arr'] =$remember_arr;
                  $this->mViewData['remember_c'] =$remember_c;

                  $postal_code_list = $this->custom_model->get_data_array("SELECT * FROM postal_code_list Order by id desc ");
                  $state_list = $this->custom_model->get_data_array("SELECT * FROM state_list Order by state_name asc ");

                  $city_list = $this->custom_model->get_data_array("SELECT * FROM city_list Order by city_name asc ");

                  $bank_details = $this->custom_model->get_data_array("SELECT * FROM bank_details Order by bank_name asc ");

                  $this->mViewData['postal_code_list'] =$postal_code_list;
                  $this->mViewData['state_list'] =$state_list;
                  $this->mViewData['city_list'] =$city_list;
                  $this->mViewData['bank_details'] =$bank_details;

 			// $this->Urender('register', 'udefault');
                  $this->Urender('login', 'udefault');
 		}

 	}

      public function virtual_account($post_data){

            $url = "https://dpwt.alrajhibank.com.sa:19443/VARESTService/RestAPI/VaCreation";
            $post = json_encode([
                  "RemitterDetails" => [ json_encode([
                        "email" => trim($post_data['email']),
                        "invoiceNotify" => "E",
                        "mobile" =>trim($post_data['phone']),
                        "notifLang" => "en",
                        "remitterId" => "2399239",
                        "remitterName" => trim($post_data['first_name']),
                        "operationCode" => "CREATE",
                        "maximumAmnt" => "98888867"
                  ]) ]

              ]);

              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, $url);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt($ch, CURLOPT_POST, 1);
              curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

              $headers = array();
              $headers[] = "clientId : 125011989";
              $headers[] = "msgReference : VirtualAccount";
              $headers[] = "msgReference : VA0125095263";

              curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
              $result = curl_exec($ch);
              $jsnDCod = json_decode( $result);
              curl_close($ch);

      }
}
?>
