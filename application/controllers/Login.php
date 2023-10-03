<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Home page
 */
class Login extends MY_Controller
{

	public function __construct()
	{
		// $this->CI = &get_instance();
		// $this->CI->load->model('admin/Custom_model', 'custom_model');
		$this->load->model('User_model');
		$this->load->model('admin/Custom_model', 'custom_model');
		date_default_timezone_set('Asia/Kolkata');
	}

	public function index()
	{
		$data = array();
		$language = $this->uri->segments[1];
		$post_data = $this->input->post();
		// echo "<pre>";
		// print_r($post_data);
		// die;
		$uid = $this->session->userdata('uid');
		if (!empty($uid)) {
			// echo "logged_user";
			redirect();
			die;
			// print_r($uid);
			// die;
		}
		if (!empty($post_data)) {
			// echo "<pre>";
			// print_r($post_data);
			// die;
			$username = $this->input->post('cr_number');
			$password = $this->input->post('pass');
			$query = $this->User_model->validate_user($username, $password);
			// echo $this->db->last_query();
			// die;
			// echo "<pre>";
			// print_r($query);
			// die;
			if (!is_array($query) && $query == '1') {
				echo "pass";
				die;
				/*$data['message_error'] = 'pass';
				$data['un'] = $username;
				$data['pass'] = $password;
				$data['mobile_no'] = $mobile_no;
				$data['c_mobile_no'] = $c_mobile_no;
				$data['country_code'] = $country_code;
				$data['c_country_code'] = $c_country_code;*/
			} elseif (!is_array($query) && $query == '0') {
				echo "email";
				die;
				/*$data['message_error'] = 'email';
				$data['un'] = $username;
				$data['pass'] = $password;*/
			} elseif (!is_array($query) && $query == 11) {
				echo "deactivate";
				die;
			} elseif (!is_array($query) && $query == 12) {
				echo "verify_email";
				die;
			} elseif (!is_array($query) && $query == 13) {
				echo "account_terminate";
				die;
			} else {
				$this->load->library('session');
				$this->load->library('user_account');
				$content = unserialize($this->session->userdata('content'));
				if (!empty($content)) {
					$is_data = $this->custom_model->my_where('my_cart', '*', array('user_id' => $query['uid'], 'meta_key' => 'cart'));
					if (!empty($is_data[0]['content'])) {
						$card_data2 = unserialize($is_data[0]['content']);
						// code start for to check different current prodcut			
						// if found remove form cart						 			
						// $last_pid=end($content);	
						// $is_product = $this->custom_model->my_where('product','*',array('id' => $last_pid['pid']));
						// $this->session->set_userdata('country',$is_product[0]['country_name']);					 
						//  $p_country_name=$is_product[0]['country_name'];
						//  foreach ($card_data2 as $card_data2_key => $card_data2_val) 
						//  {
						//  	$is_product = $this->custom_model->my_where('product','country_name',array('id' => $card_data2_val['pid']));
						//  	if($p_country_name!=$is_product[0]['country_name'])
						// 	{
						// 	  unset($card_data2[$card_data2_key]);						  
						// 	}
						//  }
						// code end for different country
						// this for update card quanitity start	
						if (!empty($card_data2)) {
							foreach ($card_data2 as $card_data2_key => $card_data2_val) {
								if (array_key_exists($card_data2_key, $content)) {

									$sqty = $content[$card_data2_key]['qty'];
									$cqty = $card_data2_val['qty'];
									$card_data2[$card_data2_key]['qty'] = $cqty + $sqty;
								}
							}
						}
						// this for update card quanitity end

						$array_merg = array_merge($content, $card_data2);
						$content3 = serialize($array_merg);

						$update = $this->custom_model->my_update(array('content' => $content3), array('user_id' => $query['uid'], 'meta_key' => 'cart'), 'my_cart');
					} else {
						// $this->set_country($content);
						$content3 = serialize($content);
						$cart_data = array('meta_key' => 'cart', 'content' => $content3);
						$cart_data['user_id'] = $query['uid'];
						$this->custom_model->my_insert($cart_data, 'my_cart');
					}
					// echo "<pre>";
					// print_r($array_merg);										
				}
				$is_data = $this->custom_model->my_where('my_cart', '*', array('user_id' => $query['uid'], 'meta_key' => 'cart'));

				if (!empty($is_data[0]['content'])) {
					// $this->set_country(unserialize($is_data[0]['content']));

					$this->session->set_userdata('content', $is_data[0]['content']);
				}

				$compare_data = unserialize($this->session->userdata('compare'));
				$compare_data2 = array();
				$is_data = $this->custom_model->my_where('my_cart', '*', array('user_id' => $query['uid'], 'meta_key' => 'compare'));
				if (!empty($is_data)) {
					if (!empty($is_data[0]['content'])) {
						$compare_data2 = unserialize($is_data[0]['content']);
						if (!empty($compare_data)) {
							$array_merg = array_merge($compare_data, $compare_data2);
							$content3 = serialize($array_merg);
						} else {
							$content3 = serialize($compare_data2);
						}
						// echo '123';
						// print_r($content3);
						// print_r($compare_data2);
						// print_r($is_data);
						// die;
						$this->session->set_userdata('compare', $content3);
						$update = $this->custom_model->my_update(array('content' => $content3), array('user_id' => $query['uid'], 'meta_key' => 'compare'), 'my_cart');
					}
				} else {
					$compare_data = serialize($compare_data);
					$cart_data = array('meta_key' => 'compare', 'content' => $compare_data);
					$cart_data['user_id'] = $query['uid'];
					$this->custom_model->my_insert($cart_data, 'my_cart');
				}
				$front_login = false;

				if ($query['group_id'] == 10) {
					if (!empty($query['access_permission'])) {
						$access_permission_arr = explode(',', $query['access_permission']);
						if (in_array('buyer_account', $access_permission_arr)) {
							$front_login = true;
						}
					}
				} else {
					$front_login = true;
				}

				if ($front_login == true) {
					$data = array(
						'user_name' 	=> $query['first_name'],
						'uid' 			=> $query['uid'],
						'email' 		=> $query['email'],
						'phone' 		=> $query['phone'],
						'is_logged_in'	=> true,
						'username' 	=> $query['username'],
						'user_id' 			=> $query['uid'],
						'group_id' 			=> $query['group_id'],
						'type' 			=> $query['type'],
					);
				}

				if (isset($post_data['remember_me']) && $post_data['remember_me'] == 'on') {
					$this->set_remember_me($username, $password);
				} else {
					$this->set_remember_me('', '');
				}
				if ($query['type'] != 'buyer') {
					$data['username'] = $query['username'];
					$data['user_id'] = $query['uid'];
					$data['group_id'] = $query['group_id'];
					if ($query['type'] == 'subsupplier') {
						$data['identity'] = 'subsupplier';
					} else {
						$data['identity'] = 'vendor';
					}
					//this for suppler and both				
					$this->session->set_userdata($data);
					if ($query['subs_status'] == 'expired') {
						echo "expired";
						die;
					}
					echo "success1";
					die;
				} else {
					// this for user
					$this->session->set_userdata($data);
					echo "success";
					die;
				}
				// echo "<pre>";
				// print_r($data);
				// die;
			}
		}
		$postal_code_list = $this->custom_model->get_data_array("SELECT * FROM postal_code_list Order by id desc ");
		$state_list = $this->custom_model->get_data_array("SELECT * FROM state_list Order by state_name asc ");

		$city_list = $this->custom_model->get_data_array("SELECT * FROM city_list Order by city_name asc ");

		$bank_details = $this->custom_model->get_data_array("SELECT * FROM bank_details Order by bank_name asc ");

		// echo "<pre>";
		// print_r($postal_code_list);
		// print_r($state_list);
		// print_r($city_list);
		// die;
		$remember_arr = $this->get_remember_me();
		$remember_c = '';
		if (!empty($remember_arr['remember_user_name']) && !empty($remember_arr['remember_password'])) {
			$remember_c = 'checked';
		}
		$this->mViewData['remember_arr'] = $remember_arr;
		$this->mViewData['remember_c'] = $remember_c;

		$this->mViewData['postal_code_list'] = $postal_code_list;
		$this->mViewData['state_list'] = $state_list;
		$this->mViewData['city_list'] = $city_list;
		$this->mViewData['bank_details'] = $bank_details;
		$this->Urender('login', 'udefault');
	}
	/*Log out */
	function logout()
	{
		$language = $this->uri->segments[1];
		$this->session->sess_destroy();
		//$this->load->view('index');
		redirect('/');
	}

