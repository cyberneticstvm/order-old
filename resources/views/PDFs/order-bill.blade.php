<!DOCTYPE html>
<html>
<head>
    <title>Devi Eye Clinic & Opticians</title>
    <style>
        table{
            border: 1px solid #e6e6e6;
            font-size: 12px;
        }
        thead{
            border-bottom: 1px solid #e6e6e6;
        }
        table thead th, table tbody td{
            padding: 5px;
        }
        .bordered td{
            border: 1px solid #e6e6e6;
        }
        .text-right{
            text-align: right;
        }
        .txt{
            font-size: x-small;
        }
        .text-center{
            text-align: center;
        }
    </style>
</head>
<body>
    <table width="100%">
        <tr><td></td><td>
        <center>
            <img src="./assets/images/Devi-Logo-Transparent.jpg" width="15%"/><br/>
                {{ $order->branch->address }}, Phone: {{ $order->branch->mobile }}
        </center>
        </td><td><img src="data:image/png;base64, {!! $qrcode !!}"></td></tr>
    </table>
    <table class="bordered" width="100%" cellspacing="0" cellpadding="0">
        <thead><tr><th text-align="center" colspan="4">Order Bill</th></tr></thead>
        <tbody>
            <tr>
                <td>CUSTOMER NAME</td>
                <td>{{ $order->patient_name }}</td>
                <td>AGE / SEX</td>
                <td>{{ $order->age }} / {{ $order->gender }}</td>
            </tr>
            <tr>
                <td>CUSTOMER CONTACT</td>
                <td>{{ $order->mobile }}</td>
                <td>ORDER NUMBER</td>
                <td>{{ $order->order_number }}</td>
            </tr>
            <tr>
                <td>MEDICAL RECORD ID</td>
                <td>{{ $order->medical_record_id }}</td>
                <td>ORDER DATE</td>
                <td>{{ $order->order_date->format('d-M-Y') }}</td>
            </tr>
        </tbody>
    </table>
    <center><p>Product Details</p></center>
    <table class="bordered" width="100%" cellspacing="0" cellpadding="0">
        <thead><tr><th>SL No</th><th>Product</th><th>Qty</th><th>Price</th><th>Discount</th><th>Tax</th><th>Total</th></tr></thead>
        <tbody>
            @php $slno = 1; @endphp
            @forelse($order->orderdetails as $key => $value)
            <tr>
                <td>{{ $slno++ }}</td>
                <td>{{ $value->product->name }}</td>
                <td class="text-right">{{ $value->qty }}</td>
                <td class="text-right">{{ $value->price }}</td>
                <td class="text-right">{{ $value->discount_amount }}</td>
                <td class="text-right">{{ $value->tax_amount }}</td>
                <td class="text-right">{{ $value->total }}</td>
            </tr>
            @empty
            @endforelse
            <tr><td colspan="6" class="text-right"><b>Total</b></td><td class="text-right"><b>{{ $order->order_total }}</b></td></tr>
            <tr><td colspan="6" class="text-right"><b>Discount</b></td><td class="text-right"><b>{{ $order->discount }}</b></td></tr>
            <tr><td colspan="6" class="text-right"><b>Advance</b></td><td class="text-right"><b>{{ $order->advance }}</b></td></tr>
            <tr><td colspan="6" class="text-right"><b>Balance</b></td><td class="text-right"><b>{{ $order->balance }}</b></td></tr>
        </tbody>
    </table>
    <center><p class="txt"> welcome to Devi Opticians Family. Thank you for your order. For any enquiry about your order please contact us on 93 88 611 622</p></center>
    ------------------------------------------------------------------------------------------------------------------------------------
    <br>
    <table>
        <tr>
            <td>
                Order Date: <b>{{ $order->order_date->format('d-M-Y') }}</b>
            </td>
            <td>
                Due Date: <b>{{ $order->expected_delivery_date->format('d-M-Y') }}</b>
            </td>
        </tr>
        <tr>
            <td>
                Order Number: <b>{{ $order->order_number }}</b>
            </td>
            <td>
                Customer Name: <b>{{ $order->patient_name }}</b>
            </td>
        </tr>
    </table>
    <br>
    <table width="50%" cellspacing="0" cellpadding="0">
        <tbody>
            @forelse($order->orderdetails as $key => $value)
            <tr>
                <td>{{ $value->product_type }}</td>
                <td>{{ $value->product->name }}</td>
                <td class="text-right">{{ $value->qty }}</td>
            </tr>
            @empty
            @endforelse
        </tbody>
    </table>
    <br>
    <table width="50%" cellspacing="0" cellpadding="0">
        <thead><tr><th></th><th>SPH</th><th>CYL</th><th>AXIS</th><th>ADD</th><th>PD</th><th>FH</th><th>PRISM</th></tr></thead>
        <tbody>
            @forelse($order->orderdetails as $key => $value)
            <tr>
                <td class="text-center">{{ ($value->product_type == 'RE' || $value->product_type == 'LE') ? $value->product_type : '' }}</td>
                <td class="text-center">{{ $value->sph }}</td>
                <td class="text-center">{{ $value->cyl }}</td>
                <td class="text-center">{{ $value->axis }}</td>
                <td class="text-center">{{ $value->addition }}</td>
                @if($value->product_type == 'RE' || $value->product_type == 'LE')
                <td class="text-center">{{ ($key == 0) ? $order->re_pd : $order->le_pd }}</td>
                <td class="text-center">{{ ($key == 0) ? $order->re_fh : $order->le_fh }}</td>
                <td class="text-center">{{ ($key == 0) ? $order->re_prism : $order->le_prism }}</td>
                @else
                <td></td><td></td><td></td>
                @endif
            </tr>
            @empty
            @endforelse
            <tr><td colspan="8" class="text-center">VD: {{ $order->vd }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; IPD: {{ $order->ipd }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NPD: {{ $order->npd }}</td></tr>
            <tr><td></td>
                <td class="text-center">DBL<br>{{ $order->dbl }}</td>
                <td class="text-center">ED<br>{{ $order->ed }}</td>
                <td class="text-center">Size A<br>{{ $order->size_a }}</td>
                <td class="text-center">Size B<br>{{ $order->size_b }}</td>
                <td class="text-center">PA<br>{{ $order->pa }}</td>
                <td class="text-center">WA<br>{{ $order->wa }}</td>
            <td></td></tr>
        </tbody>
    </table>
    <p class="txt">Comments: {{ $order->notes }}</p>
</body>
</html>