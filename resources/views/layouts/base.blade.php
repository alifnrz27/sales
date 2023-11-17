<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @hasSection('title')

            <title>@yield('title') - {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        <!-- Favicon -->
		<link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        {{-- <link rel="stylesheet" href="{{ asset('build/assets/app-7bf6ca24.css') }}">
        <script type="module" src="{{ asset('build/assets/app-69332da4.js') }}"></script> --}}
        @livewireStyles
        @livewireScripts

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{--  Tailwind CSS  --}}
        <link href="{{ asset('css/output.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>


        <link rel="stylesheet" href="{{ asset('template/stylesheet.css') }}">

		<style type="text/css">
			.group + .card {
				margin-top: 2rem;
			}

			.group + .image {
				margin-top: 2rem;
			}

			.group > section:last-child {
				margin-bottom: 0px;
			}
		</style>
    </head>

    <body>
        @yield('body')


        <script src="{{ asset('js/cropperJS.js') }}"></script>
        <script src="{{ asset('js/cookie.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>

            window.addEventListener('modal', event=> {
                Swal.fire({
                    position: 'center',
                    icon: event.detail.type,
                    title: event.detail.title,
                    showConfirmButton: true,
                    });
            });

            window.addEventListener('confirm', event=>{
                Swal.fire({
                    title: event.detail.title,
                    text: event.detail.text,
                    icon: event.detail.icon,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: event.detail.confirmButtonText,
                    cancelButtonText: 'Batal'
                })
                .then((result) => {
                    if(result.isConfirmed){
                        window.livewire.emit(event.detail.useMethod, event.detail.key);
                        console.log(event.detail.key);
                    }
                });
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
    </body>
</html>
