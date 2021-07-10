<div class="container-fluid">
    {{-- List --}}
    <h2>{{ $pageName }} list</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ $pageName }} page</li>
    </ol>

    {{-- Button --}}
    @if($buttonValue != null)
        <button type="button" id="create_record"
            class="btn btn-primary btn-sm">Create {{ $buttonValue }}</button> 
        <hr>
    @endif
    
    {{-- Responsive table --}}
    <div class="table-responsive">
        {{ $table }}
    </div>
</div>
