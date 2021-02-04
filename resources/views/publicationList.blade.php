@extends('layouts.admin')
@section('title','Publication List')

@section('content')
    {{-- Header --}}
    <x-admin.header pageName="Publication">
        <x-slot name="table">
            {!! $publicationTable->table(['class' => 'table table-striped table-bordered w-100 nowrap text-center']) !!}
        </x-slot>
    </x-admin.header>

    {{-- Insert Modal --}}
    <x-admin.insert size="modal-l" formId="publicationForm">
        <x-slot name="content">
            <div class="row">
                {{-- Title --}}
                <div class="col-md-12">
                    <label for="title"></label>
                    <input id="title" name="title" Placeholder="Title" type="text" class="form-control">
                </div>
            </div>
        </x-slot>
    </x-admin.insert>

    {{-- Delete Modal --}}
    <x-admin.delete title="Do you confirm to delete publication?" />
@endsection

{{-- Scripts --}}
@section('scripts')
@parent
    {{-- Publication Table --}}
    {!! $publicationTable->scripts() !!}

    <script>
        $(document).ready(function() {
            // Publication Table
            let dt = window.LaravelDataTables['publicationTable'];
            // Record Modal
            $('#create_record').click(function () {
                $('#formModal').modal('show');
                $('#publicationForm')[0].reset();
                $('#form_output').html('');
                $('#action').val('Insert');
            });
            // Create a new one
            $('#publicationForm').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ route('publication.store') }}",
                    method: "POST",
                    data: form_data,
                    processing: true,
                    dataType: "json",
                    success: function (data) { 
                        $('#form_output').html(data.success);
                        $('#publicationForm')[0].reset();
                        $('#button_action').val('insert');
                        dt.draw(false);
                    },
                    error: function(data) { 
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
                editPublication(url);
            }
            function editPublication($url) {
                var id = $url;
                $('#formModal').modal('show');
                $('#form_output').html('');
                $.ajax({
                    url: "{{ route('publication.edit') }}",
                    method: "get",
                    data: {id: id},
                    dataType: "json",
                    success: function(data) {
                        // Get Values From Database
                        $('#id').val(data.id);
                        $('#button_action').val('update');
                        $('#action').val('Update');
                        $('#title').val(data.title);
                    }
                })
            }
            // Delete
            window.showConfirmationModal = function showConfirmationModal(url) {
                deletePublication(url);
            }
            function deletePublication($url) {
                var id = $url;
                $('#confirmModal').modal('show');
                $('#ok_button').click(function () {
                    $.ajax({
                        url: "/publication/delete/" + id,
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