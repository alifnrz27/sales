<div>
    <header class="header" style="position: sticky; top: 0; z-index: 100;">
        <div class="min-h-0">
            <section class="flex flex-row items-center">
                                    <img class="max-h-10 mr-2 rounded-full" src="{{ asset('template/t7E6bzbTjDsYk7kRJVTEEV1FDyAWmPJCbXRVexeZ.jpg') }}">
                <div class="text-black text-sm font-bold">PT Fourmi Asha Sejahtera</div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="ml-1 w-4 h-4 fill-current">
                    <polygon fill="#4c8bf5" points="29.62,3 33.053,8.308 39.367,8.624 39.686,14.937 44.997,18.367 42.116,23.995 45,29.62 39.692,33.053 39.376,39.367 33.063,39.686 29.633,44.997 24.005,42.116 18.38,45 14.947,39.692 8.633,39.376 8.314,33.063 3.003,29.633 5.884,24.005 3,18.38 8.308,14.947 8.624,8.633 14.937,8.314 18.367,3.003 23.995,5.884"></polygon><polygon fill="#fff" points="21.396,31.255 14.899,24.76 17.021,22.639 21.428,27.046 30.996,17.772 33.084,19.926"></polygon>
                </svg>


                <div id="login-button" class="hidden" style=" flex: 1 1 auto; text-align: right;">
                    <a href="{{ route('login') }}" class="btn-profile" style="color: white; background-color: rgb(59 130 246 / var(--tw-bg-opacity));display: inline-flex; padding-left: 1rem; padding-right: 1rem;">
                        <span>LOGIN</span>
                    </a>
                </div>
                <div id="logout-button" class="hidden" style=" flex: 1 1 auto; text-align: right;">
                    <div onclick="logout()" class="btn-profile hidden no-select cursor-pointer" style="color: white; background-color: rgb(239 68 68 / var(--tw-bg-opacity));display: inline-flex; padding-left: 1rem; padding-right: 1rem;">
                        <span>LOGOUT</span>
                    </div>
                </div>

            </section>
        </div>
    </header>

    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '{{ env('APP_URL').'/api/v1/check-authenticate' }}',
                headers: {
                    "secret": '{{ base64_encode(env('JWT_SECRET')) }}',
                    "Authorization": "Bearer " + Cookies.get('sales_access_token')
                },
                success: function(response) {
                    document.getElementById('login-button').classList.add('hidden')
                    document.getElementById('logout-button').classList.remove('hidden')
                },
                error: function(error) {
                    document.getElementById('login-button').classList.remove('hidden')
                    document.getElementById('logout-button').classList.add('hidden')
                }
            });
        });

        function logout() {
                Swal.fire({
                    title: 'Logout?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Cookies.remove('sales_access_token');
                        window.location.href = '{{ route("login") }}';
                    }
                });
            }
    </script>
</div>
