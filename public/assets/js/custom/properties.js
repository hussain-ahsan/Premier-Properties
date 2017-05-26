/*LOAD FUNCTIONS ON DOCUMENT READY*/
$(document).ready(function () {
    async.parallel([
            function (callback) {
                window.associatedCompanies = [];
                callback(null, 'initialized associatedCompanies');
            },
            function (callback) {
                loadAssociatedModalsFunctions();
                callback(null, 'loaded associated companies modal related functions');
            },
            function (callback) {
                submitPropertyForm();
                callback(null, 'loaded property form');
            },
            function (callback) {
                propertyDropDownActions();
                callback(null, 'loaded property drop-down related function');
            },
            function (callback) {
                companiesDropDownActions();
                callback(null, 'loaded companies drop-down related function');
            },
            function (callback) {
                uploadImageActions();
                callback(null, 'loaded upload image functionality');
            },
            function (callback) {
                loadDateTimePicker();
                callback(null, 'loaded all the date time pickers');
            },
            function (callback) {
                loadPropertyDetail();
                callback(null, 'loaded property detail page event');
            }
        ],
        function (err, results) {
        });
});

function loadPropertyDetail() {
    $('.property-list').bind('click', function () {
        var propertyId = $(this).attr("property-id") ? $(this).attr("property-id") : '';
        if (propertyId && propertyId != '') {
            window.location = 'property-detail/' + propertyId;
        } else {
            window.location = '/404';
        }
    });
}

/*
 * Trigger on Add/Edit Button on properties page
 * */
function addEditProperty() {
    resetForm('propertyForm'); // reset Add/Edit property modal
    showSampleImage(); // show sample image in thumbnail preview
    configureAddNewPropertyBtn(); //show add new property button and hide update property button
    configureModal('myModal'); //configure given modal
    showModal('myModal'); //show the add/edit property modal
}

/*
 * Submit form is a ajax post type code which hit the route to add/edit property
 *  */
function submitForm(formData, isUpdate) {
    $.ajax({
        type: "POST",
        beforeSend: function (request) {
            request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="_token"]').attr('content'));
        },
        url: !isUpdate || isUpdate == 0 ? '/saveProperty' : '/updateProperty',
        data: formData,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == "success") {
                window.location = '/properties';
            } else {
                showErrorMessage('myModal', 'errorMessage', data.message);
            }
        }, error: function (e) {
            var errors = e && e.responseJSON ? e.responseJSON : '';
            var message = errors.ein ? errors.ein : errors.email ? errors.email : 'Something unexpected happened..!';
            showErrorMessage('myModal', 'errorMessage', message);
        }
    })
}

/*
 * preview the image on the Add/Edit bootstrap modal
 * */
function previewFile(id, file) {
    $('#imagePreview').css('display', 'none');
    $('#sampleImage').css('display', 'block');
    document.getElementById("sampleImage").src = window.imagePath+id+'/'+ file;
}

/*
 * Show associate company model
 * */
function associateCompany() {
    changeText('companyAddress', $('#street_address').val().toUpperCase());
    showAssociatedCompanies();
    configureModal('associateModal');
    showAssociateModal();
}

/*
 * Check for the given route if exist or not
 * used to check if we've image in out local directory or not
 *  */
function UrlExists(url) {
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status != 404;
}
/*
 * Save Associated companies in a variable window.associatedCompanies after different validation checks
 * */
function saveAssociatedCompany(bit, response) {
    validateAssociateCompany(function (err, resp) { // validate associated companies
        if (err && err.status == 'failure') {
            showErrorMessage('myModal', 'errorMessageAssociateCompany', err.message);
            if (bit == 2) {
                response({
                    status: 'failure'
                });
            }
        } else {
            if (window.associatedCompanies.length > 0 && window.isUpdateOn != 1) {
                checkAlreadyAddedCompany(resp.record.companyId, function (err, status) {
                    if (status) {
                        createAssociatedCompanies(resp.record);
                        showAssociatedCompanies(); //show associated companies html table
                        resetAssociatedCompanyForm();
                        if (bit == 2) {
                            response(null, {
                                status: 'success'
                            });
                        }
                    } else {
                        if (bit == 2) {
                            response({
                                status: 'failure'
                            });
                        }
                    }
                })
            } else {
                resetAssociatedCompanyForm();
                removeAssociatedCompany(resp.record.companyId, function (err, resp) {
                });
                createAssociatedCompanies(resp.record);
                showAssociatedCompanies();
                window.isUpdateOn = 0;
                if (bit == 2) {
                    response(null, {
                        status: 'success'
                    });
                }
            }
        }
    });
}

