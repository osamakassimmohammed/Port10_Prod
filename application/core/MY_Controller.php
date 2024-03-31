<?php

/**
 * Base controllers for different purposes
 *    - MY_Controller: for Frontend Website
 *    - Admin_Controller: for Admin Panel (require login), extends from MY_Controller
 *    - API_Controller: for API Site, extends from REST_Controller
 */
class MY_Controller extends MX_Controller
{

    // Values to be obtained automatically from router
    protected $mModule = '';            // module name (empty = Frontend Website)
    protected $mCtrler = 'home';        // current controller
    protected $mAction = 'index';        // controller function being called
    protected $mMethod = 'GET';            // HTTP request method

    // Config values from config/ci_bootstrap.php
    protected $mConfig = array();
    protected $mBaseUrl = array();
    protected $mSiteName = '';
    protected $mMetaData = array();
    protected $mScripts = array();
    protected $mStylesheets = array();

    // Values and objects to be overrided or accessible from child controllers
    protected $mPageTitlePrefix = '';
    protected $mPageTitle = '';
    protected $mParentTitle = '';
    protected $mBodyClass = '';
    protected $mMenu = array();
    protected $sub_seller_menu = array();
    protected $mBreadcrumb = array();
    // test key
    // protected $payment_key='02956034208202956034208202956034';
    // protected $payment_password='k22B2EgE!$$4yOf';
    // protected $payment_id='15kVTt0sd2Vn1RB';

    // live key
    protected $payment_key = '10520813918510520813918510520813';
    protected $payment_password = 'dZ6k63Q@$Ko@K4j';
    protected $payment_id = 'hA80LypF150dGYy';

    // Multilingual
    protected $mMultilingual = FALSE;
    protected $mLanguage = 'en';
    protected $mAvailableLanguages = array();

    // Data to pass into views
    protected $mViewData = array();

    // Login user
    protected $mPageAuth = array();
    protected $mUser = NULL;
    protected $mUserGroups = array();
    protected $mUserMainGroup;

    protected ?Exen $Exen = null;

    // Constructor
    public function __construct()
    {
        parent::__construct();

        // router info
        $this->mModule = $this->router->fetch_module();
        $this->mCtrler = $this->router->fetch_class();
        $this->mAction = $this->router->fetch_method();
        $this->mMethod = $this->input->server('REQUEST_METHOD');

        $this->load->library('Exen');

        $this->exen->load('Constants');

        // load custom model
        $this->load->model('admin/Custom_model', 'custom_model');

        // initial setup
        $this->_setup();
        date_default_timezone_set('Asia/Kolkata');

        $this->is_subscribtion_expire();
    }

    // Setup values from file: config/ci_bootstrap.php
    private function _setup()
    {
        $config = $this->config->item('ci_bootstrap');

        // load default values
        $this->mBaseUrl = empty($this->mModule) ? base_url() : base_url($this->mModule) . '/';
        $this->mSiteName = empty($config['site_name']) ? '' : $config['site_name'];
        $this->mPageTitlePrefix = empty($config['page_title_prefix']) ? '' : $config['page_title_prefix'];
        $this->mPageTitle = empty($config['page_title']) ? '' : $config['page_title'];
        $this->mBodyClass = empty($config['body_class']) ? '' : $config['body_class'];
        $this->mMenu = empty($config['menu']) ? array() : $config['menu'];
        $this->sub_seller_menu = empty($config['sub_seller_menu']) ? array() : $config['sub_seller_menu'];
        $this->mMetaData = empty($config['meta_data']) ? array() : $config['meta_data'];
        $this->mScripts = empty($config['scripts']) ? array() : $config['scripts'];
        $this->mStylesheets = empty($config['stylesheets']) ? array() : $config['stylesheets'];
        $this->mPageAuth = empty($config['page_auth']) ? array() : $config['page_auth'];

        // multilingual setup
        $lang_config = empty($config['languages']) ? array() : $config['languages'];
        if (!empty($lang_config)) {
            $this->mMultilingual = TRUE;
            $this->load->helper('language');

            // redirect to Home page in default language
            if (empty($this->uri->segment(1))) {
                $home_url = base_url($lang_config['default']) . '/';
                redirect($home_url);
            }

            // get language from URL, or from config's default value (in ci_bootstrap.php)
            $this->mAvailableLanguages = $lang_config['available'];
            $language = array_key_exists($this->uri->segment(1), $this->mAvailableLanguages) ? $this->uri->segment(1) : $lang_config['default'];

            // append to base URL
            $this->mBaseUrl .= $language . '/';

            // autoload language files
            foreach ($lang_config['autoload'] as $file)
                $this->lang->load($file, $this->mAvailableLanguages[$language]['value']);

            $this->mLanguage = $language;
        }

        // restrict pages
        $uri = ($this->mAction == 'index') ? $this->mCtrler : $this->mCtrler . '/' . $this->mAction;
        if (!empty($this->mPageAuth[$uri]) && !$this->ion_auth->in_group($this->mPageAuth[$uri])) {
            $page_404 = $this->router->routes['404_override'];
            $redirect_url = empty($this->mModule) ? $page_404 : $this->mModule . '/' . $page_404;
            redirect($redirect_url);
        }

        // push first entry to breadcrumb
        if ($this->mCtrler != 'home') {
            $page = $this->mMultilingual ? lang('home') : 'Home';
            $this->push_breadcrumb($page, '');
        }

        // get user data if logged in
        if ($this->ion_auth->logged_in()) {
            $this->mUser = $this->ion_auth->user()->row();
            if (!empty($this->mUser)) {
                $this->mUserGroups = $this->ion_auth->get_users_groups($this->mUser->id)->result();
                // echo $this->db->last_query();

                // TODO: get group with most permissions (instead of getting first group)
                // change_admin
                if (!empty($this->mUserGroups)) {
                    $this->mUserMainGroup = $this->mUserGroups[0]->name;
                }
            }
        }

        $this->mConfig = $config;
    }

