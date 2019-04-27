<?php
namespace App\Utility;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\ErrorCorrectionLevel;

class QrCodeIndireccion{
    public function __construct(){
        
    }
    public function generateQrCode(string $data){
        $qrCode = new QrCode();
        $qrCode->setSize(100);
        $qrCode->setMargin(-8);
        //si queremos hacerlo mas piola estan esos metodos para ponerle un logo
        //$qrCode->setLogoPath('webroot/img/logo.png');
        //$qrCode->setLogoSize(50);
        $qrCode->setErrorCorrectionLevel(new ErrorCorrectionLevel(ErrorCorrectionLevel::HIGH));
        $qrCode->setText($data);
        $qrCode->writeString(PngWriter::class);
        return $qrCode;
    }
}
