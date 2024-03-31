<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Ajax
 */
class Test_cont extends MY_Controller
{

    protected $shi_UserName = 'armx.ruh.it@gmail.com';
    protected $shi_Password = 'YUre@9982';
    protected $shi_Version = 'v1';
    protected $shi_AccountNumber = '20016';
    protected $shi_AccountPin = '331421';
    protected $shi_AccountEntity = 'AMM';
    protected $shi_AccountCountryCode = 'SA';
    protected $shi_Source = 'SA';
    protected $shi_CountryCode = 'SA';

    public function __construct()
    {
        $this->load->model('admin/Custom_model', 'custom_model');

    }

    public function return_html_old($product_data, $language, $inc_count = '')
    {
        $html_tag = '';
        if ($language == 'en') {
            $add_to_cart_text = "Add To Cart";
        } else {
            $add_to_cart_text = "إضافة إلى سلة الشراء";
        }
        if (!empty($product_data)) {
            $i = 1;
            if (!empty($inc_count)) {
                $i = 101;
            }
            $currency = $this->return_currency_name();
            $currency_symbol = $this->return_currency_symbol($currency, $language);
            foreach ($product_data as $product_key => $product_value) {
                if ($product_value['is_stock'] == 0) {
                    $stock_class = "prd-outstock";
                    $stock_label_class = "label-outstock";
                    $stock_label = "OUT OF STOCK";
                    $btn_disabled = 'disabled';
                } else {
                    $stock_class = "";
                    $stock_label_class = "";
                    $stock_label = "";
                    $btn_disabled = '';
                }

                $product_image = explode("/", $product_value['product_image']);
                $product_image = count($product_image);
                if ($product_image == 1) {
                    $image_url = base_url("assets/admin/products/") . $product_value['product_image'];
                } else {
                    $image_url = $product_value['product_image'];
                }

                $html_tag .= '<div class="col-xl-2 col-6 col-grid-box">';

                $html_tag .= '<div class="product-box">';

                $html_tag .= '<div class="img-wrapper">';

                $html_tag .= '<div class="front">';
                $html_tag .= '<a href="#"><img src="' . $image_url . '" class="img-fluid blur-up lazyload bg-img" alt=""></a>';
                $html_tag .= '</div>'; //front

                $html_tag .= '<div class="back">';
                $html_tag .= '<a href="' . base_url($language . '/home/detail/') . $product_value['id'] . '"><img src="' . $image_url . '" class="img-fluid blur-up lazyload bg-img" alt=""></a>';
                $html_tag .= '</div>'; //back

                $html_tag .= '<div class="cart-info cart-wrap">';
                if ($product_value['price_select'] == '1') {
                    $html_tag .= '<button title="Add to cart" data-id="' . $product_value['id'] . '" data-unit="get_unit' . $i . '" data-detislqty="' . $product_value['min_order_quantity'] . '" class="add_to_cart2">
                                              <i class="ti-shopping-cart"></i>
                                             </button>';
                } else {
                    $html_tag .= '<button title="Add to cart"data-class="get_size' . $i . '" data-id="' . $product_value['id'] . '" data-unit="get_unit' . $i . '" data-detislqty="' . $product_value['min_order_quantity'] . '" class="add_to_cart2">
                                              <i class="ti-shopping-cart"></i>
                                             </button> ';
                }
                $html_tag .= '<span class="wishlist' . $product_value['id'] . '">';
                if ($product_value['wish_list'] == 1) {
                    $html_tag .= '<a  href="javascript:void(0)" onclick="remove_cart(' . $product_value['id'] . ')" ><i class="ti-heart" aria-hidden="true"></i></a> ';
                } else {
                    $html_tag .= '<a style="background:#343a40 !important"  href="javascript:void(0)" onclick="move_to_wish_list(' . $product_value['id'] . ')" ><i class="ti-heart" aria-hidden="true"></i></a> ';
                }
                $html_tag .= '</span>';


                $html_tag .= '</div>'; //cart-wrap

                $html_tag .= '</div>'; //img-wrapper

                $html_tag .= '<div class="product-detail">';

                if (!empty($product_value['unit_list'])) {
                    $html_tag .= '<select class="form-control select_unit get_unit' . $i . '">';
                    foreach ($product_value['unit_list'] as $uld_key => $uld_value) {
                        $html_tag .= '<option data-id="' . $uld_value['id'] . '" >' . $uld_value['unit_name'] . '</option>';
                    }

                    $html_tag .= '</select>';
                }

                if (isset($product_value['meta_data']) && !empty($product_value['meta_data'])) {
                    $html_tag .= '<select class="form-control select_size get_size' . $i . '">';
                    $html_tag .= '<option value="0">Select Size</option>';
                    foreach ($product_value['meta_data'] as $md_key => $md_val) {
                        $html_tag .= '<option data-price="' . $md_val['price'] . '" data-value="' . $md_val['size'] . '" value="' . $md_val['item_id'] . '">' . $md_val['size'] . '</option>';
                    }
                    $html_tag .= '</select>';
                }

                $html_tag .= '<div>';

                $html_tag .= '<div class="new_rating">' . $product_value['rating_element'] . ' </div>';
                $html_tag .= '<a href="' . base_url($language . '/home/detail/') . $product_value['id'] . '"> <h6>' . $product_value['product_name'] . '</h6> </a>';
                $html_tag .= '<h4>' . $currency_symbol . ' ' . $product_value['sale_price'] . '</h4>';
                $html_tag .= '<ul class="color-variant"> <li class="bg-light0"></li> <li class="bg-light1"></li> <li class="bg-light2"></li> </ul>';

                $html_tag .= '</div>';

                $html_tag .= '</div>';  //product-detail

                $html_tag .= '</div>'; //product-box


                $html_tag .= '</div>'; //col-grid-box

                $i++;
            }
        }
        return $html_tag;
    }

