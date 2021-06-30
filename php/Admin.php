<?php
    require_once("Database.php");

    class Admin {

        protected $db;

        function drawSelectItems($table) {
            $this->db = new Database();
            $pdo = $this->db->createPDO();
            $type = $this->db->getAllFromTable($pdo, $table);
            for ($i = 0; $i < sizeof($type); $i++)
                echo '<option value="'.$type[$i][0].'" class="option-select-admin-form">'.$type[$i][1].'</option>';
        }

        function drawAddGameForm() {
            $admin = new Admin();
            echo '<form method="post" class="admin-form" id="admin-form-game" enctype="multipart/form-data">
            <h1 class="form-title-admin-form">Dodaj grę do sklepu</h1>
            <label for="title-admin-form" class="label-admin-form">
                Tytuł gry
            </label>
            <input type="text" name="title-admin-form" id="title-admin-form" class="text-admin-form" placeholder="np. Days gone" maxlength="50">
            <label for="brutto-admin-form" class="label-admin-form">
                Cena brutto gry
            </label>
            <input type="number" name="brutto-admin-form" id="brutto-admin-form" class="number-admin-form" placeholder="np. 159.99" step="0.01" min="0.01" max="999.99" onchange="showPriceNetto()">
            <label for="netto-admin-form" class="label-admin-form">
                Cena netto gry
            </label>
            <input type="number" name="netto-admin-form" id="netto-admin-form" class="number-admin-form" placeholder="np. 130.07" step="0.01" min="0.01" max="999.99">
            <label for="short-desc-admin-form" class="label-admin-form">
                Krótki opis gry
            </label>
            <textarea name="short-desc-admin-form" id="short-desc-admin-form" class="textare-admin-form" placeholder="Jedź i walcz w zabójczej, postpandemicznej Ameryce. W tej przygodowej grze akcji z otwartym światem zagrasz jako Deacon St. John, walczący o przetrwanie włóczęga i łowca nagród, przemierzający zniszczoną drogę w poszukiwaniu powodów, by dalej żyć." maxlength="250"></textarea>
            <label for="desc-admin-form" class="label-admin-form">
                Opis gry
            </label>
            <textarea name="desc-admin-form" id="desc-admin-form" class="textare-admin-form" placeholder="Days Gone  to klasyczna przygodowa gra akcji, w której kamera znajduje się stale za plecami głównego bohatera. Podczas rozgrywki eksplorujemy obszerną sandboksową mapę, wykonujemy zadania (główne i poboczne – np. czyszczenie obozów z bandytów czy polowanie na zwierzęta) i walczymy z wrogami – zarówno ludźmi, jak i z rozmaitymi rodzajami groźnych ofiar wirusa. Te ostatnie często poruszają się w hordach liczących nawet kilkaset osobników, a do tego posiadają własne potrzeby i regulujący ich zachowanie cykl dobowy. Ciekawym detalem urozmaicającym zabawę jest częściowa interaktywność otoczenia – mamy możliwość m.in. popychania przeciwników na obiekty lub przecinania lin podtrzymujących ścięte drzewa. Twórcy położyli też duży nacisk na taktykę i planowanie – szczególnie w przypadku starć z ludzkimi wrogami." maxlength="1000"></textarea>
            <label for="quantity-admin-form" class="label-admin-form">
                Ilość kluczy 
            </label>
            <input type="number" name="quantity-admin-form" id="quantity-admin-form" class="number-admin-form" placeholder="np. 50"  min="1" max="999">
            <label for="type-admin-form" class="label-admin-form">
                Typ gry
            </label>
            <div class="container-select-admin-form">
                <select id="type-admin-form" name="type-admin-form" class="select-admin-form">';
                    $admin->drawSelectItems('type');
                echo '</select>
            </div>
            <label for="version-admin-form" class="label-admin-form">
                Wersja gry
            </label>
            <div class="container-select-admin-form">
                <select id="version-admin-form" name="version-admin-form" class="select-admin-form">';
                    $admin->drawSelectItems('version');
                echo '</select>
            </div>
            <label for="platform-admin-form" class="label-admin-form">
                Platforma gry
            </label>
            <div class="container-select-admin-form">
                <select id="platform-admin-form" name="platform-admin-form" class="select-admin-form">';
                    $admin->drawSelectItems('platform');
                echo '</select>
            </div>
            <label for="cover-admin-form" class="label-admin-form">
                Okładka gry
            </label>
            <div id="cover-admin-form" class="image-upload-wrap">
                <input class="file-upload-input" name="file-upload-input" type="file" onchange="readURL(this);" accept="image/*">
                <div class="drag-text">
                    <h3>Przeciągnij i upuść plik lub wybierz obraz</h3>
                </div>
            </div>
            <div class="file-upload-content">
                <img class="file-upload-image" src="#" alt="Okładka gry">
                <div class="image-title-wrap">
                    <button type="button" onclick="removeUpload()" class="remove-image">Usuń <span class="image-title"></span></button>
                </div>
            </div>
            <input type="submit" value="Dodaj grę" class="submit-admin-form">
        </form>';
        }

        function addGameToDatabase($title, $price_brutto, $price_netto, $short_desc, $desc, $quantity, $type, $version, $platform) {
            
        }

    }

?>