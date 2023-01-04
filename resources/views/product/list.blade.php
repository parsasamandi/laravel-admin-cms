@extends('layouts.admin')
@section('title','Management of products')

@section('content')

  {{-- Header --}}
  <x-header pageName="Product" buttonValue="product">
    <x-slot name="table">
      <x-table :table="$productTable" />
    </x-slot>
  </x-header>

   {{-- Insert --}}
   <x-insert size="modal-l" formId="productForm">
    <x-slot name="content">
      {{-- Product form --}}
      <div class="row">
        {{-- Name --}}
        <x-input key="name" name="Name" class="col-md-12 mb-2" />
        {{-- Prpduct --}}
        <x-input key="price" name="Price" class="col-md-12 mb-3" />
        {{-- Phone number --}}
        <x-textarea key="description" placeholder="Description" class="col-md-12 mb-3" />
        {{-- Status --}}
        <div class="col-md-12">
          <label for="status">Choose the product status:</label>
          <select class="custom-select" name="status" id="status">
            <option value="0">available</option>
            <option value="1">unavailable</option>
          </select>
        </div>
      </div>
    </x-slot>
  </x-insert>

  {{-- Delete --}}
  <x-delete title="product"/>

@endsection


@section('scripts')
  @parent

  {{-- Product Table --}}
  {!! $productTable->scripts() !!}

  <script>
    $(document).ready(function () {
      // Product DataTable And Action Object
      let dt = window.LaravelDataTables['productTable'];
      let action = new RequestHandler(dt,'#productForm', 'product');

      // Record modal
      $('#create_record').click(function () {
        action.openModal();
      });

      // Export button
      $('#export_btn').click(function() {
        $.ajax({
          url: "{{ url('product/export') }}",
          method: "get",  
          success: function(data) {
            var url = "{{URL::to('product/export')}}?" 
            window.location = url;
          }
        })

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
          url: "{{ url('product/edit') }}",
          method: "get",
          data: {id: $id},
          success: function(data) {
            action.editOnSuccess($id);
            $('#name').val(data.name);
            $('#price').val(data.price);
            $('#description').val(data.description);
            $('#status').val(data.status);
          }
        })
      }
    });
  </script>
@endsection
