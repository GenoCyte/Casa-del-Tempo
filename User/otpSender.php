<?php
    session_start();
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'src/Exception.php';
    require 'src/PHPMailer.php';
    require 'src/SMTP.php';
    require 'config.php';

    if($conn->connect_error){
        die('Connection Failed : ' .$conn->connect_error);
    }

    if(isset($_POST['email'])){
        $email = $_POST['email'];
        $sql = "SELECT email FROM user WHERE email = '$email'";
        $result = $conn->query($sql);

        if($result -> num_rows > 0){

            $otp = rand(100000, 999999);

            $stmt = $conn->prepare("UPDATE user SET otp = '$otp' WHERE email = '$email'");
            $stmt->execute();

            $mail = new PHPMailer(true);

            try {
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'gazerampong@gmail.com';                     //SMTP username
                $mail->Password   = 'evyhcpmithdrhafp';                               //SMTP password
                $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('gazerampong@gmail.com', 'Casa Del Tempo');
                $mail->addAddress($email, 'User');     //Add a recipient
                //$mail->addAddress('ellen@example.com');               //Name is optional
                //$mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Forgot Password';
                $mail->Body    = 'Your OTP is: '. $otp;
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                $_SESSION['email'] = $email;
                echo"<script>
                        alert('OTP is send to your email')
                        window.location='forgotPass2.php';
                    </script>";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }else{
            echo"<script>
                    alert('Email is Incorrect')
                    window.location='forgotPass1.php';
                </script>";
        }
    }
    $conn->close();
?>