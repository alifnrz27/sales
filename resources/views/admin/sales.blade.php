@extends('layouts.app')

@section('content')
<x-layouts.header />
    <div class="w-screen h-screen max-h-screen overflow-hidden bg-white flex justify-center" x-data="{form_create_sales:false, table_sales:true, open_confirm:false}">
        <div id="table-sales" class="w-full">
            <div class="relative w-full max-h-screen overflow-auto h-full bg-white flex justify-center hide-scrollbar">
                <div class="flex justify-center">
                    <div class="mt-[30px] bg-white rounded-t-2xl p-6 w-full">
                        <div style="line-height:22px" class="w-full h-8 text-[24px] font-bold flex items-center">
                            Manage Sales
                        </div>
                        <div style="line-height: 22px" class="text-[16px] font-normal text-[#64748B]">
                            In this page you can manage your sales
                        </div>
                        <div class="flex gap-2">
                            <div onclick="showConfirmTable()" class="p-3 mt-4 w-fit cursor-pointer no-select rounded-lg flex items-center justify-center bg-green-400 text-white">
                                Confirm Sales
                            </div>
                            <div onclick="hideShow('table-sales', 'form-create-sales')" class="p-3 mt-4 w-fit cursor-pointer no-select rounded-lg flex items-center justify-center bg-blue-400 text-white">
                                Create
                            </div>
                        </div>

                        <div class="w-full mt-16">
                            <table class="">
                                <thead>
                                    <th class="w-[30px]">No</th>
                                    <th class="w-[150px]">Name</th>
                                    <th class="w-[100px]">Action</th>
                                </thead>
                                <tbody id="table-body-sales">
                                    @foreach ($sales as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td class="w-full flex items-center justify-center gap-2 mb-1">
                                            <div onclick="showDetailSales('{{ $user->uuid }}')" class="p-3 w-fit text-white cursor-pointer no-select rounded-lg flex items-center justify-center bg-yellow-400">
                                                Edit
                                            </div>
                                            <div onclick="deleteSales('{{ $user->uuid }}')" class="p-3 w-fit text-white cursor-pointer no-select rounded-lg flex items-center justify-center bg-red-600">
                                                Delete
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="table-confirm-sales" class="hidden w-full">
            <div class="relative w-full flex justify-center max-h-screen overflow-auto h-full bg-white hide-scrollbar">
                <div class="">
                    <div class="inline-block cursor-pointer" onclick="hideShow('table-confirm-sales', 'table-sales')">
                        <div class="flex items-center mt-[40px]">
                            <div style="font-weight: 600;" class="text-[16px] ml-3 mt-4 text-primary">
                                Back
                            </div>
                        </div>
                    </div>
                    <div class="mt-[30px] bg-white rounded-t-2xl p-6">
                        <div style="line-height:22px" class="w-full h-8 text-[24px] font-bold flex items-center">
                            Confirm Sales
                        </div>

                        <div class="w-full mt-16">
                            <table class="">
                                <thead>
                                    <th class="w-[30px]">No</th>
                                    <th class="w-[150px]">Name</th>
                                    <th class="w-[100px]">Action</th>
                                </thead>
                                <tbody id="table-body-confirm-sales">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="form-create-sales" style="margin-top:-33px; z-index:50;left:0;overflow: auto;" class="fixed hidden w-screen h-full">
            <form>
                <div class="w-full px-0 md:px-[100px] lg:px-[399px] bg-[#F9FAFB]">
                    <div>
                        <div class="inline-block cursor-pointer" onclick="deleteFormValue()">
                            <div class="flex items-center mt-[40px]">
                                <div style="font-weight: 600;" class="text-[16px] ml-3 mt-4 text-primary">
                                    Back
                                </div>
                            </div>
                        </div>
                        <div style="font-weight: 700;" class="text-[24px] text-black">
                            {{-- {{$isShowUpdate ? 'Update claim' : 'Create new claim'}} --}}
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
                                <div class="mr-[14px]">
                                    <button type="button" onclick="deleteFormValue()" style="font-weight: 600;" wire:click="deleteShow" class="w-[83px] h-[44px] text-primary text-center text-[16px]">
                                        Cancel
                                    </button>
                                </div>
                                <div>
                                    <button id="submit-button" type="button" onclick="submitSales()" style="font-weight: 600;background-color: rgb(96 165 250 / var(--tw-bg-opacity));" class="w-[83px] h-[44px] text-white text-center text-[16px]">
                                        Save
                                    </button>
                                </div>
                                <div>
                                    <button id="update-button" type="button" data-uuid="" onclick="updateSales()" style="font-weight: 600;background-color: rgb(96 165 250 / var(--tw-bg-opacity));" class="w-[83px] hidden h-[44px] text-white text-center text-[16px]">
                                        Update
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

        <div id="confirm-sales-modal" class="relative hidden">
            <div style="z-index: 20;--tw-bg-opacity: 0.7;backdrop-filter: blur(10px);" class="fixed top-0 w-screen h-screen bg-black flex items-center justify-center">
                <div class="p-7 rounded-lg bg-white w-[400px]">
                    <div class="flex justify-between items-center">
                        <div class="font-bold text-[16px] mb-4">
                            Konfirmasi perubahan akun
                        </div>
                        <div onclick="hide('confirm-sales-modal')" class="no-select cursor-pointer">
                            X
                        </div>
                    </div>
                    <div class="flex justify-center items-center">
                        <div class="relative rounded-full max-w-[160px] justify-center mt-3">
                            <img id="confirmImage" class= "h-[120px] rounded-full" src="" alt="Uploaded Image">
                        </div>
                    </div>
                    <div class="mt-5">
                        <table  class="flex justify-start">
                            <tr>
                                <td class="font-bold text-[18px] mr-4">
                                    Nama
                                </td>
                                <td id="name-confirm" class="pl-4">

                                </td>
                            </tr>
                            <tr>
                                <td class="font-bold text-[18px] mr-4">
                                    Email
                                </td>
                                <td id="email-confirm" class="pl-4">

                                </td>
                            </tr>
                            <tr>
                                <td class="font-bold text-[18px] mr-4">
                                    username
                                </td>
                                <td id="username-confirm" class="pl-4">

                                </td>
                            </tr>
                            <tr>
                                <td class="font-bold text-[18px] mr-4">
                                    Whatsapp
                                </td>
                                <td id="whatsapp-confirm" class="pl-4">

                                </td>
                            </tr>
                            <tr>
                                <td class="font-bold text-[18px] mr-4">
                                    instagram
                                </td>
                                <td id="instagram-confirm" class="pl-4">

                                </td>
                            </tr>
                            <tr>
                                <td class="font-bold text-[18px] mr-4">
                                    facebook
                                </td>
                                <td id="facebook-confirm" class="pl-4">

                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="w-full flex justify-end items-center">
                        <div id="confirm-button" onclick="confirmSales()" class="px-3 py-2 rounded-lg bg-blue-400 text-white no-select cursor-pointer">
                            Confirm
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script>
            $(document).ready(function() {
                $.ajax({
                    type: 'GET',
                    url: '{{ env('APP_URL').'/api/v1/admin/sales' }}',
                    headers: {
                        "secret": '{{ base64_encode(env('JWT_SECRET')) }}',
                        "Authorization": "Bearer " + Cookies.get('sales_access_token')
                    },
                    success: function(response) {

                    },
                    error: function(error) {
                        if(error.responseJSON.message == "Not allowed" ||
                            error.responseJSON.message == "User not found" ||
                            error.responseJSON.message == 'Token expired' ||
                            error.responseJSON.message == 'Token invalid' ||
                            error.responseJSON.message == 'Token not found' ||
                            error.responseJSON.message == 'Could not decode token' ||
                            error.responseJSON.message == 'Secret not valid'
                            ){
                            window.location.href = '{{ route("login") }}'
                        }
                    }
                });
            });

            function showConfirmTable(){
                $.ajax({
                    type: 'GET',
                    url: '{{ env('APP_URL').'/api/v1/admin/sales/confirm' }}',
                    headers: {
                        "secret": '{{ base64_encode(env('JWT_SECRET')) }}',
                        "Authorization": "Bearer " + Cookies.get('sales_access_token')
                    },
                    success: function(response) {
                        hideShow('table-sales', 'table-confirm-sales');
                        // Loop melalui data response dan tambahkan baris baru ke dalam tabel
                        response.sales.forEach(function(user, index) {
                            // Buat elemen <tr> dan tambahkan ke dalam tabel
                            var row = $('<tr>');

                            // Tambahkan data ke dalam baris
                            row.append('<td>' +  (index + 1) + '</td>');
                            row.append('<td>' + user.name + '</td>');

                            // Buat elemen <td> untuk tombol Edit
                            var editButton = $('<div>')
                                .addClass('p-3 w-fit text-white cursor-pointer no-select rounded-lg flex items-center justify-center bg-green-400')
                                .text('Confirm')
                                .click(function() {
                                    showDetailConfirmSales(user.uuid);
                                });

                            // Tambahkan tombol Edit dan Delete ke dalam baris
                            row.append($('<td>').append(editButton));

                            // Tambahkan baris ke dalam tabel
                            $('#table-body-confirm-sales').append(row);
                        });
                    },
                    error: function(error) {
                        //
                    }
                });
            }

            function showDetailConfirmSales(uuid){
                document.getElementById('confirm-sales-modal').classList.remove("hidden")

                $.ajax({
                    type: "GET",
                    url: '{{ env('APP_URL').'/api/v1/admin/sales/confirm/' }}' + uuid,
                    contentType: false,  // Biarkan jQuery menangani tipe konten
                    processData: false,  // Biarkan jQuery tidak memproses FormData
                    headers: {
                        "secret": '{{ base64_encode(env('JWT_SECRET')) }}',
                        "Authorization": "Bearer " + Cookies.get('sales_access_token')
                    },
                    success: function(response) {
                        var confirmImage = document.getElementById('confirmImage');
                        confirmImage.src = '{{ env('APP_URL') }}/storage/' + response.sales.image_path;
                        $('#confirm-button').data('uuid', response.sales.uuid);
                        $('#name-confirm').text(response.sales.name);
                        $('#email-confirm').text(response.sales.email);
                        $('#username-confirm').text(response.sales.username);
                        $('#whatsapp-confirm').text(response.sales.whatsapp);
                        $('#instagram-confirm').text(response.sales.instagram);
                        $('#facebook-confirm').text(response.sales.facebook);
                    },
                    error: function(error) {

                    }
                });
            }

            function showDetailSales(uuid){
                $.ajax({
                    type: 'GET',
                    url: '{{ env('APP_URL').'/api/v1/admin/sales/' }}' + uuid,
                    headers: {
                        "secret": '{{ base64_encode(env('JWT_SECRET')) }}',
                        "Authorization": "Bearer " + Cookies.get('sales_access_token')
                    },
                    success: function(response) {
                        $("#salesImageCropped").val(response.user.image_path);
                        $("#name").val(response.user.name);
                        $("#username").val(response.user.username);
                        $("#email").val(response.user.email);
                        $("#whatsapp").val(response.user.whatsapp);
                        $("#instagram").val(response.user.instagram);
                        $("#facebook").val(response.user.facebook);

                        $('#update-button').data('uuid', response.user.uuid);
                        var croppedImage = document.getElementById('croppedImage');
                        croppedImage.src = '{{ env('APP_URL') }}/storage/' + response.user.image_path;
                        document.getElementById('input-image').classList.add('hidden');
                        document.getElementById('input-image').classList.remove('flex');
                        document.getElementById('preview-image').classList.remove('hidden');
                        document.getElementById('preview-image').classList.add('flex');
                        hideShow('table-sales', 'form-create-sales');
                        hideShow('submit-button', 'update-button');
                    },
                    error: function(error) {
                        // Handle error jika diperlukan
                        Swal.fire(
                            'Error!',
                            'Failed to edit.',
                            'error'
                        );
                    }
                });
            }

            function confirmSales(){
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
                        var uuid = $('#confirm-button').data('uuid')
                        // Mengirim data menggunakan AJAX
                        $.ajax({
                            type: "POST",
                            url: '{{ env('APP_URL').'/api/v1/admin/sales/confirm/' }}' + uuid,
                            contentType: false,  // Biarkan jQuery menangani tipe konten
                            processData: false,  // Biarkan jQuery tidak memproses FormData
                            headers: {
                                "secret": '{{ base64_encode(env('JWT_SECRET')) }}',
                                "Authorization": "Bearer " + Cookies.get('sales_access_token')
                            },
                            success: function(response) {
                                // Handle response dari server jika diperlukan
                                hide('confirm-sales-modal')

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: 'Sales data has been updated successfully.',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                });
                            },
                            error: function(error) {

                            }
                        });
                    }
                });
            }

            function deleteFormValue(){
                $("#salesImageCropped").val("");
                $("#name").val("");
                $("#username").val("");
                $("#email").val("");
                $("#whatsapp").val("");
                $("#instagram").val("");
                $("#facebook").val("");

                hideShow('update-button', 'submit-button');
                var croppedImage = document.getElementById('croppedImage');
                croppedImage.src = "";
                document.getElementById('input-image').classList.remove('hidden');
                document.getElementById('input-image').classList.add('flex');
                document.getElementById('preview-image').classList.add('hidden');
                document.getElementById('preview-image').classList.remove('flex');
                hideShow('form-create-sales', 'table-sales');
            }

            function deleteSales(uuid) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika pengguna mengonfirmasi penghapusan
                        $.ajax({
                            type: 'DELETE',
                            url: '/api/v1/admin/sales/' + uuid,
                            headers: {
                                "secret": '{{ base64_encode(env('JWT_SECRET')) }}',
                                "Authorization": "Bearer " + Cookies.get('sales_access_token')
                            },
                            success: function(response) {
                                // Handle response dari server jika diperlukan
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                ).then((result) => {
                                    // Lakukan sesuatu setelah SweetAlert tertutup
                                    location.reload(); // Contoh: Refresh halaman
                                });
                            },
                            error: function(error) {
                                // Handle error jika diperlukan
                                Swal.fire(
                                    'Error!',
                                    'Failed to delete.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            }

            function hide($hideID){
                document.getElementById($hideID).classList.add('hidden');
            }

            function hideShow($hideID, $showID){
                document.getElementById($showID).classList.remove('hidden');
                document.getElementById($hideID).classList.add('hidden');
            }
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

                        // Mengirim data menggunakan AJAX
                        $.ajax({
                            type: "POST",
                            url: '{{ env('APP_URL').'/api/v1/admin/sales' }}',
                            data: formData,
                            contentType: false,  // Biarkan jQuery menangani tipe konten
                            processData: false,  // Biarkan jQuery tidak memproses FormData
                            headers: {
                                "secret": '{{ base64_encode(env('JWT_SECRET')) }}',
                                "Authorization": "Bearer " + Cookies.get('sales_access_token')
                            },
                            success: function(response) {
                                // Handle response dari server jika diperlukan
                                hideShow('form-create-sales','table-sales')

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: 'Sales data has been submitted successfully.',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                });
                            },
                            error: function(error) {
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

            function updateSales() {
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
                        var uuid = $('#update-button').data('uuid')
                        var formData = new FormData();
                        formData.append('image', $("#salesImageCropped").val());
                        formData.append('name', $("#name").val());
                        formData.append('username', $("#username").val());
                        formData.append('email', $("#email").val());
                        formData.append('password', $("#password").val());
                        formData.append('whatsapp', $("#whatsapp").val());
                        formData.append('instagram', $("#instagram").val());
                        formData.append('facebook', $("#facebook").val());

                        // Mengirim data menggunakan AJAX
                        $.ajax({
                            type: "POST",
                            url: '{{ env('APP_URL').'/api/v1/admin/sales/' }}' + uuid,
                            data: formData,
                            contentType: false,  // Biarkan jQuery menangani tipe konten
                            processData: false,  // Biarkan jQuery tidak memproses FormData
                            headers: {
                                "secret": '{{ base64_encode(env('JWT_SECRET')) }}',
                                "Authorization": "Bearer " + Cookies.get('sales_access_token')
                            },
                            success: function(response) {
                                // Handle response dari server jika diperlukan
                                hideShow('form-create-sales','table-sales')

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: 'Sales data has been updated successfully.',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                });
                            },
                            error: function(error) {
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
    </div>
    @endsection
