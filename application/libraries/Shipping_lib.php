<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Library to add cart/ add wish list
 */
class Shipping_lib {

	/// thise are test key

  // protected $shi_UserName='reem@reem.com';
  // protected $shi_Password='123456789';
  // protected $shi_Version='1.0';
  // protected $shi_AccountNumber='4004636';
  // protected $shi_AccountPin='432432';
  // protected $shi_AccountEntity='RUH';
  // protected $shi_AccountCountryCode='SA';
  // protected $shi_Source=24;
  // protected $shi_CountryCode='SA';
  // protected $shi_url='https://ws.dev.aramex.net/ShippingAPI.V2/';


  protected $shi_UserName='armx.ruh.it@gmail.com';
  protected $shi_Password='YUre@9982';
  protected $shi_Version='v1';
  protected $shi_AccountNumber='4004636';
  protected $shi_AccountPin='442543';
  protected $shi_AccountEntity='RUH';
  protected $shi_AccountCountryCode='SA';
  protected $shi_Source=24;
  protected $shi_CountryCode='SA';
  protected $shi_url='https://ws.aramex.net/ShippingAPI.V2/';
  // protected $shi_UserName='testingapi@aramex.com';
  // protected $shi_Password='R123456789$r';
  // protected $shi_Version='v1';
  // protected $shi_AccountNumber='60536338';
  // protected $shi_AccountPin='543543';
  // protected $shi_AccountEntity='RUH';
  // protected $shi_AccountCountryCode='SA';
  // protected $shi_Source=24;
  // protected $shi_CountryCode='SA';
  // protected $shi_url='https://ws.aramex.net/ShippingAPI.V2/';

  // https://ws.sbx.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc/
//   "UserName": "testingapi@aramex.com",
// "Password": "R123456789$r",
// "Version": "v1",
// "AccountNumber": "4004636",
// "AccountPin": "432432",
// "AccountEntity": "RUH",
// "AccountCountryCode": "SA",
// "Source": 24

	public function __construct()
	{
		// Assign the CodeIgniter super-object
		$this->CI =& get_instance();
		$this->CI->load->model('admin/Custom_model','custom_model');
		// $this->order_datetime = date('Y-m-d H:i:s');
		// date_default_timezone_set('Asia/Kolkata');
	}

	public function get_ClientInfo()
	{
		$ClientInfo=array();
    $ClientInfo['UserName']=$this->shi_UserName;
    $ClientInfo['Password']=$this->shi_Password;
    $ClientInfo['Version']=$this->shi_Version;
    $ClientInfo['AccountNumber']=$this->shi_AccountNumber;
    $ClientInfo['AccountPin']=$this->shi_AccountPin;
    $ClientInfo['AccountEntity']=$this->shi_AccountEntity;
    $ClientInfo['AccountCountryCode']=$this->shi_AccountCountryCode;
    $ClientInfo['Source']=$this->shi_Source;
    return $ClientInfo;
	}

	public function get_DestinationAddress($send_data)
  {
    // $DestinationAddress['PostCode']=$send_data['postal_code'];
  //  print_r($send_data['postal_code']);
    $DestinationAddress=array();
    if(isset($send_data['street_name']))
    {
       $DestinationAddress['Line1']=$send_data['street_name'];
    }else{
      $DestinationAddress['Line1']=$send_data['address_1'];
    }
    if(isset($send_data['google_address']))
    {
      $DestinationAddress['Line2']=empty($send_data['google_address'])? null:$send_data['google_address'];
    }else{
      $DestinationAddress['Line2']=null;
    }

    // print_r($code);die;
    $DestinationAddress['Line3']='';
    $DestinationAddress['City']=$send_data['city'];
    $DestinationAddress['StateOrProvinceCode']='';
    $DestinationAddress['PostCode']=$send_data['postal_code'] ?? '';
    $DestinationAddress['CountryCode']=$this->shi_CountryCode;
    if(isset($send_data['lng']))
    {
      $DestinationAddress['Longitude']=empty($send_data['lng'])? 0:$send_data['lng'];
      $DestinationAddress['Latitude']=empty($send_data['lat'])? 0:$send_data['lat'];
    }else{
      $DestinationAddress['Longitude']=0;
      $DestinationAddress['Latitude']=0;
    }
    $DestinationAddress['BuildingNumber']=null;
    if(isset($send_data['building_no']))
    {
      $DestinationAddress['BuildingNumber']=$send_data['building_no'];
    }
    $DestinationAddress['BuildingName']=null;
    $DestinationAddress['Floor']=null;
    $DestinationAddress['Apartment']=null;
    $DestinationAddress['POBox']=null;
    $DestinationAddress['Description']=null;
    // $DestinationAddress['Description']='Name: '.$send_data['first_name'].' '.$send_data['last_name'].' Email: '.$send_data['email'].' Mobile No: '.$send_data['mobile_no'];
      //  print_r($DestinationAddress);exit();
    return $DestinationAddress;
  }

