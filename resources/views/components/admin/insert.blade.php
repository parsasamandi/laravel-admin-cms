<!-- Modal Creation -->
<div id="formModal" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog {{ $size }}">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="{{ $formId }}" class="form-horizontal" enctype="multipart/form-data">
          <span id="form_output"></span>
          {{csrf_field()}}

          {{-- Content --}}
          @if(isset($content))
            {{ $content }}
          @endif

          <br />
          <div class="form-group" align="center">
            <input type="hidden" name="id" id="id" value="" />
            <input type="hidden" name="button_action" id="button_action" value="insert" />
            <input type="submit" name="submit" id="action" value="Insert" class="btn btn-primary" />
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>