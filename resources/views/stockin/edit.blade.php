@extends("base")
@section("content")
<!-- Body: Header -->
<div class="body-header d-flex py-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-4 mt-1 mb-0">Stock update</h1>
                <small class="text-muted">Inventory / Update Stock</small>
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
                    <form action="{{ route('stockin.update', $stockin->id) }}" method="post">
                        @csrf
                        @method("PUT")
                        <div class="row g-4">
                            <div class="col-sm-5">
                                <label class="form-label req">Supplier</label>
                                {!! Form::select('supplier_id', $suppliers->pluck('name', 'id')->all(),  $stockin->supplier_id, ['class' => 'form-control form-control-sm select2 border-0', 'placeholder' => 'Select']) !!}
                                @error('supplier_id')
                                <small class="text-danger">{{ $errors->first('supplier_id') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label req">Order Date</label>
                                <input type="date" value="{{ $stockin->order_date->format('Y-m-d') }}" name="order_date" class="form-control form-control-md" placeholder="Order Date" >
                                @error('order_date')
                                <small class="text-danger">{{ $errors->first('order_date') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label req">Delivery Date</label>
                                <input type="date" value="{{ $stockin->delivery_date->format('Y-m-d') }}" name="delivery_date" class="form-control form-control-md" placeholder="Order Date" >
                                @error('delivery_date')
                                <small class="text-danger">{{ $errors->first('delivery_date') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label req">Invoice Number</label>
                                <input type="text" value="{{ $stockin->invoice }}" name="invoice" class="form-control form-control-md" placeholder="Invoice Number">
                                @error('invoice')
                                <small class="text-danger">{{ $errors->first('invoice') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Notes / Remarks</label>
                                <input type="text" value="{{ $stockin->notes }}" name="notes" class="form-control form-control-md" placeholder="Notes / Remarks">
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
                                        @forelse($stockin->details as $key => $product)
                                        <tr>
                                            <td>
                                                {!! Form::select('category[]', $categories->pluck('name', 'id')->all(), $product->product->category_id, ['class' => 'form-control form-control-sm select2 selPdctCat', 'data-placeholder' => 'Category', 'required']) !!}
                                            </td>
                                            <td>
                                                {!! Form::select('subcategory[]', $subcategories->where('category_id', $product->product->category_id)->pluck('name', 'id'), $product->product->subcategory_id, ['class' => 'form-control form-control-sm select2 selProdSubcat', 'data-placeholder' => 'Subcategory', 'required']) !!}
                                            </td>
                                            <td>
                                                {!! Form::select('product[]', $products->where('subcategory_id', $product->product->subcategory_id)->pluck('name', 'id'), $product->product_id, ['class' => 'form-control form-control-sm select2 selProd', 'data-placeholder' => 'Product', 'required']) !!}
                                            </td>
                                            <td>
                                                {!! Form::text('qty[]', $product->qty, ['class' => 'form-control form-control-sm border-0 text-end', 'placeholder' => 'Qty', 'required']) !!}
                                            </td>
                                            <td class="text-center"><a href='javascript:void(0)' onclick='$(this).parent().parent().remove();'><i class='fa fa-times text-danger'></i></a></td>
                                        </tr>
                                        @empty
                                        @endforelse
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
                                <button type="submit" class="btn btn-primary btn-submit">Update</button>
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