	public function forgetpassword()
	{
		$data = array();
		$language = $this->uri->segment(1);
		if (!empty($this->input->post())) {
			$username = $this->input->post('username');
			$cr_number = $this->input->post('cr_number');
			if (empty($username)) {
				echo "empty";
			} else if (empty($cr_number)) {
				echo "empty2";
			} else {
				$datas = $this->User_model->forget_password($username, $cr_number);
				// echo "<pre>";
				// print_r($datas);
				// die;
				if ($datas) {
					$name = $datas->first_name;
					// $email = $datas->username;
					$email = $datas->email;
					$link = base_url() . "en/login/resetpassword/" . en_de_crypt($datas->id) . "/" . $datas->forgotten_password_code;
					$this->load->library("email_template");
					if ($language == 'en') {
						$subject = "Reset Password";
						$message = $this->email_template->forget_pass_en($name, $link);
						// $message = forgetpass_content($name,$link);
					} else {
						$subject = "إعادة تعيين كلمة المرور";
						$message = $this->email_template->forget_pass_ar($name, $link);
					}
					$emails = $email;
					$this->load->library("email_cilib");
					$this->email_cilib->send_welcome($emails, $subject, $message);
					// $this->load->library("email_send");
					// $this->email_send->forget_pass($emails,$subject,$message);	
					// send_email($emails,$subject,$message);
					echo "success";
				} else {
					echo "notexist";
				}
			}
		}
		/*$this->Urender('forgetpassword','udefault', 'Forget Password',$data);*/
	}

