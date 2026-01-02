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
        @font-face {
            font-family: 'NotoNaskhArabic';
            src: url('{{ public_path('fonts/NotoNaskhArabic-Regular.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'NotoNaskhArabic';
            src: url('{{ public_path('fonts/NotoNaskhArabic-Bold.ttf') }}') format('truetype');
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
        }

        body {
            font-family: 'Montserrat', 'NotoNaskhArabic', sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.4;
            width: 100%;
            height: 100%;
        }

        .invoice-wrapper {
            width: 100%;
            min-height: 100%;
        }

        .w-100 { width: 100%; }
        .w-50 { width: 50%; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }

        /* Header */
        .header {
            background-color: #2d3748;
            padding: 25px 35px;
        }
        .brand-name {
            font-family: 'Montserrat', sans-serif;
            font-size: 22px;
            font-weight: bold;
            color: #ffffff;
        }
        .tagline {
            font-family: 'Montserrat', sans-serif;
            font-size: 9px;
            color: #a0aec0;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 2px;
        }
        .invoice-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 32px;
            font-weight: bold;
            color: #e8384f;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Accent Line */
        .accent-line {
            height: 4px;
            background-color: #e8384f;
        }

        /* Billing Section */
        .billing-section {
            background-color: #2d3748;
            padding: 20px 35px 25px 35px;
        }
        .invoice-to-label {
            font-family: 'Montserrat', sans-serif;
            font-size: 10px;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 5px;
        }
        .customer-name {
            font-family: 'Montserrat', 'NotoNaskhArabic', sans-serif;
            font-size: 14px;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 3px;
        }
        .customer-details {
            font-family: 'Montserrat', 'NotoNaskhArabic', sans-serif;
            font-size: 10px;
            color: #cbd5e0;
            line-height: 1.5;
        }
        .invoice-meta td {
            font-family: 'Montserrat', sans-serif;
            font-size: 11px;
            padding: 3px 0;
        }
        .invoice-meta .label {
            font-weight: bold;
            color: #ffffff;
            padding-right: 15px;
        }
        .invoice-meta .value {
            color: #cbd5e0;
        }

        /* Items Table */
        .items-section {
            padding: 20px 35px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
        }
        .items-table th {
            font-family: 'Montserrat', sans-serif;
            background-color: #f7fafc;
            padding: 10px 8px;
            text-align: left;
            font-weight: bold;
            color: #2d3748;
            font-size: 10px;
            border-bottom: 2px solid #e2e8f0;
            text-transform: uppercase;
        }
        .items-table th.text-right {
            text-align: right;
        }
        .items-table td {
            font-family: 'Montserrat', 'NotoNaskhArabic', sans-serif;
            padding: 10px 8px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 11px;
            color: #4a5568;
        }
        .items-table td.text-right {
            text-align: right;
        }
        .items-table .sl-col {
            width: 35px;
            text-align: center;
        }
        .items-table th.sl-col {
            text-align: center;
        }

        /* Footer Section */
        .footer-section {
            padding: 15px 35px 20px 35px;
            background-color: #f8fafc;
        }
        .thank-you {
            font-family: 'Montserrat', sans-serif;
            font-size: 12px;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 10px;
        }
        .payment-label {
            font-family: 'Montserrat', sans-serif;
            font-size: 11px;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 6px;
        }
        .payment-details {
            font-family: 'Montserrat', 'NotoNaskhArabic', sans-serif;
            font-size: 9px;
            color: #4a5568;
            line-height: 1.7;
        }
        .payment-details .label {
            display: inline-block;
            width: 65px;
            color: #718096;
            font-weight: bold;
        }

        /* Totals */
        .totals-table {
            width: 100%;
        }
        .totals-table td {
            font-family: 'Montserrat', sans-serif;
            padding: 5px 0;
            font-size: 11px;
        }
        .totals-table .label {
            text-align: right;
            color: #4a5568;
            padding-right: 15px;
            font-weight: bold;
        }
        .totals-table .value {
            text-align: right;
            color: #2d3748;
            width: 100px;
        }
        .totals-table .total-row td {
            padding-top: 10px;
            font-size: 14px;
            font-weight: bold;
            border-top: 2px solid #e2e8f0;
        }
        .totals-table .total-row .value {
            color: #e8384f;
            font-size: 16px;
        }

        /* Terms */
        .terms-section {
            padding: 15px 35px 20px 35px;
        }
        .terms-label {
            font-family: 'Montserrat', sans-serif;
            font-size: 10px;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 5px;
        }
        .terms-text {
            font-family: 'Montserrat', 'NotoNaskhArabic', sans-serif;
            font-size: 8px;
            color: #718096;
            line-height: 1.5;
        }

        /* Footer Bar */
        .footer-bar {
            background-color: #2d3748;
            height: 20px;
        }
    </style>
</head>
<body>

<div class="invoice-wrapper">

    <!-- Header -->
    <table class="w-100 header">
        <tr>
            <td class="w-50" style="vertical-align: middle;">
                <div class="brand-name">{{ config('app.name', 'Brand Name') }}</div>
                <div class="tagline">Inventory Management System</div>
            </td>
            <td class="w-50 text-right" style="vertical-align: middle;">
                <div class="invoice-title">Invoice</div>
            </td>
        </tr>
    </table>

    <!-- Accent Line -->
    <div class="accent-line"></div>

    <!-- Billing Section -->
    <table class="w-100 billing-section">
        <tr>
            <td class="w-50" style="vertical-align: top;">
                <div class="invoice-to-label">Invoice To:</div>
                <div class="customer-name">{{ $invoice->order->contact->name ?? 'N/A' }}</div>
                <div class="customer-details">
                    {{ $invoice->order->address ?? '' }}<br>
                    @if($invoice->order->contact->city || $invoice->order->contact->state)
                        {{ $invoice->order->contact->city ?? '' }}{{ $invoice->order->contact->city && $invoice->order->contact->state ? ', ' : '' }}{{ $invoice->order->contact->state ?? '' }} {{ $invoice->order->contact->zip_code ?? '' }}<br>
                    @endif
                    @if($invoice->order->contact->phone)
                        {{ $invoice->order->contact->phone }}
                    @endif
                </div>
            </td>
            <td class="w-50" style="vertical-align: top;">
                <table class="invoice-meta" style="float: right;">
                    <tr>
                        <td class="label">Invoice #:</td>
                        <td class="value">{{ $invoice->invoice_number ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Date:</td>
                        <td class="value">{{ $invoice->created_at ? $invoice->created_at->format('d M, Y') : 'N/A' }}</td>
                    </tr>
                    @if($invoice->due_date)
                    <tr>
                        <td class="label">Due Date:</td>
                        <td class="value">{{ \Carbon\Carbon::parse($invoice->due_date)->format('d M, Y') }}</td>
                    </tr>
                    @endif
                </table>
            </td>
        </tr>
    </table>

    <!-- Items Table -->
    <div class="items-section">
        <table class="items-table">
            <thead>
                <tr>
                    <th class="sl-col">#</th>
                    <th>Item</th>
                    <th class="text-right" style="width: 90px;">Price</th>
                    <th class="text-right" style="width: 50px;">Qty</th>
                    <th class="text-right" style="width: 100px;">Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($invoice->order->products as $index => $product)
                <tr>
                    <td class="sl-col">{{ $index + 1 }}</td>
                    <td>{{ $product->name ?? 'N/A' }}</td>
                    <td class="text-right">Rs {{ number_format($product->pivot->sale_price ?? 0, 2) }}</td>
                    <td class="text-right">{{ $product->pivot->quantity ?? 0 }}</td>
                    <td class="text-right" style="font-weight: bold;">Rs {{ number_format(($product->pivot->sale_price ?? 0) * ($product->pivot->quantity ?? 0), 2) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center" style="padding: 20px; color: #a0aec0;">No items found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Footer Section -->
    <table class="w-100 footer-section">
        <tr>
            <td class="w-50" style="vertical-align: top; padding-right: 20px;">
                <div class="thank-you">Thank you for your business!</div>
                <div class="payment-label">Payment Info</div>
                <div class="payment-details">
                    <div><span class="label">Account #:</span> {{ config('company.account_number') ?? config('settings.account_number') ?? '1234 5678 9012' }}</div>
                    <div><span class="label">A/C Name:</span> {{ config('company.account_name') ?? config('settings.account_name') ?? config('app.name', 'Your Company') }}</div>
                    <div><span class="label">Bank:</span> {{ config('company.bank_details') ?? config('settings.bank_details') ?? 'Your Bank Name' }}</div>
                </div>
            </td>
            <td class="w-50" style="vertical-align: top;">
                <table class="totals-table">
                    <tr>
                        <td class="label">Subtotal:</td>
                        <td class="value">Rs {{ number_format($invoice->order->subtotal_amount ?? ($invoice->order->total_amount - ($invoice->order->delivery_charge ?? 0) + ($invoice->order->discount_amount ?? 0)) ?? 0, 2) }}</td>
                    </tr>
                    @if(($invoice->order->discount_amount ?? 0) > 0)
                    <tr>
                        <td class="label">Discount:</td>
                        <td class="value" style="color: #38a169;">- Rs {{ number_format($invoice->order->discount_amount, 2) }}</td>
                    </tr>
                    @endif
                    @if(($invoice->order->delivery_charge ?? 0) > 0)
                    <tr>
                        <td class="label">Delivery:</td>
                        <td class="value">Rs {{ number_format($invoice->order->delivery_charge, 2) }}</td>
                    </tr>
                    @endif
                    @if(($invoice->order->tax_rate ?? 0) > 0)
                    <tr>
                        <td class="label">Tax:</td>
                        <td class="value">{{ number_format($invoice->order->tax_rate, 2) }}%</td>
                    </tr>
                    @endif
                    <tr class="total-row">
                        <td class="label">Grand Total:</td>
                        <td class="value">Rs {{ number_format($invoice->order->total_amount ?? 0, 2) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Terms Section -->
    <div class="terms-section">
        <div class="terms-label">Terms & Conditions</div>
        <div class="terms-text">
            {{ config('company.invoice_terms') ?? 'Payment is due within 30 days. Late payments may incur additional charges. Please include invoice number with payment.' }}
        </div>
    </div>

    <!-- Footer Bar -->
    <div class="footer-bar"></div>

</div>

</body>
</html>
