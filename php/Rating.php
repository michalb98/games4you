<?php

    class Rating {

        protected $games;

        function drawRating($db, $pdo, $login, $rating) {
            $this->games = $db->getGamesToRating($pdo, $login);
            if(sizeof($this->games) == 0) {
                echo '<h1 class="text-alert">Nie masz gier do oceny.</h1>';
            } else {
                for($i=0; $i < sizeof($this->games); $i++) {
                    $gameRating = $rating->checkRating($db, $pdo, $login, $this->games[$i][0]);
                    echo '<div class="game-rating-container">
                            <div class="order-game-cover">
                                <img src="./img/covers/'.$this->games[$i][1].'_cover.webp" alt="">
                            </div>
                            <a href="produkt?id='.$this->games[$i][0].'" title="Zobacz grę '.$this->games[$i][1].'" class="order-game-title">
                                '.$this->games[$i][1].'
                            </a>
                            <div class="game-rating">
                                <form class="form-star" method="POST">';
                                    if(!$gameRating)
                                        echo '<input type="submit" class="submit-rating" value="Oceń">';
                                    else
                                        echo 'Dziękujemy!';
                                    echo '<input type="radio" class="star" id="star-5-'.$this->games[$i][0].'" name="star" value="5" ';
                                        if($gameRating)
                                            echo "disabled";
                                        if($gameRating == 5)
                                            echo " checked";
                                    echo '>
                                    <label class="label-star" for="star-5-'.$this->games[$i][0].'"></label>
                                    <input type="radio" class="star" id="star-4-'.$this->games[$i][0].'" name="star" value="4"';
                                    if($gameRating)
                                        echo "disabled";
                                    if($gameRating == 4)
                                        echo " checked";
                                    echo '>
                                    <label class="label-star" for="star-4-'.$this->games[$i][0].'"></label>
                                    <input type="radio" class="star" id="star-3-'.$this->games[$i][0].'" name="star" value="3"';
                                    if($gameRating)
                                        echo "disabled";
                                    if($gameRating == 3)
                                        echo " checked";
                                    echo '>
                                    <label class="label-star" for="star-3-'.$this->games[$i][0].'"></label>
                                    <input type="radio" class="star" id="star-2-'.$this->games[$i][0].'" name="star" value="2"';
                                    if($gameRating)
                                        echo "disabled";
                                    if($gameRating == 2)
                                        echo " checked";
                                    echo '>
                                    <label class="label-star" for="star-2-'.$this->games[$i][0].'"></label>
                                    <input type="radio" class="star" id="star-1-'.$this->games[$i][0].'" name="star" value="1"';
                                    if($gameRating)
                                        echo "disabled";
                                    if($gameRating == 1)
                                        echo " checked";
                                    echo '>
                                    <label class="label-star" for="star-1-'.$this->games[$i][0].'"></label>
                                    <input type="hidden" name="rating-game-id" value="'.$this->games[$i][0].'">                               
                                </form>
                            </div>
                        </div>';
                }
            }
        }

        private function checkRating($db, $pdo, $login, $idGame) {
            $rating = $db->checkGameToRating($pdo, $login, $idGame);
            if($rating == false) 
                return false;
            else
                return $rating;
        }

        function ratingGame($pdo, $db, $idGame, $idUser, $rating) {
            $db->insertGameRating($pdo, $idGame, $idUser, $rating);
            header('Location: ?account=ocena');
        }
    }

?>  