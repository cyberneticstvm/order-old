@extends("base")
@section("content")
<!-- Body: Header -->
<div class="body-header d-flex py-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-4 mt-1 mb-0">Order Register</h1>
                <small class="text-muted">Order / Order Register</small>
            </div>
        </div>
    </div>
</div>
<!-- Body: Body -->
<div class="body d-flex py-lg-4 py-3">
    <div class="container">        
        <div class="row g-3 clearfix">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('order.show') }}" method="post">
                        @csrf
                        <div class="row g-4">
                            <div class="col-sm-3">
                                <label class="form-label">Medical Record ID (MR.ID)<sup class="text-danger">*</sup></label>
                                <input type="number" value="{{ old('medical_record_id') }}" name="medical_record_id" class="form-control form-control-md" placeholder="Mediical Record ID">
                                @error('medical_record_id')
                                <small class="text-danger">{{ $errors->first('medical_record_id') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label">&nbsp;</label>
                                <button type="submit" class="btn btn-primary btn-submit w-100">Fetch</button>
                            </div>
                        </div>                            
                    </form>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-body p-4">
                    <p class= "text-end my-3"><a href="/order/create"><i class="fa fa-plus fa-lg text-success fw-bold"></i></a></p>
                    @include("sections.message")
                    <table id="dataTbl" class="table table-striped table-hover align-middle table-sm">
                        <thead><tr><th>SL No</th><th>Edit</th><th>Delete</th></tr></thead>
                        <tbody>
                            @php $c = 1; @endphp
                            @forelse($orders as $key => $order)
                            <tr>
                                <td>{{ $c++ }}</td>
                                <td class="text-center"><a href="/order/edit/{{$order->id}}"><i class="fa fa-pencil text-warning"></i></a></td>
                                <td class="text-center">
                                    <form method="post" action="{{ route('order.delete', $order->id) }}">
                                        @csrf 
                                        @method("DELETE")
                                        <button type="submit" class="border no-border" onclick="javascript: return confirm('Are you sure want to delete this record?');"><i class="fa fa-trash text-danger"></i></button>
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