<?php

    class Rank {

        protected $idUser, $users;
        protected $idRank, $ranks;


        function setUserAndRank($user, $rank) {
            $this->idRank = filter_var($rank, FILTER_SANITIZE_NUMBER_INT);
            $this->idUser = filter_var($user, FILTER_SANITIZE_NUMBER_INT);
        }

        function validateRankForm() {
            try {
                if($this->idRank == "-1")
                    throw new Exception('Proszę wybrać rangę!');
                if($this->idUser == "-1")
                    throw new Exception('Proszę wybrać użytkownika!');
                return true;
            } catch (Exception $e) {
                $_SESSION['error-rank'] = $e->getMessage();
                return false;
            }
        }

        function drawRankForm($db, $pdo) {
            $this->users = $db->getUsersLogin($pdo);
            $this->ranks = $db->getRank($pdo);
            echo '<h1 class="h1-admin-panel">Nadaj uprawnienia użytkownikowi</h1>';
            echo '<form method="POST" class="contact-form">';
            echo '<label for="user-admin-form" class="label">
                Wybierz użytkownika
            </label>
            <div class="container-select-admin-form">
                <select id="user-admin-form" name="user-admin-form" class="select-admin-form">
                    <option value="-1" class="option-select-admin-form">Wybierz użytkownika ...</option>';
                    for($i = 0; $i < sizeof($this->users); $i++) {
                        if($this->idUser == $this->users[$i][0])
                            echo '<option value="'.$this->users[$i][0].'" class="option-select-admin-form" selected>'.$this->users[$i][1].'</option>';
                        else
                            echo '<option value="'.$this->users[$i][0].'" class="option-select-admin-form">'.$this->users[$i][1].'</option>';
                    }
                echo '</select>
            </div>';
            echo '<label for="rank-admin-form" class="label">
                Wybierz rangę
            </label>
            <div class="container-select-admin-form">
                <select id="rank-admin-form" name="rank-admin-form" class="select-admin-form">
                    <option value="-1" class="option-select-admin-form">Wybierz rangę ...</option>';
                    for($i = 0; $i < sizeof($this->ranks); $i++) {
                        if($this->idRank == $this->ranks[$i][0])
                            echo '<option value="'.$this->ranks[$i][0].'" class="option-select-admin-form" selected>'.$this->ranks[$i][1].'</option>';
                        else
                            echo '<option value="'.$this->ranks[$i][0].'" class="option-select-admin-form">'.$this->ranks[$i][1].'</option>';
                    }
                echo '</select>
            </div>
            <input type="submit" value="Nadaj rangę" class="submit-admin-form">';
            if(isset($_SESSION['error-rank'])) {
                echo '<span class="error">'.$_SESSION['error-rank'].'</span>';
                unset($_SESSION['error-rank']);
            }
            echo '</form>';
        }

        function addUserRank($db, $pdo) {
            try {
                $db->updateUserRank($pdo, $this->idUser, $this->idRank);
                return true;
            } catch (Exception $e) {
                return false;
            }
            
        }
    }

?>