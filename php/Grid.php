<?php

    class Grid {

        function drawGamesGrid($games) {
            $rows = count($games);
            for ($row = 0; $row < $rows; $row++) {
                $cols = count($games[$row]);
                for($col = 0; $col < $cols; $col++ ) {
                    echo $games[$row][$col].'<br><br>';
                }
            }
        }

    }

?>