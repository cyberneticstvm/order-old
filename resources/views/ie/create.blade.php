@extends("base")
@section("content")
<!-- Body: Header -->
<div class="body-header d-flex py-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-4 mt-1 mb-0">Create Income & Expense</h1>
                <small class="text-muted">Administration / Create Income & Expense</small>
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
                    <form action="{{ route('ie.create') }}" method="post">
                        @csrf
                        <div class="row g-4">
                            <div class="col-sm-2">
                                <label class="form-label req">Date</label>
                                <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}">
                                @error('date')
                                <small class="text-danger">{{ $errors->first('date') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label req">Head</label>
                                <select name="head" class="form-control show-tick ms select2">
                                    <option value="">Select</option>
                                    @forelse($heads as $key => $head)
                                        <option value="{{ $head->id }}" {{ (old('head') == $head->id) ? 'selected' : '' }}>{{ $head->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('head')
                                    <small class="text-danger">{{ $errors->first('head') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label req">Amount</label>
                                <input type="number" name="amount" class="form-control" step="any" placeholder="0.00">
                                @error('amount')
                                <small class="text-danger">{{ $errors->first('amount') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-5">
                                <label class="form-label">Description</label>
                                <input type="text" name="description" class="form-control" value="{{ old('description') }}" placeholder="Description">
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