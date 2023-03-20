@extends("base")
@section("content")
<!-- Body: Header -->
<div class="body-header d-flex py-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-4 mt-1 mb-0">Create Category</h1>
                <small class="text-muted">Inventory / Create Category</small>
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
                    <form action="{{ route('category.create') }}" method="post">
                        @csrf
                        <div class="row g-4">
                            <div class="col-sm-3">
                                <label class="form-label req">Category Name</label>
                                <input type="text" value="{{ old('name') }}" name="name" class="form-control form-control-md" placeholder="Category Name">
                                @error('name')
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label req">HSN</label>
                                <input type="text" value="{{ old('hsn') }}" name="hsn" class="form-control form-control-md" placeholder="HSN">
                                @error('hsn')
                                <small class="text-danger">{{ $errors->first('hsn') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label req">Tax %</label>
                                <input type="number" value="{{ old('tax_percentage') }}" name="tax_percentage" class="form-control form-control-md" placeholder="0.00 %">
                                @error('tax_percentage')
                                <small class="text-danger">{{ $errors->first('tax_percentage') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">Description</label>
                                <input type="text" value="{{ old('description') }}" name="description" class="form-control form-control-md" placeholder="Description">
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