/*
 * Push record in window.associatedCompanies
 * */
function createAssociatedCompanies(rec) {
    window.associatedCompanies.push(rec);
}

/*
 * Validate associated company which user is trying to add
 * */
function validateAssociateCompany(response) {
    var companyId = $('#companies-dd').val();
    var companyName = $("#companies-dd option[value=" + companyId + "]").text();
    var investmentAmount = $('#investmentAmount').val();
    var investmentPercent = $('#investmentPercent').val();

    if (companyId == "") {
        response({
            status: 'failure',
            message: 'No Company Selected'
        });
    } else if (investmentAmount == "") {
        response({
            status: 'failure',
            message: 'No Amount Selected'
        });
    } else if (investmentPercent == "") {
        response({
            status: 'failure',
            message: 'No Percent Selected'
        });
    } else {
        response(null, {
            status: 'success',
            record: {
                companyName: companyName,
                companyId: companyId,
                investmentAmount: investmentAmount,
                investmentPercent: investmentPercent
            }
        });
    }
}

/*
 * Check if the user has already assocaited the company
 * */
function checkAlreadyAddedCompany(companyId, response) {
    var bit = true;
    $(window.associatedCompanies).each(function (key, val) {
        if (companyId == val.companyId) {
            showErrorMessage('associateModal', 'errorMessageAssociateCompany', 'Company already added');
            bit = false;
        }
    });
    if (bit == true) {
        response(null, {
            status: 'success'
        });
    } else {
        response({
            status: 'failure'
        });
    }
}

/*
 * Edit already associated companies
 * */
function editAssociatedCompany(bit, companyId) {
    /*
     * bit = 1 ==> just remove the company
     * bit = 2 ==> just pre-populate the company record to be edited
     * companyId ==> company id which needs to be taken care of
     * */
    async.waterfall([
        function (callback) {
            if (bit == 1) {
                removeAssociatedCompany(companyId, function (err, resp) {
                    if (resp) {
                        callback(null, true);
                    } else {
                        callback(err);
                    }
                })
            } else {
                callback(null, true);
            }
        },
        function (isRemoved, callback) {
            if (bit == 2) {
                window.isUpdateOn = 1;
                populateCompanyData(companyId, 1);
            }
            callback(null, 'three');
        }
    ], function (err, result) {
        showAssociatedCompanies();
        if (err) {
            console.log('waterfall err', err);
            window.location = '/404'
        }
    });
}

/*
 * Remove Asoociated Company
 * */
function removeAssociatedCompany(companyId, resp) {
    var associatedCompany = window.associatedCompanies;
    window.associatedCompanies = associatedCompany.filter(function (item) {
        return item.companyId != companyId;
    });
    resp(null, true);
}

/*
 * populating associated investors against selected company on associateCompanyModal
 * */
function populateCompanyData(companyId, bit) {
    var companies = window.companies;
    var singleCompany = '';
    /*picking up the selected property*/
    $(companies).each(function (key, val) {
        if (parseInt(val.id) == parseInt(companyId)) {
            singleCompany = val;
        }
    });

    if (!singleCompany) {
        resetAssociatedCompanyForm();
    } else {
        var html = "";
        for (var i = 0; i < singleCompany.investors.length; i++) {
            html += i + 1 + ': ' + singleCompany.investors[i].first_name + ' ' + singleCompany.investors[i].last_name + '\n'
        }
        $('#investors').html(html);
    }

    /*
     * If one try to edit associated company the following code populate the associated company
     * in the form
     * */
    if (bit == 1) {
        $(window.associatedCompanies).each(function (key, val) {
            if (val.companyId == companyId) {
                $('#companies-dd').val(val.companyId);
                $('#investmentAmount').val(val.investmentAmount);
                $('#investmentPercent').val(val.investmentPercent);
            }
        });
    }
}

/*
 * Create HTML table for the associated companies
 * */
