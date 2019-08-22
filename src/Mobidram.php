<?php


namespace Studioone\Mobidram;


use Illuminate\Support\Facades\Config;

class Mobidram
{
    protected $endpoint = 'https://cabinet.mobidram.am/Operations/Payment/InvoiceGet.aspx';

    protected $merchantId;
    protected $amount;
    protected $currencyType;
    protected $orderDate;
    protected $expDate;
    protected $description;
    protected $returnUrl;
    protected $cancelUrl;
    protected $language;

    protected $requiredFields = [
        'amount',
        'currencyType',
        'orderDate',
        'expDate',
        'description',
    ];

    public static function setMerchantId(int $merchantId)
    {
        return new self($merchantId);
    }

    public function __construct(int $merchantId)
    {
        $this->merchantId = $merchantId;
    }

    public function setAmount($amount = '')
    {
        $this->amount = $amount;
        return $this;
    }

    public function setOrderDate($orderDate = '')
    {
        $this->orderDate = $orderDate;
        return $this;
    }

    public function setOrderExpDate($expDate = '')
    {
        $this->expDate = $expDate;
        return $this;
    }

    public function setLocale($language = 'hy')
    {
        $this->language = $language;
        return $this;
    }

    public function setDescription($description = '')
    {
        $this->description = $description;
        return $this;
    }

    public function setCurrencyType($currencyType = '')
    {
        $this->currencyType = $currencyType;
        return $this;
    }

    public function getFormData() {
        return [
            'Amount' => $this->amount,
            'CurrencyType' => $this->currencyType,
            'OrderDate' => $this->orderDate,
            'ExpDate' => $this->expDate,
            'Content' => $this->description,
            'MerchantID' => $this->merchantId,
            'Lang' => $this->language
        ];
    }

    public function makeForm($formMethod = 'GET', $submitText = 'Pay', $endpoint = null)
    {
        $formData = $this->getFormData();
        $url = $endpoint ?? $this->endpoint;

        $rules = [
            "Amount"         => 'required',
            "CurrencyType"   => 'required',
            "OrderDate"      => 'required|date',
            "ExpDate"        => 'required|date',
            "Content"        => 'required',
            "MerchantID"        => 'required',
            "MerchantID"     => 'required|int',
//            "ReturnURL"      => 'required',//url
//            "CancelURL"      => 'required',//url
            "Lang"           => 'required',
        ];

        $validator = \Validator::make($formData, $rules, [
            'MerchantID.required' => 'Please add MERCHANT_ID key in mobidram config file'
        ]);

        if ($validator->fails()) {
            $validationErrors = $validator->errors();
        }

        return view('mobidram::mobidram_form', [
            'formData' => $formData,
            'url' => $url,
            'formMethod' => $formMethod,
            'submitText' => $submitText,
            'errors' => $validationErrors ?? ''
        ]);
    }

    public function makeFormAsText($formMethod = 'GET', $submitText = 'Pay', $endpoint = null)
    {
        $this->validateFields();

        $formData = $this->getFormData();
        $url = $endpoint ?? $this->endpoint;

        $form = sprintf(
            '<form method="%s" action="%s" accept-charset="utf-8">',
            $formMethod,
            $url
        );
        foreach ($formData as $key => $value) {
            $form .= sprintf(
                '<input type="hidden" name="%s" value="%s" />',
                $key,
                htmlspecialchars($value)
            );
        }
        $form .= sprintf(
            '<input type="submit" value="%s"></form>',
            $submitText
        );
        $form .= '</form>';

        $form = '<html><body><h1>Mobidram</h1>' . $form . '</body></html>';

        return $form;
    }

    public function makeFormAndSubmit($formMethod = 'GET', $submitText = 'Pay', $endpoint = null)
    {
        $form = $this->makeFormAsText($formMethod, $submitText, $endpoint);
        $form .= "<script>document.getElementsByTagName('form')[0].submit();</script>";

        return $form;
    }

    protected function validateFields()
    {
        $missed = [];
        $calls = [];
        foreach ($this->requiredFields as $field) {
            if (!isset($this->$field) || empty($this->$field)) {
                $missed[] = $field;
                $calls[] = 'set' . ucfirst($field) . '(...)';
            }
        }

        if ($missed) {
            $message = count($missed) >= 2 ? 'Missed methods ' : 'Missed method ';
            throw new \InvalidArgumentException(
                $message . implode(', ', $calls)
            );
        }
    }
}