	public function resetpassword($uid, $code)
	{
		$this->session->sess_destroy();
		$language = $this->uri->segments[1];
		$decrypt = en_de_crypt($uid, 'd');
		$this->mViewData['uid'] = $uid;
		$this->mViewData['code'] = $code;
		// print_r($decrypt);
		// echo "<br>";
		// print_r($response);
		// die;

		$check = $this->custom_model->my_where("admin_users", "*", array("id" =>  $decrypt));



		// $last_login = $check[0]['last_login'];
		// $date1 = new DateTime("$last_login");
		// $date2= new DateTime('now');
		// $interval=$date2->diff($date1);
		// $years =  "{$interval->y }\n"; 
		// $month = "{$interval->m }\n";
		// $day = "{$interval->d }\n";
		// $hour = "{$interval->h }\n";
		// $mins = "{$interval->i }\n";

		// print_r($day);
		// echo "<br>";
		// print_r($mins);
		// echo "<br>";


		// echo $interval->format("%Y years, %m months, %d days,  %H hours, %i minutes, %s seconds") . "\n";
		// die;



		// if ($day == 0 && $hour < 4 )
		// {
		// 	// echo "string";
		// }
		// else{
		//     // echo " asd asd"; 
		// 	redirect($language.'/login/not_found');
		// }

		// die;

		$response = $this->custom_model->my_where('admin_users', 'forgotten_password_code', array('id' => $decrypt), array(), "", "", "", "", array(), "", array(), false);
		/*print_r($response);
		die;*/
		if (!empty($response[0]['forgotten_password_code'])) {
			$data = $this->custom_model->my_where("admin_users", "*", array("id" => $decrypt), array(), "", "", "", "", array(), "", array(), false);

			$password_old =  $this->input->post('password_old', true);
			$password =  $this->input->post('password', true);
			$confirm_password =  $this->input->post('confirm_password', true);
			$hpassword = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
			if (!empty($password)) {
				// 	if (password_verify($password_old, @$data[0]['password'])) {

				$update123 = array();

				if (!empty($password) && $password == $confirm_password) {
					$update123["password"] = $hpassword;
					$update = $this->custom_model->my_update($update123, array("id" => $decrypt), "admin_users");
					if (!empty($update)) {

						$this->custom_model->my_update(array("forgotten_password_code" => ''), array("id" => $decrypt), "admin_users");
						redirect($language . '/login/success');
						//$this->session->set_flashdata('success','updated successfuly !');
						// $msgt = "success";
						// $msg = " .";
						// $data['actionmsg'] = array("msg" => $msg, "msgt" => $msgt );
					} else {
						$this->session->set_flashdata('error1', 'Something went wrong');
						/*$msgt = "error";
							$msg = "Something went wrong.";
							$data['actionmsg'] = array("msg" => $msg, "msgt" => $msgt );*/
					}
				} else {
					$this->session->set_flashdata('error1', 'New password and confirm password does not match');
					/*$msgt = "error";
						$msg = "New password and confirm password does not match.";
						$data['actionmsg'] = array("msg" => $msg, "msgt" => $msgt );*/
				}

				//  }else{
				//  	$this->session->set_flashdata('error1','Old Password is invalid');
				/*$msgt = "error";
					$msg = "Old Password is invalid.";
					$data['actionmsg'] = array("msg" => $msg, "msgt" => $msgt );*/
				//  }
			}
			$this->Urender('reset_pass', 'udefault', 'Reset Password', array('uid' => $decrypt));
		} else {
			redirect($language . '/login/not_found');
		}
	}

