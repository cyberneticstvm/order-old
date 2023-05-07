@extends("base")
@section("content")
<!-- Body: Header -->
<div class="body-header d-flex py-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-4 mt-1 mb-0">Stock Transfer</h1>
                <small class="text-muted">Inventory / Stock Transfer</small>
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
                    <form action="{{ route('stockout.create') }}" method="post">
                        @csrf
                        <div class="row g-4">
                            <div class="col-sm-2">
                                <label class="form-label req">Transfer Date</label>
                                <input type="date" value="{{ date('Y-m-d') }}" name="transfer_date" class="form-control form-control-md" placeholder="Transfer Date" >
                                @error('transfer_date')
                                <small class="text-danger">{{ $errors->first('transfer_date') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label req">From Branch</label>
                                {!! Form::select('from_branch', $branches->pluck('name', 'id')->all(),  null, ['class' => 'form-control form-control-sm select2', 'placeholder' => 'Select']) !!}
                                @error('from_branch')
                                <small class="text-danger">{{ $errors->first('from_branch') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label req">To Branch</label>
                                {!! Form::select('to_branch', $branches->pluck('name', 'id')->all(),  null, ['class' => 'form-control form-control-sm select2', 'placeholder' => 'Select']) !!}
                                @error('to_branch')
                                <small class="text-danger">{{ $errors->first('to_branch') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">Notes / Remarks</label>
                                <input type="text" value="{{ old('notes') }}" name="notes" class="form-control form-control-md" placeholder="Notes / Remarks">
                            </div>                      
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <h5 class="text-primary mb-1 text-center"><strong>Product Details</strong></h5>
                            </div>
                            <div class="col-12 table-responsive mt-3">
                                <table class="tblOrder table table-bordered table-sm">
                                    <thead><tr><th>Category</th><th>Subcategory</th><th>Product</th><th width="10%">Qty</th><th class="text-center"><a href="javascript:void(0)" class="addStockRow"><i class="fa fa-plus fa-lg text-success fw-bold"></i></a></th></tr></thead>
                                    <tbody class="tblStock">
                                        <tr>
                                            <td>
                                                {!! Form::select('category[]', $categories->pluck('name', 'id')->all(), null, ['class' => 'form-control form-control-sm select2 selPdctCat', 'data-placeholder' => 'Category', 'required']) !!}
                                            </td>
                                            <td>
                                                {!! Form::select('subcategory[]', [], null, ['class' => 'form-control form-control-sm select2 selProdSubcat', 'data-placeholder' => 'Subcategory', 'required']) !!}
                                            </td>
                                            <td>
                                                {!! Form::select('product[]', [], null, ['class' => 'form-control form-control-sm select2 selProd', 'data-placeholder' => 'Product', 'required']) !!}
                                            </td>
                                            <td>
                                                {!! Form::text('qty[]', null, ['class' => 'form-control form-control-sm border-0 text-end', 'placeholder' => 'Qty', 'required']) !!}
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                            </div>                          
                        </div>
                        <div class="row mt-3">
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