<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">

    <title>Mobidram</title>
</head>
<body>
<div class="mobidram">

    <div class="mobidram__logo">
        <img src="https://mobidram.mts.am/images/default-source/default-album/logo.png?sfvrsn=4" alt="">
    </div>
    <form action="{{$url}}" class="mobidram__form" method="{{$formMethod}}" name="pay_form">
        @csrf
        <ul>
            @if(!empty($errors))
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            @endif
        </ul>
        @foreach($formData as $name => $value)
            <div class="mobidram__form-label">
                <label for="{{$name}}">{{$name}}</label>
            </div>
            <input type="text" id="{{$name}}" name="{{$name}}" value="{{$value}}" readonly />
        @endforeach
        {{--        <input type="text" name="Amount" placeholder="'.$total_price.'" />--}}
        {{--        <input type="text" name="CurrencyType" placeholder="1" />--}}
        {{--        <input type="text" name="OrderDate" placeholder="'.$OrderDate.'" />--}}
        {{--        <input type="text" name="ExpDate" placeholder="'.$ExpDate.'" />--}}
        {{--        <input type="text" name="OrderID" placeholder="'.$orderID.'" />--}}
        {{--        <input type="text" name="Content" placeholder="'. $products_description .'" />--}}
        {{--        <input type="text" name="MerchantID" placeholder="'.self::$MerchantID.'" />--}}
        {{--        <input type="text" name="ReturnURL" placeholder="'.$ReturnURL.'" />--}}
        {{--        <input type="text" name="CancelURL" placeholder="'.$CancelURL.'" />--}}
        {{--        <input type="text" name="Lang" placeholder="'. $lang_code .'" />--}}
        <div class="mobidram__form-btn">
            <input type="submit" style="" value="{{$submitText}}" />
        </div>
    </form>
</div>

<style>

    body {
        width: 100%;
        height: 100%;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
    }

    .mobidram {
        /*padding: 0px 10px 10px 10px;*/
        margin-top: 50px;
        width: 500px;
        margin: 0 auto;
        background-color: #fff;
        /*border: 1px solid #eee;*/
        border-radius: 5px;
        -webkit-box-shadow: 0px 0px 12px -2px rgba(0,0,0,0.8);
        -moz-box-shadow: 0px 0px 12px -2px rgba(0,0,0,0.8);
        box-shadow: 0px 0px 12px -2px rgba(0,0,0,0.8);
        overflow: hidden;
    }

    .mobidram__logo {
        position: relative;
        width: 100%;
        height: 150px;
        background: rgb(225,15,33);
        background: linear-gradient(90deg, rgba(225,15,33,1) 0%, rgba(23,120,183,1) 100%);
    }

    .mobidram__logo img {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 143px;
        margin: 0 auto;
    }

    .mobidram__form {
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
    }

    .mobidram__form input[type='text'] {
        width: 100%;
        box-sizing: border-box;
        margin-bottom: 15px;
        padding: 10px;
        outline: none;
        border: none;
        border: 1px solid #ddd;
        background-color: #eee;
        border-radius: 5px;
        background: rgb(238,238,238);
        background: linear-gradient(90deg, rgba(238,238,238,1) 0%, rgba(255,255,255,1) 100%);
    }

    .mobidram__form-label {
        margin-bottom: 5px;
    }

    .mobidram__form-btn {
        margin-top: 10px;
    }

    .mobidram__form-btn input {
        border: none;
        width: 100%;
        cursor: pointer;
        padding: 10px 0;
        color: #fff;
        border-radius: 5px;
        font-size: 15px;
        font-weight: 700;
        background: rgb(225,15,33);
        background: linear-gradient(90deg, rgba(225,15,33,1) 0%, rgba(23,120,183,1) 100%);

    }

    .mobidram__form-btn input:hover {
        -webkit-transition: 0.2s ease;
        -moz-transition: 0.2s ease;
        -ms-transition: 0.2s ease;
        -o-transition: 0.2s ease;
        transition: 0.2s ease;
        -webkit-box-shadow: 0px 0px 12px -2px rgba(0,0,0,0.8);
        -moz-box-shadow: 0px 0px 12px -2px rgba(0,0,0,0.8);
        box-shadow: 0px 0px 12px -2px rgba(0,0,0,0.8);
    }

</style>

<script>
    // document.getElementsByTagName('form')[0].submit();
</script>
</body>
</html>
