<?php

    class Reply {
        protected $issue;
        protected $mail;
        protected $description;
        protected $reply;

        //Pobiera dane oraz dokonuje sanityzacji
        function setValueReply($mail, $issue, $description, $reply) {
            $this->mail = filter_var($mail, FILTER_SANITIZE_EMAIL);
            $this->issue = filter_var($issue, FILTER_SANITIZE_STRING);
            $this->description = filter_var($description, FILTER_SANITIZE_STRING);
            $this->reply = filter_var($reply, FILTER_SANITIZE_STRING);
        }

        //Sprawdza poprawność danych z formularza odpowiedz
        function validateFormReply() {
            try {
                !((strlen($this->reply) > 2000) || strlen($this->reply) < 20) ? : throw new Exception('Proszę napisać wiadomość! Treść powninna składać się od 20 do 2000 znaków.');
                return true;
            } catch (Exception $e) {
                $_SESSION['error-reply'] = $e->getMessage();
                return false;
            }
        }

        function drawReplyForm($db, $pdo) {

            echo '<div class="contact-form">
                    <label for="mail" class="label">
                        Adres E-mail
                    </label>
                    <div class="label-desc">'.$this->mail.'</div>
                    <label for="issue" class="label">
                        Czego dotyczy wiadomość
                    </label>
                    <div class="label-desc">'.$this->issue.'</div>
                    <label for="description-issue" class="label">
                        Treść wiadomości
                    </label>
                    <div class="label-desc">'.$this->description.'</div>
                    <label for="reply-issue" class="label">
                        Odpowiedź
                    </label>
                    <form class="contact-form" method="POST">
                        <textarea name="reply-issue" id="reply-issue" class="input-account textarea-account" maxlength="2000" placeholder="np. Witam! ...">'.$this->reply.'</textarea>
                        <input type="submit" value="Odpowiedz" class="submit-account">';
                        if(isset($_SESSION['error-reply'])) {
                            echo '<span class="error">'.$_SESSION['error-reply'].'</span>';
                            unset($_SESSION['error-reply']);
                        }
                    echo '</form>';
                echo '</div>';
        }
    }

?>