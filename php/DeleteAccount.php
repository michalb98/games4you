<?php

    class DeleteAccount {

        protected $login;
        protected $statute;
        protected $password;

        //Wyświetla powiadomienia oraz formularz do usunięcia konta
        function drawDeleteAccount($login) {
            echo '<h1 class="error" style="text-align: center;">Usunięcie konta jest trwałe i nieodwracalne. Oznacza to również utratę wszystkich niezapisanych kluczy do gier, faktur itd. Jeśli chcesz dalej usunąć konto: <span style="text-decoration: underline;">'.$login.'</span> musisz wypełnić poniższy formularz.</h1>';
            echo '<form class="form-account" method="POST">
                    <label for="password" class="label">
                        Hasło
                    </label>
                    <input type="password" id="password" name="password-delete" class="input-account" placeholder="*******">
                    <label for="statute" class="label">
                        Regulamin
                    </label>
                    <div class="container">
                        <input type="checkbox" name="statute" id="statute" class="checkbox-account">
                        <label for="statute" class="label-mark">
                            <div class="check-mark"></div>
                        </label>
                        <label for="statute">
                            Akceptuję regulamin.
                        </label>
                    </div>
                    <input type="hidden" name="delete-login" value="'.$login.'">
                    <input type="submit" value="Permanentnie usuń konto" class="submit-account">';
                    if(isset($_SESSION['error-delete'])){
                        echo '<span class="error">'.$_SESSION['error-delete'].'</span>';
                        unset($_SESSION['error-delete']);
                    }
                echo '</form>
              </label>';
                
        }

        function getValueFromDeleteForm($login, $statute, $password) {
            $this->login = filter_var($login, FILTER_SANITIZE_STRING);
            $this->password = hash("sha512", filter_var($password, FILTER_SANITIZE_STRING));
            $this->statute = filter_var($statute, FILTER_SANITIZE_STRING);
        }

        function validateDeleteForm($db, $pdo) {
            try {
                ($this->statute == true) ? : throw New Exception("Proszę zaakceptować regulamin!");
                ($this->password == $db->getUserPasswordHash($pdo, $this->login)) ? : throw New Exception("Błędne hasło!");
                return true;
            } catch (Exception $e) {
                $_SESSION['error-delete'] = $e->getMessage();
                return false;
            }
        }

        function deleteAccount($db, $pdo) {
            $idUser = $db->getUserId($pdo, $this->login);
            $db->updateTransactionDelete($pdo, $idUser);
            $userMail = $db->getUserMail($pdo, $this->login);
            $idAdditionalData = $db->getAdditionalDataId($pdo, $userMail);
            $db->updateGameRatingDelete($pdo, $idUser);
            $db->deleteUser($pdo, $idUser);
            $db->deleteAdditionalData($pdo, $idAdditionalData);
            session_unset();
            session_destroy();
            header('Location: strona-glowna');
        }

    }

?>