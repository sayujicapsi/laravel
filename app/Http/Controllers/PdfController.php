<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use PDF;
use DB;

class PdfController extends Controller
{
    //
    public function pdf($id)
    {
        $order = DB::table('orders as o')
        		 ->join('order_details as od','od.order_id','o.id')
        		 ->join('products as p','p.id','od.product_id')
        		 ->where('o.id',$id)
        		 ->whereNull('od.deleted_at')
        		 ->get();


       


        $pdf = PDF::loadView('pdf', compact('order'));
     
        return $pdf->download('invoice.pdf');
    }
}
