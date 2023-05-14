@extends("base")
@section("content")
<!-- Body: Header -->
<div class="body-header d-flex py-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-4 mt-1 mb-0">Update Role & Permissions</h1>
                <small class="text-muted">Roles & Permissions</small>
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
                    <form method="post" action="{{ route('role.update', $role->id) }}">
                        @csrf
                        @method("PUT")
                        <div class="row mb-3">
                            <div class="col-md-3 mb-3">
                                <label class="form-label req">Role Name </label>
                                {!! Form::text('name', $role->name, array('placeholder' => 'Role Name','class' => 'form-control')) !!}
                            </div>
                            @error('name')
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label req">Permissions </label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            @foreach($permission as $value)
                                <div class="col-sm-2 form-check form-check-inline">
                                    <label class="form-check-label" for="flexCheckDefault">{{ $value->name }}</label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name form-check-input')) }}
                                </div>
                            @endforeach
                            @error('permission')
                                <small class="text-danger mt-1">{{ $errors->first('permission') }}</small>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col text-end demo-inline-spacing">
                                <button type="submit" class="btn btn-primary btn-submit">
                                    <span class="tf-icons bx bx-check me-1"></span>Update
                                </button>
                                <button type="button" onclick="javascript:window.history.back();" class="btn btn-danger">
                                    <span class="tf-icons bx bx-redo me-1"></span>Cancel
                                </button>
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