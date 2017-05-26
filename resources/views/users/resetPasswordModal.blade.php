<!--Large Model start-->
<div id="resetPasswordModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body f-arial">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close cancelResetModel" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Reset Password</h4>
                </div>

                @include('users.resetPassword')

            </div>
        </div>
    </div>
</div>