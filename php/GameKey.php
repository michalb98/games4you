<?php

    class GameKey {
        protected $games, $keyShow;
        
        function drawGameKey($db, $pdo, $login, $grid) {
            $this->games = $db->boughtGames($pdo, $login);
            if(sizeof($this->games) == 0)
                echo '<h1 class="text-alert">Nie posiadasz jeszcze żadnych kluczy :(</h1>';
            else
                echo '<h1 class="text-alert">Twoje klucze do gier.</h1>';
            for($i = 0; $i < sizeof($this->games); $i++) {
                $this->keyShow = $db->checkGameToReturn($pdo, $this->games[$i][0], $this->games[$i][3]);
                echo '
                <div class="game-rating-container">
                    <div class="order-game-cover">';
                        $grid->drawCoverGame($this->games[$i][1]);
                    echo '</div>
                    <a href="produkt?id='.$this->games[$i][0].'" title="Zobacz grę '.$this->games[$i][1].'" class="order-game-title">
                        '.$this->games[$i][1].'
                    </a>';
                    if($this->keyShow[0][0] == 0) {
                        echo'<form method="POST" class="form-return">
                        <input type="hidden" name="show-game-id" value="'.$this->games[$i][0].'">
                        <input type="hidden" name="order-number" value="'.$this->games[$i][2].'">
                        <input type="hidden" name="transaction-number" value="'.$this->games[$i][3].'">
                        <input class="game-return-submit key-submit" type="submit" value="Wyświetl klucz">
                        </form>';
                    } else {
                        echo '<div class="game-key">'.$db->showGameKey($pdo, $this->games[$i][3], $this->games[$i][0]).'</div>';
                    }
                    
                echo '</div>';
            }
        }

        function showGameKey($pdo, $db, $idGame, $idTransaction) {
            $db->updateTransactionShowKey($pdo, $idGame, $idTransaction);
            header('Location: ?account=klucze');
        }
    }

?>