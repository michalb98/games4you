<?php

    class Image {
        
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

            $file = fopen($destination, "w");

            //remove temp_cover file 
            unlink($source);

            return imagewebp($image, $file, $quality);
            
        }
    }

?>