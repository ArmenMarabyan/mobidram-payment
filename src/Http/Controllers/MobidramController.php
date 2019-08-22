<?php

namespace Studioone\Mobidram\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;

class MobidramController extends Controller
{

    protected $merchantId;

    public function index(Request $request, $orderId = 10)
    {
        $this->merchantId = Config::get('mobidram.MERCHANT_ID');

        $request['MerchantID'] = $this->merchantId;

        $rules = [
            "Amount"         => 'required',
            "CurrencyType"   => 'required',
            "OrderDate"      => 'required|date',
            "ExpDate"        => 'required|date',
            "OrderID"        => 'required',
            "Content"        => 'required',
            "MerchantID"     => 'required|int',
            "ReturnURL"      => 'required',//url
            "CancelURL"      => 'required',//url
            "Lang"           => 'required',
        ];

        $validator = \Validator::make($request->all(), $rules, [
            'MerchantID.required' => 'Please add MERCHANT_ID key in mobidram config file'
        ]);

        if ($validator->fails()) {
//            return response()->json(['success' => false, 'errors' => $validator->messages()], 422);
            $validationErrors = $validator->errors();
        }

        $parameters = $request->all();
        return view('mobidram::mobidram_form', [
            'parameters' => $parameters,
            'errors' => $validationErrors ?? ''
        ]);
    }

    public function redirect()
    {
        dd(1);
    }
}
