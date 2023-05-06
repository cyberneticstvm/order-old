@extends("base")
@section("content")
<!-- Body: Header -->
<div class="body-header d-flex py-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-4 mt-1 mb-0">Income & Expense Head</h1>
                <small class="text-muted">Administration / Update Income & Expense Head</small>
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
                    <form action="{{ route('iehead.update', $head->id) }}" method="post">
                        @csrf
                        @method("PUT")
                        <div class="row g-4">
                            <div class="col-sm-4">
                                <label class="form-label req">Head Name</label>
                                <input type="text" value="{{ $head->name }}" name="name" class="form-control form-control-md" placeholder="Head Name">
                                @error('name')
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label req">Type</label>
                                <select class="form-control select2" name="type">
                                    <option value="">Select</option>
                                    <option value="Income" {{ ($head->type == 'Income') ? 'selected' : '' }}>Income</option>
                                    <option value="Expense" {{ ($head->type == 'Expense') ? 'selected' : '' }}>Expense</option>
                                </select>
                                @error('type')
                                <small class="text-danger">{{ $errors->first('type') }}</small>
                                @enderror
                            </div>                          
                            <div class="col-sm-6">
                                <label class="form-label">Description</label>
                                <input type="text" name="description" class="form-control" value="{{ $head->description }}" placeholder="Description">
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