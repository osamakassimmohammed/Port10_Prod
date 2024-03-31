<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Home page
 */
class Price extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('User_model');
        $this->load->model('admin/Custom_model', 'custom_model');
    }

    public function index()
    {
        $language = $this->uri->segment(1);

        if ($language == "en") {
            $subs_plans = "subs_plans";
            $sub_more = "sub_more";
        } else {
            $subs_plans = "subs_plans_trans";
            $sub_more = "sub_more_trans";
        }

        $tax_table = $this->custom_model->my_where('tax', '*', array());
        $currency = $this->return_currency_name();
        $currency_symbol = $this->return_currency_symbol($currency, $language);

        $subs_plans = $this->custom_model->get_data_array("SELECT * FROM $subs_plans ");

        if (!empty($subs_plans)) {
            if ($currency == 'USD') {
                $single_price = $subs_plans[0]['amount'] / $tax_table[0]['sar_rate'];
                $subs_plans[0]['amount'] = decnum($single_price);
            }

            $sub_more_data = $this->custom_model->get_data_array("SELECT * FROM $sub_more ");
            $subs_plans[0]['sub_more_data'] = $sub_more_data;
        }

        // echo "<pre>";
        // print_r($subs_plans);
        // die;

        $this->mViewData['subs_plans'] = $subs_plans;
        $this->mViewData['currency_symbol'] = $currency_symbol;

        $this->Urender('price', 'udefault');
    }
}
