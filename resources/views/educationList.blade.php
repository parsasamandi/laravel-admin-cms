@extends('layouts.admin')
@section('title', 'Education List')

@section('content')
    {{-- Header --}}
    <x-admin.header pageName="Education">
        <x-slot name="table">
            {!! $educationTable->table(['class' => 'table table-striped table-bordered table-hover-responsive w-100 nowrap text-center']) !!}
        </x-slot>
    </x-admin.header>

    {{-- Insert Modal --}}
    <x-admin.insert size="modal-xl" formId="educationForm">
        <x-slot name="content">
            {{-- Name --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name">Name</label>
                    <input id="name" name="name" type="text" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="row">
                {{-- Degree --}}
                <div class="col-md-6 mb-3">
                    <label for="Degree">Degree</label>
                    <textarea id="degree" name="degree" class="form-control" placeholder="Degree"></textarea>
                </div>
                {{-- TOEFL --}}
                <div class="col-md-6 mb-3">
                    <label for="toefl">TOEFL</label>
                    <textarea id="toefl" name="toefl" class="form-control" placeholder="TOEFL"></textarea>
                </div>
            </div>
            <div class="row">
                {{-- GPA --}}
                <div class="col-md-6 mb-3">
                    <label for="GPA">GPA</label>
                    <textarea id="GPA" name="GPA" class="form-control" placeholder="GPA"></textarea>
                </div>
                {{-- Education Period --}}
                <div class="col-md-6 mb-3">
                    <label for="period">Education Period</label>
                    <textarea id="period" name="period" class="form-control" placeholder="Period"></textarea>
                </div>
            </div>
            <div class="row">
                {{-- University Description --}}
                <div class="col-md-6 mb-3">
                    <label for="university_description">University Description</label>
                    <textarea id="university_description" name="university_description" class="form-control" placeholder="University description"></textarea>
                </div>
                {{-- Thesis Topic --}}
                <div class="col-md-6 mb-3">
                    <label for="thesis_topic">Thesis topic</label>
                    <textarea id="thesis_topic" name="thesis_topic" class="form-control" placeholder="Thesis topic"></textarea>
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
    {!! $educationTable->scripts() !!}

    <script>
        $(document).ready(function() {
            // Description Table
            let dt = window.LaravelDataTables['educationTable'];
            // Select2
            $('#projectBox').select2({ width: '100%' });
            $('#experienceBox').select2({ width: '100%' });
            // Record Modal
            $('#create_record').click(function () {
                $('#formModal').modal('show');
                $('#adminForm')[0].reset();
                $('#form_output').html('');
            });
            // Create a new one
            $('#educationForm').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ route('education.store') }}",
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
                            $('#educationForm')[0].reset();
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
                    url: "{{ route('education.edit') }}",
                    method: "get",
                    data: {id: id},
                    dataType: "json",
                    success: function(data) {
                        $('#id').val(id);
                        $('#name').val(data.name);
                        $('#degree').val(data.degree);
                        $('#toefl').val(data.TOEFL);
                        $('#GPA').val(data.GPA);
                        $('#period').val(data.education_period);
                        $('#university_description').val(data.education_period);
                        $('#desc').val(data.desc);
                        $('#thesis_topic').val(data.Thesis_topic);
                        $('#experienceBox').val(data.experience_id).trigger('change');
                        $('#projectBox').val(data.project_id).trigger('change');
                        $('#size').val(data.size);
                        $('#button_action').val('update');
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
                        url: "/education/delete/" + id,
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