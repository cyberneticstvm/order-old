$(function(){
    "use strict"

    var branch = $("#branch_selector").val();
    if(!branch){
        $(".branchSelector").modal({backdrop: 'static'});
        $(".branchSelector").modal({keyboard: false});
        $(".branchSelector").modal("show");
    }

    $('form').submit(function(){
        $(".btn-submit").attr("disabled", true);
        $(".btn-submit").html("<span class='spinner-grow spinner-grow-sm' role='status' aria-hidden='true'></span>");
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#dataTbl").dataTable();

    $('.select2').select2({
        placeholder: 'Select'
    });

    $(".sel_category_for_add_item").change(function(){
        var category = $(this).val();
        if(category == 1){ // Frames
            $(".tblOrder tbody").append("<tr><td colspan='5'><input type='text' value='FRAME' name='type[]' class='form-control form-control-sm border-0' readonly /><input type='hidden' name='sph[]' value='' /><input type='hidden' name='cyl[]' value='' /><input type='hidden' name='axis[]' value='' /><input type='hidden' name='add[]' value='' /></td><td><select class='form-control form-control-md select2 selFrame' data-placeholder='Select' name='product[]' required='required'><option value=''>Select</option></select></td><td><input type='number' class='form-control form-control-sm border-0 text-end qty' name='qty[]' placeholder='0' /></td><td><input type='number' class='form-control form-control-sm border-0 text-end price' name='price[]' placeholder='0.00' /></td><td><input type='number' class='form-control form-control-sm border-0 text-end total' name='total[]' placeholder='0.00' /></td><td><a href='javascript:void(0)' onclick='$(this).parent().parent().remove();calculateTotal();'><i class='fa fa-times text-danger'></i></a></td></tr>");
            bindDDL(category, 'selFrame');
        }
        if(category == 2 || category == 3){ // Lenses
            $(".tblOrder tbody").append("<tr><td><input type='text' value='RE' name='type[]' class='form-control form-control-sm border-0' readonly /></td><td><input type='text' class='form-control form-control-sm border-0' placeholder='Sph' name='sph[]'></td><td><input type='text' class='form-control form-control-sm border-0' placeholder='Cyl' name='cyl[]'></td><td><input type='text' class='form-control form-control-sm border-0' placeholder='Axis' name='axis[]'></td><td><input type='text' class='form-control form-control-sm border-0' placeholder='Add' name='add[]'></td><td><select class='form-control form-control-md select2 selLens' data-placeholder='Select' name='product[]' required='required'><option value=''>Select</option></select></td><td><input type='number' class='form-control form-control-sm border-0 text-end qty' name='qty[]' placeholder='0' /></td><td><input type='number' class='form-control form-control-sm border-0 text-end price' name='price[]' placeholder='0.00' /></td><td><input type='number' class='form-control form-control-sm border-0 text-end total' name='total[]' placeholder='0.00' /></td><td><a href='javascript:void(0)' onclick='$(this).parent().parent().remove();calculateTotal();'><i class='fa fa-times text-danger'></i></a></td></tr>");
            $(".tblOrder tbody").append("<tr><td><input type='text' value='LE' name='type[]' class='form-control form-control-sm border-0' readonly /></td><td><input type='text' class='form-control form-control-sm border-0' placeholder='Sph' name='sph[]'></td><td><input type='text' class='form-control form-control-sm border-0' placeholder='Cyl' name='cyl[]'></td><td><input type='text' class='form-control form-control-sm border-0' placeholder='Axis' name='axis[]'></td><td><input type='text' class='form-control form-control-sm border-0' placeholder='Add' name='add[]'></td><td><select class='form-control form-control-md select2 selLens' data-placeholder='Select' name='product[]' required='required'><option value=''>Select</option></select></td><td><input type='number' class='form-control form-control-sm border-0 text-end qty' name='qty[]' placeholder='0' /></td><td><input type='number' class='form-control form-control-sm border-0 text-end price' name='price[]' placeholder='0.00' /></td><td><input type='number' class='form-control form-control-sm border-0 text-end total' name='total[]' placeholder='0.00' /></td><td><a href='javascript:void(0)' onclick='$(this).parent().parent().remove();calculateTotal();'><i class='fa fa-times text-danger'></i></a></td></tr>");
            bindDDL(category, 'selLens');
        }
        if(category == 4){ // Accessories
            $(".tblOrder tbody").append("<tr><td colspan='5'><input type='text' value='ACCESSORY' name='type[]' class='form-control form-control-sm border-0' readonly /><input type='hidden' name='sph[]' value='' /><input type='hidden' name='cyl[]' value='' /><input type='hidden' name='axis[]' value='' /><input type='hidden' name='add[]' value='' /></td><td><select class='form-control form-control-md select2 selAccessory' data-placeholder='Select' name='product[]' required='required'><option value=''>Select</option></select></td><td><input type='number' class='form-control form-control-sm border-0 text-end qty' name='qty[]' placeholder='0' /></td><td><input type='number' class='form-control form-control-sm border-0 text-end price' name='price[]' placeholder='0.00' /></td><td><input type='number' class='form-control form-control-sm border-0 text-end total' name='total[]' placeholder='0.00' /></td><td><a href='javascript:void(0)' onclick='$(this).parent().parent().remove();calculateTotal();'><i class='fa fa-times text-danger'></i></a></td></tr>");
            bindDDL(category, 'selAccessory');
        }
        if(category == 5){ // Solutions
            $(".tblOrder tbody").append("<tr><td colspan='5'><input type='text' value='SOLUTION' name='type[]' class='form-control form-control-sm border-0' readonly /><input type='hidden' name='sph[]' value='' /><input type='hidden' name='cyl[]' value='' /><input type='hidden' name='axis[]' value='' /><input type='hidden' name='add[]' value='' /></td><td><select class='form-control form-control-md select2 selSolution' data-placeholder='Select' name='product[]' required='required'><option value=''>Select</option></select></td><td><input type='number' class='form-control form-control-sm border-0 text-end qty' name='qty[]' placeholder='0' /></td><td><input type='number' class='form-control form-control-sm border-0 text-end price' name='price[]' placeholder='0.00' /></td><td><input type='number' class='form-control form-control-sm border-0 text-end total' name='total[]' placeholder='0.00' /></td><td><a href='javascript:void(0)' onclick='$(this).parent().parent().remove();calculateTotal();'><i class='fa fa-times text-danger'></i></a></td></tr>");
            bindDDL(category, 'selSolution');
        }
        if(category == 6){ // Services
            $(".tblOrder tbody").append("<tr><td colspan='5'><input type='text' value='SERVICE' name='type[]' class='form-control form-control-sm border-0' readonly /><input type='hidden' name='sph[]' value='' /><input type='hidden' name='cyl[]' value='' /><input type='hidden' name='axis[]' value='' /><input type='hidden' name='add[]' value='' /></td><td><select class='form-control form-control-md select2 selService' data-placeholder='Select' name='product[]' required='required'><option value=''>Select</option></select></td><td><input type='number' class='form-control form-control-sm border-0 text-end qty' name='qty[]' placeholder='0' /></td><td><input type='number' class='form-control form-control-sm border-0 text-end price' name='price[]' placeholder='0.00' /></td><td><input type='number' class='form-control form-control-sm border-0 text-end total' name='total[]' placeholder='0.00' /></td><td><a href='javascript:void(0)' onclick='$(this).parent().parent().remove();calculateTotal();'><i class='fa fa-times text-danger'></i></a></td></tr>");
            bindDDL(category, 'selService');
        }        
    });

    $(document).on('change', '.selLens, .selFrame, .selAccessory, .selService, .selSolution', function(){
        var dis = $(this);
        var product = dis.val();
        $.ajax({
            type: 'GET',
            url: '/helper/getProductPrice',
            data: {'product': product},
            success: function(response){
                dis.closest('tr').find('.qty').val(1);
                dis.closest('tr').find('.price').val(response.mrp);
                dis.closest('tr').find('.total').val(response.mrp);
                calculateTotal();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                console.log(XMLHttpRequest);
            }
        });
    });
    $(document).on('change', '.qty, .price, .total, .discount, .advance', function(){
        calculateTotal();
    });
});

function bindDDL(category, ddl){
    $.ajax({
        type: 'GET',
        url: '/helper/createddl/'+category
    }).then(function (data){
        xdata = $.map(data, function(obj){
            obj.text = obj.name || obj.id;  
            return obj;
        });
        $('.'+ddl).select2({data:xdata});
    });
}

setTimeout(function () {
    $(".alert").hide('slow');
}, 3000);

function calculateTotal(){
    var order_total = 0;
    $(".tblOrder tbody tr").each(function(){
        var qty = parseInt($(this).find('.qty').val());
        var price = parseFloat($(this).find('.price').val());
        var tot = (qty*price);
        $(this).find('.total').val(tot.toFixed(2));
        order_total += (tot > 0) ? parseFloat(tot) : 0;
    });
    $(".otot").val(order_total.toFixed(2));
    var discount = $(".discount").val();
    var nettot = (parseFloat(discount) > 0 ) ? order_total-parseFloat(discount) : order_total;
    var advance = $(".advance").val();
    var balance = (parseFloat(advance) > 0 ) ? nettot-parseFloat(advance) : nettot;
    $(".nettot").val(nettot.toFixed(2));
    $(".balance").val(balance.toFixed(2));
    
}