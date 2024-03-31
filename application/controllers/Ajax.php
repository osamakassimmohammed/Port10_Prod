<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Ajax
 */
class Ajax extends MY_Controller
{
    protected static ?Ajax $instance = null;

    public function __construct()
    {
        $this->load->model('admin/Custom_model', 'custom_model');
        parent::__construct();
        self::$instance = $this;
    }

    /**
     * @return self|null
     *
     * @noinspection PhpUnused
     */
    public static function getInstance(): ?self
    {
        if (self::$instance === null) {
            self::$instance = new Ajax();
        }

        return self::$instance;
    }

    public static function geolocation_address($lat = '', $long = '')
    {
        $post_data = self::getInstance()->input->post();
        // echo "<pre>";
        // print_r($post_data);
        // die();

        $lat = $post_data['lat'];
        $long = $post_data['lng'];

        $geocode = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$long&sensor=false&key=AIzaSyAat9nw12i9GrQx0T7AJaiQ1Po-GzS7mlA";

        $ch = @curl_init();

        @curl_setopt($ch, CURLOPT_URL, $geocode);
        @curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        @curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        @curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        @curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $response = @curl_exec($ch);

        @curl_close($ch);

        $output = json_decode($response);
        $data_arr = get_object_vars($output);

        if ($data_arr['status'] != 'ZERO_RESULTS' && $data_arr['status'] != 'INVALID_REQUEST') {
            if (isset($data_arr['results'][0]->formatted_address)) {

                $address = $data_arr['results'][0]->formatted_address;

                echo $address;
                die();

            } else {
                $address = 'Not Found';

            }
        } else {
            $address = 'Not Found';
        }
    }

    public function shipping_rate()
    {
        $language = $this->uri->segments[1];
        $post_arr = $this->input->post();
        $uid = $this->session->userdata('uid');
        $product = null;

        if (empty($uid)) {
            echo json_encode(array("status" => false, "message" => ($language == 'ar' ? 'لرجاء الدخول لإنشاء حساب' : 'Please Login Or Create Account!!'), "flag" => "login_message"));
            die();
        }

        if (!empty($post_arr)) {
            if (isset($post_arr['first_name']) && isset($post_arr['last_name']) && isset($post_arr['payment_mode']) && isset($post_arr['mobile_no']) && isset($post_arr['email']) && isset($post_arr['address_1']) && isset($post_arr['country']) && isset($post_arr['city']) && isset($post_arr['state']) && isset($post_arr['pincode']) && isset($post_arr['google_address']) && isset($post_arr['lat']) && isset($post_arr['lng'])) {
                $send_data = array();
                $send_data['first_name'] = trim($post_arr['first_name']);
                $send_data['last_name'] = trim($post_arr['last_name']);
                $send_data['payment_mode'] = trim($post_arr['payment_mode']);
                $send_data['mobile_no'] = trim($post_arr['mobile_no']);
                $send_data['email'] = trim($post_arr['email']);
                $send_data['address_1'] = trim($post_arr['address_1']);
                $send_data['country'] = trim($post_arr['country']);
                $send_data['city'] = trim($post_arr['city']);
                $send_data['state'] = trim($post_arr['state']);
                $send_data['pincode'] = trim($post_arr['pincode']);
                $send_data['google_address'] = trim($post_arr['google_address']);
                $send_data['lat'] = trim($post_arr['lat']);
                $send_data['lng'] = trim($post_arr['lng']);

                if (!empty($send_data['first_name']) && !empty($send_data['last_name']) && !empty($send_data['payment_mode']) && !empty($send_data['mobile_no']) && !empty($send_data['email']) && !empty($send_data['address_1']) && !empty($send_data['country']) && !empty($send_data['city']) && !empty($send_data['state']) && !empty($send_data['pincode']) && !empty($send_data['pincode'])) {
                    if ($post_arr['flow_type'] == 'normal') {
                        $products = unserialize($this->session->userdata('content'));
                    } else if ($post_arr['flow_type'] == 'buynow') {
                        $products = $this->session->userdata('products');
                    } else if ($post_arr['flow_type'] == 'invoice') {
                        $in_id = $post_arr['in_id'];
                        $data = $this->custom_model->get_data_array("SELECT pro.id,pro.product_name,pro.product_image,pro.status,pro.stock,pro.stock_status,pro.price,pro.sale_price,pro.product_delete,pro.is_delivery_available,qoin.in_id,qoin.in_qty as quantity,qoin.in_unit,qoin.in_price,qoin.invoice_status FROM $product as pro INNER JOIN quotation_invoice as qoin ON pro.id=qoin.in_sku WHERE qoin.in_id='$in_id' AND qoin.uid='$uid' AND pro.product_delete=0 AND pro.status=1 ");

                        // if (!empty($data)) {
                        //     $unit_data = $this->custom_model->my_where($unit_list, 'id,unit_name', array('id' => $data[0]['in_unit']));
                        //     if (!empty($unit_data)) {
                        //         $data[0]['unit_name'] = $unit_data[0]['unit_name'];
                        //     }
                        // }

                        $this->load->library('user_account');
                        $data_res = $this->user_account->product_check($data, $flag = true, $is_other = true, $language);
                        if (!empty($post_arr) && $data_res['status'] == 1) {
                            $pid = $data_res['data'][0]['id'];
                            $qty = $data_res['data'][0]['quantity'];
                            $unit = $data_res['data'][0]['in_unit'];
                            $products = array(
                                array("pid" => $pid, "qty" => $qty, "metadata" => "", "comment" => "", "unit" => $unit)
                            );
                        } else {
                            echo json_encode(array("status" => $data_res['status'], "message" => $data_res['message'], "flag" => "",));
                            die();
                        }
                    }
                    if (empty($products)) {
                        // redirect($language);
                        echo json_encode(array("status" => false, "message" => ($language == 'ar' ? 'Your shopping cart is empty' : 'Your shopping cart is empty'), "flag" => "redirect", "url" => base_url($language . '/home/view_cart')));
                        die();
                    }
                    $this->load->library('shipping_lib');
                    $rate_info = $this->shipping_lib->get_shipping_rate($products, $send_data);
                    echo json_encode($rate_info);
                    die();
                    // echo "<pre>";
                    // print_r($rate_info);
                    // die();
                } else {
                    echo json_encode(array("status" => false, "message" => ($language == 'ar' ? 'All Field Required' : 'All Field Required'), "flag" => ""));
                    die();
                }
            } else {
                echo json_encode(array("status" => false, "message" => ($language == 'ar' ? 'All Field Required' : 'All Field Required'), "flag" => ""));
                die();
            }
        } else {
            echo json_encode(array("status" => false, "message" => ($language == 'ar' ? 'Something went wrong' : 'Something went wrong'), "flag" => ""));
            die();
        }
    }

