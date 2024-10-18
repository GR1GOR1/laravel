<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Bitrix24\BX24;

class Account extends Controller
{
    public function index(Request $request) {
        return view('account.index');
    }
}
