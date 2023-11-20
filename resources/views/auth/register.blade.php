@extends('layouts.app')

@section('content')
<div id="form-create-sales" style="z-index:50;overflow: auto;" class="w-screen h-full mt-3">
    <form>
        <div class="w-full px-0 md:px-[100px] lg:px-[399px] bg-[#F9FAFB]">
            <div>
                <div style="font-weight: 700;" class="text-[24px] text-black">
                    Register your account
                </div>

                <div class="mt-6 p-6 bg-white w-full">
                    <div class="mb-5" x-data="{
                        }">
                        <div style="font-weight: 400;" class="text-[14px] flex text-gray-500 mb-1">
                            <div class="mr-1 text-gray-500 text-opacity-70">
                                Profile image
                            </div>
                            <div class="text-red-600">
                                *
                            </div>
                        </div>
                        <input id="salesImageCropped" class="hidden">
                        <input type="file" id="salesImage" class="hidden image" accept="image/png, image/jpeg">
                            <div class=" w-full flex justify-center items-center">
                                <div id="preview-image" class="relative hidden max-w-[160px] justify-center mt-3">
                                    <img id="croppedImage" class= "h-[120px]" alt="Uploaded Image">
                                    <div onclick="deleteImage()" class="absolute  right-2 items-start p-1 text-white cursor-pointer rounded-full bg-black opacity-50">
                                        x
                                    </div>
                                </div>
                            </div>
                        {{-- @else --}}
                        <div class="flex items-center justify-center">
                            <label id="input-image" for="salesImage" class="w-[160px] h-[120px] cursor-pointer flex justify-center items-center border border-dashed">
                                <div style="font-weight: 400;" class="w-full text-center">
                                    <div class="text-[16px] text-dark-primary ">
                                        profile image
                                    </div>
                                </div>
                            </label>
                        </div>
                        {{-- @endif --}}
                        <p id="profile-image-error" class="relative text-sm text-red-600"></p>
                    </div>

                    <div class="mb-5">
                        <div class="inline-block mb-1">
                            <div style="font-weight: 400;font-size: 14px;" class="flex mb-1">
                                <div class="mr-1 text-gray-500 text-opacity-70">
                                    Name
                                </div>
                                <div class="text-red-600">
                                    *
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <input id="name" style="font-weight: 400;" class="w-full h-[44px] border border-gray-500 p-3 text-[16px]" placeholder="Insert name here...." />
                            <p id="name-error" class="relative text-sm text-red-600"></p>
                        </div>
                    </div>

                    <div class="mb-5">
                        <div class="inline-block mb-1">
                            <div style="font-weight: 400;font-size: 14px;" class="flex mb-1">
                                <div class="mr-1 text-gray-500 text-opacity-70">
                                    Username
                                </div>
                                <div class="text-red-600">
                                    *
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <input id="username" style="font-weight: 400;" class="w-full h-[44px] border border-gray-500 p-3 text-[16px]" placeholder="Insert username here...." />
                            <p id="username-error" class="relative text-sm text-red-600"></p>
                        </div>
                    </div>

                    <div class="mb-5">
                        <div class="inline-block mb-1">
                            <div style="font-weight: 400;font-size: 14px;" class="flex mb-1">
                                <div class="mr-1 text-gray-500 text-opacity-70">
                                    Email
                                </div>
                                <div class="text-red-600">
                                    *
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <input id="email" style="font-weight: 400;" class="w-full h-[44px] border border-gray-500 p-3 text-[16px]" placeholder="Insert email here...." />
                            <p id="email-error" class="relative text-sm text-red-600"></p>
                        </div>
                    </div>

                    <div class="mb-5">
                        <div class="inline-block mb-1">
                            <div style="font-weight: 400;font-size: 14px;" class="flex mb-1">
                                <div class="mr-1 text-gray-500 text-opacity-70">
                                    Whatsapp
                                </div>
                                <div class="text-red-600">
                                    *
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <input id="whatsapp" style="font-weight: 400;" class="w-full h-[44px] border border-gray-500 p-3 text-[16px]" placeholder="+6281234566789" />
                            <p id="whatsapp-error" class="relative text-sm text-red-600"></p>
                        </div>
                    </div>

                    <div class="mb-5">
                        <div class="inline-block mb-1">
                            <div style="font-weight: 400;font-size: 14px;" class="flex mb-1">
                                <div class="mr-1 text-gray-500 text-opacity-70">
                                    Instagram
                                </div>
                                <div class="text-red-600">
                                    *
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <input id="instagram" style="font-weight: 400;" class="w-full h-[44px] border border-gray-500 p-3 text-[16px]" placeholder="Insert username instagram here...." />
                            <p id="instagram-error" class="relative text-sm text-red-600"></p>
                        </div>
                    </div>

                    <div class="mb-5">
                        <div class="inline-block mb-1">
                            <div style="font-weight: 400;font-size: 14px;" class="flex mb-1">
                                <div class="mr-1 text-gray-500 text-opacity-70">
                                    Facebook
                                </div>
                                <div class="text-red-600">
                                    *
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <input id="facebook" style="font-weight: 400;" class="w-full h-[44px] border border-gray-500 p-3 text-[16px]" placeholder="Insert facebook link here...." />
                            <p id="facebook-error" class="relative text-sm text-red-600"></p>
                        </div>
                    </div>

                    <div class="mb-5">
                        <div class="inline-block mb-1">
                            <div style="font-weight: 400;font-size: 14px;" class="flex mb-1">
                                <div class="mr-1 text-gray-500 text-opacity-70">
                                    Password
                                </div>
                                <div class="text-red-600">
                                    *
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <input type="password" id="password" style="font-weight: 400;" class="w-full h-[44px] border border-gray-500 p-3 text-[16px]" placeholder="Insert password here...." />
                            <p id="password-error" class="relative text-sm text-red-600"></p>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="mb-20 p-6 bg-white">
                    <div class="flex justify-end">
                        <div>
                            <button id="submit-button" type="button" onclick="submitSales()" style="font-weight: 600;background-color: rgb(96 165 250 / var(--tw-bg-opacity));" class="w-[83px] h-[44px] text-white text-center text-[16px]">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" class="hidden fixed w-screen h-screen top-0 left-0 right-0 bottom-0" style="z-index: 200">
    <div class="absolute top-0 left-0 right-0 bottom-0 flex w-screen h-screen justify-center items-center bg-black bg-opacity-70">
        <div class="modal fade p-10 rounded-lg justify-center items-center w-[500px] h-fit bg-white" style="z-index: 200">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-[20px]">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-8">
                                    <img id="image" class="w-[400px]">
                                </div>
                                <div class="col-md-4">
                                    <div class="preview"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full flex gap-2 items-center justify-end mt-5">
                        <button type="button" style=" --tw-bg-opacity: 1;background-color: rgb(248 113 113 / var(--tw-bg-opacity)); color:white;" class="px-3 py-2 bg-red-400 rounded-lg text-white" data-dismiss="modal">Cancel</button>
                        <button type="button" style=" --tw-bg-opacity: 1;background-color: rgb(74 222 128 / var(--tw-bg-opacity)); color:white;" class="px-3 py-2 bg-green-400 rounded-lg text-white" id="crop">Crop</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        // $(document).ready(function() {
        //     $.ajax({
        //         type: 'GET',
        //         url: '{{ env('APP_URL').'/api/v1/check-authenticate' }}',
        //         headers: {
        //             "secret": '{{ base64_encode(env('JWT_SECRET')) }}',
        //             "Authorization": "Bearer " + Cookies.get('sales_access_token')
        //         },
        //         success: function(response) {
        //             if(response.redirectTo == "Admin"){
        //                 window.location.href = '{{ route("admin.sales") }}';
        //             }else{
        //                 window.location.href = '{{ route("profile") }}';
        //             }
        //         },
        //         error: function(error) {
        //             //
        //         }
        //     });
        // });


        function deleteImage(){
            var croppedImage = document.getElementById('croppedImage');
            croppedImage.src = '';
            $("#salesImage").val("");
            document.getElementById('input-image').classList.remove('hidden');
            document.getElementById('input-image').classList.add('flex');
            document.getElementById('preview-image').classList.add('hidden');
            document.getElementById('preview-image').classList.remove('flex');
        }

        function submitSales() {
            Swal.fire({
                title: 'Are you sure?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mengambil data formulir
                    var formData = new FormData();
                    formData.append('image', $("#salesImageCropped").val());
                    formData.append('name', $("#name").val());
                    formData.append('username', $("#username").val());
                    formData.append('email', $("#email").val());
                    formData.append('password', $("#password").val());
                    formData.append('whatsapp', $("#whatsapp").val());
                    formData.append('instagram', $("#instagram").val());
                    formData.append('facebook', $("#facebook").val());
                    var currentUrl = window.location.href;
                    var url = new URL(currentUrl);
                    var referenceSalesUuid = url.searchParams.get("reference_sales_uuid");
                    formData.append('reference_sales_uuid', referenceSalesUuid);

                    $.ajax({
                        type: "POST",
                        url: '{{ env('APP_URL').'/api/v1/register' }}',
                        data: formData,
                        contentType: false,  // Biarkan jQuery menangani tipe konten
                        processData: false,  // Biarkan jQuery tidak memproses FormData
                        headers: {
                            "secret": '{{ base64_encode(env('JWT_SECRET')) }}',
                            "Authorization": "Bearer " + Cookies.get('sales_access_token')
                        },
                        success: function(response) {
                            // Handle response dari server jika diperlukan
                            setCookie('sales-web-cookie', response.dataCookie, 100);
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Sales data has been submitted successfully.',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '{{ env('APP_URL')."/" }}' + response.username
                                }
                            });
                        },
                        error: function(error) {
                            if(error.responseJSON.message == 'Reference sales not found'){
                                Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: error.responseJSON.message,
                            })
                            }
                            if(error.responseJSON.errors.image){
                                $('#profile-image-error').text(error.responseJSON.errors.image[0]);
                            }else{
                                $('#profile-image-error').text("");
                            }
                            if(error.responseJSON.errors.name){
                                $('#name-error').text(error.responseJSON.errors.name[0]);
                            }else{
                                $('#name-error').text("");
                            }
                            if(error.responseJSON.errors.username){
                                $('#username-error').text(error.responseJSON.errors.username[0]);
                            }else{
                                $('#username-error').text("");
                            }
                            if(error.responseJSON.errors.instagram){
                                $('#instagram-error').text(error.responseJSON.errors.instagram[0]);
                            }else{
                                $('#instagram-error').text("");
                            }
                            if(error.responseJSON.errors.whatsapp){
                                $('#whatsapp-error').text(error.responseJSON.errors.whatsapp[0]);
                            }else{
                                $('#whatsapp-error').text("");
                            }
                            if(error.responseJSON.errors.facebook){
                                $('#facebook-error').text(error.responseJSON.errors.facebook[0]);
                            }else{
                                $('#facebook-error').text("");
                            }
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
            });
        }
    </script>
    @endsection
