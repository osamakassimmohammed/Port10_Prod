<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') or define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE') or define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') or define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') or define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') or define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ') or define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') or define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') or define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESCTRUCTIVE') or define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') or define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') or define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') or define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') or define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS') or define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') or define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') or define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') or define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') or define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') or define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') or define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') or define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') or define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') or define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/*
|--------------------------------------------------------------------------
| Custom Constants (added by CI Bootstrap)
|--------------------------------------------------------------------------
| Constants to be used in both Frontend and other modules
|
*/
if (!(PHP_SAPI === 'cli' or defined('STDIN'))) {
    // Base URL with directory support
    $protocol = (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') ? 'https' : 'http';
    $base_url = $protocol . '://' . $_SERVER['HTTP_HOST'];
    $base_url .= dirname($_SERVER['SCRIPT_NAME']);
    define('BASE_URL', $base_url);

    // For API prefix in Swagger annotation (/application/modules/api/swagger/info.php)
    define('API_PROTOCOL', $protocol);
    define('API_HOST', $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']));
}

define('CI_BOOTSTRAP_REPO', '#');
define('CI_BOOTSTRAP_VERSION', 'Build 2017');    // will follow semantic version (e.g. v1.x.x) after first stable launch
// C:\wamp64\www\port10-master\application\modules\admin\views\product\create_product.php
// Upload paths
// echo "<pre>";
// print_r( $_SERVER);
if($_SERVER['DOCUMENT_ROOT'] == 'C:/wamp64/www'){
    define('ASSETS_PATH', $_SERVER['DOCUMENT_ROOT'] . '/port10-master/assets/'); // port10-master//assets
}else{
    define('ASSETS_PATH', $_SERVER['DOCUMENT_ROOT'] . '/assets/');

}
define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/');
define('BANNER_PATH', 'assets/admin/banner/');
define('UPLOAD_BLOG_POST', 'assets/frontend/images/');
define('UPLOAD_BLOG_PDF_POST', 'assets/frontend/images/pdf/');

// define("CI_CURRENCY_SYMBOL", "KD");
// define("CI_CURRENCY_CODE", "KD");
// define("STORE_TYPE", "KWT");
// define("BRANCH_ID", "8");

/*function get_store_type(){
// 	return array( "store_type" => STORE_TYPE );
return array( );
}*/

function store_push($a)
{
// return array_merge($a,get_store_type());
    return $a;

}

function get_percentage($sale_price, $price)
{
    if ($price > $sale_price) {
        return round((($price - $sale_price) / $price) * 100);
    } else {
        return 0;
    }

}

function send_email($emails, $subject, $message, $includes = true)
{
    if (!empty($message)) {
        if ($includes) {
            $header = email_header();
            $footer = email_footer();
            $message = $header . $message . $footer;
        }

        $headers = "From: quamer313@gmail.com\r\n";
        $headers .= "Reply-To: quamer313@gmail.com\r\n";
        $headers .= "CC:quamer313@gmail.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        return @mail($emails, $subject, $message, $headers);
    }
}


function email_header()
{
    $template = '<table cellspacing="0" cellpadding="5" width="100%" bgcolor="#f3f1ed">
					    <tbody>
					    <tr>
					        <td width="1000" style="padding-top:;">
					            <div style="min-width:300px;margin:0 auto;">
					                <table cellspacing="1" cellpadding="0" width="100%" bgcolor="#e5e5e5" style="border-collapse:separate;">
					                    <tbody>
					                    <tr>
					                        <td bgcolor="white">
					                            <table cellspacing="0" cellpadding="0" width="100%">
					                                <tbody>
					                                <tr>
					                                    <td align="center" valign="middle"
					                                        style="padding: 10px;border-bottom: 1px solid #cdcdcd;">
					                                        <img height="80" src="' . base_url() . 'assets/frontend/images/icon/logo.png">
					                                    </td>
					                                </tr>
					                                </tbody>
					                            </table>
					                        </td>
					                    </tr>
					                    <tr>
					                    <td bgcolor="white" style="padding:25px;">';
    return $template;
}

function email_footer()
{
    $template = '
					                        </td>
					                    </tr>
					                    </tbody>
					                </table>
					            </div>
					        </td>

					    </tr>
					    <tr style="background: white;">

					        <td>
					            <div style="max-width:760px;margin:0 auto;">
					                <table cellspacing="0" cellpadding="0" align="right"
					                       style="font:12px/15px Arial,sans-serif;color:#999999;margin:0 0 20px 20px;">
					                    <tbody>
					                    <tr>
					                        <td align="right">
					                            <div>&copy; ADZ</div>
					                        </td>
					                    </tr>
					                    </tbody>
					                </table>
					                <div style="font:12px/15px Arial,sans-serif;color:#999999;">
					                    <div style="margin-bottom:1em;">This&nbsp;is&nbsp;an automatically&nbsp;generated&nbsp;mail, please&nbsp;do&nbsp;not&nbsp;reply.</div>
					                </div>
					            </div>
					        </td>

					    </tr>
					    </tbody>
					</table>';
    return $template;
}


function forgetpass_content($name, $link)
{

    $message = "<div style='
    width: 80%;
    margin: 0px auto;
    padding: 10px;'>
				<p style='font-size: 12px;'>Hi $name,</p>
				<br/><p style='font-size: 12px; color:#696969; margin-top: -15px;'>We've received a request to reset your password. If you didn't make the request,just ignore this email. <br/> Otherwise, you can reset your password using this link.</p><br/>
				<a href='" . $link . "' style='margin-left: 104px; margin-top: 20px; width: 100% !important;padding: 10px 0px;background: #3c4043;border: none;color: #fff;font-size: 14px;text-transform: uppercase;text-decoration: none;border-radius: 3px;margin: 15px 0 15px 0; cursor: pointer;clear: both; overflow: hidden;margin: auto;display: block;font-weight: 500;text-align: center;'>Reset Password</a>
				</div>";
    return $message;
}

function registration_content($name, $link = '')
{
    // $link=base_url();
    $message = "<div style='
    width: 80%;
    margin: 0px auto;
    padding: 10px;'>
				<p style='font-size: 12px;'>Dear $name,</p>
				<br/><p style='font-size: 12px; color:#696969; margin-top: -15px;'>Thank you for registering the business entity (Enter Business Entity Name) on Port10! We have received your registration and your payment.</p><br/>
				<p style='font-size: 12px; color:#696969; margin-top: -15px;'>Please click
				<a href='" . $link . "' style='margin-left: 104px; margin-top: 20px; width: 100% !important;padding: 10px 0px;background: #3c4043;border: none;color: #fff;font-size: 14px;text-transform: uppercase;text-decoration: none;border-radius: 3px;margin: 15px 0 15px 0; cursor: pointer;clear: both; overflow: hidden;margin: auto;font-weight: 500;text-align: center;'>HERE</a>to activate your account</p><br/>
				<p style='font-size: 12px; color:#696969; margin-top: -15px;'>On your dashboard page, you will be able to control your account, upload products, contact buyers and much more! </p><br/>
				<p style='font-size: 12px; color:#696969; margin-top: -15px;'>To have a better understanding on using the platform, please go through the step-by-step tutorials  found HERE.</p><br/>
				<p style='font-size: 12px; color:#696969; margin-top: -15px;'>Having you part of Port10’s growing business community is our pleasure. We’d love it if you could SPREAD THE WORD about Port10 with your business partners! You can find links to our Facebook and Twitter pages below.</p><br/>
				<p style='font-size: 12px; color:#696969; margin-top: -15px;'>Thank you again for your registration. If you have any questions, please let us know!</p><br/>
				<p style='font-size: 12px; color:#696969; margin-top: -15px;'>Regards,</p><br/>
				<p style='font-size: 12px; color:#696969; margin-top: -15px;'>Anwar Adushe</p><br/>
				<p style='font-size: 12px; color:#696969; margin-top: -30px;'>Facebook</p><br/>
				<p style='font-size: 12px; color:#696969; margin-top: -30px;'>Twitter</p><br/>
				</div>";
    return $message;
}

/**
 * Encrypt and decrypt
 * @param string $string string to be encrypted/decrypted
 * @param string $action what to do with this? e for encrypt, d for decrypt
 */

function en_de_crypt($string, $action = 'e')
{
    $secret_key = 'a1s3er1n5n7m3f3e45o5p9w3k2x3q32x';
    $secret_iv = 'a1snsd5nm3fssddsdgrkjlpdf9llkw22x';
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'e') {
        $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    } else if ($action == 'd') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

function getLocationInfoByIp()
{

    $client = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote = @$_SERVER['REMOTE_ADDR'];
    $result = array('country' => '', 'city' => '');
    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }
    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
    if ($ip_data && $ip_data->geoplugin_countryName != null) {
        $result['country'] = $ip_data->geoplugin_countryName;
        $result['country_code'] = $ip_data->geoplugin_countryCode;
        $result['city'] = $ip_data->geoplugin_city;
    }
    return $result;
}

function decnum($number)
{
    $number = round($number, 2);
    return number_format((float)$number, 2, '.', '');
}

function date_compare($element1, $element2)
{
    $datetime1 = strtotime($element1['add_date']);
    $datetime2 = strtotime($element2['add_date']);
    return $datetime1 - $datetime2;
}


