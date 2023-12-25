<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepositWithdrawalController extends Controller
{
    public function index()
    {
        return view('pages.deposit-withdrawal.list');
    }
}
