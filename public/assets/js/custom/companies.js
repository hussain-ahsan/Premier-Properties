$(document).ready(function ($) {
    async.parallel([
            function (callback) {
                addCompanyAction();
                callback(null, 'add company action loaded');
            },
            function (callback) {
                submitCompanyForm();
                callback(null, 'submit company form loaded');
            },
            function (callback) {
                initializeCompaniesTable();
                callback(null, 'companies table initialized');
            }
        ],
        function (err, results) {
        });
});

function initializeCompaniesTable() {
    $('#tableData').DataTable({
        bFilter: false,
        bInfo: true,
        aaSorting: [[6, 'desc']]
    });

    $('#tableData').on( 'page.dt', function () {
        paginateScroll();
        console.log('scroll now');
    });
}
/*update company function*/
function updateCompany(formData, bit) {
    $.ajax({
        type: "POST",
        beforeSend: function (request) {
            request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="_token"]').attr('content'));
        },
        url: bit != 1 ? '/saveCompany' : '/updateCompany',
        data: formData,
        dataType: 'json',
        success: function (data) {
            console.log('resp: ', data);
            if (data.status == "success") {
                window.location = '/companies'
            } else {
                message = data && data.message ? data.message : 'Something went wrong..!';
                showErrorMessage('myModal', 'errorMessage', message);
            }
        },
        error: function (e) {
            var errors = e && e.responseJSON ? e.responseJSON : '';
            var message = errors.ein ? errors.ein : errors.email ? errors.email : 'Something went wrong..!';
            showErrorMessage('myModal', 'errorMessage', message);
        }
    });
};

function editCompany(obj) {
    var parsedResponse = JSON.parse($(obj).attr('custom-data'));
    window.form_original_data = $("#companyForm").serialize();
    setWindowUpdate(1);

    $(Object.keys(parsedResponse)).each(function (index, key) {
        $('#' + key).val(parsedResponse[key]);
    });
    $("#company_id").val(parsedResponse.id);

    showUpdateCompany();
    setCompanyModalHeader("Update Company (LLC of Investor)");
    configureModal('myModal');
    showModal('myModal')
}

function submitCompanyForm() {
    /*Company Form Submit*/
    $("#companyForm").validate({
        rules: {
            name: "required",
            ein: "required",
            phone: "required",
            email: {
                required: true,
                email: true
            },
            contact: "required",
            address: "required",
            city: "required",
            states: "required",
            zip: "required"
        },
        messages: {
            name: "Please specify company name",
            ein: "Please specify company ein",
            email: 'Please specify company email',
            phone: 'Please specify company phone',
            contact: 'Please specify company contact',
            address: 'Please specify company address',
            city: 'Please specify company city',
            states: 'Please specify company states',
            zip: 'Please specify company zip'
        },
        errorPlacement: function (error, element) {
            $("#" + element.attr("id")).parent().append(error).css({color: "red"});
        },
        submitHandler: function (form) {
            var formData = $('#companyForm').serialize();
            if (window.update == 1) {
                if (formData != window.form_original_data)
                    updateCompany(formData, 1); //1 to update company
            } else {
                updateCompany(formData, 0); //0 to create company
            }
        }
    });
}

/*
 * Add Company event
 * */
function addCompanyAction() {
    $("#addCompany").click(function () {
        setWindowUpdate(0);
        resetForm('companyForm');
        setCompanyModalHeader("Add New Company (LLC of Investor)");
        showAddCompany();
        configureModal('myModal');
        showModal('myModal')
    });
}

function setCompanyModalHeader(headerText) {
    $("#companyHeader").html(headerText);
}

function showAddCompany() {
    $("#addCompanyBtn").text("Save");
}

function showUpdateCompany() {
    $("#addCompanyBtn").text("Update");
}

function setWindowUpdate(val) {
    window.update = val;
}
