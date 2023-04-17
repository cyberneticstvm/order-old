@extends("base")
@section("content")
<!-- Body: Header -->
<div class="body-header d-flex py-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-4 mt-1 mb-0">Create Order</h1>
                <small class="text-muted">Order / Create Order</small>
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
                    <form action="{{ route('order.create') }}" method="post">
                        @csrf
                        <input type="hidden" name="doctor_id" value="{{ ($mrecord) ? $mrecord->doctor_id : 0 }}" />
                        <input type="hidden" name="patient_id" value="{{ ($patient) ? $patient->id : 0 }}" />
                        <div class="row g-4">
                            <div class="col-sm-2">
                                <label class="form-label req">Order Date</label>
                                <input type="date" value="{{ date('Y-m-d') }}" name="order_date" class="form-control form-control-md" placeholder="Order Date" >
                                @error('order_date')
                                <small class="text-danger">{{ $errors->first('order_date') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label req">Medical Record ID</label>
                                <input type="text" value="{{ ($mrecord) ? $mrecord->id : 0 }}" name="medical_record_id" class="form-control form-control-md" placeholder="MR id" readonly>
                                @error('medical_record_id')
                                <small class="text-danger">{{ $errors->first('medical_record_id') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label req">Patient Name</label>
                                <input type="text" value="{{ ($patient) ? $patient->patient_name : '' }}" name="patient_name" class="form-control form-control-md" placeholder="Patient Name">
                                @error('patient_name')
                                <small class="text-danger">{{ $errors->first('patient_name') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label req">Age</label>
                                <input type="number" value="{{ ($patient) ? $patient->age : '' }}" name="age" class="form-control form-control-md" placeholder="0">
                                @error('age')
                                <small class="text-danger">{{ $errors->first('age') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label req">Gender</label>
                                <select class="form-control">
                                    <option value="">Select</option>
                                    <option value="male" {{ ($patient && $patient->gender == 'male') ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ ($patient && $patient->gender == 'female') ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ ($patient && $patient->gender == 'other') ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('age')
                                <small class="text-danger">{{ $errors->first('age') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label req">Mobile</label>
                                <input type="text" value="{{ ($patient) ? $patient->mobile_number : '' }}" name="mobile" class="form-control form-control-md" maxlength="10" placeholder="Mobile">
                                @error('age')
                                <small class="text-danger">{{ $errors->first('age') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label req">Expected Del. Date</label>
                                <input type="date" value="{{ date('Y-m-d') }}" name="expected_delivery_date" class="form-control form-control-md" placeholder="Del. Date" >
                                @error('expected_delivery_date')
                                <small class="text-danger">{{ $errors->first('expected_delivery_date') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label req">Product Advisor</label>
                                {!! Form::select('product_advisor', $users->pluck('name', 'id')->all(),  Auth::user()->id, ['class' => 'form-control form-control-sm select2 border-0', 'placeholder' => 'Select']) !!}
                                @error('expected_delivery_date')
                                <small class="text-danger">{{ $errors->first('expected_delivery_date') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label req">Order Status</label>
                                {!! Form::select('order_status', $status->pluck('name', 'id')->all(),  '', ['class' => 'form-control form-control-sm select2 border-0', 'placeholder' => 'OrderStatus']) !!}
                                @error('order_status')
                                <small class="text-danger">{{ $errors->first('order_status') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <h5 class="text-primary mb-1">Prescription</h5>
                            <div class="col-12 table-responsive mt-3">
                                <table class="table table-bordered table-sm">
                                    <thead><tr><th>Eye</th><th>Sph</th><th>Cyl</th><th>Axis</th><th>Add</th><th width="40%">Product</th><th>Qty</th><th>Price</th><th>Total</th></tr></thead>
                                    <tbody>
                                        <tr>
                                            <td>RE</td>
                                            <td><input type="text" class="form-control form-control-sm border-0" placeholder="Sph" name="re_sph" value="{{ ($spectacle) ? $spectacle->re_dist_sph : '' }}"></td>
                                            <td><input type="text" class="form-control form-control-sm border-0" placeholder="Cyl" name="re_cyl" value="{{ ($spectacle) ? $spectacle->re_dist_cyl : '' }}"></td>
                                            <td><input type="text" class="form-control form-control-sm border-0" placeholder="Axis" name="re_axis" value="{{ ($spectacle) ? $spectacle->re_dist_axis : '' }}"></td>
                                            <td><input type="text" class="form-control form-control-sm border-0" placeholder="Add" name="re_add" value="{{ ($spectacle) ? $spectacle->re_dist_add : '' }}"></td>
                                            <td>
                                                {!! Form::select('re_lens', $products->pluck('name', 'id')->all(),  '', ['class' => 'form-control form-control-sm select2 border-0', 'placeholder' => 'Select']) !!}
                                            </td>
                                            <td><input type="number" class="form-control form-control-sm border-0 text-end" name="" placeholder="0" /></td>
                                            <td><input type="number" class="form-control form-control-sm border-0 text-end" name="" placeholder="0.00" /></td>
                                            <td><input type="number" class="form-control form-control-sm border-0 text-end" name="" placeholder="0.00" /></td>
                                        </tr>
                                        <tr>
                                            <td>LE</td>
                                            <td><input type="text" class="form-control form-control-sm border-0" placeholder="Sph" name="le_sph" value="{{ ($spectacle) ? $spectacle->le_dist_sph : '' }}"></td>
                                            <td><input type="text" class="form-control form-control-sm border-0" placeholder="Cyl" name="le_cyl" value="{{ ($spectacle) ? $spectacle->le_dist_cyl : '' }}"></td>
                                            <td><input type="text" class="form-control form-control-sm border-0" placeholder="Axis" name="le_axis" value="{{ ($spectacle) ? $spectacle->le_dist_axis : '' }}"></td>
                                            <td><input type="text" class="form-control form-control-sm border-0" placeholder="Add" name="le_add" value="{{ ($spectacle) ? $spectacle->le_dist_add : '' }}"></td>
                                            <td>
                                                {!! Form::select('le_lens', $products->pluck('name', 'id')->all(),  '', ['class' => 'form-control select2', 'placeholder' => 'Select']) !!}
                                            </td>
                                            <td><input type="number" class="form-control form-control-sm border-0 text-end" name="" placeholder="0" /></td>
                                            <td><input type="number" class="form-control form-control-sm border-0 text-end" name="" placeholder="0.00" /></td>
                                            <td><input type="number" class="form-control form-control-sm border-0 text-end" name="" placeholder="0.00" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">Frame</td>
                                            <td>
                                                {!! Form::select('frame', $products->pluck('name', 'id')->all(),  '', ['class' => 'form-control select2', 'placeholder' => 'Select']) !!}
                                            </td>
                                            <td><input type="number" class="form-control form-control-sm border-0 text-end" name="" placeholder="0" /></td>
                                            <td><input type="number" class="form-control form-control-sm border-0 text-end" name="" placeholder="0.00" /></td>
                                            <td><input type="number" class="form-control form-control-sm border-0 text-end" name="" placeholder="0.00" /></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <td colspan="8" class="text-end">Order Total</td>
                                            <td class="fw-bold text-end"><input type="number" class="form-control form-control-sm border-0 text-end" placeholder="0.00" name="order_total" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="8" class="text-end">Discount</td>
                                            <td class="fw-bold"><input type="number" class="form-control form-control-sm border-0 text-end" name="discount" placeholder="0.00" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="8" class="text-end">Net Total</td>
                                            <td class="fw-bold text-end"><input type="number" class="form-control form-control-sm border-0 text-end" name="total_after_discount" placeholder="0.00" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" class="text-end">Advance</td>
                                            <td>
                                                {!! Form::select('advance_payment_type', $pmodes->pluck('name', 'id')->all(),  '', ['class' => 'form-control select2', 'placeholder' => 'PaymentMode']) !!}
                                            </td>
                                            <td class="fw-bold text-end"><input type="number" class="form-control form-control-sm border-0 text-end" name="advance" placeholder="0.00" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" class="text-end">Balance</td>
                                            <td>
                                                {!! Form::select('balance_payment_type', $pmodes->pluck('name', 'id')->all(),  '', ['class' => 'form-control select2', 'placeholder' => 'PaymentMode']) !!}
                                            </td>
                                            <td class="fw-bold text-end"><input type="number" class="form-control form-control-sm border-0 text-end" name="balance" placeholder="0.00" /></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label">Order Notes / Remarks</label>
                                <textarea class="form-control" name="notes" placeholder="Order Notes / Remarks"></textarea>
                            </div>                            
                        </div>
                        <div class="row mt-3">
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