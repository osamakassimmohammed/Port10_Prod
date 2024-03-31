<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fcmnotification
{
    public function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();
        $this->CI->load->model('admin/Custom_model', 'custom_model');
        date_default_timezone_set('Asia/Kolkata');
    }

    public function send_order_accept_message_user($user_id)
    {
        $user_id = $user_id;
        $title = "Order Accepted";
        $message = "We acknowledge the receipt of your order number (xx). Thank you .";
        $to_id = '';
        $this->send_fcm_message_usert_new_integrate($user_id, $message, $title);

    }

    function send_fcm_message_usert_new_integrate($user_id, $msg, $title = '', $image_url = '', $action = '', $action_destination = '', $topic = '')
    {
        // $check = User::where('id', $user_id)->get();
        // get user id
        $check = $this->CI->custom_model->my_where('admin_users', '*', array('id' => $user_id, 'fcm_no!=' => ''));

        // echo "<pre>";
        // print_r($check);
        // die;

        if (isset($title)) {
            $notification = new Firebase1();

            $title = $title;
            $message = isset($msg) ? $msg : '';
            $imageUrl = isset($image_url) ? $image_url : '';
            $action = isset($action) ? $action : '';

            $actionDestination = isset($_POST['action_destination']) ? $_POST['action_destination'] : '';

            if ($actionDestination == '') {
                $action = '';
            }

            $notification->setTitle($title);
            $notification->setMessage($message);
            $notification->setImage($imageUrl);
            $notification->setAction($action);
            $notification->setActionDestination($actionDestination);

            $firebase_token = @$check[0]['fcm_no'];

            $firebase_api = "AAAAZwy2rb4:APA91bGHdFanr-NstPyMNxaIBech_6M4qAJyOONJqickQ1agvPfYCbBhJkq_Gvr7HuTzmykq8jgiBWvPjQo9hGylvvsBJnZjB6u6dhYPiovCB74J609zv-3DIFZwJE4_JUPAle67riN8";

            $topic = $topic;

            $requestData = $notification->getNotificatin();

            if (!empty($topic)) {
                $fields = array(
                    'to' => '/topics/' . $topic,
                    'data' => $requestData,
                );

            } else {

                $fields = array(
                    'to' => $firebase_token,
                    'data' => $requestData,
                );
            }


            // Set POST variables
            $url = 'https://fcm.googleapis.com/fcm/send';

            $headers = array(
                'Authorization: key=' . $firebase_api,
                'Content-Type: application/json'
            );

            // Open connection
            $ch = curl_init();

            // Set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Disabling SSL Certificate support temporarily
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

            // Execute post
            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            }

            // Close connection
            curl_close($ch);

            // echo '<h2>Result</h2><hr/><h3>Request </h3><p><pre>';
            // echo json_encode($fields,JSON_PRETTY_PRINT);
            // echo '</pre></p><h3>Response </h3><p><pre>';
            // echo $result;
            // echo '</pre></p>';
            // die;
        }
    }

    public function order_dispatched_msg_to_user($user_id)
    {
        $user_id = $user_id;
        $title = "Order Picked by driver";
        $message = "Your order has been picked up for delivery. Expect your delivery soon.";
        $to_id = '';

        $this->send_fcm_message_usert_new_integrate($user_id, $message, $title);
    }


    public function order_delivered_msg_to_user($user_id, $oid)
    {
        $user_id = $user_id;
        $title = "Order Delivered";
        $message = "Your order number 11 is delivered. Thank you for your patronage .";
        $to_id = '';

        $this->send_fcm_message_usert_new_integrate($user_id, $message, $title);
    }

    public function order_canceled_msg_to_user($user_id, $oid)
    {
        $user_id = $user_id;
        $title = "Order Cancelled";
        $message = "Your order number 11 is Cancelled. Thank you for your patronage .";
        $to_id = '';

        $this->send_fcm_message_usert_new_integrate($user_id, $message, $title);
    }

}
