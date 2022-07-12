@extends('layouts.admin')
@section('title','Management of admins')

@section('content')

  {{-- Header --}}
  <x-header pageName="User" buttonValue="user">
    <x-slot name="table">
      <x-table :table="$userTable" />
    </x-slot>
  </x-header>

   {{-- Insert --}}
   <x-insert size="modal-l" formId="userForm">
    <x-slot name="content">
      {{-- User form --}}
      <div class="row">
        {{-- Name --}}
        <x-input key="name" name="Name" class="col-md-12 mb-2" />
        {{-- Email --}}
        <x-input key="email" name="Email addrees" class="col-md-12 mb-3" />
        {{-- Phone number --}}
        <x-input type="number" key="phone_number" name="Phone number" class="col-md-12 mb-3" />
        {{-- Passwords --}}
        <div class="col-md-12 mb-3">
          <label for="password">Password:</label>
          <input type="password" name="password" id="password" class="form-control" 
                    placeholder="Password" autocomplete="new-password">
        </div>
        <div class="col-md-12">
          <label for="password-confirm">Password confirmaion:</label>
          <input type="password" name="password-confirm" id="password-confirm" class="form-control" 
                    placeholder="Password confirmation" autocomplete="new-password">
        </div>
      </div>
    </x-slot>
  </x-insert>

  

  {{-- Delete --}}
  <x-delete title="user"/>

@endsection


@section('scripts')
  @parent

  {{-- User Table --}}
  {!! $userTable->scripts() !!}

  <script>
    $(document).ready(function () {
      // Admin DataTable And Action Object
      let dt = window.LaravelDataTables['userTable'];
      let action = new RequestHandler(dt,'#userForm', 'user');

      // Record modal
      $('#create_record').click(function () {
        action.openModal();
      });

      // Insert
      action.insert();

      // Delete
      window.showConfirmationModal = function showConfirmationModal(url) {
        action.delete(url);
      }
      // Edit
      window.showEditModal = function showEditModal(id) {
        edit(id);
      }
      function edit($id) {
        action.reloadModal();

        $.ajax({
          url: "{{ url('user/edit') }}",
          method: "get",
          data: {id: $id},
          success: function(data) {
            action.editOnSuccess($id);
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#phone_number').val(data.phone_number);
            $('#password').val('NewPassword');
            $('#password-confirm').val('NewPassword');
          }
        })
      }
    });
  </script>
@endsection