  public function get_OriginAddress($orignin_data)
  {
    $OriginAddress=array();
    $OriginAddress['Line1']=$orignin_data['street_name'];
    $OriginAddress['Line2']=empty($orignin_data['warehouse_location'])? null:$orignin_data['warehouse_location'];
    $OriginAddress['Line3']='';
    $OriginAddress['City']=$orignin_data['city'];
    $OriginAddress['StateOrProvinceCode']='';
    $OriginAddress['PostCode']=$orignin_data['postal_code'];
    $OriginAddress['CountryCode']=$this->shi_CountryCode;
    $OriginAddress['Longitude']=empty($orignin_data['lng'])? 0:$orignin_data['lng'];
    $OriginAddress['Latitude']=empty($orignin_data['lat'])? 0:$orignin_data['lat'];
    $OriginAddress['BuildingNumber']=$orignin_data['building_no'];
    $OriginAddress['BuildingName']=null;
    $OriginAddress['Floor']=null;
    $OriginAddress['Apartment']=null;
    $OriginAddress['POBox']=null;
    $OriginAddress['Description']=null;
    return $OriginAddress;
  }

  public function get_shipping_rate($products,$send_data,$currency='SAR')
  {
    $send_data['postal_code'] = $send_data['pincode'];
    $total_amount=$i=0;
    $is_single_pro_error=false;
    $info_arr=array();
    if(!empty($products))
    {
      $DestinationAddress=$this->get_DestinationAddress($send_data);
      $ClientInfo=$this->get_ClientInfo();

      foreach ($products as $key => $val)
      {
        $product_data = $this->CI->custom_model->get_data_array("SELECT pro.product_name,pro.price,pro.sale_price,pro.weight,pro.weight_unit,pro.city,pro.warehouse_location,pro.city,pro.lat,pro.lng,pro.weight_unit,pro.weight,pro.length,pro.width,pro.height,pro.is_delivery_available,admin.street_name,admin.building_no,admin.city as ad_city,admin.state,admin.postal_code FROM product as pro INNER JOIN admin_users as admin ON pro.seller_id=admin.id WHERE pro.id='".$val['pid']."'  ");
        // print_r($product_data);

        if(!empty($product_data))
        {
          if($product_data[0]['is_delivery_available']==1)
          {
            $weight_value = $this->weight_farmula($product_data[0]['weight'],$product_data[0]['weight_unit']);

          	$OriginAddress=$this->get_OriginAddress($product_data[0]);
          	$ShipmentDetails=$Transaction=$shipping_arr=array();
          	$ShipmentDetails['Dimensions']=null;
          	$ShipmentDetails['ActualWeight']=array("Unit"=>"KG","Value"=>$weight_value);
          	$ShipmentDetails['ChargeableWeight']=null;
          	$ShipmentDetails['DescriptionOfGoods']=$product_data[0]['product_name'];
          	$ShipmentDetails['GoodsOriginCountry']=$this->shi_CountryCode;
          	$ShipmentDetails['NumberOfPieces']=$val['qty'];
          	$ShipmentDetails['ProductGroup']='EXP';
          	$ShipmentDetails['ProductType']='PPX';
            // $ShipmentDetails['ProductGroup']='DOM';
            // $ShipmentDetails['ProductType']='CDS';
            $ShipmentDetails['PaymentType']='P';
          	$ShipmentDetails['PaymentOptions']='';
          	$ShipmentDetails['CustomsValueAmount']=null;
          	$ShipmentDetails['CashOnDeliveryAmount']=null;
          	$ShipmentDetails['InsuranceAmount']=null;
          	$ShipmentDetails['CashAdditionalAmount']=null;
          	$ShipmentDetails['CashAdditionalAmountDescription']=null;
          	$ShipmentDetails['CollectAmount']=null;
          	$ShipmentDetails['Services']='';
          	$ShipmentDetails['Items']=null;
          	$ShipmentDetails['DeliveryInstructions']=null;

            $Transaction['Reference1']='';
            $Transaction['Reference2']='';
            $Transaction['Reference3']='';
            $Transaction['Reference4']='';
            $Transaction['Reference5']='';

            $shipping_arr['ClientInfo']=$ClientInfo;
            $shipping_arr['DestinationAddress']=$DestinationAddress;
            $shipping_arr['OriginAddress']=$OriginAddress;
            $shipping_arr['PreferredCurrencyCode']='SAR';
            $shipping_arr['ShipmentDetails']=$ShipmentDetails;
            $shipping_arr['Transaction']=$Transaction;
            // echo "<pre>";
            // print_r('hi');
            // exit();

            $shipping_arr = json_encode($shipping_arr);
            // print_r("hi");

            // echo "<pre>";  
            // print_r($shipping_arr);
            // exit();
            // die;
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $this->shi_url.'RateCalculator/Service_1_0.svc/json/CalculateRate',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>$shipping_arr,
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json'
              ),
            ));

            $response = curl_exec($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

          //  print_r(json_decode($response,true));
          //   exit();

            if($httpcode==200)
            {
              $response=json_decode($response,true);
              if($response['HasErrors']==false)
              {
                $info_arr['data'][$key]['pid']=$val['pid'];
                $info_arr['data'][$key]['amount']=$response['TotalAmount']['Value'];
                $info_arr['data'][$key]['error']=0;
                $info_arr['data'][$key]['error_message']=Null;
                $info_arr['data'][$key]['currency']=$response['TotalAmount']['CurrencyCode'];
                $total_amount=$response['TotalAmount']['Value']+$total_amount;
              }else{
                $is_single_pro_error=true;
                $info_arr['data'][$key]['pid']=$val['pid'];
                $info_arr['data'][$key]['error']=1;
                $info_arr['data'][$key]['error_message']=$response['Notifications'][0]['Message'];
                $info_arr['data'][$key]['error_code']=$response['Notifications'][0]['Code'];
              }
            }else{
              $is_single_pro_error=true;
              $info_arr['data'][$key]['pid']=$val['pid'];
              $info_arr['data'][$key]['error']=1;
              $info_arr['data'][$key]['error_message']='Pad string passed';
              $info_arr['data'][$key]['error_code']=Null;
            }
          }else{
              $info_arr['data'][$key]['pid']=$val['pid'];
              $info_arr['data'][$key]['amount']=0;
              $info_arr['data'][$key]['error']=0;
              $info_arr['data'][$key]['error_message']='';
              $info_arr['data'][$key]['error_code']=Null;
          }
        }else{
          $info_arr['data'][$key]['pid']=$val['pid'];
          $info_arr['data'][$key]['error']=1;
          $info_arr['data'][$key]['error_message']='Product Not Found';
          $info_arr['data'][$key]['error_code']=Null;
        }
        // $i++;
        $info_arr['TotalAmount']=$total_amount;
        $info_arr['status']=true;
        $info_arr['is_single_pro_error']=$is_single_pro_error;
        $info_arr['message']='';
      }
    }else{
      $info_arr['status']=false;
      $info_arr['message']='Something Went Wrong';
    }
    return $info_arr;
  }

  public function weight_farmula($weight,$unit)
  {
    $value=0;
    if(!empty($weight))
    {
      if($unit=="G")
      {
        $value=$weight/1000;
      }else if($unit=="T")
      {
        $value=$weight*1000;
      }else if($unit=="KG")
      {
        $value=$weight;
      }
    }
    return $value;
  }

  public function create_shipments($order_items,$is_order,$seller_data,$post_data)
  {
    $info_arr=array();
    // print_r($is_order);
    $is_order[0]['pincode'] = $is_order[0]['postal_code'] ?? '';
    // $is_order[0]['pincode'] = $is_order[0]['pincode'];

    if(!empty($order_items) && !empty($is_order) && !empty($seller_data) && !empty($post_data) )
    {
        $currency="SAR";
        $ClientInfo=$this->get_ClientInfo();
        $PickupAddress=$this->get_DestinationAddress($seller_data[0]);

        // print_r($ClientInfo);
        // exit();
        $PickupContact=$this->get_PickupContact($seller_data[0]);

        $PartyAddress=$this->get_DestinationAddress($is_order[0]);

        // print_r($PartyAddress);

        // exit();
        $is_order[0]['phone'] = $is_order[0]['mobile_no'];
        $Contact=$this->get_PickupContact($is_order[0]);

        $create_shipments_arr=$LabelInfo=$Items=array();
        $weight_value_all=$quantity_all=0;
        $product_name_all='';
        $CollectAmount=null;
        if($order_items[0]['payment_status']=="Paid")
        {
          $CollectAmount=$order_items[0]['net_total'];
        }
      //   foreach ($products as $key => $val)
      // {
      //   $product_data = $this->CI->custom_model->get_data_array("SELECT pro.product_name,pro.price,pro.sale_price,pro.weight,pro.weight_unit,pro.city,pro.warehouse_location,pro.city,pro.lat,pro.lng,pro.weight_unit,pro.weight,pro.length,pro.width,pro.height,pro.is_delivery_available,admin.street_name,admin.building_no,admin.city as ad_city,admin.state,admin.postal_code FROM product as pro INNER JOIN admin_users as admin ON pro.seller_id=admin.id WHERE pro.id='".$val['pid']."'  ");
        foreach ($order_items as $ori_key => $ori_val)
        {
          $productData = $this->CI->custom_model->get_data_array("SELECT product_name,packaging_type, req_loading , vehical_requirement, is_hazardous, hazardous_specify,price,sale_price,weight,weight_unit,city,warehouse_location,lat,lng,weight_unit,weight,length,width,height,is_delivery_available FROM product  WHERE id='".$ori_val['product_id']."'");

          $product_name_all=$ori_val['product_name'].','.$product_name_all;
          $quantity_all=$ori_val['quantity']+$quantity_all;
          $weight_value = $this->weight_farmula($productData[0]['weight'],$productData[0]['weight_unit']);
          $weight_value_all=$weight_value+$weight_value;

          $Items[$ori_key]['PackageType']=$productData[0]['packaging_type'];
          $Items[$ori_key]['Quantity']=$ori_val['quantity'];
          $Items[$ori_key]['Weight']=array("Unit"=>"KG","Value"=>$weight_value);
          $comment='Requirement for Loading:- '.$productData[0]['req_loading'].', Vehicle Requirement:- '.$productData[0]['vehical_requirement'].', is this hazardous material:- '.$productData[0]['is_hazardous'];
          if(!empty($productData[0]['hazardous_specify']))
          {
            $comment.=' '.$productData[0]['hazardous_specify'];
          }
          $Items[$ori_key]['Comments']=$comment;
          // $Items[$ori_key]['Reference']=$productData[0]['trans_ref'];
        }

        $product_name_all=trim($product_name_all,',');

        $create_shipments_arr['ClientInfo']=$ClientInfo;
        $create_shipments_arr['LabelInfo']=null;

        $create_shipments_arr['Shipments'][0]['Reference1']=$is_order[0]['display_order_id'];
        // $create_shipments_arr['Shipments'][0]['Reference2']=$is_order[0]['invoice_ref'];
        $create_shipments_arr['Shipments'][0]['Reference3'] = $post_data['Shipment_Reference_Note'];;

        $create_shipments_arr['Shipments'][0]['Shipper']['Reference1']="";
        $create_shipments_arr['Shipments'][0]['Shipper']['Reference2']="";
        $create_shipments_arr['Shipments'][0]['Shipper']['AccountNumber']=$this->shi_AccountNumber;


        $create_shipments_arr['Shipments'][0]['Shipper']['PartyAddress']=$PickupAddress;
        $create_shipments_arr['Shipments'][0]['Shipper']['Contact']=$PickupContact;

        $create_shipments_arr['Shipments'][0]['Consignee']['Reference1']='';
        $create_shipments_arr['Shipments'][0]['Consignee']['Reference2']='';
        $create_shipments_arr['Shipments'][0]['Consignee']['AccountNumber']='';
        $create_shipments_arr['Shipments'][0]['Consignee']['PartyAddress']=$PartyAddress;
        $create_shipments_arr['Shipments'][0]['Consignee']['Contact']=$Contact;

        $create_shipments_arr['Shipments'][0]['ThirdParty']['Reference1']='';
        $create_shipments_arr['Shipments'][0]['ThirdParty']['Reference2']='';
        $create_shipments_arr['Shipments'][0]['ThirdParty']['AccountNumber']='';
        $create_shipments_arr['Shipments'][0]['ThirdParty']['PartyAddress']=$this->empty_PartyAddress();
        $create_shipments_arr['Shipments'][0]['ThirdParty']['Contact']=$this->empty_Contact();

        $create_shipments_arr['Shipments'][0]['ShippingDateTime']=$this->get_time_stamp($post_data['ShippingDateTime'],'datetime');
        $create_shipments_arr['Shipments'][0]['DueDate']=$this->get_time_stamp($post_data['DueDate'],'datetime');

        $create_shipments_arr['Shipments'][0]['Comments']='test';
        $create_shipments_arr['Shipments'][0]['PickupLocation']='';
        $create_shipments_arr['Shipments'][0]['OperationsInstructions']='';
        $create_shipments_arr['Shipments'][0]['AccountingInstrcutions']='';

        $ShipmentDetails['Dimensions']=null;
        $ShipmentDetails['ActualWeight']=array("Unit"=>"KG","Value"=>$weight_value_all);
        // $ShipmentDetails['ActualWeight']=array("Unit"=>null,"Value"=>null);
        $ShipmentDetails['ChargeableWeight']=null;
        $ShipmentDetails['DescriptionOfGoods']=$product_name_all;
        $ShipmentDetails['GoodsOriginCountry']=$this->shi_CountryCode;
        $ShipmentDetails['NumberOfPieces']=$quantity_all;
        $ShipmentDetails['ProductGroup']='DOM';
        $ShipmentDetails['ProductType']='CDS';
        $ShipmentDetails['PaymentType']='P';
        $ShipmentDetails['PaymentOptions']='';
        $ShipmentDetails['CustomsValueAmount']=array("CurrencyCode"=>$currency,"Value"=>$is_order[0]['shipping_charge']);
        $ShipmentDetails['CashOnDeliveryAmount']=null;
        $ShipmentDetails['InsuranceAmount']=null;
        $ShipmentDetails['CashAdditionalAmount']=null;
        $ShipmentDetails['CashAdditionalAmountDescription']=null;
        $ShipmentDetails['CollectAmount']=null;
        $ShipmentDetails['Services']='';
        $ShipmentDetails['Items']=$Items;

        $create_shipments_arr['Shipments'][0]['Details']=$ShipmentDetails;
        $create_shipments_arr['Shipments'][0]['Attachments']=array();
        $create_shipments_arr['Shipments'][0]['ForeignHAWB']='';
        $create_shipments_arr['Shipments'][0]['TransportType']=0;
        $create_shipments_arr['Shipments'][0]['PickupGUID']='';
        $create_shipments_arr['Shipments'][0]['Number']=null;
        $create_shipments_arr['Shipments'][0]['ScheduledDelivery']=null;
        // $shipping_arr['ClientInfo']=$ClientInfo;


        $Transaction['Reference1'] = $post_data['Transaction_Reference_Note'];
        $Transaction['Reference2']='';
        $Transaction['Reference3']='';
        $Transaction['Reference4']='';
        $Transaction['Reference5']='';

        $create_shipments_arr['Transaction']=$Transaction;

        // print_r($create_shipments_arr['Shipments'][0]['ShippingDateTime']);
        // exit();

        $create_shipments_arr = json_encode($create_shipments_arr);

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://ws.sbx.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc/json/CreateShipments',
          // CURLOPT_URL => $this->shi_url.'Shipping/Service_1_0.svc/json/CreateShipments',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>$create_shipments_arr,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Accept: application/json'
          ),
        ));



        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
      //   $response=json_decode($response,true);

      //  echo "<pre>";
      //  print_r($response);
      //  exit();

        if($httpcode==200)
        {
          $response=json_decode($response,true);
          // print_r($post_data['ShippingDateTime']);
          // exit();
          if($response['HasErrors']==false)
          {
            $this->CI->custom_model->my_delete(['order_master_id' => $is_order[0]['order_master_id']], 'shipments');
            $this->CI->custom_model->my_update(array("shipping_id"=>$response['Shipments'][0]['ID'],"shipping_date_time"=>$post_data['ShippingDateTime'],"shipping_dub_date"=>$post_data['DueDate']),array('order_no' => $is_order[0]['order_master_id']),'order_invoice');
            $this->CI->custom_model->my_update(array("shipping_id"=>$response['Shipments'][0]['ID']),array('order_no' => $is_order[0]['order_master_id'],"is_delivery_available"=>0),'order_items');
            $this->CI->custom_model->my_insert(array("logistics_shipment_id"=>$response['Shipments'][0]['ID'],"shipping_date_time"=>$post_data['ShippingDateTime'],"shipping_due_date"=>$post_data['DueDate'],'order_master_id' => $is_order[0]['order_master_id'], 'customer_id' => $is_order[0]['user_id'], 'seller_id' => $order_items[0]['seller_id'], "status"=>$post_data['status'], "created_by"=>$post_data['created_by']),'shipments');

            $info_arr['status']=true;
            $info_arr['message']="Shipping created successfully";
            $info_arr['shipping_id']=$response['Shipments'][0]['ID'];
          }else{
            $message='';
            foreach ($response['Shipments'][0]['Notifications'] as $er_key => $er_val) {
              $message=$er_val['Message'].'<br>'.$message;
            }
            $info_arr['status']=false;
            $info_arr['message']=$message;
          }
        }else{
          $info_arr['status']=false;
          $info_arr['message']="Bad string passed";
        }

    }else{
      $info_arr['status']=false;
      $info_arr['message']='Something Went Wrong';
    }
    return $info_arr;
  }

  public function get_PickupContact($data)
  {
    $PickupContact=array();
    $PickupContact['Department']="";
    $full_name=$data['first_name'];
    $CompanyName=$full_name;
    if(isset($data['last_name']))
    {
      $full_name.=' '.$data['last_name'];
    }
    if(isset($data['entity_name']))
    {
      $CompanyName=$data['entity_name'];
    }
    // print_r($data['phone']);
    // exit();
    $PickupContact['PersonName']=$full_name;
    $PickupContact['Title']="";
    $PickupContact['CompanyName']=$CompanyName;
    $PickupContact['PhoneNumber1'] = $data['phone'];
    $PickupContact['PhoneNumber1Ext']="";
    $PickupContact['PhoneNumber2']="";
    $PickupContact['PhoneNumber2Ext']="";
    $PickupContact['FaxNumber']="";
    $PickupContact['CellPhone']=$data['phone'];
    $PickupContact['EmailAddress']=$data['email'];
    $PickupContact['Type']="";
    return $PickupContact;
  }

  public function create_pickup($order_items,$is_order,$seller_data,$post_data)
  {
    $weight_value_all=$quantity_all=0;
    $product_name_all='';
    $CollectAmount=null;
    $is_order[0]['phone'] = $is_order[0]['mobile_no'];
    // $is_order[0]['pincode'] = $is_order[0]['postal_code'];

    // //print_r();
    // //exit();
    $is_order[0]['postal_code'] = $is_order[0]['pincode'];
    $info_arr=array();
    if(!empty($order_items) && !empty($is_order) && !empty($seller_data) && !empty($post_data) )
    {
        $ClientInfo=$this->get_ClientInfo();
        $PickupAddress=$this->get_DestinationAddress($seller_data[0]);
        $PickupContact=$this->get_PickupContact($seller_data[0]);

        $PartyAddress=$this->get_DestinationAddress($is_order[0]);
        $Contact=$this->get_PickupContact($is_order[0]);

        $create_pickup_arr=$LabelInfo=array();

        $create_pickup_arr['ClientInfo']=$ClientInfo;
        $LabelInfo['ReportID']='9729';
        $LabelInfo['ReportType']='URL';
        $create_pickup_arr['LabelInfo']=$LabelInfo;

        // print_r($this->get_time_stamp($post_data['PickupDate'],'datetime'));
        // exit();
        $create_pickup_arr['Pickup']['PickupAddress']=$PickupAddress;
        $create_pickup_arr['Pickup']['PickupContact']=$PickupContact;
        $create_pickup_arr['Pickup']['PickupLocation']="RUH";
        $create_pickup_arr['Pickup']['PickupDate']=$this->get_time_stamp($post_data['PickupDate'],'datetime');
        $create_pickup_arr['Pickup']['ReadyTime']=$this->get_time_stamp($post_data['ReadyTime'],'datetime');
        $create_pickup_arr['Pickup']['LastPickupTime']=$this->get_time_stamp($post_data['LastPickupTime'],'datetime');
        $create_pickup_arr['Pickup']['ClosingTime']=$this->get_time_stamp($post_data['ClosingTime'],'datetime');
        // print_r($create_pickup_arr['Pickup']['PickupDate']);
		    // exit();
        $create_pickup_arr['Pickup']['Comments']="";
        $create_pickup_arr['Pickup']['Reference1']=$is_order[0]['display_order_id'];
        // $create_pickup_arr['Pickup']['Reference2']=$is_order[0]['invoice_ref'];
        $create_pickup_arr['Pickup']['Vehicle']="";
        $create_pickup_arr['Pickup']['Shipments'][0]['Reference1']=$is_order[0]['display_order_id'];
        // $create_pickup_arr['Pickup']['Shipments'][0]['Reference2']=$is_order[0]['invoice_ref'];
        $create_pickup_arr['Pickup']['Shipments'][0]['Reference3']="";

        $create_pickup_arr['Pickup']['Shipments'][0]['Shipper']['Reference1']="";
        $create_pickup_arr['Pickup']['Shipments'][0]['Shipper']['Reference2']="";
        $create_pickup_arr['Pickup']['Shipments'][0]['Shipper']['AccountNumber']=$this->shi_AccountNumber;
        $create_pickup_arr['Pickup']['Shipments'][0]['Shipper']['PartyAddress']=$PickupAddress;
        $create_pickup_arr['Pickup']['Shipments'][0]['Shipper']['Contact']=$PickupContact;

        $create_pickup_arr['Pickup']['Shipments'][0]['Consignee']['Reference1']="";
        $create_pickup_arr['Pickup']['Shipments'][0]['Consignee']['Reference2']="";
        $create_pickup_arr['Pickup']['Shipments'][0]['Consignee']['AccountNumber']=$this->shi_AccountNumber;

        $create_pickup_arr['Pickup']['Shipments'][0]['Consignee']['PartyAddress']=$PartyAddress;
        $create_pickup_arr['Pickup']['Shipments'][0]['Consignee']['Contact']=$Contact;

        $create_pickup_arr['Pickup']['Shipments'][0]['ThirdParty']['Reference1']="";
        $create_pickup_arr['Pickup']['Shipments'][0]['ThirdParty']['Reference2']="";
        $create_pickup_arr['Pickup']['Shipments'][0]['ThirdParty']['AccountNumber']="";

        $create_pickup_arr['Pickup']['Shipments'][0]['ThirdParty']['PartyAddress']=$this->empty_PartyAddress();
        $create_pickup_arr['Pickup']['Shipments'][0]['ThirdParty']['Contact']=$this->empty_Contact();

        $create_pickup_arr['Pickup']['Shipments'][0]['ShippingDateTime']=$this->get_time_stamp($post_data['ShippingDateTime'],'datetime');
        $create_pickup_arr['Pickup']['Shipments'][0]['DueDate']=$this->get_time_stamp($post_data['DueDate'],'datetime');
        $create_pickup_arr['Pickup']['Shipments'][0]['Comments']="";
        $create_pickup_arr['Pickup']['Shipments'][0]['PickupLocation']="RUH";
        $create_pickup_arr['Pickup']['Shipments'][0]['OperationsInstructions']="";
        $create_pickup_arr['Pickup']['Shipments'][0]['AccountingInstrcutions']="";

        $PickupItems=array();

        foreach ($order_items as $oi_key => $ori_val)
        {
          // echo "<pre>";
          // print_r($oi_val);
          // exit();
          $productData = $this->CI->custom_model->get_data_array("SELECT product_name,packaging_type, req_loading , vehical_requirement, is_hazardous, hazardous_specify,price,sale_price,weight,weight_unit,city,warehouse_location,city,lat,lng,weight_unit,weight,length,width,height,is_delivery_available FROM product  WHERE id='".$ori_val['product_id']."'");
          $product_name_all=$ori_val['product_name'].','.$product_name_all;
          $quantity_all=$ori_val['quantity']+$quantity_all;
          $weight_value = $this->weight_farmula($productData[0]['weight'],$productData[0]['weight_unit']);
          $weight_value_all = $weight_value+$weight_value;

          // $Items[$oi_key]['PackageType']=$productData[0]['packaging_type'];
          // $Items[$oi_key]['Quantity']=$ori_val['quantity'];
          // $Items[$oi_key]['Weight']=array("Unit"=>"KG","Value"=>$weight_value);
          // $comment='Requirement for Loading:- '.$productData[0]['req_loading'].', Vehicle Requirement:- '.$productData[0]['vehical_requirement'].', is this hazardous material:- '.$productData[0]['is_hazardous'];
          // if(!empty($productData[0]['hazardous_specify']))
          // {
          //   $comment.=' '.$productData[0]['hazardous_specify'];
          // }

           $PickupItems[$oi_key]['ProductGroup']="DOM";
           $PickupItems[$oi_key]['ProductType']="CDS";
           $PickupItems[$oi_key]['NumberOfShipments']=1;
           $PickupItems[$oi_key]['PackageType']="Box";
           $PickupItems[$oi_key]['Payment']="P";

           $PickupItems[$oi_key]['ShipmentWeight']=array("Unit"=>$productData[0]['weight_unit'],"Value"=>$productData[0]['weight']);
           $PickupItems[$oi_key]['ShipmentVolume']=null;
           $PickupItems[$oi_key]['NumberOfPieces']=$ori_val['quantity'];
           $PickupItems[$oi_key]['CashAmount']=null;
           $PickupItems[$oi_key]['ExtraCharges']=null;

           $PickupItems[$oi_key]['ShipmentDimensions']=array("Length"=>0,"Width"=>0,"Height"=>0,"Unit"=>"");
           $PickupItems[$oi_key]['Comments']="";
        }

        $ShipmentDetails['Dimensions']=null;
          $ShipmentDetails['ActualWeight']=array("Unit"=>"KG","Value"=>$weight_value_all);
          $ShipmentDetails['ChargeableWeight']=null;
          $ShipmentDetails['DescriptionOfGoods']=$order_items[0]['product_name'];
          $ShipmentDetails['GoodsOriginCountry']=$this->shi_CountryCode;
          $ShipmentDetails['NumberOfPieces']=$order_items[0]['quantity'];
          $ShipmentDetails['ProductGroup']='DOM';
          $ShipmentDetails['ProductType']='CDS';
          $ShipmentDetails['PaymentType']='P';
          $ShipmentDetails['PaymentOptions']='';
          $ShipmentDetails['CustomsValueAmount']=null;
          $ShipmentDetails['CashOnDeliveryAmount']=null;
          $ShipmentDetails['InsuranceAmount']=null;
          $ShipmentDetails['CashAdditionalAmount']=null;
          $ShipmentDetails['CashAdditionalAmountDescription']=null;
          $ShipmentDetails['CollectAmount']=null;
          $ShipmentDetails['Services']='';
          $ShipmentDetails['Items']=null;
          $ShipmentDetails['DeliveryInstructions']=null;

        // $create_pickup_arr['Pickup']['Shipments'][0]['Details']=$this->empty_details();
        $create_pickup_arr['Pickup']['Shipments'][0]['Details']=$ShipmentDetails;

        $create_pickup_arr['Pickup']['Shipments'][0]['Attachments']=array();
        $create_pickup_arr['Pickup']['Shipments'][0]['ForeignHAWB']="";
        $create_pickup_arr['Pickup']['Shipments'][0]['TransportType']=0;
        $create_pickup_arr['Pickup']['Shipments'][0]['PickupGUID']=null;
        $create_pickup_arr['Pickup']['Shipments'][0]['Number']="";
        $create_pickup_arr['Pickup']['Shipments'][0]['ScheduledDelivery']=null;
        $create_pickup_arr['Pickup']['PickupItems']=$PickupItems;
        $create_pickup_arr['Pickup']['Status']='Ready';
        $create_pickup_arr['Pickup']['ExistingShipments']=null;
        $create_pickup_arr['Pickup']['Branch']="";
        $create_pickup_arr['Pickup']['RouteCode']="";

        $Transaction['Reference1']='';
        $Transaction['Reference2']='';
        $Transaction['Reference3']='';
        $Transaction['Reference4']='';
        $Transaction['Reference5']='';

        $create_pickup_arr['Transaction']=$Transaction;

        $create_pickup_arr = json_encode($create_pickup_arr);


        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $this->shi_url.'Shipping/Service_1_0.svc/json/CreatePickup',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>$create_pickup_arr,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Accept: application/json'
          ),
        ));

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        // $response=json_decode($response,true);
        // echo "<pre>";
        // print_r($response);
        // exit();

        if($httpcode==200)
        {
          $response=json_decode($response,true);
          if($response['HasErrors']==false)
          {
            // $this->CI->custom_model->my_update(array("shipping_id"=>$response['Shipments'][0]['ID'],"shipping_date_time"=>$post_data['ShippingDateTime'],"shipping_dub_date"=>$post_data['DueDate']),array('order_no' => $is_order[0]['order_master_id']),'order_invoice');
            // $this->CI->custom_model->my_update(array("shipping_id"=>$response['Shipments'][0]['ID']),array('order_no' => $is_order[0]['order_master_id'],"is_delivery_available"=>0),'order_items');
            $this->CI->custom_model->my_delete(['order_master_id' => $is_order[0]['order_master_id']], 'pickups');
            $this->CI->custom_model->my_insert(array("logistics_pickup_id"=>$response['ProcessedPickup']['ID'],"guid"=>$response['ProcessedPickup']['GUID'],"logistics_shipment_id"=>$response['ProcessedPickup']['ProcessedShipments'][0]['ID'],"pickup_location"=>$response['ProcessedPickup']['ProcessedShipments'][0]['ShipmentDetails']['Origin'],"label_url"=>$response['ProcessedPickup']['ProcessedShipments'][0]['ShipmentLabel']['LabelURL'], "shipping_date_time"=>$post_data['ShippingDateTime'],"shipping_due_date"=>$post_data['DueDate'],'order_master_id' => $is_order[0]['order_master_id'],"pickup_date"=>$post_data['PickupDate'], "ready_time"=>$post_data['ReadyTime'],"last_pickup_time"=>$post_data['LastPickupTime'],"closing_time"=>$post_data['ClosingTime'],"status"=>$post_data['status'], "created_by"=>$post_data['created_by'], "seller_id"=> $order_items[0]['seller_id']),'pickups');

            $info_arr['status']=true;
            $info_arr['message']="Pickup scheduled successfully";
            $info_arr['shipping_id']=$response['ProcessedPickup']['ProcessedShipments'][0]['ID'];
          }else{
            $message='';
            foreach ($response['Notifications'] as $er_key => $er_val) {
              $message=$er_val['Message'].'<br>'.$message;
            }
            $info_arr['status']=false;
            $info_arr['message']=$message;
          }
        }else{
          $info_arr['status']=false;
          $info_arr['message']="Bad string passed";
        }

    }else{
      $info_arr['status']=false;
      $info_arr['message']='Something Went Wrong';
    }
    return $info_arr;
  }

  public function get_time_stamp($date,$type)
  {
    if($type=='datetime')
    {
      $d = DateTime::createFromFormat('y-m-d H:i:s', $date ,new DateTimeZone('UTC'));
      // print_r($d);
      // exit();
    }else if($type=='date'){
      $d = DateTime::createFromFormat('y-m-d H:i:s', $date.' 00:00:00',new DateTimeZone('UTC'));
    }else{
      $d = DateTime::createFromFormat('H:i:s', $date.':00',new DateTimeZone('UTC'));
    }


    if ($d === false) {
        // die("Incorrect date string");
      $val='';
    } else {
        $val= $d->getTimestamp();
        $val.='000';
        // print_r($val);
        // exit();
        $val = '/Date('.$val.'+003)/';
        // $val = '/Date('.$val.')/';
    }
    return $val;
  }


  public function empty_PartyAddress()
  {
    $PartyAddress=array();
    $PartyAddress['Line1']="";
    $PartyAddress['Line2']="";
    $PartyAddress['Line3']="";
    $PartyAddress['City']="";
    $PartyAddress['StateOrProvinceCode']="";
    $PartyAddress['PostCode']="";
    $PartyAddress['CountryCode']="";
    $PartyAddress['Longitude']=0;
    $PartyAddress['Latitude']=0;
    $PartyAddress['BuildingNumber']="";
    $PartyAddress['BuildingName']="";
    $PartyAddress['Floor']="";
    $PartyAddress['Apartment']="";
    $PartyAddress['POBox']="";
    $PartyAddress['Description']="";
    return $PartyAddress;
  }

  public function empty_Contact()
  {
    $Contact=array();
    $Contact['Department']="";
    $Contact['PersonName']="";
    $Contact['Title']="";
    $Contact['CompanyName']="";
    $Contact['PhoneNumber1']="";
    $Contact['PhoneNumber1Ext']="";
    $Contact['PhoneNumber2']="";
    $Contact['PhoneNumber2Ext']="";
    $Contact['FaxNumber']="";
    $Contact['CellPhone']="";
    $Contact['EmailAddress']="";
    $Contact['Type']="";
    return $Contact;
  }

  public function empty_details()
  {
    $ShipmentDetails=array();
    $ShipmentDetails['Dimensions']=null;
    $ShipmentDetails['ActualWeight']=array("Unit"=>null,"Value"=>null);
    $ShipmentDetails['ChargeableWeight']=null;
    $ShipmentDetails['DescriptionOfGoods']=null;
    $ShipmentDetails['GoodsOriginCountry']=null;
    $ShipmentDetails['NumberOfPieces']=null;
    $ShipmentDetails['ProductGroup']='DOM';
    $ShipmentDetails['ProductType']='CDS';
    $ShipmentDetails['PaymentType']='P';
    $ShipmentDetails['PaymentOptions']='';
    $ShipmentDetails['CustomsValueAmount']=null;
    $ShipmentDetails['CashOnDeliveryAmount']=null;
    $ShipmentDetails['InsuranceAmount']=null;
    $ShipmentDetails['CashAdditionalAmount']=null;
    $ShipmentDetails['CashAdditionalAmountDescription']=null;
    $ShipmentDetails['CollectAmount']=null;
    $ShipmentDetails['Services']='';
    $ShipmentDetails['Items']=null;
    $ShipmentDetails['DeliveryInstructions']=null;
    return $ShipmentDetails;
  }

	public function CalculateRate()
	{

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $this->shi_url.'RateCalculator/Service_1_0.svc/json/CalculateRate',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{"ClientInfo":{"UserName":"armx.ruh.it@gmail.com","Password":"YUre@9982","Version":"v1","AccountNumber":"20016","AccountPin":"331421","AccountEntity":"AMM","AccountCountryCode":"JO","Source":24},"DestinationAddress":{"Line1":"XYZ Street","Line2":"Unit # 1","Line3":"","City":"Dubai","StateOrProvinceCode":"","PostCode":"","CountryCode":"AE","Longitude":0,"Latitude":0,"BuildingNumber":null,"BuildingName":null,"Floor":null,"Apartment":null,"POBox":null,"Description":null},"OriginAddress":{"Line1":"ABC Street","Line2":"Unit # 1","Line3":"","City":"Amman","StateOrProvinceCode":"","PostCode":"","CountryCode":"JO","Longitude":0,"Latitude":0,"BuildingNumber":null,"BuildingName":null,"Floor":null,"Apartment":null,"POBox":null,"Description":null},"PreferredCurrencyCode":"USD","ShipmentDetails":{"Dimensions":null,"ActualWeight":{"Unit":"KG","Value":1},"ChargeableWeight":null,"DescriptionOfGoods":null,"GoodsOriginCountry":null,"NumberOfPieces":1,"ProductGroup":"DOM","ProductType":"CDS","PaymentType":"P","PaymentOptions":"","CustomsValueAmount":null,"CashOnDeliveryAmount":null,"InsuranceAmount":null,"CashAdditionalAmount":null,"CashAdditionalAmountDescription":null,"CollectAmount":null,"Services":"","Items":null,"DeliveryInstructions":null},"Transaction":{"Reference1":"","Reference2":"","Reference3":"","Reference4":"","Reference5":""}}',
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/json',
		    'Accept: application/json'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;

	}

}
