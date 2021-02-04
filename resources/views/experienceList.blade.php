@extends('layouts.admin')
@section('title', 'Experience List')

@section('content')
    {{-- Header --}}
    <x-admin.header pageName="Experience">
        <x-slot name="table">
            {!! $experienceTable->table(['class' => 'table table-striped table-bordered table-hover-responsive w-100 nowrap text-center']) !!}
        </x-slot>
    </x-admin.header>

    {{-- Insert Modal --}}
    <x-admin.insert size="modal-lg" formId="experienceForm">
        <x-slot name="content">
            <div class="row">
                {{-- Title --}}
                <div class="col-md-6 mb-3">
                    <label for="title">Title</label>
                    <input id="title" name="title" type="text" class="form-control" placeholder="Title">
                </div>
                {{-- Image --}}
                <div class="col-md-6">
                    <input id="image" name="image" type="file">
                </div>
            </div>
    
        </x-slot>
    </x-admin.insert>

    {{-- Delete Modal --}}
    <x-admin.delete title="Do you confirm to delete experience?"/>
@endsection

{{-- Scripts --}}
@section('scripts')
@parent
    {{-- Experience Table --}}
    {!! $experienceTable->scripts() !!}

    <script>
        $(document).ready(function() {
            // Experience Table
            let dt = window.LaravelDataTables['experienceTable'];
            // Record Modal
            $('#create_record').click(function () {
                $('#formModal').modal('show');
                $('#experienceForm')[0].reset();
                $('#form_output').html('');
            });
            // Create a new one
            $('#experienceForm').on('submit', function(event) {
                event.preventDefault();
                var form_data = new FormData(this);
                form_data.append('file',form_data)
                $.ajax({
                    url: "{{ route('experience.store') }}",
                    method: "POST",
                    data: form_data,
                    processing: true,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
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
                            $('#experienceForm')[0].reset();
                            $('#button_action').val('insert');
                            dt.draw(false);
                        }
                    }
                })
            });
            // Edit
            window.showEditModal = function showEditModal(url) {
                editExperience(url);
            }
            function editExperience($url) {
                var id = $url;
                $('#formModal').modal('show');
                $('#form_output').html('');
                $.ajax({
                    url: "{{ route('experience.edit') }}",
                    method: "get",
                    data: {id: id},
                    dataType: "json",
                    success: function(data) {
                        $('#id').val(id);
                        $('#button_action').val('update');
                        $('#title').val(data.title);
                    }
                })
            }
            // Delete
            window.showConfirmationModal = function showConfirmationModal(url) {
                deleteDescription(url);
            }
            function deleteDescription($url) {
                var id = $url;
                $('#confirmModal').modal('show');
                $('#ok_button').click(function () {
                    $.ajax({
                        url: "/experience/delete/" + id,
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