function showAssociatedCompanies() {
    if (window.associatedCompanies.length > 0) {
        var html = "";
        html += "<table id=\"t01\" class=\"table table-striped table-bordered dataTable no-footer\">";
        html += "<div class=\"associateCompanyTableHeader\"> <b>Associated Companies</b></div>";
        html += "<tbody>";
        html += "<tr>";
        html += "<th>Company Name</th>";
        html += "<th>Company %</th>";
        html += "<th>Actions</th>";
        html += "</tr>";

        $(window.associatedCompanies).each(function (key, val) {
            html += "<tr>";
            html += " <td>" + val.companyName + "</td>";
            html += " <td>" + val.investmentPercent + "%</td>";
            html += " <td>";
            html += "    <i class=\"pp-delete col-md-6 cursor_p\" onclick=\"editAssociatedCompany('1','" + val.companyId + "')\"></i>";
            html += "    <i class=\"pp-edit col-md-6 cursor_p\" onclick=\"editAssociatedCompany('2', '" + val.companyId + "')\" ></i>";
            html += " </td>";
            html += "</tr>";
        });

        html += "</tr>";
        html += "</tbody>";
        html += "</table>";

        $('#associatedCompaniesTable').html(html).show();
    } else {
        $('#associatedCompaniesTable').html('').hide();
    }
}

/*
 * Reset Associated companies form
 * */
function resetAssociatedCompanyForm() {
    $('#companies-dd').val('');
    $('#investors').html('');
    $('#investmentAmount').val('');
    $('#investmentPercent').val('');
}

/*
 * Load all the date time pickers used in all over the properties form
 * */
function loadDateTimePicker() {
    loadAllDateTimePicker('#ref_date, #date_of_purchase', 1);
    loadAllDateTimePicker('#year_renovated_DP, #year_built_DP', 0);
}

/*
 * This is the general function to fetch the record using ajax post, type GET
 * @param url ==> Route to hit => required
 * @param record ==> parameter array if need to send any ==> optional
 * @resp ==> callback function which will return the data
 * */
function getRecord(url, record, resp) {
    $.ajax({
        url: url,
        data: record,
        cache: false,
        beforeSend: function (xhr) {
            xhr.overrideMimeType("text/json; charset=x-user-defined");
        }
    }).done(function (data) {
        if (data && data.status == "success") {
            resp(null, data.record);
        } else {
            showErrorMessage('myModal', 'errorMessage', data && data.message ? data.message : 'Something went wrong');
        }
    }).fail(function (e) {
        showErrorMessage('myModal', 'errorMessage', e);
    });
}

/*
 * Fetch the user year end tax reports
 * */
function taxInformation() {
    configureModal('yearAndTaxModal');
    showModal('yearAndTaxModal');
    async.waterfall([
        function (callback) {
            getRecord('/getUserReports', '', function (err, resp) {
                if (resp) {
                    callback(null, resp);
                } else {
                    callback(err);
                }
            });
        },
        function (reports, callback) {
            createReportsHtml(reports, function (err, html) {
                callback(null, 'success');
            });
        }
    ], function (err, result) {
    });
}

/*
 * Create the html for the reports being shown on year end tax information modaL
 * */
function createReportsHtml(record) {
    var html = "";
    if (record.length > 0) {
        html += "<div>";
        $(record).each(function (key, val) {
            var title = val.report_title != '' ? val.report_title : 'N/A';
            var name = val.report;
            var reportName = val.report;
            if (name && name != '') {
                html += "<div class='row' id='reports'>";

                html += "<div class='col-md-6'>";
                html += "<label>  " + title + " </label>";
                html += "</div>";

                html += "<div class='col-md-6'>";
                html += "<a href='/download/?name=" + name + "&env="+window.reportPath+"'>  " + reportName.substring(reportName.indexOf("__") + 2) + " </a>";
                html += "</div>";

                html += "</div>";
                html += "<hr>";
            }
        });
        html += "</div> ";
    }
    if (html != "") {
        $('#reports').html(html);
    } else {
        $('#noRecord').show();
    }
    $('#loader').hide();
}

/*
 * Hide associated modal
 * */
function hideAssociatedModal() {
    $('#associateModal').hide();
}

/*
 * Show associated modal
 * */
function showAssociateModal() {
    $('#associateModal').css('display', 'block');
}

/*
 * on load associated modal related functions
 * */
function loadAssociatedModalsFunctions() {
    $("#associateModal").on('shown.bs.modal', function () {
        $('#associateModalClose, #associateCloseBtn').on('click', function () {
            hideAssociatedModal();
        });

        $('#associateSaveBtn').on('click', function () {
            if ($('#companies-dd').val() != '' || $('#investmentAmount').val() != '' || $('#investmentPercent').val() != '') {
                saveAssociatedCompany(2, function (err, resp) {
                    if (resp) {
                        hideAssociatedModal();
                    }
                });
            } else {
                hideAssociatedModal();
            }
        });
    });
}

/*
 * Jquery Submit handler for propertyForm
 * */
