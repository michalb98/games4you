<?php

    class Grid {

        function drawGamesGrid($games) {
            $rows = count($games);
            for ($row = 0; $row < $rows; $row++) {
                echo '<a class="game" href="" title="Zobacz produkt '.$games[$row][1].'">
                        <div class="game-cover-container">
                            <img class="game-cover" src="./img/covers/'.$games[$row][1].'_'.$games[$row][0].'_cover.jpg" alt="Days gone">
                        </div>
                        <div class="game-container">
                             <div class="game-info">
                                 <p class="game-title">'.$games[$row][1].'</p>
                                 <p class="game-price">'.$games[$row][3].' zł</p>
                            </div>
                            <div class="game-info-hover">
                                <p class="game-title">'.$games[$row][1].'</p>
                                <p class="game-desc">'.$games[$row][4].'</p>
                                <p class="game-price">'.$games[$row][3].' zł</p>
                            </div>
                        </div>
                     </a>'; 
            }
        }

    }

?>