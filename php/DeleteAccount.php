<?php

    class DeleteAccount {

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
                    <input type="submit" value="Permanentnie usuń konto" class="submit-account">
                </form>
              </label>';
                
        }

    }

?>