    // Verify user login (regardless of user group)

    protected function push_breadcrumb($name, $url = '#', $append = TRUE)
    {
        $entry = array('name' => $name, 'url' => $url);

        if ($append)
            $this->mBreadcrumb[] = $entry;
        else
            array_unshift($this->mBreadcrumb, $entry);
    }

    // Verify user authentication
    // $group parameter can be name, ID, name array, ID array, or mixed array
    // Reference: http://benedmunds.com/ion_auth/#in_group

    public function is_subscribtion_expire()
    {
        if (!empty($this->mUser->id)) {
            $vender_data = $this->custom_model->my_where('admin_users', 'group_id,subs_status,active,is_terminate,type', array('id' => $this->mUser->id, 'type!=' => ''));
            if (!empty($vender_data)) {
                if ($vender_data[0]['group_id'] == 5 && $vender_data[0]['subs_status'] == 'expired') {
                    redirect('en/price');
                }
                if ($vender_data[0]['active'] == '0') {
                    $this->ion_auth->trigger_events('logout');
                    $this->session->sess_destroy();
                    $this->session->set_flashdata('common_message', 'Account is deactivated. Please send email to help@port10.sa to have your account activated.');
                    redirect($this->mLanguage . '/login');
                }
                if ($vender_data[0]['is_terminate'] == '1') {
                    $this->ion_auth->trigger_events('logout');
                    $this->session->sess_destroy();
                    $this->session->set_flashdata('common_message', 'Your account is terminated. Please contact help@port10.sa');
                    redirect($this->mLanguage . '/login');
                }
            }
        }
    }

    // Add script files, either append or prepend to $this->mScripts array
    // ($files can be string or string array)

    public function return_cart_price()
    {
        $grand_total_inc = 0;
        $currency = $this->return_currency_name();
        $uid = $this->session->userdata('uid');
        if (!empty($uid)) {
            $is_data = $this->custom_model->my_where('my_cart', '*', array('user_id' => $uid, 'meta_key' => 'cart'));
            $this->session->set_userdata('content', ((!empty($is_data)) ? $is_data[0]['content'] : array()));
        }
        if (!empty($this->session->userdata('content'))) {
            $cart_data = unserialize($this->session->userdata('content'));
            // echo "<pre>";
            // print_r($cart_data);
            // die;
            if (!empty($cart_data)) {
                $tax_table = $this->custom_model->my_where('tax', '*', array());
                foreach ($cart_data as $cd_key => $cd_val) {
                    $product_data = $this->custom_model->my_where('product', 'id,sale_price,price', array('id' => $cd_val['pid']));
                    if (!empty($product_data)) {
                        $product_price = $product_data[0]['sale_price'];
                        if ($currency == 'SAR') {
                            $pro_total = $product_price * $cd_val['qty'];

                        } else if ($currency == 'USD') {
                            $pro_singl = $product_price * $tax_table[0]['usd_rate'];
                            $pro_singl = round($pro_singl);
                            $pro_total = $pro_singl * $cd_val['qty'];
                        }

                        $commission = $tax_table[0]['commission'];
                        $single_commission = ($commission * $pro_total) / 100;
                        if ($single_commission > $tax_table[0]['cap_rate']) {
                            $single_commission = $tax_table[0]['cap_rate'];
                        }
                        $pro_total = $pro_total + $single_commission;
                        $single_vat = ($tax_table[0]['vat'] * $pro_total) / 100;
                        $pro_total = $pro_total + $single_vat;
                        $grand_total_inc = $pro_total + $grand_total_inc;
                    } else {
                        $grand_total_inc = 0 + $grand_total_inc;
                    }
                }
            }
        }
        return decnum($grand_total_inc);
    }

