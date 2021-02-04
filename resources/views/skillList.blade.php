@extends('layouts.admin')
@section('title','Skill List')

@section('content')
    {{-- Header --}}
    <x-admin.header pageName="Skill">
        <x-slot name="table">
            {!! $skillTable->table(['class' => 'table table-striped table-bordered w-100 nowrap text-center']) !!}
        </x-slot>
    </x-admin.header>

    {{-- Insert Modal --}}
    <x-admin.insert size="modal-l" formId="skillForm">
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
    <x-admin.delete title="Do you confirm to delete skill?" />
@endsection

{{-- Scripts --}}
@section('scripts')
@parent
    {{-- Skill Table --}}
    {!! $skillTable->scripts() !!}

    <script>
        $(document).ready(function() {
            // SKill Table
            let dt = window.LaravelDataTables['skillTable'];
            // Record Modal
            $('#create_record').click(function () {
                $('#formModal').modal('show');
                $('#skillForm')[0].reset();
                $('#form_output').html('');
            });
            // Create a new one
            $('#skillForm').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ route('skill.store') }}",
                    method: "POST",
                    data: form_data,
                    processing: true,
                    dataType: "json",
                    success: function (data) { 
                        $('#form_output').html(data.success);
                        $('#skillForm')[0].reset();
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
                editSkill(url);
            }
            function editSkill($url) {
                var id = $url;
                $('#formModal').modal('show');
                $('#form_output').html('');
                $.ajax({
                    url: "{{ route('skill.edit') }}",
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
                deleteSkill(url);
            }
            function deleteSkill($url) {
                var id = $url;
                $('#confirmModal').modal('show');
                $('#ok_button').click(function () {
                    $.ajax({
                        url: "/skill/delete/" + id,
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