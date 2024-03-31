<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function __construct()
    {        
        $this->api_url         =   url('').'/api';
        $this->wallet_currency_symbol   =   'MYR';
    }

    public function index()
    {
        $customer_url       =   $this->api_url.'/customers';
        $api_url            =   $this->api_url.'/';
        return view('home', array(
            'api_url'             =>      $api_url,
            'customer_url'        =>      $customer_url,
            'currency_symbol'     =>      $this->wallet_currency_symbol
        ));
    }

    public function api_data_to_table()
    {
        $response_array = request()->all();
        $customer_url       =   $this->api_url.'/customers';
        $customer_html = view('api_data_to_table')->with(array('response' => $response_array, 'currency_symbol' => $this->wallet_currency_symbol, 'customer_url' => $customer_url,))->render();
        return response()->json(array('success' => true, 'customer_html' => $customer_html));
    }

    public function customer_wallet($id)
    {
        $customer_url       =   $this->api_url.'/customers';
        $api_url            =   $this->api_url.'/';
        $customer           =   Customer::with('wallet')->find($id);
        return view('customer_wallet', array(
            'api_url'             =>      $api_url,
            'customer_url'        =>      $customer_url,
            'add_balance_url'     =>      $customer_url.'/'.$id.'/add-balance',
            'ded_balance_url'     =>      $customer_url.'/'.$id.'/deduct-balance',
            'currency_symbol'     =>      $this->wallet_currency_symbol,
            'customer_info'       =>      $customer
        ));
    }
}
