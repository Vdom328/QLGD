<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalyzeController extends Controller
{
    public function sales_index()
    {
        return view('pages.analyze.sale.index');
    }

    public function order_index()
    {
        return view('pages.analyze.order.index');
    }

    public function gross_profit_total_index()
    {
        return view('pages.analyze.gross-profit-total.index');
    }

    public function gross_profit_margin_index()
    {
        return view('pages.analyze.gross-profit-margin.index');
    }
}
