<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Library to add cart/ add wish list
 */
class User_account
{

    public function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();
        $this->CI->load->model('admin/Custom_model', 'custom_model');
        date_default_timezone_set('Asia/Kolkata');
    }

    public function add_remove_cart($pid, $uid, $type, $qty = 1, $metadata = array(), $comment = '', $append = '', $unit = '', $country = '')
    {
        $uncontent = $response = array();
        $status = $check_pr_at = false;
        $cart_qty = 0;

        if (!empty($uid)) {
            $is_data = $this->CI->custom_model->my_where('my_cart', '*', array('user_id' => $uid, 'meta_key' => 'cart'));
            if (!empty($is_data)) {
                $status = true;
                $db_content = $is_data[0]['content'];
                $id = $is_data[0]['id'];
                $uncontent = unserialize($db_content);
            }
        } else {
            $uncontent = unserialize($this->CI->session->userdata('content'));
        }
        // echo "<pre>";
        // print_r($uncontent);
        // die;
        if ($type == 'add') {
            $ck_sk = $this->CI->custom_model->my_where('product', '*', array('id' => $pid));

            if (!empty($ck_sk)) {
                // echo $ck_sk[0]['stock'];
                // echo "<br>";
                // echo $qty;
                // echo "<br>";
                // echo "<pre>";
                // print_r($ck_sk);
                // die;

                if ($ck_sk[0]['status'] == '0') {
                    return json_encode(array('status' => false, 'message' => 'product_is_deactive'));
                }


                // if($ck_sk[0]['stock'] > $qty  ||  $ck_sk[0]['stock_status'] == 'instock' )
                if ($ck_sk[0]['price_select'] == 1 || $ck_sk[0]['price_select'] == 2) {
                    if ($ck_sk[0]['price_select'] == 1) {
                        // echo '<pre>';
                        // print_r($ck_sk)
                        // die;
                        if ($ck_sk[0]['stock'] >= $qty) {
                            if ($ck_sk[0]['stock_status'] == 'notinstock') {
                                return json_encode(array('status' => false, 'message' => 'quantity_notinstock'));
                            }
                        } else {
                            return json_encode(array('status' => false, 'message' => 'quantity_not_avilable'));
                        }

                    }
                    if ($qty >= $ck_sk[0]['min_order_quantity']) {

                    } else {
                        return json_encode(array('status' => false, 'message' => 'min_order', "message2" => "Minimum order must be " . $ck_sk[0]['min_order_quantity']));
                    }
                    if (!empty($unit)) {
                        $is_unit = $this->CI->custom_model->my_where('unit_list', '*', array('id' => $unit));
                        if (empty($is_unit)) {
                            return json_encode(array('status' => false, 'message' => 'invalid_unit_id'));
                        }
                    }


                    if (empty($metadata) && empty($comment)) {
                        $append = 'm' . $pid;
                        if (!empty($unit)) {
                            $append .= 'm' . $unit;
                        }
                        $attribute_price = '';
                    } else if (empty($metadata) && !empty($comment)) {
                        $pcxdata = $this->product_exdata($comment, $country);
                        if ($pcxdata != 'invalid_customize_id') {
                            $append = 'm' . $pid;
                            $comment = $pcxdata['pcxdata'];
                            $append = $append . $pcxdata['append'];
                        } else {
                            return json_encode(array('status' => false, 'message' => $pcxdata));
                        }
                    } else if (!empty($metadata) && empty($comment)) {
                        // echo "123";
                        // die;
                        $return_val = $this->product_metadata($metadata, $pid, $ck_sk, $qty);
                        // if($return_val!='invalid_size' )
                        if (is_array($return_val)) {
                            $metadata = $return_val['metadata'];
                            $append = $return_val['append'];
                            $attribute_price = $return_val['attribute_price'];
                        } else {
                            return json_encode(array('status' => false, 'message' => $return_val));
                        }
                    } else if (!empty($metadata) && !empty($comment)) {
                        $return_val = $this->product_metadata($metadata, $pid);
                        if ($return_val != 'invalid_size') {
                            $metadata = $return_val['metadata'];
                            $append = $return_val['append'];
                        } else {
                            return json_encode(array('status' => false, 'message' => $return_val));
                        }

                        $pcxdata = $this->product_exdata($comment, $country);
                        if ($pcxdata != 'invalid_customize_id') {
                            // $append = 'm'.$pid;
                            $comment = $pcxdata['pcxdata'];
                            $append = $append . $pcxdata['append'];
                        } else {
                            return json_encode(array('status' => false, 'message' => $pcxdata));
                        }
                    }

                    // echo "<pre>";
                    // print_r($append);
                    // die;
                    $cart_check = $this->check_product_added($uid, $qty, $uncontent, $append, $ck_sk, $attribute_price);

                    if ($cart_check == 'not_added_tocart') {
                        $cnt[$append] = array('pid' => $pid, 'qty' => $qty, 'metadata' => $metadata, 'comment' => $comment, 'unit' => $unit);
                        if (!empty($uncontent)) {
                            $cnt = array_merge($uncontent, $cnt);
                        }

                        $response = $cnt;
                        $data = array('meta_key' => 'cart', 'content' => serialize($cnt));
                        if (!empty($uid)) {
                            if ($status) {
                                $this->CI->custom_model->my_update(array('content' => serialize($response)), array('id' => $id, 'meta_key' => 'cart'), 'my_cart', true, true);
                            } else {
                                $data['user_id'] = $uid;
                                $this->CI->custom_model->my_insert($data, 'my_cart');
                            }
                        }
                        // echo "<pre>";
                        // print_r($response);

                        $this->CI->session->set_userdata('content', serialize($response));
                        // return $response;
                        return json_encode(array('status' => true, 'message' => "first_time_added_successfully"));
                    } else {
                        return json_encode(array('status' => false, 'message' => $cart_check));
                    }
                } else {
                    // if quantity is grather than stock
                    return json_encode(array('status' => false, 'message' => 'quantity_not_avilable'));
                }
            } else {
                return json_encode(array('status' => false, 'message' => 'product_not_found'));
            }
        } else if ($type == 'update') {
            $ck_sk = $this->CI->custom_model->my_where('product', '*', array('id' => $pid));
            if (!empty($ck_sk)) {

                if ($ck_sk[0]['status'] == 1) {
                    if ($ck_sk[0]['price_select'] == 1) {
                        if ($ck_sk[0]['stock_status'] == 'notinstock') {
                            return json_encode(array('status' => false, 'message' => 'quantity_notinstock'));
                        }
                    }
                    $cart_check = $this->check_product_update($uid, $qty, $uncontent, $append, $ck_sk, $unit);

                    // echo "<pre>";
                    // print_r($cart_check);
                    // die;

                    if ($cart_check == 'cart_updated') {
                        return json_encode(array('status' => true, 'message' => $cart_check));
                    } else {
                        // $cart_check=substr('min_order_1', 0, 9);
                        if (substr($cart_check, 0, 9) == 'min_order') {
                            return json_encode(array('status' => false, 'message' => substr($cart_check, 0, 9), "message2" => "Minimum order must be " . substr($cart_check, 10)));
                        } else {
                            return json_encode(array('status' => false, 'message' => $cart_check));
                        }
                    }
                } else {
                    return json_encode(array('status' => false, 'message' => 'product_deactive'));
                }
            } else {
                return json_encode(array('status' => false, 'message' => 'product_not_found'));
            }
        }  //  this for remove individual prodcut form cart
        else if ($type == 'remove') {
            if (!empty($uncontent)) {
                $append = $pid;
                $uncontent2 = unserialize($this->CI->session->userdata('content'));
                // echo "<pre>";
                // print_r($append);
                // echo "<br>";
                // print_r($uncontent2);
                // die;
                if (@array_key_exists(@$append, @$uncontent2)) {
                    /*echo "123"; exit;*/
                    unset($uncontent2[$append]);
                    $uncontent2 = array_filter($uncontent2);
                    $response2 = $uncontent2;
                    $this->CI->session->set_userdata('content', serialize($response2));
                }

                if (array_key_exists($append, $uncontent)) {
                    unset($uncontent[$append]);
                    $uncontent = array_filter($uncontent);
                    $response = $uncontent;

                    if (!empty($uid) && $status) {
                        $this->CI->custom_model->my_update(array('content' => serialize($response)), array('id' => $id, 'meta_key' => 'cart'), 'my_cart', true, true);
                    }

                    return $response;
                } else {
                    return '-1';
                }
            } else {
                return '-1';
            }
        }
    }

    public function product_exdata($comment, $country)
    {
        $pcxdata = array();
        $append = '';
        if (!empty($comment)) {
            foreach ($comment as $pcxd_key => $pcxd_val) {
                $cus_att_value = $this->CI->custom_model->my_where('pcustomize_attribute', '*', array('id' => $pcxd_val));
                if (!empty($cus_att_value)) {
                    $pcxdata[$pcxd_val]['name'] = $cus_att_value[0]['name'];

                    if ($country == 'Abu Dhabi') {
                        $price = $cus_att_value[0]['price_ad'];
                    } else {
                        $price = $cus_att_value[0]['price_bh'];
                    }

                    $pcxdata[$pcxd_val]['price'] = $price;
                    $append = $append . 'm' . $pcxd_val;
                } else {
                    $return_val = "invalid_customize_id";
                    return $return_val;
                }
            }
            return ['append' => $append, 'pcxdata' => $pcxdata];
        }
    }

    public function product_metadata($metadata, $pid, $ck_sk, $qty)
    {
        // echo "<pre>";
        // print_r($metadata);
        // print_r($ck_sk);
        // die;
        foreach ($metadata as $md_key => $md_val) {

            $attribute_item = $this->CI->custom_model->my_where('attribute_item', 'item_name', array('id' => $md_val));
            $attribute = $this->CI->custom_model->my_where('attribute', 'name', array('id' => $md_key));
            $attribute_price = $this->CI->custom_model->my_where('product_attribute', 'price,sale_price,qty', array('attribute_id' => $md_key, 'item_id' => $md_val, 'p_id' => $pid));

            if (!empty($attribute_item) && !empty($attribute)) {
                if ($attribute_price[0]['qty'] >= $qty) {
                    $append = 'm' . $pid . 'm' . $md_val;
                    unset($metadata[$md_key]);
                    $metadata['price'] = $attribute_price[0]['price'];
                    $metadata['price'] = $ck_sk[0]['sale_price'];
                    $metadata['size'] = $attribute_item[0]['item_name'];
                    $metadata['attribute_item_id'] = $md_val;
                    return ['append' => $append, 'metadata' => $metadata, 'attribute_price' => $attribute_price];
                } else {
                    $return_val = "quantity_not_avilable";
                    return $return_val;
                }
            } else {
                $return_val = "invalid_size";
                return $return_val;
            }

            break;
        }
    }

    public function check_product_added($uid, $qty, $uncontent, $append, $ck_sk, $attribute_price)
    {
        // echo "<pre>";
        // print_r($attribute_price);
        // die;
        if (!empty($uid)) {
            // $is_data = $this->custom_model->my_where('my_cart','*',array('user_id' => $uid,'meta_key' => 'cart'));
            if (!empty($uncontent)) {
                // $db_content = $is_data[0]['content'];
                // $id = $is_data[0]['id'];
                // $uncontent = unserialize($db_content);
                // check product all ready added ot cart
                if (array_key_exists($append, $uncontent)) {
                    //echo "123"; exit;
                    $p_qurnt = $uncontent[$append]['qty'];
                    $uncontent[$append]['qty'] = $p_qurnt + $qty;
                    $p_q_c = $p_qurnt + $qty;
                    if ($ck_sk[0]['price_select'] == 1) {
                        if ($ck_sk[0]['stock_status'] == 'notinstock') {
                            $return_val = "quantity_not_avilable";
                            return $return_val;
                        }
                        if ($p_q_c > $ck_sk[0]['stock']) {
                            $return_val = "quantity_not_avilable";
                            return $return_val;
                        }
                    } else {
                        // echo "<pre>";
                        // print_r($attribute_price);
                        // echo $p_q_c;
                        // die;
                        if ($p_q_c > $attribute_price[0]['qty']) {
                            $return_val = "quantity_not_avilable";
                            return $return_val;
                        }
                    }

                    // if($p_q_c > $ck_sk[0]['stock'] || $ck_sk[0]['stock_status'] == 'notinstock')
                    // {
                    // $return_val="quantity_not_avilable";
                    // return $return_val;
                    // }

                    $update = $this->CI->custom_model->my_update(array('content' => serialize($uncontent)), array('user_id' => $uid, 'meta_key' => 'cart'), 'my_cart');
                    $return_val = "founded";
                    return $return_val;
                }
            }
            // prodcut not already added to cart
            $return_val = "not_added_tocart";
            return $return_val;
        } else {
            if (!empty($uncontent)) {
                // 	echo "111123";
                // die;
                // $uncontent3=unserialize($this->CI->session->userdata('content'));
                if (array_key_exists($append, $uncontent)) {
                    $p_qurnt = $uncontent[$append]['qty'];
                    $uncontent[$append]['qty'] = $p_qurnt + $qty;
                    $p_q_c = $p_qurnt + $qty;
                    if ($ck_sk[0]['price_select'] == 1) {
                        if ($ck_sk[0]['stock_status'] == 'notinstock') {
                            $return_val = "quantity_not_avilable";
                            return $return_val;
                        }
                        if ($p_q_c > $ck_sk[0]['stock']) {
                            $return_val = "quantity_not_avilable";
                            return $return_val;
                        }
                    } else {
                        // echo "<pre>";
                        // print_r($attribute_price);
                        // echo $p_q_c;
                        // die;
                        if ($p_q_c > $attribute_price[0]['qty']) {
                            $return_val = "quantity_not_avilable";
                            return $return_val;
                        }
                    }
                    // if($p_q_c > $ck_sk[0]['stock'] || $ck_sk[0]['stock_status'] == 'notinstock')
                    //             {
                    //             	$return_val="quantity_not_avilable";
                    //                 return $return_val;
                    //             }
                    $this->CI->session->set_userdata('content', serialize($uncontent));
                    $return_val = "founded";
                    return $return_val;
                }
            }
            // prodcut not already added to cart
            $return_val = "not_added_tocart";
            return $return_val;
        }
    }

    public function check_product_update($uid, $qty, $uncontent, $append, $ck_sk, $unit)
    {
        if (!empty($uid)) {
            if (!empty($uncontent)) {

                if (array_key_exists($append, $uncontent)) {

                    if (!empty($unit)) {
                        $is_unit = $this->CI->custom_model->my_where('unit_list', '*', array('id' => $unit));
                        if (!empty($is_unit)) {
                            $uncontent[$append]['unit'] = $unit;
                            $gpid = $uncontent[$append]['pid'];
                            $new_append = 'm' . $gpid . 'm' . $unit;
                            $uncontent[$new_append] = $uncontent[$append];
                            unset($uncontent[$append]);
                            $update = $this->CI->custom_model->my_update(array('content' => serialize($uncontent)), array('user_id' => $uid, 'meta_key' => 'cart'), 'my_cart');
                            $return_val = "cart_updated";
                            return $return_val;
                        } else {
                            $return_val = "invalid_unit_id";
                            return $return_val;
                        }
                    }

                    $p_qurnt = $uncontent[$append]['qty'];
                    $tcount = $qty + $p_qurnt;

                    if ($p_qurnt == 1 && $tcount < 1) {
                        $return_val = "quantity_not_update_below_one";
                        return $return_val;
                    }

                    if ($qty == -1) {
                        $is_minus = true;
                        $uncontent[$append]['qty'] = $p_qurnt - 1;
                        $p_q_c = $p_qurnt - 1;
                    } else {
                        $is_minus = false;
                        $uncontent[$append]['qty'] = $p_qurnt + 1;
                        $p_q_c = $p_qurnt + 1;
                    }
                    if ($p_q_c >= $ck_sk[0]['min_order_quantity']) {

                    } else {
                        $return_val = "min_order_" . $ck_sk[0]['min_order_quantity'];
                        return $return_val;
                    }
                    if ($ck_sk[0]['price_select'] == 1) {
                        if ($p_q_c > $ck_sk[0]['stock'] || $ck_sk[0]['stock_status'] == 'notinstock') {
                            $return_val = "quantity_not_avilable";
                            return $return_val;
                        }
                    } else {
                        if (isset($uncontent[$append]['metadata'])) {

                            $attribute_price = $this->CI->custom_model->my_where('product_attribute', 'price,sale_price,qty', array('attribute_id' => "20", 'item_id' => $uncontent[$append]['metadata']['attribute_item_id'], 'p_id' => $uncontent[$append]['pid']));

                            if ($p_q_c > $attribute_price[0]['qty']) {
                                $return_val = "quantity_not_avilable";
                                return $return_val;
                            }
                        }
                    }

                    $update = $this->CI->custom_model->my_update(array('content' => serialize($uncontent)), array('user_id' => $uid, 'meta_key' => 'cart'), 'my_cart');
                    $return_val = "cart_updated";
                    return $return_val;
                }
            }
            // prodcut not already added to cart
            $return_val = "not_added_tocart";
            return $return_val;
        } else {
            // echo 111;
            // die;
            if (!empty($uncontent)) {
                if (array_key_exists($append, $uncontent)) {

                    if (!empty($unit)) {
                        $is_unit = $this->CI->custom_model->my_where('unit_list', '*', array('id' => $unit));
                        if (!empty($is_unit)) {
                            $uncontent[$append]['unit'] = $unit;
                            $gpid = $uncontent[$append]['pid'];
                            $new_append = 'm' . $gpid . 'm' . $unit;
                            $uncontent[$new_append] = $uncontent[$append];
                            unset($uncontent[$append]);
                            $this->CI->session->set_userdata('content', serialize($uncontent));
                            $return_val = "cart_updated";
                            return $return_val;
                        } else {
                            $return_val = "invalid_unit_id";
                            return $return_val;
                        }
                    }

                    $p_qurnt = $uncontent[$append]['qty'];
                    if ($qty == -1) {
                        $is_minus = true;
                        $uncontent[$append]['qty'] = $p_qurnt - 1;
                        $p_q_c = $p_qurnt - 1;
                    } else {
                        $is_minus = false;
                        $uncontent[$append]['qty'] = $p_qurnt + 1;
                        $p_q_c = $p_qurnt + 1;
                    }
                    if ($p_q_c >= $ck_sk[0]['min_order_quantity']) {

                    } else {
                        $return_val = "min_order_" . $ck_sk[0]['min_order_quantity'];
                        return $return_val;
                    }
                    if ($ck_sk[0]['price_select'] == 1) {
                        if ($p_q_c > $ck_sk[0]['stock'] || $ck_sk[0]['stock_status'] == 'notinstock') {
                            $return_val = "quantity_not_avilable";
                            return $return_val;

                        }
                    } else {
                        if (isset($uncontent[$append]['metadata'])) {
                            // echo 1;
                            // die;
                            $attribute_price = $this->CI->custom_model->my_where('product_attribute', 'price,sale_price,qty', array('attribute_id' => "20", 'item_id' => $uncontent[$append]['metadata']['attribute_item_id'], 'p_id' => $uncontent[$append]['pid']));

                            if ($p_q_c > $attribute_price[0]['qty']) {
                                $return_val = "quantity_not_avilable";
                                return $return_val;
                            }
                        }
                    }


                    // // $uncontent["m1m7"];
                    // echo "<pre>";
                    // print_r($uncontent);
                    // die;
                    $this->CI->session->set_userdata('content', serialize($uncontent));
                    $return_val = "cart_updated";
                    return $return_val;
                }
            }
            // prodcut not already added to cart
            $return_val = "not_added_tocart";
            return $return_val;
        }
    }

    // this funciton for if cart qty is grather than available prodcut qty than set avilable qty

    public function update_catqty($content, $key, $available_qty)
    {
        $uid = $this->CI->session->userdata('uid');
        if (array_key_exists($key, $content)) {
            $content[$key]['qty'] = $available_qty;
            // $uncontent = array_filter($uncontent);
            // echo "<pre>";
            // print_r($content);
            // die;
            if (!empty($uid)) {
                $this->CI->custom_model->my_update(array('content' => serialize($content)), array('user_id' => $uid, 'meta_key' => 'cart'), 'my_cart', true, true);
            }
            $this->CI->session->set_userdata('content', serialize($content));
        }
    }

    public function product_check($data, $flag = false, $is_other = false, $language)
    {
        // $language = $this->uri->segments[1];
        if ($language == 'en') {
            $error_lab1 = "Product out of stock";
            $error_lab2 = "Available quantity is";
            $error_lab3 = "Your invoice request rejected by seller";
            $error_lab4 = "You cancelled your quotaion request";
            $error_lab5 = "Your quotation request is pending";
            // $error_lab6="Invalid order id or invalid product id";
            $error_lab6 = "Invalid request id";
        } else {
            $error_lab1 = "المنتج نفذ من المخزون";
            $error_lab2 = "الكمية المتوفرة هي";
            $error_lab3 = "الة طلب التسعيرة: مرفوض";
            $error_lab4 = "الة طلب التسعيرة: ملغى";
            $error_lab5 = "الة طلب التسعيرة: معلق";
            $error_lab6 = "عرف طلب غير صحيح";
        }

        if (!empty($data)) {
            if ($data[0]['stock_status'] == 'notinstock' || $data[0]['stock'] == 0 || $data[0]['stock'] <= 0) {
                $data_res['status'] = false;
                $data_res['message'] = $error_lab1;
            } else if ($data[0]['quantity'] > $data[0]['stock'] && $flag == false) {
                $data_res['status'] = true;
                $data[0]['quantity'] = $data[0]['stock'];
                $data_res['message'] = $error_lab2 . ' ' . $data[0]['stock'];
            } else {
                $data_res['status'] = true;
                $data_res['message'] = '';
            }
            if ($is_other == true) {
                if (!empty($data[0]['invoice_status'])) {
                    if ($data[0]['invoice_status'] == 'Rejected') {
                        $data_res['status'] = false;
                        $data_res['message'] = $error_lab3;
                    } else if ($data[0]['invoice_status'] == 'Cancelled') {
                        $data_res['status'] = false;
                        $data_res['message'] = $error_lab4;
                    }
                } else {
                    $data_res['status'] = false;
                    $data_res['message'] = $error_lab5;
                }
            }
            $data_res['data'] = $data;
            return $data_res;
        } else {
            $data_res['status'] = false;
            $data_res['message'] = $error_lab6;
            $data_res['data'] = $data;
            return $data_res;
        }
    }
}
