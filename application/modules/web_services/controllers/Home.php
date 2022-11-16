<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller {

	public function __construct()
	{
		$this->load->model('default_model');
		$this->load->model('admin/custom_model');
		$this->load->library("Jwt_client");
		$this->load->model('admin/User_model');
	    $this->token_id = "s56by73212343289fdsfitdsdne";
	}

    public function sign_up()
	{
   	    $Jwt_client = new Jwt_client();
		$json = file_get_contents('php://input');

		// $json  = '{"email":"girishbhumkar5@gmail.com" , "password":"123123","first_name": "Girish Bhumkar","mobile":"8149169115", "source":"ios"}';

		$jsonobj 		= json_decode($json);
		$first_name 	= @$jsonobj->first_name;
		$email 			= @$jsonobj->email;
		$username 		= $email;
		$mobile 		=  @$jsonobj->mobile;
		$password 		= @$jsonobj->password;
		$password_show 	= @$jsonobj->password;
		$source 		= @$jsonobj->source;
		$social 		= @$jsonobj->social;
        $social 		= empty($social)? 'normal':$social;
		$group_id 		= @$jsonobj->group_id;
        $group_id 		= empty($group_id)? 9:$group_id;
        $type 			= @$jsonobj->type;      
        $type 			= empty($type)? 'user':$type;
        $invite_code 	= @$jsonobj->invite_code;

        $language 		= @$jsonobj->language;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'sign_up':$ws;
		$user_id 		= $this->validate_token($language , $ws);

		date_default_timezone_set('Asia/Kolkata');
        $created_on = date("Y/m/d h:i:s");

        if (!empty($mobile))
		{
			$this->load->model('User_model');
			$additional_data = $response = array();
			if(!empty($country_code)) $additional_data['country_code'] = $country_code;
			if(!empty($first_name)) $additional_data['first_name'] 	= $first_name;
			if(!empty($mobile)) $additional_data['phone'] 			= $mobile;
			if(!empty($email)) $additional_data['username'] 		= $email;
			if(!empty($email)) $additional_data['email'] 			= $email;
	        if(!empty($source)) $additional_data['source'] 			= $source;
	        if(!empty($social)) $additional_data['social'] 			= $social;
	        if(!empty($created_on)) $additional_data['created_on']  = $created_on;
	        if(!empty($type)) $additional_data['type'] 			    = $type;
    		if(!empty($password_show)) $additional_data['password_show']= $password_show;

    		if(!empty($invite_code)) $additional_data['invite_code']= $invite_code;
    		if(!empty($language)) $additional_data['language'] 		= $language;
			if(!empty($password)) $additional_data['password'] 		= password_hash($password, PASSWORD_BCRYPT);
			$additional_data['active'] 								= 1;
	        $additional_data['group_id'] 							= $group_id;

	        // echo "<PRE>";
	        // print_r($additional_data);
	        // die;

			$query = $this->User_model->create_member($additional_data);
			
			if($query == 'email')
			{
				echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'البريد الالكتروني موجود بالفعل':'Email already exists') ) );die;
			}
			elseif($query == 'phone')
			{
				echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'رقم الهاتف موجود بالفعل':'Phone number already exists') ) );die;
			}
			elseif($query == 'invite_code')
			{
				echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'رمز الدعوة غير صالح':'Invitation code is invalid') ) );die;
			}			
			else
			{				
				// echo "<pre>";
				// print_r($ref_user); die;
				$user1 = $this->custom_model->my_where('admin_users','id,email,phone,first_name',array('phone' => $mobile),array(),"","","","", array(), "",array(),false );

				if (!empty($user1))
				{
					$myStr = $user1['0']['first_name'];
					$result = substr($myStr, 0, 4);
					$generate_ref = lcfirst($result).$user1['0']['id'];
					$this->custom_model->my_update(['own_refere_id' => $generate_ref], ['id' => $user1['0']['id']], 'admin_users');
				}

				if (!empty($invite_code)) 
				{
					$ref_user = $this->custom_model->my_where('admin_users','*',array('own_refere_id' => $invite_code));
				}
				
				if (!empty($ref_user))
				{
					$count = $ref_user[0]['refer_count'];
					if ($count)
					{
						$total_c = $count + 1 ;
					}
					else
					{
						$total_c = 1 ;	
					}
					$this->custom_model->my_update(['refer_count' => $total_c], ['own_refere_id' => $invite_code], 'admin_users');
					$from_id = $ref_user[0]['id'];
					$to_id   = $user1['0']['id'];
					date_default_timezone_set('Asia/Kolkata');
					$date  = date("Y/m/d h:i:s");
					//$this->custom_model->my_insert(['from_id' => $from_id ,'to_id' => $to_id,'date' => $date ],'referal');
				}


				$token = $Jwt_client->encode( array( "password" => $password,"id" => $user1[0]['id'] ) );

				$this->custom_model->my_update(['token' => $token], ['id' => $user1['0']['id']], 'admin_users');

				$user = $this->custom_model->my_where('admin_users','id,email,phone,first_name,token',array('phone' => $mobile),array(),"","","","", array(), "",array(),false );
				$uid= $user1['0']['id'];
				
				// Mail send using library
				$this->load->library('send_mail');
				$this->send_mail->send_register_succ_msg($uid);

				echo json_encode( array("status" => true, "ws" => $ws , "data" => $user[0] ,"message" => ($language == 'ar'? 'تم إنشاء الحساب بنجاح':'Account Created Successfully') ) );die;
			}
		}
		else
		{
			echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'الطلب غير ساري المفعول':'Invalid request') ) );die;
		}
	} 

	public function login()
	{
   	    $Jwt_client = new Jwt_client();
		$json 		= file_get_contents('php://input');

		// $json 		= '{"email":"girishbhumkar5@gmail.com","password":"123123" , "language":"en","source":"android"}';

		$jsonobj 	= json_decode($json);

		$password 	= @$jsonobj->password;
		$email 		= @$jsonobj->email;
		$type 		= @$jsonobj->type;
		$source 	= @$jsonobj->source;
		$language 	= @$jsonobj->language;
		$language 	= empty($language)? 'en':$language;
		$source 	= empty($source)? 'ios':$source;
		$ws 		= empty($ws)? 'login':$ws;
		$type 		= empty($type)? 'user':$type;

		$user_id = $this->validate_token($language , $ws);

		if (empty($email) || empty($password)) {
			echo json_encode(array("status" => false, "ws" => $ws, "message" => ($language == 'ar'? 'كل الحقول مطلوبة.':'All fields are required.') ));
			die;
		}

		$logged_in = $this->ion_auth->user_login($email, $password,$type, FALSE);

		// result
		if ($logged_in == 'error')
		{
			echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'يرجى الانتظار حتى يقوم المشرف في وقت ما بتنشيط حسابك قريبًا':'Please wait while the administrator will soon activate your account') ) );die;
		}
		elseif ($logged_in == 'error1') {
            echo json_encode(array("status" => false,"message" => ('you cant login as a '.$type.'') ));
		}
		elseif ($logged_in == 'password')
		{
			echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'الرجاء إدخال كلمة المرور الصحيحة':'Please enter correct password') ) );die;
		}
		else if ($logged_in)
		{
			$user = $logged_in;
			$user_id = $user[0]->id;
			$token = $Jwt_client->encode( array( "password" => $password,"id" => $user_id ) );
			$this->custom_model->my_update(array("language" => $language,"source" =>$source , "token"=> $token ),array("id" => $user_id),"admin_users");
			$u_details = $this->custom_model->get_data("SELECT id,first_name,email,phone,token,logo FROM admin_users WHERE id = $user_id  ORDER BY 'id' DESC");
            $u_details[0]->logo = $this->get_profile_path($u_details[0]->logo);
            echo json_encode( array("status" => true, "ws" => $ws ,"data" => $u_details[0] ,"message" => ($language == 'ar'? 'تسجيل الدخول بنجاح':'Login Successfully') ) );die;
		}
		else
		{
			echo json_encode(array("status" => false,"ws"=> $ws ,"message" => ($language == 'ar'? 'يرجى إدخال البريد الإلكتروني الصحيح':'Please enter correct email') ));
		}
		die;
	}

	public function forget_password()
	{
		$json = file_get_contents('php://input');
		
		// $json 		= '{"string":"girishbhumkar5@gmail.com"}';
		
		$jsonobj 	= json_decode($json);
		$string 	= @$jsonobj->string;
		$language 	= @$jsonobj->language;
		$language 	= empty($language)? 'en':$language;
		$ws 		= empty($ws)? 'forget_password':$ws;

		$user_id = $this->validate_token($language , $ws);		

   	 	if (empty($string)) {
   	 		echo json_encode( array("status" => false, "ws"=>$ws ,"message" => ($language == 'ar'? 'يرجى إدخال عنوان البريد الإلكتروني':'Please enter an email address .')) );die;
   	 	}
   	 	else
   	 	{
			$this->load->model('User_model');
   	 		$datas = $this->User_model->forget_password($string);
			if($datas)
			{
			    $this->load->model('User_model');
   	 		    $datas = $this->User_model->forget_password($string);   	 			
   	 			// echo "<pre>";
   	 			// print_r($datas);die;
			    if (@$datas->social == 'facebook' || @$datas->social =='gmail')
			    {
			    	echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'لا يمكنك تغيير كلمة المرور لأنك تسجيل الدخول من خلال الاجتماعية':'You cannot change the password because you are logged in with social media.') ) );die;
			    }

				$name = $datas->first_name;
				$email = $datas->email;
				$link = base_url()."Login/resetpassword/".en_de_crypt($datas->id)."/".$datas->forgotten_password_code;
				$message = forgetpass_content($name,$link,$datas->email);
				$emails = $email;
				$subject = "ADZ password reset.";

				// send_email_using_sendinblue($emails,$subject,$message);
				        	                
				// echo "<pre>";
				// print_r($message);
				// die;

				echo json_encode( array("status" => true, "ws" => $ws ,"message" => ($language == 'ar'? 'يرجى التحقق من بريدك الإلكتروني لإعادة تعيين كلمة المرور.':'Please check your email to reset your password.') ) );die;
   	 		}
   	 		else{
   	 			echo json_encode( array("status" => false , "ws" => $ws ,"message" => ($language == 'ar'? 'البريد الإلكتروني غير موجود الرجاء إدخال بريد إلكتروني صالح':'Email does not exist. Please enter a valid email. ')) );die;
   	 		}

   	 	}
		echo json_encode( array("status" => false  , "ws" => $ws ,"message" => ($language == 'ar'? 'حدث خطأ نرجوا المشرف اتصال':'Something went wrong, please contact your administrator')) );die;
   	}

    
    public function profile_info()
	{
		$json = file_get_contents('php://input');
		// $user_id = 2;
		// $json 		= '{"first_name":"Girish","email":"girishbhumkar5@gmail.com","phone":"8149169115132", "language":"en"}';
		
		$jsonobj 		= json_decode($json);
		$first_name 	= @$jsonobj->first_name;
		$logo 			= @$jsonobj->logo;
		$email 			= @$jsonobj->email;
		$phone 			= @$jsonobj->phone;
		$address		= @$jsonobj->address;
		$language 		= @$jsonobj->language;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'profile_info':$ws;
		$user_id = $this->validate_token($language , $ws);

   	 	if (!empty($user_id))
   	 	{
			$user_check = $this->custom_model->my_where("admin_users","id",array("id =" => $user_id),array(),"","","","", array(), "",array(),false  );
			if (empty($user_check))
			{
				echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'المستخدم غير موجود':'The user does not exist') ) );die;
			}

			$phone_check = $this->custom_model->my_where("admin_users","id",array("phone" => $phone, "id !=" => $user_id),array(),"","","","", array(), "",array(),false  );

			if (!empty($phone_check))
			{
				echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'رقم الهاتف موجود بالفعل':'Phone number already exists') ) );die;
			}

			$email_check = $this->custom_model->my_where("admin_users","id",array("email" => $email,"id !=" => $user_id),array(),"","","","", array(), "",array(),false  );
			
			if (!empty($email_check))
			{
				echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'البريد الإلكتروني موجود بالفعل':'Email already exists') ) );die;
			}

			$additional_data = $response = array();
			if(!empty($logo)) $additional_data['logo'] 						= $logo;
			if(!empty($first_name)) $additional_data['first_name'] 			= $first_name;
			if(!empty($phone)) $additional_data['phone'] 					= $phone;
			if(!empty($email)) $additional_data['username'] 				= $email;
			if(!empty($email)) $additional_data['email'] 					= $email;
	        if(!empty($address)) $additional_data['address'] 				= $address;

	        $result = $this->custom_model->my_update($additional_data,array("id" => $user_id),"admin_users");		
			$data = $this->custom_model->my_where("admin_users","id,email,logo,phone,first_name",array("id" => $user_id),array(),"","","","", array(), "",array(),false  );
			$data[0]['logo'] = $this->get_profile_path($data[0]['logo']);

			echo json_encode( array("status" => true, "ws" => $ws,"data" => $data[0] ,"message" => ($language == 'ar'? 'الملف الشخصي تحديث بنجاح':'Profile updated successfully') ) );die;
   	 	}
		else
		{
			echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'الطلب غير ساري المفعول':'Invalid request') ) );die;
		}
   	}

   	public function change_pass()
	{
		$json = file_get_contents('php://input');
		// $json 		= '{"password":"123456","old_password":"123123"}';
		// $user_id 	= 2;
		$jsonobj 	= json_decode($json);
		$user_id 			= @$user_id;
		$password 			= @$jsonobj->password;
		$current_password 	= @$jsonobj->old_password;

		$language 			= @$jsonobj->language;
		$language 			= empty($language)? 'en':$language;
		$ws 				= empty($ws)? 'change_pass':$ws;

		$user_id = $this->validate_token($language , $ws);

   	 	if (empty($user_id)) {
   	 		echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'الطلب غير ساري المفعول':'Invalid request') ) );die;
   	 	}

		if (empty($password) && strlen($password) < 6 )
		{
			echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'الرجاء إدخال كلمة المرور على الأقل 6 أحرف':'Please enter password atleast 6 character') ) );die;
		}

		$logged_in = $this->custom_model->my_where('admin_users','password',array('id'=>$user_id),array(),"","","","", array(), "",array(),false );
	    
	    // echo "<pre>";
	    // print_r($logged_in);
	    // die;

    	if (!empty($logged_in))
	 	{ 		
	 		if(password_verify ( $current_password ,$logged_in[0]['password'] ))
			{
				$password_show	=	$password;
				$password =password_hash($password, PASSWORD_BCRYPT);
				$this->custom_model->my_update(array("password" => $password,"password_show" => $password_show),array("id" => $user_id),"admin_users" );
				echo json_encode( array("status" => true, "ws" => $ws ,"message" => ($language == 'ar'? 'تم تغيير كلمة المرور بنجاح':'Password changed successfully') ) );die;
			}
			else
			{
				echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'الرجاء إدخال كلمة المرور الحالية صالحة':'Please enter valid current password') ) );die;
			}
	 	}else
	 	{
	 		echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'المستخدم غير موجود':'The user does not exist') ) );die;
	 	}	 	
   	}

	public function get_pages()
	{
		$json = file_get_contents('php://input');
		// $json 		= '{"slug":"about","language":"en"}';
		// $json 		= '{"slug":"about","language":"ar"}';
		// $json 		= '{"slug":"terms-conditions","language":"en"}';
		// $json 		= '{"slug":"privacy-policy","language":"en"}';
		// $json 		= '{"slug":"faq","language":"en"}';

		$jsonobj 	= json_decode($json);
		$slug 		= @$jsonobj->slug;
		$language 	= @$jsonobj->language;
		$language 	= empty($language)? 'en':$language;
		$ws 		= @$jsonobj->ws;
		$ws 		= empty($ws)? 'get_pages':$ws;
		
		$user_id = $this->validate_token($language,$ws);

   	 	$response = array();
 		$data = $this->custom_model->my_where("pages","*",array("status" => 'active' ,'slug' => $slug) );

 		if($language != "en"){
 			$datat = $this->custom_model->my_where("pages_trans","*",array('id' => $data[0]['id'] ) );
 			if(isset($datat[0]['title']) && !empty($datat[0]['title'])){
 				$data[0]['title'] = $datat[0]['title'];
 			}
 			if(isset($datat[0]['editor']) && !empty($datat[0]['editor'])){
 				$data[0]['editor'] = $datat[0]['editor'];
 			}
 		}


   	 	if(isset($data[0]))
   	 	{
   	 		echo json_encode( array("status" => true ,"data" => $data , "ws" => $ws ,"message" => ($language == 'ar'? 'بنجاح':'Successfully') ) );die;
   	 	}
   	 	else
   	 	{
   	 		echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'الطلب غير ساري المفعول':'Invalid request') ) );die;
   	 	}
   	}

    public function home_page_data()
	{
		date_default_timezone_set('Asia/Kolkata');
		$json = file_get_contents('php://input');
		// $json 		= '{"language":"en"}';
		// $user_id = '2';

		$jsonobj 				= json_decode($json);
		$language 				= @$jsonobj->language;
		$language 				= empty($language)? 'en':$language;

		$ws 					= empty($ws)? 'home_page_data':$ws;
        $created_date 			= date("Y/m/d h:i:s");
		
		$user_id = $this->validate_token($language , $ws);

		$banner = $this->custom_model->get_data_array("SELECT id,image,category FROM banner  ");
        
        if (!empty($banner))
        {
        	foreach ($banner as $qkey => $qvalue)
			{
				if($language != "en"){
		 			$banner_trans = $this->custom_model->my_where("banner_trans","*",array('id' => $qvalue['id'] ) );
		 			if(isset($banner_trans[0]['image']) && !empty($banner_trans[0]['image'])){
		 				$category_listing[$qkey]['image'] = $banner_trans[0]['image'];
		 			}
		 		}

				$banner[$qkey]['image'] = $this->get_banner_path($qvalue['image']);
			}
        }
		
		/*// check category has product or not
		$this->load->library('place_order');
        $this->place_order->check_pro_available_or_not();*/


        $category_listing = $this->custom_model->get_data_array("SELECT id,display_name,image FROM category where `status` = 'active' AND `parent` = '0'  AND `has_product` = '1'  order by RAND() LIMIT 10 "); 

		if (!empty($category_listing))
        {
        	foreach ($category_listing as $vkey => $vvalue)
			{
				if($language != "en"){
		 			$datat = $this->custom_model->my_where("category_trans","*",array('id' => $vvalue['id'] ) );
		 			if(isset($datat[0]['display_name']) && !empty($datat[0]['display_name'])){
		 				$category_listing[$vkey]['display_name'] = $datat[0]['display_name'];
		 			}
		 			if(isset($datat[0]['image']) && !empty($datat[0]['image'])){
		 				$category_listing[$vkey]['image'] = $datat[0]['image'];
		 			}
		 		}

		 		$category_listing[$vkey]['image'] = $this->get_category_path($vvalue['image']);


				$cat = $vvalue['id'];
				$product_listing = $this->custom_model->get_data_array("SELECT id,product_name,product_image,price,sale_price,category,subcategory FROM product where  `stock_status` = 'instock' AND `product_delete`='0' AND `category` = '$cat' AND `status`='1'   order by RAND() LIMIT 8 "); 
			   	// echo $this->db->last_query(); echo "<br>";


			    if (!empty($product_listing))
		        {
		        	foreach ($product_listing as $dkey => $dvalue)
					{
						// echo "<pre>";
						// print_r($dvalue);
						// die;

						// $dvalue['id'] = 13;

						$this->load->library('place_order');
        				$rating = $this->place_order->rating($dvalue['id']);

						$product_listing[$dkey]['rating'] = $rating['rating'];
						// $product_listing[$dkey]['user_count'] = $rating['user_count'];
						

						$product_listing[$dkey]['collection_price'] = $dvalue['price'];
						$product_listing[$dkey]['delivery_price'] = $dvalue['sale_price'];

						$product_listing[$dkey]['product_image'] = $this->get_product_path($dvalue['product_image']);
						
						$is_in_wish_list 	= $this->is_in_wish_list($dvalue['id'] ,$user_id);
						$get_count 			= $this->get_count($dvalue['id'] ,$user_id);
						$remove_key_genrate = $this->remove_key_genrate($dvalue['id'] ,$user_id);
						
						if (empty($get_count)){$get_count = 0;}

						// echo $dvalue['id'];
						// echo "<br>";
						// print_r($get_count);
						// die;

						$main_category_name 	= $this->get_category_name($dvalue['category'] ,$user_id);
						$sub_category_name 		= $this->get_category_name($dvalue['subcategory'] ,$user_id);

				    	$product_listing[$dkey]['category'] 		= $main_category_name;
				    	$product_listing[$dkey]['subcategory'] 		= $sub_category_name;

				    	$product_listing[$dkey]['is_in_wish_list'] 		= $is_in_wish_list;
				    	$product_listing[$dkey]['count_add'] 			= $get_count;
				    	$product_listing[$dkey]['remove_key_genrate'] 	= $remove_key_genrate;

				    	unset($product_listing[$dkey]['price']);
				    	unset($product_listing[$dkey]['sale_price']);
					}
					$category_listing[$vkey]['product_list'] = $product_listing;
      			}
      			else
      			{
      				$category_listing[$vkey]['product_list'] = array();
      			}
			}
        }

        

        $c_listing = $this->custom_model->get_data_array("SELECT id,display_name,image FROM category where `status` = 'active' AND `parent` = '0'  order by RAND() LIMIT 3 "); 

		if (!empty($c_listing))
        {
        	foreach ($c_listing as $ckey => $calue)
			{

				if($language != "en")
				{
		 			$cat_datat = $this->custom_model->my_where("category_trans","*",array('id' => $calue['id'] ) );

		 			if(isset($cat_datat[0]['display_name']) && !empty($cat_datat[0]['display_name'])){
		 				$c_listing[$ckey]['display_name'] = $cat_datat[0]['display_name'];
		 			}
		 			if(isset($cat_datat[0]['image']) && !empty($cat_datat[0]['image'])){
		 				$c_listing[$ckey]['image'] = $cat_datat[0]['image'];
		 			}
		 		}

				$c_listing[$ckey]['image'] = $this->get_category_path($calue['image']);
			}
        }

        // echo "<pre>";
        // print_r($category_listing);
        // die;

        $count = $this->view_cart_count($user_id);
		$response["category_listing"] = $c_listing;
		$response["banner_listing"] 	= $banner;
		$response["product_listing"] 	= $category_listing;
		$response["ws"] = $ws;
		$response["message"] = "Successfully";
		$response["cart_count"] = $count;
		$response["status"] = true;
		echo json_encode( $response );die;
   	}
   	
   	
   	public function is_in_wish_list($user_id , $product_id)
   	{
   		$wish_arr = $this->custom_model->my_where('my_cart','id,content',array('user_id' => $user_id,'meta_key' => 'wish_list'));

		if(!empty($wish_arr)) $my_wish = unserialize($wish_arr[0]['content']);

		$data = !empty($my_wish) && in_array($product_id, $my_wish)? true:false;

		return $data;
   	}


   	public function category_wise_product_list()
	{
		$json = file_get_contents('php://input');
		$post_data = $this->input->post();
		
		// $json 		= '{"category":"12","string":"","pagination":"1" ,"language":"en"}';
		
		$jsonobj 	= json_decode($json);
		$language 	= @$jsonobj->language;
		$ws 		= @$jsonobj->ws;
		$string 	= @$jsonobj->string;
		
		$language 	= empty($language)? 'en':$language;
		$ws 		= empty($ws)? 'category_wise_product_list':$ws;
		$category 	= @$jsonobj->category;
	    // $user_id = 1;
		$user_id = $this->validate_token($language ,$ws);
        
        $pagination = @$jsonobj->pagination;

        if (empty($pagination))
		{
			echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'أضف ترقيم الصفحات':'Add pagination') ) );die;
		}

		
        if(empty($pagination)) $pagination = 1;
		$limit = 5;
		$pagination = $limit * ( $pagination - 1);


		$active = $this->custom_model->get_data_array("SELECT * FROM  category where `status` != 'active'  ");
		if (!empty($active))
		{
			foreach ($active as $dkey => $fvalue)
			{
				$category_id = $fvalue['id'];
				$update_p['category_status'] = 'deactive';
				$this->custom_model->my_update($update_p,array('category' => $category_id),'product');
				$this->custom_model->my_update($update_p,array('category' => $category_id),'product_trans');
			}
		}



   	 	if (!empty($string) && empty($category) )
   	 	{
 			$data = $this->custom_model->get_data_array("SELECT id,product_name,category,subcategory,price,sale_price,product_image,stock_status FROM product WHERE product_name LIKE '%$string%' AND `status` != '0' AND `stock_status` = 'instock' order by id asc  LIMIT $pagination,$limit  ");

 			// echo $this->db->last_query();
 			// die;

 		}
   	 	else if (!empty($string) && !empty($category))
   	 	{
 			$data = $this->custom_model->get_data_array("SELECT id,product_name,category,subcategory,price,sale_price,product_image,stock_status FROM product WHERE product_name LIKE '%$string%' AND ( `category` = '$category' OR `subcategory` = '$category' ) AND `status` != '0' AND `stock_status` = 'instock' order by id asc  LIMIT $pagination,$limit  ");

 			// echo $this->db->last_query();
 			// die;
 		}
 		elseif(!empty($category) && empty($string))
 		{
 			$data = $this->custom_model->get_data_array("SELECT id,product_name,category,subcategory,price,sale_price,product_image,stock_status FROM product WHERE  `status` != '0' AND ( `category` = '$category' OR `subcategory` = '$category' ) AND `stock_status` = 'instock'  order by id asc  LIMIT $pagination,$limit");

 			// echo $this->db->last_query();
 			// die;
 		}
 		else
 		{
 			echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'الطلب غير ساري المفعول':'Invalid request') ) );die;
 		}

   	 		

 		if ($data)
 		{
 			foreach ($data as $key => $value)
 			{
 			    $category = $value['category'];
 			    $subcategory = $value['subcategory'];
 			    $pid = $value['id'];

 			    if($language != "en"){
		 			$product_trans = $this->custom_model->my_where("product","id,product_name,category,price,sale_price,stock_status,product_image,status",array('id' => $pid ) );
		 			if(isset($product_trans[0]['image']) && !empty($product_trans[0]['image'])){
		 				$data[$key]['image'] = $product_trans[0]['image'];
		 			}
		 			if(isset($product_trans[0]['product_name']) && !empty($product_trans[0]['product_name'])){
		 				$data[$key]['product_name'] = $product_trans[0]['product_name'];
		 			}
		 		}

 			    $get_count 			= $this->get_count($pid ,$user_id);
				$remove_key_genrate = $this->remove_key_genrate($pid ,$user_id);
						
				if (empty($get_count)){$get_count = 0;}		

		    	$data[$key]['count_add'] 			= $get_count;
		    	$data[$key]['remove_key_genrate'] 	= $remove_key_genrate;


				// echo "<pre>";
				// print_r($data);
				// print_r($get);
				// die;
                
                $main_category_name 	= $this->get_category_name($category ,$user_id);
				$sub_category_name 		= $this->get_category_name($subcategory ,$user_id);

		    	$data[$key]['category'] 		= $main_category_name;
		    	$data[$key]['subcategory'] 		= $sub_category_name;


                // Add ratings
				$this->load->library('place_order');
				$rating = $this->place_order->rating($value['id']);

				$data[$key]['rating'] = $rating['rating'];
				$data[$key]['rating_user_count'] = $rating['user_count'];

			    $product_id = $value['id'];
			    $is_in_wish_list 	= $this->is_in_wish_list($product_id ,$user_id);
				$data[$key]['is_in_wish_list'] = $is_in_wish_list;			
 				$data[$key]['product_image'] = $this->get_product_path($value['product_image']);

				$data[$key]['collection_price'] = $value['price'];
				$data[$key]['delivery_price'] = $value['sale_price'];
				unset($data[$key]['price']);
				unset($data[$key]['sale_price']);				    	
 			}
			// echo "<pre>";
			// print_r($data);
			// die;

 			echo json_encode(array("status" => true,"data" => $data ,"ws" => $ws ,"message" => ($language == 'ar'? 'بنجاح':'Successfully') )); die;
		}
 		else
 		{
 			echo json_encode( array("status" => false,"message" => ($language == 'ar'? 'لايوجد سجل':'No record found') , "ws" => $ws ) );die;
 		}		
	}


	public function get_subcategory()
	{
		date_default_timezone_set('Asia/Kolkata');
		$json = file_get_contents('php://input');
		// $json 		= '{"language":"en","category_id" :"11"}';
		// $user_id = '2';

		$jsonobj 				= json_decode($json);
		$category_id 			= @$jsonobj->category_id;
		$language 				= @$jsonobj->language;
		$language 				= empty($language)? 'en':$language;

		$ws 					= empty($ws)? 'get_subcategory':$ws;
        $created_date 			= date("Y/m/d h:i:s");
		
		$user_id = $this->validate_token($language , $ws);

        if (!empty($category_id))
        {
			$count = $this->view_cart_count($user_id);
       		$c_listing = $this->custom_model->get_data_array("SELECT id,display_name,image FROM category where `status` = 'active' AND `parent` = '$category_id'  order by RAND() LIMIT 3 "); 

			if (!empty($c_listing))
	        {
	        	foreach ($c_listing as $ckey => $calue)
				{
					if($language != "en")
					{
			 			$cat_datat = $this->custom_model->my_where("category_trans","*",array('id' => $calue['id'] ) );

			 			if(isset($cat_datat[0]['display_name']) && !empty($cat_datat[0]['display_name'])){
			 				$c_listing[$ckey]['display_name'] = $cat_datat[0]['display_name'];
			 			}
			 			if(isset($cat_datat[0]['image']) && !empty($cat_datat[0]['image'])){
			 				$c_listing[$ckey]['image'] = $cat_datat[0]['image'];
			 			}
			 		}

					$c_listing[$ckey]['image'] = $this->get_category_path($calue['image']);
				}
				
	        	echo json_encode( array("status" => true, "cart_count" => $count, "category_listing" => $c_listing, "ws" => $ws ,"message" => ($language == 'ar'? '':'Successfully') ) );die;
	        }
	        echo json_encode( array("status" => false, "cart_count" => $count , "ws" => $ws ,"message" => ($language == 'ar'? '':'No record found') ) );die;
        }
        else
        {
        	echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid request') ) );die;
        }
   	}

	public function get_count($pid,$user_id)
	{  
		$language = 'en';

		$this->load->library('user_account');

   	 	$cart = $this->custom_model->my_where('my_cart','content',array('user_id'=>$user_id,'meta_key' => 'cart'));

   	 	if(!empty($cart)) $content = unserialize($cart[0]['content']);

   	 	// echo "<pre>";
   	 	// print_r($pid);
   	 	// print_r($content);
   	 	// die;

   	 	if (!empty($content)) {
			foreach ($content as $key => $value)
			{
				$old_pid = $value['pid'] ;

				// print_r($old_pid);


				if ($pid == $old_pid) {
					return $value['qty'];
				}
				
				// echo "<pre>";
				// print_r($old_pid);
				// die;

				/*if(!empty($value['metadata']))
				{
                    foreach ($value['metadata'] as $pkey => $pvalue) {
						$append .= 'm'.$pvalue;
					}
				}*/			
			}
		}
		else
		{
			return 0;
		}
   	}

   	public function remove_key_genrate($pid,$user_id)
	{  
		$language = 'en';

		$this->load->library('user_account');

   	 	$cart = $this->custom_model->my_where('my_cart','content',array('user_id'=>$user_id,'meta_key' => 'cart'));

   	 	if(!empty($cart)) $content = unserialize($cart[0]['content']);

   	 	// echo "<pre>";
   	 	// print_r($pid);
   	 	// print_r($content);
   	 	// die;

   	 	if (!empty($content)) {
			foreach ($content as $key => $value)
			{
				$old_pid = $value['pid'] ;

				// print_r($old_pid);


				if ($pid == $old_pid) {
					if(!empty($value['metadata']))
					{
		                foreach ($value['metadata'] as $pkey => $pvalue) {
							$append .= 'm'.$pvalue;

							return 'm'.$append;
						}
					}
					else
					{
						return 'm'.$pid;
					}					
				}else
					{
						return 'm'.$pid;
					}
				
				// echo "<pre>";
				// print_r($old_pid);
				// die;

						
			}
		}
		else
		{
			return 'm'.$pid;
		}
   	}

	public function product_detail()
	{
		$json = file_get_contents('php://input');
		// $json 	= '{"product_id":"5","language":"en"}';
		$jsonobj 	= json_decode($json);
		$language 	= @$jsonobj->language;
		$language 	= empty($language)? 'en':$language;
		$ws 		= @$jsonobj->ws;
		$ws 		= empty($ws)? 'product_detail':$ws;
		// $user_id = 1;
		
		$pid 	= @$jsonobj->product_id;
		$my_wish = array();
   	 	$response = array();        
        $user_id = $this->validate_token($language,$ws);
		$product_detail = $this->custom_model->my_where("product","*",array('id' =>$pid,'status'=>'1','product_delete'=>'0'));

		$product_detail=$this->related_menu($product_detail,$language);

		
		// echo $this->db->last_query();
	
		if(empty($product_detail))
		{
			echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'المنتج غير نشط':'Product is deactive') ) );die;
		}


		if(!empty($product_detail))
		{
			if($language != "en"){
				$product_trans = $this->custom_model->my_where("product_trans","id,product_name,category,price,sale_price,stock_status,product_image,status,description",array('id' => $pid ) );
				if(isset($product_trans[0]['product_image']) && !empty($product_trans[0]['product_image'])){
					$product_detail[0]['product_image'] =  $this->get_product_path($product_trans[0]['product_image']);
				}
				if(isset($product_trans[0]['product_name']) && !empty($product_trans[0]['product_name'])){
					$product_detail[0]['product_name'] = $product_trans[0]['product_name'];
				}
				if(isset($product_trans[0]['product_name']) && !empty($product_trans[0]['product_name'])){
					$product_detail[0]['product_name'] = $product_trans[0]['product_name'];
				}
				if(isset($product_trans[0]['description']) && !empty($product_trans[0]['description'])){
					$product_detail[0]['description'] = $product_trans[0]['description'];
				}
			}
			
			$product_detail[0]['collection_price'] = $product_detail[0]['price'];
			$product_detail[0]['delivery_price'] = $product_detail[0]['sale_price'];

			$is_in_wish_list 	= $this->is_in_wish_list($pid ,$user_id);
			$product_detail[0]['is_in_wish_list'] 	= $is_in_wish_list;

			unset($product_detail[0]['category_status']);
			unset($product_detail[0]['status']);
			unset($product_detail[0]['stock']);
			unset($product_detail[0]['sale']);
			unset($product_detail[0]['slug']);
			unset($product_detail[0]['created_date']);
			unset($product_detail[0]['tags']);
			unset($product_detail[0]['price_select']);
			unset($product_detail[0]['offer']);
			unset($product_detail[0]['special_menu']);
			unset($product_detail[0]['product_delete']);
			unset($product_detail[0]['price']);
			unset($product_detail[0]['sale_price']);


			// echo "<pre>";
			// print_r($product_detail);
			// die;

			$main_cat = $product_detail[0]['category'];
			$sub_cat = $product_detail[0]['subcategory'];

			$main_cat_name 	= $this->get_category_name($product_detail[0]['category'] ,$user_id);
			$sub_cat_name 		= $this->get_category_name($product_detail[0]['subcategory'] ,$user_id);

	    	$product_detail[0]['category'] 			= $main_cat_name;
	    	$product_detail[0]['subcategory'] 		= $sub_cat_name;

			$image_gallery = $product_detail[0]['image_gallery'];
            $aimage_gallery = explode(",", $image_gallery); 
            $aimage_gallery = array_filter($aimage_gallery);
            $product_detail[0]['image_gallery'] = $aimage_gallery;

            foreach ($product_detail[0]['image_gallery'] as $gkey => $gvalue)
 			{
 				$product_detail[0]['gallery_image'][] = $this->get_product_path($gvalue);
 			}

 			if (@$gkey)
 			{
 				$product_detail[0]['gallery_image'][$gkey+1] = $product_detail[0]['product_image'];
 			}
 			else
 			{
 				$product_detail[0]['gallery_image'][] = @$product_detail[0]['product_image'];	
 			}

            // echo "<pre>";
            // print_r($product_detail[0]['gallery_image']);
            // print_r($product_detail[0]['product_image']);
            // print_r($product_detail[0]['image_gallery']);
            // print_r($product_detail[0]['gallery_image']);
            // die;		
			
			$get_count 			= $this->get_count($pid ,$user_id);
			$remove_key_genrate = $this->remove_key_genrate($pid ,$user_id);
				
			if (empty($get_count)){$get_count = 0;}

		    $product_detail[0]['count_add'] 			= $get_count;
		    $product_detail[0]['remove_key_genrate'] 	= $remove_key_genrate;
		}


		$related_Procut = $this->custom_model->get_data_array("SELECT id,product_name,category,product_image,price,sale_price,stock_status,subcategory FROM product where  `stock_status` = 'instock' AND `product_delete`='0' AND( `category` = '$sub_cat' OR `subcategory` = '$sub_cat'   ) AND `status`='1' AND `id` != '$pid'  order by RAND() LIMIT 20 "); 

		// echo $this->db->last_query(); echo "<br>";

		$related_Procut=$this->related_menu($related_Procut,$language);

		// echo "<pre>";
		// print_r($related_Procut);
		// die;

		// Related product add count & check added in wishlist or not 
		if (!empty($related_Procut))
		{
			foreach ($related_Procut as $vkey => $vvalue)
			{
				$product_id 	= 	$vvalue['id'];
				$category_id 	= 	$vvalue['category'];
				$subcategory_id =	$vvalue['subcategory'];

				$main_category_name 	= $this->get_category_name($category_id ,$user_id);
				$sub_category_name 		= $this->get_category_name($subcategory_id ,$user_id);

				$is_in_wish_list 	= $this->is_in_wish_list($product_id ,$user_id);
				$get_count 			= $this->get_count($product_id ,$user_id);
				$remove_key_genrate = $this->remove_key_genrate($product_id ,$user_id);
				
				if (empty($get_count)){$get_count = 0;}

				$related_Procut[$vkey]['collection_price'] = $vvalue['price'];
				$related_Procut[$vkey]['delivery_price'] = $vvalue['sale_price'];

				unset($related_Procut[$vkey]['price']);
				unset($related_Procut[$vkey]['sale_price']);

		    	$related_Procut[$vkey]['category'] 				= $main_category_name;
		    	$related_Procut[$vkey]['subcategory'] 			= $sub_category_name;

		    	$related_Procut[$vkey]['is_in_wish_list'] 		= $is_in_wish_list;
		    	$related_Procut[$vkey]['count_add'] 			= $get_count;
		    	$related_Procut[$vkey]['remove_key_genrate'] 	= $remove_key_genrate;
			}
		}
		
		

		echo json_encode( array("status" => true, "related_Procut" => $related_Procut,"data" => $product_detail[0] , "ws" => $ws ,"message" => ($language == 'ar'? 'بنجاح':'Successfully') ) );die;
   	}


   	public function get_category_name($category_id)
   	{
   		if($category_id)
        {
            $category_listing = $this->custom_model->my_where("category","display_name",array("id" => $category_id ) );

            if ($category_listing)
            {
            	// echo "<pre>";
            	// print_r($category_listing);
            	// die;

        		return $category_listing['0']['display_name'];
            }
            else
            {
            	return '';	
            }  
        }
   	}

   	public function related_menu($related_Procut='', $language = '')
	{
		if (empty($language))
		{
			$language ='en';
		}

		// echo "<pre>";
		// print_r($related_Procut);
		// die;

		if(!empty($related_Procut))
		{
			foreach ($related_Procut as $key => $product) {

				$related_Procut[$key]['product_image'] = $this->get_product_path($product['product_image']);

				$pid=$product['id'];

				$this->load->library('place_order');
				$rating = $this->place_order->rating($pid);

				$related_Procut[$key]['rating'] 	= $rating['rating'];
				$related_Procut[$key]['rating_user_count'] = $rating['user_count'];

				


				$category = $this->custom_model->my_where("category","display_name",array('id' => $product['category']));
				if(!empty($category))
				{

					if($language != "en"){

						$category_trans = $this->custom_model->my_where("category_trans","display_name",array('id' => $product['category'] ) );

						if(!empty($category_trans))
						{
							// echo "<pre>";
							// print_r($category_trans);
							// die;

							$related_Procut[$key]['category_name']=$category_trans[0]['display_name'];
						}
						else
						{
							$related_Procut[$key]['category_name']= '';
						}
					}
					else
					{
						$related_Procut[$key]['category_name']=$category[0]['display_name'];
					}

				}

				$product_attrs = $this->custom_model->get_data_array("SELECT `item_id`,`price`,`sale_price`,`attribute_id` FROM product_attribute WHERE `p_id` = '$pid'");
				if(!empty($product_attrs))
				{
					$related_Procut[$key]['meta_data']=$product_attrs;
					foreach ($related_Procut[$key]['meta_data'] as $key2 => $meta_data) 
					{
						$item_id=$meta_data['item_id'];
						$attribute_item = $this->custom_model->get_data_array("SELECT `item_name` FROM attribute_item WHERE `id` = '$item_id'");
						$related_Procut[$key]['meta_data'][$key2]['size']=$attribute_item[0]['item_name'];					
					}					
				}

				$pc_details = $this->custom_model->my_where("product_custimze_details","*",array('pid' => $pid));	
				if(!empty($pc_details))
				{
					$related_Procut[$key]['pc_details']=1;
				}else{
					$related_Procut[$key]['pc_details']=0;
				}


			}
		}
		// echo '<pre>';
		// print_r($related_Procut);
		// die;
		return $related_Procut;
	}


   public function add_to_cart()
	{
		$json = file_get_contents('php://input');
		// $json 		= '{"product_id":"5","quantity":"1","color":"","size":"","type":"add"}';
		// $json 		= '{"product_id":"5","quantity":"-1","color":"","size":"","type":"update"}';
		// $json 		= '{"p_key":"m2","type":"remove"}';

		// $json 		= '{"product_id":"14","quantity":"1","type":"add"}';
		// $json 		= '{"product_id":"5","quantity":"1","type":"update"}';
		// $json 		= '{"p_key":"m14","type":"remove"}';

		$jsonobj 	= json_decode($json);
		$language 	= @$jsonobj->language;
		$p_key 		= @$jsonobj->p_key;
		
		$ws 		= @$jsonobj->ws;
		$ws 		= empty($ws)? 'add_to_cart':$ws;
		$language 	= empty($language)? 'en':$language;
		
		$pid 		= @$jsonobj->product_id;
		$quantity 	= @$jsonobj->quantity;
		$color 		= @$jsonobj->color;
		$size 		= @$jsonobj->size;
		$type 		= @$jsonobj->type;
		$type 		= empty($type)? 'add':$type;
		$cart_qty 	= 0;
        $metadata 	= array();        
		$user_id 	= $this->check_user_login($language,$ws);
        // $user_id 	= 2 ;

		if (!empty($pid) && !empty($user_id) && !empty($quantity))
		{
            if(!empty($color)) $metadata['color'] = $color;
            if(!empty($size)) $metadata['size'] = $size;
            
			$this->load->library('user_account');
			
			if ($type == 'add')
			{
				$response = $this->user_account->add_remove_cart($pid,$user_id,'add',$quantity, $metadata);

				// echo "<pre>";
				// print_r($response);
				// die;

				if ($response)
				{
					$count = $this->view_cart_count($user_id);
					$response=json_decode($response,true);

					if ($response['message'] == 'invalid_size') 
					{
						echo json_encode( array("status" => false,"ws" => $ws , "message" => "Invalid Size Request!" ) );die;
					}
					else if ($response['message'] == 'product_is_deactive') 
					{
						echo json_encode( array("status" => true,"ws" => $ws , "message" => "Product is deactive!" ) );die;
					}
					else if ($response['message'] == 'founded') 
					{
						echo json_encode( array("status" => true,"ws" => $ws , "message" => "Added to cart successfully!","cart_count"=>$count ) );die;
					}
					else if ($response['message'] == 'quantity_notinstock') 
					{
						echo json_encode( array("status" => false,"ws" => $ws , "message" => "Product quantity is not in stock!" ) );die;
					}
					else if ($response['message'] == 'quantity_not_avilable') 
					{
						echo json_encode( array("status" => false,"ws" => $ws , "message" => "Quantity not available!" ) );die;
					}
					else if ($response['message'] == 'first_time_added_successfully') 
					{
						echo json_encode(array("status" => true,"ws" => $ws ,"message" => ($language == 'ar'? 'تمت الإضافة إلى السلة بنجاح':'Added to cart successfully!'),"cart_count"=>$count )); die;
					}					
				}
				else{
				    $msg = ($language == 'ar'? 'لا يوجد رصيد كاف لإضافة كمية ...':'Not enough stock to add quantity...');
					echo json_encode( array("status" => false, "ws" => $ws ,"message" => $msg) );die;
				}				
			}
			elseif ($type == 'update')
			{
				$metadata='';
				$pcxdata='';

				if(!empty($metadata)){
					foreach ($metadata as $pkey => $pvalue) {
						$pid .= 'm'.$pvalue;
					}
					$append = $pid;
				}    			
    			else
    			{
    				$append = 'm'.$pid;
    			}

				$response = $this->user_account->add_remove_cart($pid,$user_id,$type,$quantity,$metadata,$pcxdata,$append);
				// echo "<pre>";
				// print_r($response);
				// die;
				$response=json_decode($response,true);
				$product_count = $this->view_cart_count($user_id);
				if ($response['message'] == 'cart_updated')
				{
					echo json_encode( array("status" => true , "ws" => $ws,"message" => "Updated successfully","cart_count" => $product_count) );die;
				}
				if ($response['message'] == 'quantity_not_avilable')
				{
					echo json_encode( array("status" => true , "ws" => $ws,"message" => "Quantity not available","cart_count" => $product_count) );die;
				}
				if ($response['message'] == 'not_added_tocart')
				{
					echo json_encode( array("status" => true , "ws" => $ws,"message" => "Product not added to cart","cart_count" => $product_count) );die;
				}
				if ($response['message'] == 'quantity_notinstock') 
				{
					echo json_encode( array("status" => false,"ws" => $ws , "message" => "Product quantity is not in stock! " ) );die;
				}
				if ($response['message'] == 'quantity_not_update_below_one') 
				{
					echo json_encode(array("status" => true,"ws" => $ws ,"message" => ($language == 'ar'? '':'Quantity is not updated below one. you have to remove that product from cart. ') )); die;
				}
			}
		}

		if ($type == 'remove')
		{
			$this->load->library('user_account');
			$response = $this->user_account->add_remove_cart($p_key,$user_id,'remove');
			$product_count = $this->view_cart_count($user_id);
			if ($response == '-1')
			{
				echo json_encode( array("status" => false , "ws" => $ws,"message" => "Invalid removed request","cart_count" => $product_count) );die;
			}
			// echo "<pre>";
			// print_r($response);
			// die;
			echo json_encode( array("status" => true , "ws" => $ws,"message" => "Removed successfully","cart_count" => $product_count) );die;
		}

		echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'الطلب غير ساري المفعول':'Invalid request') ) );die;
   	}


   	public function view_cart()
	{
		$total_saved = $totaltax = $totaldel = 0;
		$json 		= file_get_contents('php://input');
		$jsonobj 	= json_decode($json);

		$language 	= @$jsonobj->language;
		$language 	= empty($language)? 'en':$language;

    	$ws 		= @$jsonobj->ws;
		$ws 		= empty($ws)? 'view_cart':$ws;
		
		// $user_id 	= 2;
        $user_id = $this->check_user_login($language,$ws);
    
		// echo "<pre>";
   	 	if (empty($user_id))
   	 	{
   	 		echo json_encode( array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid request')) );die;
   	 	}

		$data = $this->view_cart_deta($user_id,$language);
		$count = $this->view_cart_count($user_id);
		
		if (empty($data))
		{
			echo json_encode( array("status" => true ,  "ws" => $ws ,"data" => $data,"card_count" => $count,"message"=> "Cart is empty") );die;
		}

		if (!empty($data))
		{
			$sum = 0;

			foreach ($data as $ckey => $cvalue)
			{
				$sum+= $cvalue['c']['total_amount'];
			}
		}

		
		// echo "<br>";
		// print_r($sum);
		// print_r($data);
		// die;

		echo json_encode( array("status" => true , "total_amount" => $sum ,  "ws" => $ws ,"data" => $data,"card_count" => $count ,"message"=> "Successfully" ) );die;
   	}


	public function place_order()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"mobile_no": "8149169115", "email": "girish@persausive.in", "language": "en", "device": "ios", "shipping_charge": "0", "name": "Girish", "payment_mode": "cash-on-del","address":"address", "city":"city", "country":"country","state":"state","pincode":"pincode","source":"android","order_pickup_status":"Restaurant" }';
		
		// $json 		= '{"mobile_no": "8149169115", "email": "girish@persausive.in", "language": "en", "device": "ios", "shipping_charge": "0", "name": "Girish", "payment_mode": "cash-on-del","address":"address", "city":"city", "country":"country","state":"state","pincode":"pincode","source":"android","order_pickup_status":"Home" }';

		$jsonobj 		= json_decode($json, True);
   	 	$response 		= $data = $post_arr = array();

		$language 		= @$jsonobj['language'];
		$language 		= empty($language)? 'en':$language;		
		$ws 			= @$jsonobj->ws;
        $ws 			= empty($ws)? 'place_order':$ws;

		$source 		= @$jsonobj->source;
        $source 		= empty($source)? 'android':$source;

		// $uid = 2;
		$uid = $this->validate_token($language,$ws);

		// CONTACT DETAILS
		$post_arr['email'] 							= @$jsonobj['email'];
		$post_arr['name'] 							= @$jsonobj['name'];
		$post_arr['mobile_no'] 						= @$jsonobj['mobile_no'];
		$post_arr['address'] 						= @$jsonobj['address'];
		$post_arr['city'] 							= @$jsonobj['city'];
		$post_arr['country'] 						= @$jsonobj['country'];
		$post_arr['state'] 							= @$jsonobj['state'];
		$post_arr['pincode'] 						= @$jsonobj['pincode'];
		$post_arr['payment_mode'] 					= $jsonobj['payment_mode'];
		$post_arr['source'] 						= $jsonobj['source'];
		$post_arr['order_pickup_status'] 			= @$jsonobj['order_pickup_status'];
   	 	$post_arr['order_status'] 					= "Pending";


   	 	if ($post_arr['order_pickup_status'] == 'Home')
   	 	{
			$info_array = array(
					"user_id" 			=> $uid,
					"address" 			=> @$jsonobj['address'],
					"city" 				=> @$jsonobj['city'],
					"country" 			=> @$jsonobj['country'],
					"state" 			=> @$jsonobj['state'],
					"pincode" 			=> @$jsonobj['pincode']
				);	
			

			if (!empty($info_array))
			{
				$address = $this->custom_model->my_insert($info_array, 'user_address');
			}
   	 	}

		

        $is_data = $this->custom_model->my_where('my_cart','*',array('user_id' => $uid,'meta_key' => 'cart'));
        if (!empty($is_data))
        {
            $products = unserialize($is_data[0]['content']);
            if (!empty($products))
            {
                $this->load->library('place_order');
                $response = $this->place_order->create_order($post_arr, $products, $uid);
            }

        }

		// echo "<pre>";
		// print_r($response);
		// die;

        if (!empty($response))
		{
			unset($response['product']);
			unset($response['remove_pr']);

			$this->load->library("email_send");
			$this->email_send->send_invoice($response['display_order_id']);
			// $this->custom_model->my_update(array('content' => ''),array('user_id' => $uid,'meta_key' => 'cart'),'my_cart');		
		}
		else
		{
			echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'الطلب غير ساري المفعول':'Invalid request') ) );die;
		}


		// echo "<pre>";
		// print_r($is_data);
		// print_r($response);
		// die;

		if ($response)
		{	
			echo json_encode( array("status" => true ,"ws" => $ws ,"data" => $response ,"message" => ($language == 'ar'? 'تم وضع الطلب بنجاح':'Order placed successfully')) );die;
		}
		else
		{
			echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'الطلب غير ساري المفعول':'Invalid request') ) );die;
		}
   	}


   	public function view_cart_count($user_id)
   	{
   		$cart = $this->custom_model->my_where('my_cart','content',array('user_id'=>$user_id,'meta_key' => 'cart'));

		if(!empty($cart)) $content = unserialize($cart[0]['content']);
   	 	$cart_qty = 0;
   	 	if (@$cart[0]['content'])
   	 	{
   	 		$content=$cart[0]['content'];
			$content=unserialize($content);				
			// $cart_qty= count($content);

   	 		foreach ($content as $unkey => $unvalue)
			{
				// echo "<pre>";
   	 			// print_r($unvalue);
				$cart_qty += $unvalue['qty'];
			}
   	 	}

   	 	// echo "<pre>";
   	 	// print_r($cart_qty);
   	 	// die;

	   	return $cart_qty;
   	}

   	public function remove_from_view_cart($pid, $uid)
	{
		// $pid = $this->input->post('pid');
		// $uid = $this->session->userdata('uid');
		
		// print_r($pid);
		// echo "<br>";
		// print_r($uid);
		// die;

		$this->load->library('user_account');
		$response = $this->user_account->add_remove_cart($pid,$uid,'remove');
		// print_r($response);die;
		if ($response)
		{
			if ($response != '-1')
			{
				// echo "1";
			}
			else{
				// echo "0";
			}
		}
	}

	public function view_cart_deta($uid,$language)
	{
		$data = $adata = array();		
		
		$attp = array();
        $attc = array();

		if (!empty($uid))
		{
			$is_data = $this->custom_model->my_where('my_cart','*',array('user_id' => $uid,'meta_key' => 'cart'));
			$this->session->set_userdata('content',((!empty($is_data))? $is_data[0]['content']:array()));
		}
		// echo "<pre>";
		
		if (!empty($is_data) )
		{
			$content = unserialize($is_data[0]['content']);
			// echo '<pre>';
			// print_r($content);
			// die;

			if (!empty($content)) {
				unset($content['cart_qty']);
				$final_sum = 0;
				foreach ($content as $key => $value) {
					if(empty($value['pid']))
					{						
						$_POST['pid'] = $value['pid'];						
						if(!empty($uid)) $_POST['uid'] = $uid;
						$this->remove_from_cart(false);
						$_POST[] = array();
						continue;
					}

					

					$curr = $this->custom_model->my_where('product','id,product_name,price,sale_price,stock_status,stock,product_image,special_menu,status,category,subcategory',array('id'=>$value['pid']));
					if(!empty($curr) && $language=='en' )
					{
						$main_category_name 	= $this->get_category_name($curr[0]['category'] ,$uid);
						$sub_category_name 		= $this->get_category_name($curr[0]['subcategory'] ,$uid);

				    	$curr[0]['category'] 			= $main_category_name;
				    	$curr[0]['subcategory'] 		= $sub_category_name;


						$curr[0]['product_image'] = $this->get_product_path($curr[0]['product_image']);
						$category_data = $this->custom_model->my_where('category','display_name',array('id'=>$curr[0]['category']));

					}
					
					if($language != "en"){
						$product_trans = $this->custom_model->my_where("product_trans","id,product_name,price,sale_price,stock_status,stock,product_image,special_menu,status,category",array('id' => $value['pid'] ) );

						if(isset($product_trans[0]['product_name']) && !empty($product_trans[0]['product_name'])){
							$curr[0]['product_name'] = $product_trans[0]['product_name'];
						}
						if(isset($product_trans[0]['product_image']) && !empty($product_trans[0]['product_image'])){							
							$curr[0]['product_image'] = $this->get_product_path($product_trans[0]['product_image']);
						}

						if(isset($product_trans[0]['product_name']) && !empty($product_trans[0]['product_name'])){
							$category_data = $this->custom_model->my_where('category_trans','display_name',array('id'=>$curr[0]['category']));
							$curr[0]['category_name']=$category_data[0]['display_name'];
						}
					}

					$is_in_wish_list 				= $this->is_in_wish_list($curr[0]['id'] ,$uid);
					$curr[0]['is_in_wish_list']		= $is_in_wish_list;
					$curr[0]['collection_price']	= $curr[0]['price'];
					$curr[0]['delivery_price'] 		= $curr[0]['sale_price'];

					unset($curr[0]['price']);
			    	unset($curr[0]['sale_price']);


					// echo "<pre>";
					// print_r($curr);
					// die;

					if ($curr[0]['stock_status'] == 'notinstock' || $curr[0]['stock'] == 0 || $curr[0]['stock'] <= 0 || $curr[0]['status'] == 0 )
					{
						// print_r($curr[0]['stock_status']);
						// echo "<br>";
						// print_r($curr[0]['status']);
						// echo "<br>";
						// $_POST['pid'] = $value['pid'];

						$_POST['pid'] = $key;
						if(!empty($uid)) $_POST['uid'] = $uid;
						// echo '132';
						// die;
						$this->add_to_wish_list_from_view_cart(false);
						$this->remove_from_cart(false);
						$adata['error'][$key] = $curr[0]['product_name'];
						continue;
					}										
					if($value['qty'] > $curr[0]['stock'] )
					{
						$value['qty'] 	= 	$curr[0]['stock'];
						$this->load->library('user_account');
						$this->user_account->update_catqty($content,$key,$curr[0]['stock']);
					}				
					
					$user_data = $this->custom_model->get_data_array("SELECT order_pickup FROM  admin_users where `id` = '$uid'  ");

					// print_r($user_data);
					// die;

					if ($user_data)
					{
						if ($user_data[0]['order_pickup'] == 'Restaurant')
						{
							$value['price'] 		= 	$curr[0]['collection_price'] ;
						}
						else
						{
							$value['price'] 		= 	$curr[0]['delivery_price'] ;
						}
					}

					$value['total_amount'] 	= 	$value['qty'] * $value['price'];

					$final_sum+= $value['total_amount'];

					$pid = $curr[0]['id'];

					$this->load->library('place_order');
					$rating = $this->place_order->rating($pid);

					$data[$key]['p'] = $curr[0];					
					$data[$key]['c'] = $value;
					if(isset($value['metadata'])){
						if(!empty($value['metadata'])){
							foreach ($value['metadata'] as $dkey => $vadlue) {
								$attid = $dkey;
					        	if(!isset($attp[$attid])){
					        		$attp[$attid] = $this->custom_model->my_where('attribute','*',array('id' => $attid));
					        	}
					        	$itemid = $vadlue;
					        	if(!isset($attc[$itemid])){
					        		$attc[$itemid] = $this->custom_model->my_where('attribute_item','*',array('id' => $itemid));
					        	}
							}
						}
						
					}

					$data[$key]['rating'] = $rating['rating'];
					$data[$key]['rating_user_count'] = $rating['user_count'];

					// $data[$key]['final_sum'] = $final_sum;
					$data[$key]['key'] = $key;
					$data[$key]['uqty'] = $value['qty'];
				}
			}
		}
		$response = array();
		$bill_amt = $dilevery = $total_saved = $totaltax = 0;	

		foreach ($data as $key => $value)
		{	
			$response[] = $value;
		}

		// echo "<pre>";
		// print_r($response);
		// die;	

		return $response;
	}

	public function remove_from_cart($echo=true)
	{
		$pid = $this->input->post('pid');
		$uid = $this->input->post('uid');
		$this->load->library('user_account');
		$response = $this->user_account->add_remove_cart($pid,$uid,'remove');

		if ($echo)
		{
			if ($response != '-1')
			{
				if (isset($response['cart_qty']))
				{
					$cart_qty = $response['cart_qty'];
					$this->session->set_userdata('cart_qty', $response['cart_qty']);
					unset($response['cart_qty']);
				}

				$this->session->set_userdata('content', serialize($response));
				echo "1";
			}
			else{
				echo "0";
			}
		}
	}


	public function add_to_wish_list_from_view_cart($echo=true)
	{
		$pid = $this->input->post('pid');
		$is_wish = $this->input->post('is_wish');
		$uid = $this->input->post('uid');
		if (empty($uid))
		{
			if ($echo)
			{
				echo "0";die;
			}
			else{
				return;
			}
		}
		$my_wish = array();
		$my_wish = $this->session->userdata('my_wish');
		if (empty($my_wish))
		{
			$my_wish[] = $pid;
			$this->session->set_userdata('my_wish',$my_wish);
		}
		elseif (!in_array($pid, $my_wish))
		{
			$my_wish[] = $pid;
			$this->session->set_userdata('my_wish',$my_wish);
		}
		elseif ($is_wish == '1')
		{
			$my_wish = array_diff($my_wish, array($pid));
			$this->session->set_userdata('my_wish',$my_wish);
		}

		if (!empty($uid))
		{
			$is_data = $this->custom_model->my_where('my_cart','*',array('user_id' => $uid,'meta_key' => 'wish_list'));

			if (!empty($is_data)) {
				$this->custom_model->my_update(array('content' => serialize($my_wish)),array('id' => $is_data[0]['id'],'meta_key' => 'wish_list'),'my_cart',true,true);
			}
			else{
				$data['user_id'] = $uid;
				$data['meta_key'] = 'wish_list';
				$data['content'] = serialize($my_wish);
				$this->custom_model->my_insert($data,'my_cart');
			}
		}
		if ($echo)
		{
			echo "1";
		}
		// die;
	}


   	public function add_to_wish_list()
	{
		$json = file_get_contents('php://input');
		// $json 		= '{"product_id":"2","type":"add"}';
		// $json 		= '{"product_id":"2","type":"remove"}';
		$jsonobj 	= json_decode($json);
		$language 	= @$jsonobj->language;
		$ws 		= @$jsonobj->ws;
		$language 	= empty($language)? 'en':$language;
		$ws 		= empty($ws)? 'add_to_wish_list':$ws;

		// $user_id = 1;
		$uid = $this->validate_token($language,$ws);

		$pid 	= @$jsonobj->product_id;
		$type 	= @$jsonobj->type;
		$type = empty($type)? 'add':$type;
		$my_wish = array();

		if (!empty($user_id))
		{
			$my_wish = $this->wish_list_actions($user_id, $pid, $type);
			if($type != 'add')
			{
			    echo json_encode( array("status" => true, "message" => ($language == 'ar'? 'تمت إزالة المنتج من قائمة الأمنيات.':'The product has been removed from wishlist.') ,  "ws" => $ws , "wish_list" => $my_wish) );die;    
			}
			echo json_encode( array("status" => true, "message" => ($language == 'ar'? 'تمت إضافة المنتج بنجاح إلى قائمة الأمنيات.':'The product has been successfully added to your Wishlist.') ,  "ws" => $ws , "wish_list" => $my_wish) );die;
		}
		else
		{
			echo json_encode( array("status" => false ,  "ws" => $ws  , "message" => ($language == 'ar'? 'يرجى تسجيل الدخول لإضافة منتجات في قائمة الأمنيات':'Please sign in to add products to wishlist.')) );die;
		}
   	}



   	public function wish_list_actions($user_id, $pid, $type)
   	{
   		$wish_arr = $this->custom_model->my_where('my_cart','id,content',array('user_id' => $user_id,'meta_key' => 'wish_list'));

   		// echo "<pre>";
   		// print_r($wish_arr);
   		// die;
   			$my_wish = array();

			if(!empty($wish_arr)) $id = $wish_arr[0]['id'];
			if(!empty($wish_arr)) $my_wish = unserialize($wish_arr[0]['content']);

			if (empty($wish_arr) && $type == 'add')
			{
				$my_wish[] = $pid;
				$data = array('meta_key' => 'wish_list', 'content' => serialize($my_wish), 'user_id' => $user_id);
				$this->custom_model->my_insert($data,'my_cart');
			}
			elseif (!in_array($pid, $my_wish) && $type == 'add')
			{
				$my_wish[] = $pid;
				
				$this->custom_model->my_update(array('content' => serialize($my_wish)),array('id' => $id),'my_cart',true,true);
			}
			
			if (in_array($pid, $my_wish) && $type == 'remove')
			{
				$my_wish = array_diff($my_wish, array($pid));
				
				// print_r($my_wish);
				// die;
				// $my_wish = array_filter($my_wish);
				$this->custom_model->my_update(array('content' => serialize($my_wish)),array('id' => $id),'my_cart');
				
			}

		return $my_wish;
   	}


   	public function view_wish_list()
	{
		$json = file_get_contents('php://input');
		// $json 	= '{}';
		$jsonobj 	= json_decode($json);
		$language 	= @$jsonobj->language;
		$language 	= empty($language)? 'en':$language;
		$ws 		= @$jsonobj->ws;
		$ws 		= empty($ws)? 'view_wish_list':$ws;
		// $user_id = 72;
		$user_id 	= $this->validate_token($language,$ws);
   	 	
   	 	if (!empty($user_id) )
		{
			$data = array();

			$wish_arr = $this->custom_model->my_where('my_cart','id,content',array('user_id' => $user_id,'meta_key' => 'wish_list'));

			if (!empty($wish_arr) && !empty($wish_arr[0]['content']))
			{
				$my_wish = unserialize($wish_arr[0]['content']);
				if (empty($my_wish))
				{
					echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'قائمة الأمنيات فارغة':'The wish list is empty') ) );die;
				}

				foreach ($my_wish as $key => $value)
				{
					$res = $this->this_product_data($value,$language);
					if ($res)
					{
						$pid = $res['curr']['id'];
						$get_count 			= $this->get_count($pid ,$user_id);
						$remove_key_genrate = $this->remove_key_genrate($pid ,$user_id);
								
						if (empty($get_count)){$get_count = 0;}
						

				    	$res['curr']['count_add'] 			= $get_count;
				    	$res['curr']['remove_key_genrate'] 	= $remove_key_genrate;


					    $category = $res['curr']['category'];

						unset($res['curr']['product_delete']);
						unset($res['curr']['seller_id']);
						unset($res['curr']['category']);
						unset($res['curr']['category_status']);
						unset($res['curr']['subcategory']);
						unset($res['curr']['stock_status']);
						unset($res['curr']['stock']);
						unset($res['curr']['sale']);
						unset($res['curr']['slug']);
						unset($res['curr']['image_gallery']);
						unset($res['curr']['status']);
						unset($res['curr']['tags']);
						unset($res['curr']['price_select']);
						unset($res['curr']['offer']);


						// echo "<pre>";
						// print_r($res);
						// die;
                        
                        if($category)
                        {
                            $category_listing = $this->custom_model->my_where("category","*",array("id" => $category ) );    
                            $res['curr']['category'] = $category_listing['0']['display_name'];
                        }

						$data[] = $res['curr'];
					}
				}
				
				// echo "<pre>";
				// print_r($wish_arr);
				// print_r($data);
				// die;
                
                if(!empty($wish_arr) && empty($data))
                {
                    $this->custom_model->my_delete(['user_id' => $user_id,'meta_key' => 'wish_list'], 'my_cart');
                }
                
				if($data)
				{
					echo json_encode( array("status" => true,  "ws" => $ws, "message" => ($language == 'ar'? 'بنجاح':'Successfully')  ,"data" => $data) );die;
				}
			}
			else
			{
				$data = new stdClass();
				echo json_encode( array("status" => false ,  "ws" => $ws  ,"data" => $data,"message" => ($language == 'ar'? 'لم يتم العثور على المنتج':'No product found !')) );die;
			}
		}
		else
		{
			echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'الطلب غير ساري المفعول':'Invalid request') ) );die;
		}
   	}


   	public function order_history_user()
	{
		$json = file_get_contents('php://input');
		// $json 		= '{"pagination" :"1"}';
		$jsonobj 	= json_decode($json);
		$language 	= @$jsonobj->language;
		$ws 		= @$jsonobj->ws;
		$language 	= empty($language)? 'en':$language;
		$ws 		= empty($ws)? 'order_history_user':$ws;
		// $uid = 1;
		$uid = $this->validate_token($language,$ws);

		$pagination = @$jsonobj->pagination;

		if (empty($pagination))
		{
			echo json_encode( array("status" => false,"ws" => $ws ,"message" => ($language == 'ar'? 'أضف ترقيم الصفحات':'Add pagination') ) );die;
		}

        if(empty($pagination)) $pagination = 1;
		$limit = 10;
		$pagination = $limit * ( $pagination - 1);


   	 	$response = array();

   	 	if (!empty($uid))
		{
			$data = array();			
			$data = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,name,shipping_charge,sub_total,tax,net_total,order_status,payment_mode,payment_status,mobile_no,email,neighbourhood,street,entry,building_number,apartment_number,note,delivery_date FROM `order_master` WHERE `customer_id` = '$uid' ORDER BY order_master_id desc LIMIT $pagination,$limit ");
			if(!empty($data))
			{
				foreach ($data as $key => $value)
				{
					$items = $this->custom_model->my_where("order_items","item_id,order_no,product_name,quantity,product_id",array("order_no" => $value['order_master_id']) );

					foreach ($items as $k => $val)
					{
						$item_info = $this->custom_model->my_where("product","product_name,product_image,seller_id,id,category",array("id" => $val['product_id']) );

						// echo "<pre>";
						// print_r($item_info);
						// die;

						$seller_id = $item_info[0]['seller_id'];
						$category = $item_info[0]['category'];

						$category_info = $this->custom_model->my_where("category","id,display_name",array("id" => @$category) );
						if ($category_info)
						{
							$item_info[0]['category_name'] = $category_info[0]['display_name']; 
						}
						else
						{
							$item_info[0]['category_name'] = '';
						}

						$item_info[0]['product_image'] = $this->get_product_path($item_info[0]['product_image']);
						$seller_info = $this->custom_model->my_where("admin_users","id,first_name",array("id" => @$seller_id) );
						@$item_info[0]['seller_name'] = $seller_info[0]['first_name'];
						@$data[$key]['items'][$k] = array_merge($val,$item_info[0]);

						$items_extra_data = $this->custom_model->my_where('items_extra_data','*',array('item_id' => $val['item_id']));
						if(!empty($items_extra_data))
						{
							$data[$k]['pro_custdata']=$items_extra_data;
							$pcus_price=0;
							if(!empty($data[$k]['pro_custdata']))
							{
								foreach ($data[$k]['pro_custdata'] as $pc_key => $pc_val) 
								{
									$pcus_price=$pcus_price+$pc_val['price'];
								}
								$data[$k]['pcus_price']=$pcus_price;	
							}else{
								$data[$k]['pcus_price']=$pcus_price;
							}					
						}						
					}				
				}
				echo json_encode( array("status" => true,"ws" => $ws ,"data" => $data,"message" => ($language == 'ar'? 'بنجاح':'Successfully')));die;
			}
			else
			{
				echo json_encode( array("status" => false,"ws" => $ws ,"data" => $data,"message" =>  ($language == 'ar'? 'لم يتم العثور على أي طلب':'No order found') ) );die;	
			}
		}
   	}



   	public function insert_user_rating()
	{
		$json = file_get_contents('php://input');
		// $json 		= '{"product_id":"2","comment":"comment","rating":"2"}';
		$jsonobj 	= json_decode($json);
		$rating 	= @$jsonobj->rating;
		$pid 		= @$jsonobj->product_id;
		$comment 	= @$jsonobj->comment;
		$language 	= @$jsonobj->language;
		$language 	= empty($language)? 'en':$language;
		$ws 		= @$jsonobj->ws;
		$ws 		= empty($ws)? 'insert_user_rating':$ws;
		// $user_id = 1;

		$user_id = $this->validate_token($language,$ws);
   	 	$response = array();

   	 	if (empty($user_id))
   	 	{
   	 		echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'الطلب غير ساري المفعول':'Invalid request') ) );die;
   	 	}
		
   	 	$data = array();
		$data['rating'] = $rating;
		$data['comment'] = $comment;
		$data['pid'] = $pid;
		$data['uid'] = $user_id;
		$data['status'] = 'active';
		date_default_timezone_set('Asia/Kolkata');
        $created_date = date("Y/m/d h:i:s");
		$data['created_date'] = $created_date;

		$this->custom_model->my_insert($data, 'user_rating');
		$user_review = $this->custom_model->my_where("user_rating","*",array('pid' => $data['pid'], 'status' => 'active') );
		if (!empty($user_review))
		{
			$avg = 0;
			foreach ($user_review as $key => $value)
			{
				$avg += $value['rating'];
			}
			$response['rating'] = round($avg/count($user_review));
			$response['rating_user_count'] = count($user_review);
		}

		// $update['rating'] = $response['rating'];
		// $update['reviews'] = $response['user_count'];
		// $this->custom_model->my_update($update,array('id' => $data['pid']),'product');

		echo json_encode( array("status" => true,"message" => ($language == 'ar'? 'تمت إضافة تعليقك بنجاح ....':'Your review added successfully....')) );die;
   	}

   	public function this_product_data($pid,$language = 'en')
	{
		$curr = $this->custom_model->my_where('product','*',array('id'=>$pid));
		$shipping = 0;
		$deliveryin = 1;
		if (empty($curr))
		{
			return false;
		}

		$curr1 = $this->custom_model->my_where('admin_users','first_name as vendor_name',array('id'=>$curr[0]['seller_id']));
	
		$curr1[0]['shipping'] = $shipping;
		
	 		if ($language != 'en')
	 		{
	 			$res = $this->custom_model->my_where("product_trans","*",array('id' => $curr[0]['id']) );
	 			if (!empty($res))
	 			{
	   	 			$curr[0]['product_name'] = $res[0]['product_name'];
	   	 			$curr[0]['description'] = $res[0]['description'];
	   	 			// $curr[0]['product_brand'] = $res[0]['product_brand'];
	 			}

	 			$res1 = $this->custom_model->my_where("admin_users","first_name as vendor_name",array('id' => $curr[0]['seller_id']) );
	 			if (!empty($res1))
	 			{
	   	 			$curr1[0]['vendor_name'] = $res1[0]['vendor_name'];
	 			}
	 		}

	 		unset($curr[0]['delivery_returns']);
	 		unset($curr[0]['description']);
			unset($curr[0]['user_like']);
			unset($curr[0]['product_code']);
			unset($curr[0]['created_date']);

			$curr[0]['product_image'] = $this->get_product_path($curr[0]['product_image']);
			$curr[0]['slug'] = $curr1[0]['vendor_name'];
			
		return array('curr' => $curr[0], 'curr1' => $curr1[0]);
   	}



   	public function get_product_path($image)
	{
		if (!empty($image))
		{
			$str = base_url().'assets/admin/products/'.$image;
			return $str;
		}
   	}
   	

   	public function fcm_update()
	{
		$json = file_get_contents('php://input');
		// $user_id = 1;		
		// $json 		= '{"fcm_no":"asdasdasdasdasdasdasdweqw"}';
		
		$jsonobj 		= json_decode($json);
		$fcm_no 		= @$jsonobj->fcm_no;
		$language 		= @$jsonobj->language;

		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'fcm_update':$ws;

		$user_id = $this->validate_token($language , $ws);

   	 	if (!empty($user_id))
   	 	{
			$user_check = $this->custom_model->my_where("admin_users","*",array("id =" => $user_id),array(),"","","","", array(), "",array(),false  );

			if (empty($user_check))
			{
				echo json_encode( array("status" => false , "ws" => $ws ,"message" => ($language == 'ar'? 'لم يتم العثور على أي طلب':'User not found')));die;
			}

			$additional_data = $response = array();

			if(!empty($fcm_no)) $additional_data['fcm_no'] 		= $fcm_no;

	        $result = $this->custom_model->my_update($additional_data,array("id" => $user_id),"admin_users");
	        
			$response["message"] = ($language == 'ar'? '':'Firebase key updated successfully.');
			$response["status"] = true;
			$response["ws"] = $ws;
			echo json_encode( $response );die;
   	 	}
		else
		{
			echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'الطلب غير ساري المفعول':'Invalid request') ) );die;
		}
   	}


   	public function logout()
	{
		$json = file_get_contents('php://input');
		// $user_id = 1;		
		// $json 		= '{}';
		
		$jsonobj 		= json_decode($json);
		$token 			= @$jsonobj->token;
		$language 		= @$jsonobj->language;

		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'logout':$ws;

		$user_id = $this->validate_token($language , $ws);

   	 	if (!empty($user_id))
   	 	{
			$user_check = $this->custom_model->my_where("admin_users","*",array("id =" => $user_id),array(),"","","","", array(), "",array(),false  );
			if (empty($user_check))
			{
				echo json_encode( array("status" => false , "ws" => $ws ,"message" => ($language == 'ar'? 'لم يتم العثور على أي طلب':'User not found')));die;
			}

			$additional_data = $response = array();

			$additional_data['token'] 		= '';
			$additional_data['fcm_no'] 		= '';

	        $result = $this->custom_model->my_update($additional_data,array("id" => $user_id),"admin_users");
	        
			$response["message"] = ($language == 'ar'? 'تسجيل الخروج بنجاح':'Logout successfully.');
			$response["status"] = true;
			$response["ws"] = $ws;
			echo json_encode( $response );die;
   	 	}
		else
		{
			echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? 'الطلب غير ساري المفعول':'Invalid request') ) );die;
		}
   	}


   	public function get_banner_path($image)
	{
		if (!empty($image))
		{
			$str = base_url().'assets/frontend/images/'.$image;
			return $str;
		}
   	}

   	public function upload_image()
   	{
   		$uid = 0;
        $language = 'en';
        $ws = 'upload_image';
   		$uid = $this->validate_token($language,$ws);

    	/*	$id = uniqid();
    	$req_dump = "<br/>---------".$id."---------<br/>".print_r( $_REQUEST, true );
    	file_put_contents( 'logs/'.$id.'_request.log', $req_dump );
    	$ser_dump = "<br/>---------".$id."---------<br/>".print_r( $_SERVER, true );
    	file_put_contents( 'logs/'.$id.'_server.log', $ser_dump );
    	$file_dump = "<br/>---------".$id."---------<br/>".file_get_contents( 'php://input' );
    	file_put_contents( 'logs/'.$id.'_file.log', $file_dump );
    	$fil_dump = "<br/>---------".$id."---------<br/>".print_r( $_FILES, true );
    	file_put_contents( 'logs/'.$id.'_fil.log', $fil_dump );*/
    	
   	    //$image_type = $_POST['image_type'];
   	    
   	    $FILES = @$_FILES['club_image'];
    	if(!empty($FILES)){
    				if(isset($FILES["type"]))
    				{
    					$details = array( "caption" => "My Logo", "action" => "fiu_upload_file", "path" => "admin/usersdata/" );
    					$path = $details['path'];
    					$upload_dir =  ASSETS_PATH.$path;
    					if (!file_exists($upload_dir)) {
    						mkdir($upload_dir, 0777, true);
    					}
    					$newFileName = md5(time());
    					$target_file = $upload_dir . basename($FILES["name"]);
    					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    					$newFileName = $newFileName.".".$imageFileType;
    					$target_file = $upload_dir.$newFileName;

    					list($width, $height, $type, $attr)= getimagesize($FILES["tmp_name"]);
    					$type1 = $FILES['type'];  

    					if ( ( ($imageFileType == "gif") || ($imageFileType == "jpeg") || ($imageFileType == "jpg") || ($imageFileType == "png") ) )
    					{ 

    						if (move_uploaded_file($FILES["tmp_name"], $target_file)) 
    						{
    							$post_data = array('name' => $newFileName,
    												'path' => $path,
													'note' => 'user,app',
    												'user_id' => $uid);
    							// $img_id = $this->custom_model->my_insert($post_data,'image_master');

    							$update_p['logo'] = $newFileName;
								$this->custom_model->my_update($update_p,array('id' => $uid),'admin_users');

								// echo $this->db->last_query();
								// die;


    							echo json_encode( array( "status" => true,"data" => $newFileName, "url" => base_url("assets/admin/usersdata/").$newFileName ) );die;
    						}
    						else
    						{
    							echo json_encode( array( "status" => false,"data" => ($language == 'ar'? 'حاول مرة اخرى.':'Please try again.') ) );die;
    						}
    					}
    					else
    					{ 
    						echo json_encode( array( "status" => false,"data" => ($language == 'ar'? 'الرجاء تحميل صورة صالحة.':'Please upload valid image.') ) );die;
    					}
    				}
    	}else{
    		echo json_encode( array( "status" => false,"data" => ($language == 'ar'? 'الرجاء تحميل صورة صالحة.':'Please upload valid image.') ) );die;
    	}	    
   	}


   	public function get_category_path($image)
	{
		if (!empty($image))
		{
			$str = base_url().'assets/admin/category/'.$image;
			return $str;
		}
   	}

    public function get_profile_path($image)
	{
		if (!empty($image))
		{
			$str = base_url().'assets/admin/usersdata/'.$image;
			return $str;
		}
   	}


	public function validate_token($language = 'en',$ws='')
	{
		$uid = 0;
		$token = $this->getBearerToken();
		// print_r($token); die;
   	    $Jwt_client = new Jwt_client();
   	    $token = $Jwt_client->decode($token);
   	    if($token){
   	       if(@$token['api_key'] != $this->token_id ){
   	       		$uid = $this->check_user_login($language,$ws);
   	       }
   	    }else{
   	        $uid = $this->check_user_login($language,$ws);
   	    }

   	    return $uid;
   	}

   	public function check_user_login($language = 'en',$ws)
	{
		$token1 = $this->getBearerToken();
	    $Jwt_client = new Jwt_client(); 
	    $token = $Jwt_client->decode($token1);

	    if($token)
	    {
	    	$aData = array();
	    	$id = @$token['id'];
	    	$password = @$token['password'];
	    	// $this->logout();
	    	$logged_in = $this->custom_model->my_where('admin_users','password,token',array('id'=>$id),array(),"","","","", array(), "",array(),false );
	    	
	    	if (!empty($logged_in))
   	 		{
   	 			if(password_verify ( $password ,$logged_in[0]['password'] ))
				{
					if ($logged_in[0]['token'] == $token1) {
						return $id;
					}
				}
				elseif ($password == $logged_in[0]['password'] )
				{
				    if ($logged_in[0]['token'] == $token1) {
						return $id;
					}
				}
   	 		}
   	 	}

   	 	echo json_encode( array("status" => false,"message" => ($language == 'ar'? "مصادقة غير صالحة.":'Invalid authentication.' ),  "language"=> $language , "ws" => $ws ) );die;
   	}

	/** 
	 * Get hearder Authorization
	 * */

	function getAuthorizationHeader()
	{
	        $headers = null;
	        if (isset($_SERVER['Token'])) {
	            $headers = trim($_SERVER["Token"]);
	        }
	        else if (isset($_SERVER['HTTP_TOKEN'])) { //Nginx or fast CGI
	            $headers = trim($_SERVER["HTTP_TOKEN"]);
	        } elseif (function_exists('apache_request_headers')) {
	            $requestHeaders = apache_request_headers();
	            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
	            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
	            if (isset($requestHeaders['Token'])) {
	                $headers = trim($requestHeaders['Token']);
	            }
	        }
	        return $headers;
	}


	/**
	 * get access token from header
	 * */
	function getBearerToken() {
	   $headers = $this->getAuthorizationHeader();
	    // HEADER: Get the access token from the header
	    if (!empty($headers)) {
	        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
	            return trim($matches[1]);
	        }
	    }
	    return null;
	}



	public function email_send()
	{
		$result = array();
		// Pass the customer's authorisation code, email and amount

		$emails = 'girishbhumkar5@gmail.com';
		$subject = 'Subject';
		$message = 'Subject';

		$postdata =  array (
						  'sender' => 
						  array (
						    'name' => 'ADZ Pizza',
						    'email' => 'girish@persausive.in',
						  ),
						  'to' => 
						  array (
						    0 => 
						    array (
						      'email' => $emails,
						      'name' => 'Girish Bhumkar',
						    ),
						  ),
						  'subject' => $subject,
						  'htmlContent' => $message,
						  'headers' => 
						  array (
						    'X-Mailin-custom' => 'custom_header_1:custom_value_1|custom_header_2:custom_value_2|custom_header_3:custom_value_3',
						    'charset' => 'iso-8859-1',
						  ),
						);


		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://api.sendinblue.com/v3/smtp/email");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($postdata));  //Post Fields
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$headers = [
		'api-key: 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',
		'Content-Type: application/json',
		'accept: application/json',
		'Postman-Token: f161f461-9f42-1728-f459-68f1d77e88e5',
		];

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$request = curl_exec ($ch);
		// echo $request;
		if(curl_error($ch)){
			echo 'error:' . curl_error($ch);
		}

		curl_close ($ch);
		if ($request) {
			$result = json_decode($request, true);
		}

		// echo "<pre>";
		// print_r($result);
		// die;
	}
}