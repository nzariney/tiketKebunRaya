<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>E-Ticket {{ $transaction->invoice_code }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .ticket-box {
            border: 2px dashed #4ade80; /* green-400 */
            padding: 30px;
            max-width: 600px;
            margin: 0 auto;
            position: relative;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #166534; /* green-800 */
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #166534;
            margin: 0;
            font-size: 28px;
        }
        .header p {
            margin: 5px 0 0 0;
            color: #666;
        }
        .details {
            margin-bottom: 30px;
        }
        .details table {
            width: 100%;
        }
        .details th {
            text-align: left;
            padding-bottom: 10px;
            color: #666;
            width: 40%;
        }
        .details td {
            font-weight: bold;
            font-size: 16px;
            padding-bottom: 10px;
        }
        .qr-section {
            text-align: center;
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }
        .qr-section img {
            margin-bottom: 10px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>

    <div class="ticket-box">
        <div class="header">
            <h1>E-TICKET KEBUN RAYA</h1>
            <p>Invoice: {{ $transaction->invoice_code }}</p>
        </div>

        <div class="details">
            <table>
                <tr>
                    <th>Nama Pemesan</th>
                    <td>{{ $transaction->user->name }}</td>
                </tr>
                <tr>
                    <th>Tanggal Kunjungan</th>
                    <td>{{ $transaction->visit_date }}</td>
                </tr>
                <tr>
                    <th>Tiket Dewasa</th>
                    <td>{{ $transaction->adult_quantity }}x</td>
                </tr>
                <tr>
                    <th>Tiket Anak</th>
                    <td>{{ $transaction->child_quantity }}x</td>
                </tr>
                <tr>
                    <th>Status Pembayaran</th>
                    <td style="color: #166534;">LUNAS</td>
                </tr>
            </table>
        </div>

        <div class="qr-section">
            <p>Tunjukkan QR Code ini pada petugas di gerbang masuk.</p>
            <img src="data:image/svg+xml;base64,{{ $qrcode }}" alt="QR Code">
        </div>
    </div>

    <div class="footer">
        <p>Tiket ini sah dan diterbitkan oleh Sistem Tiketing Kebun Raya.</p>
        <p>Harap tidak membagikan tiket ini kepada orang lain.</p>
    </div>

</body>
</html>
