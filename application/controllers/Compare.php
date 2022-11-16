<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Compare
 */
class Compare extends MY_Controller {

	public function __construct()
	{
		$this->load->model('admin/Custom_model','custom_model');
		
	}

  public function index()
  {
    $language= $this->uri->segment(1);    
    if($language=="en")
    {
      $product = "product";
    }else{
      $product = "product_trans";
    }  
    $uid = $this->session->userdata('uid');

    $compare_data=$product_data=array();
    if (!empty($uid))
    {
      $is_data = $this->custom_model->my_where('my_cart','*',array('user_id' => $uid,'meta_key' => 'compare'));
      if(!empty($is_data))
      {
        $compare_data = unserialize($is_data[0]['content']);
      }
    }else{
      // echo 1111; die;
      $compare_data = unserialize($this->session->userdata('compare'));
    } 

      // echo "<pre>";
      // print_r($compare_data);
      // die;
    if(!empty($compare_data))
    {
      $stirng="";
      foreach ($compare_data as $key => $val) 
      {
        $stirng.=$val['pid'].',';
      }
       $stirng=rtrim($stirng,',');
       $sub_query=" WHERE pro.product_delete!='1'  AND admin.is_terminate='0' AND pro.status='1' AND pro.id IN (".$stirng.") ";
      $order_by=' order by pro.id desc limit 12 '; 
      $product_data = $this->custom_model->get_data_array("SELECT pro.id,pro.product_name,pro.category,pro.subcategory,pro.price,pro.sale_price,pro.stock_status,pro.stock,pro.product_image,pro.status,pro.price_select,pro.brand,pro.unite,pro.min_order_quantity,pro.short_description,pro.weight,pro.length,pro.width,pro.height FROM $product as pro INNER JOIN admin_users as admin ON pro.seller_id=admin.id $sub_query $order_by ");

      $product_data=$this->related_menu($product_data,$language,$is_catetory=true);
      $product_data=$this->is_wishlist($product_data);
    }
    // echo "111<pre>";
    // print_r($stirng);
    // print_r($compare_data);
    // print_r($product_data);
    // die;    

    $this->mViewData['product_data'] =$product_data;
    $this->Urender('compare', 'udefault'); 
  }


}

?>

