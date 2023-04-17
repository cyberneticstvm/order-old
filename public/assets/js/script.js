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
});

setTimeout(function () {
    $(".alert").hide('slow');
}, 3000);