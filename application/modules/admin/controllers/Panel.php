<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Admin Panel management, includes:
 *    - Admin Users CRUD
 *    - Admin User Groups CRUD
 *    - Admin User Reset Password
 *    - Account Settings (for login user)
 */
class Panel extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_builder');
        $this->load->model('custom_model');
    }

    public function index()
    {
        $crud = $this->generate_crud('admin_users');

        $crud->columns('id', 'first_name', 'phone', 'email');

        // $this->unset_crud_fields('ip_address', 'last_login');
        //$crud->set_relation('country_code', 'country', 'name', 'phonecode');
        $crud->set_theme('datatables');
        //$crud->display_as('country_code','Country');

        // only webmaster and admin can change member groups
        if ($crud->getState() == 'list' || $this->ion_auth->in_group(array('webmaster', 'admin'))) {
            //$crud->set_relation_n_n('groups', 'users_groups', 'groups', 'user_id', 'group_id', 'name');
        }

        // only webmaster and admin can reset user password
        if ($this->ion_auth->in_group(array('webmaster', 'admin'))) {
            //	$crud->add_action('refresh', '', 'admin/user/reset_password', 'fa fa-repeat');
        }

        // disable direct create / delete Frontend User

        $crud->where('group_id', '9');
        $crud->unset_add();
        $crud->unset_delete();
        $crud->unset_edit();
        $crud->unset_operations();

        $crud->order_by('id', 'desc');
        $crud->add_action('remove_red_eye', '', 'admin/panel/admin_user_reset_password', '');

        $this->mPageTitle = 'Partner List';
        $this->render_crud();
    }

    public function account()
    {
        $language = $this->uri->segment(1);
        if ($language == 'en') {
            $err_msg1 = 'Account Settings';
        } else {
            $err_msg1 = 'عدادت الحساب';
        }
        // Update Info form
        $form1 = $this->form_builder->create_form($this->mModule . '/panel/account_update_info', '', 'id="account_pro_update"');
        $form1->set_rule_group('panel/account_update_info');
        $this->mViewData['form1'] = $form1;

        // Change Password form
        $form2 = $this->form_builder->create_form($language . '/' . $this->mModule . '/panel/account_change_password', '', 'id="account_pro_pass"');
        $form1->set_rule_group('panel/account_change_password');
        $this->mViewData['form2'] = $form2;

        // $admin_users = $this->custom_model->my_where('admin_users','id,logo',array('id' => $this->mUser->id));
        // echo "<pre>";
        // print_r($admin_users);
        // die;
        $bank_details = $this->custom_model->get_data_array("SELECT * FROM bank_details Order by bank_name asc ");
        $city_list = $this->custom_model->get_data_array("SELECT * FROM city_list Order by city_name asc ");
        $state_list = $this->custom_model->get_data_array("SELECT * FROM state_list Order by state_name asc ");
        $postal_code_list = $this->custom_model->get_data_array("SELECT * FROM postal_code_list Order by id desc ");

        // $this->mViewData['admin_users'] = $admin_users;
        $this->mViewData['bank_details'] = $bank_details;
        $this->mViewData['city_list'] = $city_list;
        $this->mViewData['state_list'] = $state_list;
        $this->mViewData['postal_code_list'] = $postal_code_list;
        $this->mPageTitle = $err_msg1;
        $this->render('panel/account');
    }

    public function account_update_info()
    {
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            // echo $this->mUser->id; die;
            // echo "<pre>";
            // print_r($this->mUser);
            // die;
            $update_data = array();


            if ($this->mUser->type != '') {
                //this for supplier
                $is_username = $this->custom_model->my_where('admin_users', "*", array("username" => $post_data['username'], 'id!=' => $this->mUser->id));
                if (!empty($is_username)) {
                    echo "cr_number";
                    die;
                }

                if (isset($post_data['phone'])) {
                    $is_phone = $this->custom_model->my_where('admin_users', "*", array("phone" => $post_data['phone'], 'id!=' => $this->mUser->id));
                    if (!empty($is_phone)) {
                        echo "phone";
                        die;
                    }
                }

                if (isset($post_data['phone'])) {
                    $is_email = $this->custom_model->my_where('admin_users', "*", array("email" => $post_data['email'], 'id!=' => $this->mUser->id));
                    if (!empty($is_email)) {
                        echo "email";
                        die;
                    }
                }


                if (!empty($post_data['first_name'])) $update_data['first_name'] = $post_data['first_name'];
                if (!empty($post_data['entity_name'])) $update_data['entity_name'] = $post_data['entity_name'];

                if (!empty($post_data['username'])) $update_data['username'] = $post_data['username'];

                if (!empty($post_data['street_name'])) $update_data['street_name'] = $post_data['street_name'];

                if (!empty($post_data['building_no'])) $update_data['building_no'] = $post_data['building_no'];

                if (!empty($post_data['city'])) $update_data['city'] = $post_data['city'];

                if (!empty($post_data['state'])) $update_data['state'] = $post_data['state'];

                if (!empty($post_data['postal_code'])) $update_data['postal_code'] = $post_data['postal_code'];

                // if(!empty($post_data['country'])) $update_data['country'] 	= $post_data['country'];

                if (!empty($post_data['phone'])) $update_data['phone'] = $post_data['phone'];

                if (!empty($post_data['email'])) $update_data['email'] = $post_data['email'];

                if (!empty($post_data['vat_number'])) $update_data['vat_number'] = $post_data['vat_number'];

                if (!empty($post_data['bank_name'])) $update_data['bank_name'] = $post_data['bank_name'];

                if (!empty($post_data['iban'])) $update_data['iban'] = $post_data['iban'];
            } else {
                $is_username = $this->custom_model->my_where('admin_users', "*", array("username" => $post_data['username'], 'id!=' => $this->mUser->id));
                if (!empty($is_username)) {
                    echo "username";
                    die;
                }

                if (!empty($post_data['username'])) $update_data['username'] = $post_data['username'];
                if (!empty($post_data['username'])) $update_data['email'] = $post_data['username'];
                if (!empty($post_data['first_name'])) $update_data['first_name'] = $post_data['first_name'];
                if (!empty($post_data['last_name'])) $update_data['last_name'] = $post_data['last_name'];

            }

            $response = $this->custom_model->my_update($update_data, array('id' => $this->mUser->id), 'admin_users');
            if ($response) {
                echo "success";
                die;
            } else {
                echo "something";
                die;
            }
        }
    }


    // Submission of Change Password form
    public function account_change_password()
    {
        $new_password = $this->input->post('new_password');
        $retype_password = $this->input->post('retype_password');
        $language = $this->uri->segment(1);
        if ($new_password != $retype_password) {
            if ($language == 'en') {
                $this->system_message->set_error("Password does not match!");
            } else {
                $this->system_message->set_error("كلمة المرور غير متطابقة!");
            }

        } else {
            $data = array('password' => $this->input->post('new_password'));
            if (!empty($new_password) && !empty($retype_password)) {
                if ($this->ion_auth->update($this->mUser->id, $data)) {
                    if ($language == 'en') {
                        $messages = 'Account password successfully updated';
                    } else {
                        $messages = 'تم تحديث كلمة مرور الحساب بنجاح';
                    }
                    // $messages = $this->ion_auth->messages();
                    $this->system_message->set_success($messages);
                } else {
                    $errors = $this->ion_auth->errors();
                    $this->system_message->set_error($errors);
                }
            } else {
                if ($language == 'en') {
                    $this->system_message->set_error('All fields are required');
                } else {
                    $this->system_message->set_error('ل الحقول مطلوبة');
                }
            }
        }


        redirect($language . '/' . $this->mModule . '/panel/account');
    }

    public function create_sub_seller($euid = '')
    {
        $language = $this->uri->segment(1);
        if ($language == 'en') {
            $err_msg1 = 'Account Settings';
        } else {
            $err_msg1 = 'عدادت الحساب';
        }

        $post_data = $this->input->post();
        if (!empty($post_data)) {
            if (isset($post_data['first_name']) && isset($post_data['username']) && isset($post_data['street_name']) && isset($post_data['building_no']) && isset($post_data['city']) && isset($post_data['state']) && isset($post_data['postal_code']) && isset($post_data['phone']) && isset($post_data['email']) && isset($post_data['new_password']) && isset($post_data['access_permission']) && isset($post_data['active'])) {

                if (!empty($post_data['first_name']) && !empty($post_data['username']) && !empty($post_data['street_name']) && !empty($post_data['building_no']) && !empty($post_data['city']) && !empty($post_data['state']) && !empty($post_data['postal_code']) && !empty($post_data['phone']) && !empty($post_data['email']) && !empty($post_data['access_permission'])) {
                    // && !empty($post_data['new_password'])
                    // echo $this->mUser->id; die;
                    // echo "<pre>";
                    // print_r($post_data);
                    // print_r($_FILES);
                    // die;
                    $update_data = array();
                    //this for supplier
                    if (empty($euid)) {
                        $is_username = $this->custom_model->my_where('admin_users', "*", array("username" => $post_data['username']));
                    } else {
                        $is_username = $this->custom_model->my_where('admin_users', "*", array("username" => $post_data['username'], 'id!=' => $euid));
                    }
                    if (!empty($is_username)) {
                        echo json_encode(array("status" => false, "message" => ($language == 'ar' ? 'قم السجل التجاري مسجل!' : 'CR number already exist !'), "flag" => "cr_number"));
                        die;
                    }

                    if (empty($euid)) {
                        $is_phone = $this->custom_model->my_where('admin_users', "*", array("phone" => $post_data['phone']));
                    } else {
                        $is_phone = $this->custom_model->my_where('admin_users', "*", array("phone" => $post_data['phone'], 'id!=' => $euid));
                    }
                    if (!empty($is_phone)) {
                        echo json_encode(array("status" => false, "message" => ($language == 'ar' ? 'رقم الهاتف المحمول مسجل!' : 'Mobile number already exist !'), "flag" => "phone"));
                        die;
                    }


                    if (empty($euid)) {
                        $is_email = $this->custom_model->my_where('admin_users', "*", array("email" => $post_data['email']));
                    } else {
                        $is_email = $this->custom_model->my_where('admin_users', "*", array("email" => $post_data['email'], 'id!=' => $euid));
                    }
                    if (!empty($is_email)) {
                        echo json_encode(array("status" => false, "message" => ($language == 'ar' ? 'البريد الإلكتروني مسجل!' : 'Email already exist'), "flag" => "email"));
                        die;
                    }


                    if (!empty($post_data['new_password'])) $update_data['password'] = password_hash($post_data['new_password'], PASSWORD_BCRYPT);


                    if (!empty($post_data['first_name'])) $update_data['first_name'] = $post_data['first_name'];

                    if (!empty($post_data['username'])) $update_data['username'] = $post_data['username'];

                    if (!empty($post_data['street_name'])) $update_data['street_name'] = $post_data['street_name'];

                    if (!empty($post_data['building_no'])) $update_data['building_no'] = $post_data['building_no'];

                    if (!empty($post_data['city'])) $update_data['city'] = $post_data['city'];

                    if (!empty($post_data['state'])) $update_data['state'] = $post_data['state'];

                    if (!empty($post_data['postal_code'])) $update_data['postal_code'] = $post_data['postal_code'];

                    $update_data['country'] = 'Saudi Arabia';
                    $update_data['active'] = $post_data['active'];
                    $update_data['ip_address'] = $this->return_ip_address();
                    $update_data['is_email_verify'] = 1;

                    if (!empty($post_data['access_permission'])) {
                        foreach ($post_data['access_permission'] as $key => $val) {
                            if (!array_key_exists($val, $this->get_access_permission())) {
                                echo json_encode(array("status" => false, "message" => ($language == 'ar' ? 'Please Select Valid Access Permission' : 'Please Select Valid Access Permission'), "flag" => "email"));
                                die;
                            }
                            // else{
                            // }
                        }
                        $update_data['access_permission'] = implode(",", $post_data['access_permission']);

                    } else {
                        echo json_encode(array("status" => false, "message" => ($language == 'ar' ? 'Please Select Valid Access Permission' : 'Please Select Valid Access Permission'), "flag" => "email"));
                        die;
                    }

                    // echo "<pre>";
                    // print_r($post_data);
                    // print_r($update_data);
                    // die;
                    if (!empty($post_data['phone'])) $update_data['phone'] = $post_data['phone'];

                    if (!empty($post_data['email'])) $update_data['email'] = $post_data['email'];
                    if (isset($_FILES['logo']['name']) && $_FILES['logo']['name'] != '') {
                        @$FILES = $_FILES["logo"];
                        $folder_name = 'admin/usersdata/';
                        @$image_name = $this->uploads($FILES, $folder_name);
                        $update_data['logo'] = $image_name;
                    } else {
                        $update_data['logo'] = 'user_chat.png';
                    }

                    if (empty($euid)) {
                        $update_data['created_on'] = date("Y/m/d h:i:s");
                        $update_data['group_id'] = 10;
                        $update_data['type'] = 'subsupplier';
                        $update_data['social'] = 'normal';
                        $update_data['seller_id'] = $this->mUser->id;
                        $update_data['subs_start_date'] = $this->mUser->subs_start_date;
                        $update_data['subs_end_date'] = $this->mUser->subs_end_date;
                        $update_data['subs_status'] = $this->mUser->subs_status;

                        $response = $this->custom_model->my_insert($update_data, 'admin_users');
                        if ($response) {
                            $gorup_data['user_id'] = $response;
                            $gorup_data['group_id'] = 10;
                            $this->custom_model->my_insert($gorup_data, 'admin_users_groups');
                            echo json_encode(array("status" => true, "message" => ($language == 'ar' ? 'تم التسجيل بنجاح' : 'Successfully Register'), "flag" => "added"));
                            die;
                        } else {
                            echo json_encode(array("status" => false, "message" => ($language == 'ar' ? 'هناك خطأ ما' : 'Something went wrong'), "flag" => "something"));
                            die;
                        }
                    } else {
                        $response = $this->custom_model->my_update($update_data, array('id' => $euid, 'seller_id' => $this->mUser->id, 'type' => 'subsupplier'), 'admin_users');
                        if ($response) {
                            echo json_encode(array("status" => true, "message" => ($language == 'ar' ? 'تحديث الملف الشخصي بنجاح' : 'Profile updated successfully'), "flag" => "updated"));
                            die;
                        } else {
                            echo json_encode(array("status" => false, "message" => ($language == 'ar' ? 'هناك خطأ ما' : 'Something went wrong'), "flag" => "something"));
                            die;
                        }
                    }
                } else {
                    echo json_encode(array("status" => false, "message" => ($language == 'ar' ? 'كل الحقول مطلوبة' : 'All fields are required'), "flag" => "all_fild_required"));
                    die;
                }
            } else {
                echo json_encode(array("status" => false, "message" => ($language == 'ar' ? 'كل الحقول مطلوبة' : 'All fields are required'), "flag" => "all_fild_required"));
                die;
            }
        }
        $city_list = $this->custom_model->get_data_array("SELECT * FROM city_list Order by city_name asc ");
        $state_list = $this->custom_model->get_data_array("SELECT * FROM state_list Order by state_name asc ");
        $postal_code_list = $this->custom_model->get_data_array("SELECT * FROM postal_code_list Order by id desc ");
        $subsupplier_data = array();
        if (!empty($euid)) {
            $subsupplier_data = $this->custom_model->get_data_array("SELECT id,username,email,first_name,phone,logo,street_name,building_no,city,state,postal_code,country,access_permission,active FROM admin_users WHERE id='" . $euid . "' AND seller_id='" . $this->mUser->id . "' AND type='subsupplier' ");
        }

        // echo "<pre>";
        // print_r($subsupplier_data);
        // die;
        $this->mViewData['city_list'] = $city_list;
        $this->mViewData['state_list'] = $state_list;
        $this->mViewData['postal_code_list'] = $postal_code_list;
        $this->mViewData['euid'] = $euid;
        $this->mViewData['subsupplier_data'] = $subsupplier_data;
        $this->mViewData['permission_arr'] = $this->get_access_permission();
        $this->mPageTitle = $err_msg1;
        $this->render('panel/create_sub_seller');
    }


    // Admin User Groups CRUD

    public function uploads($FILES, $folder_name = '')
    {
        if (isset($FILES['name'])) {
            //$upload_dir = ASSETS_PATH . "/admin/category/";
            $upload_dir = ASSETS_PATH . $folder_name;
            // print_r($upload_dir);
            // die;
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $file_name = $FILES['name'];
            $random_digit = rand(0000, 9999);
            $target_file = $upload_dir . basename($FILES["name"]);
            $ext = pathinfo($target_file, PATHINFO_EXTENSION);

            $new_file_name = $random_digit . "." . $ext;
            $path = $upload_dir . $new_file_name;

            if (move_uploaded_file($FILES['tmp_name'], $path)) {
                return $new_file_name;
            } else {
                return false;
            }
        } else {
            return false;

        }
    }

    public function admin_user_group()
    {
        $crud = $this->generate_crud('admin_groups');
        $crud->set_theme('datatables');
        $this->mPageTitle = 'Admin User Groups';
        $this->render_crud();
    }

    /**
     * Logout user
     */
    public function logout()
    {
        if ($this->session->userdata('group_id') == 5) {
            redirect($this->mLanguage . '/login/logout');
        } else {
            $this->ion_auth->logout();
            redirect($this->mLanguage . '/' . $this->mConfig['login_url']);
        }
    }

    public function delete($id)
    {
        $this->custom_model->my_delete(array("id" => $id), "admin_users", false);
        $this->custom_model->my_delete(array("id" => $id), "admin_users_trans", false);
        header("Location: " . base_url() . "admin/panel/vendor_user");
        die;
    }

    public function upload_logo()
    {
        if (!empty($this->mUser->id)) {
            if (isset($_FILES) and $_FILES['logo']['name'] != '') {
                @$FILES = $_FILES["logo"];
                $folder_name = 'admin/usersdata/';
                @$image_name = $this->uploads($FILES, $folder_name);
                $this->custom_model->my_update(array('logo' => $image_name), array('id' => $this->mUser->id), 'admin_users');
                echo 1;
                die;
            } else {
                echo 2;
                die;
            }
        }
        echo 0;
        die;
    }

    public function supplier_sub()
    {
        $language = $this->uri->segment(1);
        if ($language == 'en') {
            $err_msg1 = 'Subscribtion';
        } else {
            $err_msg1 = 'الاشتراك';
        }
        $rowno = 0;
        $ajax = 'call';
        $serach = '';
        // $users_data = $this->custom_model->my_where('admin_users','*',array('id!=' =>'1'));

        $this->load->library('pagination');

        $post_data = $this->input->post();

        if (!empty($post_data)) {
            $rowno = $post_data['pagno'];
            $ajax = $post_data['ajax'];
            $serach = $post_data['serach'];
        }
        // Row per page
        $rowperpage = 30;
        $page_no = 0;
        $seller_id = $this->mUser->id;

        if ($this->mUser->id != 1) {
            $subq = " WHERE user_id='$seller_id'";
            $subq2 = " AND  user_id='$seller_id'";
        } else {
            $subq = "";
            $subq2 = "";
        }

        // Row position
        if ($rowno != 0) {
            $page_no = $rowno;
            $rowno = ($rowno - 1) * $rowperpage;
        }
        if ($ajax == 'call') {
            $trans_data = $this->custom_model->get_data_array("SELECT * FROM transaction_details $subq  Order BY id DESC limit $rowno,$rowperpage ");

            $trans_count = $this->custom_model->get_data_array("SELECT count(id) as trans_count FROM transaction_details $subq   Order BY id DESC ");
            // $users_data = $this->custom_model->get_data_array(" SELECT admin.subs_status,trans.track_id,trans.paymentid,trans.errorText,trans.currency,trans.amount,trans.payment_status,trans.subs_start_date,trans.subs_end_date,trans.id,trans.created_date FROM admin_users as admin LEFT JOIN transaction_details as trans ON admin.id = trans.user_id  WHERE admin.id='$seller_id' Order BY trans.id DESC limit $rowno,$rowperpage ");
            // $users_count = $this->custom_model->get_data_array("SELECT admin.id as supplier_id FROM admin_users as admin LEFT JOIN transaction_details as trans ON admin.id = trans.user_id WHERE admin.id='$seller_id' Order BY trans.id DESC  ");
            // echo '<pre>';
            // print_r($users_data);
            // die;
        } else {
            if (empty($serach)) {
                $trans_data = $this->custom_model->get_data_array("SELECT * FROM transaction_details $subq  Order BY id DESC limit $rowno,$rowperpage ");

                $trans_count = $this->custom_model->get_data_array("SELECT count(id) as trans_count FROM transaction_details $subq  Order BY id DESC ");
            } else {

                $trans_data = $this->custom_model->get_data_array("SELECT * FROM transaction_details  WHERE (track_id LIKE '%$serach%' OR `transId` LIKE '%$serach%' OR `payment_status` LIKE '%$serach%' OR `subs_start_date` LIKE '%$serach%' OR `subs_end_date` LIKE '%$serach%' ) $subq2  Order BY id DESC limit $rowno,$rowperpage ");

                $trans_count = $this->custom_model->get_data_array("SELECT count(id) as trans_count FROM transaction_details  WHERE (track_id LIKE '%$serach%' OR `transId` LIKE '%$serach%' OR `payment_status` LIKE '%$serach%' OR `subs_start_date` LIKE '%$serach%' OR `subs_end_date` LIKE '%$serach%' ) $subq2  Order BY id DESC ");
            }
        }
        // if(!empty($users_data))
        // {
        // 	foreach ($users_data as $ud_key => $ud_val)
        // 	{
        // 		$user_id=$ud_val['id'];
        // 		$users_data[$ud_key]['created_on']=date("Y/m/d", strtotime($ud_val['created_on']));
        // 		$order_count = $this->custom_model->get_data_array("SELECT COUNT(item_id) as item_sell FROM order_items WHERE seller_id='$user_id' ");
        // 		$users_data[$ud_key]['order_count']=$order_count[0]['item_sell'];

        // 	}
        // }
        $users_data = $this->custom_model->my_where('admin_users', 'subs_status,', array('id=' => $seller_id));

        $config['base_url'] = base_url() . 'admin/users/supplier_list';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $trans_count[0]['trans_count'];
        $config['per_page'] = $rowperpage;
        $config['page_query_string'] = FALSE;
        $config['enable_query_strings'] = FALSE;
        $config['reuse_query_string'] = FALSE;
        $config['cur_page'] = $page_no;

        // Initialize
        $this->pagination->initialize($config);
        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $trans_data;
        $data['row'] = $rowno;
        $data['total_rows'] = $trans_count[0]['trans_count'];
        // $this->mViewData['pagination'] = $this->pagination->create_links();
        // this for when page load
        if ($ajax == 'call' && $rowno == 0 && empty($post_data)) {
            $this->mViewData['pagination'] = $this->pagination->create_links();
        } elseif ($serach != '') {  // this for search button pagination
            echo json_encode($data);
            exit;
        } else { // this for pagination-
            echo json_encode($data);
            exit;
        }
        // $users_data = $this->custom_model->get_data_array("SELECT * FROM admin_users WHERE id!='1' ORDER BY id desc ");
        // echo "<pre>";
        // print_r($trans_data);
        // die;
        $this->mPageTitle = $err_msg1;
        $this->mViewData['trans_data'] = $trans_data;
        $this->mViewData['users_data'] = $users_data;
        $this->mViewData['subq'] = $subq;
        // $this->mViewData['subs_status'] = $subs_status;
        $this->render('panel/supplier_sub/list');
    }

    public function sub_supplier_list()
    {
        $rowno = 0;
        $ajax = 'call';
        $serach = '';
        // $users_data = $this->custom_model->my_where('admin_users','*',array('id!=' =>'1'));

        $this->load->library('pagination');

        $post_data = $this->input->post();

        if (!empty($post_data)) {
            $rowno = $post_data['pagno'];
            $ajax = $post_data['ajax'];
            $serach = $post_data['serach'];
        }
        // Row per page
        $rowperpage = 25;
        $page_no = 0;

        $query = " seller_id='" . $this->mUser->id . "' AND type='subsupplier' ";


        // Row position
        if ($rowno != 0) {
            $page_no = $rowno;
            $rowno = ($rowno - 1) * $rowperpage;
        }

        if ($ajax == 'call') {
            $users_data = $this->custom_model->get_data_array("SELECT id,first_name,created_on,phone,username,email,active,access_permission  FROM admin_users WHERE $query   Order BY id ASC limit $rowno,$rowperpage ");

            $users_count = $this->custom_model->get_data_array("SELECT COUNT(id) as users_count FROM admin_users WHERE $query ");

        } else {
            if (empty($serach)) {
                $users_data = $this->custom_model->get_data_array("SELECT id,first_name,created_on,phone,username,email,active,access_permission  FROM admin_users WHERE  $query  Order BY id DESC limit $rowno,$rowperpage ");

                $users_count = $this->custom_model->get_data_array("SELECT COUNT(id) as users_count FROM admin_users WHERE $query ");
            } else {

                $users_data = $this->custom_model->get_data_array("SELECT id,first_name,created_on,phone,username,email,active,access_permission FROM admin_users WHERE (first_name LIKE '%$serach%' OR `created_on` LIKE '%$serach%' OR phone LIKE '%$serach%' OR username LIKE '%$serach%'  OR email LIKE '%$serach%') AND $query ORDER BY `id` DESC LIMIT $rowno,$rowperpage ");

                $users_count = $this->custom_model->get_data_array("SELECT COUNT(id) as users_count FROM admin_users WHERE (first_name LIKE '%$serach%' OR `created_on` LIKE '%$serach%' OR phone LIKE '%$serach%' OR username LIKE '%$serach%'  OR email LIKE '%$serach%') AND  $query  ORDER BY `id` DESC ");
            }
        }

        if (!empty($users_data)) {
            $permission_arr = $this->get_access_permission();
            foreach ($users_data as $ud_key => $ud_val) {
                $users_data[$ud_key]['created_on'] = date("Y/m/d", strtotime($ud_val['created_on']));
                $access_permission = '';
                if (!empty($ud_val['access_permission'])) {
                    $access_permission_arr = explode(',', $ud_val['access_permission']);
                    foreach ($access_permission_arr as $key => $val) {
                        $access_permission = $permission_arr[$val] . ',' . $access_permission;
                    }
                    $access_permission = trim($access_permission, ',');
                }
                $users_data[$ud_key]['access_permission'] = $access_permission;

                $order_count = $this->custom_model->get_data_array("SELECT COUNT(order_master_id) as order_count FROM order_master WHERE is_show='1' AND user_id='" . $ud_val['id'] . "' ");

                $users_data[$ud_key]['order_count'] = $order_count[0]['order_count'];

                // seller send quotation count
                $send_quotation_count = $this->custom_model->get_data_array("SELECT count(id) as send_quotation_count FROM `send_quotation` WHERE uid = '" . $ud_val['id'] . "' ");
                $users_data[$ud_key]['send_quotation_count'] = $send_quotation_count[0]['send_quotation_count'];
                $users_data[$ud_key]['uide'] = en_de_crypt($ud_val['id']);
            }
        }

        $config['base_url'] = base_url() . 'admin/users/supplier_list';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $users_count[0]['users_count'];
        $config['per_page'] = $rowperpage;
        $config['page_query_string'] = FALSE;
        $config['enable_query_strings'] = FALSE;
        $config['reuse_query_string'] = FALSE;
        $config['cur_page'] = $page_no;

        // Initialize
        $this->pagination->initialize($config);
        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $users_data;
        $data['row'] = $rowno;
        $data['total_rows'] = $users_count[0]['users_count'];
        // $this->mViewData['pagination'] = $this->pagination->create_links();
        // this for when page load
        if ($ajax == 'call' && $rowno == 0 && empty($post_data)) {
            $this->mViewData['pagination'] = $this->pagination->create_links();
        } elseif ($serach != '') {  // this for search button pagination
            echo json_encode($data);
            exit;
        } else { // this for pagination-
            echo json_encode($data);
            exit;
        }
        // $users_data = $this->custom_model->get_data_array("SELECT * FROM admin_users WHERE id!='1' ORDER BY id ASC ");
        // echo "<pre>";
        // print_r($users_data);
        // die;
        $this->mPageTitle = 'Supplier list';
        $this->mViewData['users_data'] = $users_data;
        $this->render('panel/sub_supplier_list');
    }

    public function subsupplier_detail($euid, $flag = '')
    {

        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $responce = $this->custom_model->my_update($post_data, array('id' => $euid, 'seller_id' => $this->mUser->id, 'type' => "subsupplier"), 'admin_users');
            echo 1;
            die;
        }
        $query = " seller_id='" . $this->mUser->id . "' AND type='subsupplier' ";
        $users_data = $this->custom_model->get_data_array("SELECT * FROM admin_users WHERE  id='$euid' AND type='subsupplier' AND  seller_id='" . $this->mUser->id . "' ");
        if (!empty($users_data)) {


            if ($users_data[0]['subs_status'] != 'expired') {
                $current_data = date('Y-m-d');
                $date1 = new DateTime($current_data);  //current date or any date
                $date2 = new DateTime($users_data[0]['subs_end_date']);   //Future date
                $diff = $date2->diff($date1)->format("%a");  //find difference
                $days = intval($diff);   //rounding days
                $users_data[0]['days_left'] = $days;
            } else {
                $users_data[0]['days_left'] = 0;
            }

            $order_count = $this->custom_model->get_data_array("SELECT COUNT(item_id) as item_sell FROM order_items WHERE seller_id='$euid' ");

            $users_data[0]['order_count'] = $order_count[0]['item_sell'];

            $bank_details = $this->custom_model->get_data_array("SELECT bank_name FROM bank_details WHERE id='" . $users_data[0]['bank_name'] . "' ");
            if (!empty($bank_details)) {
                $users_data[0]['bank_name'] = $bank_details[0]['bank_name'];
            }
        }

        // echo "<pre>";
        // print_r($users_data);
        // die;
        $this->mPageTitle = 'Sub Supplier Details';
        $this->mViewData['users_data'] = $users_data;
        $this->mViewData['flag'] = $flag;
        $this->render('panel/subsupplier_detail');
    }


}
