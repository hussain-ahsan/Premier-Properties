<div id="YearAndTaxElement">
    <div class="row">
        <div class="panel-body">
            <form class="form-horizontal f-arial" role="form" method="POST" id="companyForm" name="companyForm">
                {!! csrf_field() !!}
                <div class="container-fluid" id="reports" style="margin-left: 0px; padding-left: 0px; right: 24px;">
                    <img id="loader" src="/images/loader.gif">
                    <div id="noRecord" style="display: none"> NO REPORTS FOUND</div>
                </div>
            </form>
        </div>
    </div>
</div>
