<!--Large Model start-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true" id="myModal">
    <div class="modal-dialog modal-lg2">
        <div class="modal-body f-arial">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" onclick="$('.modal').modal('hide');"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title f-arial" id="propertyHeader">ADD/EDIT PROPERTY</h4>
                </div>
                @include('properties.saveProperty')
            </div>
        </div>
    </div>
</div>