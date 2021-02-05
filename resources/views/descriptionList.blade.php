@extends('layouts.admin')
@section('title', 'Description List')

@section('content')
    {{-- Header --}}
    <x-admin.header pageName="Description">
        <x-slot name="table">
            {!! $descriptionTable->table(['class' => 'table table-striped table-bordered w-100 nowrap text-center']) !!}
        </x-slot>
    </x-admin.header>

    {{-- Insert Modal --}}
    <x-admin.insert size="modal-xl" formId="descriptionForm">
        <x-slot name="content">
            <div class="row">
                {{-- Description --}}
                <div class="col-md-12 mb-3">
                    <textarea rows="7" cols="50" type="text" id="desc" name="desc" placeholder="Description" class="form-control"></textarea>
                </div>
            </div>
            <div class="row">
                {{-- Project Name --}}
                <div class="col-md-6 mb-3">
                    <label for="projectBox">Project Name(If your description belongs to it)</label>
                    <select id="projectBox" name="projectBox" class="browser-default custom-select">
                        <option value="">Null</option>
                        @foreach($projects as $project)
                            <option name="project" value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- Experience --}}
                <div class="col-md-6 mb-3">
                    <label for="experienceBox">Experience(If your description belongs to it)</label>
                    <select id="experienceBox" name="experienceBox" class="browser-default custom-select">
                        <option value="">Null</option>
                        @foreach($experiences as $experience)
                            <option name="experience" value="{{ $experience->id }}">{{ $experience->title }}</option>
                        @endforeach
                    </select>
                </div>   
            </div>   
            <div class="row">
                {{-- Publication --}}
                <div class="col-md-6 mb-2">
                    <label for="publicationBox">Publication</label>
                    <select name="publicationBox" id="publicationBox" class="browser-default custom-select">
                        <option value="">Null</option>
                        @foreach($publications as $publication) 
                            <option value="publication" value="{{ $publication->id }}"></option>
                        @endforeach
                    </select>
                </div>
                {{-- Get col-md size from 1 to 12 --}}
                <div class="col-md-6 mb-3">
                    <label for="size">Size(Choose a number from 1 to 12)</label>
                    <input type="text" class="form-control" id="size" name="size" class="custom-file-input" placeholder="Size">
                </div>
            </div>

        </x-slot>
    </x-admin.insert>

    {{-- Delete Modal --}}
    <x-admin.delete title="Do you confirm to delete description?"/>
@endsection

{{-- Scripts --}}
@section('scripts')
@parent
    {{-- Description Table --}}
    {!! $descriptionTable->scripts() !!}

    <script>
        $(document).ready(function() {
            // Description Table
            let dt = window.LaravelDataTables['descriptionTable'];
            // Select2
            $('#projectBox').select2({ width: '100%' });
            $('#experienceBox').select2({ width: '100%' });
            // Record Modal
            $('#create_record').click(function () {
                $('#formModal').modal('show');
                $('#descriptionForm')[0].reset();
                $('#form_output').html('');
                var x = document.getElementById("publicationBox");
                x.style.visibility = 'hidden';
                /// Do It With Jquery
            });
            // Create a new one
            $('#descriptionForm').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ route('description.store') }}",
                    method: "POST",
                    data: form_data,
                    processing: true,
                    dataType: "json",
                    success: function (data) { 
                        $('#form_output').html(data.success);
                        $('#descriptionForm')[0].reset();
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
                editDescription(url);
            }
            function editDescription($url) {
                var id = $url;
                $('#formModal').modal('show');
                $('#form_output').html('');
                $.ajax({
                    url: "{{ route('description.edit') }}",
                    method: "get",
                    data: {id: id},
                    dataType: "json",
                    success: function(data) {
                        // Get Values From Database
                        $('#id').val(data.id);
                        $('#button_action').val('update');
                        $('#action').val('Update');
                        $('#desc').val(data.desc);
                        $('#experienceBox').val(data.experience_id).trigger('change');
                        $('#projectBox').val(data.project_id).trigger('change');
                        $('#size').val(data.size);
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
                        url: "/description/delete/" + id,
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