	public function setpass()
	{
		$language = $this->uri->segments[1];
		$username = $this->input->post();
		if (!empty($username)) {
			$password = password_hash($username['password'], PASSWORD_BCRYPT);
			$res = $this->custom_model->my_update(array('password' => $password), array('id' => $username['uid']), 'admin_users');
			if ($res) {
				$forgotten_password_code = uniqid();
				$this->custom_model->my_update(array("forgotten_password_code" => $forgotten_password_code), array('id' => $username['uid']), 'admin_users');

				$this->session->set_flashdata('reset_pass', 'Password Reset successfully !');
				redirect($language);
			}
		} else {
			redirect($language . '/login/forgetpassword');
		}
	}


	public function not_found()
	{
		$this->Urender('not_found', 'udefault');
	}
	public function success()
	{
		$this->Urender('success', 'udefault');
	}

	public function set_country($content)
	{
		$last_pid = end($content);
		$is_product = $this->custom_model->my_where('product', '*', array('id' => $last_pid['pid']));
		$this->session->set_userdata('country', $is_product[0]['country_name']);
	}

	public function email_verify($user_id = '')
	{
		$language = $this->uri->segments[1];
		if (!empty($user_id)) {
			$message = '';
			$user_id = en_de_crypt($user_id, 'd');
			$is_user = $this->custom_model->my_where('admin_users', "id,is_email_verify,type,email,phone,username,first_name", array('id' => $user_id));
			if (!empty($is_user)) {
				if ($is_user[0]['is_email_verify'] == 1) {
					$message = "Email already verified";
				} else {
					$update = $this->custom_model->my_update(array('is_email_verify' => 1), array("id" => $user_id), "admin_users");
					$message = "Email verified successfully";
					//after successful verification of email virtual account is being created @ap@
					// print_r($is_user);
					// exit();
					$this->create_virtual_account($is_user[0]['email'], $is_user[0]['phone'], $is_user[0]['username'], $is_user[0]['first_name'], $is_user[0]['id']);
					$this->load->library("email_template");
					$link_arr = array();
					// $link_arr['buyer_manual_en'] =base_url('assets/admin/user_manual/Buyer Manual - English.docx');
					// $link_arr['buyer_manual_ar'] =base_url('assets/admin/user_manual/Buyer Manual - Arabic.docx');
					$link_arr['buyer_manual_en'] = "https://docs.google.com/document/d/10yRVBJscda4nLGnsGZPKVb-5F7xzV-i-/edit";
					$link_arr['buyer_manual_ar'] = "https://docs.google.com/document/d/110WtTKKsiwxHbqxN2lyzbaIb1w_3aPSU/edit";
					if ($is_user[0]['type'] == 'buyer') {
						if ($language == 'en') {
							$email_message = $this->email_template->varified_email_en($link_arr);
							$subject = "Your account is verified successfully";
						} else {
							$email_message = $this->email_template->varified_email_ar($link_arr);
							$subject = "Your account is verified successfully";
						}
						$this->load->library("email_cilib");
						$this->email_cilib->send_welcome($is_user[0]['email'], $subject, $email_message);
					} else if ($is_user[0]['type'] == 'suppler') {
						// $link_arr['supplier_manual_en'] =base_url('assets/admin/user_manual/Supplier Manual - English.docx');
						// $link_arr['supplier_manual_ar'] =base_url('assets/admin/user_manual/Supplier Manual - Arabic.docx');
						$link_arr['supplier_manual_en'] = "https://docs.google.com/document/d/1-ZtLtSToUlLBJ4dAMEOl3zrFnxtzsTsa/edit";
						$link_arr['supplier_manual_ar'] = "https://docs.google.com/document/d/1021wgbN4qB0QwYZXvJ3mODsqcc_EcMtO/edit";
						if ($language == 'en') {
							$email_message = $this->email_template->varified_email_en($link_arr);
							$subject = "Your account is verified successfully";
						} else {
							$email_message = $this->email_template->varified_email_ar($link_arr);
							$subject = "Your account is verified successfully";
						}
						$this->load->library("email_cilib");
						$this->email_cilib->send_welcome($is_user[0]['email'], $subject, $email_message);
					}
				}
				$this->session->set_flashdata('common_message_success', $message);
				redirect($language . '/login');
			}
		} else {
			$message = "Invalid user details";
		}
		$this->mViewData['message'] = $message;
		$this->Urender('success', 'udefault');
	}

