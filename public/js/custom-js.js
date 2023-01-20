$(document).ready(function () {
    $('.dt-table').dataTable();

});

$('.dt-table-button').dataTable({
    responsive: true,
    dom:

        "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    buttons: [
        {
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
});

$('.yearPicker').datepicker({
    format: "yyyy",
    viewMode: "years",
    minViewMode: "years",
    todayHighlight: true,
    autoclose: true,
    endDate: 'y',

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
