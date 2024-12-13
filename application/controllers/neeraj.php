<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class neeraj extends CI_Controller{
    public function index(){
        $to_email = "neeraj.prajapati@trucsr.in";
        $subject = "Simple Email Test via PHP";
        $body = "Hi, This is test email send by PHP Script";
        $headers = "From: sender email";
        
        if (mail($to_email, $subject, $body, $headers)) {
            echo "Email successfully sent to $to_email...";
        } else {
            echo "Email sending failed...";
    }
}
}