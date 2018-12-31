
<?PHP
			$sender = 'leena.schumacher@web.de';
			$recipient = 'leena.schumacher@web.de';

			$subject = "php mail test";
			$message = "php test message";
			$headers = 'From:' . $sender;

			if (mail($recipient, $subject, $message, $headers))
			{
			    echo "Message accepted";
			}
			else
			{
			    echo "Error: Message not accepted";
			}
?>