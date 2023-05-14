@extends("base")
@section("content")
<!-- Body: Header -->
<div class="body-header d-flex py-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-4 mt-1 mb-0">Create User</h1>
                <small class="text-muted">User / Create User</small>
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
                    <form action="{{ route('user.create') }}" method="post">
                        @csrf
                        <div class="row g-4">
                            <div class="col-sm-3">
                                <label class="form-label req">Full Name</label>
                                <input type="text" value="{{ old('name') }}" name="name" class="form-control form-control-md" placeholder="Full Name">
                                @error('name')
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label req">Email</label>
                                <input type="email" value="{{ old('email') }}" name="email" class="form-control form-control-md" placeholder="Email">
                                @error('email')
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label req">User Role</label>
                                {!! Form::select('roles', $roles, null, array('placeholder' => 'Select','class' => 'form-control select2')) !!}
                                @error('roles')
                                    <small class="text-danger">{{ $errors->first('roles') }}</small>
                                @enderror
                            </div>                            
                            <div class="col-sm-3">
                                <label class="form-label req">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="******">
                                @error('password')
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label req">User Branches</label>
                                    {!! Form::select('branch[]', $branches, null, array('class' => 'form-control select2', 'multiple' => 'multiple', 'data-placeholder' => 'Select Branch')) !!}
                                @error('branch')
                                    <small class="text-danger">{{ $errors->first('branch') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label req">User Status</label>
                                <select name="status" class="form-control show-tick ms select2">
                                    <option value="">Select</option>
                                    <option value="1" {{ (old('status') == 1) ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ (old('status') == 0) ? 'selected' : '' }}>Inactive</option>                                    
                                </select>
                                @error('status')
                                    <small class="text-danger">{{ $errors->first('status') }}</small>
                                @enderror
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