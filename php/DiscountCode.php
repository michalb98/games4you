<?php

    class DiscountCode {

        protected $discountCode;

        //Wyświetla kody rabatowe użytkonika o loginie $login
        function drawDiscountCode($db, $pdo, $login) {
            $this->discountCode = $db->getDiscountCode($pdo, $login);
            if(sizeof($this->discountCode) == 0) {
                echo '<h1 class="text-alert">Nie posiadasz kodów rabatowych.</h1>';
            } else {
                echo '<h1 class="text-alert">Twoje kody rabatowe.</h1>';
                for($i=0; $i < sizeof($this->discountCode); $i++) {
                    echo '<div class="game-rating-container discount-code-container">
                            <div class="discount-code">
                                <span class="info-label">Kod rabatowy:</span>'.$this->discountCode[$i][0].'
                            </div>
                            <div class="validate-account">
                                <span class="info-label">Ważny od:</span>'.$this->discountCode[$i][1].'
                            </div>
                            <div class="validate-account">
                                <span class="info-label">Ważny do:</span>'.$this->discountCode[$i][2].'
                            </div>
                            <div class="value-account">
                                <span class="info-label">Wartość:</span>'.$this->discountCode[$i][3].' zł
                            </div>
                        </div>';
                }
            }
        }
    }

?>