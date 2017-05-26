<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title f-arial" id="companyHeader">ADD NEW COMPANY (LLC OF INVERSTOR)</h4>
            </div>
            <div class="modal-body f-arial p-b-0">
                @include('companies.saveCompany')
            </div>
        </div>
    </div>
</div>