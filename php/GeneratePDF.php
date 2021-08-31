<?php

use Mpdf\Mpdf;

require('C:\xampp\htdocs\sklep\vendor\autoload.php');
    
    class GeneratePDF extends Database {
        protected $name, $surname;
        protected $postalCode, $city, $street, $streetNumber, $houseNumber;
        protected $email;
        protected $title, $priceNetto, $priceBrutto, $quantity;
        protected $data;
        protected $orderNumber;
        protected $orderValue, $discountValue;
        
        function setDataToInvoice($login, $orderNumber) {
            $db = new Database();
            $pdo = $db->createPDO();
            $data = $db->getDataToInvoice($pdo, $login, $orderNumber);

            $this->name = $data[0][0];
            $this->surname = $data[0][1];
            $this->postalCode = $data[0][2];
            $this->city = $data[0][3];
            $this->street = $data[0][4];
            $this->streetNumber = $data[0][5];
            $this->houseNumber = $data[0][6];
            $this->email = $data[0][7];
            $this->title = $data[0][8];
            $this->priceNetto = $data[0][9];
            $this->priceBrutto = $data[0][10];
            $this->quantity = $data[0][11];
            $this->data = $data[0][12];
            $this->orderNumber = $data[0][13];
            $this->orderValue = $data[0][14];
            $this->discountValue = $data[0][15];

        }

        function generateInvoice() {
            $mpdf = new Mpdf();

            $data = '';

            $data .= '<h1>Faktura numer: '.$this->orderNumber.'</h1><br>';
            $data .= '<strong>Imię: </strong>'.$this->name;

            $mpdf->WriteHTML($data);
            $fileName = 'Faktura nr. '.$this->orderNumber.'.pdf';
            $mpdf->Output($fileName, 'D');
        }
    }

?>