function submitPropertyForm() {
    $("#propertyForm").validate({
        rules: {
            property_name: {
                required: true
            }
        },
        messages: {
            property_name: "Please specify property name"
        },
        errorPlacement: function (error, element) {
            $("#" + element.attr("id")).parent().append(error).css({color: "red"});
        },
        submitHandler: function (form) {
            var formData = new FormData($("#propertyForm")[0]);
            formData.append('companyDataArray', JSON.stringify(window.associatedCompanies));
            submitForm(formData, window.updateProperty);
        }
    });
}

/*
 * All the action after change of property dropdown
 * */
function propertyDropDownActions() {
    $("#property-dd").bind("keyup change", function () {
        var selectedCompany = this.value;
        window.updateProperty = selectedCompany;
        setWindowAssociatedCompanies(selectedCompany);
        if (selectedCompany != 0) {
            console.log("selectedCompany", selectedCompany);
            async.waterfall([
                function (callback) {
                    getRecord('/getProperty', {id: selectedCompany}, function (err, resp) {
                        if (resp) {
                            callback(null, resp);
                        } else {
                            callback(err);
                        }
                    });
                },
                function (singleProperty, callback) {
                    /*populating the form fields with the data of selected property*/
                    $(Object.keys(singleProperty[0])).each(function (key, value) {
                        var valueToAssign = singleProperty[0]['' + value + ''] && singleProperty[0]['' + value + ''] != '' ? singleProperty[0]['' + value + ''] : '';
                        if (value == "name") {
                            $('#property_name').val(valueToAssign);
                        }
                        $('#' + value).val(valueToAssign);
                    });
                    callback(null, singleProperty);
                },
                function (singleProperty, callback) {
                    if (singleProperty[0].companies.length > 0) { // if any company is associated with property
                        setWindowAssociatedCompanies([]);
                        // creating array for associated companies with selected property
                        $(singleProperty[0].companies).each(function (key1, val1) {
                            window.associatedCompanies.push({
                                companyName: val1.name,
                                companyId: val1.pivot.company_id,
                                investmentAmount: val1.pivot.investment_amount,
                                investmentPercent: val1.pivot.investment_percent,
                            })
                        });
                    } else {
                        setWindowAssociatedCompanies([]);
                    }
                    callback(null, singleProperty);
                },
                function (singleProperty, callback) {

                    //UNCOMMENT THIS CODE IF WANT TO SHOW PREVIEW OF PROPERTY IMAGE ON PROPERTY ADD/EDIT POPUP

                    if (!singleProperty[0].image || singleProperty[0].image == "" || !UrlExists(window.imagePath+singleProperty[0].id+'/'+ singleProperty[0].image)) {
                        showSampleImage();
                    } else {
                        $('#image_name').val(singleProperty[0].image);
                        previewFile(singleProperty[0].id, singleProperty[0].image);
                    }
                    callback(null, singleProperty)
                },
                function (singleProperty, callback) {
                    configureUpdatePropertyBtn(singleProperty[0].name);
                    callback(null, singleProperty);
                }
            ], function (err, result) {
            });
        } else {
            setWindowAssociatedCompanies([]);
            configureAddNewPropertyBtn();
        }
    });
}

/*
 * All the action after change of companies dropdown
 * */
function companiesDropDownActions() {
    $('#companies-dd').on("change", function () {
        populateCompanyData(this.value, 0);
    });
}

/*
 * Show the thumbnail of the selected image on run time
 * */
function uploadImageActions() {
    /* show selected image on run time */
    $("#uploadImage").on("change", function () {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function () { // set image data as background of div
                $('#sampleImage').css('display', 'none');
                $('#imagePreview').css({'display': 'block', "background-image": "url(" + this.result + ")"});
            }
        }
    });
    /* show selected image on run time */
}

/*
 * Hide update property button and show add new property
 * */
function configureAddNewPropertyBtn() {
    $('#addPropertyBtn').text("Save");
    changeText('propertyHeader', 'ADD/EDIT PROPERTY');
    showSampleImage();
    resetForm('propertyForm');
}

/*
 * Hide add new property button and show update property
 * */
function configureUpdatePropertyBtn(propertyName) {
    $('#addPropertyBtn').text("Update");
    changeText('propertyHeader', 'Update ' + propertyName);
}

/*
 * set Window Associated Companies
 */
function setWindowAssociatedCompanies(val) {
    window.associatedCompanies = val;
}

/*
 * show sample noImg
 */
function showSampleImage() {
    $('#sampleImage').attr("src", "images/noImg.jpg").show();
    $('#imagePreview').hide();
}

