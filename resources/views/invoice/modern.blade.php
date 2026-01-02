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
            size: A4;
        }

        html, body {
            font-family: 'Montserrat', 'NotoNaskhArabic', sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.4;
            background-color: #ffffff;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        /* Header Bar */
        .header-bar {
            background-color: #1e3a5f;
            padding: 25px 35px;
        }
        .invoice-label {
            font-family: 'Montserrat', sans-serif;
            font-size: 24px;
            font-weight: bold;
            color: #ffffff;
            letter-spacing: 12px;
            text-transform: uppercase;
        }
        .logo-text {
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
            text-align: right;
        }
        .logo-tagline {
            font-family: 'Montserrat', sans-serif;
            font-size: 8px;
            color: #a0b4c8;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-align: right;
            margin-top: 3px;
        }

        /* Website URL */
        .website-section {
            text-align: center;
            padding: 12px 0;
            border-bottom: 1px solid #e5e5e5;
            background-color: #f8f8f8;
        }
        .website-url {
            font-family: 'Montserrat', sans-serif;
            font-size: 10px;
            color: #1e3a5f;
            letter-spacing: 2px;
        }

        /* Billing Section */
        .billing-section {
            padding: 22px 35px;
        }
        .billing-label {
            font-family: 'Montserrat', sans-serif;
            font-size: 10px;
            font-weight: bold;
            color: #1e3a5f;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 6px;
        }
        .customer-name {
            font-family: 'Montserrat', 'NotoNaskhArabic', sans-serif;
            font-size: 14px;
            font-weight: bold;
            color: #1e3a5f;
            margin-bottom: 4px;
        }
        .customer-address {
            font-family: 'Montserrat', 'NotoNaskhArabic', sans-serif;
            font-size: 11px;
            color: #555555;
            line-height: 1.6;
        }
        .meta-label {
            font-family: 'Montserrat', sans-serif;
            font-size: 10px;
            font-weight: bold;
            color: #1e3a5f;
            text-transform: uppercase;
        }
        .meta-value {
            font-family: 'Montserrat', sans-serif;
            font-size: 12px;
            color: #333333;
            margin-left: 10px;
        }
        .meta-row {
            margin-bottom: 6px;
            text-align: right;
        }

        /* Items Table */
        .items-section {
            padding: 5px 35px 25px 35px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
        }
        .items-table th {
            font-family: 'Montserrat', sans-serif;
            padding: 12px 10px;
            text-align: left;
            font-weight: bold;
            color: #1e3a5f;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid #1e3a5f;
        }
        .items-table th.text-right {
            text-align: right;
        }
        .items-table th.text-center {
            text-align: center;
        }
        .items-table td {
            font-family: 'Montserrat', 'NotoNaskhArabic', sans-serif;
            padding: 14px 10px;
            font-size: 11px;
            color: #444444;
            border-bottom: 1px solid #e5e5e5;
        }
        .items-table td.text-right {
            text-align: right;
        }
        .items-table td.text-center {
            text-align: center;
        }
        .items-table td.total-col {
            color: #1e3a5f;
            font-weight: bold;
        }

        /* Footer Section */
        .footer-section {
            padding: 20px 35px 25px 35px;
            background-color: #f8f8f8;
        }
        .terms-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 10px;
            font-weight: bold;
            color: #1e3a5f;
            margin-bottom: 6px;
        }
        .terms-text {
            font-family: 'Montserrat', 'NotoNaskhArabic', sans-serif;
            font-size: 9px;
            color: #666666;
            line-height: 1.6;
        }
        .payment-section {
            margin-top: 12px;
            padding-top: 10px;
            border-top: 1px solid #e0e0e0;
        }
        .payment-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 9px;
            font-weight: bold;
            color: #1e3a5f;
            margin-bottom: 5px;
        }
        .payment-details {
            font-family: 'Montserrat', sans-serif;
            font-size: 9px;
            color: #555555;
            line-height: 1.7;
        }

        /* Totals Table */
        .totals-table {
            width: 100%;
        }
        .totals-table td {
            font-family: 'Montserrat', sans-serif;
            padding: 6px 0;
            font-size: 11px;
        }
        .totals-table .label-cell {
            text-align: right;
            color: #1e3a5f;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding-right: 15px;
            width: 55%;
        }
        .totals-table .value-cell {
            text-align: right;
            color: #333333;
            width: 45%;
        }
        .totals-table .grand-total td {
            padding-top: 12px;
            font-size: 14px;
            border-top: 2px solid #1e3a5f;
        }
        .totals-table .grand-total .value-cell {
            color: #1e3a5f;
            font-weight: bold;
            font-size: 18px;
        }

        /* Contact Footer Bar */
        .contact-bar {
            background-color: #1e3a5f;
            padding: 18px 35px;
        }

        /* Full Page Layout - A4 is 297mm tall */
        .page-table {
            width: 100%;
            height: 297mm;
            border-collapse: collapse;
        }
        .content-cell {
            vertical-align: top;
            padding: 0;
        }
        .spacer-cell {
            height: auto;
        }
        .footer-cell {
            vertical-align: bottom;
            padding: 0;
            height: 1px;
        }
        .contact-item {
            font-family: 'Montserrat', sans-serif;
            font-size: 10px;
            color: #ffffff;
            text-align: center;
        }
        .contact-icon {
            display: inline-block;
            width: 18px;
            height: 18px;
            background-color: #c9a96e;
            border-radius: 50%;
            text-align: center;
            line-height: 18px;
            margin-right: 8px;
            font-size: 9px;
            color: #1e3a5f;
            vertical-align: middle;
            font-weight: bold;
        }

        /* Utilities */
        .w-100 { width: 100%; }
        .w-50 { width: 50%; }
        .w-33 { width: 33.33%; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .v-top { vertical-align: top; }
        .v-middle { vertical-align: middle; }
    </style>
</head>
<body>

<table class="page-table">
<tr>
    <td class="content-cell">

    <!-- Header Bar -->
    <table class="w-100 header-bar">
        <tr>
            <td class="w-50 v-middle">
                <div class="invoice-label">I N V O I C E</div>
            </td>
            <td class="w-50 v-middle">
                <div class="logo-text">{{ config('app.name', 'Your Company') }}</div>
                <div class="logo-tagline">Inventory Management System</div>
            </td>
        </tr>
    </table>

    <!-- Website URL -->
    <div class="website-section">
        <span class="website-url">{{ config('app.url', 'www.yourcompany.com') }}</span>
    </div>

    <!-- Billing Section -->
    <table class="w-100 billing-section">
        <tr>
            <td class="w-50 v-top">
                <div class="billing-label">Invoice To:</div>
                <div class="customer-name">{{ $invoice->order->contact->name ?? 'N/A' }}</div>
                <div class="customer-address">
                    {{ $invoice->order->address ?? '' }}<br>
                    @if($invoice->order->contact->city || $invoice->order->contact->state)
                        {{ $invoice->order->contact->city ?? '' }}{{ $invoice->order->contact->city && $invoice->order->contact->state ? ', ' : '' }}{{ $invoice->order->contact->state ?? '' }} {{ $invoice->order->contact->zip_code ?? '' }}<br>
                    @endif
                    @if($invoice->order->contact->phone)
                        {{ $invoice->order->contact->phone }}
                    @endif
                </div>
            </td>
            <td class="w-50 v-top">
                <div class="meta-row">
                    <span class="meta-label">Invoice No.</span>
                    <span class="meta-value">{{ $invoice->invoice_number ?? 'N/A' }}</span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">Date</span>
                    <span class="meta-value">{{ $invoice->created_at ? $invoice->created_at->format('d M, Y') : 'N/A' }}</span>
                </div>
                @if($invoice->due_date)
                <div class="meta-row">
                    <span class="meta-label">Due Date</span>
                    <span class="meta-value">{{ \Carbon\Carbon::parse($invoice->due_date)->format('d M, Y') }}</span>
                </div>
                @endif
            </td>
        </tr>
    </table>

    <!-- Items Table -->
    <div class="items-section">
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 45%;">Item</th>
                    <th class="text-right" style="width: 18%;">Price</th>
                    <th class="text-center" style="width: 12%;">Qty</th>
                    <th class="text-right" style="width: 25%;">Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($invoice->order->products as $product)
                <tr>
                    <td>{{ $product->name ?? 'N/A' }}</td>
                    <td class="text-right">Rs {{ number_format($product->pivot->sale_price ?? 0, 2) }}</td>
                    <td class="text-center">{{ $product->pivot->quantity ?? 0 }}</td>
                    <td class="text-right total-col">Rs {{ number_format(($product->pivot->sale_price ?? 0) * ($product->pivot->quantity ?? 0), 2) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center" style="padding: 25px; color: #999;">No items found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Footer Section -->
    <table class="w-100 footer-section">
        <tr>
            <td class="w-50 v-top" style="padding-right: 25px;">
                <div class="terms-title">Terms and Conditions</div>
                <div class="terms-text">
                    {{ config('company.invoice_terms') ?? 'Payment is due within 30 days. Late payments may incur additional charges. Please include invoice number with payment.' }}
                </div>
                <div class="payment-section">
                    <div class="payment-title">Payment Information</div>
                    <div class="payment-details">
                        <strong>Account #:</strong> {{ config('company.account_number') ?? config('settings.account_number') ?? '1234 5678 9012' }}<br>
                        <strong>A/C Name:</strong> {{ config('company.account_name') ?? config('settings.account_name') ?? config('app.name', 'Your Company') }}<br>
                        <strong>Bank:</strong> {{ config('company.bank_details') ?? config('settings.bank_details') ?? 'Your Bank Name' }}
                    </div>
                </div>
            </td>
            <td class="w-50 v-top">
                <table class="totals-table">
                    <tr>
                        <td class="label-cell">Subtotal</td>
                        <td class="value-cell">Rs {{ number_format($invoice->order->subtotal_amount ?? ($invoice->order->total_amount - ($invoice->order->delivery_charge ?? 0) + ($invoice->order->discount_amount ?? 0)) ?? 0, 2) }}</td>
                    </tr>
                    @if(($invoice->order->discount_amount ?? 0) > 0)
                    <tr>
                        <td class="label-cell">Discount</td>
                        <td class="value-cell" style="color: #38a169;">- Rs {{ number_format($invoice->order->discount_amount, 2) }}</td>
                    </tr>
                    @endif
                    @if(($invoice->order->delivery_charge ?? 0) > 0)
                    <tr>
                        <td class="label-cell">Delivery</td>
                        <td class="value-cell">Rs {{ number_format($invoice->order->delivery_charge, 2) }}</td>
                    </tr>
                    @endif
                    @if(($invoice->order->tax_rate ?? 0) > 0)
                    <tr>
                        <td class="label-cell">Tax</td>
                        <td class="value-cell">{{ number_format($invoice->order->tax_rate, 2) }}%</td>
                    </tr>
                    @endif
                    <tr class="grand-total">
                        <td class="label-cell">Grand Total</td>
                        <td class="value-cell">Rs {{ number_format($invoice->order->total_amount ?? 0, 2) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    </td>
</tr>
<tr>
    <td class="spacer-cell"></td>
</tr>
<tr>
    <td class="footer-cell">
    <!-- Contact Footer Bar -->
    <table class="w-100 contact-bar">
        <tr>
            <td class="w-33 contact-item">
                <span class="contact-icon">@</span>
                <span>{{ config('company.address') ?? config('settings.address') ?? 'Your Business Address' }}</span>
            </td>
            <td class="w-33 contact-item">
                <span class="contact-icon">E</span>
                <span>{{ config('company.email') ?? config('settings.email') ?? 'contact@yourcompany.com' }}</span>
            </td>
            <td class="w-33 contact-item">
                <span class="contact-icon">T</span>
                <span>{{ config('company.phone') ?? config('settings.phone') ?? '+92 XXX XXX XXXX' }}</span>
            </td>
        </tr>
    </table>
    </td>
</tr>
</table>

</body>
</html>
