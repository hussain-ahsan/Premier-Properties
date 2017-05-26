/**
 * GENERAL.JS
 * All the general functions being used in all over the website are declared here.
 * */

/**
 * Configure modal and prevent modal to close on body click
 * @param modalId ==> modal id to configure
 * */
function configureModal(modalId) {
    $('#' + modalId).modal({backdrop: 'static', keyboard: false});
}

/**
 * Show error message on bootstrap form
 * @param modalName ==> Main twitter bootstrap modal id
 * @param divId ==> Error message div
 * @param message ==> Error message to be shown
 * */
function showErrorMessage(modalName, divId, message) {
    $('#' + modalName).animate({scrollTop: 0}, 'slow').focus();
    $('#' + divId).text(message).show();
    setTimeout(function () {
        $('#' + divId).hide();
    }, 3000);
}

/**
 * Show bootstrap modal
 * @param ==> bootstrap modal id
 * */
function showModal(modalId) {
    $('#' + modalId).modal('show');
}

/**
 * Hide bootstrap modal
 * @param ==> bootstrap modal id
 * */
function hideModal(modalId) {
    $('#' + modalId).modal('hide');
}

/**
 * reset add edit form
 * @param id ==> form id to reset
 */
function resetForm(id) {
    document.getElementById(id).reset();
}

/**
 * Load the datetime picker for your form
 * @param ids ==> all the ids of date time pickers, for single pass id like '#myId' and for multiple '#mdId1, #mdId2'
 * @param bit ==> bit 1 for dd/mm/yy format and 2 for yyyy format
 * */
function loadAllDateTimePicker(ids, bit) {
    var dateFormat = bit == 1 ? window.dateTimePickerFormat : window.dateTimePickerYearFormat;
    var minView = bit == 1 ? 0 : 2;
    /*jquery datePicker functions*/
    $(ids).datepicker({
        autoclose: true,
        startDate: "today",
        todayHighlight: true,
        format: dateFormat.toLowerCase(),
        minViewMode: minView
    });

}

function changeText(id, text) {
    $("#" + id).text(text);
}

/*Focus on jquery dataTable*/
function paginateScroll() {
    $('html, body').animate({
        scrollTop: $(".dataTables_wrapper").offset().top
    }, "slow" );
    console.log('pagination button clicked');
    $(".paginate_button").unbind('click', paginateScroll);
    $(".paginate_button").bind('click', paginateScroll);

}
