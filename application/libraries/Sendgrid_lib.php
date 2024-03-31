<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'libraries/sendgrid-php/sendgrid-php.php';

use SendGrid\Mail\Mail;

class Sendgrid_lib
{
    private $sendGrid;
    private $apiKey;
    private $from;

    public function __construct()
    {
        // Assuming your SendGrid API Key is stored in your CodeIgniter config file
        // You can also load this from a database or environment variable
        $this->CI =& get_instance();
        $this->CI->config->load('sendgrid', TRUE);
        $this->apiKey = $this->CI->config->item('api_key', 'sendgrid');
        $this->from = $this->CI->config->item('from', 'sendgrid');

        $this->sendGrid = new \SendGrid($this->apiKey);
    }

    public function sendEmail($to, $subject, $htmlContent)
    {
        $email = new Mail();
        $email->setFrom($this->from);
        $email->setSubject($subject);
        $email->addTo($to);
        $email->addContent("text/html", $htmlContent);

        try {
            $response = $this->sendGrid->send($email);
            return $response;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return false;
        }
    }
}
