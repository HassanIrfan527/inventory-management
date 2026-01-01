<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
            color: #1a202c;
            line-height: 1.6;
            background: #f7fafc;
        }

        .invoice-container {
            max-width: 900px;
            margin: 20px auto;
            background: white;
            padding: 50px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 50px;
            border-bottom: 2px solid #edf2f7;
            padding-bottom: 30px;
        }

        .company-info h1 {
            font-size: 28px;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 8px;
        }

        .company-info p {
            font-size: 13px;
            color: #718096;
            margin: 4px 0;
        }

        .invoice-title {
            text-align: right;
        }

        .invoice-title h2 {
            font-size: 32px;
            font-weight: 300;
            color: #cbd5e0;
            margin-bottom: 15px;
            letter-spacing: 2px;
        }

        .invoice-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            font-size: 13px;
        }

        .detail-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .detail-label {
            color: #718096;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
        }

        .detail-value {
            color: #1a202c;
            font-size: 14px;
        }

        .content {
            margin: 50px 0;
        }

        .section-title {
            color: #1a202c;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 15px;
            color: #718096;
        }

        .billing-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 50px;
        }

        .billing-section {
            padding: 20px;
            background: #f7fafc;
            border-radius: 6px;
        }

        .billing-section h3 {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            color: #718096;
            margin-bottom: 12px;
            letter-spacing: 0.5px;
        }

        .billing-section p {
            font-size: 14px;
            color: #1a202c;
            line-height: 1.8;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
        }

        thead {
            background: #f7fafc;
            border-top: 1px solid #edf2f7;
            border-bottom: 1px solid #edf2f7;
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 12px;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 15px;
            font-size: 14px;
            color: #1a202c;
            border-bottom: 1px solid #edf2f7;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .summary {
            display: flex;
            justify-content: flex-end;
            margin-top: 40px;
        }

        .summary-box {
            width: 350px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 20px;
            font-size: 14px;
            border-bottom: 1px solid #edf2f7;
        }

        .summary-row.total {
            background: #1a202c;
            color: white;
            font-weight: 700;
            font-size: 16px;
            padding: 16px 20px;
            border: none;
        }

        .summary-row.total-label {
            font-weight: 600;
        }

        .summary-row.subtotal {
            color: #718096;
        }

        .summary-row.tax {
            color: #718096;
        }

        .footer {
            margin-top: 60px;
            padding-top: 30px;
            border-top: 1px solid #edf2f7;
            text-align: center;
            font-size: 12px;
            color: #a0aec0;
        }

        .notes {
            background: #f7fafc;
            padding: 20px;
            border-radius: 6px;
            margin: 30px 0;
        }

        .notes h4 {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            color: #718096;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }

        .notes p {
            font-size: 13px;
            color: #4a5568;
            line-height: 1.8;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            background: #c3dafe;
            color: #2c3e50;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        @media print {
            body {
                background: white;
            }

            .invoice-container {
                box-shadow: none;
                max-width: 100%;
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="header">
            <div class="company-info">
                <h1>{{ Auth::user()->companyInfo?->name }}</h1>
                <p>{{ Auth::user()->companyInfo?->address }}</p>
                {{-- <p>{{ Auth::user()->companyInfo->city }}, {{ Auth::user()->companyInfo->state }} {{ Auth::user()->companyInfo->zip }}</p> --}}
                <p>{{ Auth::user()->companyInfo?->email }}</p>
                <p>{{ Auth::user()->companyInfo?->phone }}</p>
            </div>
            <div class="invoice-title">
                <h2>INVOICE</h2>
            </div>
        </div>

        <!-- Invoice Details -->
        <div class="invoice-details">
            <div class="detail-group">
                <span class="detail-label">Invoice Number</span>
                <span class="detail-value">{{ $invoice->invoice_number }}</span>
            </div>
            <div class="detail-group">
                <span class="detail-label">Invoice Date</span>
                <span class="detail-value">{{ $invoice->created_at }}</span>
            </div>
            <div class="detail-group">
                <span class="detail-label">Due Date</span>
                <span class="detail-value">{{ $invoice->due_date }}</span>
            </div>
            <div class="detail-group">
                <span class="detail-label">Status</span>
                <span class="detail-value"><span class="badge">{{ $invoice->status }}</span></span>
            </div>
        </div>

        <!-- Billing Information -->
        <div class="content">
            <div class="billing-grid">
                <div class="billing-section">
                    <h3>Bill From</h3>
                    <p>
                        Acme Corporation<br>
                        123 Business Street<br>
                        New York, NY 10001<br>
                        USA
                    </p>
                </div>
                <div class="billing-section">
                    <h3>Bill To</h3>
                    <p>
                        John Smith<br>
                        XYZ Industries<br>
                        456 Enterprise Avenue<br>
                        Los Angeles, CA 90001<br>
                        USA
                    </p>
                </div>
            </div>

            <!-- Line Items Table -->
            <table>
                <thead>
                    <tr>
                        <th>Description</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-right">Unit Price</th>
                        <th class="text-right">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoice->order->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td class="text-center">{{ $product->pivot->quantity }}</td>
                        <td class="text-right">${{ number_format($product->retail_price, 2) }}</td>
                        <td class="text-right">${{ number_format($product->retail_price * $product->pivot->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Summary -->
            <div class="summary">
                <div class="summary-box">
                    <div class="summary-row subtotal">
                        <span>Subtotal</span>
                        <span>${{ number_format($invoice->order->total_amount - $invoice->order->delivery_charge, 2) }}</span>
                    </div>
                    <div class="summary-row tax">
                        <span>Delivery Charges</span>
                        <span>${{ number_format($invoice->order->delivery_charge, 2) }}</span>
                    </div>
                    <div class="summary-row total">
                        <span class="total-label">Subtotal</span>
                        <span>${{ number_format($invoice->order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div class="notes">
                <h4>Notes</h4>
                <p>Thank you for your business. Payment is due within 30 days of invoice date. Please make checks
                    payable to Acme Corporation. For questions regarding this invoice, please contact our accounting
                    department.</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; 2024 Acme Corporation. All rights reserved. | Tax ID: 12-3456789</p>
        </div>
    </div>
</body>

</html>
