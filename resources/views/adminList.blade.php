@extends('layouts.admin')
@section('title', 'لیست ادمین')


@section('content')
    {{-- Header --}}
    <x-admin.header pageName="Admin">
        <x-slot name="table">
            {!! $adminTable->table(['class' => 'table table-striped table-bordered table-hover-responsive w-100 nowrap text-center']) !!}
        </x-slot>
    </x-admin.header>

    {{-- Insert Modal --}}
    <x-admin.insert size="modal-l" formId="adminForm">
        <x-slot name="content">
            <div class="row">
                {{-- Name --}}
                <div class="col-md-12 mb-3">
                    <label for="name">Name:</label>
                    <input name="name" id="name" type="text" class="form-control" placeholder="Name">
                </div>
                {{-- Email --}}
                <div class="col-md-12 mb-3">
                    <label for="email">Email:</label>
                    <input name="email" id="email" type="email" class="form-control" placeholder="Email">
                </div>
                {{-- New Password --}}
                <div class="col-md-12 mb-3">
                    <label for="password">New Password:</label>
                    <input name="password" id="password" class="form-control" placeholder="New Password">
                </div>
                {{-- Password Confirmation --}}
                <div class="col-md-12 mb-3">
                    <label for="password2">Password Confirmation:</label>
                    <input name="password2" id="password2"  class="form-control" placeholder="New Password Confirmation">
                </div>
            </div>
        </x-slot>
    </x-admin.insert>

    {{-- Delete Modal --}}
    <x-admin.delete title="Do you confirm to delete the admin?" />
@endsection

@section('scripts')
@parent

    {{-- Admin Table --}}
    {!! $adminTable->scripts() !!}

    <script>
        $(document).ready(function() {
            // Admin DataTable
            let dt = window.LaravelDataTables['adminTable'];
            // Record Modal
            $('#create_record').click(function () {
                $('#formModal').modal('show');
                $('#adminForm')[0].reset();
                $('#form_output').html('');
            });
            // Create a new one
            $('#adminForm').on('submit', function (event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ route('admin.store') }}",
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
                            $('#adminForm')[0].reset();
                            $('#button_action').val('insert');
                            dt.draw(false);
                        }
                    }
                })
            });
            // Delete 
            window.showConfirmationModal = function showConfirmationModal(url) {
                deleteAdmin(url);
            }
            function deleteAdmin($url) {
                var id = $url;
                $('#confirmModal').modal('show');
                $('#ok_button').click(function() {
                    $.ajax({
                        url: "{{ url('admin.delete/') }}" + id,
                        method: "get",
                        dataType: "json",
                        success: function(data) {
                            $('#confirmModal').modal('hide');
                            dt.draw(false);
                        }
                    })
                });
            }
            // Edit
            window.showEditModal = function showEditModal(url) {
                editAdmin(url);
            }
            function editAdmin($url) {
                var id = $url;
                $('#formModal').modal('show');
                $('#form_output').html('');
                $.ajax({
                    url: "{{ route('admin.edit') }}",
                    method: "get",
                    data: {id: id},
                    dataType: "json",
                    success: function(data) {
                        $('#name').val(data.name);
                        $('#email').val(data.email);
                        $('#password').val('New Passwrod');
                        $('#password2').val('New Password');
                        $('#id').val(id);
                        $('#button_action').val('update');
                    }
                })
            }
        });
    </script>

@endsection