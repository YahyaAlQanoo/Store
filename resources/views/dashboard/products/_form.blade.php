<div class="form-group">
    <x-form.input label="Product Name" name="name" :value="$product->name" />
</div>
<div class="form-group">
    <label for="name" class="form-label">Image</label>
    <input type="file" id="name" name="image" class="form-control @error('image') is-invalid @enderror" >
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    <img src="{{ $product->image }}" alt="" width="40">

</div>

<div class="form-group">
    <label class="form-label">Product Category	</label>
    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
            <option value="">No Select Data</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"  @selected($category->id == old('category_id', $product->category_id) )  >{{ $category->name }}</option>
        @endforeach
    </select>
    @error('parent_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

</div>

<div class="form-group">
    <label class="form-label">Product Store</label>
    <select name="store_id" class="form-control @error('store_id') is-invalid @enderror">
            <option value="">No Select Data</option>
        @foreach ($stores as $store)
            <option value="{{ $store->id }}"  @selected($store->id == old('store_id',$product->store_id) )  >{{ $store->name }}</option>
        @endforeach
    </select>
    @error('store_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

</div>

<div class="form-group">
    <x-form.label >Product Description</x-form.label>
    <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description',$product->description) }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

</div>


<div class="form-group">
    <x-form.input label="Product Price" name="price" :value="$product->price" />
</div>

<div class="form-group">
    <x-form.input label="product Compare Price" name="compare_price" :value="$product->compare_price" />
</div>

<div class="form-group">
    <x-form.input label="product featured" name="featured" :value="$product->featured" />
</div>

<div class="form-group">
    <x-form.input label="Product Tags" name="tags" :value="$tags" autofocus/>
</div>



<div class="form-group">
    <label for="">product Status	</label>
    <div class="form-check">
        <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" value="active" id="flexRadioDefault1" @checked( old('status',$product->status)   == 'active' ) >
        <label class="form-check-label" for="flexRadioDefault1">
            Active
        </label>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

      </div>
      <div class="form-check">
        <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" value="inactive" id="flexRadioDefault2"  @checked(old('status',$product->status) == 'inactive' )>
        <label class="form-check-label" for="flexRadioDefault2">
            InActive
        </label>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

      </div>
</div>

<button type="submit" class="btn btn-primary">{{ $btn_name }}</button>



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
