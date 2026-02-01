<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    <style>
        @font-face {
            font-family: 'Montserrat';
            src: url('{{ public_path('fonts/Montserrat-Regular.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'Montserrat';
            src: url('{{ public_path('fonts/Montserrat-Bold.ttf') }}') format('truetype');
            font-weight: bold;
            font-style: normal;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @page {
            margin: 0;
            size: A4;
        }

        html, body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11px;
            color: #3f3f46;
            line-height: 1.5;
            background-color: #ffffff;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        /* Header Bar */
        .header-bar {
            background-color: #059669;
            padding: 35px 45px;
        }
        .invoice-label {
            font-size: 32px;
            font-weight: bold;
            color: #ffffff;
            letter-spacing: -1px;
        }
        .logo-text {
            font-size: 20px;
            font-weight: bold;
            color: #ffffff;
            text-align: right;
        }
        .logo-tagline {
            font-size: 9px;
            color: #d1fae5;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-align: right;
            margin-top: 4px;
        }

        /* Billing Section */
        .billing-section {
            padding: 40px 45px;
        }
        .section-title {
            font-size: 10px;
            font-weight: bold;
            color: #059669;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }
        .customer-name {
            font-size: 18px;
            font-weight: bold;
            color: #18181b;
            margin-bottom: 6px;
        }
        .customer-address {
            font-size: 11px;
            color: #71717a;
            line-height: 1.6;
        }
        .meta-label {
            font-size: 10px;
            font-weight: bold;
            color: #71717a;
            text-transform: uppercase;
        }
        .meta-value {
            font-size: 12px;
            font-weight: bold;
            color: #18181b;
            margin-left: 10px;
        }
        .meta-row {
            margin-bottom: 8px;
            text-align: right;
        }

        /* Table */
        .items-section {
            padding: 0 45px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
        }
        .items-table th {
            padding: 12px 15px;
            text-align: left;
            font-weight: bold;
            color: #065f46;
            font-size: 10px;
            text-transform: uppercase;
            background-color: #ecfdf5;
            border-bottom: 2px solid #10b981;
        }
        .items-table td {
            padding: 15px;
            font-size: 11px;
            border-bottom: 1px solid #f4f4f5;
        }
        .items-table tr:nth-child(even) {
            background-color: #fafafa;
        }

        /* Totals */
        .totals-section {
            padding: 30px 45px;
        }
        .totals-table {
            float: right;
            width: 250px;
        }
        .totals-table td {
            padding: 8px 0;
        }
        .totals-label {
            text-align: left;
            color: #71717a;
            font-weight: bold;
        }
        .totals-value {
            text-align: right;
            color: #18181b;
            font-weight: bold;
        }
        .grand-total {
            border-top: 2px solid #059669;
            margin-top: 10px;
        }
        .grand-total .totals-label {
            color: #059669;
            font-size: 14px;
            padding-top: 15px;
        }
        .grand-total .totals-value {
            color: #059669;
            font-size: 20px;
            padding-top: 15px;
        }

        /* Footer */
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 40px 45px;
            background-color: #fafafa;
            border-top: 1px solid #f4f4f5;
        }
        .footer-text {
            font-size: 10px;
            color: #71717a;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header-bar">
        <table style="width: 100%;">
            <tr>
                <td>
                    <div class="invoice-label">INVOICE</div>
                </td>
                <td>
                    <div class="logo-text">{{ config('app.name') }}</div>
                    <div class="logo-tagline italic">Inventory Management System</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="billing-section">
        <table style="width: 100%;">
            <tr>
                <td style="width: 60%; vertical-align: top;">
                    <div class="section-title">Invoice To</div>
                    <div class="customer-name">{{ $invoice->billing_name ?? 'N/A' }}</div>
                    <div class="customer-address">
                        {{ $invoice->billing_address ?? 'No address provided' }}<br>
                        {{ $invoice->billing_phone ?? '' }}<br>
                        {{ $invoice->billing_email ?? '' }}
                    </div>
                </td>
                <td style="width: 40%; vertical-align: top;">
                    <div class="meta-row">
                        <span class="meta-label">Invoice Number</span>
                        <span class="meta-value">{{ $invoice->invoice_number }}</span>
                    </div>
                    @if($invoice->po_number)
                    <div class="meta-row">
                        <span class="meta-label">PO Number</span>
                        <span class="meta-value">{{ $invoice->po_number }}</span>
                    </div>
                    @endif
                    <div class="meta-row">
                        <span class="meta-label">Date Issued</span>
                        <span class="meta-value">{{ ($invoice->issued_at ?? $invoice->created_at)->format('M d, Y') }}</span>
                    </div>
                    <div class="meta-row">
                        <span class="meta-label">Due Date</span>
                        <span class="meta-value">{{ $invoice->due_date ? $invoice->due_date->format('M d, Y') : 'Immediate' }}</span>
                    </div>
                    <div class="meta-row">
                        <span class="meta-label">Currency</span>
                        <span class="meta-value">{{ $invoice->currency }}</span>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="items-section">
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 50%;">Description</th>
                    <th style="text-align: center; width: 10%;">Qty</th>
                    <th style="text-align: right; width: 20%;">Price</th>
                    <th style="text-align: right; width: 20%;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->order->products as $product)
                <tr>
                    <td>
                        <div style="font-weight: bold; color: #18181b;">{{ $product->name }}</div>
                        <div style="font-size: 9px; color: #71717a; margin-top: 2px;">SKU: {{ $product->sku }}</div>
                    </td>
                    <td style="text-align: center;">{{ $product->pivot->quantity }}</td>
                    <td style="text-align: right;">Rs. {{ number_format($product->pivot->sale_price, 2) }}</td>
                    <td style="text-align: right; font-weight: bold; color: #18181b;">Rs. {{ number_format($product->pivot->quantity * $product->pivot->sale_price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="totals-section">
        <table class="totals-table">
            <tr>
                <td class="totals-label">Subtotal</td>
                <td class="totals-value">Rs. {{ number_format($invoice->subtotal_amount, 2) }}</td>
            </tr>
            @if($invoice->tax_amount > 0)
            <tr>
                <td class="totals-label">Tax</td>
                <td class="totals-value">Rs. {{ number_format($invoice->tax_amount, 2) }}</td>
            </tr>
            @endif
            @if($invoice->discount_amount > 0)
            <tr>
                <td class="totals-label">Discount</td>
                <td class="totals-value" style="color: #059669;">- Rs. {{ number_format($invoice->discount_amount, 2) }}</td>
            </tr>
            @endif
            @if($invoice->delivery_charge > 0)
            <tr>
                <td class="totals-label">Delivery</td>
                <td class="totals-value">Rs. {{ number_format($invoice->delivery_charge, 2) }}</td>
            </tr>
            @endif
            <tr class="grand-total">
                <td class="totals-label">Total Amount</td>
                <td class="totals-value">{{ $invoice->currency }} {{ number_format($invoice->total_amount, 2) }}</td>
            </tr>
        </table>
        <div style="clear: both;"></div>
    </div>

    <div class="footer">
        <div class="footer-text">
            <p style="font-weight: bold; margin-bottom: 5px;">Thank you for your business!</p>
            <p>Please contact us at support@example.com for any questions regarding this invoice.</p>
        </div>
    </div>
</body>
</html>
