<!-- Modal -->
<div id="yearAndTaxModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="$('.modal').modal('hide');">&times;</button>
                <h4 class="modal-title" id="propertyHeader">TAX RETURNS</h4>
            </div>
            <div class="modal-body">
                @include('properties.saveYearEndTax')
            </div>
        </div>
    </div>
</div>