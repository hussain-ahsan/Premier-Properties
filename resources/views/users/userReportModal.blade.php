<!--Large Model start-->
<div id="userReportModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body f-arial">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" id="userReportModalClose" aria-hidden="true">&times;</button>
                    <h4 class="modal-title f-arial" id="userReportModelTitle">Upload User Report</h4>
                </div>

                @include('users.saveUserReport')

            </div>
        </div>
    </div>
</div>