    public function get_sub_cat()
    {
        $post_data = $this->input->post();

        if (!empty($post_data['id'])) {
            $id = $post_data['id'];

            $response = $this->custom_model->my_where("category", "*", array("parent" => $id));

            echo json_encode($response);
            // echo "<pre>";
            // print_r($response);
            // die();
        } else {
            echo 0;
        }
    }

    public function check_user_login()
    {
        $uid = $this->session->userdata('uid');
        if (!empty($uid)) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function search_main_cat_sub_cat()
    {
        $post_data = $this->input->post();

        $search_name = $post_data['string'];
        $country = $this->return_country_name();
        $response = $sub_cat_id = [];

        if (!empty($post_data)) {
            // echo "<pre>";
            // print_r($post_data);die();

            /*if (empty($search_name))
            {
                $get_data =  $this->custom_model->get_data_array("SELECT * FROM `product` WHERE `category` =  '$category_id'  AND `product_name` LIKE '%$search_name%' OR `tags` LIKE '%$search_name%' ORDER BY `id` DESC Limit 5 ");
            }*/

            if (!empty($search_name) and !empty($country)) {
                /** @noinspection SqlResolve */
                $get_data = $this->custom_model->get_data_array("SELECT * FROM `product` WHERE status =  '1' AND country_name = '$country' AND (`product_name` LIKE '%$search_name%' OR `tags` LIKE '%$search_name%' OR `price` LIKE '%$search_name%' OR `sale_price` LIKE '%$search_name%')");
            }

            if (!empty($get_data)) {
                foreach ($get_data as $key => $gvalue) {
                    $response[] = '<div  onclick="location.href=\'' . base_url('/home/detail/') . en_de_crypt($gvalue['id']) . '\'" class="point_me search_drop_down " >' . $gvalue['product_name'] . '</div>';
                }
            } else {
                $response[] = '<div  class="point_me search_drop_down " >No products Found ! </div>';
            }

            echo json_encode($response);
        } else {
            echo 0;
        }
    }

    public function search_category()
    {
        $post_data = $this->input->post();

        $search_name = $post_data['string'];
        // $category_id = $post_data['category_id'];
        $response = $sub_cat_id = array();

        if (!empty($post_data)) {
            // echo "<pre>";
            // print_r($post_data);die();

            /*if (empty($search_name))
            {
                $get_data =  $this->custom_model->get_data_array("SELECT * FROM `product` WHERE `category` =  '$category_id'  AND `product_name` LIKE '%$search_name%' OR `tags` LIKE '%$search_name%' ORDER BY `id` DESC Limit 5 ");
            }*/

            if (!empty($search_name)) {
                $get_data = $this->custom_model->get_data_array("SELECT * FROM `category` WHERE status =  'active'  AND (`display_name` LIKE '%$search_name%' ) ");
                // echo "<pre>";
                // print_r($get_data);
                // die();
            } else {
                $get_data = $this->custom_model->get_data_array("SELECT * FROM `category` WHERE status =  'active' ");
            }

            if (!empty($get_data)) {
                foreach ($get_data as $key => $gvalue) {
                    $cat_id = $gvalue['id'];
                    $subcat_id = $gvalue['parent'];
                    if ($gvalue['display_name'] != 'Order Now') {
                        if ($gvalue['parent'] == '0') {
                            $count = $this->custom_model->get_data_array("SELECT * FROM `product` WHERE category =  $cat_id ");

                            $response[] = '<li><a href="' . base_url('/home/listing/') . $gvalue['id'] . '">' . $gvalue['display_name'] . ' <span>(' . count($count) . ')</span></a></li>';

                        } else {

                            $count2 = $this->custom_model->get_data_array("SELECT * FROM `product` WHERE category = $subcat_id AND subcategory = $cat_id");

                            $response[] = '<li><a href="' . base_url('/home/order_now_all/') . $subcat_id . '/' . $cat_id . '">' . $gvalue['display_name'] . ' <span>(' . count($count2) . ')</span></a></li>';
                        }
                    }
                }
            } else {
                $response[] = '<li><a class="curser">No Record Found <span>(0)</span></a></li>';
            }

            echo json_encode($response);
        } else {
            echo 0;
        }
    }

    public function newsletter_insert()
    {
        $post_data = $this->input->post();

        // echo "<pre>";
        // print_r($post_data);
        // die();

        if (!empty($post_data)) {
            $response = $this->custom_model->my_where("newsletter", "*", array("email" => $post_data['sub_email']));

            if (empty($response)) {
                $data['created_date'] = date("Y-m-d h:i:s");
                $data['email'] = trim($post_data['sub_email']);
                $qu = $this->custom_model->my_insert($data, 'newsletter');
                echo "success";
                die();
            } else {
                echo "email";
                die();
            }
        } else {
            echo 0;
        }
    }

    public function newsletter_demo()
    {
        $post_data = $this->input->post();

        // echo "<pre>";
        // print_r($post_data);
        // die();

        if (!empty($post_data)) {
            $response = $this->custom_model->my_where("newsletter", "*", array("email" => $post_data['sub_email']));

            if (empty($response)) {
                $data['created_date'] = date("Y-m-d h:i:s");
                $data['email'] = trim($post_data['sub_email']);
                $qu = $this->custom_model->my_insert($data, 'newsletter');
                echo "success";
                die();
            } else {
                echo "email";
                die();
            }
        } else {
            echo 0;
        }
    }

    public function rating_insert()
    {
        $post_data = $this->input->post();
        $uid = $this->session->userdata('uid');

        if (!empty($post_data)) {
            if (empty($uid)) {
                echo "pleas_login";
                die();
            }

            $pid = en_de_crypt($post_data['pid'], 'd');
            $is_buy = $this->custom_model->my_where('order_items', 'item_id', array('product_id' => $pid, "user_id" => $uid));

            if (!empty($is_buy)) {
                $is_rating = $this->custom_model->my_where('user_rating', 'id', array('pid' => $pid, "uid" => $uid));

                if (empty($is_rating)) {
                    if ($post_data['rating'] > 5) {
                        echo "invalid_rating";
                        die();
                    }

                    $created_date = date("Y-m-d h:i:s");
                    $data['uid'] = $uid;
                    $data['pid'] = $pid;
                    $data['name'] = $post_data['name'];
                    $data['email'] = $post_data['email'];
                    $data['comment'] = $post_data['comment'];
                    $data['rating'] = $post_data['rating'];
                    $data['created_date'] = $created_date;
                    $data['status'] = 1;
                    // echo "<pre>";
                    // print_r($post_data);
                    // die();
                    $this->custom_model->my_insert($data, 'user_rating');

                    echo 1;

                    die();
                } else {
                    echo "already";
                    die();
                }
            } else {
                echo "please_buy";
                die();
            }
        } else {
            echo 0;
            die();
        }
    }

    public function deliver_request()
    {
        $post_data = $this->input->post();

        if (!empty($post_data)) {
            $this->custom_model->my_insert($post_data, 'deliver_request');
            echo 1;
            die();
        } else {
            echo 0;
            die();
        }
    }

    public function contact_us()
    {
        $post_data = $this->input->post();

        if (!empty($post_data)) {
            $post_data['created_date'] = date('Y-m-d H:i:s');
            $this->custom_model->my_insert($post_data, 'contact_us');
            echo 1;
            die();
        } else {
            echo 0;
            die();
        }
    }

    public function get_subcategory_data()
    {
        $post_data = $this->input->post();

        if (!empty($post_data)) {
            $category = $this->custom_model->my_where('category', 'id,display_name', array('parent' => $post_data['cat_id']));
            if (!empty($category)) {
                echo json_encode($category);
                die();
            } else {
                echo "not_found";
                die();
            }
            // echo "<pre>";
            // print_r($category);
            // die();
        } else {
            echo 0;
            die();
        }
    }

    public function check_hotel_time()
    {
        $date = date('d-m-Y'); //Thu  Sun Fri ,Sat
        $day = date("D", strtotime($date));

        if ($day == 'Fri' || $day == 'Sat') {
            $shop_timing = $this->custom_model->my_where('shop_timing', '*', array('id' => '2'));
            $open_time = $shop_timing[0]['open_time'];
            $close_time = $shop_timing[0]['close_time'];

            if (strtotime(date('H:i:s')) > strtotime(date($open_time)) && strtotime(date('H:i:s')) < strtotime(date($close_time))) {
                echo 'yes';
                die();
            } else {
                echo 'no';
                die();
            }
        } else {
            $shop_timing = $this->custom_model->my_where('shop_timing', '*', array('id' => '1'));
            $open_time = $shop_timing[0]['open_time'];
            $close_time = $shop_timing[0]['close_time'];

            if (strtotime(date('H:i:s')) > strtotime(date($open_time)) && strtotime(date('H:i:s')) < strtotime(date($close_time))) {
                echo 'yes';
                die();
            } else {
                echo 'no';
                die();
            }
        }
    }

    public function currency_change()
    {
        $post_data = $this->input->post();

        // echo "<pre>";
        // print_r($post_data);
        // die();

        if (!empty($post_data['currency_name'])) {
            // $uid=$this->session->userdata('uid');
            // if(!empty($uid))
            // {
            // $this->custom_model->my_delete(array('user_id'=>$uid),'my_cart');
            // $this->custom_model->my_update(array('content' =>''),array('user_id' => $uid),'my_cart',true,true);
            // }
            // $this->session->set_userdata('content','');
            // $this->session->unset_userdata('my_wish');
            $this->session->set_userdata('currency', $post_data['currency_name']);
            echo 1;
            die();
        } else {
            echo 0;
            die();
        }
    }

    public function apply_coupon()
    {
        $post_data = $this->input->post();

        $this->session->unset_userdata('discount_value');
        $this->session->unset_userdata('shipping_flag');
        $this->session->unset_userdata('coupon_code');
        $uid = $this->session->userdata('uid');

        if (!empty($post_data)) {
            $coupon_code = $post_data['coupon_code'];
            $is_vouchers = $this->custom_model->my_where('vouchers', '*', array('code' => $coupon_code));
            $is_used = $this->custom_model->my_where('order_master', '*', array('coupon_code' => $coupon_code, 'user_id' => $uid));

            // echo $this->db->last_query();
            // die();
            // echo "<pre>";
            // print_r(expression)

            if (!empty($is_vouchers)) {
                if (!empty($is_used)) {
                    echo json_encode(array("status" => false, "message" => "already_used"));
                    die();
                }

                if ($is_vouchers[0]['status'] == 1) {
                    $today = date('Y-m-d');
                    $today = strtotime($today);
                    $end_date = $is_vouchers[0]['end_date'];
                    $end_date = strtotime($end_date);

                    if ($end_date >= $today) {
                        $cart_total = $this->return_cart_price();
                        $currency = $this->return_currency_name();
                        $tax_table = $this->custom_model->my_where('tax', '*', array());

                        if ($currency == "USD") {
                            $real_value = $is_vouchers[0]['amount'] / $tax_table[0]['sar_rate'];
                        } else {
                            $real_value = $is_vouchers[0]['amount'];
                        }

                        if ($is_vouchers[0]['type'] == 1) {
                            $discount_value = ($cart_total * $is_vouchers[0]['amount'] / 100);
                        } else {
                            // $discount_value=$cart_total-$real_value;
                            $discount_value = $real_value;
                        }

                        // 1 means shipping free 0 means not free
                        $data = [
                            'discount_value' => $discount_value,
                            'shipping_flag' => $is_vouchers[0]['free_shipping'],
                            'coupon_code' => $is_vouchers[0]['code'],
                        ];

                        $this->session->set_userdata($data);
                        echo json_encode(["status" => true, "discount_value" => $discount_value, "shipping_flag" => $is_vouchers[0]['free_shipping'], "cart_total" => $cart_total]);
                        die();
                    } else {
                        echo json_encode(["status" => false, "message" => "code_expire"]);
                        die();
                    }
                } else {
                    echo json_encode(["status" => false, "message" => "code_expire"]);
                    die();
                }

            } else {
                echo json_encode(["status" => false, "message" => "invalid_code"]);
                die();
            }
        } else {
            echo json_encode(["status" => false, "message" => "something"]);
            die();
        }
    }

    public function csv_download_id($api_flag = '')
    {
        die();

        // $api_flag=2;
        $query = 'id,api_pro_id,product_name,product_image,sale_price';

        // this for show most user view product
        $url = base_url('admin/product/most_pro');
        $file_name = 'most_view_' . date("d-m-Y") . '.csv';
        $data = $this->custom_model->get_data_array("SELECT $query FROM `product` WHERE product_image=''  ");

        // echo "<pre>";
        // print_r($data);
        // die();

        if (!empty($data)) {
            @header('Content-Type:text/csv');
            @header("Content-Disposition: attachment; filename=\"$file_name\";");
            // header("Content-Disposition: attachment; filename=" );
            $str = 'Product id';
            $fp = fopen('php://output', 'wb');
            $i = 0;
            $header = explode(",", $str);

            fputcsv($fp, $header);

            foreach ($data as $key => $value) {
                // $date=date('M-d-Y' ,strtotime($value['order_datetime']));
                // $CSV_DATA[] = $value['id'];
                $CSV_DATA[] = $value['api_pro_id'];
                // $CSV_DATA[] = $value['product_name'];
                // $CSV_DATA[] = $value['product_image'];
                // $CSV_DATA[] = $value['sale_price'];

                fputcsv($fp, $CSV_DATA);

                $CSV_DATA = [];
            }
        } else { ?>
            <script id="DataOne">
                //
                alert("No data found");
                //
                let url = "<?php echo $url; ?>";
                //
                setTimeout(() => {
                    window.location = url;
                }, 2000);
            </script>
        <?php }
        die();
        // $lang['ALERT'] =" No data found";
    }

    public function show_date_time()
    {
        echo phpinfo();
        // echo "This is you current Date & Time ".date('Y-m-d H:i:s');
    }

    public function send_inquiry()
    {
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $insert_data = array();
            if (!empty($post_data['subject']) && !empty($post_data['message'])) {
                $insert_data['subject'] = $post_data['subject'];
                $insert_data['vender_name'] = $post_data['vender_name'];
                $insert_data['message'] = $post_data['message'];
                $insert_data['vender_id'] = en_de_crypt($post_data['vid'], 'd');
                $insert_data['pid'] = en_de_crypt($post_data['pid'], 'd');
                $insert_data['created_date'] = date("Y-m-d h:i:s");

                if (isset($_FILES['document']['name']) && $_FILES['document']['name'] != '') {
                    @$FILES = $_FILES["document"];
                    $folder_name = 'admin/inquiry_doc/';
                    @$image_name = $this->uploads($FILES, $folder_name);
                    $insert_data['document'] = $image_name;
                }
                $this->custom_model->my_insert($insert_data, 'send_inquiry');
                echo 1;
                die();
            } else {
                echo "all_filed";
                die();
            }
        } else {
            echo 0;
            die();
        }
    }

