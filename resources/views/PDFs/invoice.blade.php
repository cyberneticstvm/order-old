<!DOCTYPE html>
<html>
<head>
    <title>Devi Eye Clinic & Opticians</title>
    <style>
        table{
            font-size: 15px;
        }
        thead{
            border-bottom: 1px solid #000;
        }
        table thead th, table tbody td{
            padding: 5px;
        }
        .bordered{
            border: 1px solid #000;
        }
        .text-right{
            text-align: right;
        }
        .border-right{
            border-right: 1px solid #000;
        }
        .bg-gray{
            background-color: #eee;
        }
    </style>
</head>
<body>
    <table width="100%">
        <tr>
            <td width="30%">TAX INVOICE</td>
            <td class="bordered" width="30%">ORIGINAL FOR RECEIPIENT</td>
            <td width="40%" class="text-right">Innovative Production Process</td>
        </tr>
    </table>
    <br>
    <table class="bordered" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="25%">
                <img src="./assets/images/Devi-Logo-Transparent.jpg" width="50%"/>
            </td>
            <td class="border-right" width="20%">
                {{ $invoice->order->branch->address }}<br> Phone: {{ $invoice->order->branch->mobile }}
            </td>
            <td width="15%">
                Invoice No:<br>{{ $invoice->invoice_number }}
            </td>
            <td width="15%">
                Order Date:<br>{{ $invoice->order->order_date->format('d-M-Y') }}
            </td>
            <td width="15%">
                Invoice Date:<br>{{ $invoice->invoice_date->format('d-M-Y') }}
            </td>
        </tr>
    </table>
    <br>
    <table class="bordered" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td class="bordered" width="50%">
                BILL TO<br>
                {{ $invoice->order->patient_name }}<br>
                {{ $invoice->order->address }}<br>
                {{ $invoice->order->mobile }}
            </td>
            <td class="bordered" width="50%">
                SHIP TO<br>
                {{ $invoice->order->patient_name }}<br>
                {{ $invoice->order->address }}<br>
                {{ $invoice->order->mobile }}
            </td>
        </tr>
    </table>
    <br>
    <table class="bordered" cellpadding="0" cellspacing="0" width="100%">
        <thead class="bg-gray"><tr>
            <th>SL No</th><th>Item</th><th>Qty</th><th>Rate</th><th>Discount</th><th>Tax</th><th>Total</th>
        </tr></thead>
        <tbody>
            @php $slno = 1; @endphp
            @forelse($invoice->order->orderdetails as $key => $value)
            <tr>
                <td class="bordered">{{ $slno++ }}</td>
                <td class="bordered">{{ $value->product->name }}</td>
                <td class="text-right bordered">{{ $value->qty }}</td>
                <td class="text-right bordered">{{ $value->price }}</td>
                <td class="text-right bordered">{{ $value->discount_amount }}</td>
                <td class="text-right bordered">{{ $value->tax_amount }}</td>
                <td class="text-right bordered">{{ $value->total }}</td>
            </tr>
            @empty
            @endforelse
            <tr><td colspan="4" class="text-right bordered"><b>Total</b></td><td class="text-right bordered"><b>{{ number_format($invoice->order->orderdetails->sum('discount_amount'), 2) }}</b></td><td class="text-right bordered"><b>{{ number_format($invoice->order->orderdetails->sum('tax_amount'), 2) }}</b></td><td class="text-right bordered"><b>{{ number_format($invoice->order->order_total, 2) }}</b></td></tr>
        </tbody>
    </table>
    <h5>TAX COMPARISON</h5>
    <table class="bordered" cellpadding="0" cellspacing="0" width="100%">
        <thead class="bg-gray bordered"><tr>
            <th>Taxable Value</th><th>CGST</th><th>SGST</th><th>CESS</th><th>TAX %</th><th>TAX AMOUNT</th>
        </tr></thead>
        <tr>
            <td class="bordered text-right">{{ number_format($invoice->order->order_total, 2) }}</td>
            <td class="bordered text-right">{{ number_format($invoice->order->orderdetails->sum('tax_amount')/2, 2) }}</td>
            <td class="bordered text-right">{{ number_format($invoice->order->orderdetails->sum('tax_amount')/2, 2) }}</td>
            <td class="bordered text-right">0.00</td>
            <td class="bordered text-right">{{ $invoice->order->orderdetails->first()->value('tax_percentage') }}</td>
            <td class="bordered text-right">{{ number_format($invoice->order->orderdetails->sum('tax_amount'), 2) }}</td>
        </tr>
    </table>
    <br>
    <table class="bordered" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td class="bordered">   
            <b>Bank Details</b><br>
            Name: Drx Lab<br>
            IFSC Code: HDFC0001492<br>
            Account No: 14922000000161<br>
            Brach: HDFC Bank, Varkala
            </td>
            <td class="bordered"><center>Payment QR Code (PhonePe / Google Pay)</center></td>
        </tr>
        <tr>
            <td class="bordered">
            <b>Terms & Conditions</b><br>
            This is computer generated does not require stamp and<br>
            signature Subject to Thiruvananthapuram Jurisdiction
            </td>
            <td class="bordered">
            <center>Authorized Signority For<br>
                Drx Lab</center>
            </td>
        </tr>
    </table>
</body>
</html>