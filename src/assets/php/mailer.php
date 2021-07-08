<?php
    require '../init.php';
    include('../res_handler.php');

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    $to = $request->email;
    $name = $request->name;
    $mesage_body = $request->message;
    $country = $request->country;
    $phone = $request->phone;

    // Message
    $message_to_ess = '
        <html>
        <head>
        <title>Customer Enquiry</title>
        </head>
        <body>
        <p>Here are the details of enquiry.</p>
        <table>
            <tr>
            <td>Name</td>
            <td>:</td>
            <td>' . $name . '</td>
            </tr>
            <tr>
            <td>Email</td>
            <td>:</td>
            <td>' . $to . '</td>
            </tr>
            <tr>
            <td>Phone</td>
            <td>:</td>
            <td>' . $phone . '</td>
            </tr>
            <tr>
            <td>Country Code</td>
            <td>:</td>
            <td>' . $country . '</td>
            </tr>
        </table>
        <br>
        <p>' . $request->message . ' </p>
        </body>
        </html>
        ';
    $message_to_customer = '
        <html>
            <head>
                <title>Enquiry - Support @ ESS Consultancy</title>
            </head>
            <body>
                <p>Dear <span style="text-transform:capitalize;">' . $name . '</span>,</p>
                <p>Thank you for your enquiry. We will get in touch with you shortly.<br>You can reach us at <a href="mailto:info@essconsult.com">info@essconsult.com</a></p>
                <br>
                <div style="background:#f2f2f2; padding:10px;">
                    <p>Message copy</p>
                    <pre>' . $request->message . ' </pre>
                </div>
                
            </body>
        </html>
        ';

    // To send HTML mail, the Content-type header must be set
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=iso-8859-1';
    $headers[] = 'X-Priority: 3';
    $headers[] = 'X-Mailer: PHP' . phpversion();
    // Additional headers
    $headers[] = 'From: Support -  ESS Consultancy<info@essconsult.com>';
    $headers[] = 'Reply-To: Support -  ESS Consultancy<info@essconsult.com>';
    $headers[] = 'Return-Path: Support -  ESS Consultancy<info@essconsult.com>';
    $headers[] = 'Organization: ESS Consultancy';

    print_r($headers);
    // Mail it
    mail('<info@essconsult.com>', 'Customer Enquiry from ESS Consultancy', $message_to_ess, implode("\r\n", $headers), '-finfo@essconsult.com');
    try {
        if(mail($to, 'Customer Support | ESS Consultancy', $message_to_customer, implode("\r\n", $headers), '-finfo@essconsult.com')){
            send_response(true, 'Mail sent successfully!');
        } else {
            send_response(false, 'Unable to send mail!');
        }
    } catch (Exception $e) {
        $msg = $e->getMessage();
    }
?>