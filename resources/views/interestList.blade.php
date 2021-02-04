@extends('layouts.admin')
@section('title', 'Interest List')

@section('content')
    {{-- Header --}}
    <x-admin.header pageName="Interest">
        <x-slot name="table">
            {!! $interestTable->table(['class' => 'table table-striped table-bordered table-hover-responsive w-100 nowrap text-center']) !!}
        </x-slot>
    </x-admin.header>

    {{-- Insert Modal --}}
    <x-admin.insert size="modal-lg" formId="interestForm">
        <x-slot name="content">
            <div class="row">
                {{-- Title --}}
                <div class="col-md-6 mb-3">
                    <label for="title">Title</label>
                    <input id="title" name="title" type="text" class="form-control" placeholder="Title">
                </div>
                {{-- Image --}}
                <div class="col-md-6">
                    <label for="imageBox">Image Url:</label>
                    <select name="imageBox" id="imageBox" class="browser-default custom-select">
                        @foreach($medias as $media) 
                            <option value="{{ $media->id }}">{{ $media->media_url }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- Showing Image --}}
            <div class="row">
                <div class="col-md-12">
                    <img class="full-size" id="image" />
                </div>
            </div>
        </x-slot>
    </x-admin.insert>

    {{-- Delete Modal --}}
    <x-admin.delete title="Do you confirm to delete interest?"/>
@endsection

{{-- Scripts --}}
@section('scripts')
@parent
    {{-- Interest Table --}}
    {!! $interestTable->scripts() !!}

    <script>
        $(document).ready(function() {
            // Interest Table
            let dt = window.LaravelDataTables['interestTable'];

            // Select2
            $('#imageBox').select2({width: '100%'});

            // Record Modal
            $('#create_record').click(function () {
                $('#formModal').modal('show');
                $('#interestForm')[0].reset();
                $('#form_output').html('');
                $('#action').val('Insert');
            });

            // Create a new one
            $('#interestForm').on('submit', function(event) {
                event.preventDefault();
                var form_data = new FormData(this);
                form_data.append('file',form_data)
                $.ajax({
                    url: "{{ route('interest.store') }}",
                    method: "POST",
                    data: form_data,
                    processing: true,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) { 
                        $('#form_output').html(data.success);
                        $('#interestForm')[0].reset();
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
                editExperience(url);
            }
            function editExperience($url) {
                var id = $url;
                $('#formModal').modal('show');
                $('#form_output').html('');
                $.ajax({
                    url: "{{ route('interest.edit') }}",
                    method: "get",
                    data: {id: id},
                    dataType: "json",
                    success: function(data) {
                        $('#id').val(id);
                        $('#button_action').val('update');
                        $('#action').val('Update');
                        $('#title').val(data.title);
                        $('#imageBox').val(data.media_id).trigger('change');
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
                        url: "/interest/delete/" + id,
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
        
        // Image
        $imageBox = document.getElementById("imageBox").onchange = setImage;
        function setImage() {
            var img = document.getElementById("image");
            img.src = "/images/" + imageBox.options[imageBox.selectedIndex].text;
            return true;
        }

    </script>

@endsection