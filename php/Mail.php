<?php

    class Mail {
        function sendEmail($contactForm, $subjectForm, $messageForm, $email) {
            $subject = $subjectForm;
            $message = '
                        <html>
                            <head>
                                <meta charset=utf-8">
                                <title></title>
                                <style>
                                    #email-wrap {
                                        justify-content: center;
                                        align-items: center;
                                        overflow: hidden;
                                     }
                                     h1,p,a{
                                         text-align: center;
                                     }
                                            
                                     a{
                                         margin-left: auto;
                                         margin-right: auto;
                                     }
                                 </style>
                             </head>
                             <body>
                                <div id="email-wrap">
                                    <h1>Temat <span style="color:#df9191;">'.$subject.'</span>,</h1><br>
                                     <p>Kontakt: '.$contactForm.'</p><br>
                                     <p>Treść: '.$messageForm.'</p>
                                 </div>
                             </body>
                         </html>';
            $headers = "MIME-Version: 1.0" . "\r\n"; 
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
            $headers .= "From: games4you.pl";
            
            if(mail($email, $subject, $message, $headers)) {     
                return 'Wysłano maila!';
            } 
        }
    }

?>