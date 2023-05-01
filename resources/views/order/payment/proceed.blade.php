@extends("base")
@section("content")
<!-- Body: Header -->
<div class="body-header d-flex py-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-4 mt-1 mb-0">Order Fetch</h1>
                <small class="text-muted">Order / Order Fetch</small>
            </div>
        </div>
    </div>
</div>
<!-- Body: Body -->
<div class="body d-flex py-lg-4 py-3">
    <div class="container">        
        <div class="row g-3 clearfix">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <label class="form-label">Patient Name</label>
                            <input type="text" value="{{ $order->patient_name }}" name="patient_name" class="form-control form-control-md" placeholder="Patient Name" readonly />
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label">Mobile</label>
                            <input type="text" value="{{ $order->mobile }}" name="mobile" class="form-control form-control-md" maxlength="10" placeholder="Mobile" readonly />
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label">Address</label>
                            <input type="text" value="{{ $order->address }}" name="address" class="form-control form-control-md" placeholder="Address" readonly />
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label">Order Number</label>
                            <input type="text" value="{{ $order->order_number }}" name="address" class="form-control form-control-md" placeholder="Order Number" readonly />
                        </div>
                        <div class="col-md-12 text-center mt-3"><a class="btn btn-primary" href="/order/payment/create/{{ encrypt($order->id) }}">Proceed</a></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- .row end -->
    </div>
</div>
@endsection