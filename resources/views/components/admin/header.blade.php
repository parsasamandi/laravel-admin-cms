<div class="container-fluid mt-3">
    {{-- Page Name --}}
    <h1 class="mt-4">{{ $pageName }}</h1>

    {{-- Breadcrumb --}}
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('adminHome') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">{{ $pageName }} List</li>
    </ol>

    {{-- Button --}}
    <button type="button" name="create_record" id="create_record"
        class="btn btn-success btn-sm mb-2">Add {{ $pageName }}</button>

    {{-- Responsive Table --}}
    <div class="table-responsive">
        {{ $table }}
    </div>
</div>
