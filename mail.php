<?php 

            $email = $request->email;

            //dd('ffd');

            $user = User::where('email', '=', $email)->first();
           // dd($user->id);
            
            if ($user == null) {
                
                return back()->with('error', 'Please Check, Your Email Does not Exists With Gocoiner.com.');
            }
           else{
              $id = base64_encode($user->id);
              $link = asset('verify/');
             //dd($link);
              //send mail to verify email
              require_once(public_path('phpmailer/class.phpmailer.php'));


              $mail = new PHPMailer();

             //dd('dda');

              $mail->IsSMTP();
              $mail->Host = "gocoiner.com";

              $mail->SMTPAuth = true;
              //$mail->SMTPSecure = "ssl";
              $mail->Port = 587;
              $mail->Username = "xu79rce8hj8b@gocoiner.com";
              $mail->Password = "W&say6Fay&{G";

              $mail->From = "admin@gocoiner.com";
              //$mail->To = "vivek.allalgos@gmail.com";
              $mail->FromName = "Gocoiner";
              $mail->AddAddress($email);
              //$mail->AddReplyTo("vivek.allalgos@gmail.com");

              $mail->IsHTML(true);

              $mail->Subject = "Gocoiner Reset Password Request";
              $message = 'Please click on below link to Reset your Password.<br/>';
              $message .= 'Gocoiner-Link-'.$link.'/'.$id;
             // dd($message);
              $mail->Body = $message;
              //$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

              if(!$mail->Send())
              {
                  echo "Message could not be sent. <p>";
                  echo "Mailer Error: " . $mail->ErrorInfo;
                  exit;
              }
?>