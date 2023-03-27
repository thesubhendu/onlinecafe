<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <title>mycoffees</title> <!-- The title tag shows in email notifications, like Android 4.4. -->
    <style type="text/css">
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            font-family: "Raleway", sans-serif;
            font-size: 15px;
            font-weight: 500;
        }

        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        table {
            border-spacing: 0;
            border-collapse: collapse;
            table-layout: fixed;
            Margin: 0 auto !;
        }

        table table table {
            table-layout: auto;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        .mobile-link--footer a,
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: underline !important;
        }

        .text-default {
            color: #e28936;
        }

        .logo-bar {
            background: #e28936;
            padding: 2rem 1rem;
        }

        .logo-bar h2 {
            display: block;
            color: #fff;
            margin: 0;
            line-height: 0;
            font-size: 25px;
        }

        .logo-bar h2 span {
            font-size: 20px;
            font-weight: lighter;
        }

        h1 {
            font-weight: 900;
            font-size: 26px;
            margin-bottom: 0 !important;
            margin-top: 2rem;
        }

        .username {
            font-size: 20px;
            margin: 0;
        }

        .order-table {
            border: 1px solid #eee;
            padding: 12px;
            margin-bottom: 1rem;
        }

        .order-table h5 {
            font-size: 1.125rem;
            margin: 0 0 12px;
        }

        .order-table li {
            list-style: none;
            margin-bottom: 8px;
            color: #555;
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
        }
        .item-row.order-header {
            border-bottom: 2px solid #eee;
            padding: 10px 0;
        }
        .item-heading {
            font-weight: 600;
        }

        .thank-you {
            margin: 3rem 0;
            padding: 0 1rem;
        }

        .thank-you h4 {
            margin: 0;
            font-size: 20px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">
</head>

<body width="100%" style="Margin: 0; background: #fafbff">
    <center style="width: 100%;">
        <div style="max-width: 600px; margin: auto; padding : 1rem">
            <div style="max-width: 600px; margin: auto; -webkit-box-shadow: -1px 1px 5px 2px rgb(238 238 239); -moz-box-shadow: -1px 1px 5px 2px rgb(238 238 239); box-shadow: -1px 1px 5px 2px rgb(238 238 239); border-radius: 10px; border: 10px solid white; background: #FFF">
                <table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#ffffff" width="100%" style="max-width: 600px; ">
                    <tr>
                        <td class="logo-bar">
                            <h2>mycoffees<span>.com.au</span></h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h1>Order Confirmed!</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4 class="username">Hi {{$order->user->name}}</h4>
                            <p>Thank you for your order! It has been processed </p>
                            <div class="order-table">
                                <h5>Ordered Item</h5>
                                <div class="item-row order-header">
                                    <div class="item-heading">Name</div>
                                    <div class="item-heading">Qty</div>
                                    <div class="item-heading">Price</div>
                                    <div class="item-heading">Additions</div>
                                </div>

                                @foreach($order->products as $product)
                                    <div class="item-row">
                                        <div> {{$product->name}}</div>
                                        <div>{{ $product->pivot->quantity}}</div>
                                        <div>$ {{$product->pivot->price}}</div>
                                        <div>
                                            @include('components.product-options')
                                        </div>
                                    </div>

                                @endforeach


                                <div class="item-row">
                                    <div class="item-heading">Total</div>
                                    <div class="item-heading"></div>
                                    <div class="item-heading">$ {{$order->order_total}}</div>
                                </div>
                            </div>
                            <div class="order-table">
                                <h4>Transactions:</h4>
                                <li>Store Name: <span class="text-default">{{$order->vendor->shop_name}}</span></li>
                                <li>Order Time & Date: <span
                                        class="text-default">{{$order->created_at->format("F j, Y, g:i a")}}</span></li>
                                <li>Order Type: <span class="text-default">Pickup</span></li>
                                {{--                                <li>Payment: <span class="text-default">Credit Card</span></li>--}}
                            </div>
                            <div class="order-table">
                                <h4>Your Information:</h4>
                                <li>Name: {{$order->user->name}}</li>
                                <li>Phone Number: {{$order->user->phone}} </li>
                                <li>Email : <a href="mailto:{{$order->user->email}}">{{$order->user->email}}</a></li>
                            </div>
                            <div class="order-table">
                                <h4>Store Information:</h4>
                                <li>Store: {{$order->vendor->name}}</li>
                                <li>Phone Number: {{$order->vendor->phone}} </li>
                                <li>Address : {{$order->vendor->address}}</li>
                            </div>
                            <div class="thank-you">
                                <h4>Thank You!</h4>
                                <p>Let us know your feedback</p>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </center>

</body>

</html>
