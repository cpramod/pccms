<?php
/**
 * Created by PhpStorm.
 * User: pramod
 * Date: 9/6/18
 * Time: 1:39 PM
 */

require APPPATH.'third_party/phpmailer/PHPMailerAutoload.php';

class My_email{
    function __construct()
    {
        $this->ci=&get_instance();
        $this->ci->config->load('email/my_email');
        $this->mail = new PHPMailer(true);   
        $this->config();
    }

    function config(){

        $this->mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $this->mail->isSMTP();                                      // Set mailer to use SMTP
        $this->mail->Host = $this->ci->config->item('host');  // Specify main and backup SMTP servers
        $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
        $this->mail->Username = $this->ci->config->item('username');                 // SMTP username
        $this->mail->Password = $this->ci->config->item('password');                           // SMTP password
        $this->mail->SMTPSecure = $this->ci->config->item('protocol');                            // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port = $this->ci->config->item('port');   

    }

    function send($to,$subject,$message, $from){

        try{
            $this->mail->setFrom($from['email'], $from['name']);
            $this->mail->addAddress($to);     // Add a recipient
        //$this->mail->addAddress('ellen@example.com');               // Name is optional
        //$this->mail->addReplyTo('info@example.com', 'Information');

            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = $subject;
            $this->mail->Body = $message;
            $this->mail->send();
            return true;
        }catch(Exception $e){
            // echo $this->mail->ErrorInfo;
            // exit;
            return false;
        } //Recipients
        

        
    }




}