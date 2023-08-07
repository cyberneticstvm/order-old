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
    </style>
</head>
<body>
    <center>
        <img src="./assets/images/Devi-Logo-Transparent.jpg" width="15%"/><br/>
            {{ $payment->order->branch->address }}, Phone: {{ $payment->order->branch->mobile }}
    </center>
    <br/>
    <table class="bordered" width="100%" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td>PATIENT NAME</td>
                <td>{{ $payment->order->patient_name }}</td>
                <td>AGE / SEX</td>
                <td>{{ $payment->order->age }} / {{ $payment->order->gender }}</td>
            </tr>
            <tr>
                <td>PATIENT CONTACT</td>
                <td>{{ $payment->order->mobile }}</td>
                <td>ORDER NUMBER</td>
                <td>{{ $payment->order->order_number }}</td>
            </tr>
            <tr>
                <td>MEDICAL RECORD ID</td>
                <td>{{ $payment->order->medical_record_id }}</td>
                <td>PAYMENT DATE</td>
                <td>{{ $payment->payment_date->format('d-M-Y') }}</td>
            </tr>
        </tbody>
    </table>
    <center><p>Payment Receipt</p></center>
    <table class="bordered" width="100%" cellspacing="0" cellpadding="0">
        <thead><tr><th>Particulars</th><th>Payment Mode</th><th>amount</th></tr></thead>
        <tbody>
            <tr>
                <td>Payment Against Order Number {{ $payment->order->order_number }}</td>
                <td>{{ $payment->pmode->name }}</td>
                <td class="text-right">{{ $payment->amount }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>