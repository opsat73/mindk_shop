<?php
/**
 * Created by PhpStorm.
 * User: opsat73
 * Date: 21.03.16
 * Time: 0:22
 */

namespace core;

class Mailer
{

    private $mailer;
    public function __construct($host, $user, $password,  $secure, $protocol, $port) {
        require_once(BASE_DIR.DS.'lib'.DS.'phpmailer'.DS.'PHPMailerAutoload.php');
        $mail = new \PHPMailer();

        $mail->isSMTP();
        $mail->Host = $host;
        $mail->SMTPAuth = $secure;
        $mail->Username = $user;
        $mail->Password = $password;
        $mail->SMTPSecure = $protocol;
        $mail->Port = $port;
        $this->mailer = $mail;
    }

    public function sendEmail ($from, $to, $subject, $body) {
        $this->mailer->setFrom($from);
        $this->mailer->addAddress($to);
        $this->mailer->isHTML(true);

        $this->mailer->Subject = $subject;
        $this->mailer->Body    = $body;
        $this->mailer->send();
    }




}