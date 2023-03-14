    @extends('layouts.dashboard')

    @section('title','Product Show Page')

    @section('breadcrumb')
        @parent
        <li class="breadcrumb-item active">Product Show Page</li>
    @endsection

    @section('content')



<x-alert type='success' color='success' />
<x-alert type='update' color='primary' />
<x-alert type='deleted' color='danger' />
{{-- @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif --}}

{{-- @if (session('update'))
    <div class="alert alert-primary">
        {{ session('update') }}
    </div>
@endif

@if (session('deleted'))
    <div class="alert alert-danger">
        {{ session('deleted') }}
    </div>
@endif --}}



    <div class="content">


        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th> Name</th>
                    <th>Description</th>
                    <th> Store</th>
                    <th> Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $products = $category->products()->with('store')->paginate(3);
                @endphp

                @forelse ($products as $product)
                    <tr>
                        <td><img src="{{ $product->image }}" alt="" width="40"></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->store->name }}</td>
                        <td>{{ $product->status }}</td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="8">Not Found Categories</td>
                    </tr>
                @endforelse

            </tbody>
        </table>

    </div>
    {{ $products->links() }}



    @endsection
