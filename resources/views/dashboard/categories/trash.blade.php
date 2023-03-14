    @extends('layouts.dashboard')

    @section('title','Categories Trashed')

    @section('breadcrumb')
        @parent
        <li class="breadcrumb-item active">Categories Trashed</li>
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


        <a href="{{ route('dashboard.categories.index') }}" class="btn btn-primary mb-5">Back</a>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category Image</th>
                    <th>Category Name</th>
                    <th>Category description</th>
                    <th>Category Status</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>     <?php $i = 0 ?>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td><img src="{{asset('storage/' . $category->image) }}" alt="" width="40"></td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->status }}</td>
                        <td>
                            <form action="{{ route('dashboard.categories.restore',$category->id) }}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-outline-dark">Restore</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('dashboard.categories.forcdelete',$category->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="8">Not Found Categories</td>
                    </tr>
                @endforelse

            </tbody>
        </table>

    </div>
    {{ $categories->withQueryString()->appends(['my-name' => 'yahya'])->links() }}



    @endsection
