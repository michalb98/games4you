<?php

    require_once('./php/Database.php');
    require_once('./php/Grid.php');

    $db = new Database();
    $grid = new Grid();

    $pdo = $db->creatrPDO();
    $games = $db->getAllFromTable($pdo, 'game');


?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Michał Błaszczyk">
    <link rel="icon" type="image/png" href="./img/web/fav.png">
    <title>Games4You - panel administratora</title>
    <link rel="stylesheet" href="./css/main-style.css">
    <link rel="stylesheet" href="./css/admin-style.css">
</head>
<body>
    <div id="main-header">
        <a href="strona-glowna" title="Przejdź do strony głównej">
            <div id="logo">
                <img src="./img/web/logo.png" alt="Games4You">
            </div>
        </a>
        <div id="search">
            <input type="search" name="search">
        </div>
        <div id="account" class="icon-main-header">
        
        </div>
        <div id="cart" class="icon-main-header">
        
        </div>
    </div>
    <nav id="categories-nav">

    </nav>
    <main>
        <?php

            //$grid->drawGamesGrid($games);

        ?>
        <form method="post" class="admin-form" id="admin-form-game">
            <h1 class="form-title-admin-form">Dodaj grę do sklepu</h1>
            <label for="title-admin-form" class="label-admin-form">
                Tytuł gry
            </label>
            <input type="text" name="title-admin-form" id="title-admin-form" class="text-admin-form" placeholder="np. Days gone" maxlength="50">
            <label for="netto-admin-form" class="label-admin-form">
                Cena netto gry
            </label>
            <input type="number" name="netto-admin-form" id="netto-admin-form" class="number-admin-form" placeholder="np. 130.07" step="0.01" min="0.01" max="999.99">
            <label for="brutto-admin-form" class="label-admin-form">
                Cena brutto gry
            </label>
            <input type="number" name="brutto-admin-form" id="brutto-admin-form" class="number-admin-form" placeholder="np. 159.99" step="0.01" min="0.01" max="999.99">
            <label for="short-desc-admin-form" class="label-admin-form">
                Krótki opis gry
            </label>
            <textarea name="short-desc-admin-form" id="short-desc-admin-form" class="textare-admin-form" placeholder="Jedź i walcz w zabójczej, postpandemicznej Ameryce. W tej przygodowej grze akcji z otwartym światem zagrasz jako Deacon St. John, walczący o przetrwanie włóczęga i łowca nagród, przemierzający zniszczoną drogę w poszukiwaniu powodów, by dalej żyć." maxlength="250"></textarea>
            <label for="desc-admin-form" class="label-admin-form">
                Opis gry
            </label>
            <textarea name="desc-admin-form" id="desc-admin-form" class="textare-admin-form" placeholder="Days Gone  to klasyczna przygodowa gra akcji, w której kamera znajduje się stale za plecami głównego bohatera. Podczas rozgrywki eksplorujemy obszerną sandboksową mapę, wykonujemy zadania (główne i poboczne – np. czyszczenie obozów z bandytów czy polowanie na zwierzęta) i walczymy z wrogami – zarówno ludźmi, jak i z rozmaitymi rodzajami groźnych ofiar wirusa. Te ostatnie często poruszają się w hordach liczących nawet kilkaset osobników, a do tego posiadają własne potrzeby i regulujący ich zachowanie cykl dobowy. Ciekawym detalem urozmaicającym zabawę jest częściowa interaktywność otoczenia – mamy możliwość m.in. popychania przeciwników na obiekty lub przecinania lin podtrzymujących ścięte drzewa. Twórcy położyli też duży nacisk na taktykę i planowanie – szczególnie w przypadku starć z ludzkimi wrogami. Walczymy, korzystając z rozbudowanego arsenału, m.in. karabinów maszynowych, shotgunów czy snajperek. Deacon dysponuje również kilkoma specjalnymi umiejętnościami, takimi jak np. spowalnianie czasu w trakcie walki (klasyczny bullet time) czy tzw. survival vision, umożliwiające podkreślanie ważnych przedmiotów i przeciwników, dzięki czemu łatwiej jest dostrzec, co i kto nas otacza – i gdzie mogą kryć się potencjalne zagrożenia. W miarę postępów w rozgrywce bohater może uczyć się nowych rzeczy i stopniowo rozwijać statystyki (takie jak życie czy wytrzymałość). Gra posiada rozbudowany, ale relatywnie prosty w obsłudze system rzemiosła, na potrzeby którego zbieramy duże ilości przeróżnych materiałów. Duże znaczenie dla rozgrywki ma także motocykl, którym poruszamy się po mapie. Mamy możliwość dostosowywania jego wyglądu, parametrów technicznych (np. poprzez zmianę opon czy silnika), a także zdobywania innych usprawnień, takich jak torby umożliwiające przewożenie większej liczby przedmiotów. Co ciekawe, nasz stalowy rumak wymaga benzyny, o której zapas trzeba się zatroszczyć, jeśli nie chcemy utknąć na niebezpiecznym pustkowiu." maxlength="1000"></textarea>
            <label for="quantity-admin-form" class="label-admin-form">
                Ilość kluczy 
            </label>
            <input type="number" name="quantity-admin-form" id="quantity-admin-form" class="number-admin-form" placeholder="np. 50"  min="1" max="999">
            <label for="type-admin-form" class="label-admin-form">
                Typ gry
            </label>
            <div class="container-select-admin-form">
                <select id="type-admin-form" name="type-admin-form" class="select-admin-form">
                    <option value="" class="option-select-admin-form">1</option>
                    <option value="" class="option-select-admin-form">2</option>
                    <option value="" class="option-select-admin-form">3</option>
                </select>
            </div>
            <label for="version-admin-form" class="label-admin-form">
                Wersja gry
            </label>
            <div class="container-select-admin-form">
                <select id="version-admin-form" name="version-admin-form" class="select-admin-form">
                    <option value="" class="option-select-admin-form">1</option>
                    <option value="" class="option-select-admin-form">2</option>
                    <option value="" class="option-select-admin-form">3</option>
                </select>
            </div>
            <label for="platform-admin-form" class="label-admin-form">
                Platforma gry
            </label>
            <div class="container-select-admin-form">
                <select id="platform-admin-form" name="platform-admin-form" class="select-admin-form">
                    <option value="" class="option-select-admin-form">1</option>
                    <option value="" class="option-select-admin-form">2</option>
                    <option value="" class="option-select-admin-form">3</option>
                </select>
            </div>
            <label for="cover-admin-form" class="label-admin-form">
                Okładka gry
            </label>
            <div id="cover-admin-form" class="image-upload-wrap">
                <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*">
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
        </form>
    </main>
    <footer>
        <div id="payment-method">
        
        </div>
        <div id="help">

        </div>
        <div id="contact">
        
        </div>
        <div id="social-media">
        
        </div>
    </footer>
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script>
    function readURL(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap').hide();

      $('.file-upload-image').attr('src', e.target.result);
      $('.file-upload-content').show();

      $('.image-title').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload();
  }
}

function removeUpload() {
  $('.file-upload-input').replaceWith($('.file-upload-input').clone());
  $('.file-upload-content').hide();
  $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function () {
    $('.image-upload-wrap').addClass('image-dropping');
  });
  $('.image-upload-wrap').bind('dragleave', function () {
    $('.image-upload-wrap').removeClass('image-dropping');
});
</script>
</body>
</html>