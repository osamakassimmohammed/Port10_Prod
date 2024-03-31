<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| CI Bootstrap 3 Configuration
| -------------------------------------------------------------------------
| This file lets you define default values to be passed into views
| when calling MY_Controller's render() function.
|
| See example and detailed explanation from:
| 	/application/config/ci_bootstrap_example.php
*/

$config['ci_bootstrap'] = array(

    // Site name
    'site_name' => 'Port10',

    // Default page title prefix
    'page_title_prefix' => '',

    // Default page title
    'page_title' => '',

    // Default meta data
    'meta_data' => array(
        'author' => '',
        'description' => '',
        'keywords' => ''
    ),

    /*
    // Default scripts to embed at page head or end
    'scripts' => array(
        'head'	=> array(
            'assets/dist/admin/adminlte.min.js',
            'assets/dist/admin/lib.min.js',
            'assets/dist/admin/app.min.js'
        ),
        'foot'	=> array(
        ),
    ),


    // Default stylesheets to embed at page head
    'stylesheets' => array(
        'screen' => array(
            'assets/dist/admin/adminlte.min.css',
            'assets/dist/admin/lib.min.css',
            'assets/dist/admin/app.min.css'
        )
    ),*/

    // Default scripts to embed at page head or end
    'scripts' => array(
        'head' => array(
            'assets/admin/js/jquery.min.js',
            'assets/admin/js/bootstrap.js',
            // 'assets/admin/js/bootstrap-select.min.js',
            'assets/admin/js/jquery.slimscroll.js',
            'assets/admin/js/jquery.inputmask.bundle.js',
            'assets/admin/js/sweetalert.min.js',
            'assets/admin/js/dialogs.js',
            'assets/admin/js/waves.js',
            /*'assets/admin/js/jquery.flot.js',
            'assets/admin/js/jquery.flot.resize.js',
            'assets/admin/js/jquery.flot.pie.js',*/
            'assets/admin/js/Chart.bundle.js',
            'assets/admin/js/admin.js',
            // 'assets/admin/js/demo.js',
            'assets/admin/js/jquery.validate.js',
            'assets/admin/js/jquery.steps.min.js',
            //'assets/admin/js/select2.min.js',
            'assets/admin/js/form-wizard.js',
            'assets/admin/js/advanced-form-elements.js',
            'assets/admin/js/bootstrap-tagsinput.js',
            'assets/admin/js/ckeditor/ckeditor.js',
            'assets/admin/js/bootstrap-material-datetimepicker/js/moment.js',
            'assets/admin/js/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            'assets/admin/js/chosen.jquery.js',
            'assets/admin/js/viewer.min.js',
        ),
        'foot' => array(),
    ),

    // Default stylesheets to embed at page head
    'stylesheets' => array(
        'screen' => array(
            'assets/admin/css/roboto.css',
            'assets/admin/css/fonts_popins.css',
            'assets/admin/css/material_icons.css',
            'assets/admin/css/bootstrap.css',
            //'assets/admin/css/bootstrap-select.min.css',
            'assets/admin/css/waves.css',
            'assets/admin/css/animate.css',
            'assets/admin/css/morris.css',
            'assets/admin/css/style.css',
            'assets/admin/css/all-themes.css',
            'assets/admin/css/mystyle.css',
            'assets/admin/css/sweetalert.css',
            //'assets/admin/css/select2.min.css',
            'assets/admin/css/bootstrap-tagsinput.css',
            'assets/admin/js/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            'assets/admin/css/chosen.css',
            'assets/admin/css/viewer.min.css'
        )
    ),

    // Default CSS class for <body> tag
    'body_class' => '',

    // Multilingual settings
    // 'languages' => array(
    // ),
    // Multilingual settings
    'languages' => array(
        'default' => 'en',
        'autoload' => array('general'),
        'available' => array(
            'en' => array(
                'label' => 'English',
                'value' => 'english'
            ),
            'ar' => array(
                'label' => 'العربية',
                'value' => 'arabic'
            )
        )
    ),

    // Menu items
    'menu' => array(

        'dashbord' => array(
            'name' => 'Dashbord',
            'url' => '',
            'icon' => 'dashboard',
        ),


        'users' => array(
            'name' => 'Customer List',
            'url' => 'users',
            'icon' => 'group',
            'children' => array(
                'Buyer List' => 'users',
                'Supplier List' => 'users/supplier_list',
                'Supplier Sub Trial' => 'users/supplier_list/trial',
                'Supplier Sub Active' => 'users/supplier_list/active',
                'Supplier Sub Expired' => 'users/supplier_list/expired',
                'Supplier Remitter' => 'users/supplier_excel',
            )
        ),

        'orders' => array(
            'name' => 'Orders',
            'url' => 'orders',
            'icon' => 'shopping_cart',
            'children' => array(
                'Orders' => 'orders',
                'Today New order' => 'orders/new_api_order',
                'Paid order' => 'orders/paid_order',
                'Unpaid order' => 'orders/unpaid_order',
                'Bank Excel' => 'orders/bank_excel',
                'Admin Fees' => 'orders/admin_fees',
                // 'Pending order'			=> 'orders/pending_order',
                // 'Cancel order'			=> 'orders/cancel_order',
                // 'Completed order'		=> 'orders/completed_order',
            )
        ),

        'vorders' => array(
            'name' => 'Orders',
            'url' => 'vorders',
            'icon' => 'shopping_cart',
        ),

        // 'vorders' => array(
        // 	'name'		=> 'Supplier Order',
        // 	'url'		=> 'vorders',
        // 	'icon'		=> 'shopping_cart',
        // 	'children'  => array(
        // 		'All Order'				=> 'vorders',
        // 		'Today New Order'		=> 'vorders/today_order',
        // 		'Pending Order'			=> 'vorders/pending_order',
        // 		'Cancel Order'			=> 'vorders/cancel_order',
        // 		'Completed Order'		=> 'vorders/completed_order',
        // 	)
        // ),


        'assign_quotation' => array(
            'name' => 'Quotation',
            'url' => 'assign_quotation',
            'icon' => 'group',
            'children' => array(
                'Listing' => 'assign_quotation',
            )
        ),

        'receive_quotation' => array(
            'name' => 'Quotation',
            'url' => 'receive_quotation',
            'icon' => 'group',
        ),

        'category' => array(
            'name' => 'Category',
            'url' => 'category',
            'icon' => 'widgets',
            'children' => array(
                'List' => 'category',
                // 'Create'		=> 'category/create',
            )
        ),

        'subs_plans' => array(
            'name' => 'Subscription Plan',
            'url' => 'subs_plans',
            'icon' => 'group',
            'children' => array(
                'Listing' => 'subs_plans',
                'Subscription More' => 'subs_plans/sub_more',
            )
        ),

        // 'attribute' => array(
        //       	'name'		=> 'Product Sizes ',
        //       	'url'		=> 'attribute/attribute_item',
        //       	'icon'		=> 'add_a_photo',
        //           	),

        // 'product' => array(
        // 	'name'		=> 'Product',
        // 	'url'		=> 'product',
        // 	'icon'		=> 'widgets',
        // 	'children'  => array(
        // 		'List'			=> 'product/list1',
        // 		'Create'		=> 'product/create',
        // 		'Brand Listing'		=> 'product/brand_index',
        // 		'Brand Create'		=> 'product/brand_create',
        // 	)
        // ),

        'brand' => array(
            'name' => 'Brands',
            'url' => 'brand',
            'icon' => 'wb_auto',
        ),

        'product/list1' => array(
            'name' => 'Product',
            'url' => 'product/list1',
            'icon' => 'add_a_photo',
        ),

        'chat' => array(
            'name' => 'Messages',
            'url' => 'chat',
            'icon' => 'chat',
            /*'children'  => array(
            'Messaging'			=> 'chat',
            )*/
        ),

        'panel/account' => array(
            'name' => 'Account Settings',
            'url' => 'panel/account',
            'icon' => 'settings',
            // 'children'  => array(
            // 	'Edit Profile'			=> 'panel/account',
            // 	// 'Subscription History'			=> 'panel/supplier_sub',
            // 	)
        ),

        // 'panel/supplier_sub' => array(
        //     'name'      => 'Subscription History',
        //     'url'       => 'panel/supplier_sub',
        //     'icon'      => 'subscriptions',
        //     // 'children'  => array(
        //     //     'Edit Profile'          => 'panel/account',
        //     //     'Subscription History'          => 'panel/supplier_sub',
        //     //     )
        // ),

        'blog' => array(
            'name' => 'Blog ',
            'url' => 'blog',
            'icon' => 'add_a_photo',
            'children' => array(
                'List' => 'blog',
                'Create' => 'blog/create',
            )
        ),

        'help' => array(
            'name' => 'Help ',
            'url' => 'help',
            'icon' => 'add_a_photo',
            'children' => array(
                'Faq List' => 'help',
                'Faq Create' => 'help/create',
                'Tutorial List' => 'help/tutorial',
                'Tutorial Add' => 'help/tutorial_create',
            )
        ),

        'email' => array(
            'name' => 'Newsletter',
            'url' => 'email',
            'icon' => 'add_a_photo',
            'children' => array(
                'Subscribe Email' => 'email/index',
            )
        ),

        // 'tax' => array(
        // 	'name'		=> 'TAX',
        // 	'url'		=> 'tax',
        // 	'icon'		=> 'group',
        // ),

        'home_data' => array(
            'name' => 'Home Data',
            'url' => 'home_data',
            'icon' => 'widgets',
            'children' => array(
                'Banner List' => 'home_data',
                'Banner Create' => 'home_data/banner_create',
                // 'Section one'		=> 'home_data/section_one',
                // 'Testimonial List'		=> 'home_data/testimonial',
                // 'Testimonial Create'		=> 'home_data/testimonial_create',
                'Footer Data' => 'home_data/footer_data',
                'Home Page Product Display' => 'home_data/product_advertise',
                // 'Bottom Banner'		=> 'home_data/single_image',
            )
        ),

        'email_send' => array(
            'name' => 'Email Send',
            'url' => 'email_send',
            'icon' => 'widgets',
            'children' => array(
                'Email List' => 'email_send',
                'Create' => 'email_send/create',
            )
        ),

        // 'vouchers' => array(
        // 	'name'		=> 'Vouchers',
        // 	'url'		=> 'vouchers',
        // 	'icon'		=> 'widgets',
        // 	'children'  => array(
        // 		'Vouchers List' => 'vouchers',
        // 		'Create'		=> 'vouchers/create',
        // 	)
        // ),


        'pages' => array(
            'name' => 'Pages',
            'url' => 'pages',
            'icon' => 'pages',
            'children' => array(
                'List' => 'pages',
                // 'Create'		=> 'pages/create',
            )
        ),

        'tax' => array(
            'name' => 'Tax Percentage',
            'url' => 'tax/index',
            'icon' => 'control_point',
        ),


        /*'pcustomize' => array(
            'name'		=> 'Customize',
            'url'		=> 'pcustomize',
            'icon'		=> 'widgets',
            'children'  => array(
                'List'			=> 'pcustomize/list',
                'Create'		=> 'pcustomize',
            )
        ),

        */


        // 'application' => array(
        // 	'name'		=> 'Application Content',
        // 	'url'		=> 'application',
        // 	'icon'		=> 'widgets',
        // 	'children'  => array(
        // 		'Banner'				=> 'application/banner',

        // 	)
        // ),


        // 'api' => array(
        //       	'name'		=> 'Api ',
        //       	'url'		=> 'api',
        //       	'icon'		=> 'add_a_photo',
        //           	),


        // 'logout' => array(
        // 	'name'		=> 'Sign Out',
        // 	'url'		=> 'panel/logout',
        // 	'icon'		=> 'input',
        // )
    ),
    'sub_seller_menu' => array(

        'dashbord' => array(
            'name' => 'Dashbord',
            'url' => '',
            'icon' => 'dashboard',
            'flag' => 'dashbord',
        ),
        'receive_quotation' => array(
            'name' => 'Quotation',
            'url' => 'receive_quotation',
            'icon' => 'group',
            'flag' => 'receive_quotation',
        ),
        'vorders' => array(
            'name' => 'Orders',
            'url' => 'vorders',
            'icon' => 'shopping_cart',
            'flag' => 'vorders',
        ),
        'brand' => array(
            'name' => 'Brands',
            'url' => 'brand',
            'icon' => 'wb_auto',
            'flag' => 'brand',
        ),

        'product/list1' => array(
            'name' => 'Product',
            'url' => 'product/list1',
            'icon' => 'add_a_photo',
            'flag' => 'product',
        ),
        'chat' => array(
            'name' => 'Messages',
            'url' => 'chat',
            'icon' => 'chat',
            'flag' => 'chat',
        ),
        'panel/account' => array(
            'name' => 'Account Settings',
            'url' => 'panel/account',
            'icon' => 'settings',
            'flag' => 'panel',
        ),

    ),
    // Login page
    'login_url' => 'admin/login',

    // Restricted pages

    'page_auth' => array(
        // 'useful_links'					=> array('webmaster', 'admin', 'manager'),
        'user' => array('webmaster', 'admin', 'manager'),
        'user/create' => array('webmaster', 'admin', 'manager'),
        'user/group' => array('webmaster', 'admin', 'manager'),
        'util' => array('webmaster'),
        'util/list_db' => array('webmaster'),
        'util/backup_db' => array('webmaster'),
        'util/restore_db' => array('webmaster'),
        'util/remove_db' => array('webmaster'),
        'assign_quotation' => array('webmaster'),
        'tax/index' => array('webmaster'),
        'blog' => array('webmaster', 'admin'),
        'category' => array('webmaster', 'admin'),
        'help' => array('webmaster', 'admin'),
        'pages' => array('webmaster', 'admin'),
        'email_send' => array('webmaster', 'admin'),
        'home_data' => array('webmaster', 'admin'),
        'orders' => array('webmaster', 'admin'),
        'users' => array('webmaster', 'admin'),
        'attribute' => array('webmaster', 'admin'),
        'subs_plans' => array('webmaster', 'admin'),
        'email' => array('webmaster'),
        'vorders' => array('vendor', 'subsupplier'),
        'receive_quotation' => array('vendor', 'subsupplier'),
        'chat' => array('webmaster', 'vendor', 'admin', 'subsupplier'),
        // 'panel'				=> array('vendor'),
    ),

    // AdminLTE settings
    'adminlte' => array(
        'body_class' => array(
            'webmaster' => 'theme-light-green',
            'admin' => 'theme-light-green',
            'manager' => 'theme-light-green',
            'staff' => 'theme-light-green',
            'partner' => 'theme-light-green',
            'vendor' => 'theme-light-green',
            'branch' => 'theme-light-green',
            'subsupplier' => 'theme-light-green',
        )
    ),

    // Useful links to display at bottom of sidemenu
    'useful_links' => array(
        array(
            'auth' => array('webmaster', 'admin', 'manager', 'vendor'),
            'name' => 'Frontend Website',
            'url' => '',
            'target' => '_blank',
            'color' => 'text-aqua'
        ),
    ),

    // Debug tools
    'debug' => array(
        'view_data' => FALSE,
        'profiler' => FALSE
    ),
);

/*
| -------------------------------------------------------------------------
| Override values from /application/config/config.php
| -------------------------------------------------------------------------
*/
// $config['sess_cookie_name'] = 'ci_session_admin';
$config['sess_cookie_name'] = 'ci_session_frontend';
