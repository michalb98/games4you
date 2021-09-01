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
        protected $paymentMethod;
        protected $totalOrderBruttoValue, $totalOrderNettoValue, $totalVatValue;
        protected $i = 1;
        
        function validateDataToInvoice($login) {
            $db = new Database();
            $pdo = $db->createPDO();

            $additionalData = $db->getUserAdditionalData($pdo, $login);

            try{
                !($additionalData[0][0] == "" || strlen($additionalData[0][0]) < 1) ? true : throw new Exception(false);
                !($additionalData[0][1] == "" || strlen($additionalData[0][1]) < 1) ? true : throw new Exception(false);
                !($additionalData[0][2] == "" || strlen($additionalData[0][2]) < 1) ? true : throw new Exception(false);
                !($additionalData[0][3] == "" || strlen($additionalData[0][3]) < 1) ? true : throw new Exception(false);
                !($additionalData[0][4] == "" || strlen($additionalData[0][4]) < 1) ? true : throw new Exception(false);
                !($additionalData[0][5] == "" || strlen($additionalData[0][5]) < 1) ? true : throw new Exception(false);
                !($additionalData[0][6] == "" || strlen($additionalData[0][6]) < 1) ? true : throw new Exception(false);
                !($additionalData[0][8] == "" || strlen($additionalData[0][8]) < 1) ? true : throw new Exception(false);
                return true;
            } catch (Exception) {
                return false;
            }
        }

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
            $this->data = $data[0][12];
            $this->paymentMethod = $data[0][16];
            $this->orderNumber = $data[0][13];

            for($i = 0; $i < sizeof($data); $i++) {
                $this->title[$i] = $data[$i][8];
                $this->priceNetto[$i] = $data[$i][9];
                $this->priceBrutto[$i] = $data[$i][10];
                $this->quantity[$i] = $data[$i][11];
                $this->orderValue[$i] = $data[$i][14];
                $this->discountValue[$i] = $data[$i][15];
            }

        }

        function generateInvoice() {
            $mpdf = new Mpdf();

            $data = '';
            $data .= '<div style="width: 100%; height: auto; display: flex; justify-content: center; align-items: center; background-color: gray;">
            <h1 style="width: 100%; text-align:center; padding: 10px 5px">Faktura numer: '.$this->orderNumber.'</h1>
        </div>
        <div style="width: 100%; height: auto; text-align: right;">
            <strong>Wystawiono dnia: '.$this->data.'</strong>
        </div>
        <div style="width: 100%; height: auto; display: flex; justify-content: space-evenly; align-items: center;">
            <div style="width: 35%; float: left; margin-left: 10%;">
                <h2 style="border-bottom: 2px solid black;">
                    Sprzedawca
                </h2>
                <h4 style="font-weight: normal;">Michał Błaszczyk</h4>
                <h4 style="font-weight: normal;">99-300 Kutno</h4>
                <h4 style="font-weight: normal;">ul. Łokietka 6/60</h4>
            </div>
            <div style="width: 35%; float: left; margin-left: 10%;">
                <h2 style="border-bottom: 2px solid black;">
                    Nabywca
                </h2>
                <h4 style="font-weight: normal;">'.$this->name.' '.$this->surname.'</h4>
                <h4 style="font-weight: normal;">'.$this->postalCode.' '.$this->city.'</h4>
                <h4 style="font-weight: normal;">ul. '.$this->street.' '.$this->streetNumber;
                if($this->houseNumber != "") {
                    $data .= '/'.$this->houseNumber;
                }
                
                $data .= '</h4>
            </div>
        </div>
        <div style="width: 100%; height: auto; text-align: left;">
            <strong>Metoda płatności: </strong>'.$this->paymentMethod.'
        </div>
        <br>
        <table style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr style="background-color: lightgray;">
                <td style=" border: 2px solid black;">Lp.</td>
                <td style=" border: 2px solid black;">Tytuł gry</td>
                <td style=" border: 2px solid black;">Ilość kluczy</td>
                <td style=" border: 2px solid black;">Cena brutto</td>
                <td style=" border: 2px solid black;">Cena netto</td>
                <td style=" border: 2px solid black;">VAT</td>
                <td style=" border: 2px solid black;">Wartość VAT</td>
            </tr>
        </thead>
        <tbody>';
            for($i = 0; $i < sizeof($this->title); $i++) {
                 $data .= '<tr>
                 <td style=" border: 2px solid black;">'.$i + $this->i.'</td>
                 <td style=" border: 2px solid black;">'.$this->title[$i].'</td>
                 <td style=" border: 2px solid black;">'.$this->quantity[$i].'</td>
                 <td style=" border: 2px solid black;">'.$this->quantity[$i] * $this->priceBrutto[$i].' zł</td>
                 <td style=" border: 2px solid black;">'.$this->quantity[$i] * $this->priceNetto[$i].' zł</td>
                 <td style=" border: 2px solid black;">23%</td>
                 <td style=" border: 2px solid black;">'.($this->quantity[$i] * $this->priceBrutto[$i]) - ($this->quantity[$i] * $this->priceNetto[$i]).' zł</td>
             </tr>';
             $this->totalOrderBruttoValue += $this->quantity[$i] * $this->priceBrutto[$i];
             $this->totalOrderNettoValue += $this->quantity[$i] * $this->priceNetto[$i];
             $this->totalVatValue += ($this->quantity[$i] * $this->priceBrutto[$i]) - ($this->quantity[$i] * $this->priceNetto[$i]);
            }
            $data .='<tr>
                <td></td>
                <td></td>
                <td>Razem: </td>
                <td style=" border: 2px solid black;">'.$this->totalOrderBruttoValue.' zł</td>
                <td style=" border: 2px solid black;">'.$this->totalOrderNettoValue.' zł</td>
                <td ></td>
                <td style=" border: 2px solid black;">'.$this->totalVatValue.' zł</td>
            </tr>
        </tbody>
    </table>';

            $mpdf->WriteHTML($data);
            $fileName = 'Faktura nr. '.$this->orderNumber.'.pdf';
            $mpdf->Output($fileName, 'D');
        }
    }

?>