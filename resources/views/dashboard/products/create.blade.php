@extends('layouts.dashboard')

@section('title','Create Product Page')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Create Product Page</li>
@endsection

@section('content')


@if ($errors->any())
    <div class="alert alert-primary">
        <ul>
            @foreach($errors->all() as $error)
                <li class="alert alert-danger">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="content">

    <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('dashboard.products._form',[
            'btn_name' => 'Submit',
        ])


    </form>

</div>


@endsection



{{-- 
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
@endpush

<script>
    var input = document.querySelector('input[name=tags]');
    new Tagify(input)
</script> --}}
