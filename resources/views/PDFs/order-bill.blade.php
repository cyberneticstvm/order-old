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
            {{ $order->branch->address }}, Phone: {{ $order->branch->mobile }}
    </center>
    <br/>
    <table class="bordered" width="100%" cellspacing="0" cellpadding="0">
        <thead><tr><th text-align="center" colspan="4">Order Bill</th></tr></thead>
        <tbody>
            <tr>
                <td>PATIENT NAME</td>
                <td>{{ $order->patient_name }}</td>
                <td>AGE / SEX</td>
                <td>{{ $order->age }} / {{ $order->gender }}</td>
            </tr>
            <tr>
                <td>PATIENT CONTACT</td>
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
</body>
</html>