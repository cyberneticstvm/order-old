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
            {{ $invoice->order->branch->address }}, Phone: {{ $invoice->order->branch->mobile }}
    </center>
    <br/>
    <center><p>Invoice</p></center>
</body>
</html>