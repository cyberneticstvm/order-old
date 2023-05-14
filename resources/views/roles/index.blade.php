@extends("base")
@section("content")
<!-- Body: Header -->
<div class="body-header d-flex py-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-4 mt-1 mb-0">Roles & Permissions</h1>
                <small class="text-muted">Role / Roles & Permissions List</small>
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
                    <p class= "text-end my-3"><a href="/role/create/"><i class="fa fa-plus fa-lg text-success fw-bold"></i></a></p>
                    @include("sections.message")
                    <table id="dataTbl" class="table table-striped table-hover align-middle table-sm">
                        <thead><tr><th>SL No</th><th>Role Name</th><th>Edit</th><th>Delete</th></tr></thead>
                        <tbody>
                            @php $c = 1; @endphp
                            @forelse($roles as $key => $role)
                                <tr>
                                    <td>{{ $c++ }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td class="text-center"><a href="/role/edit/{{ encrypt($role->id) }}"><i class="fa fa-pencil text-warning"></i></a></td>
                                    <td class="text-center">
                                        <form method="post" action="{{ route('role.delete', $role->id) }}">
                                            @csrf 
                                            @method("DELETE")
                                            <button type="submit" class="border no-border" onclick="javascript: return confirm('Are you sure want to delete this record?');"><i class="fa fa-times text-danger"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- .row end -->
    </div>
</div>
@endsection