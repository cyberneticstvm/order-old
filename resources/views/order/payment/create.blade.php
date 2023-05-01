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
                    <form method="post" action="{{ route('order.payment.save') }}" >
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}" />
                        <div class="row g-3">
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
                            <div class="col-sm-2">
                                <label class="form-label req">Date</label>
                                <input type="date" name="payment_date" class="form-control" value="{{ (old('payment_date')) ? old('payment_date') : date('Y-m-d') }}">
                                @error('payment_date')
                                    <small class="text-danger">{{ $errors->first('payment_date') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label req">Payment Mode</label>
                                {!! Form::select('payment_mode', $pmodes->pluck('name', 'id')->all(),  '', ['class' => 'form-control form-control-sm select2 border-0', 'placeholder' => 'Payment Mode']) !!}
                                @error('payment_mode')
                                <small class="text-danger">{{ $errors->first('payment_mode') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label req">Amount</label>
                                <input type="number" name="amount" class="form-control" step="any" max="{{ $max }}" value="{{ old('amount') }}" placeholder="0.0">
                                @error('amount')
                                    <small class="text-danger">{{ $errors->first('amount') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-5">
                                <label class="form-label">Notes / Remarks</label>
                                <input type="text" name="notes" class="form-control" value="{{ old('notes') }}" placeholder="Notes / Remarks">
                            </div>
                            <div class="col-sm-12 text-end">
                                <button type="button" onClick="history.back()"  class="btn btn-danger">Cancel</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="submit" class="btn btn-primary btn-submit">Save</button>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
        <!-- .row end -->
    </div>
</div>
@endsection