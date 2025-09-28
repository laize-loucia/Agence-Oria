<?php

namespace model\mail;

use controller\AppController;
use Error;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;

//require "vendor/autoload.php"; // if using PHPMailer with composer

/*$separator = '/';
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
  $separator = '\\';
}*/
//$phpmailerSrcPath = 'PHPMailer' . $separator . 'src/';

if (!defined('DIR_SEPARATOR')) {
	define('DIR_SEPARATOR', '/');
}
$phpmailerSrcPath = 'PHPMailer' . DIR_SEPARATOR . 'src/';
require_once($phpmailerSrcPath . 'Exception.php');
require_once($phpmailerSrcPath . 'PHPMailer.php');
require_once($phpmailerSrcPath . 'SMTP.php');

//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;

//require "vendor/autoload.php";

class MailingManager {
  
  public const CONTACT_SMTP_HOST = 'smtp.gmail.com';
  public const CONTACT_SMTP_PORT = 587;
	public const CONTACT_SMTP_AUTH_USERNAME = 'agency.oria@gmail.com';
  public const CONTACT_SMTP_AUTH_PASSWORD = 'juif tirf guec mnpw';
  
	public const CONTACT_SEND_TO_EMAIL = self::CONTACT_SMTP_AUTH_USERNAME;
	public const CONTACT_SEND_TO_NAME = 'Agence Oria';
  public const CONTACT_REPLY_TO_EMAIL = self::CONTACT_SEND_TO_EMAIL;
	public const CONTACT_REPLY_TO_NAME = self::CONTACT_SEND_TO_NAME;

  public static function tryActContact(): void {
    $paramName = AppController::GET_PARAM_NAME_RESPONSE_REQUEST;
    $responseCondition = (
      (isset($_GET[$paramName])) &&
      ($_GET[$paramName]==AppController::ACTION_CHECK_MAIL_SENT)
    );
    try {
      $wasMailSent = MailingManager::sendMail($_POST);
      if ($responseCondition) {
        var_export($wasMailSent);
      }
    } catch (Error $e) {
      if ($responseCondition) {
        echo "[" . get_class($e) .
          "] | MailingManager::tryActContact() => ACTION_SEND_MAIL => [error]";
      }
    } catch (Exception $e) {
      if ($responseCondition) {
        echo "[" . get_class($e) .
          "] | MailingManager::tryActContact() => ACTION_SEND_MAIL => [error]";
      }
    }
  }

  public static function sendMail(array $params): bool {
    if ((empty($params['email'])) || (empty($params['message']))) {
      return false;
    }
		$fromEmail = "";
		$fromName = "";
		$emailSubject = "[Contact]";
		$emailMessage = "";
		
		$fromEmail = $params['email'];
		if (isset($params['firstname'])) {
			$fromEmail .= $params['firstname'];
		}
		if (isset($params['lastname'])) {
			$fromEmail .= ' ' . $params['lastname'];
			$fromEmail = trim($fromEmail);
		}
		if (!(empty($params['subject']))) {
			$emailSubject = $params['subject'];
		}
		$emailMessage = $params['message'];

		$mail = new PHPMailer(); // composer require phpmailer/phpmailer || download zip from github
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
		$mail->isSMTP();
    $mail->SMTPOptions = [
      'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      ]
    ];
		$mail->SMTPAuth = true;
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		$mail->Port = self::CONTACT_SMTP_PORT;
		$mail->Username = self::CONTACT_SMTP_AUTH_USERNAME;
		$mail->Password = self::CONTACT_SMTP_AUTH_PASSWORD;
		
		$mail->setFrom(
			$fromEmail,
			$fromName
		);
		$mail->addAddress(
			self::CONTACT_SEND_TO_EMAIL,
			self::CONTACT_SEND_TO_NAME
		);
    $mail->addReplyTo(
			$fromEmail,
			$fromName
    );

    $mail->isHTML();

		$mail->Subject = $emailSubject;
		$mail->Body = $emailMessage;
		$mail->AltBody = $emailMessage;
		
		$wasMailSent = $mail->send();
		
		return $wasMailSent;
	}

}

?>