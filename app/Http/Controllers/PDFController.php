<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Http\Controllers\Controller;

class PDFController extends Controller
{
    public function getPDF(){
        $pdf=PDF::loadView('pdf.customer');
        return $pdf->stream('customer.pdf');
    }
}
