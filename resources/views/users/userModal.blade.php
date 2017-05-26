<!--Large Model start-->
<div id="userModal" class="modal fade bs-example-modal-lg " tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-body f-arial">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close cancelModel" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title f-arial" id="userModelTitle">ADD NEW USER</h4>
                </div>

                @include('users.saveUser')

            </div>
        </div>
    </div>
</div>