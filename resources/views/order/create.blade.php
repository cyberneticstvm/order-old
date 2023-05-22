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
                    <form action="{{ route('order.create', ($mrecord) ? $mrecord->id : 0) }}" method="post">
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
                                <select class="form-control" name="gender">
                                    <option value="">Select</option>
                                    <option value="male" {{ ($patient && $patient->gender == 'male') ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ ($patient && $patient->gender == 'female') ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ ($patient && $patient->gender == 'other') ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('gender')
                                <small class="text-danger">{{ $errors->first('gender') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label req">Mobile</label>
                                <input type="text" value="{{ ($patient) ? $patient->mobile_number : '' }}" name="mobile" class="form-control form-control-md" maxlength="10" placeholder="Mobile">
                                @error('mobile')
                                <small class="text-danger">{{ $errors->first('mobile') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label req">Address</label>
                                <input type="text" value="{{ ($patient) ? $patient->address : '' }}" name="address" class="form-control form-control-md" placeholder="Address" />
                                @error('address')
                                <small class="text-danger">{{ $errors->first('address') }}</small>
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
                                @error('product_advisor')
                                <small class="text-danger">{{ $errors->first('product_advisor') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label req">Order Status</label>
                                {!! Form::select('order_status', $status->pluck('name', 'id')->all(),  1, ['class' => 'form-control form-control-sm select2 border-0', 'placeholder' => 'OrderStatus']) !!}
                                @error('order_status')
                                <small class="text-danger">{{ $errors->first('order_status') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                @error('product')
                                <small class="text-danger">{{ $errors->first('product') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Barcode Input</label>
                                <input type="text" class="form-control" name="" id="bcodepdct" placeholder="Barcode Input" />
                            </div>
                            <div class="col-md-6"><h5 class="text-primary mb-1 text-center"><strong>Prescription</strong></h5></div>
                            <div class="col-md-3">
                                <label class="form-label">Add New Item</label>
                                {!! Form::select('sel_category_for_add_item', $categories->pluck('name', 'id')->all(),  '', ['class' => 'form-control form-control-sm select2 sel_category_for_add_item', 'placeholder' => 'Category']) !!}
                            </div>
                            <div class="col-12 table-responsive mt-3">
                                <table class="tblOrder table table-bordered table-sm">
                                    <thead><tr><th>Eye</th><th>Sph</th><th>Cyl</th><th>Axis</th><th>Add</th><th width="34%">Product</th><th>Qty</th><th width="7%">MRP</th><th>Tax %</th><th width="5%">Disc.%</th><th width="8%">Total</th><th></th></tr></thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" name="type[]" value="RE" class="form-control form-control-sm border-0" readonly/></td>
                                            <td><input type="text" class="form-control form-control-sm border-0" placeholder="Sph" name="sph[]" value="{{ ($spectacle) ? $spectacle->re_dist_sph : '' }}"></td>
                                            <td><input type="text" class="form-control form-control-sm border-0" placeholder="Cyl" name="cyl[]" value="{{ ($spectacle) ? $spectacle->re_dist_cyl : '' }}"></td>
                                            <td><input type="text" class="form-control form-control-sm border-0" placeholder="Axis" name="axis[]" value="{{ ($spectacle) ? $spectacle->re_dist_axis : '' }}"></td>
                                            <td><input type="text" class="form-control form-control-sm border-0" placeholder="Add" name="add[]" value="{{ ($spectacle) ? $spectacle->re_dist_add : '' }}"></td>
                                            <td>
                                                {!! Form::select('product[]', $products->whereIn('category_id', [2,3])->pluck('full_name', 'id')->all(), 0, ['class' => 'form-control form-control-sm select2 selLens', 'placeholder' => 'Select']) !!}
                                            </td>
                                            <td><input type="number" class="form-control form-control-sm border-0 text-end qty" name="qty[]" step='any' placeholder="0" /></td>
                                            <td><input step='any' type="number" class="form-control form-control-sm border-0 text-end price" name="price[]" placeholder="0.00" /></td>
                                            <td><input step='any' type="number" class="form-control form-control-sm border-0 text-end tax_per" name="tax_per[]" placeholder="0%" /></td>
                                            <td><input step='any' type="number" class="form-control form-control-sm border-0 text-end disc_per" name="disc_per[]" placeholder="0%" /></td>
                                            <td><input step='any' type="number" class="form-control form-control-sm border-0 text-end total" name="total[]" placeholder="0.00" /></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="type[]" value="LE" class="form-control form-control-sm border-0" readonly/></td>
                                            <td><input type="text" class="form-control form-control-sm border-0" placeholder="Sph" name="sph[]" value="{{ ($spectacle) ? $spectacle->le_dist_sph : '' }}"></td>
                                            <td><input type="text" class="form-control form-control-sm border-0" placeholder="Cyl" name="cyl[]" value="{{ ($spectacle) ? $spectacle->le_dist_cyl : '' }}"></td>
                                            <td><input type="text" class="form-control form-control-sm border-0" placeholder="Axis" name="axis[]" value="{{ ($spectacle) ? $spectacle->le_dist_axis : '' }}"></td>
                                            <td><input type="text" class="form-control form-control-sm border-0" placeholder="Add" name="add[]" value="{{ ($spectacle) ? $spectacle->le_dist_add : '' }}"></td>
                                            <td>
                                                {!! Form::select('product[]', $products->whereIn('category_id', [2,3])->pluck('full_name', 'id')->all(), 0, ['class' => 'form-control select2 selLens', 'placeholder' => 'Select']) !!}
                                            </td>
                                            <td><input type="number" step='any' class="form-control form-control-sm border-0 text-end qty" name="qty[]" placeholder="0" /></td>
                                            <td><input type="number" step='any' class="form-control form-control-sm border-0 text-end price" name="price[]" placeholder="0.00" /></td>
                                            <td><input type="number" step='any' class="form-control form-control-sm border-0 text-end tax_per" name="tax_per[]" placeholder="0%" /></td>
                                            <td><input type="number" step='any' class="form-control form-control-sm border-0 text-end disc_per" name="disc_per[]" placeholder="0%" /></td>
                                            <td><input type="number" class="form-control form-control-sm border-0 text-end total" name="total[]" step='any' placeholder="0.00" /></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <input type="text" name="type[]" value="FRAME" class="form-control form-control-sm border-0" readonly/>
                                                <input type='hidden' name='sph[]' value='' /><input type='hidden' name='cyl[]' value='' /><input type='hidden' name='axis[]' value='' /><input type='hidden' name='add[]' value='' />
                                            </td>
                                            <td colspan="3">
                                                <input type="text" class="form-control" name="" id="bcodeFrame" placeholder="Barcode Input" />
                                            </td>
                                            <td>
                                                {!! Form::select('product[]', $products->whereIn('category_id', [1])->pluck('full_name', 'id')->all(), 0, ['class' => 'form-control select2 selFrame', 'placeholder' => 'Select']) !!}
                                            </td>
                                            <td><input type="number" step='any' class="form-control form-control-sm border-0 text-end qty" name="qty[]" placeholder="0" /></td>
                                            <td><input type="number" step='any' class="form-control form-control-sm border-0 text-end price" name="price[]" placeholder="0.00" /></td>
                                            <td><input type="number" step='any' class="form-control form-control-sm border-0 text-end tax_per" name="tax_per[]" placeholder="0%" /></td>
                                            <td><input type="number" step='any' class="form-control form-control-sm border-0 text-end disc_per" name="disc_per[]" placeholder="0%" /></td>
                                            <td><input type="number" step='any' class="form-control form-control-sm border-0 text-end total" name="total[]" placeholder="0.00" /></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <td colspan="10" class="text-end">Order Total</td>
                                            <td class="fw-bold text-end">
                                                <input type="number" step='any' class="form-control form-control-sm border-0 text-end otot" placeholder="0.00" name="order_total" value="{{ old('order_total') }}" />
                                            </td>
                                            <td>
                                            @error('order_total')
                                            <small class="text-danger">{{ $errors->first('order_total') }}</small>
                                            @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="10" class="text-end">Discount</td>
                                            <td class="fw-bold"><input type="number" step='any' class="form-control form-control-sm border-0 text-end discount" name="discount" placeholder="0.00" value="{{ old('discount') }}" /></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="10" class="text-end">Total After Discount</td>
                                            <td class="fw-bold text-end">
                                                <input type="number" class="form-control form-control-sm border-0 text-end nettot" name="total_after_discount" step='any' placeholder="0.00" value="{{ old('total_after_discount') }}" />                                                
                                            </td>
                                            <td>
                                                @error('total_after_discount')
                                                <small class="text-danger">{{ $errors->first('total_after_discount') }}</small>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="10" class="text-end">Tax Amount</td>
                                            <td class="fw-bold text-end">
                                                <input type="number" step='any' class="form-control form-control-sm border-0 text-end tax" name="tax_amount" placeholder="0.00" value="{{ old('tax') }}" />                                                
                                            </td>
                                            <td>
                                                @error('tax_amount')
                                                <small class="text-danger">{{ $errors->first('tax_amount') }}</small>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="10" class="text-end fw-bold">Net Total</td>
                                            <td class="fw-bold text-end">
                                                <input type="number" step='any' class="form-control form-control-sm border-0 text-end amount_due fw-bold" name="net_total" placeholder="0.00" value="{{ old('net_total') }}" />                                                
                                            </td>
                                            <td>
                                                @error('net_total')
                                                <small class="text-danger">{{ $errors->first('net_total') }}</small>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="9" class="text-end">
                                                Advance
                                                @error('advance_payment_type')
                                                <small class="text-danger">{{ $errors->first('advance_payment_type') }}</small>
                                                @enderror
                                            </td>
                                            <td>
                                                {!! Form::select('advance_payment_type', $pmodes->pluck('name', 'id')->all(),  '', ['class' => 'form-control select2', 'placeholder' => 'PaymentMode']) !!}
                                                
                                            </td>
                                            <td class="fw-bold text-end"><input type="number" step='any' class="form-control form-control-sm border-0 text-end advance" name="advance" placeholder="0.00" value="{{ old('advance') }}" /></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="9" class="text-end">Balance</td>
                                            <td>
                                                {!! Form::select('balance_payment_type', $pmodes->pluck('name', 'id')->all(),  '', ['class' => 'form-control select2', 'placeholder' => 'PaymentMode']) !!}
                                            </td>
                                            <td class="fw-bold text-end"><input type="number" step='any' class="form-control form-control-sm border-0 text-end balance" name="balance" placeholder="0.00" value="{{ old('balance') }}" /></td>
                                            <td></td>
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