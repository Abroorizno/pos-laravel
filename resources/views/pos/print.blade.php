<style>
    body{
        width: 70mm;
        margin: 0 auto;
        font-family: 'calibri', sans-serif;
        font-size: 12px;
        color: #000;
    }

    header{
        text-align: center;
        /* margin-bottom: 10px; */
    }

    h2{
        text-align: center;
        padding-top: 0;
    }

    img{
        width: 100px;
        height: auto;
        display: block;
        margin: 50px auto 0;
    }

    p{
        margin-top: 0px;
        margin-bottom: 5px; /* Adjusted to create a gap between paragraphs */
    }

    .divider{
        border-top: 1px solid #000;
        margin: 5px 0;
    }

    .item-row{
        display: flex;
        justify-content: space-between;
        margin: 5px 0;
    }

    .item-row .left{
        flex: 1;
    }

    .item-row .right{
        flex: 0 0 auto;
        text-align: right;
        font-weight: bold;

    }

    .footer{
        text-align: center;
        margin-top: 10px;
    }

    .text-center{
        text-align: center;
    }

    .liner{
        /* border-top: 1px solid #000; */
        margin: 5px 0;
    }

    .left-price{
        font-weight: bold;
    }

    .left-total {
        font-weight: bold;
    }

    @media print {
        body {
            margin: 0;
        }
    }
</style>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body onload="window.print()">
        <div class="wrapper">
            <div class="header">
                <img src="{{ asset('assets/img/logostruck/a.png') }}" alt="Logo" style="width: 100px; height: auto;">
                <h2>Receipt Transaction</h2>
                <div class="divider"></div>
                <p>Jl. Raya Riyi, Blok Haha, No. 1, Kec. Kemana Aja, Wakanda Pusat.</p>
                <p>No. Telp : 081234567890</p>
            </div>
            <div class="divider"></div>
            <div>
                <div class="liner">Transaction Dates : {{ $orders->created_at }}</div>
                <div class="liner"></div>Transaction Number : {{ $orders->order_code }}</div>
            </div>
            <div class="divider"></div>
                @foreach ($orders->orderDetails as $orderDetail)
                    <div class="item-row">
                        <div class="left">{{ $orderDetail->product->product_name }}</div>
                        <div class="right">{{ 'Rp. ' . number_format($orderDetail->order_subtotal, 0, ',', '.') }}</div>
                    </div>
                    <div class="item-row">
                        <div class="left-price">{{ $orderDetail->qty .' x Rp. '. number_format($orderDetail->order_price, 0, ',', '.') }}</div>
                    </div>
                @endforeach
                <div class="divider"></div>
            <div class="item-row">
                <div class="left-total">TOTAL</div>
                <div class="right">Rp. {{ number_format($orders->order_mount, 0, ',', '.') }}</div>
            </div>
            <div class="divider"></div>
            <div class="footer">
                <h3>Thank you for shopping with us!</h3>
                <p>We hope to see you again soon.</p>
            </div>
        </div>
    </body>
</html>