    public function send_quotation()
    {
        $post_data = $this->input->post();
        $uid = $this->session->userdata('uid');
        $user_name = $this->session->userdata('user_name');

        if (empty($uid)) {
            echo "login";
            die();
        }
        if (!empty($post_data)) {
            // echo "<pre>";
            // print_r($post_data);
            // print_r($_FILES);
            // die();
            $insert_data = array();
            $pid = $post_data['pid'];
            $seller_id = $post_data['seller_id'];
            if ($post_data['seller_id'] == 0) {
                $condition_array['id'] = $pid;
            } else {
                $condition_array['id'] = $pid;
                $condition_array['seller_id'] = $seller_id;
            }
            // $is_product = $this->custom_model->my_where("product","*",$condition_array);
            // if(empty($is_product))
            // {
            // 	echo "invalid_pro";
            // 	die();
            // }

            $insert_data['seller_id'] = $post_data['seller_id'];
            $insert_data['uid'] = $uid;
            $insert_data['user_name'] = $user_name;
            $insert_data['product_name'] = $post_data['product_name'];
            $insert_data['category_id'] = $post_data['category_id'];
            $insert_data['purchase_cycle'] = $post_data['purchase_cycle'];
            $insert_data['customiz'] = $post_data['customiz'];
            // $insert_data['deadline']=$post_data['deadline'];
            $insert_data['deadline'] = date('Y-m-d', strtotime($post_data['deadline']));
            $insert_data['pid'] = $post_data['pid'];
            $insert_data['hscode'] = $post_data['hscode'];
            $insert_data['unit'] = $post_data['unit'];
            $insert_data['qty'] = $post_data['qty'];
            $insert_data['address'] = $post_data['address'];
            // $insert_data['delivery_date']=$post_data['delivery_date'];
            $insert_data['delivery_date'] = date('Y-m-d', strtotime($post_data['delivery_date']));
            $insert_data['incoterms'] = $post_data['incoterms'];
            $insert_data['certification'] = $post_data['certification'];
            $insert_data['information'] = $post_data['information'];
            $insert_data['google_address'] = $post_data['google_address'];
            $insert_data['lat'] = $post_data['lat'];
            $insert_data['lng'] = $post_data['lng'];
            $insert_data['quotation_status'] = 'Open';

            $insert_data['created_date'] = date("Y-m-d h:i:s");
            if (!empty($post_data['document'])) {
                $insert_data['document'] = ltrim($post_data['document'], ',');
            }
            // if(isset($_FILES['document']['name']) && $_FILES['document']['name']!='')
            // {
            // 	@$FILES = $_FILES["document"];
            // 	$folder_name='admin/inquiry_doc/';
            // 	@$image_name = $this->uploads($FILES,$folder_name);
            // 	$insert_data['document']=$image_name;
            // }
            // echo "<pre>";
            // print_r($insert_data);
            // die();
            $response = $this->custom_model->my_insert($insert_data, 'send_quotation');
            if ($response) {
                $noti_data = array();
                $noti_data['noti_type'] = 'invoice';
                $noti_data['message'] = 'You receive new invoice request';
                $noti_data['uid'] = $uid;
                $noti_data['sid'] = $post_data['seller_id'];
                $noti_data['qut_msg_id'] = $response;
                $noti_data['send_by'] = 'user';
                $noti_data['send_to'] = 'admin';
                $noti_data['created_date'] = date("Y-m-d h:i:s");

                if ($post_data['seller_id'] != 0) {
                    $noti_data['send_to'] = 'seller';

                    $insert_data = array();
                    $insert_data['quotaion_id'] = $response;
                    $insert_data['in_user_name'] = $user_name;
                    $insert_data['uid'] = $uid;
                    $insert_data['in_address'] = $post_data['address'];
                    $insert_data['in_qty'] = $post_data['qty'];
                    $insert_data['in_unit'] = $post_data['unit'];
                    $insert_data['in_sku'] = $post_data['pid'];
                    $insert_data['seller_id'] = $post_data['seller_id'];
                    // $insert_data['created_date']=date("Y-m-d h:i:s");
                    // $insert_data['in_date']=date("Y-m-d");
                    $response = $this->custom_model->my_insert($insert_data, 'quotation_invoice');
                    if ($response) {
                        $arr = explode(' ', trim($user_name));
                        $first_name = $arr[0];
                        $in_iref_no = $first_name . '-' . $response;
                        $this->custom_model->my_update(array('in_iref_no' => $in_iref_no), array('in_id' => $response), 'quotation_invoice');
                    }
                }

                $this->custom_model->my_insert($noti_data, 'inv_mesg_notification');
                echo 1;
                die();
            } else {
                echo 0;
                die();
            }
        } else {
            echo 0;
            die();
        }
    }

