@extends('layouts.admin')
@section('title', 'Link List')

@section('content')
    {{-- Header --}}
    <x-admin.header pageName="Link">
        <x-slot name="table">
            {!! $linkTable->table(['class' => 'table table-striped table-bordered table-hover-responsive w-100 nowrap text-center']) !!}
        </x-slot>
    </x-admin.header>

    {{-- Insert Modal --}}
    <x-admin.insert size="modal-lg" formId="linkForm">
        <x-slot name="content">
            <div class="row">
                <div class="col-md-6 mb-3">
                    {{-- Text --}}
                    <label for="text">Text</label>
                    <input type="text" class="form-control" id="text" name="text" class="custom-file-input" placeholder="Text">
                </div>
                <div class="col-md-6 mb-3">
                    {{-- Link Url --}}
                    <label for="url">Link Url</label>
                    <textarea rows="5" type="url" class="form-control" id="link" name="link" class="custom-file-input" placeholder="Link Url"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    {{-- Description Text --}}
                    <label for="description">Description Text</label>
                    <select id="descriptionBox" name="descriptionBox" class="browser-default custom-select">
                        @foreach($descriptions as $desc)
                            <option value="{{ $desc->id }}">{{ $desc->desc }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </x-slot>
    </x-admin.insert>

    {{-- Delete Modal --}}
    <x-admin.delete title="Do you confirm to delete link?"/>
@endsection

{{-- Scripts --}}
@section('scripts')
@parent
    {{-- Link Table --}}
    {!! $linkTable->scripts() !!}

    <script>
        $(document).ready(function() {
            // Select2
            $('#descriptionBox').select2({width: '100%'});
            // Link Table
            let dt = window.LaravelDataTables['linkTable'];
            // Record Modal
            $('#create_record').click(function () {
                $('#formModal').modal('show');
                $('#linkForm')[0].reset();
                $('#form_output').html('');
            });
            // Create a new one
            $('#linkForm').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ route('link.store') }}",
                    method: "POST",
                    data: form_data,
                    processing: true,
                    dataType: "json",
                    success: function (data) { 
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output').html(error_html);
                        }
                        else {
                            $('#form_output').html(data.success);
                            $('#linkForm')[0].reset();
                            $('#button_action').val('insert');
                            dt.draw(false);
                        }
                    }
                })
            });
            // Edit
            window.showEditModal = function showEditModal(url) {
                editEducation(url);
            }
            function editEducation($url) {
                var id = $url;
                $('#formModal').modal('show');
                $('#form_output').html('');
                $.ajax({
                    url: "{{ route('link.edit') }}",
                    method: "get",
                    data: {id: id},
                    dataType: "json",
                    success: function(data) {
                        $('#id').val(id);
                        $('#button_action').val('update');
                        $('#text').val(data.text);
                        $('#link').val(data.link);
                        $('#desc_id').val(data.desc_id);
                        $('#descriptionBox').val(data.desc_id).trigger('change');
                    }
                })
            }
            // Delete
            window.showConfirmationModal = function showConfirmationModal(url) {
                deleteLink(url);
            }
            function deleteLink($url) {
                var id = $url;
                $('#confirmModal').modal('show');
                $('#ok_button').click(function () {
                    $.ajax({
                        url: "/link/delete/" + id,
                        method: "get",
                        dataType: "json",
                        success: function(data) {
                            $('#confirmModal').modal('hide');
                            dt.draw(false);
                        }
                    })
                });
            }
        });

    </script>
@endsection