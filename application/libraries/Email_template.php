<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Library to add cart/ add wish list
 */
class Email_template
{

    protected $order_datetime;

    public function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();
        $this->CI->load->model('admin/Custom_model', 'custom_model');
        // $this->CI->load->library('email');
        date_default_timezone_set('Asia/Kolkata');
        $this->order_datetime = date('Y-m-d H:i:s');
    }

    public function welcom_email($first_name, $link)
    {
        $html_tag = '';
        $html_tag .= '<!DOCTYPE html>';
        $html_tag .= '<html>';
        $html_tag .= ' <head><title>Index</title></head>';
        $html_tag .= '<style>
				      html, body{
				      padding:0px;
				      margin:0px;
				      font-family: arial;
				      font-size: 14px;
				      }
				      div{
				      box-sizing: border-box;
				      }
				      .row_padng td{
				      padding:10px 0px;
				      }
				   </style>';

        $html_tag .= '<body>
					      <div style="text-align: center; background: #f3f3f3; " >
					         <div style="width: 750px; background: #fff; box-shadow: 0px 0px 4px 1px #cccccc25; display: inline-block; margin: 20px 0px; padding: 0px 15px 10px 15px; border-radius: 8px; border-top: 5px solid #fd3a58; border-bottom: 5px solid #fd3a58; " >
					            <div style="padding:10px 0px;">
					               <img src="' . base_url('assets/frontend/images/icon/logo-04.png') . '" style="width: 130px; margin-top: 10px; margin-bottom: 10px; " >
					            </div>
					            <div style="float: left;width: 100%; text-align: center;  " >
					               <div style="width: 100%;">
					                  <div style="float: left; width:100%; text-align: center; font-weight: 600; line-height: 20px; font-size: 18px; " >
					                     Welcome to Port10
					                  </div>
					               </div>
					            </div>

					            <div style="float: right;width: 100%; text-align: left;  " >
					               <div style="width: 100%;">
					                  <div style="float: left; width:100%; text-align: left; line-height: 20px; padding:0px 20px; " >
					                     <div style="font-weight: 600; margin-top:30px; font-size: 16px; " >
					                     Dear ' . $first_name . ',
					                     </div>

					                     <div style="margin-top: 13px; font-size: 15px; font-weight: 500; line-height: 22px; " >

					                        Thank you for registering the business entity (Enter Business Entity Name) on Port10! We have received your registration and your payment. <br>

					                        <div style="margin-top: 13px;">
					                           Please click <a href="' . $link . '" style="background: #fd3a58; margin-left: 2px; margin-right: 2px; padding: 3px 7px; border-radius: 4px; color: #fff; cursor: pointer;text-decoration: none;" >HERE</a> to activate your account
					                        </div>


					                        <div style="margin-top: 13px;" >
					                           On your dashboard page, you will be able to control your account, upload products, contact buyers and much more!
					                        </div>

					                        <div style="margin-top: 13px;" >
					                           To have a better understanding on using the platform, please go through the step-by-step tutorials found HERE.
					                        </div>

					                        <div style="margin-top: 13px;" >
					                           Having you part of Port10’s growing business community is our pleasure. We’d love it if you could SPREAD THE WORD about Port10 with your business partners! You can find links to our Facebook and Twitter pages below.
					                        </div>

					                        <div style="margin-top: 13px;" >
					                           Thank you again for your registration. If you have any questions, please let us know!
					                        </div>

					                        <div  style="margin-top: 10px; font-weight: 600; margin-top: 15px; ">
					                           Regards,
					                           <div style=" font-size: 18px; margin-top: 2px; margin-bottom: 6px; ">
					                              Anwar Adushe
					                           </div>

					                           <div>
					                              <a href="" style="background: white; display: inline-block; width: 40px; height: 40px; text-align: center; border-radius: 8px; margin-left: -6px; margin-top: 4px; margin-bottom: 20px;" >
					                                 <img src="' . base_url('assets/frontend/images/icon/insta.png') . '" style="width: 35px; margin-top: 2px;" >
					                              </a>

					                              <a href="" style="background: white; display: inline-block; width: 40px; height: 40px; text-align: center; border-radius: 8px; margin-left: 0px; margin-top: 4px; margin-bottom: 20px;" >
					                                 <img src="' . base_url('assets/frontend/images/icon/fb.png') . '" style="width: 35px; margin-top: 2px;" >
					                              </a>
					                           </div>
					                        </div>
					                     </div>
					                  </div>
					               </div>
					            </div>

					            <div style="clear:both;"></div>
					         </div>
					      </div>
					    </body>';
        $html_tag .= '</html>';
        return $html_tag;
    }

    public function wecom_email_en($first_name, $link)
    {
        $html_tag = '';
        $html_tag .= '<!DOCTYPE html>
		<html  >
		   <head>
		      <title>Index</title>
		   </head>
		   <style>
		      html, body{
		      padding:0px;
		      margin:0px;
		      font-family: arial;
		      font-size: 14px;
		      }
		      div{
		      box-sizing: border-box;
		      }
		      .row_padng td{
		      padding:10px 0px;
		      }
		   </style>';
        $html_tag .= '<body>
		         <div style="text-align: center; background: #f3f3f3; " >
		            <div style="width: 750px; background: #fff; box-shadow: 0px 0px 4px 1px #cccccc25; display: inline-block; margin: 20px 0px; padding: 0px 15px 10px 15px; border-radius: 8px; border-top: 5px solid #fd3a58; border-bottom: 5px solid #fd3a58; " >
		               <div style="padding:10px 0px;">
		                  <img src="' . base_url('assets/frontend/images/icon/logo-04.png') . '" style="width: 130px; margin-top: 10px; margin-bottom: 30px; " >
		               </div>
		               <div style="clear:both;"></div>
		               <div style="width: 100%;">
		                  <div style="width: 100%; font-weight: 600; font-size: 20px; margin-top: 00px;" >
		                     Welcome!
		                  </div>
		                  <div style="width: 100%; font-weight: 500; margin-top:15px; font-size: 18px; line-height: 24px; " >
		                     Thank you for creating your account at Port10. <br> In order to activate your account, please click the button below.
		                  </div>
		               </div>
		               <div style="clear:both;"></div>
		               <a style="color: #fff; background: #fd3a58; display: inline-block; padding: 9px 14px 10px 14px; margin-top: 10px; text-decoration: none; border-radius: 3px; margin-top: 10px;" href="' . $link . '">
		               Activate
		               </a>
		               <div  style="width: 100%; font-weight: 500; margin-top: 15px; font-size: 17px; line-height: 22px; padding: 0px 00px; margin-top: 20px;" >
		                  If you have any questions, check out our Frequently Asked Questions page by clicking <a href="https://port10.sa/en/help" target="_blank"> Here </a>   or contact us at <a href="mailto:hello@port10.sa"  target="_blank"> hello@port10.sa  </a>  and we will be more than happy to serve you.
		               </div>
		               <div style="clear:both;"></div>
		               <div style="font-weight: 600; font-size: 22px; margin-top: 40px; margin-bottom: 10px; color: #fd3a58;">
		                  Team Port10
		               </div>
		               <div style="clear:both;"></div>
		            </div>
		         </div>
		   </body>
		</html>';
        return $html_tag;
    }

    public function wecom_email_ar($first_name, $link)
    {
        $html_tag = '';
        $html_tag .= '<!DOCTYPE html>
		<html  >
		   <head>
		      <title>Index</title>
		   </head>
		   <style>
		      html, body{
		      padding:0px;
		      margin:0px;
		      font-family: arial;
		      font-size: 14px;
		      }
		      div{
		      box-sizing: border-box;
		      }
		      .row_padng td{
		      padding:10px 0px;
		      }
		   </style>';
        $html_tag .= '<body>
		         <div style="text-align: center; background: #f3f3f3; " >
		            <div style="width: 750px; background: #fff; box-shadow: 0px 0px 4px 1px #cccccc25; display: inline-block; margin: 20px 0px; padding: 0px 15px 10px 15px; border-radius: 8px; border-top: 5px solid #fd3a58; border-bottom: 5px solid #fd3a58; " >
		               <div style="padding:10px 0px;">
		                  <img src="' . base_url('assets/frontend/images/icon/logo-04.png') . '" style="width: 130px; margin-top: 10px; margin-bottom: 30px; " >
		               </div>
		               <div style="clear:both;"></div>
		               <div style="width: 100%;">
		                  <div style="width: 100%; font-weight: 600; font-size: 20px; margin-top: 00px;" >
		                     مرحبا!
		                  </div>
		                  <div style="width: 100%; font-weight: 500; margin-top:15px; font-size: 18px; line-height: 24px; " >
		                     شكرًا لك على إنشاء حسابك في بورت١٠. لتفعيل حسابك، الرجاء النقر على الزر أدناه.
		                  </div>
		               </div>
		               <div style="clear:both;"></div>
		               <a style="color: #fff; background: #fd3a58; display: inline-block; padding: 9px 14px 10px 14px; margin-top: 10px; text-decoration: none; border-radius: 3px; margin-top: 10px;" href="' . $link . '">
		               تفعيل
		               </a>

		               <div  style="width: 100%; font-weight: 500; margin-top: 15px; font-size: 17px; line-height: 22px; padding: 0px 00px; margin-top: 20px;" >
		                  إذا كان لديك أي أسئلة، نرجو منك زيارة صفحة الأسئلة الشائعة بالضغط هنا أو التواصل بنا على <a href="mailto:hello@port10.sa"  target="_blank">hello@port10.sa</a> وسنكون سعيدين لخدمتك.
		               </div>
		               <div style="clear:both;"></div>
		               <div style="font-weight: 600; font-size: 22px; margin-top: 40px; margin-bottom: 10px; color: #fd3a58;">
		                  فريق بورت١٠
		               </div>
		               <div style="clear:both;"></div>
		            </div>
		         </div>
		   </body>
		</html>';
        return $html_tag;
    }

    public function varified_email_en($link_arr)
    {
        $html_tag = '';
        $html_tag .= '<!DOCTYPE html>
		<html  >
		   <head>
		      <title>Index</title>
		   </head>
		   <style>
		      html, body{
		      padding:0px;
		      margin:0px;
		      font-family: arial;
		      font-size: 14px;
		      }
		      div{
		      box-sizing: border-box;
		      }
		      .row_padng td{
		      padding:10px 0px;
		      }
		   </style>';
        $html_tag .= '<body>
		         <div style="text-align: center; background: #f3f3f3; " >
		            <div style="width: 750px; background: #fff; box-shadow: 0px 0px 4px 1px #cccccc25; display: inline-block; margin: 20px 0px; padding: 0px 15px 10px 15px; border-radius: 8px; border-top: 5px solid #fd3a58; border-bottom: 5px solid #fd3a58; " >
		               <div style="padding:10px 0px;">
		                  <img src="' . base_url('assets/frontend/images/icon/logo-04.png') . '" style="width: 130px; margin-top: 10px; margin-bottom: 30px; " >
		               </div>
		               <div style="clear:both;"></div>
		               <div style="width: 100%;">
		                  <div style="width: 100%; font-weight: 600; font-size: 20px; margin-top: 00px;" >
		                     Welcome!
		                  </div>
		                  <div style="width: 100%; font-weight: 500; margin-top:15px; font-size: 18px; line-height: 24px; " >
		                     Your account is verified successfully, please go to the website and login also please check the user manual below.
		                  </div>
		               </div>
		               <div style="clear:both;"></div>';
        $html_tag .= '<a style="color: #fff; background: #fd3a58; display: inline-block; padding: 9px 14px 10px 14px; margin-top: 10px; text-decoration: none; border-radius: 3px; margin-top: 10px;margin-right:10px;" href="' . $link_arr['buyer_manual_en'] . '">Buyer Manual English </a>';
        $html_tag .= '<a style="color: #fff; background: #fd3a58; display: inline-block; padding: 9px 14px 10px 14px; margin-top: 10px; text-decoration: none; border-radius: 3px; margin-top: 10px;margin-right:10px;" href="' . $link_arr['buyer_manual_ar'] . '">Buyer Manual Arabic</a>';

        $html_tag .= '<div style="clear:both;"></div>';

        if (!empty($link_arr['supplier_manual_en'])) {
            $html_tag .= '<a style="color: #fff; background: #fd3a58; display: inline-block; padding: 9px 14px 10px 14px; margin-top: 10px; text-decoration: none; border-radius: 3px; margin-top: 10px;margin-right:10px;" href="' . $link_arr['supplier_manual_en'] . '">Supplier Manual English</a>';

            $html_tag .= '<a style="color: #fff; background: #fd3a58; display: inline-block; padding: 9px 14px 10px 14px; margin-top: 10px; text-decoration: none; border-radius: 3px; margin-top: 10px;margin-right:10px;" href="' . $link_arr['supplier_manual_ar'] . '">Supplier Manual Arabic</a>';
        }

        $html_tag .= '<div  style="width: 100%; font-weight: 500; margin-top: 15px; font-size: 17px; line-height: 22px; padding: 0px 00px; margin-top: 20px;" >
		                  If you have any questions, check out our Frequently Asked Questions page by clicking <a href="https://port10.sa/en/help" target="_blank"> Here </a>   or contact us at <a href="mailto:hello@port10.sa"  target="_blank"> hello@port10.sa  </a>  and we will be more than happy to serve you.
		               </div>
		               <div style="clear:both;"></div>
		               <div style="font-weight: 600; font-size: 22px; margin-top: 40px; margin-bottom: 10px; color: #fd3a58;">
		                  Team Port10
		               </div>
		               <div style="clear:both;"></div>
		            </div>
		         </div>
		   </body>
		</html>';
        return $html_tag;
    }

    public function varified_email_ar($link_arr)
    {
        $html_tag = '';
        $html_tag .= '<!DOCTYPE html>
		<html  >
		   <head>
		      <title>Index</title>
		   </head>
		   <style>
		      html, body{
		      padding:0px;
		      margin:0px;
		      font-family: arial;
		      font-size: 14px;
		      }
		      div{
		      box-sizing: border-box;
		      }
		      .row_padng td{
		      padding:10px 0px;
		      }
		   </style>';
        $html_tag .= '<body>
		         <div style="text-align: center; background: #f3f3f3; " >
		            <div style="width: 750px; background: #fff; box-shadow: 0px 0px 4px 1px #cccccc25; display: inline-block; margin: 20px 0px; padding: 0px 15px 10px 15px; border-radius: 8px; border-top: 5px solid #fd3a58; border-bottom: 5px solid #fd3a58; " >
		               <div style="padding:10px 0px;">
		                  <img src="' . base_url('assets/frontend/images/icon/logo-04.png') . '" style="width: 130px; margin-top: 10px; margin-bottom: 30px; " >
		               </div>
		               <div style="clear:both;"></div>
		               <div style="width: 100%;">
		                  <div style="width: 100%; font-weight: 600; font-size: 20px; margin-top: 00px;" >
		                     مرحبا!
		                  </div>
		                  <div style="width: 100%; font-weight: 500; margin-top:15px; font-size: 18px; line-height: 24px; " >
		                     Your account is verified successfully, please go to the website and login also please check the user manual below.
		                  </div>
		               </div>
		               <div style="clear:both;"></div>';
        $html_tag .= '<a style="color: #fff; background: #fd3a58; display: inline-block; padding: 9px 14px 10px 14px; margin-top: 10px; text-decoration: none; border-radius: 3px; margin-top: 10px;margin-right:10px;" href="' . $link_arr['buyer_manual_en'] . '">Buyer Manual English </a>';
        $html_tag .= '<a style="color: #fff; background: #fd3a58; display: inline-block; padding: 9px 14px 10px 14px; margin-top: 10px; text-decoration: none; border-radius: 3px; margin-top: 10px;margin-right:10px;" href="' . $link_arr['buyer_manual_ar'] . '">Buyer Manual Arabic</a>';

        $html_tag .= '<div style="clear:both;"></div>';

        if (!empty($link_arr['supplier_manual_en'])) {
            $html_tag .= '<a style="color: #fff; background: #fd3a58; display: inline-block; padding: 9px 14px 10px 14px; margin-top: 10px; text-decoration: none; border-radius: 3px; margin-top: 10px;margin-right:10px;" href="' . $link_arr['supplier_manual_en'] . '">Supplier Manual English</a>';

            $html_tag .= '<a style="color: #fff; background: #fd3a58; display: inline-block; padding: 9px 14px 10px 14px; margin-top: 10px; text-decoration: none; border-radius: 3px; margin-top: 10px;margin-right:10px;" href="' . $link_arr['supplier_manual_ar'] . '">Supplier Manual Arabic</a>';
        }

        $html_tag .= '<div  style="width: 100%; font-weight: 500; margin-top: 15px; font-size: 17px; line-height: 22px; padding: 0px 00px; margin-top: 20px;" >
		                  إذا كان لديك أي أسئلة، نرجو منك زيارة صفحة الأسئلة الشائعة بالضغط هنا أو التواصل بنا على <a href="mailto:hello@port10.sa"  target="_blank">hello@port10.sa</a> وسنكون سعيدين لخدمتك.
		               </div>
		               <div style="clear:both;"></div>
		               <div style="font-weight: 600; font-size: 22px; margin-top: 40px; margin-bottom: 10px; color: #fd3a58;">
		                  فريق بورت١٠
		               </div>
		               <div style="clear:both;"></div>
		            </div>
		         </div>
		   </body>
		</html>';
        return $html_tag;
    }

    public function forget_pass_en($first_name, $link)
    {
        $html_tag = '';
        $html_tag .= '<!DOCTYPE html>
		<html>
		   <head>
		      <title>Index</title>
		   </head>
		   <style>
		      html, body{
		      padding:0px;
		      margin:0px;
		      font-family: arial;
		      font-size: 14px;
		      }
		      div{
		      box-sizing: border-box;
		      }
		      .row_padng td{
		      padding:10px 0px;
		      }
		   </style>';

        $html_tag .= '<body>
		      <div style="text-align: center; background: #f3f3f3; " >
		         <div style="width: 750px; background: #fff; box-shadow: 0px 0px 4px 1px #cccccc25; display: inline-block; margin: 20px 0px; padding: 0px 15px 10px 15px; border-radius: 8px; border-top: 5px solid #fd3a58; border-bottom: 5px solid #fd3a58; " >
		            <div style="padding:10px 0px;">
		               <img src="' . base_url('assets/frontend/images/icon/logo-04.png') . '" style="width: 130px; margin-top: 10px; margin-bottom: 30px; " >
		            </div>
		            <div style="clear:both;"></div>
		            <div style="width: 100%;">
		               <div style="width: 100%; font-weight: 600; font-size: 20px; margin-top: 00px;" >
		                  Hello ' . $first_name . '
		               </div>
		               <div style="width: 100%; font-weight: 500; margin-top:15px; font-size: 18px; line-height: 24px; " >
		                  We have received a request to reset your password. <br>
		                   If you didn’t make this request, just ignore this email. <br>
		                    Otherwise, you can click on the button below to have your password reset:
		               </div>
		            </div>
		            <div style="clear:both;"></div>
		            <a style="color: #fff; background: #fd3a58; display: inline-block; padding: 9px 14px 10px 14px; margin-top: 10px; text-decoration: none; border-radius: 3px; margin-top: 10px;" href="' . $link . '">
		            Reset Password
		            </a>

		            <div style="clear:both;"></div>
		            <div style="font-weight: 600; font-size: 22px; margin-top: 40px; margin-bottom: 10px; color: #fd3a58;">
		               Thanks, <br>
		               Team Port10
		            </div>
		            <div style="clear:both;"></div>
		         </div>
		      </div>
		   </body>
		</html>';
        return $html_tag;
    }

    public function forget_pass_ar($first_name, $link)
    {
        $html_tag = '';
        $html_tag .= '<!DOCTYPE html>
		<html>
		   <head>
		      <title>Index</title>
		   </head>
		   <style>
		      html, body{
		      padding:0px;
		      margin:0px;
		      font-family: arial;
		      font-size: 14px;
		      }
		      div{
		      box-sizing: border-box;
		      }
		      .row_padng td{
		      padding:10px 0px;
		      }
		   </style>';

        $html_tag .= '<body>
		      <div style="text-align: center; background: #f3f3f3; " >
		         <div style="width: 750px; background: #fff; box-shadow: 0px 0px 4px 1px #cccccc25; display: inline-block; margin: 20px 0px; padding: 0px 15px 10px 15px; border-radius: 8px; border-top: 5px solid #fd3a58; border-bottom: 5px solid #fd3a58; " >
		            <div style="padding:10px 0px;">
		               <img src="' . base_url('assets/frontend/images/icon/logo-04.png') . '" style="width: 130px; margin-top: 10px; margin-bottom: 30px; " >
		            </div>
		            <div style="clear:both;"></div>
		            <div style="width: 100%;">
		               <div style="width: 100%; font-weight: 600; font-size: 20px; margin-top: 00px;" >
		                   ' . $first_name . ' مرحبًا
		               </div>
		               <div style="width: 100%; font-weight: 500; margin-top:15px; font-size: 18px; line-height: 24px; " >
		                  لقد تلقينا طلبًا لإعادة تعيين كلمة المرور الخاصة بك. إذا لم تقدم هذا الطلب، فيمكنك تجاهل هذا البريد الإلكتروني. وإلا، يمكنك النقر الزر أدناه لإعادة تعيين كلمة المرور الخاصة بك:
		               </div>
		            </div>
		            <div style="clear:both;"></div>
		            <a style="color: #fff; background: #fd3a58; display: inline-block; padding: 9px 14px 10px 14px; margin-top: 10px; text-decoration: none; border-radius: 3px; margin-top: 10px;" href="' . $link . '">
		            إعادة تعيين كلمة المرور
		            </a>

		            <div style="clear:both;"></div>
		            <div style="font-weight: 600; font-size: 22px; margin-top: 40px; margin-bottom: 10px; color: #fd3a58;">
		               شكرا، <br>
		                فريق بورت١٠
		            </div>
		            <div style="clear:both;"></div>
		         </div>
		      </div>
		   </body>
		</html>';
        return $html_tag;
    }

    public function send_trial_email_en($name = '')
    {
        $html_tag = '';
        $html_tag .= '<!DOCTYPE html>
		<html  >
		   <head>
		      <title>Index</title>
		   </head>
		   <style>
		      html, body{
		      padding:0px;
		      margin:0px;
		      font-family: arial;
		      font-size: 14px;
		      }
		      div{
		      box-sizing: border-box;
		      }
		      .row_padng td{
		      padding:10px 0px;
		      }
		   </style>';
        $html_tag .= '<body>
		      <div style="text-align: center; background: #f3f3f3; " >
		         <div style="width: 750px; background: #fff; box-shadow: 0px 0px 4px 1px #cccccc25; display: inline-block; margin: 20px 0px; padding: 0px 15px 10px 15px; border-radius: 8px; border-top: 5px solid #fd3a58; border-bottom: 5px solid #fd3a58; " >
		            <div style="padding:10px 0px;">
		               <img src="' . base_url('assets/frontend/images/icon/logo-04.png') . '" style="width: 130px; margin-top: 10px; margin-bottom: 30px; " >
		            </div>
		            <div style="clear:both;"></div>
		            <div style="width: 100%;">
		               <div style="width: 100%; font-weight: 600; font-size: 20px; margin-top: 00px;" >
		                  Hello ' . $name . '
		               </div>
		               <div style="width: 100%; font-weight: 500; margin-top:15px; font-size: 18px; line-height: 24px; " >
		                  Thank you for becoming part of Port10. <br>
		                  We hope you have been enjoying your free trial.
		               </div>
		            </div>
		            <div style="clear:both;"></div>
		                   <div style="font-size: 18px; font-weight: 600; color:#fd3a58; margin-top: 10px; ">
		                     Unfortunately, your free trial is ending in 3 days.
		                   </div>
		            <div style="clear:both;"></div>


		            <div  style="width: 100%; font-weight: 500; margin-top: 15px; font-size: 17px; line-height: 22px; padding: 0px 00px; margin-top: 20px;" >
		               We’d love to keep you as a customer, and there is still time to complete your subscription! Simply visit your account dashboard to subscribe.
		            </div>
		            <div style="clear:both;"></div>
		            <div style="font-weight: 600; font-size: 22px; margin-top: 40px; margin-bottom: 10px; color: #fd3a58;">
		               Thanks, <br>
		               Team Port10
		            </div>
		            <div style="clear:both;"></div>
		         </div>

		      </div>
		   </body>
		</html>';
        return $html_tag;
    }
}
