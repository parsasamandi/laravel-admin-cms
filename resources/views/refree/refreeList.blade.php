@extends('layouts.admin')
@section('title', 'Refree List')

@section('content')
    {{-- Header --}}
    <x-admin.header pageName="Refree">
        <x-slot name="table">
            {!! $refreeTable->table(['class' => 'table table-striped table-bordered table-hover-responsive w-100 nowrap text-center']) !!}
        </x-slot>
    </x-admin.header>

    {{-- Insert Modal --}}
    <x-admin.insert size="modal-lg" formId="refreeForm">
        <x-slot name="content">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="image">Image</label>
                    <br>
                    <input type="file" name="image">
                </div>
            </div>
            <div class="row">
                {{-- Name --}}
                <div class="col-md-6 mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" class="custom-file-input" placeholder="name">
                </div>
                {{-- Description --}}
                <div class="col-md-6 mb-3">
                    <label for="desc">Description</label>
                    <textarea rows="5" cols="50" id="desc" name="desc" class="form-control" placeholder="Description"></textarea>
                </div>
            </div>
            {{-- Website Link --}}
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="link">Website Link</label>
                    <input type="url" id="link" name="link" class="form-control" placeholder="ٌWebsite Link"></input>
                    @if($errors->has('link'))
                        <span class="error">{{ $errors->first('link') }}</span>
                    @endif
                </div>
            </div>
        </x-slot>
    </x-admin.insert>

    {{-- Delete Modal --}}
    <x-admin.delete title="Do you confirm to delete refree?"/>

@endsection

{{-- Scripts --}}
@section('scripts')
@parent
    {{-- Refree Table --}}
    {!! $refreeTable->scripts() !!}

    <script>
        $(document).ready(function() {
            // Refree Table
            let dt = window.LaravelDataTables['refreeTable'];

            // Record Modal
            $('#create_record').click(function () {
                $('#formModal').modal('show');
                $('#refreeForm')[0].reset();
                $('#form_output').html('');
                $('#action').val('Insert');
            });

            // Create a new one
            $('#refreeForm').on('submit', function(event) {
                event.preventDefault();
                var form_data = new FormData(this);
                form_data.append('file',form_data)
                $.ajax({
                    url: "{{ route('refree.store') }}",
                    method: "POST",
                    data: form_data,
                    processing: true,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) { 
                        $('#form_output').html(data.success);
                        $('#refreeForm')[0].reset();
                        $('#button_action').val('insert');
                        dt.draw(false);
                    },
                    error: function (data) {
                        // Parse To Json
                        var data = JSON.parse(data.responseText);
                        // Error
                        error_html = '';
                        for(var all in data.errors) {
                            error_html += '<div class="alert alert-danger">' + data.errors[all] + '</div>';
                        }
                        $('#form_output').html(error_html);
                    }
                })
            });

            // Edit
            window.showEditModal = function showEditModal(url) {
                editRefree(url);
            }
            function editRefree($url) {
                var id = $url;
                $('#formModal').modal('show');
                $('#form_output').html('');
                $.ajax({
                    url: "{{ route('refree.edit') }}",
                    method: "get",
                    data: {id: id},
                    dataType: "json",
                    success: function(data) {
                        $('#id').val(id);
                        $('#button_action').val('update');
                        $('#action').val('Update');
                        $('#name').val(data.name);
                        $('#desc').val(data.desc);
                        $('#link').val(data.link);
                    }
                })
            }

            // Delete
            window.showConfirmationModal = function showConfirmationModal(url) {
                deleteRefree(url);
            }
            function deleteRefree($url) {
                var id = $url;
                $('#confirmModal').modal('show');
                $('#ok_button').click(function () {
                    $.ajax({
                        url: "/refree/delete/" + id,
                        method: "get",
                        dataType: "json",
                        success: function(data) {
                            $('#confirmModal').modal('hide');
                            dt.draw(false);
                        }
                    })
                });
            };
        });

    </script>

@endsection