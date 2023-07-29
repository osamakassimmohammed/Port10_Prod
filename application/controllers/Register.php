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
                              // $this->create_virtual_account($email,$phone,$cr_number,$first_name);
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
                  // $this->virtual_account($post_data);
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


      // public function create_virtual_account($email,$phone,$cr_number,$first_name) {

      //       // echo $$email.'<br>'.$phone.'<br>'.$cr_number.'<br>'.$first_name;
      //       $certPassword = 'a@dmin123';
      //       $certFile = '/home/sayan/Desktop/WIS/projects/beyond_tech/port10_git/Port10/certificate.pfx';
      //       // $certPassword = 'password'; // Password for the PKCS12 certificate
      //       $data_create_va = json_encode([
      //             "RemitterDetails" => array(
      //             "email" => $email,
      //             "invoiceNotify" => "E",
      //             "mobile" => $phone,
      //             "notifLang" => 0,
      //             "remitterId" => $cr_number,
      //             "remitterName" => $first_name,
      //             "operationCode" => "CREATE",
      //             "maximumAmnt" => "98887867"
      //       )
      //       ]);

           
      //       /**================For Signature+++++++++++++++++++++ */
      //       $curl = curl_init();
      //       curl_setopt_array($curl, array(
      //       CURLOPT_URL => "https://dpwu.alrajhibank.com.sa:443/VARESTService/RestAPI/VaCreation",
      //       CURLOPT_RETURNTRANSFER => true,
      //       CURLOPT_ENCODING => '',
      //       CURLOPT_MAXREDIRS => 10,
      //       CURLOPT_TIMEOUT => 0,
      //       CURLOPT_FOLLOWLOCATION => true,
      //       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      //       CURLOPT_CUSTOMREQUEST => 'POST',
      //       CURLOPT_POSTFIELDS =>$data_create_va,
      //       CURLOPT_HTTPHEADER => array(
      //             'Content-Type: application/json',
      //             'Accept: application/json'
      //       ),
      //       ));

      //       $response = curl_exec($curl);
      //       $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      //       curl_close($curl);





      //       $check_value_response = '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';
      //       $postData = [];
      //       $postDataNew = [];

      //       $postData["Header"] = 
      //       array(
      //             "clientId" => "0125095263",
      //             "msgReference" => "25Tjara05",
      //             "schemeId" => "VA0125095263",
      //       );
      //       $postDataNew['RemitterDetails'][0] = array(
      //             "email" => $email,
      //             "invoiceNotify" => "E",
      //             "mobile" => $phone,
      //             "notifLang" => 0,
      //             "remitterId" => $cr_number,
      //             "remitterName" => $first_name,
      //             "operationCode" => "CREATE",
      //             "maximumAmnt" => "98887867"
      //       ) ;
      //       $postData["Data"] =  $postDataNew;

      //       $postData["Signature"] = $check_value_response;
      //       $requestData = (json_encode($postData));
      //       // print_r($postData);
      //       // print_r($requestData);
      //       /**================For Bank+++++++++++++++++++++ */
      //       $curl = curl_init();
      //       curl_setopt_array($curl, array(
      //       CURLOPT_URL => "https://dpwu.alrajhibank.com.sa:443/VARESTService/RestAPI/VaCreation",
      //       CURLOPT_RETURNTRANSFER => true,
      //       CURLOPT_ENCODING => '',
      //       CURLOPT_MAXREDIRS => 10,
      //       CURLOPT_TIMEOUT => 0,
      //       CURLOPT_FOLLOWLOCATION => true,
      //       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      //       CURLOPT_CUSTOMREQUEST => 'POST',
      //       CURLOPT_POSTFIELDS => $requestData,
      //       CURLOPT_HTTPHEADER => array(
      //             'Content-Type: application/json',
      //             'Accept: application/json'
      //       ),
      //       CURLOPT_SSLCERT => '/var/www/html/Port10/dev_port10_sa.pfx',
      //       CURLOPT_SSLCERTPASSWD => 'a@admin',
      //       ));

      //       $response = curl_exec($curl);
      //       $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      //       curl_close($curl);
           
            
      // }

}
?>