    // Add stylesheet files, either append or prepend to $this->mStylesheets array
    // ($files can be string or string array)

    public function return_html($product_data, $language, $inc_count = '')
    {
        $html_tag = '';
        if ($language == 'en') {
            $add_to_cart_text = "Add To Cart";
            $add_to_comp_text = "Add To Compare";
        } else {
            $add_to_cart_text = "إضافة إلى سلة الشراء";
            $add_to_comp_text = "Add To Compare";
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

                $html_tag .= '<div class="product-box">';

                $html_tag .= '<div class="img-wrapper">';
                $html_tag .= '<div class="front">';
                $html_tag .= '<a href="#"><img src="' . base_url("assets/admin/products/") . $product_value['product_image'] . '" class="img-fluid blur-up lazyload bg-img" alt=""></a>';
                $html_tag .= '</div>'; //front

                $html_tag .= '<div class="back">';
                $html_tag .= '<a href="' . base_url($language . '/home/detail/') . $product_value['id'] . '"><img src="' . base_url("assets/admin/products/") . $product_value['product_image'] . '" class="img-fluid blur-up lazyload bg-img" alt=""></a>';
                $html_tag .= '</div>'; //back

                $html_tag .= '<div class="cart-info cart-wrap">';
                $html_tag .= '</div>';

                $html_tag .= '</div>'; //img-wrapper

                $html_tag .= '<div class="product-detail">';
                if (!empty($product_value['unit_list'])) {
                    $html_tag .= '<select class="form-control select_unit get_unit' . $product_key . '">';
                    foreach ($product_value['unit_list'] as $uld_key => $uld_value) {
                        $html_tag .= '<option data-id="' . $uld_value['id'] . '" >' . $uld_value['unit_name'] . '</option>';
                    }
                    $html_tag .= '</select>';
                }

                if (isset($product_value['meta_data']) && !empty($product_value['meta_data'])) {
                    $html_tag .= '<select class="form-control select_size get_size' . $product_key . '">';
                    $html_tag .= '<option value="0">Select Size</option>';
                    foreach ($product_value['meta_data'] as $md_key => $md_val) {
                        $html_tag .= '<option data-price="' . $md_val['price'] . '" data-value="' . $md_val['size'] . '" value="' . $md_val['item_id'] . '">' . $md_val['size'] . '</option>';
                    }
                    $html_tag .= '</select>';
                }

                $html_tag .= '<div>';
                $html_tag .= '<a href="' . base_url($language . '/home/detail/') . $product_value['id'] . '"><h6>' . $product_value['product_name'] . '</h6> </a>';

                $html_tag .= '<span class="wish_l wishlist' . $product_value['id'] . '">';
                if ($product_value['wish_list'] == 1) {
                    $html_tag .= '<a href="javascript:void(0)" onclick="remove_cart(' . $product_value['id'] . ')" ><i class="ti-heart" aria-hidden="true"></i></a>';
                } else {
                    $html_tag .= '<a href="javascript:void(0)" onclick="move_to_wish_list(' . $product_value['id'] . ')" ><i class="ti-heart" aria-hidden="true"></i></a>';
                }
                $html_tag .= '</span>';

                $html_tag .= '<h4>' . $currency_symbol . '  ' . $product_value['sale_price'] . ' </h4>';
                $html_tag .= '<ul class="color-variant"> <li class="bg-light0"></li> <li class="bg-light1"></li> <li class="bg-light2"></li> </ul>';

                if ($product_value['price_select'] == '1') {
                    $html_tag .= '<button title="Add to cart" data-id="' . $product_value['id'] . '" data-unit="get_unit' . $product_key . '" data-detislqty="' . $product_value['min_order_quantity'] . '" class="add_to_cart2"><i class="ti-shopping-cart"></i> Add to cart           </button>';
                } else {

                    $html_tag .= '<button title="Add to cart"data-class="get_size' . $product_key . '" data-id="' . $product_value['id'] . '" data-unit="get_unit' . $product_key . '" data-detislqty="' . $product_value['min_order_quantity'] . '" class="add_to_cart2"><i class="ti-shopping-cart"></i> Add to cart</button>';
                }
                $html_tag .= '<div class="wrp_cmpr_2">';
                $html_tag .= '<label>';
                $html_tag .= '<input type="checkbox" class="add_check2 compare_ck" value="' . $product_value['id'] . '" ' . $product_value['is_compare'] . '>';
                $html_tag .= '<div class="ad_cmpr_tex2"> ' . $add_to_comp_text . ' </div>';
                $html_tag .= '</label>';
                $html_tag .= '</div>';

                $html_tag .= '</div>';

                $html_tag .= '</div>'; //product-detail

                $html_tag .= '</div>'; //product-box
            }
        }
        return $html_tag;
    }

    // Render template

    public function uploads($FILES, $folder_name = '')
    {
        /*echo "<pre>";
        print_r($FILES);
        die;*/
        if (isset($FILES['name'])) {
            //$upload_dir = ASSETS_PATH . "/admin/category/";
            $upload_dir = ASSETS_PATH . $folder_name;
            // print_r($upload_dir);
            // die;
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $file_name = $FILES['name'];
            $random_digit = rand(00, 99);
            $target_file = $upload_dir . basename($FILES["name"]);
            $ext = pathinfo($target_file, PATHINFO_EXTENSION);

            $new_file_name = md5(time()) . $random_digit . "." . $ext;
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

    // Render template

    public function return_ip_address()
    {
        // this function for count number
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    // Output JSON string

    public function set_remember_me($user_name = '', $password = '')
    {
        // $post_data=$this->input->post();
        if (!empty($user_name) && !empty($password)) {
            $this->load->helper('cookie');
            // 0 means not set Restaurant means Collection Home means Home Delivery
            set_cookie('remember_user_name', $user_name, time() + (10 * 365 * 24 * 60 * 60));
            set_cookie('remember_password', $password, time() + (10 * 365 * 24 * 60 * 60));
            // echo json_encode(array("status"=>true,"message"=>"Delivery type selected successfully")); die;
        } else {
            set_cookie('remember_user_name', $user_name, time() + (10 * 365 * 24 * 60 * 60));
            set_cookie('remember_password', $password, time() + (10 * 365 * 24 * 60 * 60));
        }
    }

    // Add breadcrumb entry
    // (Link will be disabled when it is the last entry, or URL set as '#')

    public function get_remember_me()
    {
        $this->load->helper('cookie');
        $remember_arr = array();
        $remember_arr['remember_user_name'] = get_cookie('remember_user_name');
        $remember_arr['remember_password'] = get_cookie('remember_password');
        return $remember_arr;
    }

    protected function verify_login($redirect_url = NULL)
    {
        if (!$this->ion_auth->logged_in()) {
            if ($redirect_url == NULL)
                $redirect_url = $this->mConfig['login_url'];

            redirect($this->mLanguage . '/' . $redirect_url);
        }
    }

    protected function verify_auth($group = 'members', $redirect_url = NULL)
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group($group)) {
            if ($redirect_url == NULL)
                $redirect_url = $this->mConfig['login_url'];

            redirect($redirect_url);
        }
    }

    protected function add_script($files, $append = TRUE, $position = 'foot')
    {
        $files = is_string($files) ? array($files) : $files;
        $position = ($position === 'head' || $position === 'foot') ? $position : 'foot';

        if ($append)
            $this->mScripts[$position] = array_merge($this->mScripts[$position], $files);
        else
            $this->mScripts[$position] = array_merge($files, $this->mScripts[$position]);
    }

    protected function add_stylesheet($files, $append = TRUE, $media = 'screen')
    {
        $files = is_string($files) ? array($files) : $files;

        if ($append)
            $this->mStylesheets[$media] = array_merge($this->mStylesheets[$media], $files);
        else
            $this->mStylesheets[$media] = array_merge($files, $this->mStylesheets[$media]);
    }

    protected function render($view_file, $layout = 'default')
    {
        // automatically generate page title
        if (empty($this->mPageTitle)) {
            if ($this->mAction == 'index')
                $this->mPageTitle = humanize($this->mCtrler);
            else
                $this->mPageTitle = humanize($this->mAction);
        }

        $this->mViewData['module'] = $this->mModule;
        $this->mViewData['ctrler'] = $this->mCtrler;
        $this->mViewData['action'] = $this->mAction;

        $this->mViewData['site_name'] = $this->mSiteName;
        $this->mViewData['page_title'] = $this->mPageTitlePrefix . $this->mPageTitle;
        $this->mViewData['current_uri'] = empty($this->mModule) ? uri_string() : str_replace($this->mModule . '/', '', uri_string());


        $this->mViewData['meta_data'] = $this->mMetaData;
        $this->mViewData['scripts'] = $this->mScripts;
        $this->mViewData['stylesheets'] = $this->mStylesheets;
        $this->mViewData['page_auth'] = $this->mPageAuth;

        $this->mBaseUrl = empty($this->mModule) ? base_url($this->mLanguage) : base_url($this->mLanguage . '/' . $this->mModule) . '/';
        // echo '<pre>';
        // print_r($this->mMenu);
        // die;
        $this->mViewData['base_url'] = $this->mBaseUrl;
        $this->mViewData['menu'] = $this->mMenu;
        $this->mViewData['sub_seller_menu'] = $this->sub_seller_menu;
        $this->mViewData['user'] = $this->mUser;
        $this->mViewData['ga_id'] = empty($this->mConfig['ga_id']) ? '' : $this->mConfig['ga_id'];
        $this->mViewData['body_class'] = $this->mBodyClass;

        // automatically push current page to last record of breadcrumb
        $this->push_breadcrumb($this->mPageTitle);
        $this->mViewData['breadcrumb'] = $this->mBreadcrumb;

        // multilingual
        $this->mViewData['multilingual'] = $this->mMultilingual;
        if ($this->mMultilingual) {
            $this->mViewData['available_languages'] = $this->mAvailableLanguages;
            $this->mViewData['language'] = $this->mLanguage;
        }

        // debug tools - CodeIgniter profiler
        $debug_config = $this->mConfig['debug'];
        if (ENVIRONMENT === 'development' && !empty($debug_config)) {
            $this->output->enable_profiler($debug_config['profiler']);
        }

        $this->mViewData['inner_view'] = $view_file;
        $this->load->view('_base/head', $this->mViewData);
        $this->load->view('_layouts/' . $layout, $this->mViewData);

        // debug tools - display view data
        if (ENVIRONMENT === 'development' && !empty($debug_config) && !empty($debug_config['view_data'])) {
            $this->output->append_output('<hr/>' . print_r($this->mViewData, TRUE));
        }

        $this->load->view('_base/foot', $this->mViewData);
    }

    protected function Urender($view_file, $layout = 'udefault', $page_name = '', $data = array(), $parent_name = array())
    {
        if (!empty($data)) {
            $this->mViewData['data'] = $data;
        }

        $this->mPageTitle = $page_name;
        $this->mParentTitle = $parent_name;
        // automatically generate page title
        /*if ( empty($this->mPageTitle) )
        {
            if ($this->mAction=='index')
                $this->mPageTitle = humanize($this->mCtrler);
            else
                $this->mPageTitle = humanize($this->mAction);
        }*/

        $this->mViewData['page_title'] = $this->mPageTitlePrefix . $this->mPageTitle;
        $this->mViewData['parent_title'] = $this->mParentTitle;
        $this->_setup();
        $this->mViewData['module'] = $this->mModule;
        $this->mViewData['ctrler'] = $this->mCtrler;
        $this->mViewData['action'] = $this->mAction;

        $this->mViewData['site_name'] = $this->mSiteName;
        $this->mViewData['current_uri'] = empty($this->mModule) ? uri_string() : str_replace($this->mModule . '/', '', uri_string());


        if ($this->mLanguage == 'en') {
            $pages = 'pages';
            $brand = "brand";
            $category = "category";
            $product = "product";
            $brand_orderby = " order by br.brand_name ASC ";
            $unit_list = "unit_list";
        } else {
            $pages = 'pages_trans';
            $brand = "brand_trans";
            $category = "category_trans";
            $product = "product_trans";
            $brand_orderby = " order by br.order_by ";
            $unit_list = "unit_list_trans";
        }
        // echo "<pre>";
        // print_r($women_Accessories);
        // die;

        $main_category = $this->custom_model->my_where($category, "*", array('parent' => '0', 'status' => 'active'));
        if (!empty($main_category)) {
            foreach ($main_category as $mc_key => $mc_val) {
                $sub_category = $this->custom_model->my_where($category, "*", array('parent' => $mc_val['id'], 'status' => 'active'));
                $main_category[$mc_key]['sub_category'] = $sub_category;
            }
        }

        // echo "<pre>";
        // print_r($this->session->userdata());
        // die;

        // $vender_info=$this->custom_model->get_data_array(" SELECT id,first_name FROM admin_users WHERE type!='buyer'  AND is_terminate='0'  ORDER BY first_name ASC  ");

        // $funit_list_data = $this->custom_model->get_data_array("SELECT * FROM $unit_list ORDER BY unit_name ASC ");

        // echo "<pre>";
        // print_r($main_category);
        // die;

        $footer_content = $this->custom_model->my_where("footer_content", "*", array('id' => '1'));

        $currency = $this->return_currency_name();
        $currency_symbol = $this->return_currency_symbol($currency, $this->mLanguage);

        $uid1 = $this->session->userdata('uid');
        $type1 = $this->session->userdata('type');

        $noti_data = array();
        if (!empty($uid1) && !empty($type1)) {
            if ($type1 == 'buyer') {
                $noti_data = $this->custom_model->get_data_array(" SELECT id,noti_type,message,qut_msg_id FROM inv_mesg_notification WHERE send_to='user' AND uid='$uid1' AND is_seen=0 ORDER BY id DESC ");

                if (!empty($noti_data)) {
                    foreach ($noti_data as $nd_key => $nd_val) {
                        if ($nd_val['noti_type'] == "invoice") {
                            $noti_data[$nd_key]['link'] = base_url($this->mLanguage . '/my_account/send_quotation_list/') . $nd_val['qut_msg_id'] . '/' . $nd_val['id'];
                        } else {
                            $noti_data[$nd_key]['link'] = base_url($this->mLanguage . '/chat/index/') . $nd_val['qut_msg_id'] . '/' . $nd_val['id'];
                        }
                    }
                }
            }
        }


        // $this->is_subscribtion_expire();
        // echo "<pre>";
        // print_r($noti_data);
        // print_r($uid1);
        // die;


        $this->mViewData['footer_content'] = $footer_content;
        $this->mViewData['main_category'] = $main_category;
        // $this->mViewData['vender_info'] =$vender_info;
        // $this->mViewData['funit_list_data'] =$funit_list_data;

        $this->mViewData['currency_symbol'] = $currency_symbol;
        $this->mViewData['noti_data'] = $noti_data;
        $this->mViewData['compare_count'] = $this->get_compare_count();
        // $this->mViewData['cart_price'] =$this->return_cart_price();


        $this->mViewData['meta_data'] = $this->mMetaData;
        $this->mViewData['scripts'] = $this->mScripts;
        $this->mViewData['stylesheets'] = $this->mStylesheets;
        $this->mViewData['page_auth'] = $this->mPageAuth;

        $this->mViewData['base_url'] = $this->mBaseUrl;
        $this->mViewData['menu'] = $this->mMenu;
        $this->mViewData['user'] = $this->mUser;
        $this->mViewData['ga_id'] = empty($this->mConfig['ga_id']) ? '' : $this->mConfig['ga_id'];
        $this->mViewData['body_class'] = $this->mBodyClass;

        // automatically push current page to last record of breadcrumb
        $this->push_breadcrumb($this->mPageTitle);
        $this->mViewData['breadcrumb'] = $this->mBreadcrumb;

        // multilingual
        $this->mViewData['multilingual'] = $this->mMultilingual;
        if ($this->mMultilingual) {
            $this->mViewData['available_languages'] = $this->mAvailableLanguages;
            $this->mViewData['language'] = $this->mLanguage;
        }

        // debug tools - CodeIgniter profiler
        $debug_config = $this->mConfig['debug'];
        if (ENVIRONMENT === 'development' && !empty($debug_config)) {
            $this->output->enable_profiler($debug_config['profiler']);
        }

        $this->load->model('Default_model');

        $this->mViewData['inner_view'] = $view_file;

        $this->load->view('_base/head', $this->mViewData);
        $this->load->view('_layouts/' . $layout, $this->mViewData);

        // debug tools - display view data
        if (ENVIRONMENT === 'development' && !empty($debug_config) && !empty($debug_config['view_data'])) {
            $this->output->append_output('<hr/>' . print_r($this->mViewData, TRUE));
        }

        $this->load->view('_base/foot', $this->mViewData);
    }

    protected function return_currency_name()
    {

        $currency = $this->session->userdata('currency');
        if (empty($currency) || $currency == 'SAR') {
            $currency = 'SAR';
            return $currency;
        } else {
            return $currency;
        }
    }

    protected function return_currency_symbol($currency, $language = '')
    {
        if (empty($currency) || $currency == 'SAR') {
            $currency = 'SAR';
            if ($language == 'ar') {
                $currency = "ريال";
            }
            return $currency;
        } else {
            if ($language == 'ar') {
                $currency = "دولار";
            }
            return $currency;
        }
    }

    public function get_compare_count()
    {
        $compare_count = 0;
        $compare = $this->session->userdata('compare');
        if (!empty($compare)) {
            $compare = unserialize($compare);
            if (!empty($compare)) {
                $compare_count = count($compare);
            }
        }
        return $compare_count;
    }

    protected function render_json($data, $code = 200)
    {
        $this->output
            ->set_status_header($code)
            ->set_content_type('application/json')
            ->set_output(json_encode($data));

        // force output immediately and interrupt other scripts
        global $OUT;
        $OUT->_display();
        exit;
    }

    protected function time_check()
    {
        // $date=date('d-m-Y'); //Tue Mon Wed Thu Fri Sat Sun Mon
        // $day= date("D",strtotime($date));
        // $footer_content = $this->custom_model->my_where('footer_content','*',array('id' =>'1'));
        // if(!empty(@$footer_content[0]['saturday']) || !empty(@$footer_content[0]['sunday']) || !empty(@$footer_content[0]['mon_fri']) )
        // {

        // 	if($day=='Sat')
        // 	{
        // 		$time_shope=$footer_content[0]['saturday'];
        // 	}else if($day=='Sun'){
        // 		$time_shope=$footer_content[0]['sunday'];
        // 	}else{
        // 		$time_shope=$footer_content[0]['mon_fri'];
        // 	}
        // }else{
        $time_shope = '10:00 am-10:00 pm';
        // }
        return $time_shope;
    }

    protected function related_menu($related_Procut = '', $language, $is_catetory = false)
    {
        $currency = $this->return_currency_name();
        $currency_symbol = $this->return_currency_symbol($currency, $language);
        $tax_table = $this->custom_model->my_where('tax', '*', array());

        if ($language == "en") {
            $category_table = "category";
            $brand = "brand";
            $unit_list_tb = "unit_list";
        } else {
            $category_table = "category_trans";
            $brand = "brand_trans";
            $unit_list_tb = "unit_list_trans";
        }

        if (!empty($related_Procut)) {
            foreach ($related_Procut as $key => $product) {
                $pid = $product['id'];

                if ($currency == 'USD') {
                    $single_price = $product['sale_price'] / $tax_table[0]['sar_rate'];
                    // $single_price=round($single_price);
                    $related_Procut[$key]['sale_price'] = decnum($single_price);
                } else {
                    $related_Procut[$key]['sale_price'] = decnum($product['sale_price']);
                }

                $user_review = $this->custom_model->my_where("user_rating", "*", array('pid' => $pid, 'status' => '1'));
                if (!empty($user_review)) {
                    $avg = 0;
                    foreach ($user_review as $key3 => $value) {
                        $avg += $value['rating'];
                    }
                    $avg_rating = $avg / count($user_review);
                    $related_Procut[$key]['avg_rating'] = $avg_rating;
                    $related_Procut[$key]['rating_element'] = $this->rating_element($avg_rating);
                    $related_Procut[$key]['user_count'] = count($user_review);
                } else {
                    $related_Procut[$key]['avg_rating'] = 0;
                    $related_Procut[$key]['user_count'] = 0;
                    $related_Procut[$key]['rating_element'] = $this->rating_element(0);
                }

                if ($is_catetory == true) {
                    $category = $this->custom_model->my_where($category_table, "display_name", array('id' => $product['category']));
                    $subcategory = $this->custom_model->my_where($category_table, "display_name", array('id' => $product['subcategory']));


                    if (!empty($category)) {
                        $related_Procut[$key]['category_name'] = $category[0]['display_name'];
                    }
                    if (!empty($subcategory)) {
                        $related_Procut[$key]['subcategory_name'] = $subcategory[0]['display_name'];
                    } else {
                        $related_Procut[$key]['subcategory_name'] = '';
                    }


                    $brand_data = $this->custom_model->my_where($brand, "id,brand_name", array('id' => $product['brand']));
                    if (!empty($brand_data)) {
                        $related_Procut[$key]['brand_name'] = $brand_data[0]['brand_name'];
                    } else {
                        $related_Procut[$key]['brand_name'] = '';
                    }
                }

                // $unit_list = $this->custom_model->get_data_array("SELECT id,unit_name FROM unit_list WHERE id IN (".$product['unite'].") ");
                $unit_list = $this->custom_model->my_where($unit_list_tb, "id,unit_name", array('id' => $product['unite']));

                $related_Procut[$key]['unit_list'] = $unit_list;


                if ($product['price_select'] == 1) {
                    if ($product['stock_status'] == 'instock') {
                        if ($product['stock'] == 0 || $product['stock'] < 0) {
                            $related_Procut[$key]['is_stock'] = 0;
                        } else {
                            $related_Procut[$key]['is_stock'] = 1;
                        }
                    } else {
                        $related_Procut[$key]['is_stock'] = 0;
                    }
                }


                $product_attrs = $this->custom_model->get_data_array("SELECT `item_id`,`price`,`sale_price`,`attribute_id`,`qty` FROM product_attribute WHERE `p_id` = '$pid'");
                $loop_count = $pro_att_stock = 0;
                if (!empty($product_attrs)) {
                    $related_Procut[$key]['meta_data'] = $product_attrs;
                    foreach ($related_Procut[$key]['meta_data'] as $key2 => $meta_data) {

                        if ($meta_data['qty'] == 0 || $meta_data['qty'] < 0) {
                            // $related_Procut[$key]['is_stock']=0;
                            $pro_att_stock++;
                        }
                        $item_id = $meta_data['item_id'];
                        $attribute_item = $this->custom_model->get_data_array("SELECT `item_name` FROM attribute_item WHERE `id` = '$item_id'");
                        $related_Procut[$key]['meta_data'][$key2]['size'] = $attribute_item[0]['item_name'];
                        $loop_count++;
                    }
                    if ($loop_count == $pro_att_stock) {
                        $related_Procut[$key]['is_stock'] = 0;
                    } else {
                        $related_Procut[$key]['is_stock'] = 1;
                    }
                }

                if (empty($product_attrs) && $product['price_select'] == 2) {
                    $related_Procut[$key]['is_stock'] = 0;
                }


                $pc_details = $this->custom_model->my_where("product_custimze_details", "*", array('pid' => $pid));
                if (!empty($pc_details)) {
                    $related_Procut[$key]['pc_details'] = 1;
                } else {
                    $related_Procut[$key]['pc_details'] = 0;
                }


            }
        }
        // echo '<pre>';
        // print_r($related_Procut);
        // die;
        return $related_Procut;
    }

    public function rating_element($rating)
    {
        $element = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $rating) {
                $element .= '<i class="fa fa-star green"></i>';
            } else {
                $element .= '<i class="fa fa-star"></i>';
            }
        }
        return $element;
    }

    protected function is_wishlist($related_Procut = '')
    {
        $uid = $this->session->userdata('uid');
        if (!empty($related_Procut)) {
            $my_cart = $this->custom_model->my_where("my_cart", "*", array('user_id' => $uid, 'meta_key' => 'wish_list'));
            foreach ($related_Procut as $key => $relval) {
                if (!empty($uid)) {
                    if (!empty($my_cart)) {
                        if (!empty(unserialize($my_cart[0]['content']))) {
                            $wish_list = unserialize($my_cart[0]['content']);
                            if (array_key_exists('m' . $relval['id'], $wish_list)) {
                                $related_Procut[$key]['wish_list'] = 1;
                            } else {
                                $related_Procut[$key]['wish_list'] = 0;
                            }
                        } else {
                            $related_Procut[$key]['wish_list'] = 0;
                        }
                    } else {
                        $related_Procut[$key]['wish_list'] = 0;
                    }
                } else {
                    $related_Procut[$key]['wish_list'] = '0';
                }
            }
        }
        return $related_Procut;
    }

    protected function is_compare($related_Procut)
    {
        $uid = $this->session->userdata('uid');
        if (!empty($related_Procut)) {
            $compare_data = array();
            if (!empty($uid)) {
                $is_data = $this->custom_model->my_where("my_cart", "*", array('user_id' => $uid, 'meta_key' => 'compare'));
                if (!empty($is_data) && !empty($is_data[0]['content'])) {
                    $compare_data = unserialize($is_data[0]['content']);
                    if (!empty($compare_data)) {
                        $this->session->set_userdata('compare', serialize($compare_data));
                    }
                }
            } else {
                $is_data = $this->session->userdata('compare');
                $compare_data = unserialize($is_data);
            }

            foreach ($related_Procut as $key => $relval) {
                if (!empty($compare_data)) {
                    if (array_key_exists('m' . $relval['id'], $compare_data)) {
                        $related_Procut[$key]['is_compare'] = 'checked';
                    } else {
                        $related_Procut[$key]['is_compare'] = '';
                    }
                } else {
                    $related_Procut[$key]['is_compare'] = '';
                }
            }
        }
        return $related_Procut;
    }


}

// include base controllers
require APPPATH . "core/controllers/Admin_Controller.php";
require APPPATH . "core/controllers/Api_Controller.php";