	public function test()
	{
		$name = "siddiqui";
		$link = "siddiqui";
		$message = forgetpass_content($name, $link);
		$emails = "quamer313@gmail.com";
		$subject = "Forget Password Link.";
		$this->load->library("email_send");
		$this->email_send->forget_pass($emails, $subject, $message);
		die;
		echo time();
		echo "<br>";
		echo date('d-m-Y H:i');
		echo "<br>";
		$check = $this->custom_model->my_where("admin_users", "*", array("id" => 9));
		$last_login = $check[0]['forgotten_password_time'];
		echo $last_login = date('Y-m-d h:i:s', strtotime(time()));
		echo $last_login;



		$date1 = new DateTime($last_login);
		$date2 = new DateTime('now');
		$interval = $date2->diff($date1);
		$years =  "{$interval->y}\n";
		$month = "{$interval->m}\n";
		$day = "{$interval->d}\n";
		$hour = "{$interval->h}\n";
		$mins = "{$interval->i}\n";
		echo "<br>day";
		echo $day . '<br>';
		echo "hours";
		echo $hour . '<br>';
		echo "mins";
		echo $mins . '<br>';
	}

	public function create_virtual_account($email, $phone, $cr_number, $first_name, $user_id)
	// public function create_virtual_account()
	{

		// $email = "itsmesayan0678@gmail.com";
		// $phone =  "09038529604";
		// $cr_number = "200008";
		// $first_name = "sayan066";
		// echo $email;
		// exit();
		$data_create_va = array(
			"RemitterDetails" => array(
				"email" => $email,
				"invoiceNotify" => "N",
				"mobile" => $phone,
				"notifLang" => "0",
				"remitterId" => $cr_number,
				"remitterName" => $first_name,
				"operationCode" => "CREATE",
				"maximumAmnt" => "98888866"
			)
		);

		$outputArray = array(
			"RemitterDetails" => array(
				$data_create_va["RemitterDetails"]
			)
		);

		$outputJSON = json_encode($outputArray, JSON_PRETTY_PRINT);


		// echo "<pre>";
		// print_r($outputJSON);
		// exit();

		/**================For Signature+++++++++++++++++++++ */
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://34.29.193.63:3000/token-genrate-remiters",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => $outputJSON,
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Accept: application/json'
			),
		));

		$response = curl_exec($curl);
		$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);

		$signature = json_decode($response);

		$last = stripslashes($signature->signature);
		$check_value_response = $last;
		// print_r($check_value_response);
		// exit();
		$postData = [];
		$postDataNew = [];

		$postData["Header"] =
			array(
				"clientId" => "0125095263",
				"MsgReference" => $cr_number . 'Va',
				"schemeId" => "VA0125095263",
			);
		$postDataNew['RemitterDetails'][0] = array(
			"email" => $email,
			"invoiceNotify" => "N",
			"mobile" => $phone,
			"notifLang" => "0",
			"remitterId" => $cr_number,
			"remitterName" => $first_name,
			"operationCode" => "CREATE",
			"maximumAmnt" => "98888866"
		);
		$postData["Data"] =  $postDataNew;

		$postData["Signature"] = $check_value_response;


		//TEST==============
		$url = 'https://dpwu.alrajhibank.com.sa:443/VARESTService/RestAPI/VaCreation';
		$headers = array(
			'Content-Type: application/json'
		);

		$data_json = json_encode($postData);
		// print_r($data_json);
		// exit();

		$certPath = '/var/www/html/Port10/_port10_sa.pfx';
		$certPassword = 'a@admin123';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'P12');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt($ch, CURLOPT_SSLCERT, $certPath);
		curl_setopt($ch, CURLOPT_SSLCERTPASSWD, $certPassword);




		$response = curl_exec($ch);

		if (curl_errno($ch)) {
			echo 'Error: ' . curl_error($ch);
		}

		curl_close($ch);


		if ($httpcode == 200) {
			$response = json_decode($response, true);
			// print_r($post_data['ShippingDateTime']);


			$this->load->library("email_template");
			$this->load->library("email_cilib");
			// $emails=$email;
			// $message=$this->email_template->create_virtual_account_email($first_name,"sjkldhf","jsdhf","khsdg");
			// $subject="Welcome virtual account";			
			// $this->email_cilib->send_virtual_account_email($emails,$subject,$message);
			// exit();


			$datum = array("user_id" => $user_id, "remitter_id" => $response['Data']['RemitterDetails'][0]['remitterId'], "bban" => $response['Data']['RemitterDetails'][0]['bban'], "viban" => $response['Data']['RemitterDetails'][0]['iban'], "max_amount" => $response['Data']['RemitterDetails'][0]['maximumAmnt'], "is_active" => 1);

			$this->custom_model->my_insert($datum, 'account_details');

			$emails = $email;
			$message = $this->email_template->create_virtual_account_email($first_name, $response['Data']['RemitterDetails'][0]['iban'], $response['Data']['RemitterDetails'][0]['remitterId'], $response['Data']['RemitterDetails'][0]['bban'], $response['Data']['RemitterDetails'][0]['maximumAmnt']);
			$subject = "Welcome virtual account";
			$this->email_cilib->send_virtual_account_email($emails, $subject, $message);



			// $this->CI->custom_model->my_insert(array("user_id" => 1, "remitter_id" => $response['Data']['RemitterDetails'][0]['remitterId'], "viban" => $response['Data']['RemitterDetails'][0]['iban'], "max_amount" => $response['Data']['RemitterDetails'][0]['maximumAmnt']), 'account_details');
		} else {
			// $this->session->set_flashdata('System Error', $message);
			$language = 'en';
			redirect($language . '/');
		}
	}
	public function payment()
	// public function create_virtual_account()
	{
		$postData = [];
		$postDataNew = [];

		$postData["paymentMultiBlockHeader"] =
			array(
				"SenderID" => "0125095263",
				"Receiver" => "ARB",
				"schemeId" => "VA0125095263",
				"MsgReference" => "VABULK123",
				"MsgType" => "BKPAYMTREQ",
				"MsgDateTime" => "VA0125095263",
				"MsgRetryNo" => "0125095263",
				"ServiceType" => $cr_number.'Va',
				"SenderTimeStamp" => "VA0125095263",
			);
		// $postDataNew['RemitterDetails'][0] = array(
		// 	"email" => $email,
		// 	"invoiceNotify" => "N",
		// 	"mobile" => $phone,
		// 	"notifLang" => "0",
		// 	"remitterId" => $cr_number,
		// 	"remitterName" => $first_name,
		// 	"operationCode" => "CREATE",
		// 	"maximumAmnt" => "98888866"
		// );
		// $postData["Data"] =  $postDataNew;

		// $postData["Signature"] = $check_value_response;


		//TEST==============

		$postData = '{
			"paymentMultiBlockHeader": {
			  "SenderID": "0125095263",
			  "Receiver": "ARB",
			  "schemeId": "VA0125095263",
			  "MsgReference": "VABULK123",
			  "MsgType": "BKPAYMTREQ",
			  "MsgDateTime": "2023-09-28T17:36:35",
			  "MsgRetryNo": "0",
			  "ServiceType": "VAPAYMT",
			  "SenderTimeStamp": "2023-09-28T17:36:35",
			  
			},
			"paymentMultiBlockBody": {
			  "clientId": "0125095263",
			  "schemeId": "VA0125095263",
			  "NumberOfTransactions": "1",
			  "ControlSum": "100.00",
			  "FileReference": "GB2OK238",
			  "Initiation": [
				{
				  "InstructionIdentification": "ANSM023",
				  "RequestedExecutionDateTime": "25-01-2022",
				  "PaymentRemarks": "Remarks1",
				  "LocalInstrument": "ACCOUNTTYPE",
				  "InstructedAmount": {
					"Amount": "100.00",
					"Currency": "SAR"
				  },
				  "DebtorAccount": {
					"Identification": "SA0380900000011995192017",
					"Name": "Admin"
				  },
				  "CreditorAccount": {
					"Identification": "SA8780900000015995192018",
					"Name": "Kaari"
				  },
				  "CreditorAgent ": {
					"Identification": "ARB",
					"Name": "Al Rajhi Bank"
				  }
				}
			  ]
			},
			"SignatureValue": {
			  "Signature": "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"
			}
		  }';

		  $dataArray = json_decode($postData, true);
		  if ($dataArray === null) {
			echo 'JSON Error: ' . json_last_error_msg();
		} else {
			// Successfully decoded JSON
			print_r($dataArray);
		}
		exit();
		// $url = 'https://dpwu.alrajhibank.com.sa:443/VARESTService/VABulkPayment/file-payment';
		// $headers = array(
		// 	'Content-Type: application/zip'
		// );

		// $data_json = json_encode($postData);
		// // print_r($data_json);
		// // exit();

		// $certPath = '/var/www/html/Port10/_port10_sa.pfx';
		// $certPassword = 'a@admin123';

		// $ch = curl_init();
		// curl_setopt($ch, CURLOPT_URL, $url);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($ch, CURLOPT_POST, true);
		// curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
		// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		// curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'P12');	
		// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		// curl_setopt($ch, CURLOPT_SSLCERT, $certPath);
		// curl_setopt($ch, CURLOPT_SSLCERTPASSWD, $certPassword);




		// $response = curl_exec($ch);

		// if (curl_errno($ch)) {
		// 	echo 'Error: ' . curl_error($ch);
		// }

		// curl_close($ch);
		// Compress the JSON data

		$compressedData = gzencode($postData);

		$url = 'https://dpwu.alrajhibank.com.sa:443/VARESTService/VABulkPayment/file-payment';
		$headers = array(
			'Content-Type: application/zip',
			'Content-Encoding: gzip' // Indicate gzip compression
		);

		$certPath = '/var/www/html/Port10/_port10_sa.pfx';
		$certPassword = 'a@admin123';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $compressedData);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'P12');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSLCERT, $certPath);
		curl_setopt($ch, CURLOPT_SSLCERTPASSWD, $certPassword);

		$response = curl_exec($ch);

		if (curl_errno($ch)) {
			echo 'Error: ' . curl_error($ch);
		}

		curl_close($ch);

		print_r($response);
		exit();
	}
}
