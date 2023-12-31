$(document).ready(function () {
    $('.dt-table').dataTable();

});

$('.dt-table-button').dataTable({
    responsive: true,
    dom:

        "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    buttons: [{
            extend: 'colvis',
            text: 'Column Visibility',
            titleAttr: 'Col visibility',
            className: 'btn-outline-default'
        },
        {
            extend: 'csvHtml5',
            text: 'CSV',
            titleAttr: 'Generate CSV',
            className: 'btn-outline-default'
        },
        {
            extend: 'copyHtml5',
            text: 'Copy',
            titleAttr: 'Copy to clipboard',
            className: 'btn-outline-default'
        },
        {
            extend: 'print',
            text: 'Print',
            titleAttr: 'Print Table',
            className: 'btn-outline-default'
        }

    ]
});
var controls = {
    leftArrow: '<i class="fal fa-angle-left" style="font-size: 1.25rem"></i>',
    rightArrow: '<i class="fal fa-angle-right" style="font-size: 1.25rem"></i>'
}
$('.app-datepicker').datepicker({
    autoclose: true,
    todayHighlight: true,
});
$('.datepicker-1').datepicker({
    selectYears: '100',
    selectMonths: true,
    autoclose: true,
    format: 'dd-mm-yyyy',
    singleDatePicker: true,
    showDropdowns: true,
    // endDate: '+1',
    todayHighlight: true,
    minDate: 1,
    startDate: '-0d',
    // todayBtn: "linked",
    // clearBtn: true,
    templates: controls,
    // orientation: "bottom left",
});
$('.datepicker-2').datepicker({
    selectYears: '100',
    selectMonths: true,
    autoclose: true,
    format: 'dd-mm-yyyy',
    singleDatePicker: true,
    showDropdowns: true,
    endDate: '+1',
    todayHighlight: true,
    minDate: 1,
    // startDate: '-0d',
    todayBtn: "linked",
    clearBtn: true,
    orientation: "bottom left",

});

$('.yearPicker').datepicker({
    format: "yyyy",
    viewMode: "years",
    minViewMode: "years",
    todayHighlight: true,
    autoclose: true,
    endDate: 'y',
    orientation: "bottom left",
});

$('.year').datepicker({
    format: "yyyy",
    viewMode: "years",
    minViewMode: "years",
    todayHighlight: true,
    autoclose: true,
    // endDate: 'y',
    // startDate: '-y',
    orientation: "bottom left",
});
$('.select2').select2();

function view_reason(remark) {
    $("#remark_div").html(remark);
    $('#view_reason').modal('show');
}

function upload_image_view(url) {
    event.preventDefault();
    $('#view_upload_image').html('<embed src="' + url +
        '" frameborder="0" width="100%" id="view_upload_image" height="400px">');
    $('#upload_image_view').modal('show');
}

$('.remove-alert').delay(5000).fadeOut('slow');


$(".fromDate").datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    selectYears: '100',
    selectMonths: true,
    singleDatePicker: true,
    showDropdowns: true,
    orientation: "bottom left",
    todayHighlight: true,
    startDate: '-0d',
}).on('changeDate', function (selected) {
    var minDate = new Date(selected.date.valueOf());
    $('.toDate').datepicker('setStartDate', minDate);
});

$(".toDate").datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    selectYears: '100',
    selectMonths: true,
    max: 'today',
    singleDatePicker: true,
    showDropdowns: true,
    orientation: "bottom left",
    todayHighlight: true,
}).on('changeDate', function (selected) {
    var minDate = new Date(selected.date.valueOf());
    $('.fromDate').datepicker('setEndDate', minDate);
});


$(".numeric").on("input", function (evt) {
    let self = $(this);
    self.val(self.val().replace(/\D/g, ""));
    if ((evt.which < 48 || evt.which > 57)) {
        evt.preventDefault();
    }
});

$(".decimal").on("input", function (evt) {
    let self = $(this);
    self.val(self.val().replace(/[^0-9\.]/g, ''));
    if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which >
            57)) {
        evt.preventDefault();
    }
});



$(".alphaonly").keydown(function (event) {
    var userGetData = event.which;
    if (!(userGetData >= 65 && userGetData <= 120) && (userGetData != 32 && userGetData != 0)) {
        event.preventDefault();
    }
});

$("#is_migration").change(function () {
    if ($(this).val() == '1') {
        $('#migration_cert').addClass('chk_blank chk_5mb_file_only');
    } else {
        $('#migration_cert').removeClass('chk_blank chk_5mb_file_only');
        $('#migration_cert').parent().find('.error-msg').html('');

    }
})

$(document).ready(function () {
    $(".multiselect").multiselect({
        includeSelectAllOption: true,
        includeSelectAllOption: true,
        enableFiltering: true

    });
})
