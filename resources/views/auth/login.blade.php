@extends('layouts.app')

@section('content')
    <div class="w-screen h-screen max-h-screen overflow-hidden bg-white flex justify-center items-center" x-data="{}">
        <div class="relative w-screen md:w-full md:max-w-md max-w-full max-h-screen overflow-auto h-full bg-white hide-scrollbar">
            <div class="absolute left-0 lg:right-0 right-0 lg:top-[160px] top-[50px]">
                <div class="mt-[30px] bg-white rounded-t-2xl p-6">
                    <div style="font-weight: 700;line-height:22px" class="w-full h-8 text-[18px] flex items-center">
                        Welcome
                    </div>
                    <div style="line-height: 22px" class="text-[14px] font-normal text-[#64748B]">
                        Login using your account
                    </div>

                    <form class="mt-4" >
                        <div class="relative border-2 pt-5 rounded-xl">
                            <div class="form-group">
                                <input type="text" id="email" style="font-weight: 400;" class="w-full h-11 p-3 text-[16px] rounded-xl" required>
                                <label for="login" style="font-weight: 400;" class="w-full h-7 p-1 flex items-center text-[#6A6A75] text-[14px]">Email</label>
                            </div>
                        </div>
                        <div class="relative">
                            <p id="email-error" style="font-size: 12px;" class="absolute text-red-600"></p>
                        </div>
                        <div class="relative border-2 pt-5 rounded-xl mt-6">
                            <div class="form-group">
                                <input type="password" id="password" style="font-weight: 400;" class="w-full h-11 p-3 text-[16px] rounded-b-lg rounded-xl" required>
                                <label for="password" style="font-weight: 400;" class="w-full h-7 p-1 flex items-center text-[#6A6A75] text-[14px]">Password</label>
                            </div>
                        </div>
                        <div class="relative">
                                <p id="password-error" style="font-size: 12px;" class="absolute text-red-600"></p>
                        </div>

                        <div class="mt-6">
                            <button type="button" onclick="login()" style="font-weight: 600;color:white" class="w-full h-[56px] bg-blue-500 rounded-xl text-center flex justify-center items-center text-[16px]">
                                Login
                            </button>
                        </div>
                        <div class="mt-2">
                            {{-- <a href="{{ route('register') }}" style="font-weight: 700;background-color:white;" class="w-full h-[56px] border-2 rounded-xl text-center flex justify-center items-center text-[16px]">
                                Register
                            </a> --}}
                        </div>
                        <div class="pb-1 flex justify-center">
                            {{-- <a href="{{ route('forgot-password-view') }}" style="font-weight: 400;" class="w-fit h-[56px] text-center flex justify-center items-center text-[#64748B] text-[14px]">
                                <div class="w-fit">
                                    Forgot password
                                </div>
                            </a> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function login() {
            // Mengambil data formulir
            var formData = {
                email: $("#email").val(),
                password: $("#password").val()
            };

            let accessToken = '';
            // Mengirim data menggunakan AJAX
            $.ajax({
                type: "POST",
                url: '{{ env('APP_URL').'/api/v1/authenticate' }}',
                data: JSON.stringify(formData),
                contentType: "application/json; charset=utf-8",
                headers: {
                    "secret": '{{ base64_encode(env('JWT_SECRET')) }}'

                },
                success: function(response) {
                    Cookies.set('sales_access_token', response.access_token)
                    if(response.user.role == "Admin"){
                        window.location.href = '{{ route("admin.sales") }}';
                        return
                    }if(response.user.role == "Sales"){
                        window.location.href = '{{ route("profile") }}';
                        return
                    }
                    console.log(response.access_token);
                    // Handle response dari server jika diperlukan
                },
                error: function(error) {
                    if(error.responseJSON.errors.email){
                        $('#email-error').text(error.responseJSON.errors.email[0]);
                    }else{
                        $('#email-error').text("");
                    }
                    if(error.responseJSON.errors.password){
                        $('#password-error').text(error.responseJSON.errors.password[0]);
                    }else{
                        $('#password-error').text("");
                    }
                }
            });
        }
    </script>
    @endsection
