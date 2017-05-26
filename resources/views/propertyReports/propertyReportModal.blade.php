<script src="{{asset('assets/js/custom/general.js')}}"></script>
<!--Large Model start-->
<div class="modal fade bs-example-modal-lg reports-model" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true" id="propertyReportModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-body">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close cancelModel" aria-hidden="true">&times;</button>
                    <h4 class="modal-title f-arial" id="myModalLabel">REPORT</h4>
                </div>

                @include('propertyReports.savePropertyReport')

            </div>
        </div>
    </div>
</div>