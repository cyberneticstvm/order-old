@extends("base")
@section("content")
<!-- Body: Header -->
<div class="body-header d-flex py-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-4 mt-1 mb-0">Update Product</h1>
                <small class="text-muted">Inventory / Update Product</small>
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
                    <form action="{{ route('product.update', $product->id) }}" method="post">
                        @csrf
                        @method("PUT")
                        <div class="row g-4">
                            <div class="col-sm-4">
                                <label class="form-label req">Product Name</label>
                                <input type="text" value="{{ $product->name }}" name="name" class="form-control form-control-md" placeholder="Full Name">
                                @error('name')
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label req">Category</label>
                                <select name="category_id" class="form-control show-tick ms select2">
                                    <option value="">Select</option>
                                    @forelse($categories as $key => $cat)
                                        <option value="{{ $cat->id }}" {{ ($product->category_id == $cat->id) ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('category_id')
                                    <small class="text-danger">{{ $errors->first('category_id') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label req">Subcategory</label>
                                <select name="subcategory_id" class="form-control show-tick ms select2">
                                    <option value="">Select</option>
                                    @forelse($subcategories as $key => $sub)
                                        <option value="{{ $sub->id }}" {{ ($product->subcategory_id == $sub->id) ? 'selected' : '' }}>{{ $sub->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('subcategory_id')
                                    <small class="text-danger">{{ $errors->first('subcategory_id') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label">Discount %</label>
                                <input type="number" name="discount_percentage" value="{{ $product->discount_percentage }}" class="form-control" min="0" max="100" step="any" placeholder="0.0 %">
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label req">MRP</label>
                                <input type="number" name="mrp" class="form-control" step="any" value="{{ $product->mrp }}" placeholder="0.0">
                                @error('mrp')
                                    <small class="text-danger">{{ $errors->first('mrp') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label req">Product Status</label>
                                <select name="status" class="form-control show-tick ms select2">
                                    <option value="">Select</option>
                                    <option value="1" {{ ($product->status == 1) ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ ($product->status == 0) ? 'selected' : '' }}>Inactive</option>                                    
                                </select>
                                @error('status')
                                    <small class="text-danger">{{ $errors->first('status') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-8">
                                <label class="form-label">Product Description</label>
                                <input type="text" name="description" class="form-control" value="{{ $product->description }}" placeholder="Product Description">
                            </div>
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