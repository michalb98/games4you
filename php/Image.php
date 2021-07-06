<?php

    class Image {
        
        //Funkcja ma za zadanie przekonwertowanie zdjęcia z jpg, jpeg, png lub gif na webp
        function convertImageToWebp($source, $destination, $quality) {

            $extension = pathinfo($source, PATHINFO_EXTENSION);

            switch($extension) {
                case 'jpeg':
                    $image = imagecreatefromjpeg($source);
                break;
                case 'jpg':
                    $image = imagecreatefromjpeg($source);
                break;
                case 'png':
                    $image = imagecreatefrompng($source);
                break;
                case 'gif':
                    $image = imagecreatefromgif($source);
                break;
                //default
                    //error
            }

            //tworzy plik docelowy
            $file = fopen($destination, "w");

            //usuwa plik temp_cover 
            unlink($source);

            return imagewebp($image, $file, $quality);
            
        }
    }

?>