@extends("base")
@section("content")
<!-- Body: Header -->
<div class="body-header d-flex py-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-4 mt-1 mb-0">Update Order</h1>
                <small class="text-muted">Order / Update Order</small>
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
                    <form action="{{ route('order.update', $order->id) }}" method="post">
                        @csrf
                        @method("PUT")
                        <input type="hidden" name="doctor_id" value="{{ $order->doctor_id }}" />
                        <input type="hidden" name="patient_id" value="{{ $order->patient_id }}" />
                        <div class="row g-4">
                            <div class="col-sm-2">
                                <label class="form-label req">Order Date</label>
                                <input type="date" value="{{ $order->order_date->format('Y-m-d') }}" name="order_date" class="form-control form-control-md" placeholder="Order Date" >
                                @error('order_date')
                                <small class="text-danger">{{ $errors->first('order_date') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label req">Medical Record ID</label>
                                <input type="text" value="{{ $order->medical_record_id }}" name="medical_record_id" class="form-control form-control-md" placeholder="MR id" readonly>
                                @error('medical_record_id')
                                <small class="text-danger">{{ $errors->first('medical_record_id') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label req">Patient Name</label>
                                <input type="text" value="{{ $order->patient_name }}" name="patient_name" class="form-control form-control-md" placeholder="Patient Name">
                                @error('patient_name')
                                <small class="text-danger">{{ $errors->first('patient_name') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label req">Age</label>
                                <input type="number" value="{{ $order->age }}" name="age" class="form-control form-control-md" placeholder="0">
                                @error('age')
                                <small class="text-danger">{{ $errors->first('age') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label req">Gender</label>
                                <select class="form-control" name="gender">
                                    <option value="">Select</option>
                                    <option value="male" {{ ($order->gender == 'male') ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ ($order->gender == 'female') ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ ($order->gender == 'other') ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('gender')
                                <small class="text-danger">{{ $errors->first('gender') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label req">Mobile</label>
                                <input type="text" value="{{ $order->mobile }}" name="mobile" class="form-control form-control-md" maxlength="10" placeholder="Mobile">
                                @error('mobile')
                                <small class="text-danger">{{ $errors->first('mobile') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label req">Address</label>
                                <input type="text" value="{{ $order->address }}" name="address" class="form-control form-control-md" placeholder="Address" />
                                @error('address')
                                <small class="text-danger">{{ $errors->first('address') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label req">Expected Del. Date</label>
                                <input type="date" value="{{ $order->expected_delivery_date->format('Y-m-d') }}" name="expected_delivery_date" class="form-control form-control-md" placeholder="Del. Date" >
                                @error('expected_delivery_date')
                                <small class="text-danger">{{ $errors->first('expected_delivery_date') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label req">Product Advisor</label>
                                {!! Form::select('product_advisor', $users->pluck('name', 'id')->all(),  $order->product_advisor, ['class' => 'form-control form-control-sm select2 border-0', 'placeholder' => 'Select']) !!}
                                @error('product_advisor')
                                <small class="text-danger">{{ $errors->first('product_advisor') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label req">Order Status</label>
                                {!! Form::select('order_status', $status->pluck('name', 'id')->all(),  $order->order_status, ['class' => 'form-control form-control-sm select2 border-0', 'placeholder' => 'OrderStatus']) !!}
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
                            <div class="col-md-6">
                                <h5 class="text-primary mb-1 text-center"><strong>Prescription</strong></h5>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Add New Item</label>
                                {!! Form::select('sel_category_for_add_item', $categories->pluck('fill_name', 'id')->all(),  '', ['class' => 'form-control form-control-sm select2 sel_category_for_add_item', 'placeholder' => 'Category']) !!}
                            </div>
                            <div class="col-12 table-responsive mt-3">
                                <table class="tblOrder table table-bordered table-sm">
                                    <thead><tr><th>Eye</th><th>Sph</th><th>Cyl</th><th>Axis</th><th>Add</th><th width="34%">Product</th><th>Qty</th><th width="7%">MRP</th><th>Tax %</th><th width="5%">Disc.%</th><th width="8%">Total</th><th></th></tr></thead>
                                    <tbody>
                                        @forelse($order->orderdetails as $key => $value)
                                            <tr>
                                                <td><input type="text" name="type[]" value="{{ $value->product_type }}" class="form-control form-control-sm border-0" readonly/></td>
                                                @if($value->product_type == 'RE' || $value->product_type == 'LE')
                                                    <td><input type="text" class="form-control form-control-sm border-0" placeholder="Sph" name="sph[]" value="{{ $value->sph }}"></td>
                                                    <td><input type="text" class="form-control form-control-sm border-0" placeholder="Cyl" name="cyl[]" value="{{ $value->cyl }}"></td>
                                                    <td><input type="text" class="form-control form-control-sm border-0" placeholder="Axis" name="axis[]" value="{{ $value->axis }}"></td>
                                                    <td><input type="text" class="form-control form-control-sm border-0" placeholder="Add" name="add[]" value="{{ $value->addition }}"></td>
                                                @else
                                                    <td colspan="4"><input type='hidden' name='sph[]' value='' /><input type='hidden' name='cyl[]' value='' /><input type='hidden' name='axis[]' value='' /><input type='hidden' name='add[]' value='' /></td>
                                                @endif
                                                <td>
                                                    {!! Form::select('product[]', $products->pluck('full_name', 'id')->all(), $value->product_id, ['class' => 'form-control form-control-sm select2 selLens', 'placeholder' => 'Select']) !!}
                                                </td>
                                                <td><input type="number" step='any' class="form-control form-control-sm border-0 text-end qty" name="qty[]" placeholder="0" value="{{ $value->qty }}" /></td>
                                                <td><input type="number" step='any' class="form-control form-control-sm border-0 text-end price" name="price[]" placeholder="0.00" value="{{ $value->price }}" /></td>
                                                <td><input type="number" step='any' class="form-control form-control-sm border-0 text-end tax_per" name="tax_per[]" placeholder="0%" value="{{ $value->tax_percentage }}" /></td>
                                                <td><input type="number" step='any' class="form-control form-control-sm border-0 text-end disc_per" name="disc_per[]" placeholder="0%" value="{{ $value->discount_percentage }}" /></td>
                                                <td><input type="number" step='any' class="form-control form-control-sm border-0 text-end total" name="total[]" placeholder="0.00" value="{{ $value->total }}" /></td>
                                                <td><a href='javascript:void(0)' onclick="$(this).parent().parent().remove();calculateTotal();"><i class='fa fa-times text-danger'></i></a></td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <td colspan="10" class="text-end">Order Total</td>
                                            <td class="fw-bold text-end">
                                                <input type="number" step='any' class="form-control form-control-sm border-0 text-end otot" placeholder="0.00" name="order_total" value="{{ $order->order_total }}" />
                                            </td>
                                            <td>
                                            @error('order_total')
                                            <small class="text-danger">{{ $errors->first('order_total') }}</small>
                                            @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="10" class="text-end">Discount</td>
                                            <td class="fw-bold"><input type="number" step='any' class="form-control form-control-sm border-0 text-end discount" name="discount" placeholder="0.00" value="{{ $order->discount }}" /></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="10" class="text-end">Total After Discount</td>
                                            <td class="fw-bold text-end">
                                                <input type="number" step='any' class="form-control form-control-sm border-0 text-end nettot" name="total_after_discount" placeholder="0.00" value="{{ $order->total_after_discount }}" />                                                
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
                                                <input type="number" step='any' class="form-control form-control-sm border-0 text-end tax" name="tax_amount" placeholder="0.00" value="{{ $order->tax_amount }}" />                                                
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
                                                <input type="number" step='any' class="form-control form-control-sm border-0 text-end amount_due fw-bold" name="net_total" placeholder="0.00" value="{{ $order->net_total }}" />                                                
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
                                                {!! Form::select('advance_payment_type', $pmodes->pluck('name', 'id')->all(),  $order->advance_payment_type, ['class' => 'form-control select2', 'placeholder' => 'PaymentMode']) !!}
                                                
                                            </td>
                                            <td class="fw-bold text-end"><input type="number" step='any' class="form-control form-control-sm border-0 text-end advance" name="advance" placeholder="0.00" value="{{ $order->advance }}" /></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="9" class="text-end">Balance</td>
                                            <td>
                                                {!! Form::select('balance_payment_type', $pmodes->pluck('name', 'id')->all(),  $order->balance_payment_type, ['class' => 'form-control select2', 'placeholder' => 'PaymentMode']) !!}
                                            </td>
                                            <td class="fw-bold text-end"><input type="number" step='any' class="form-control form-control-sm border-0 text-end balance" name="balance" placeholder="0.00" value="{{ $order->balance }}" /></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label">Order Notes / Remarks</label>
                                <textarea class="form-control" name="notes" placeholder="Order Notes / Remarks">{{ $order->notes }}</textarea>
                            </div>                            
                        </div>
                        <div class="row mt-3">
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