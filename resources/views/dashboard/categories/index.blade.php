    @extends('layouts.dashboard')

    @section('title','Categories Page')

    @section('breadcrumb')
        @parent
        <li class="breadcrumb-item active">Categories Page</li>
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

        <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
            <input name="name" placeholder="Name" class="mx-2" value="{{ request('name') }}" />
            <select name="status" class="form-control mx-2">
                <option value="">All</option>
                <option value="active" @selected(request('status') == 'active')>Active</option>
                <option value="archived" @selected(request('status') == 'archived')>Archived</option>
            </select>
            <button class="btn btn-dark mx-2">Filter</button>
        </form>

        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary mb-5">Create</a>
        <a href="{{ route('dashboard.categories.trash') }}" class="btn btn-dark mb-5">Trash</a>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category Image</th>
                    <th>Category Name</th>
                    <th>Category Parent</th>
                    <th>Count Products</th>
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
                        <td> <a href="{{ route('dashboard.categories.show',$category->id) }}">  {{ $category->name }}  </a>  </td>
                        <td>{{ $category->parent->name }}</td>
                        <td>{{ $category->products_count }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->status }}</td>
                        <td><a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-success">Edit</a></td>
                        <td>
                            <form action="{{ route('dashboard.categories.destroy',$category->id) }}" method="post">
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
