$(document).ready(function ($) {
    /**
     * This variable is used to save new or update property report
     * */
    window.updatePropertyReports = 0;
    /**
     * This variable is used to get property id
     * */
    window.propertyId = 0;
    //$("#accordion").accordion();
    async.parallel([
            function (callback) {
                propertyReportsModalEvents();
                callback(null, 'propertyReportsModalEvents loaded');
            },
            function (callback) {
                loadTinyMce();
                callback(null, 'loadTinyMce loaded');
            },
            function (callback) {
                loadAllDateTimePicker('#date_time_picker_property_report, #reportDateDP', 1);
                callback(null, 'date_time_picker_property_report loded');
            },
            function (callback) {
                submitSavePropertyReportForm();
                callback(null, 'submitSavePropertyReportForm loaded');
            },
            function (callback) {
                propertyReportEvents();
                callback(null, 'propertyReportEvents loaded');
            },
            function (callback) {
                updatePermanentCheckbox();
                callback(null, 'updatePermanentCheckbox loaded');
            },
            function (callback) {
                removeNotification();
                callback(null, 'removeNotification loaded');
            }
        ],
        function (err, results) {
        });
});

/**
 * This method is used to save new or existing Property Report
 * */
function savePropertyReports(bit) {
    var formData = new FormData($("#savePropertyReportsForm")[0]);
    $.ajax({
        type: "POST",
        beforeSend: function (request) {
            request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="_token"]').attr('content'));
        },
        url: bit != 1 ? '/addNewPropertyReport' : '/updatePropertyReport',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        dataType: 'json',
        success: function (data) {
            if (data.status == 'fail') {
                showErrorMessage('propertyReportModal', 'errorMessage' ,data.message);
            } else {
                window.location = '/property-detail/' + propertyId;
            }
        },
        error: function (error) {
            var message = error && error.responseJSON ? error.responseJSON : 'Something went wrong..!'
            showErrorMessage('propertyReportModal', 'errorMessage', message);
        }
    });
}

/**
 * This method is used to reset form
 * */
function resetForm() {
    updatePropertyReports = 0;
    $("#savePropertyReportsForm")[0].reset();
    $("#savePropertyReportBtn").text('Save');
}

/**
 * This method is used to close Add/Edit Property Report Modal
 * */
function propertyReportsModalEvents() {
    $("#propertyReportModal").on('shown.bs.modal', function (e) {
        $(".cancelModel").click(function () {
            resetForm();
            $('#propertyReportModal').modal('hide');
        });
    });

    $("#showPropertyReportsModel").click(function () {
        resetForm();
        configureModal('propertyReportModal');
    });
}

/**
 * This method is used to show text editor tinymce
 * */
function loadTinyMce() {
    tinymce.init({
        selector: 'textarea',
        element_format: 'html',

        // General options

        theme: "modern",
        plugins: "advlist colorpicker spellchecker visualblocks visualchars image imagetools table autosave jbimages link",

        // ===========================================
        // PUT PLUGIN'S BUTTON on the toolbar
        // ===========================================

        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link jbimages",

        relative_urls: false,

        setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
            });
        }
    });
}

/**
 * This method is used to save property report form
 * */
function submitSavePropertyReportForm() {
    $("#savePropertyReportsForm").validate({
        submitHandler: function (form) {
            var fileResult = true;
            if ($('#file_name').val() != '') {
                var extension = $('#file_name').val().split('.').pop().toLowerCase();
                var allowedExtensionsArray = allowedExtensions.split('|');
                if ($.inArray(extension, allowedExtensionsArray) == -1) {
                    fileResult = false;
                }
            }
            if (fileResult) {
                propertyId = $("#property_id").val();
                savePropertyReports(updatePropertyReports); //0 to save new Property Report 1 to update
            } else {
                showErrorMessage('myModal', 'propertyReportModal', 'errorMessage', 'Invalid file extension!');
            }
        }
    });
}

function propertyReportEvents() {
    $("#property_report").change(function () {
        var propertyReports = JSON.parse($('#property_report').attr('custom-propertyReports'));
        var selectedPropertyReportObject = '';
        var selectedPropertyReport = this.value;

        /**
         * Picking up the selected property report
         **/
        $(propertyReports).each(function (key, val) {
            if (parseInt(val.id) == parseInt(selectedPropertyReport)) {
                selectedPropertyReportObject = val;
            }
        });

        /**
         * Populating the form fields with the data of selected property report
         **/
        if (Object.keys(selectedPropertyReportObject).length > 0) {
            updatePropertyReports = 1;
            $("#savePropertyReportBtn").text('Update');
            $(Object.keys(selectedPropertyReportObject)).each(function (key, value) {
                if (value == 'comments') {
                    tinymce.get('comments').setContent(selectedPropertyReportObject['' + value + '']);
                    tinymce.triggerSave();
                } else {
                    $('#' + value).val(selectedPropertyReportObject['' + value + '']);
                    if (value == 'notify_investor')
                        if (selectedPropertyReportObject['' + value + ''] == 1)
                            $('#' + value).prop('checked', true);
                        else
                            $('#' + value).prop('checked', false);
                }
            });
        } else {
            resetForm();
        }
    });
}

/**
 * This method is used to update the permanent checkbox value
 * */
function updatePermanentCheckbox() {
    $('input[type="checkbox"]').change(function () {
        if (this.checked) {
            $("#notify_investor").val(1);
        } else {
            $("#notify_investor").val(0);
        }
    });
}

function removeNotification() {
    $(".removeNotifications").click(function () {
        var id = $(this).attr('id');
        if (id != '') {
            $.ajax({
                type: "POST",
                beforeSend: function (request) {
                    request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="_token"]').attr('content'));
                },
                url: '/removeNotifications',
                data: {id: id},
                success: function (data) {
                    if (data != '') {
                        $("#span_" + id).hide();
                    }
                }
            });
        }
    });
}