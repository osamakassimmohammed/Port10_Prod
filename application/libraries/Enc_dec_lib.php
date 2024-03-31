<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Library to add cart/ add wish list
 */
class Enc_dec_lib
{

    // protected $order_datetime;

    public function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();
        $this->CI->load->model('admin/Custom_model', 'custom_model');
        // $this->order_datetime = date('Y-m-d H:i:s');
        // date_default_timezone_set('Asia/Kolkata');
    }

    function encryptAES($str, $key)
    {
        $str = urlencode($str);
        $str = $this->pkcs5_pad($str);
        $ivlen = openssl_cipher_iv_length($cipher = "aes-256-cbc");
        $iv = "PGKEYENCDECIVSPC";
        $encrypted = openssl_encrypt($str, "aes-256-cbc", $key, OPENSSL_ZERO_PADDING, $iv);
        $encrypted = base64_decode($encrypted);
        $encrypted = unpack('C*', ($encrypted));
        $encrypted = $this->byteArray2Hex($encrypted);
        return $encrypted;
    }

    function pkcs5_pad($text)
    {
        $blocksize = 16;
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    function byteArray2Hex($byteArray)
    {
        $chars = array_map("chr", $byteArray);
        $bin = join($chars);
        return bin2hex($bin);
    }

    function decryptData($code, $key)
    {
        $code = $this->hex2ByteArray(trim($code));
        $code = $this->byteArray2String($code);
        $iv = "PGKEYENCDECIVSPC";
        $code = base64_encode($code);
        $decrypted = openssl_decrypt($code, 'AES-256-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
        $decrypted = $this->pkcs5_unpad($decrypted);
        return urldecode($decrypted);
    }

    function hex2ByteArray($hexString)
    {
        $string = hex2bin($hexString);
        return unpack('C*', $string);
    }

    function byteArray2String($byteArray)
    {
        $chars = array_map("chr", $byteArray);
        return join($chars);
    }

    function pkcs5_unpad($text)
    {
        $pad = ord($text{strlen($text) - 1});
        if ($pad > strlen($text)) {
            return false;
        }
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) {
            return false;
        }
        return substr($text, 0, -1 * $pad);
    }

    public function get_json_code($post)
    {
        return $str = '[{"amt":"' . $post['amount'] . '","action":"1","password":"' . $post['payment_password'] . '","id":"' . $post['payment_id'] . '","currencyCode":"' . $post['currency_code'] . '","trackId":"' . $post['track_id'] . '","responseURL":"' . $post['response_url'] . '","errorURL":"' . $post['erro_url'] . '"}]';
        //add after track_id  "udf1":"udf1text",
    }

    public function get_payment_url($post, $uid, $track_id, $payment_type = "")
    {
        // test url
        // $test_url="https://securepayments.alrajhibank.com.sa/pg/payment/hosted.htm";
        // live url
        $test_url = "https://digitalpayments.alrajhibank.com.sa/pg/payment/hosted.htm";
        $curl = curl_init();
        $post = array($post);
        // echo "<pre>";
        // print_r($post);
        // die;
        $post = json_encode($post);

        curl_setopt_array($curl, array(
            CURLOPT_URL => $test_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $post,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $return_data = array();
        if (!empty($response)) {
            $response = json_decode($response, true);
            $update_data = array();
            if ($response[0]['status'] == 1) {
                $url_payid = explode(":", $response[0]['result']);
                $paymentid = $url_payid[0];
                $pay_url = $url_payid[1];
                $pay_url .= ':' . $url_payid[2];
                $update_data['paymentid'] = $paymentid;
                $return_data['status'] = true;
                $return_data['message'] = $pay_url . '?PaymentID=' . $paymentid;
                $return_data['error_type'] = "";
            } else {
                $return_data['status'] = false;
                $return_data['message'] = $response[0]['errorText'];
                $return_data['error_id'] = $response[0]['error'];
                $return_data['error_type'] = "payment_error";
                $update_data['errorText'] = $response[0]['errorText'];
                $update_data['error'] = $response[0]['error'];
                $update_data['payment_status'] = "Unpaid";
            }

            if ($payment_type == 'ecom') {
                $this->CI->custom_model->my_update($update_data, array('user_id' => $uid, 'track_id' => $track_id), 'payment_details');
            } else {
                $this->CI->custom_model->my_update($update_data, array('user_id' => $uid, 'track_id' => $track_id), 'transaction_details');
            }
        } else {
            $return_data['status'] = false;
            $return_data['message'] = "Something wnet wrong";
            $return_data['error_type'] = "empty_response";
        }
        return $return_data;
    }
}
