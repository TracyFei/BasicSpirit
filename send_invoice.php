<?php
    include("includes/header.php"); 
    
    require 'vendor/autoload.php';

    
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


                       
    global $db;
    $date = date('mdYhis', time());
    $fileName = './data/'.$date.'.xlsx';
    saveInvoice($fileName);
    sendEmail($fileName);
    
    unlink($fileName);

    addOrder($ip_add, $run_cart);

    function sendEmail($fileName)
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
            $mail->addAddress('tracyfeiguiyu7@gmail.com');     //Add a recipient
        
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the email message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->AddAttachment($fileName);
        
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    function saveInvoice($fileName)
    {
        global $db;
        $ip_add = getRealIpUser();
        $select_cart = "select * from cart where ip_add='$ip_add'";

        $run_cart = mysqli_query($db,$select_cart);

        $inputFileName = './data/BeautifulThings.xlsx';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
        $worksheet = $spreadsheet->getActiveSheet();

        $row = 21;
        while($record=mysqli_fetch_array($run_cart)){

                 
            global $db;
            $pid = $record['p_id'];
            $select_products = "select * from products where product_id='$pid'";
            $run_products = mysqli_query($db,$select_products);
            
            while($row_products = mysqli_fetch_array($run_products)){
                $product_title = $row_products['product_title'];
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $product_title);
            }
            $worksheet->setCellValueByColumnAndRow(4, $row, $record['qty']);
            $worksheet->setCellValueByColumnAndRow(5, $row, $pid);
            // $worksheet->setCellValueByColumnAndRow()
            $worksheet->setCellValueByColumnAndRow(7, $row, $record['p_price']);
            $worksheet->setCellValueByColumnAndRow(8, $row, '=D'.$row.'*G'.$row);  
            $row++;
            
        }

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($fileName);
    }


?>