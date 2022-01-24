<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
<?php
    session_start();
    include("includes/db.php");
    include("functions/functions.php");
    
    require 'vendor/autoload.php';

    
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    


                       
    global $db;
    $date = date('mdYhis', time());
    $fileName = './data/'.$date.'.xlsx';
    
    
    
    unlink($fileName);

    addOrder($ip_add, $run_cart);
    
    saveInvoice();
    
    sendEmail();

    function sendEmail()
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
            $mail->addAddress('tracyfeiguiyu7@gmail.com'); 
            $mail->addAddress('mail@basicspirit.nz');       //Add a recipient
        
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the email message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->AddAttachment("invoice.pdf");
        
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        unlink("invoice.pdf");
    }

    function saveInvoice()
    {
        // global $db;
        // $ip_add = getRealIpUser();
        // $select_cart = "select * from cart where ip_add='$ip_add'";

        // $run_cart = mysqli_query($db,$select_cart);

        // $inputFileName = './data/BeautifulThings.xlsx';
        // $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
        // $worksheet = $spreadsheet->getActiveSheet();

        // $row = 21;
        // while($record=mysqli_fetch_array($run_cart)){

                 
        //     global $db;
        //     $pid = $record['p_id'];
        //     $select_products = "select * from products where product_id='$pid'";
        //     $run_products = mysqli_query($db,$select_products);
            
        //     while($row_products = mysqli_fetch_array($run_products)){
        //         $product_title = $row_products['product_title'];
        //         $product_code = $row_products['code'];
        //         $worksheet->setCellValueByColumnAndRow(5, $row, $product_code);
        //         $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $product_title);
        //     }
        //     $worksheet->setCellValueByColumnAndRow(4, $row, $record['qty']);
        //     $worksheet->setCellValueByColumnAndRow(7, $row, $record['p_price']);
        //     $worksheet->setCellValueByColumnAndRow(8, $row, '=D'.$row.'*G'.$row);  
        //     $row++;
            
        // }

        // $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        // $writer->save($fileName);

// Require composer autoloaduse PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf;

        require_once __DIR__ . '/vendor/autoload.php';
        // $mpdf->allow_charset_conversion=true;

        // Create an instance of the class:
        $mpdf = new \Mpdf\Mpdf();
        // $mpdf->allow_charset_conversion = true;
        // $mpdf->charset_in = 'iso-8859-4';
        
        $a = file_get_contents("http://localhost/BasicSpirit/invoice.php");
        $mpdf->SetFont('Maiandra GD');
        // $stylesheet = file_get_contents('styles/style.css');
        // Write some HTML code:
        $mpdf->WriteHTML(mb_convert_encoding($a, 'UTF-8', 'UTF-8'));
        // Output a PDF file directly to the browser
        $mpdf->Output('invoice.pdf');
        

    }


?>

</body>