    public function get_catrory()
    {
        die;
        $category_data = $this->custom_model->get_data_array("SELECT * FROM category Order by id asc ");
        if (!empty($category_data)) {
            foreach ($category_data as $key => $val) {
                $insert_data = array();
                $insert_data['id'] = $val['id'];
                $insert_data['display_name'] = $val['display_name'];
                $insert_data['banner_image'] = $val['banner_image'];
                $insert_data['image'] = $val['image'];
                $insert_data['status'] = $val['status'];
                $insert_data['parent'] = $val['parent'];
                $insert_data['has_product'] = $val['has_product'];
                $insert_data['slug'] = $val['slug'];
                $this->custom_model->my_insert($insert_data, 'category_trans');
            }
        }
        echo "<pre>";
        print_r($category_data);
        die;
    }

    public function email_test()
    {
        // echo phpinfo();
        // die;
        // $this->load->library("email_send");
        // $this->email_send->send_invoice(2021011101275236);
        // die;
        // $link = base_url()."en/login/resetpassword/".en_de_crypt($datas->id)."/".$datas->forgotten_password_code;
        // uniqid()
        $language = 'en';
        $this->load->library("email_template");
        $first_name = 'siddiqui';
        $link = base_url();
        $link = base_url() . $language . "/login/email_verify/" . en_de_crypt(4);
        $link_arr = array();
        $link_arr['buyer_manual_en'] = "https://docs.google.com/document/d/10yRVBJscda4nLGnsGZPKVb-5F7xzV-i-/edit";
        $link_arr['buyer_manual_ar'] = "https://docs.google.com/document/d/110WtTKKsiwxHbqxN2lyzbaIb1w_3aPSU/edit";
        $link_arr['supplier_manual_en'] = "https://docs.google.com/document/d/1-ZtLtSToUlLBJ4dAMEOl3zrFnxtzsTsa/edit";
        $link_arr['supplier_manual_ar'] = "https://docs.google.com/document/d/1021wgbN4qB0QwYZXvJ3mODsqcc_EcMtO/edit";
        $message = $this->email_template->varified_email_ar($link_arr);
        // echo $message;
        // die;
        // $message =registration_content('siddiqui');
        $subject = "Your account is varified successfully";
        $emails = 'rijoyim903@dakcans.com';
        $emails = 'quamer313@gmail.com';
        // $emails='rohit@persausive.com';
        $this->load->library("email_cilib");
        $this->email_cilib->send_welcome($emails, $subject, $message);
    }

    public function json_test()
    {
        $data = '{"ClientInfo":{"UserName":"reem@reem.com","Password":"123456789","Version":"1.0","AccountNumber":"4004636","AccountPin":"432432","AccountEntity":"RUH","AccountCountryCode":"SA","Source":24},"DestinationAddress":{"Line1":"XYZ Street","Line2":"Unit # 1","Line3":"","City":"Dubai","StateOrProvinceCode":"","PostCode":"","CountryCode":"AE","Longitude":0,"Latitude":0,"BuildingNumber":null,"BuildingName":null,"Floor":null,"Apartment":null,"POBox":null,"Description":null},"OriginAddress":{"Line1":"ABC Street","Line2":"Unit # 1","Line3":"","City":"Amman","StateOrProvinceCode":"","PostCode":"","CountryCode":"JO","Longitude":0,"Latitude":0,"BuildingNumber":null,"BuildingName":null,"Floor":null,"Apartment":null,"POBox":null,"Description":null},"PreferredCurrencyCode":"USD","ShipmentDetails":{"Dimensions":null,"ActualWeight":{"Unit":"KG","Value":1},"ChargeableWeight":null,"DescriptionOfGoods":null,"GoodsOriginCountry":null,"NumberOfPieces":1,"ProductGroup":"EXP","ProductType":"PPX","PaymentType":"P","PaymentOptions":"","CustomsValueAmount":null,"CashOnDeliveryAmount":null,"InsuranceAmount":null,"CashAdditionalAmount":null,"CashAdditionalAmountDescription":null,"CollectAmount":null,"Services":"","Items":null,"DeliveryInstructions":null},"Transaction":{"Reference1":"","Reference2":"","Reference3":"","Reference4":"","Reference5":""}}';

        $data2 = json_decode($data, true);
        echo "<pre>";
        print_r($data2);
    }

