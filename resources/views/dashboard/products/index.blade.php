    @extends('layouts.dashboard')

    @section('title','Products Page')

    @section('breadcrumb')
        @parent
        <li class="breadcrumb-item active">Products Page</li>
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

    {{--    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
            <input name="name" placeholder="Name" class="mx-2" value="{{ request('name') }}" />
            <select name="status" class="form-control mx-2">
                <option value="">All</option>
                <option value="active" @selected(request('status') == 'active')>Active</option>
                <option value="archived" @selected(request('status') == 'archived')>Archived</option>
            </select>
            <button class="btn btn-dark mx-2">Filter</button>
        </form>--}}

        <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary mb-5">Create</a>
        <a href="{{ route('dashboard.products.trash') }}" class="btn btn-dark mb-5">Trash</a>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>product Image</th>
                    <th>product Name</th>
                    <th> Product Category</th>
                    <th> Product Store</th>
                    <th>product description</th>
                    <th>product Price</th>
                    <th>product Compare Price</th>
                    <th>product featured</th>
                    <th>product Status</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>     <?php $i = 0 ?>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td><img src="{{ $product->image }}" alt="" width="40"></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->store->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->compare_price }}</td>
                        <td>{{ $product->featured }}</td>
                        <td>{{ $product->status }}</td>
                        <td><a href="{{ route('dashboard.products.edit', $product->id) }}" class="btn btn-success">Edit</a></td>
                        <td>
                            <form action="{{ route('dashboard.products.destroy',$product->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="8">Not Found products</td>
                    </tr>
                @endforelse

            </tbody>
        </table>

    </div>
    {{ $products->withQueryString()->appends(['my-name' => 'yahya'])->links() }}



    @endsection
