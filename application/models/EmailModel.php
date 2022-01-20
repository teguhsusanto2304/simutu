<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    include APPPATH.'libraries/PHPMailer/src/Exception.php';
    include APPPATH.'libraries/PHPMailer/src/PHPMailer.php';
    include APPPATH.'libraries/PHPMailer/src/SMTP.php';

    class EmailModel extends CI_Model{
        var $mail;

        public function __construct(){
            parent::__construct();
            $this->mail     =   new PHPMailer(true);
        }
        public function sendEmail($emailParams = null){
            $statusSend     =   false;
            $message        =   'Email Params not set!';

            if(!is_null($emailParams)){
                $mail   =   $this->mail;

                if(array_key_exists('subject', $emailParams) && array_key_exists('body', $emailParams)){
                    extract($emailParams);

                    try {
                        if(array_key_exists('smtpDebug', $emailParams)){
                            $smtpDebug  =   $emailParams['smtpDebug'];

                            if($smtpDebug){
                                $mail->SMTPDebug    =   SMTP::DEBUG_SERVER; 
                            }    
                        }                 
                        $mail->isSMTP();                                            
                        $mail->Host         =   'tempequ.com';               
                        $mail->SMTPAuth     =   true;                                   
                        $mail->Username     =   'admin@tempequ.com';                                 
                        $mail->Password     =   '4dm1nt3mp3qu.c0m';                                            
                        $mail->SMTPSecure   =   PHPMailer::ENCRYPTION_STARTTLS;            
                        $mail->Port         =   587;                                    
                    
                        //Recipients
                        $mail->setFrom('admin@tempequ.com', 'Admin TempeQu');
                        if(array_key_exists('receivers', $emailParams)){
                            extract($emailParams);

                            if(is_array($receivers)){
                                if(count($receivers) >= 1){
                                    foreach($receivers as $penerima){
                                        if(array_key_exists('email', $penerima)){
                                            $withName   =   (array_key_exists('name', $penerima));
                                            $mail->addAddress($penerima['email'], ($withName)? $penerima['name'] : ''); 
                                        }
                                    }
                                }
                            }
                        }              
                        $mail->addReplyTo('admin@tempequ.com', 'Admin TempeQu');
                    
                        //Content
                        $mail->isHTML(true);                                 
                        $mail->Subject =    $subject;
                        $mail->Body    =    $body;
                    
                        if($mail->send()){
                            $statusSend     =   true;
                            $message        =   null;
                        }else{
                            $message        =   'Could not send email! Please contact the developer on whatsapp 082362249483!';
                        }
                    } catch (Exception $e) {
                        $message    =   $mail->ErrorInfo;
                    }
                }else{
                    $message    =   'You dont include subject and body!';
                }
            }

            return ['statusSend' => $statusSend, 'message' => $message];
        }
    }
?>