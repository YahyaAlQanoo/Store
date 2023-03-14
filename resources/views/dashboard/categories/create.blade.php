@extends('layouts.dashboard')

@section('title','Create Category Page')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Create Category Page</li>
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

    <form action="{{ route('dashboard.categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('dashboard.categories._form',[
            'btn_name' => 'Submit',
        ])


    </form>

</div>


@endsection
