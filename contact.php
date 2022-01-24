<?php 
    
    $active='Contact';
    include("includes/header.php");
    require 'vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
                       use PHPMailer\PHPMailer\Exception;
?>
  
   <div id="content"><!-- #content Begin -->
       <div class="container"><!-- container Begin -->
           <div class="col-md-12"><!-- col-md-12 Begin -->
               
               <ul class="breadcrumb"><!-- breadcrumb Begin -->
                   <li>
                       <a href="index.php">Home</a>
                   </li>
                   <li>
                       Contact Us
                   </li>
               </ul><!-- breadcrumb Finish -->
               
           </div><!-- col-md-12 Finish -->
           
           <div class="col-md-12"><!-- col-md-12 Begin -->
               
               <div class="box"><!-- box Begin -->
                   
                   <div class="box-header"><!-- box-header Begin -->
                       
                       <center><!-- center Begin -->
                           
                           <h2> Feel free to Contact Us</h2>
                           
                           <p class="text-muted"><!-- text-muted Begin -->
                               
                               If you have any questions, feel free to contact us. Our Customer Service work <strong>24/7</strong>
                               
                           </p><!-- text-muted Finish -->
                           
                       </center><!-- center Finish -->
                       
                       <form action="contact.php" method="post"><!-- form Begin -->
                           
                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label>Name</label>
                               
                               <input type="text" class="form-control" name="name" required>
                               
                           </div><!-- form-group Finish -->
                           
                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label>Email</label>
                               
                               <input type="text" class="form-control" name="email" required>
                               
                           </div><!-- form-group Finish -->
                           
                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label>Subject</label>
                               
                               <input type="text" class="form-control" name="subject" required>
                               
                           </div><!-- form-group Finish -->
                           
                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label>Message</label>
                               
                               <textarea name="message" class="form-control"></textarea>
                               
                           </div><!-- form-group Finish -->
                           
                           <div class="text-center"><!-- text-center Begin -->
                               
                               <button type="submit" name="submit" class="btn btn-primary">
                               
                               <i class="fa fa-user-md"></i> Send Message
                               
                               </button>
                               
                           </div><!-- text-center Finish -->
                           
                       </form><!-- form Finish -->
                       
                       <?php 
                       
                       if(isset($_POST['submit'])){
                           
                           /// Admin receives message with this ///

                           $sender_name = $_POST['name'];
                           
                           $sender_email = $_POST['email'];

                           $sender_subject = $_POST['subject'];
                           
                           $sender_message = $_POST['message'];

                           $receiver_email = "mail@basicspirit.nz";
                           sendClientMsg($sender_email, $sender_subject, $sender_message);
                           sendAutoReply($sender_email);
                       }
                       
                       function sendClientMsg($senderAddress, $subject, $msg)
                       {
                           $mail = new PHPMailer(true);
                           try {
                               //Server settings
                               // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                               $mail->isSMTP();                                            //Send using SMTP
                               $mail->Host       = 'mailx.freeparking.co.nz';                     //Set the SMTP server to send through
                               $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                               $mail->Username   = 'mail@basicspirit.nz';                     //SMTP username
                               $mail->Password   = '14BasicSpirit28!';                               //SMTP password
                               $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
                               $mail->Port       = 2525 ;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                           
                               //Recipients
                               $mail->setFrom($senderAddress);
                               $mail->addAddress('mail@basicspirit.nz'); 
                            //    $mail->addAddress('mail@basicspirit.nz');       //Add a recipient
                           
                           
                               //Content
                               $mail->isHTML(true);                                  //Set email format to HTML
                               $mail->Subject = $subject;
                               $mail->Body    = $msg;
                            //    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                            //    $mail->AddAttachment($fileName);
                           
                               $mail->send();
                               echo 'Thank you, your message has been sent'; 
                           } catch (Exception $e) {
                               echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                           }
                       }


                       function sendAutoReply($receipient)
                       {
                           $mail = new PHPMailer(true);
                           try {
                               //Server settings
                               // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                               $mail->isSMTP();                                            //Send using SMTP
                               $mail->Host       = 'mailx.freeparking.co.nz';                     //Set the SMTP server to send through
                               $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                               $mail->Username   = 'mail@basicspirit.nz';                     //SMTP username
                               $mail->Password   = '14BasicSpirit28!';                               //SMTP password
                               $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
                               $mail->Port       = 2525 ;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                           
                               //Recipients
                               $mail->setFrom('mail@basicspirit.nz');
                               $mail->addAddress($receipient); 
                            //    $mail->addAddress('mail@basicspirit.nz');       //Add a recipient
                           
                           
                               //Content
                               $mail->isHTML(true);                                  //Set email format to HTML
                               $mail->Subject = 'Basic Spirit Auto Reply';
                               $mail->Body    = 'Welcome to Basic Spirit! Thanks for contacting us. We will contact you ASAP';
                               $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                            //    $mail->AddAttachment($fileName);
                           
                               $mail->send();
                               //echo 'auto Message has been sent';
                           } catch (Exception $e) {
                               echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                           }
                       }

                       ?>
                       
                   </div><!-- box-header Finish -->
                   
               </div><!-- box Finish -->
               
           </div><!-- col-md-12 Finish -->
           
       </div><!-- container Finish -->
   </div><!-- #content Finish -->
   
   <?php 
    
    include("includes/footer.php");
    
    ?>
    
    <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>
</body>
</html>