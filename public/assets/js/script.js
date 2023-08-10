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
        placeholder: 'Select',
        allowClear: true,
    });

    $(".selProdCat").change(function(){
        var category = $(this).val();   
        $.ajax({
            type: 'GET',
            url: '/helper/createddlSubCat/'+category
        }).then(function (data){
            var options = "<option value=''>Select</option>";
            $.map(data, function(obj){
                options = options + "<option value='"+obj.id+"'>"+obj.name+"</option>";
            });
            $(".selProdSubCat").html(options);
        });
    });

    $(".sel_category_for_add_item").change(function(){
        var category = $(this).val();
        if(category == 1){ // Frames
            $(".tblOrder tbody").append("<tr><td colspan='5'><input type='text' value='FRAME' name='type[]' class='form-control form-control-sm border-0' readonly /><input type='hidden' name='sph[]' value='' /><input type='hidden' name='cyl[]' value='' /><input type='hidden' name='axis[]' value='' /><input type='hidden' name='add[]' value='' /></td><td><select class='form-control form-control-md select2 selFrame' data-placeholder='Select' name='product[]' required='required'><option value=''>Select</option></select></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end qty' name='qty[]' placeholder='0' /></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end price' name='price[]' placeholder='0.00' readonly /></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end tax_per' name='tax_per[]' placeholder='0%' /></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end disc_per' name='disc_per[]' placeholder='0%' /></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end total' name='total[]' placeholder='0.00' readonly /></td><td><a href='javascript:void(0)' onclick='$(this).parent().parent().remove();calculateTotal();'><i class='fa fa-times text-danger'></i></a></td></tr>");
            bindDDL(category, 'selFrame');
        }
        if(category == 2 || category == 3){ // Lenses
            $(".tblOrder tbody").append("<tr><td><input type='text' value='RE' name='type[]' class='form-control form-control-sm border-0' readonly /></td><td><input type='text' class='form-control form-control-sm border-0' placeholder='Sph' name='sph[]'></td><td><input type='text' class='form-control form-control-sm border-0' placeholder='Cyl' name='cyl[]'></td><td><input type='text' class='form-control form-control-sm border-0' placeholder='Axis' name='axis[]'></td><td><input type='text' class='form-control form-control-sm border-0' placeholder='Add' name='add[]'></td><td><select class='form-control form-control-md select2 selLens' data-placeholder='Select' name='product[]' required='required'><option value=''>Select</option></select></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end qty' name='qty[]' placeholder='0' /></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end price' name='price[]' placeholder='0.00' readonly /></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end tax_per' name='tax_per[]' placeholder='0%' /></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end disc_per' name='disc_per[]' placeholder='0%' /></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end total' name='total[]' placeholder='0.00' readonly /></td><td><a href='javascript:void(0)' onclick='$(this).parent().parent().remove();calculateTotal();'><i class='fa fa-times text-danger'></i></a></td></tr>");
            $(".tblOrder tbody").append("<tr><td><input type='text' value='LE' name='type[]' class='form-control form-control-sm border-0' readonly /></td><td><input type='text' class='form-control form-control-sm border-0' placeholder='Sph' name='sph[]'></td><td><input type='text' class='form-control form-control-sm border-0' placeholder='Cyl' name='cyl[]'></td><td><input type='text' class='form-control form-control-sm border-0' placeholder='Axis' name='axis[]'></td><td><input type='text' class='form-control form-control-sm border-0' placeholder='Add' name='add[]'></td><td><select class='form-control form-control-md select2 selLens' data-placeholder='Select' name='product[]' required='required'><option value=''>Select</option></select></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end qty' name='qty[]' placeholder='0' /></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end price' name='price[]' placeholder='0.00' readonly /></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end tax_per' name='tax_per[]' placeholder='0%' /></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end disc_per' name='disc_per[]' placeholder='0%' /></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end total' name='total[]' placeholder='0.00' readonly /></td><td><a href='javascript:void(0)' onclick='$(this).parent().parent().remove();calculateTotal();'><i class='fa fa-times text-danger'></i></a></td></tr>");
            bindDDL(category, 'selLens');
        }
        if(category == 4){ // Accessories
            $(".tblOrder tbody").append("<tr><td colspan='5'><input type='text' value='ACCESSORY' name='type[]' class='form-control form-control-sm border-0' readonly /><input type='hidden' name='sph[]' value='' /><input type='hidden' name='cyl[]' value='' /><input type='hidden' name='axis[]' value='' /><input type='hidden' name='add[]' value='' /></td><td><select class='form-control form-control-md select2 selAccessory' data-placeholder='Select' name='product[]' required='required'><option value=''>Select</option></select></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end qty' name='qty[]' placeholder='0' /></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end price' name='price[]' placeholder='0.00' readonly /></td><td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end tax_per' name='tax_per[]' placeholder='0%' /></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end disc_per' name='disc_per[]' placeholder='0%' /></td><input type='number' step='any' class='form-control form-control-sm border-0 text-end total' name='total[]' placeholder='0.00' readonly /></td><td><a href='javascript:void(0)' onclick='$(this).parent().parent().remove();calculateTotal();'><i class='fa fa-times text-danger'></i></a></td></tr>");
            bindDDL(category, 'selAccessory');
        }
        if(category == 5){ // Solutions
            $(".tblOrder tbody").append("<tr><td colspan='5'><input type='text' value='SOLUTION' name='type[]' class='form-control form-control-sm border-0' readonly /><input type='hidden' name='sph[]' value='' /><input type='hidden' name='cyl[]' value='' /><input type='hidden' name='axis[]' value='' /><input type='hidden' name='add[]' value='' /></td><td><select class='form-control form-control-md select2 selSolution' data-placeholder='Select' name='product[]' required='required'><option value=''>Select</option></select></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end qty' name='qty[]' placeholder='0' /></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end price' name='price[]' placeholder='0.00' readonly /></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end tax_per' name='tax_per[]' placeholder='0%' /></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end disc_per' name='disc_per[]' placeholder='0%' /></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end total' name='total[]' placeholder='0.00' readonly /></td><td><a href='javascript:void(0)' onclick='$(this).parent().parent().remove();calculateTotal();'><i class='fa fa-times text-danger'></i></a></td></tr>");
            bindDDL(category, 'selSolution');
        }
        if(category == 6){ // Services
            $(".tblOrder tbody").append("<tr><td colspan='5'><input type='text' value='SERVICE' name='type[]' class='form-control form-control-sm border-0' readonly /><input type='hidden' name='sph[]' value='' /><input type='hidden' name='cyl[]' value='' /><input type='hidden' name='axis[]' value='' /><input type='hidden' name='add[]' value='' /></td><td><select class='form-control form-control-md select2 selService' data-placeholder='Select' name='product[]' required='required'><option value=''>Select</option></select></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end qty' name='qty[]' placeholder='0' /></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end price' name='price[]' placeholder='0.00' readonly /></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end tax_per' name='tax_per[]' placeholder='0%' /></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end disc_per' name='disc_per[]' placeholder='0%' /></td><td><input type='number' step='any' class='form-control form-control-sm border-0 text-end total' name='total[]' placeholder='0.00' readonly /></td><td><a href='javascript:void(0)' onclick='$(this).parent().parent().remove();calculateTotal();'><i class='fa fa-times text-danger'></i></a></td></tr>");
            bindDDL(category, 'selService');
        }        
    });

    $(document).on('change', '.selLensFirst', function(){
        var dis = $(this);
        var product = dis.val();
        $.ajax({
            type: 'GET',
            url: '/helper/getProductPrice',
            data: {'product': product},
            success: function(response){
                dis.closest('tr').next('tr').find('.qty').val(1);
                dis.closest('tr').next('tr').find('.price').val(response.mrp);
                dis.closest('tr').next('tr').find('.tax_per').val(response.tax_percentage);
                dis.closest('tr').next('tr').find('.disc_per').val(response.discount_percentage);
                dis.closest('tr').next('tr').find('.total').val(response.price_after_tax);
                dis.closest('tr').next('tr').find('.selLens').val(product);
                $('.selLens').select2();
                calculateTotal();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                console.log(XMLHttpRequest);
            }
        });
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
                dis.closest('tr').find('.tax_per').val(response.tax_percentage);
                dis.closest('tr').find('.disc_per').val(response.discount_percentage);
                dis.closest('tr').find('.total').val(response.price_after_tax);
                calculateTotal();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                console.log(XMLHttpRequest);
            }
        });
    });

    $(document).on('change', '.qty, .price, .total, .discount, .advance, .tax_per, .disc_per', function(){
        calculateTotal();
    });

    $(document).on('click', '.addStockRow', function(){
        $(".tblStock").append("<tr><td><select class='form-control form-control-sm select2 selPdctCat' name='category[]' required></select></td><td><select class='form-control form-control-sm select2 selProdSubcat' name='subcategory[]' required></select></td><td><select class='form-control form-control-sm select2 selProd' name='product[]' required></select></td><td><input type='number' class='form-control form-control-sm border-0 text-end' name='qty[]' required /></td><td class='text-center'><a href='javascript:void(0)' onclick='$(this).parent().parent().remove();calculateTotal();'><i class='fa fa-times text-danger'></i></a></td></tr>");
        bindCategoryDDL('selPdctCat');
    });

    $(document).on('change', '.selPdctCat', function(){
        var dis = $(this); var catid = dis.val();
        $.ajax({
            type: 'GET',
            url: '/helper/createddlSubCat/'+catid
        }).then(function (data){
            var options = "<option value=''>Select</option>";
            $.map(data, function(obj){
                options = options + "<option value='"+obj.id+"'>"+obj.name+"</option>";
            });
            dis.closest('tr').find(".selProdSubcat").select2();
            dis.closest('tr').find(".selProdSubcat").html(options);
        });
    });
    $(document).on('change', '.selProdSubcat', function(){
        var dis = $(this); var subcatid = dis.val();
        $.ajax({
            type: 'GET',
            url: '/helper/createddlProduct/'+subcatid
        }).then(function (data){
            var options = "<option value=''>Select</option>";
            $.map(data, function(obj){
                options = options + "<option value='"+obj.id+"'>"+obj.name+"</option>";
            });
            dis.closest('tr').find(".selProd").select2();
            dis.closest('tr').find(".selProd").html(options);
        });
    });

    $("#bcodepdct").keypress(function(event){
        if(event.which == '10' || event.which == '13') {
            event.preventDefault();
            var pcode = $("#bcodepdct").val();
            $.ajax({
                type: 'GET',
                url: '/helper/getProduct',
                data: {'product': pcode},
                success: function(response){
                    $(".tblOrder tbody").find('tr:eq(0)').find('.qty').val(1);
                    $(".tblOrder tbody").find('tr:eq(0)').find('.price').val(response.mrp);
                    $(".tblOrder tbody").find('tr:eq(0)').find('.tax_per').val(response.tax_percentage);
                    $(".tblOrder tbody").find('tr:eq(0)').find('.disc_per').val(response.discount_percentage);
                    $(".tblOrder tbody").find('tr:eq(0)').find('.total').val(response.price_after_tax);
                    $(".tblOrder tbody").find('tr:eq(1)').find('.qty').val(1);
                    $(".tblOrder tbody").find('tr:eq(1)').find('.price').val(response.mrp);
                    $(".tblOrder tbody").find('tr:eq(1)').find('.tax_per').val(response.tax_percentage);
                    $(".tblOrder tbody").find('tr:eq(1)').find('.disc_per').val(response.discount_percentage);
                    $(".tblOrder tbody").find('tr:eq(1)').find('.total').val(response.price_after_tax);
    
                    $(".tblOrder tbody").find('tr:eq(0)').find('.selLens').val(response.id);
                    $(".tblOrder tbody").find('tr:eq(1)').find('.selLens').val(response.id);
                    $('.selLens').select2();
                    calculateTotal();
                },
                error: function(XMLHttpRequest, textStatus, errorThrown){
                    console.log(XMLHttpRequest);
                }
            });
        }
    });

    $("#bcodeFrame").keypress(function(event){
        if(event.which == '10' || event.which == '13') {
            event.preventDefault();
            var pcode = $("#bcodeFrame").val();
            $.ajax({
                type: 'GET',
                url: '/helper/getProduct',
                data: {'product': pcode},
                success: function(response){
                    $(".tblOrder tbody").find('tr:eq(2)').find('.qty').val(1);
                    $(".tblOrder tbody").find('tr:eq(2)').find('.price').val(response.mrp);
                    $(".tblOrder tbody").find('tr:eq(2)').find('.tax_per').val(response.tax_percentage);
                    $(".tblOrder tbody").find('tr:eq(2)').find('.disc_per').val(response.discount_percentage);
                    $(".tblOrder tbody").find('tr:eq(2)').find('.total').val(response.price_after_tax);
    
                    $(".tblOrder tbody").find('tr:eq(2)').find('.selFrame').val(response.id);
                    $('.selFrame').select2();
                    calculateTotal();
                },
                error: function(XMLHttpRequest, textStatus, errorThrown){
                    console.log(XMLHttpRequest);
                }
            });
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

function bindCategoryDDL(ddl){
    $.ajax({
        type: 'GET',
        url: '/helper/createddlcat'
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
    var order_total = 0; var disc_tot = 0; var tax_tot = 0;
    $(".tblOrder tbody tr").each(function(){
        var tot = $(this).find('.total').val();
        order_total += (parseFloat(tot) > 0) ? parseFloat(tot) : 0;
        var disc = (parseFloat($(this).find('.disc_per').val()) > 0) ? (parseFloat(tot)*parseFloat($(this).find('.disc_per').val()))/100 : 0;
        disc_tot += disc;
        tax_tot += parseFloat($(this).find('.tax_per').val()) > 0 ? ((tot-disc)*parseFloat($(this).find('.tax_per').val()))/100 : 0;
    });
    $(".otot").val(order_total.toFixed(2));
    $(".discount").val(disc_tot.toFixed(2));
    var discount = $(".discount").val();
    var nettot = (parseFloat(discount) > 0 ) ? order_total-parseFloat(discount) : order_total;
    var advance = $(".advance").val();
    var balance = (parseFloat(advance) > 0 ) ? (nettot+tax_tot)-parseFloat(advance) : nettot+tax_tot;
    $(".nettot").val(nettot.toFixed(2));
    $(".tax").val(tax_tot.toFixed(2));
    $(".amount_due").val((parseFloat(nettot)+parseFloat(tax_tot)).toFixed(2));
    $(".balance").val(balance.toFixed(2));
    
}