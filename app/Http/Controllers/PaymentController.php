<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;

class PaymentController extends Controller
{
   
    /**
     * Display the Payment resource.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function paymentHistoryShow($id)
    {
        $sponsor = Sponsor::find($id);

        return view('front.payment-history')->with([
            'history' => [
                '1'=>
                [
                'Last4' => 'XXX-XXX-XXX-4444',
                'MonthYear'=> '02/22',
                'TransactionDate' => '2222',
                'Amount' => '18',
                'Status' => 'completed'
                ],
                '2'=>
                [
                'Last4' => 'XXX-XXX-XXX-4444',
                'MonthYear'=> '02/22',
                'TransactionDate' => '2222',
                'Amount' => '18',
                'Status' => 'completed'
                ]
            ],
            'id' => $id,
            'sponsor' => $sponsor,
        ]);
    }
}