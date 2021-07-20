<?php

    class GameCart {
        
        function emptyCart() {
            echo '<h1 class="cart-text">Twój koszyk jest pusty.</h1>';
        }

        function drawGameCart($pdo, $id, $db, $classNumber) {
            $gameData = $db->getGameData($pdo, $id);
            echo '<div class="game-cart-container">
            <div class="game-cart-cover">
                <img src="./img/covers/'.$gameData[0][0].'_cover.webp" alt="'.$gameData[0][0].'">
            </div>
            <a href="produkt?id='.$id.'" title="Zobacz grę w sklepie" class="game-cart-title">
                '.$gameData[0][0].'
            </a>
            <div class="game-cart-quantity">
                <form method="POST">
                    <label for="game-quantity">
                        Ilość: 
                    </label>
                    <input type="number" value="1" min="1" max="10" name="game-quantity" class="game-quantity" onchange="calculateTotalPriceGame('.$classNumber.'); calculateTotalPrice();" >
                    <input type="hidden" value='.$gameData[0][1].'" class="game-price-hidden">
                </form>
            </div>
            <div class="game-cart-price">
                '.$gameData[0][1].' zł
            </div>
            <div class="game-cart-remove">
                <a href="koszyk?remove='.$id.'" title="Usuń grę">
                    Usuń grę
                </a>';
            echo'</div>
        </div>';
        }

    }

?>