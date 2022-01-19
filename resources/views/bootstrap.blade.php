{{-- You can change this template using File > Settings > Editor > File and Code Templates > Code > Laravel Ideal Blade View Component --}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>WYSIWYG in Livewire</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.1/dist/alpine.min.js" defer></script>
    @livewireStyles
</head>
<body>
<div id="app">
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                            <div class="card-header"><h3>WYSIWYG in Livewire: Bootstrap Version</h3></div>

                        <div class="card-body">
                            @livewire('product-create', ['designTemplate' => 'bootstrap'])
                        </div>
                    </div>
                    <div class="mt-3 text-center">
                        <a href="{{ route('tailwind') }}">See Tailwind version</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/26.0.0/classic/ckeditor.js"></script>
@livewireScripts
<script>
    /**
     * An alpinejs app that handles CKEditor's lifecycle
     */
    function ckeditor() {
        return {
            /**
             * The function creates the editor and returns its instance
             * @param $dispatch Alpine's magic property
             */
            create: async function($dispatch) {
                // Create the editor with the x-ref
                const editor = await ClassicEditor.create(this.$refs.ckEditor);
                // Handle data updates
                editor.model.document.on('change:data', function() {
                    $dispatch('input', editor.getData())
                });
                // return the editor
                return editor;
            },
            /**
             * Initilizes the editor and creates a listener to recreate it after a rerender
             * @param $dispatch Alpine's magic property
             */
            init: async function($dispatch) {
                // Get an editor instance
                const editor = await this.create($dispatch);
                // Set the initial data
                editor.setData('{{ old('description') }}')
                // Pass Alpine context to Livewire's
                const $this = this;
                // On reinit, destroy the old instance and create a new one
                Livewire.on('reinit', async function(e) {
                    editor.setData('');
                    editor.destroy()
                        .catch( error => {
                            console.log( error );
                        } );
                    await $this.create($dispatch);
                });
            }
        }
    }
</script>
@stack('scripts')
</body>
</html>
