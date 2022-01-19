<div>
    @if (session()->has('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif

    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">
            Product name
        </label>
        <div>
            <input wire:model="product.name" type="text"
                   class="form-control @error('product.name') is-invalid @enderror"/>
            @error('product.name')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="description" class="col-form-label text-md-right">
            Product description
        </label>
        <div wire:ignore>
            <textarea x-data="ckeditor()"
                      x-init="init($dispatch)"
                      wire:key="ckEditor"
                      x-ref="ckEditor"
                      wire:model.debounce.9999999ms="product.description"
                      class="form-control @error('product.description') is-invalid @enderror"
                      name="description">content</textarea>
        </div>
        @error('product.description')
            <span style="font-size: 11px; color: #e3342f">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-8 offset-md-4">
            <button wire:click="submitForm" type="submit" class="btn btn-primary">
                Add Product
            </button>
        </div>
    </div>
</div>
