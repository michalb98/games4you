<?php

    class Contact {
        
        protected $issue, $issueList;
        protected $mail;
        protected $description;

        //Pobiera dane oraz dokonuje sanityzacji
        function setValueContact($mail, $issue, $description) {
            $this->mail = filter_var($mail, FILTER_SANITIZE_EMAIL);
            $this->issue = filter_var($issue, FILTER_SANITIZE_STRING);
            $this->description = filter_var($description, FILTER_SANITIZE_STRING);
        }

        //Sprawdza poprawność danych z formularza kontak
        function validateFormContact() {
            try {
                !($this->mail == '') ? : throw new Exception('Proszę podać swój E-mail!');
                !($this->issue == 'Wybierz problem...') ? : throw new Exception('Proszę wybrać cel wiadomości!');
                !((strlen($this->description) > 2000) || strlen($this->description) < 20) ? : throw new Exception('Proszę napisać wiadomość! Treść powninna składać się od 20 do 2000 znaków.');
                return true;
            } catch (Exception $e) {
                $_SESSION['error-contact'] = $e->getMessage();
                return false;
            }
        }

        //Wyświetla formularz kontaktowy
        function drawContactForm($db, $pdo) {

            $this->issueList = $db->getIssue($pdo);

            echo '<form class="contact-form" method="POST">
                    <label for="mail" class="label">
                        Twój E-mail
                    </label>
                    <input type="email" name="mail" class="input-account" placeholder="np. adam@gmail.com" value="'.$this->mail.'">
                    <label for="issue" class="label">
                        Wybierz, czego dotyczy wiadomość
                    </label>
                    <select name="issue" id="issue" class="select-account input-account">
                        <option>Wybierz problem...</option>';
                        for($i = 0; $i < sizeof($this->issueList); $i++) {
                            if($this->issueList[$i][0] == $this->issue)
                                echo '<option selected>'.$this->issueList[$i][0].'</option>';
                            else 
                                echo '<option>'.$this->issueList[$i][0].'</option>';
                        }
                    echo '</select>
                    <label for="description-issue" class="label">
                        Treść wiadomości
                    </label>
                    <textarea name="description-issue" id="description-issue" class="input-account textarea-account" maxlength="2000" placeholder="np. Mam problem z ...">'.$this->description.'</textarea>
                    <input type="submit" value="Wyślij wiadomość" class="submit-account">';
                    if(isset($_SESSION['error-contact'])) {
                        echo '<span class="error">'.$_SESSION['error-contact'].'</span>';
                        unset($_SESSION['error-contact']);
                    }
                echo '</form>';
        }

        function addNotice($db, $pdo) {
            $idUser = $db->getUserId($pdo, $_SESSION['login']);
            $idIssue= $db->getIssueId($pdo, $this->issue);
            $db->insertIntoNotices($pdo, $idUser, $idIssue, $this->description);
        }
    }

?>