    public function json_test2()
    {
        $data = '{"ClientInfo":{"UserName":"reem@reem.com","Password":"123456789","Version":"1.0","AccountNumber":"4004636","AccountPin":"432432","AccountEntity":"RUH","AccountCountryCode":"SA","Source":24},"LabelInfo":null,"Shipments":[{"Reference1":"202206171604502","Reference2":"202206171632","Reference3":"","Shipper":{"Reference1":"","Reference2":"","AccountNumber":"4004636","PartyAddress":{"Line1":"test address","Line2":null,"Line3":"","City":"Qatif","StateOrProvinceCode":"","PostCode":"61321","CountryCode":"SA","Longitude":0,"Latitude":0,"BuildingNumber":"456","BuildingName":null,"Floor":null,"Apartment":null,"POBox":null,"Description":null},"Contact":{"Department":"","PersonName":"shaikh","Title":"","CompanyName":"irfan","PhoneNumber1":"12345678","PhoneNumber1Ext":"","PhoneNumber2":"","PhoneNumber2Ext":"","FaxNumber":"","CellPhone":"12345678","EmailAddress":"quamer313@gmail.com","Type":""}},"Consignee":{"Reference1":"","Reference2":"","AccountNumber":"","PartyAddress":{"Line1":"456 test address","Line2":null,"Line3":"","City":"Qatif","StateOrProvinceCode":"","PostCode":"75471","CountryCode":"SA","Longitude":0,"Latitude":0,"BuildingNumber":null,"BuildingName":null,"Floor":null,"Apartment":null,"POBox":null,"Description":null},"Contact":{"Department":"","PersonName":"quameruddin siddiqui","Title":"","CompanyName":"quameruddin","PhoneNumber1":"8482901476","PhoneNumber1Ext":"","PhoneNumber2":"","PhoneNumber2Ext":"","FaxNumber":"","CellPhone":"8482901476","EmailAddress":"quamer123@gmail.com","Type":""}},"ThirdParty":{"Reference1":"","Reference2":"","AccountNumber":"","PartyAddress":{"Line1":"","Line2":"","Line3":"","City":"","StateOrProvinceCode":"","PostCode":"","CountryCode":"","Longitude":0,"Latitude":0,"BuildingNumber":"","BuildingName":"","Floor":"","Apartment":"","POBox":"","Description":""},"Contact":{"Department":"","PersonName":"","Title":"","CompanyName":"","PhoneNumber1":"","PhoneNumber1Ext":"","PhoneNumber2":"","PhoneNumber2Ext":"","FaxNumber":"","CellPhone":"","EmailAddress":"","Type":""}},"ShippingDateTime":"\/Date(25-06-2022 9:30:00)\/","DueDate":"\/Date(24-06-2022 15:30:00)\/","Comments":"","PickupLocation":"","OperationsInstructions":"","AccountingInstrcutions":"","Details":{"Dimensions":null,"ActualWeight":{"Unit":"KG","Value":"1"},"ChargeableWeight":null,"DescriptionOfGoods":"Test product","GoodsOriginCountry":"SA","NumberOfPieces":"1","ProductGroup":"EXP","ProductType":"PPX","PaymentType":"P","PaymentOptions":"","CustomsValueAmount":{"CurrencyCode":"SAR","Value":"1288"},"CashOnDeliveryAmount":null,"InsuranceAmount":null,"CashAdditionalAmount":null,"CashAdditionalAmountDescription":null,"CollectAmount":null,"Services":"","Items":[{"PackageType":"Boxes","Quantity":"1","Weight":{"Unit":"KG","Value":"1"},"Comments":"Requirement for Loading:- Liftgate, Vehicle Requirement:- Truck, is this hazardous material:- Yes Specify Nature","Reference":"202206173"}]},"Attachments":[],"ForeignHAWB":"","TransportType":0,"PickupGUID":"","Number":null,"ScheduledDelivery":null}],"Transaction":{"Reference1":"","Reference2":"","Reference3":"","Reference4":"","Reference5":""}}';

        $data2 = json_decode($data, true);
        echo "<pre>";
        print_r($data2);
        echo "</pre>";
        echo "<br><br><br>";
        $d = DateTime::createFromFormat(
            'd-m-Y H:i:s',
            '28-06-2022 10:00:00',
            new DateTimeZone('UTC')
        );

        if ($d === false) {
            die("Incorrect date string");
        } else {
            echo $d->getTimestamp();
        }
        // echo "<br><br>";
        // $d = DateTime::createFromFormat('d-m-Y H:i:s', '17-06-2022 00:00:00');
        // if ($d === false) {
        //     die("Incorrect date string");
        // } else {
        //     echo $d->getTimestamp();
        // }


    }

