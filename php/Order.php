<?php

    class Order {

        protected $orders;
        protected $gameData;
        protected $ordersCount;
        protected $orderValue, $gamesValue;
    
        function drawOrders($pdo, $db) {
            $this->orders = $db->getOrdersNumbers($pdo, $_SESSION['login']);
            $this->ordersCount = sizeof($this->orders);
            if($this->ordersCount == 0) 
                echo '<h1 class="text-alert">Nie masz jeszcze historii zakupów.</h1>';
            else {
                for($j=0; $j < $this->ordersCount; $j++) {
                    $this->gameData = $db->getOrders($pdo, $_SESSION['login'], $this->orders[$j][0]);
                    $this->orderValue = $db->getOrderValue($pdo, $this->orders[$j][0]);
                    $this->gamesValue = $db->getOrderGameValue($pdo, $this->orders[$j][0]);
                    echo '<div class="order-container">
                    <div class="order-number">
                        Zamówienie numer: '.$this->gameData[0][3].'
                    </div>
                    <div class="order-data">
                        Ilość: '.$this->gamesValue.'
                        Wartość: '.$this->orderValue.' zł
                        <br>Data zamówienia: '.$this->gameData[0][5].'
                    </div>';
                    for($i=0; $i < count($this->gameData);$i++) {
                        $this->gameData = $db->getOrders($pdo, $_SESSION['login'], $this->orders[$j][0]);
                        echo '                  
                        <div class="order-game">
                            <div class="order-game-cover">
                                <img src="./img/covers/'.$this->gameData[$i][1].'_cover.webp" alt="'.$this->gameData[$i][1].'">
                            </div>
                            <div class="order-game-title">
                                '.$this->gameData[$i][1].'
                            </div>
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