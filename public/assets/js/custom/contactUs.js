$(document).ready(function ($) {
    $("#contactUs").validate({
        rules: {
            name: "required",
            email: {
                required: true,
                email: true
            },
            phone: "required",
            comment: "required",
        },
        messages: {
            name: "Please enter your name",
            email: "Please enter your email",
            phone: "Please enter your phone",
            comment: "Please enter your comment",
        },
        errorPlacement: function (error, element) {
            $("#" + element.attr("id")).parent().append(error);
        },
        submitHandler: function (form) {
            var fileResult = true;
            if ($('#uploadedResume').val() != '') {
                var extension = $('#uploadedResume').val().split('.').pop().toLowerCase();
                var allowedExtensionsArray = allowedExtensions.split('|');
                if ($.inArray(extension, allowedExtensionsArray) == -1) {
                    fileResult = false;
                }
            }
            if (!fileResult) {
                showErrorMessage('', 'errorMessage', 'Invalid file extension!');
            } else {
                $('#loader').css('display', 'block');
                var formData = new FormData($("#contactUs")[0]);
                $.ajax({
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: "POST",
                    beforeSend: function (request) {
                        request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="_token"]').attr('content'));
                    },
                    url: '/contactUs',
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        console.log('resp: ', data);
                        if (data.status == "success") {
                            showErrorMessage('', 'successMessage', data.message);
                        } else {
                            showErrorMessage('', 'errorMessage', data.message);
                        }
                        resetForm('contactUs');
                        $('#loader').css('display', 'none');
                    },
                    error: function (data) {
                        showErrorMessage('', 'errorMessage', data.message);
                    }
                });
            }
        }
    });
});