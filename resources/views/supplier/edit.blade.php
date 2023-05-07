@extends("base")
@section("content")
<!-- Body: Header -->
<div class="body-header d-flex py-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-4 mt-1 mb-0">Update Supplier</h1>
                <small class="text-muted">Administration / Update Supplier</small>
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
                    <form action="{{ route('supplier.update', $supplier->id) }}" method="post">
                        @csrf
                        @method("PUT")
                        <div class="row g-4">
                            <div class="col-sm-4">
                                <label class="form-label req">Supplier Name</label>
                                <input type="text" value="{{ $supplier->name }}" name="name" class="form-control form-control-md" placeholder="Supplier Name">
                                @error('name')
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label">Email</label>
                                <input type="email" value="{{ $supplier->email }}" name="email" class="form-control form-control-md" placeholder="Email">
                            </div>
                            <div class="col-sm-5">
                                <label class="form-label req">Address</label>
                                <input type="text" name="address" class="form-control" value="{{ $supplier->address }}" placeholder="Address">
                                @error('address')
                                <small class="text-danger">{{ $errors->first('address') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label">Mobile</label>
                                <input type="text" name="mobile" class="form-control" value="{{ $supplier->mobile }}" placeholder="Mobile" maxlength="10">
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