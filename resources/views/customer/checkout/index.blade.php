<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #1f1f1f;
            color: #111;
        }

        .checkout-page {
            width: 100%;
            max-width: 390px;
            min-height: 100vh;
            margin: 0 auto;
            background: #faf1e8;
            position: relative;
            overflow: hidden;
        }

        .header {
            height: 80px;
            display: flex;
            align-items: center;
            padding: 0 23px;
            gap: 16px;
        }

        .header h1 {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 21px;
            font-weight: 700;
        }

        .back-button {
            width: 38px;
            height: 38px;
            border: none;
            border-radius: 50%;
            background: #f0e5d7;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.2s;
            text-decoration: none;
            color: inherit;
        }

        .back-button:hover {
            background: #e7d9c9;
        }

        .back-button span {
            font-size: 24px;
            line-height: 1;
            transform: translateY(-1px);
        }

        .content {
            padding: 0 22px 115px;
        }

        .table-card {
            height: 60px;
            background: #ffffff;
            border-radius: 20px;
            padding: 0 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #666;
        }

        .table-card span {
            font-size: 17px;
        }

        .table-card strong {
            color: #111;
            font-size: 16px;
        }

        .payment-section {
            margin-top: 36px;
        }

        .section-title {
            color: #666;
            font-size: 17px;
            margin-left: 14px;
            margin-bottom: 12px;
        }

        .payment-option {
            width: 100%;
            height: 60px;
            border: 1px solid transparent;
            border-radius: 19px;
            background: #ffffff;
            display: flex;
            align-items: center;
            padding: 0 14px;
            margin-bottom: 13px;
            cursor: pointer;
            text-align: left;
            transition: 0.2s;
        }

        .payment-option.active {
            border-color: #ef6b54;
            background: #fff9f4;
        }

        .radio {
            width: 23px;
            height: 23px;
            border-radius: 50%;
            border: 2px solid #d8d8d8;
            margin-right: 11px;
            position: relative;
            flex-shrink: 0;
        }

        .payment-option.active .radio {
            border-color: #ef6b54;
        }

        .payment-option.active .radio::after {
            content: "";
            width: 13px;
            height: 13px;
            border-radius: 50%;
            background: #ef6b54;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .payment-name {
            font-size: 19px;
            font-weight: 700;
        }

        .product-card {
            min-height: 101px;
            background: #ffffff;
            border-radius: 20px;
            margin-top: 23px;
            padding: 16px 23px;
            display: flex;
            align-items: center;
        }

        .product-image {
            width: 61px;
            height: 61px;
            border-radius: 8px;
            background: #e8e0d7;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 23px;
            flex-shrink: 0;
        }

        .coffee-glass {
            width: 38px;
            height: 49px;
            position: relative;
        }

        .coffee-body {
            position: absolute;
            width: 32px;
            height: 38px;
            left: 3px;
            top: 8px;
            border-radius: 5px 5px 9px 9px;
            background: linear-gradient(to bottom, #6c4027 0%, #4c2b1b 35%, #24150f 100%);
        }

        .coffee-top {
            position: absolute;
            width: 36px;
            height: 14px;
            left: 1px;
            top: 2px;
            border-radius: 50%;
            background: radial-gradient(ellipse, #b47b4c 0%, #70452c 45%, #392216 100%);
            z-index: 2;
        }

        .ice {
            position: absolute;
            width: 10px;
            height: 8px;
            background: rgba(255,255,255,0.55);
            border-radius: 3px;
            z-index: 3;
        }

        .ice-1 {
            left: 8px;
            top: 6px;
            transform: rotate(15deg);
        }

        .ice-2 {
            right: 7px;
            top: 9px;
            transform: rotate(-15deg);
        }

        .product-info {
            flex: 1;
            min-width: 0;
        }

        .product-title {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 4px;
        }

        .product-title strong {
            font-size: 16px;
        }

        .product-title span {
            color: #777;
            font-size: 14px;
        }

        .product-price {
            color: #ff3f3f;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .product-variant {
            color: #777;
            font-size: 14px;
        }

        .total-card {
            height: 50px;
            background: #ffffff;
            border-radius: 17px;
            margin-top: 25px;
            padding: 0 17px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .total-card span {
            color: #666;
            font-size: 17px;
        }

        .total-card strong {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 19px;
        }

        .bottom-bar {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 390px;
            height: 95px;
            background: rgba(255,255,255,0.92);
            padding: 21px 23px;
            display: flex;
            align-items: center;
            box-shadow: 0 -4px 15px rgba(0,0,0,0.02);
        }

        .pay-button {
            width: 100%;
            height: 53px;
            border: none;
            border-radius: 30px;
            background: #e86b54;
            color: #572d24;
            font-size: 19px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.15s;
        }

        .pay-button:hover {
            background: #df614a;
        }

        .pay-button:active {
            transform: scale(0.98);
        }

        @media (max-width: 390px) {
            .header {
                padding-left: 22px;
                padding-right: 22px;
            }

            .content {
                padding-left: 22px;
                padding-right: 22px;
            }

            .product-card {
                padding-left: 23px;
                padding-right: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="checkout-page">
        <header class="header">
            <a href="{{ route('customer.cart.index') }}" class="back-button" aria-label="Kembali">
                <span>←</span>
            </a>
            <h1>Checkout</h1>
        </header>

        <main class="content">
            <div class="table-card">
                <span>Meja</span>
                <strong>{{ $selectedTableId ? ($tableOptions[$selectedTableId] ?? 'Meja Dipilih') : '' }}</strong>
            </div>

            <form action="{{ route('customer.checkout.store') }}" method="POST" id="checkoutForm">
                @csrf
                <input type="hidden" name="table_id" value="{{ $selectedTableId ?? old('table_id') ?? 1 }}">

                <section class="payment-section">
                    <p class="section-title">Metode Bayar</p>

                    <button type="button" class="payment-option active" data-method="qris" onclick="selectPayment(this)">
                        <span class="radio"></span>
                        <span class="payment-name">Qris</span>
                    </button>

                    <button type="button" class="payment-option" data-method="cash" onclick="selectPayment(this)">
                        <span class="radio"></span>
                        <span class="payment-name">Tunai di Kasir</span>
                    </button>

                    <button type="button" class="payment-option" data-method="transfer" onclick="selectPayment(this)">
                        <span class="radio"></span>
                        <span class="payment-name">Transfer Bank</span>
                    </button>

                    <input type="hidden" name="metode_pembayaran" id="metode_pembayaran" value="Qris">
                </section>

                @foreach($cart as $item)
                    <section class="product-card">
                        <div class="product-image">
                            @if(!empty($item['image']))
                                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" style="width:100%; height:100%; object-fit:cover; display:block;">
                            @else
                                <div class="coffee-glass">
                                    <div class="coffee-top"></div>
                                    <div class="coffee-body"></div>
                                    <div class="ice ice-1"></div>
                                    <div class="ice ice-2"></div>
                                </div>
                            @endif
                        </div>

                        <div class="product-info">
                            <div class="product-title">
                                <strong>{{ $item['name'] }}</strong>
                                <span>x{{ $item['qty'] }}</span>
                            </div>
                            <div class="product-price">Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                            @if(!empty($item['variant']))
                                <div class="product-variant">{{ $item['variant'] }}</div>
                            @endif
                        </div>
                    </section>
                @endforeach

                <div class="total-card">
                    <span>Total Bayar</span>
                    <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                </div>
            </form>
        </main>

        <div class="bottom-bar">
            <button type="submit" class="pay-button" form="checkoutForm">Bayar Sekarang</button>
        </div>
    </div>

    <script>
        function selectPayment(element) {
            const options = document.querySelectorAll('.payment-option');
            options.forEach(option => option.classList.remove('active'));
            element.classList.add('active');
            const method = element.dataset.method;
            const methodMap = {
                qris: 'Qris',
                cash: 'Tunai',
                transfer: 'Transfer Bank'
            };
            document.getElementById('metode_pembayaran').value = methodMap[method] || 'Qris';
        }
    </script>
</body>
</html>