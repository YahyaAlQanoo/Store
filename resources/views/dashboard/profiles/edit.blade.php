@extends('layouts.dashboard')

@section('title','Profile Page')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Profile Page</li>
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

    <form action="{{ route('dashboard.profiles.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
<div class="container">
        <div class="form-group">
            <x-form.input label="First Name" name="first_name" :value="$user->profile->first_name" />
        </div>

        <div class="form-group">
            <x-form.input label="Last Name" name="last_name" :value="$user->profile->last_name" />
        </div>

        <div class="form-group">
            <x-form.input type="date" label="Birthday" name="birthday" :value="$user->profile->birthday" />
        </div>

        <div class="form-group">
            <label for="">Gender	</label>
            <div class="form-check">
                <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" value="male" id="flexRadi1joDefault1" @checked( old('gender',$user->profile->gender)   == 'male' ) >
                <label class="form-check-label" for="flexRadi1joDefault1">
                    Male
                </label>
                @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-check">
                <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" value="female" id="flexRadioDefault1" @checked( old('gender',$user->profile->gender)   == 'female' ) >
                <label class="form-check-label" for="flexRadioDefault1">
                    Female
                </label>
                @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

        </div>

        <div class="form-group">
            <x-form.input label="street_address" name="street_address" :value="$user->profile->street_address" />
        </div>

        <div class="form-group">
            <x-form.input label="city" name="city" :value="$user->profile->city" />
        </div>

        <div class="form-group">
            <x-form.input label="state" name="state" :value="$user->profile->state" />
        </div>

        <div class="form-group">
            <x-form.input label="postal_code" name="postal_code" :value="$user->profile->street_address" />
        </div>


        <div class="col-md-4">
            <x-form.select name="country" :options="$countries ?? '' " label="Country" :selected="$user->profile->country" />
        </div>

        <div class="col-md-4">
            <x-form.select name="locale" :options="$locales" label="Locale" :selected="$user->profile->locale" />
        </div>
        <button type="submit" class="btn btn-primary">Send</button>
    </div>


    </form>

</div>


@endsection
