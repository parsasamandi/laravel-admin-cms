{{-- Delete modal --}}
<div id="confirmationModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center">
                <h5 class="mb-0">Are you sure to delete {{ $title }}?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" id="deleteSubmission" class="btn btn-danger">Submit</button>
                <button type="button" class="btn btn-opaque" data-dismiss="modal">Close</button>
                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
            </div>
        </div>
    </div>
</div>
