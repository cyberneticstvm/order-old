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
            $(".tblOrder tbody").append("<tr><td colspan='5'><input type='text' value='FRAME' name='type[]' class='form-control form-control-sm border-0' readonly /></td><td><select class='form-control form-control-md select2 selFrame' data-placeholder='Select' name='frames[]' required='required'><option value=''>Select</option></select></td><td><input type='number' class='form-control form-control-sm border-0 text-end qty' name='qty[]' placeholder='0' /></td><td><input type='number' class='form-control form-control-sm border-0 text-end price' name='price[]' placeholder='0.00' /></td><td><input type='number' class='form-control form-control-sm border-0 text-end total' name='total[]' placeholder='0.00' /></td><td><a href='javascript:void(0)' onclick='$(this).parent().parent().remove();'><i class='fa fa-times text-danger'></i></a></td></tr>");
            bindDDL(category, 'selFrame');
        }
        if(category == 2){ // Lenses
            $(".tblOrder tbody").append("<tr><td><input type='text' value='RE' name='type[]' class='form-control form-control-sm border-0' readonly /></td><td><input type='text' class='form-control form-control-sm border-0' placeholder='Sph' name='sph[]'></td><td><input type='text' class='form-control form-control-sm border-0' placeholder='Cyl' name='cyl[]'></td><td><input type='text' class='form-control form-control-sm border-0' placeholder='Axis' name='axis[]'></td><td><input type='text' class='form-control form-control-sm border-0' placeholder='Add' name='add[]'></td><td><select class='form-control form-control-md select2 selLens' data-placeholder='Select' name='lenses[]' required='required'><option value=''>Select</option></select></td><td><input type='number' class='form-control form-control-sm border-0 text-end qty' name='qty[]' placeholder='0' /></td><td><input type='number' class='form-control form-control-sm border-0 text-end price' name='price[]' placeholder='0.00' /></td><td><input type='number' class='form-control form-control-sm border-0 text-end total' name='total[]' placeholder='0.00' /></td><td><a href='javascript:void(0)' onclick='$(this).parent().parent().remove();'><i class='fa fa-times text-danger'></i></a></td></tr>");
            $(".tblOrder tbody").append("<tr><td><input type='text' value='LE' name='type[]' class='form-control form-control-sm border-0' readonly /></td><td><input type='text' class='form-control form-control-sm border-0' placeholder='Sph' name='sph[]'></td><td><input type='text' class='form-control form-control-sm border-0' placeholder='Cyl' name='cyl[]'></td><td><input type='text' class='form-control form-control-sm border-0' placeholder='Axis' name='axis[]'></td><td><input type='text' class='form-control form-control-sm border-0' placeholder='Add' name='add[]'></td><td><select class='form-control form-control-md select2 selLens' data-placeholder='Select' name='lenses[]' required='required'><option value=''>Select</option></select></td><td><input type='number' class='form-control form-control-sm border-0 text-end qty' name='qty[]' placeholder='0' /></td><td><input type='number' class='form-control form-control-sm border-0 text-end price' name='price[]' placeholder='0.00' /></td><td><input type='number' class='form-control form-control-sm border-0 text-end total' name='total[]' placeholder='0.00' /></td><td><a href='javascript:void(0)' onclick='$(this).parent().parent().remove();'><i class='fa fa-times text-danger'></i></a></td></tr>");
            bindDDL(category, 'selLens');
        }
        if(category == 3){ // Accessories
            $(".tblOrder tbody").append("<tr><td colspan='5'><input type='text' value='ACCESSORY' name='type[]' class='form-control form-control-sm border-0' readonly /></td><td><select class='form-control form-control-md select2 selAccessory' data-placeholder='Select' name='accessory[]' required='required'><option value=''>Select</option></select></td><td><input type='number' class='form-control form-control-sm border-0 text-end qty' name='qty[]' placeholder='0' /></td><td><input type='number' class='form-control form-control-sm border-0 text-end price' name='price[]' placeholder='0.00' /></td><td><input type='number' class='form-control form-control-sm border-0 text-end total' name='total[]' placeholder='0.00' /></td><td><a href='javascript:void(0)' onclick='$(this).parent().parent().remove();'><i class='fa fa-times text-danger'></i></a></td></tr>");
            bindDDL(category, 'selAccessory');
        }
        if(category == 4){ // Services
            $(".tblOrder tbody").append("<tr><td colspan='5'><input type='text' value='SERVICE' name='type[]' class='form-control form-control-sm border-0' readonly /></td><td><select class='form-control form-control-md select2 selService' data-placeholder='Select' name='service[]' required='required'><option value=''>Select</option></select></td><td><input type='number' class='form-control form-control-sm border-0 text-end qty' name='qty[]' placeholder='0' /></td><td><input type='number' class='form-control form-control-sm border-0 text-end price' name='price[]' placeholder='0.00' /></td><td><input type='number' class='form-control form-control-sm border-0 text-end total' name='total[]' placeholder='0.00' /></td><td><a href='javascript:void(0)' onclick='$(this).parent().parent().remove();'><i class='fa fa-times text-danger'></i></a></td></tr>");
            bindDDL(category, 'selService');
        }        
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