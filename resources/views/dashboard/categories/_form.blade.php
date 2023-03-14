<div class="form-group">
    <x-form.input label="Categoey Name" name="name" :value="$category->name" />
</div>
<div class="form-group">
    <label for="name" class="form-label">Image</label>
    <input type="file" id="name" name="image" class="form-control @error('image') is-invalid @enderror" >
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    <img src="{{asset('storage/' . $category->image) }}" alt="" width="40">

</div>

<div class="form-group">
    <label class="form-label">Parent Name</label>
    <select name="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
            <option value="">No Select Data</option>
        @foreach ($parents as $parent)
            <option value="{{ $parent->id }}"  @selected($parent->id == old('parent_id',$category->parent_id) )  >{{ $parent->name }}</option>
        @endforeach
    </select>
    @error('parent_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

</div>

<div class="form-group">
    <x-form.label >Categoey Description</x-form.label>
    <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description',$category->description) }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

</div>
<div class="form-group">
    <div class="form-check">
        <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" value="active" id="flexRadioDefault1" @checked( old('status',$category->status)   == 'active' ) >
        <label class="form-check-label" for="flexRadioDefault1">
            Active
        </label>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

      </div>
      <div class="form-check">
        <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" value="inactive" id="flexRadioDefault2"  @checked(old('status',$category->status) == 'inactive' )>
        <label class="form-check-label" for="flexRadioDefault2">
            InActive
        </label>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

      </div>
</div>

<button type="submit" class="btn btn-primary">{{ $btn_name }}</button>
