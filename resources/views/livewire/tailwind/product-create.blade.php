<div>
    @if (session()->has('message'))
        <div class="px-4 py-3 mb-4 leading-normal text-blue-700 bg-blue-100 rounded-lg" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-4">
        <label class="block font-medium text-sm text-gray-700" for="name">
            Product name
        </label>
        <input wire:model="product.name" type="text" name="name"
               class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400"
               required/>
        @error('product.name')
        <div class="text-sm text-red-500 ml-1">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block font-medium text-sm text-gray-700" for="description">
            Product description
        </label>
        <div wire:ignore>
            <textarea id="description"></textarea>
        </div>
        @error('product.description')
        <div class="text-sm text-red-500 ml-1">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="flex items-center mt-4">
        <button wire:click="submitForm" type="submit"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
            Add Product
        </button>
    </div>
</div>

@push('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('product.description', editor.getData());
                })

                Livewire.on('reinit', () => {
                    editor.setData('', '')
                })
            })
            .catch(error => {
                console.error(error);
            });

    </script>
@endpush