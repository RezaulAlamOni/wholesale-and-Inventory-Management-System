<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;


class OcrController extends Controller
{

    public function getOcrFormReceipt(Request $request)
    {
        $imageFile = 'http://localhost/rv3_tonyav1/public/dashboard/Recipt.png';
        $this->receiptOcr($imageFile);
    }

    public function receiptOcr(Request $request) {
        $receiptOcrEndpoint = 'https://ocr.asprise.com/api/v1/receipt'; //
//        $receiptOcrEndpoint = 'https://ocr2.asprise.com/api/v1/receipt'; //
        $imageFile = 'http://localhost/rv3_tonyav1/public/dashboard/Recipt.png';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $receiptOcrEndpoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            'client_id' => 'TEST',      // Use 'TEST' for testing purpose
//            'client_id' => '1njX19hXIDmlYWK6bHaGDKcSWVBN2kl4YmF5iafu8qiCleWuv8CAMb3oehtcv2Wi',      // Use 'TEST' for testing purpose
            'recognizer' => 'auto',     // can be 'US', 'CA', 'JP', 'SG' or 'auto'
            'ref_no' => 'ocr_php_123',  // optional caller provided ref code
            'file' => curl_file_create($imageFile) // the image file
        ));

        $result = curl_exec($ch);
        if(curl_errno($ch)){
            throw new Exception(curl_error($ch));
        }

        return $result; // result in JSON
    }
}
