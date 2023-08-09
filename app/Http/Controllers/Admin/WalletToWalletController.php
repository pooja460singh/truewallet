<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class WalletToWalletController extends Controller
{
    public function index(){


       $wallet_to_wallet=DB::table('tbl_wallettowallet')->where('status',1)->get();
    	return view('admin.wallet.view_wallettowallet',compact('wallet_to_wallet'));
    }
}
