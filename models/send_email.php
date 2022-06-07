<?php 
/**
 * send_email class
 */
require_once "send_email/vendor/autoload.php";
require_once "common.php";

class send_email
{
    /**
	 * declarations
	 */
    private $to_email;
    private $to_display_name;
    private $subject;
    private $message;
    private $attachment;

	/**
     * Get the value of to_email
     *
     * @return mixed
     */
    public function getToEmail()
    {
        return $this->to_email;
    }
 
    /**
     * Set the value of to_email
     *
     * @param mixed to_email
     *
     * @return self
     */
    public function setToEmail($to_email)
    {
        $this->to_email = $to_email;

        return $this;
    }
	
	/**
     * Get the value of to_display_name
     *
     * @return mixed
     */
    public function getToDisplayName()
    {
        return $this->to_display_name;
    }
 
    /**
     * Set the value of to_display_name
     *
     * @param mixed to_display_name
     *
     * @return self
     */
    public function setToDisplayName($to_display_name)
    {
        $this->to_display_name = $to_display_name;

        return $this;
    }

    /**
     * Get the value of subject
     *
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }
 
    /**
     * Set the value of subject
     *
     * @param mixed subject
     *
     * @return self
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }
   
    /**
     * Get the value of message
     *
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }
 
    /**
     * Set the value of message
     *
     * @param mixed message
     *
     * @return self
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of attachment
     *
     * @return mixed
     */
    public function getAttachment()
    {
        return $this->attachment;
    }
 
    /**
     * Set the value of attachment
     *
     * @param mixed attachment
     *
     * @return self
     */
    public function setAttachment($attachment)
    {
        $this->attachment = $attachment;

        return $this;
    }

    public function send()
    {
		// get signature
		$system_title = common::getFieldValue("system", "title");
		$licensee = common::getFieldValue("system", "licensee");
		$telephone = common::getFieldValue("system", "telephone");
		$email = common::getFieldValue("system", "email");
		$website = common::getFieldValue("system", "website");
		$signature = "<p>Regards,</p><p>$licensee<br />$telephone<br />$email<br />$website";
		
		// disable ssl feature
		$https["ssl"]["allow_self_signed"] = TRUE;
		$https["ssl"]["verify_peer"] = FALSE;
		$https["ssl"]["verify_peer_name"] = FALSE;
		
		$transport = (new \Swift_SmtpTransport(MAIL_HOST, MAIL_PORT))//, MAIL_ENCRYPTION))
			->setUsername(FROM_EMAIL)
			->setPassword(EMAIL_PASSWORD)
			->setStreamOptions($https);
		
		for ($i = 0; $i < count($this->to_email); $i++) :
			// create the message
			$message = (new \Swift_Message());

			// embed the system logo
			$img_url = $message->embed(Swift_Image::fromPath("../../assets/images/logo-lg.png"));
					
			// place the message in the email (html format)
			$html_content = "<div style=\"font-size: 15px; font-family: Arial, Calibri, Verdana, 'Times New Roman'\">";
			$html_content .= "<img src=\"$img_url\" alt=\"myNGO Logo\" />";
			$html_content .= "<hr style=\"height: 1px; border-width: 0; width: 100%; color: #000; background-color: #000;\">";
			$html_content .= $this->message[$i] . $signature;
			$html_content .= "</div>";
			
			 // place the message in the email (plain text format)
			$plain_text = strip_tags($this->message[$i] . $signature);

			for ($j = 0; $j < count($this->to_email[$i]); $j++) :
				try {
					// create the message properties...subject, from, to, etc
					//$message = (new \Swift_Message())
					$message->setSubject($this->subject[$i]);
					$message->setFrom([FROM_EMAIL => EMAIL_DISPLAY_NAME]);
					$message->setTo([$this->to_email[$i][$j] => $this->to_display_name[$i][$j]]);
					$message->setBody($html_content, "text/html");
					$message->addPart($plain_text, "text/plain");					
					
					if ($this->attachment[$i]["file"] != NULL) {
						// add an attachment if it exists
					  	$attachment = (new Swift_Attachment())
						  ->setFilename($this->attachment[$i]["file_name"])
						  ->setContentType("application/pdf")
						  ->setBody($this->attachment[$i]["file"]);
						$message->attach($attachment);
					}					
				} catch (Swift_RfcComplianceException $r) {
					// invalid email address
					$_SESSION["message"] = "Failed to send email '" . $this->subject[$i] . "' to " . $this->to_email[$i][$j] . ": " . $r->getMessage();
					audit_trail::log_trail("Email", $_SESSION["message"], "system", "Notification", $this->to_email[$i][$j]);
					return;	
				}
				 
				$mailer = (new \Swift_Mailer($transport));

				try {
					// send email
					$is_sent = $mailer->send($message);
					
					if ($is_sent) {
						// email sent successfully
						$_SESSION["message"] = "Email '" . $this->subject[$i] . "' was sent to " . $this->to_email[$i][$j] . MESSAGE_SUCCESS;
						$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
					} else {
						// an error was encountered while sending email
						$_SESSION["message"] = "Failed to send email '" . $this->subject[$i] . "' to " . $this->to_email[$i][$j] . ":" . MESSAGE_ERROR;
						$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
					}
				} catch (Swift_TransportException $t) {
					// connection could not be established
					$_SESSION["message"] = "Failed to send email '" . $this->subject[$i] . "' to " . $this->to_email[$i][$j] . ": " . $t->getMessage();
					$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
					audit_trail::log_trail("Email", $_SESSION["message"], "system", "Notification", $this->to_email[$i][$j]);
					return;	
				}		

				// log the user activity
				audit_trail::log_trail("Email", $_SESSION["message"], "system", "Notification", $this->to_email[$i][$j]);
			endfor;
		endfor;
    }
}
?>