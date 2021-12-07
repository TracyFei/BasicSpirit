<?php
    include("includes/header.php"); 
    
    require 'vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $inputFileName = './data/BeautifulThings.xlsx';
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
    $worksheet = $spreadsheet->getActiveSheet();
                       
    global $db;
    $ip_add = getRealIpUser();
    $select_cart = "select * from cart where ip_add='$ip_add'";

    $run_cart = mysqli_query($db,$select_cart);

    $row = 21;
    while($record=mysqli_fetch_array($run_cart)){
        
        $worksheet->setCellValueByColumnAndRow(4, $row, 1);
        $worksheet->setCellValueByColumnAndRow(5, $row, $record['p_id']);
        // $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($row, 6, $record['p_id']);
        $worksheet->setCellValueByColumnAndRow(7, $row, $record['p_price']);
        $worksheet->setCellValueByColumnAndRow(8, $row, '=D'.$row.'*G'.$row);  
        $row++;
        
    }

    $date = date('mdYhis', time());
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    $fileName = './data/'.$date.'.xlsx';
    $writer->save($fileName);


    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'tracyfeiguiyu7@gmail.com';                     //SMTP username
        $mail->Password   = '1997feigui--yu';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('basicspirit@basicspirit.nz');
        $mail->addAddress('tracyfeiguiyu7@gmail.com');     //Add a recipient
        $mail->addAddress('zhanglicug@126.com');               //Name is optional
    
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->AddAttachment($fileName);
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }



?>