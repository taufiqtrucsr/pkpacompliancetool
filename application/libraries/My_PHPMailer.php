<?php 
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class My_PHPMailer{
    public function __construct() {
        require_once('smtpmail/class.phpmailer.php');
        require_once('smtpmail/library.php');
    }
}