<?php

namespace App\Http\Controllers\esc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use charlieuki\ReceiptPrinter\ReceiptPrinter as ReceiptPrinter;

class EscController extends Controller
{
    public function index(){

// // Set params
// $mid = '123123456';
// $store_name = 'YOURMART';
// $store_address = 'Mart Address';
// $store_phone = '1234567890';
// $store_email = 'yourmart@email.com';
// $store_website = 'yourmart.com';
// $tax_percentage = 10;
// $transaction_id = 'TX123ABC456';
// $currency = 'Rp';

// // Set items
// $items = [
//     [
//         'name' => 'French Fries (tera)',
//         'qty' => 2,
//         'price' => 65000,
//     ],
//     [
//         'name' => 'Roasted Milk Tea (large)',
//         'qty' => 1,
//         'price' => 24000,
//     ],
//     [
//         'name' => 'Honey Lime (large)',
//         'qty' => 3,
//         'price' => 10000,
//     ],
//     [
//         'name' => 'Jasmine Tea (grande)',
//         'qty' => 3,
//         'price' => 8000,
//     ],
// ];

// // Init printer
// $printer = new ReceiptPrinter;
// $printer->init(
//     // config('receiptprinter.connector_type'),
//     // config('receiptprinter.connector_descriptor')

//     // 'network',
//     // '127.0.0.1'
//     'windows',
//     'POS-80C'
// );
// ;
// $printer->setIcons();
// // Set store info
// $printer->setStore($mid, $store_name, $store_address, $store_phone, $store_email, $store_website);

// // Set currency
// $printer->setCurrency($currency);

// // Add items
// foreach ($items as $item) {
//     $printer->addItem(
//         $item['name'],
//         $item['qty'],
//         $item['price']
//     );
// }
// // Set tax
// $printer->setTax($tax_percentage);

// // Calculate total
// $printer->calculateSubTotal();
// $printer->calculateGrandTotal();

// // Set transaction ID
// $printer->setTransactionID($transaction_id);

// // Set qr code
// $printer->setQRcode([
//     'tid' => $transaction_id,
// ]);

// // Print receipt
// $printer->printReceipt();
$pathToFile = 'apk/app.apk';

return response()->download($pathToFile);
    }
}
