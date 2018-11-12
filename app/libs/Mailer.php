<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



if(!class_exists('Mailer')){
    class Mailer{

        public  $mail;

        public function __construct($exceptions=false){
            // require_once('/home/sdhoju/gmail_config.php');

            $this->mail = new PHPMailer($exceptions);              
            
            // $this->mail->SMTPDebug = 2;                            // Enable verbose debug output
            $this->mail->isSMTP();                                 // Set mailer to use SMTP
            $this->mail->Host = 'smtp.gmail.com';                  // Specify main and backup SMTP servers
            $this->mail->SMTPAuth = true;                          // Enable SMTP authentication
            $this->mail->Username = 'samee.dhoju@gmail.com';       // SMTP username
            $this->mail->Password = 'Style0n4345';                 // SMTP password
            $this->mail->SMTPSecure = 'tls';                       // Enable TLS encryption, `ssl` also accepted
            $this->mail->Port = 587;    
            
        }

        public function mail($to=array(),$subject,$html,$from=array(),$plaintext=false,$cc=array(),$bcc=array(),$attachments=array()){
            if(empty($to) || empty($from) || empty($subject)|| empty($html)){
                die('Missing a parameter');
            }
            
            //Sender
            $this->mail->setFrom($from['email'], $from['name']);
            // $this-> $mail->addReplyTo($replyto['email'], $replyto['name']);

            //Recipients
            if(!empty($to)){
                foreach($to as $recipient){
                    $this->mail->addAddress($recipient['email'], $recipient['name']);
                }

            }
            //CC
            if(!empty($cc)){
                foreach($cc as $recipient){
                    $this->mail->addCC($recipient['email'], $recipient['name']);
                }

            }
            //BCC
            if(!empty($bcc)){
                foreach($bcc as $recipient){
                    $this->mail->addBCC($recipient['email'], $recipient['name']);
                }

            }
            //Attachments
            if(!empty($attachments)){
                foreach($attachments as $attachment){
                    $this->mail->addAttachment($attachment); 
                }
            }

            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = $subject;
            $this->mail->Body    = $html;

            if(fals !== $plaintext){
                $this->mail->AltBody = $plaintext;
            }
 
            try{
                $this->mail->send();
                // echo 'Email Sent';
            } 
            catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $this->mail->ErrorInfo;
            }
        }
    } 
}
