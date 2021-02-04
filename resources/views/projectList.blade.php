@extends('layouts.admin')
@section('title', 'Project List')

@section('content')
    {{-- Header --}}
    <x-admin.header pageName="Project">
        <x-slot name="table">
            {!! $projectTable->table(['class' => 'table table-striped table-bordered table-hover-responsive w-100 nowrap text-center']) !!}
        </x-slot>
    </x-admin.header>

    {{-- Insert Modal --}}
    <x-admin.insert size="modal-l" formId="projectForm">
        <x-slot name="content">
            {{-- Title --}}
            <div class="row">
                <div class="col-md-12 mb-3">
                    <input type="text" id="name" name="name" placeholder="Title" class="form-control">
                </div>
            </div>
            <div class="row">
                {{-- ‌Background Color --}}
                <div class="col-md-6 mb-3">
                    <input type="text" id="background" name="background" placeholder="Background-color" class="form-control">
                </div>
                {{-- Section Id --}}
                <div class="col-md-6 mb-3">
                    <input type="text" id="section_id" name="section_id" placeholder="Section Id" class="form-control" required>
                </div>
            </div>
        </x-slot>
    </x-admin.insert>

    {{-- Delete Modal --}}
    <x-admin.delete title="Do you confirm to delete project?"/>
@endsection

{{-- Scripts --}}
@section('scripts')
@parent
    {{-- Description Table --}}
    {!! $projectTable->scripts() !!}

    <script>
        $(document).ready(function() {
            // Description Table
            let dt = window.LaravelDataTables['projectTable'];
            // Record Modal
            $('#create_record').click(function () {
                $('#formModal').modal('show');
                $('#projecForm')[0].reset();
                $('#form_output').html('');
                $('#action').val('Insert');
            });
            // Create a new one
            $('#projectForm').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ route('project.store') }}",
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
                            $('#projectForm')[0].reset();
                            $('#button_action').val('insert');
                            dt.draw(false);
                        }
                    }
                })
            });
            // Edit
            window.showEditModal = function showEditModal(url) {
                editProject(url);
            }
            function editProject($url) {
                var id = $url;
                $('#formModal').modal('show');
                $('#form_output').html('');
                $.ajax({
                    url: "{{ route('project.edit') }}",
                    method: "get",
                    data: {id: id},
                    dataType: "json",
                    success: function(data) {
                        $('#name').val(data.name);
                        $('#background').val(data.background);
                        $('#section_id').val(data.section_id);
                    }
                })
            }
            // Delete
            window.showConfirmationModal = function showConfirmationModal(url) {
                deleteProject(url);
            }
            function deleteProject($url) {
                var id = $url;
                $('#confirmModal').modal('show');
                $('#ok_button').click(function () {
                    $.ajax({
                        url: "/project/delete/" + id,
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