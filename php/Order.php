<?php

    class Order {

        protected $orders;
        protected $gameData;
        protected $ordersCount;
        protected $orderValue, $gamesValue, $orderDiscountValue;
    
        //Wyświetla zamówienia użytkownika
        function drawOrders($pdo, $db, $grid) {
            $this->orders = $db->getOrdersNumbers($pdo, $_SESSION['login']);
            $this->ordersCount = sizeof($this->orders);
            if($this->ordersCount == 0) 
                echo '<h1 class="text-alert">Nie masz jeszcze historii zakupów.</h1>';
            else {
                for($j=0; $j < $this->ordersCount; $j++) {
                    $this->gameData = $db->getOrders($pdo, $_SESSION['login'], $this->orders[$j][0]);
                    $this->orderValue = $db->getOrderValue($pdo, $this->orders[$j][0])[0][0];
                    $this->orderDiscountValue = $db->getOrderValue($pdo, $this->orders[$j][0])[0][1];
                    $this->gamesValue = $db->getOrderGameValue($pdo, $this->orders[$j][0]);
                    echo '<div class="order-container">
                    <div class="order-number">
                        Zamówienie numer: '.$this->gameData[0][3].'
                        <a class="invoice-button" href="?account=historia&invoice-number='.$this->gameData[0][3].'" title="Pobierz fakturę" download>Pobierz fakturę</a>
                    </div>
                    <div class="order-data">
                        Ilość: '.$this->gamesValue.'
                        Wartość: '.$this->orderValue.' zł';
                        if($this->orderDiscountValue > 0) {
                            echo ' w tym zniżka: '.$this->orderDiscountValue.' zł';
                        } 
                        echo '<br>Data zamówienia: '.$this->gameData[0][5].'
                        <br>Metoda płatnośći: '.$this->gameData[0][6].'
                    </div>';
                    for($i = 0; $i < count($this->gameData); $i++) {
                        $this->gameData = $db->getOrders($pdo, $_SESSION['login'], $this->orders[$j][0]);
                        echo '                  
                        <div class="order-game">
                            <div class="order-game-cover">';
                                $grid->drawCoverGame($this->gameData[$i][1]);
                            echo '</div>
                            <a href="produkt?id='.$this->gameData[$i][0].'" title="Zobacz grę '.$this->gameData[$i][1].'" class="order-game-title">
                                '.$this->gameData[$i][1].'
                            </a>
                            <div class="order-game-quantity">
                                Ilość: 
                                '.$this->gameData[$i][4].'
                            </div>
                            <div class="order-game-price">
                                '.$this->gameData[$i][2].' zł
                            </div>
                        </div>';
                    }
                    echo '</div>';
                }
            }
        }
    }

?>