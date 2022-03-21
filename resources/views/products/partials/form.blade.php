@csrf

@if (request()->is('products/create'))
<div class="mb-3">
    <input class="form-control" type="file" id="image" name="image">
    @error('image')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
@endif
@error('image')
    <small class="text-danger">{{ $message }}</small>
    @enderror

<div class="mb-3">
    <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ $product->name ?? old('name') }}">
    @error('name')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <textarea name="description" id="description" rows="8" class="form-control" placeholder="Description">{{ $product->description ?? old('description') }}</textarea>
    @error('description')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="input-group mb-3">
    <span class="input-group-text" id="price">Rp</span>
    <input type="number" class="form-control" name="price" id="price" placeholder="Price" value="{{ $product->price ?? old('price') }}">
    @error('price')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <input type="number" class="form-control" name="stock" id="stock" placeholder="Stock" value="{{ $product->stock ?? old('stock') }}">
    @error('stock')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<button class="btn btn-primary w-100">Submit</button>
