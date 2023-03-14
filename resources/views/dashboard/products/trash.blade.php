    @extends('layouts.dashboard')

    @section('title','Products Trashed')

    @section('breadcrumb')
        @parent
        <li class="breadcrumb-item active">Products Trashed</li>
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


        <a href="{{ route('dashboard.products.index') }}" class="btn btn-primary mb-5">Back</a>
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
                        <td>{{ $product->category_id }}</td>
                        <td>{{ $product->store_id }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->compare_price }}</td>
                        <td>{{ $product->featured }}</td>
                        <td>{{ $product->status }}</td>
                        <td>
                            <form action="{{ route('dashboard.products.restore',$product->id) }}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-outline-dark">Restore</button>
                            </form>
                        </td>
                        
                        <td>
                            <form action="{{ route('dashboard.products.forcdelete',$product->id) }}" method="post">
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