    public function login_check()
    {
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $uid = $this->session->userdata('uid');
            if (!empty($uid)) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
        die();
    }

    public function get_product_id()
    {
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $vendor_id = $post_data['vendor_id'];
            if ($vendor_id == 0) {
                $product_ids = $this->custom_model->get_data_array("SELECT id,product_name FROM product WHERE product_delete!='1' AND status=1 order by id desc ");
            } else {
                $product_ids = $this->custom_model->get_data_array("SELECT id,product_name FROM product WHERE product_delete!='1' AND status=1 AND seller_id='$vendor_id' order by id desc ");
            }
            if (!empty($product_ids)) {
                $response = '<option value="0">Please select Product No./SKU</option>';
                foreach ($product_ids as $pi_key => $pi_val) {
                    $response .= '<option value="' . $pi_val['id'] . '" >' . $pi_val['id'] . '</option>';
                }
                echo json_encode(array("status" => true, "message" => "success", 'data' => $response));
                die();
            } else {
                echo json_encode(array("status" => false, "message" => "Product not found please select another vendor"));
                die();
            }
        } else {
            echo json_encode(array("status" => false, "message" => "Something went wrong"));
            die();
        }
    }

    public function get_product_name()
    {
        $post_data = $this->input->post();
        if (!empty($post_data) && !empty($post_data['search'])) {
            $search = $post_data['search'];
            $product_data = $this->custom_model->get_data_array("SELECT id,product_name FROM product WHERE (product_name LIKE '%$search%' OR  tags LIKE '%$search%') AND `product_delete`='0' AND `status`='1' ORDER BY `product_name` DESC  ");
            // OR `short_description` LIKE '%$search%' OR tags LIKE '%$search%'
            if (!empty($product_data)) {
                $response = '';
                foreach ($product_data as $pd_key => $pd_val) {
                    $response .= '<a class="search_name" href="javascript:void(0)" data-name="' . $pd_val['product_name'] . '" >' . $pd_val['product_name'] . '</a><br>';
                }
                echo json_encode(array("status" => true, "message" => "success", 'data' => $response));
                die();
            } else {
                echo json_encode(array("status" => false, "message" => "Product not found"));
                die();
            }
        } else {
            echo json_encode(array("status" => false, "message" => "Something went wrong"));
            die();
        }
    }

    public function get_blog_heading()
    {
        $post_data = $this->input->post();
        $language = $this->uri->segment(1);
        if (!empty($post_data) && !empty($post_data['search'])) {
            $search = $post_data['search'];
            if ($language == "en") {
                $blog = "blog";
                $query = " WHERE (blog.heading LIKE '%$search%' OR bt.name LIKE '%$search%') AND blog.status='active' ";
            } else {
                $blog = "blog_trans";
                $query = " WHERE (blog.heading LIKE '%$search%' OR bt.name_trans LIKE '%$search%') AND blog.status='active' ";
            }
            $blog_type = 'blog_type';
            // $product_data = $this->custom_model->get_data_array("SELECT id,product_name FROM product WHERE (product_name LIKE '%$search%' OR  tags LIKE '%$search%') AND `product_delete`='0' AND `status`='1' ORDER BY `product_name` DESC  ");

            $product_data = $this->custom_model->get_data_array("SELECT blog.id,blog.heading FROM $blog as blog  INNER JOIN blog_type as bt ON blog.blog_type_id=bt.id  $query   Order BY blog.id DESC");
            // OR `short_description` LIKE '%$search%' OR tags LIKE '%$search%'
            if (!empty($product_data)) {
                $response = '';
                foreach ($product_data as $pd_key => $pd_val) {
                    $response .= '<a class="search_blog" href="' . base_url('blog/detail/') . $pd_val['id'] . '" data-name="' . $pd_val['heading'] . '" >' . $pd_val['heading'] . '</a><br>';
                }
                echo json_encode(array("status" => true, "message" => "success", 'data' => $response));
                die();
            } else {
                echo json_encode(array("status" => false, "message" => ($language == 'ar' ? 'لم يوجد شيء' : 'No record found')));
                die();
            }
        } else {
            echo json_encode(array("status" => false, "message" => ($language == 'ar' ? 'هناك خطأ ما' : 'Something went wrong')));
            die();
        }
    }

    public function get_vender_name()
    {
        $post_data = $this->input->post();
        if (!empty($post_data) && !empty($post_data['search'])) {
            $uid = $this->session->userdata('uid');
            if (empty($uid)) {
                echo json_encode(array("status" => false, "message" => "Please login"));
            }
            $search = $post_data['search'];
            $vender_info = $this->custom_model->get_data_array(" SELECT id,first_name FROM admin_users WHERE (first_name LIKE '%$search%') AND type='suppler'  AND is_terminate='0'  ORDER BY first_name ASC  ");
            if (!empty($vender_info)) {
                $response = '<a class="vendor_name" href="javascript:void(0)" data-id="0" >All</a><br>';
                foreach ($vender_info as $vi_key => $vi_val) {
                    $response .= '<a class="vendor_name" href="javascript:void(0)" data-id="' . $vi_val['id'] . '" >' . $vi_val['first_name'] . '</a><br>';
                }
                echo json_encode(array("status" => true, "message" => "success", 'data' => $response));
                die();
            } else {
                echo json_encode(array("status" => false, "message" => "Vender not found"));
                die();
            }
        } else {
            echo json_encode(array("status" => false, "message" => "Something went wrong"));
            die();
        }
    }

    public function cancel_request()
    {
        $uid = $this->session->userdata('uid');
        $language = $this->uri->segment(1);
        if (empty($uid)) {
            echo json_encode(array('status' => false, "message" => ($language == 'ar' ? 'الرجاء تسجيل دخول أو إنشاء حساب' : 'Please Login')));
            die();
        }
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            if (isset($post_data['req_id'])) {
                $req_id = $post_data['req_id'];
                $is_request = $this->custom_model->get_data_array("SELECT id,quotation_status,seller_id FROM `send_quotation` WHERE uid = '$uid'  AND id='$req_id'");
                if (!empty($is_request)) {
                    if ($is_request[0]['quotation_status'] == 'Cancelled') {
                        echo json_encode(array('status' => false, "message" => ($language == 'ar' ? 'تم إلغاء الطلب' : 'Request already cancelled')));
                        die();
                    }
                    if ($is_request[0]['quotation_status'] == 'Rejected') {
                        echo json_encode(array('status' => false, "message" => ($language == 'ar' ? "لا يمكن إلغاء طلب مرفوض" : "You can't cancelled rejected request")));
                        die();
                    }
                    if ($is_request[0]['quotation_status'] == 'Confirmed') {
                        echo json_encode(array('status' => false, "message" => ($language == "ar" ? "لا يمكن إلغاء طلب مؤكد" : "You can't cancelled confirmed request")));
                        die();
                    }
                    $response = $this->custom_model->my_update(array('quotation_status' => 'Cancelled'), array('uid' => $uid, 'id' => $req_id), 'send_quotation');

                    $noti_data = array();
                    $noti_data['noti_type'] = 'invoice';
                    $noti_data['message'] = 'Invoice request cancelled.';
                    $noti_data['uid'] = $uid;
                    $noti_data['sid'] = $is_request[0]['seller_id'];
                    $noti_data['qut_msg_id'] = $is_request[0]['id'];
                    $noti_data['send_by'] = 'user';
                    if ($is_request[0]['seller_id'] == 0) {
                        $noti_data['send_to'] = 'admin';
                    } else {
                        $noti_data['send_to'] = 'seller';
                    }
                    $noti_data['created_date'] = date("Y-m-d h:i:s");

                    $this->custom_model->my_insert($noti_data, 'inv_mesg_notification');
                    if ($response) {
                        $this->custom_model->my_update(array('invoice_status' => 'Cancelled'), array('uid' => $uid, 'quotaion_id' => $req_id), 'quotation_invoice');
                        echo json_encode(array('status' => true, "message" => ($language == 'ar' ? 'تم إلغاء الطلب بنجاح' : 'Request cancelled successfully')));
                        die();
                    } else {
                        echo json_encode(array('status' => false, "message" => ($language == 'ar' ? 'هناك خطأ ما' : 'Something went wrong')));
                        die();
                    }
                } else {
                    echo json_encode(array('status' => false, "message" => ($language == 'ar' ? 'معرّف الطلب غير صحيح' : 'Invalid request id')));
                    die();
                }
            } else {
                echo json_encode(array('status' => false, "message" => ($language == 'ar' ? 'هناك خطأ ما' : 'Something went wrong')));
                die();
            }
        } else {
            echo json_encode(array('status' => false, "message" => ($language == 'ar' ? 'هناك خطأ ما' : 'Something went wrong')));
            die();
        }
    }

    public function is_suppler_login()
    {
        $uid = $this->session->userdata('uid');
        $type = $this->session->userdata('type');
        if (empty($uid) || empty($type)) {
            echo "login";
        } else if ($type == "buyer") {
            echo "not_allowed";
        } else if ($type == "suppler") {
            echo 1;
            die();
        } else {
            echo 0;
        }
        die();
    }

    public function switch_seller()
    {
        $uid = $this->session->userdata('uid');
        $type = $this->session->userdata('type');
        $language = $this->uri->segment(1);
        if (!empty($uid) && !empty($type)) {
            if ($type == 'buyer') {
                $is_data = $this->custom_model->my_where('admin_users', 'id,first_name,email,phone,username', array('id' => $uid, 'type' => 'buyer'));
                if (!empty($is_data)) {
                    $is_data2 = $this->custom_model->my_where('admin_users_groups', 'id', array('user_id' => $uid));
                    if (empty($is_data2)) {
                        // comment this code becaus client said set all seller expire date to 2022-12-31
                        //$footer_content=$this->custom_model->my_where("footer_content","default_period",array('id' => '1'));
                        //if(!empty($footer_content))
                        //{
                        // $default_period='+'.$footer_content[0]['default_period'];
                        //}else{
                        //$default_period='+1 month';
                        //}

                        $update_data = array();
                        $update_data['group_id'] = 5;
                        $subs_start_date = date("Y-m-d");
                        // $subs_end_date = date("Y-m-d", strtotime($subs_start_date.$default_period));
                        $subs_end_date = '2022-12-31';
                        $update_data['subs_start_date'] = $subs_start_date;
                        $update_data['subs_end_date'] = $subs_end_date;
                        $update_data['subs_status'] = 'trial';
                        $update_data['type'] = 'suppler';

                        $this->custom_model->my_update($update_data, array('id' => $uid), 'admin_users');
                        $gorup_data = array();
                        $gorup_data['user_id'] = $uid;
                        $gorup_data['group_id'] = 5;
                        $this->custom_model->my_insert($gorup_data, 'admin_users_groups');


                        $data['user_name'] = $is_data[0]['first_name'];
                        $data['uid'] = $uid;
                        $data['email'] = $is_data[0]['email'];
                        $data['phone'] = $is_data[0]['phone'];
                        $data['is_logged_in'] = true;
                        $data['username'] = $is_data[0]['username'];
                        $data['user_id'] = $uid;
                        $data['group_id'] = 5;
                        $data['type'] = 'suppler';
                        $data['identity'] = 'vendor';
                        $this->load->library('session');
                        $this->session->set_userdata($data);
                        echo json_encode(array('status' => true, "message" => ($language == 'ar' ? 'تم إنشاء حساب المورد بنجاح' : 'Seller account created successfully'), 'message_flag' => ''));
                        die();
                    } else {
                        echo json_encode(array('status' => false, "message" => ($language == 'ar' ? 'ناك خطأ ما' : 'Something Went Wrong'), 'message_flag' => ''));
                        die();
                    }
                } else {
                    echo json_encode(array('status' => false, "message" => ($language == 'ar' ? 'لا يسمح بالوصول' : 'No access allowed'), 'message_flag' => ''));
                    die();

                }
            } else {
                echo json_encode(array('status' => false, "message" => ($language == 'ar' ? 'لا يسمح بالوصول' : 'No access allowed'), 'message_flag' => ''));
                die();
            }
        } else {
            echo json_encode(array('status' => false, "message" => "Please Login OR Create Account", 'message_flag' => 'login'));
            die();
        }
    }

    public function csv_upload($user_id = "", $language = "")
    {
        die();
        $query = array();
        $user_id = "1";
        $language = "en";
        $csvMimes = array('application/vnd.ms-excel', 'text/plain', 'text/csv', 'text/tsv');

        if (!empty($_FILES)) {
            // echo "<pre>222";
            // print_r($_FILES);
            // die();
            if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)) {
                if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                    //open uploaded csv file with read only mode
                    $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

                    // skip first line
                    // if your csv file have no heading, just comment the next line

                    fgetcsv($csvFile);

                    //parse data from csv file line by line
                    while (($line = fgetcsv($csvFile)) !== FALSE) {
                        // echo "<pre>";
                        $code = $line[0];
                        $message = $line[1];
                        $card_type = $line[2];
                        // $code = sprintf("%02d", $code);


                        // echo $zip_code.'<br>';
                        // echo $zip_code1.'<br>';

                        $additional_data = $response = array();

                        if (!empty($code)) $additional_data['code'] = $code;
                        if (!empty($message)) $additional_data['message'] = $message;
                        if (!empty($card_type)) $additional_data['card_type'] = $card_type;

                        $is_code = $this->custom_model->my_where('payment_code_msg', 'id', array('code' => $code, 'card_type' => $card_type));
                        if (empty($is_code)) {
                            $product_id = $this->custom_model->my_insert($additional_data, 'payment_code_msg');
                        }
                    }

                    // die();

                    //close opened csv file
                    fclose($csvFile);
                    echo "yes";
                    die();
                    // $this->session->set_flashdata('csv_insert', 'CSV uploded successfully');
                    // redirect('/admin/product/list1');
                }
            } else {
                $this->session->set_flashdata('csv_error', 'Please upload csv !');
            }
        }
        // redirect('admin/product/list1');

    }
}

?>

