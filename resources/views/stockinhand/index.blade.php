@extends("base")
@section("content")
<!-- Body: Header -->
<div class="body-header d-flex py-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-4 mt-1 mb-0">Stock In hand</h1>
                <small class="text-muted">Inventory / Stock In hand</small>
            </div>
        </div>
    </div>
</div>

<!-- Body: Body -->
<div class="body d-flex py-lg-4 py-3">
    <div class="container">        
        <div class="row g-3 clearfix">
            <div class="card mb-2">
                <div class="card-body p-4">
                    @include("sections.message")
                    <form action="{{ route('stockinhand.fetch') }}" method="post">
                        @csrf
                        <div class="row g-4">
                            <div class="col-sm-3">
                                <label class="form-label req">Branch</label>
                                {!! Form::select('branch', branches()->pluck('name', 'id')->all(),  ($inputs && $inputs[0]) ? $inputs[0] : Session::get('branch'), ['class' => 'form-control form-control-sm select2 border-0', 'placeholder' => 'Select']) !!}
                                @error('branch')
                                <small class="text-danger">{{ $errors->first('branch') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-5">
                                <label class="form-label req">Product</label>
                                {!! Form::select('product', $products->pluck('name', 'id')->all(),  ($inputs && $inputs[1]) ? $inputs[1] : null, ['class' => 'form-control form-control-sm select2 border-0', 'placeholder' => 'Select']) !!}
                                @error('product')
                                <small class="text-danger">{{ $errors->first('product') }}</small>
                                @enderror
                            </div>                     
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12 text-end">
                                <button type="button" onClick="history.back()"  class="btn btn-danger">Cancel</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="submit" class="btn btn-primary btn-submit">Fetch</button>
                            </div>
                        </div>    
                    </form>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col">
                            <table id="dataTbl" class="table table-striped table-hover align-middle table-sm" style="width:100%">
                                <thead><tr><th>SL No.</th><th>Branch</th><th>Product</th><th>Pid</th><th>Product Code</th><th>Stock In</th><th>Stock Out</th><th>Balance</th></tr></thead><tbody>
                                <tr>
                                    <td>1</td>
                                    <td>{{ branches()->find(($inputs && $inputs[0]) ? $inputs[0] : Session::get('branch'))->name }}</td>
                                    <td>{{ ($inputs && $inputs[1]) ? $products->find( $inputs[1])->name : '' }}</td>
                                    <td>{{ ($inputs && $inputs[1]) ? $products->find( $inputs[1])->id : '' }}</td>
                                    <td>{{ ($inputs && $inputs[1]) ? $products->find( $inputs[1])->product_code : '' }}</td>
                                    <td class="text-end"><a class="inventory text-danger" href="javascript:void(0)" data-bs-toggle="modal" data-modal="stockInModal" data-bs-target="#stockInModal" data-title="Stock In Details" data-type="stockin">{{ $stockin->sum('qty') }}</a></td>
                                    <td class="text-end"><a class="inventory text-danger" href="javascript:void(0)" data-bs-toggle="modal" data-modal="stockOutModal" data-bs-target="#stockOutModal" data-title="Stock In Details" data-type="stockin">{{ $transfer->sum('qty')+$sold->sum('qty') }}</a></td>
                                    <td class="text-end">{{ $stockin->sum('qty')-($transfer->sum('qty')+$sold->sum('qty')) }}</td>
                                </tr>
                                </tbody></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- .row end -->
    </div>
</div>
<div class="modal fade" id="stockInModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-vertical modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary">Stock In Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body custom_scroll">
                <div class="row">
                    <div class="col-md-12 table-responsive inventoryDetailed">
                        <table class="table table-striped table-hover align-middle table-sm" style="width:100%">
                            <thead><tr><th>SL No.</th><th>Transfer Date</th><th>From</th><th>To</th><th>Product</th><th>Qty</th></tr></thead>
                            <tbody>
                                @php $c = 1; @endphp
                                @forelse($stockin as $key => $stock)
                                <tr>
                                    <td>{{ $c++ }}</td>
                                    <td>{{ $stock->created_at->format('d/M/Y') }}</td>
                                    <td>{{ branches()->find($stock->from_branch)->name }}</td>
                                    <td>{{ branches()->find($stock->to_branch)->name }}</td>
                                    <td>{{ $stock->product->name }}</td>
                                    <td class="text-end">{{ $stock->qty }}</td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5" class="text-end fw-bold">Total</th><th class="text-end fw-bold">{{ $stockin->sum('qty') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="stockOutModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-vertical modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary">Stock Out Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body custom_scroll">
                <div class="row">
                    <div class="col-md-12 table-responsive inventoryDetailed">
                        <h3>Stock Transfer</h3>
                        <table class="table table-striped table-hover align-middle table-sm" style="width:100%">
                            <thead><tr><th>SL No.</th><th>Transfer Date</th><th>From</th><th>To</th><th>Product</th><th>Qty</th></tr></thead>
                            <tbody>
                                @php $c = 1; @endphp
                                @forelse($transfer as $key => $stock)
                                <tr>
                                    <td>{{ $c++ }}</td>
                                    <td>{{ $stock->transfer->transfer_date->format('d/M/Y') }}</td>
                                    <td>{{ branches()->find($stock->from_branch)->name }}</td>
                                    <td>{{ branches()->find($stock->to_branch)->name }}</td>
                                    <td>{{ $stock->product->name }}</td>
                                    <td class="text-end">{{ $stock->qty }}</td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5" class="text-end fw-bold">Total</th><th class="text-end fw-bold">{{ $transfer->sum('qty') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                        <h3>Order</h3>
                        <table class="table table-striped table-hover align-middle table-sm" style="width:100%">
                            <thead><tr><th>SL No.</th><th>Order Date</th><th>Branch</th><th>Order Number</th><th>Product</th><th>Qty</th></tr></thead>
                            <tbody>
                                @php $c = 1; @endphp
                                @forelse($sold as $key => $order)
                                <tr>
                                    <td>{{ $c++ }}</td>
                                    <td>{{ $order->order->order_date->format('d/M/Y') }}</td>
                                    <td>{{ branches()->find($order->branch_id)->name }}</td>
                                    <td>{{ $order->order->order_number }}</td>
                                    <td>{{ $order->product->name }}</td>
                                    <td class="text-end">{{ $order->qty }}</td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5" class="text-end fw-bold">Total</th><th class="text-end fw-bold">{{ $sold->sum('qty') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection