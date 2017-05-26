$(document).ready(function ($) {
    /**
     * This variable is used to save new or update user
     * */
    window.updateUser = 0;
    /**
     * This variable is used to update company
     * */
    window.updateCompanyId = '';
    /**
     * This method is used to put company data into array*/
    window.companyDataArray = [];
    async.parallel([
            function (callback) {
                loadAllDateTimePicker('#date_time_picker_pw_expire', 1);
                callback(null, 'loadAllDateTimePicker loaded');
            },
            function (callback) {
                userReportChange();
                callback(null, 'userReportChange loaded');
            },
            function (callback) {
                userReportModalEvent();
                callback(null, 'userReportModalEvent loaded');
            },
            function (callback) {
                showUserModal();
                callback(null, 'showUserModal loaded');
            },
            function (callback) {
                deactivateButtonEvent();
                callback(null, 'deactivateButtonEvent loaded');
            },
            function (callback) {
                configurePermanent();
                callback(null, 'configurePermanent loaded');
            },
            function (callback) {
                submitSaveUserForm();
                callback(null, 'submitSaveUserForm loaded');
            },
            function (callback) {
                addAnotherCompany();
                callback(null, 'addAnotherCompany loaded');
            },
            function (callback) {
                resetPasswordModal();
                callback(null, 'resetPasswordModal loaded');
            },
            function (callback) {
                resetPasswordEvent();
                callback(null, 'resetPasswordEvent loaded');
            },
            function (callback) {
                userModal();
                callback(null, 'userModal loaded');
            },
            function (callback) {
                submitResetPassword();
                callback(null, 'userModal loaded');
            },
            function (callback) {
                initializeCompaniesTable();
                callback(null, 'userModal loaded');
            }
        ],
        function (err, results) {
        });
});

function initializeCompaniesTable() {
    $('#userTable').DataTable({
        bFilter: false,
        bInfo: true,
        aaSorting: [[7, 'desc']]
    });

    $('#userTable').on( 'page.dt', function () {
        paginateScroll();
        console.log('scroll now');
    });
}

/**
 * This method is used to make array for the company data
 * */
function makeCompanyDataArray(updateCompanyId, formRequest) {
    var companyData = {};
    var selectedCompanyId = $("#company").val();
    var selectedCompanyName = $("#company :selected").text();
    var selectedCompanyPercentOwned = $("#percent_owned").val();
    if (companyDataArray.length == 0 || !formRequest) {
        if (selectedCompanyId == '' || selectedCompanyName == 'Select Company') {
            return showMessagesForCompany("company");
        } else if (selectedCompanyPercentOwned == '') {
            return showMessagesForCompany("percent_owned");
        } else if ($.isNumeric(selectedCompanyPercentOwned)) {
            if (parseInt(selectedCompanyPercentOwned) <= 0)
                return showMessagesForCompany("percent_owned");
        } else {
            return showMessagesForCompany("percent_owned");
        }
    }
    if (selectedCompanyId != '') {
        if (selectedCompanyPercentOwned == '') {
            return showMessagesForCompany("percent_owned");
        } else {
            companyData.id = selectedCompanyId;
            companyData.name = selectedCompanyName;
            companyData.percentOwned = selectedCompanyPercentOwned;
            if (updateCompanyId) {
                deleteCompany(updateCompanyId);
            }
            var companyArrayResult = returnCompanyArray(companyData.id, true);
            if (companyArrayResult.length == 0) {
                companyDataArray.push(companyData);
            } else {
                return showMessagesForCompany("company");
            }
            updateCompanyId = '';
            companiesListing(companyDataArray);
            setCompanyDropDown('', '');
        }
    }
    return formRequest ? formRequest : updateCompanyId;
}

/**
 * This method is used to list the selected companies
 * */
function companiesListing(companyDataArray) {
    $("#companiesListing").html('');
    companyDataArrayLength = companyDataArray.length;
    var companiesListingHTML = '';

    for (var i = 0; i < companyDataArrayLength; i++) {
        companiesListingHTML += '<div class="aje-panel-heading" id="companiesListing"><div class="col-sm-4 col-xs-6 text-gold">';
        companiesListingHTML += companyDataArray[i].name + ': </div>';
        companiesListingHTML += '<div class="col-sm-4 col-xs-3">';
        companiesListingHTML += companyDataArray[i].percentOwned + '% </div>';
        companiesListingHTML += '<div class="col-sm-4 col-xs-3">';
        companiesListingHTML += '<a class="pull-left"><i class="pp-delete cursor_p" onclick="removeCompany(' + companyDataArray[i].id + ')"></i></a>';
        companiesListingHTML += '<a class="pull-left"><i class="pp-edit cursor_p" onclick="editCompany(' + companyDataArray[i].id + ')"></i></a></div></div>';
    }
    $("#companiesListing").html(companiesListingHTML);
    return companiesListingHTML;
}

/**
 * This method is used to reset the company dropdown and percent field
 * */
function setCompanyDropDown(companyValue, percentOwnedValue) {
    $('#company').val(companyValue);
    $("#percent_owned").val(percentOwnedValue);
}

/**
 * This method is used to remove company data
 * */
function removeCompany(id) {
    deleteCompany(id);
    companiesListing(companyDataArray);
}

/**
 * This method is used to remove company data
 * */
function deleteCompany(id) {
    companyDataArray = returnCompanyArray(id, false);
}

/**
 * This method is used to edit company data
 * */
function editCompany(id) {
    var selectedCompany = returnCompanyArray(id, true);
    updateCompanyId = selectedCompany[0].id;
    setCompanyDropDown(selectedCompany[0].id, selectedCompany[0].percentOwned);
}

/**
 * This method is used to return company data array
 * */
function returnCompanyArray(id, match) {
    var companyArray = $.grep(companyDataArray, function (company) {
        if (match) {
            return company.id == id;
        } else {
            return company.id != id;
        }
    });
    return companyArray ? companyArray : [];
}

/**
 * This method is used to save new or existing user
 * */
function saveUser(bit) {
    var formData = new FormData($("#saveUserForm")[0]);
    formData.append('companyDataArray', JSON.stringify(companyDataArray));
    $.ajax({
        type: "POST",
        beforeSend: function (request) {
            request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="_token"]').attr('content'));
        },
        url: bit != 1 ? '/addNewUser' : '/updateUser',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        dataType: 'json',
        success: function (data) {
            if (data.status == 'fail') {
                var message = data && data.message ? data.message : 'Something went wrong..!';
                showErrorMessage('userModal', 'errorMessage', message);
            } else {
                resetFormInner();
                window.location = '/users'
            }
            if (data.bit && parseInt(data.bit) == 2) {
                $("#status").val(1);
            }

        },
        error: function (error) {
            var errors = error && error.responseJSON ? error.responseJSON : '';
            var message = errors.email ? errors.email : errors.password ? errors.password : 'Something went wrong..!';
            showErrorMessage('userModal', 'errorMessage', message);
        }
    })
}

/**
 * This method is used to set values in form to update
 * */
function editUserData(userObject) {
    var parsedResponse = JSON.parse($(userObject).attr('custom-data'));
    updateUser = 1;
    $(".user_id").val(parsedResponse.user_id);
    $(Object.keys(parsedResponse)).each(function (index, key) {
        $('#' + key).val(parsedResponse[key]);
    });
    if (parsedResponse.permanent == 1) {
        $('#permanent').prop('checked', true);
    } else {
        $('#permanent').prop('checked', false);
    }
    if (parsedResponse.status == 1) {
        changeText('activateBtnText', 'DEACTIVATE');
    } else {
        changeText('activateBtnText', 'ACTIVATE');
    }

    changeText('userModelTitle', 'Edit User');
    $("#saveUserBtn").text("Update");

    $("#deactivateAndReset").removeClass("hidden");
    $("#deactivateAndReset").addClass("nothidden");
    $("#passwordSection").hide();

    companyDataArray = parsedResponse.companyObject;
    companiesListing(companyDataArray);
    configureModal('userModal');
}

/**
 * This method is used to show messages of company below the divs
 * */
function showMessagesForCompany(id) {
    $("#" + id).addClass("error");
    setTimeout(function () {
        $("#" + id).removeClass("error");
    }, 3000)
    return false;
}

/**
 * This method is used to reset form
 * */
function resetFormInner() {
    changeText('userModelTitle', 'Add New User');
    $("#saveUserBtn").text("Save");
    updateUser = 0;
    setCompanyDropDown('', '');
    companyDataArray = [];
    $("#passwordSection").show();
    $("#companiesListing").html('');
    $("#deactivateAndReset").removeClass("nothidden");
    $("#deactivateAndReset").addClass("hidden");
    $(".user_id").val('');
    resetForm('saveUserForm');
    resetPasswordForm();
}

/**
 * This method is used to reset form
 * */
function resetPasswordForm() {
    resetForm('resetPasswordUserForm');
}

function uploadReport() {
    if (document.getElementById("userReport").value == '' && document.getElementById("reportTitle").value == '') {
        resetUserReportModal();
    }
    configureModal('userReportModal');
    $('#userReportModal').css('display', 'block');
}

function closeUserReportModal() {
    resetUserReportModal();
    $('#userReportModal').hide();
}

function saveUserReportModal() {
    var title = document.getElementById("reportTitlePopUp").value;
    var selectedReport = document.getElementById("userReport").value;
    if (title == "" || selectedReport == '') {
        showErrorMessage('userReportModal', 'errorMessageUserReport', 'Please fill all the required fields');
    } else {
        $('#userReportModal').hide();
    }
}

function resetUserReportModal() {
    document.getElementById("userReport").value = "";
    document.getElementById("reportTitle").value = "";
    document.getElementById("reportTitlePopUp").value = "";
    setFileName('');
}

function showSelectedFile(fileName) {
    setFileName(fileName);
    $('#selectedFile').show();
}

function setFileName(name) {
    $('#selectedFile').html(name)
}

function userReportChange() {
    document.getElementById('userReport').onchange = function () {
        showSelectedFile(this.value);
    };
}

function userReportModalEvent() {
    $('#userReportModalClose').on('click', function () {
        closeUserReportModal();
    });
}

function showUserModal() {
    $("#showUserModel").click(function () {
        configureModal('userModal');
    });
}

function userModal() {
    $("#userModal").on('shown.bs.modal', function (e) {
        $(".cancelModel").click(function () {
            resetFormInner();
            $('.modal').modal('hide');
        });
    });
}

function resetPasswordEvent() {
    $("#resetPassword").click(function () {
        $("#resetPasswordModal").show();
        configureModal('resetPasswordModal');
    });
}

function resetPasswordModal() {
    $("#resetPasswordModal").on('shown.bs.modal', function (e) {
        $(".cancelResetModel").click(function () {
            resetPasswordForm();
            $('#resetPasswordModal').hide();
        });
    });
}

/**
 * This method is used to add or update company data
 * */
function addAnotherCompany() {
    $("#addAnotherCompany").click(function (e) {
        updateCompanyId = makeCompanyDataArray(updateCompanyId, false);
    });
}

function submitSaveUserForm() {
    $("#saveUserForm").validate({
        rules: {
            first_name: "required",
            last_name: "required",
            address: "required",
            city: "required",
            state: "required",
            zip: "required",
            cell_phone: "required",
            email: {
                required: true,
                email: true
            },
            role: "required",
        },
        messages: {
            first_name: "Please enter first name",
            last_name: "Please enter last name",
            address: 'Please enter address',
            city: 'Please enter city',
            zip: 'Please enter zip',
            cell_phone: 'Please enter phone',
            states: 'Please select state',
            email: 'Please enter valid email',
            role: 'Please select role'
        },
        errorPlacement: function (error, element) {
            $("#" + element.attr("id")).parent().append(error).css({color: "red"});
        },
        submitHandler: function (form) {
            var fileResult = true;
            if ($('#userReport').val() != '') {
                var extension = $('#userReport').val().split('.').pop().toLowerCase();
                var allowedExtensionsArray = allowedExtensions.split('|');
                if ($.inArray(extension, allowedExtensionsArray) == -1) {
                    fileResult = false;
                }
            }
            if (fileResult) {
                var companyResult = makeCompanyDataArray(updateCompanyId, true);
                if (companyResult) {
                    saveUser(updateUser); //0 to save new user 1 to update
                }
            } else {
                showErrorMessage('userModal', 'errorMessage', 'Invalid file extension!')
            }
        }
    });
}

/**
 * This method is used to update the permanent checkbox value
 * */
function configurePermanent() {
    $('input[type="checkbox"]').change(function () {
        if (this.checked) {
            $("#permanent").val(1);
        } else {
            $("#permanent").val(0);
        }
    });
}

function deactivateButtonEvent() {
    $("#deactivateBtn").click(function () {
        if ($("#status").val() == 1) {
            $("#status").val(0);
        } else {
            $("#status").val(1);
        }
        saveUser(1);
    });
}

function submitResetPassword() {
    $("#resetPasswordUserForm").validate({
        rules: {
            reset_password: "required",
            reset_password_confirmation: {
                required: true,
                equalTo: "#reset_password"
            }
        },
        messages: {
            reset_password: 'Please enter password',
            reset_password_confirmation: 'confirm password must match with password',
        },
        errorPlacement: function (error, element) {
            $("#" + element.attr("id")).parent().append(error).css({color: "red"});
        },
        submitHandler: function () {
            $.ajax({
                type: "POST",
                beforeSend: function (request) {
                    request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="_token"]').attr('content'));
                },
                url: '/resetUserPassword',
                data: $("#resetPasswordUserForm").serialize(),
                dataType: 'json',
                success: function (data) {
                    if (data.status != 'fail') {
                        window.location = '/users'

                    }
                }, error: function (e) {
                    window.location = '/404'
                }
            });
        }
    });

}