    public function get_shipping_rate($products)
    {

        if (!empty($products)) {
            foreach ($products as $key => $val) {
                $product_data = $this->custom_model->get_data_array("SELECT pro.product_name,pro.price,pro.sale_price,pro.weight,pro.weight_unit,pro.city,pro.warehouse_location,pro.city,pro.lat,pro.lng,admin.street_name,admin.building_no,admin.city,admin.state,admin.postal_code FROM product as pro INNER JOIN admin_users as admin ON pro.seller_id=admin.id WHERE pro.id='" . $val['pid'] . "'  ");

                $products[$key]['pro_data'] = $product_data;
                // echo "<pre>"
            }
            echo "<pre>";
            print_r($products);
        }
    }

    public function get_ClientInfo()
    {
        $ClientInfo = array();
        $ClientInfo['UserName'] = $this->shi_UserName;
        $ClientInfo['Password'] = $this->shi_Password;
        $ClientInfo['Version'] = $this->shi_Version;
        $ClientInfo['AccountNumber'] = $this->shi_AccountNumber;
        $ClientInfo['AccountPin'] = $this->shi_AccountPin;
        $ClientInfo['AccountEntity'] = $this->shi_AccountEntity;
        $ClientInfo['AccountCountryCode'] = $this->shi_AccountCountryCode;
        $ClientInfo['Source'] = $this->shi_Source;
        return $ClientInfo;
    }

    public function get_DestinationAddress($send_data)
    {
        $DestinationAddress = array();
        $DestinationAddress['Line1'] = $send_data['address_1'];
        $DestinationAddress['Line2'] = empty($send_data['google_address']) ? '' : $send_data['google_address'];
        $DestinationAddress['Line3'] = '';
        $DestinationAddress['City'] = $send_data['city'];
        $DestinationAddress['StateOrProvinceCode'] = '';
        $DestinationAddress['PostCode'] = $send_data['pincode'];
        $DestinationAddress['CountryCode'] = $this->shi_CountryCode;
        $DestinationAddress['Longitude'] = empty($send_data['lng']) ? '0' : $send_data['lng'];
        $DestinationAddress['Latitude'] = empty($send_data['lat']) ? '0' : $send_data['lat'];
        $DestinationAddress['BuildingNumber'] = '';
        $DestinationAddress['BuildingName'] = '';
        $DestinationAddress['Floor'] = '';
        $DestinationAddress['Apartment'] = '';
        $DestinationAddress['POBox'] = '';
        $DestinationAddress['Description'] = '';
        return $DestinationAddress;
    }

    public function od_invup()
    {
        $in_data = $this->custom_model->get_data_array("SELECT * FROM `admin_users` WHERE id='4' ");

        if (!empty($in_data)) {
            foreach ($in_data as $key => $val) {
                $this->custom_model->my_update(array('is_email_verify' => '0'), array('id' => $val['id']), 'admin_users');
            }
        }

        echo "<pre>";
        print_r($in_data);
        die;
    }

    public function set_shipping_city()
    {
        die;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://ws.dev.aramex.net/ShippingAPI.V2/Location/Service_1_0.svc/json/FetchCities',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"ClientInfo":{"UserName":"reem@reem.com","Password":"123456789","Version":"v1","AccountNumber":"20016","AccountPin":"331421","AccountEntity":"AMM","AccountCountryCode":"sa","Source":24},"CountryCode":"sa","NameStartsWith":"","State":"","Transaction":{"Reference1":"","Reference2":"","Reference3":"","Reference4":"","Reference5":""}}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;

        $response = json_decode($response, true);
        // echo "<pre>";
        // print_r($response);


        if (isset($response['Cities']) && !empty($response['Cities'])) {
            foreach ($response['Cities'] as $key => $val) {
                $insert_data = array();
                $insert_data['city_name'] = $val;
                $this->custom_model->my_insert($insert_data, 'city_list');
            }
        }

    }

    public function oldproduct_check($data, $flag = false, $is_other = false)
    {
        $language = $this->uri->segments[1];
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

?>

