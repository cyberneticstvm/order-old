@extends("base")
@section("content")
<!-- Body: Header -->
<div class="body-header d-flex py-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-4 mt-1 mb-0">Invoice Register</h1>
                <small class="text-muted">Invoice Register</small>
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
                    <form action="{{ route('invoice.fetch') }}" method="post">
                        @csrf
                        <div class="row g-4">
                            <div class="col-sm-3">
                                <label class="form-label">Order Number<sup class="text-danger">*</sup></label>
                                <input type="text" value="{{ old('order_number') }}" name="order_number" class="form-control form-control-md" placeholder="Order Number">
                                @error('order_number')
                                <small class="text-danger">{{ $errors->first('order_number') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label">&nbsp;</label>
                                <button type="submit" class="btn btn-primary btn-submit w-100">Fetch</button>
                            </div>
                        </div>                            
                    </form>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-body p-4">
                    @include("sections.message")
                    <table id="dataTbl" class="table table-striped table-hover align-middle table-sm">
                        <thead><tr><th>SL No</th><th>Order ID</th><th>Invoice Number</th><th>Invoice Date</th><th>Amount</th><th>Invoice</th><th>Cancel</th></tr></thead>
                        <tbody>
                            @php $c = 1; @endphp
                            @forelse($invoices as $key => $invoice)
                            <tr>
                                <td>{{ $c++ }}</td>
                                <td>{{ $invoice->order->order_number }}</td>
                                <td>{{ $invoice->invoice_number }}</td>
                                <td>{{ $invoice->invoice_date->format('d-M-Y') }}</td>
                                <td>{{ $invoice->invoice_total }}</td>
                                <td class="text-center"><a target="_blank" href="/pdf/invoice/{{ $invoice->id }}"><i class="fa fa-file-pdf-o text-danger"></i></a></td>
                                <td class="text-center">
                                    <form method="post" action="{{ route('invoice.delete', $invoice->id) }}">
                                        @csrf 
                                        @method("PUT")
                                        <button type="submit" class="border no-border" onclick="javascript: return confirm('Are you sure want to cancel this record?');"><i class="fa fa-trash text-danger"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- .row end -->
    </div>
</div>
@endsection