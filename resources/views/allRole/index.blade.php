@extends('layouts.app')

@section('content')
{{-- <x-layouts.header :sales_uuid="$sales->uuid" /> --}}
    @include('components.layouts.header')

    <section class="py-4">
        <div class="flex flex-row mb-4">
            <div class="basis-1/4">
                <img class="rounded-full" src="{{ asset('storage/' . $sales->image_path) }}">
            </div>
            <div class="basis-3/4 pl-4 flex flex-col justify-center">
                <div class="font-semibold flex flex-row" style="align-items: center;">
                    <div class="mr-2 text-lg">{{ $sales->name }}</div>
                </div>
                <div class="text-xs text-gray-400">Silver of Fourmi</div>

                <div class="text-xs text-gray-400">PT Fourmi Asha Sejahtera</div>
            </div>
        </div>
        <div class="columns-3">
            <a href="https://www.qode.cards/ellisgriady/fourmi/download" class="btn-profile text-white" id="download" style="background-color: #4c8bf5;">Save to contacts</a>
            <a href="https://wa.me/{{ $sales->whatsapp }}" class="btn-profile">Whatsapp</a>
            <a href="tel:{{ $sales->whatsapp }}" class="btn-profile" id="contact">Contact</a>
        </div>
    </section>


    <br>
    <section class="image">
        <img data-fancybox="" data-src="https://qode-files.s3.ap-southeast-1.amazonaws.com/p/qode/1003/content/XUCtQx2nDhJvfGu9X3bTiVQF6oL4LGRJt8Jw3iQf.jpg" src="{{ asset('template/XUCtQx2nDhJvfGu9X3bTiVQF6oL4LGRJt8Jw3iQf.jpg') }}">
    </section>
    <br>
    <section class="text" style="color: #000000; text-align: left;">
        <span>
            Fourmi menyediakan produk dengan kualitas terbaik asal Korea, Amerika, Jepang dan berbagai negara lainnya. Produk Fourmi telah mendapatkan sertifikat manfaat dari Ajao University, Jurnal, Patent, serta pengakuan dari dokter, profesor dan rumah sakit.<br>
            <br>
            Banyak di antara mereka yang telah membuktikannya. Scroll sampai habis ya!
        </span>
    </section>
    <br>
    <section class="card">
        <a href="https://www.qode.bio/fourmiindonesia/testimonial">
            <div class="card-cover">
                <img src="{{ asset('template/QE8jUgcIMQgIBPkpOpT3WZnEQnp3CFU7kYlCoUad.jpg') }}">
            </div>
            <div class="card-content" style="background-color: #FFFFFF;color: #000000;text-align: center;">
                <div></div>
                <div class="subtitle">It Has Been Proven and Felt by Many People</div>
            </div>
        </a>
    </section>

    <section class="card">
        <a href="https://www.qode.bio/fourmiindonesia/celebrity">
            <div class="card-cover">
                <img src="{{ asset('template/YuEhJwr8LXj5RwyuwWuEKDvlibmbSrFo5VfZSSgl.jpg') }}">
            </div>
            <div class="card-content" style="background-color: #FFFFFF;color: #01553D;text-align: center;">
                <div></div>
                <div class="subtitle">Trusted by Artists</div>
            </div>
        </a>
    </section>

    <section class="card">
        <a href="https://www.qode.bio/fourmiindonesia/products">
            <div class="card-cover">
                <img src="{{ asset('template/y9mQkCTKkTKdVOnVxfH3VjtD7o0WszMcKOfob2GA.jpg') }}">
            </div>
            <div class="card-content" style="background-color: #FFFFFF;color: #000000;text-align: center;">
                <div></div>
                <div class="subtitle">We Only Provide the Highest Quality Products</div>
            </div>
        </a>
    </section>

    <section class="card">
        <a href="https://www.qode.bio/fourmiindonesia/sertifikat">
            <div class="card-cover">
                <img src="{{ asset('template/jOHAvWEleLw1GgnhF37vnc6oKRzl5NrsVzsFzXZM.jpg') }}">
            </div>
            <div class="card-content" style="background-color: #FFFFFF;color: #000000;text-align: center;">
                <div></div>
                <div class="subtitle">Fourmi Products Have Gained International Acknowledgment</div>
            </div>
        </a>
    </section>

    <section class="card">
        <a href="https://www.qode.bio/fourmiindonesia/socialmedia">
            <div class="card-cover">
                <img src="{{ asset('template/lhznncFu8DX95esJYeCyJ0gUIY0wnBakhNsRGStx.jpg') }}">
            </div>
            <div class="card-content" style="background-color: #FFFFFF;color: #000000;text-align: center;">
                <div></div>
                <div class="subtitle">Find more about us!</div>
            </div>
        </a>
    </section>

    <section class="card">
        <a href="https://www.qode.bio/fourmiindonesia/beafourmiarmi">
            <div class="card-cover">
                <img src="{{ asset('template/PolNS3G2XrROIMOo1t47zw2SkNRT9lPmrLr17ifl.jpg') }}">
            </div>
            <div class="card-content" style="background-color: #FFFFFF;color: #000000;text-align: center;">
                <div></div>
                <div class="subtitle">Satukan peluang Fourmi dalam kehidupan Anda dan Fourmi akan membantu Anda menwujudkan mimpi Anda.</div>
            </div>
        </a>
    </section>

    <section class="group" style="background-color:#ffffff;color:#000000">
        <section class="card">
            <a href="https://wa.me/{{ $sales->whatsapp }}">
                <div class="card-content whatsapp social-media">
                    <svg class="w-6 h-6 fill-current mr-4" viewBox="-23 -21 682 682.67" xmlns="http://www.w3.org/2000/svg">
                        <path d="M544.39 93C484.5 33.07 404.89.05 320.05 0 145.25 0 2.98 142.26 2.91 317.11a316.57 316.57 0 0042.33 158.55L.25 640l168.12-44.1a316.8 316.8 0 00151.55 38.6h.13c174.79 0 317.07-142.27 317.14-317.13.03-84.75-32.92-164.42-92.8-224.36zM320.05 580.95h-.1a263.27 263.27 0 01-134.17-36.74l-9.62-5.72-99.77 26.18 26.63-97.27-6.27-9.98a262.94 262.94 0 01-40.3-140.28c.06-145.33 118.31-263.57 263.7-263.57 70.41.03 136.6 27.48 186.36 77.3s77.16 116.05 77.13 186.49c-.06 145.34-118.3 263.6-263.59 263.6zm144.59-197.42c-7.93-3.97-46.89-23.13-54.15-25.78-7.26-2.64-12.55-3.96-17.83 3.97-5.28 7.93-20.46 25.78-25.09 31.07-4.62 5.29-9.24 5.95-17.17 1.98-7.92-3.96-33.45-12.33-63.72-39.33-23.56-21.01-39.46-46.96-44.09-54.9-4.61-7.93-.04-11.8 3.48-16.16 8.58-10.66 17.17-21.82 19.8-27.1 2.65-5.3 1.33-9.93-.66-13.9-1.97-3.96-17.82-42.96-24.42-58.83-6.44-15.45-12.97-13.36-17.83-13.6-4.62-.23-9.9-.28-15.19-.28-5.28 0-13.87 1.98-21.13 9.92-7.27 7.93-27.73 27.1-27.73 66.1s28.4 76.69 32.35 81.98c3.96 5.29 55.88 85.32 135.37 119.64A453.57 453.57 0 00371.8 465c18.99 6.03 36.26 5.18 49.91 3.14 15.23-2.28 46.88-19.17 53.5-37.68 6.6-18.51 6.6-34.37 4.61-37.68-1.98-3.3-7.26-5.29-15.18-9.26zm0 0" fill-rule="evenodd"></path>
                    </svg>
                    <div>Whatsapp</div>
                </div>
            </a>
        </section>

        <section class="card">
            <a href="https://www.facebook.com/{{ $sales->facebook }}">
                <div class="card-content facebook social-media">
                    <svg class="w-6 h-6 fill-current mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="88.43 12.83 107.54 207.09">
                        <path d="M158.23 219.91v-94.46h31.7l4.76-36.81h-36.46v-23.5c0-10.66 2.96-17.93 18.25-17.93h19.5V14.27c-3.38-.45-14.95-1.45-28.42-1.45-28.1 0-47.34 17.15-47.34 48.66v27.15h-31.8v36.81h31.8v94.46h38.01z"></path>
                    </svg>
                    <div>Facebook</div>
                </div>
            </a>
        </section>

        <section class="card">
            <a href="https://www.instagram.com/{{ $sales->instagram }}">
                <div class="card-content instagram social-media">
                    <svg class="w-6 h-6 fill-current mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36">
                        <g fill-rule="evenodd">
                            <path d="M18 0c-4.89 0-5.5.02-7.42.1C8.66.2 7.35.5 6.2.95a8.82 8.82 0 00-3.19 2.08A8.83 8.83 0 00.94 6.21a13.2 13.2 0 00-.83 4.37C.02 12.5 0 13.11 0 18s.02 5.5.1 7.42c.1 1.92.4 3.23.84 4.37a8.82 8.82 0 002.08 3.19c1 1 2 1.62 3.19 2.08 1.14.44 2.45.74 4.37.83 1.92.09 2.53.11 7.42.11s5.5-.02 7.42-.1c1.92-.1 3.23-.4 4.37-.84a8.82 8.82 0 003.19-2.08c1-1 1.62-2 2.08-3.19.44-1.14.74-2.45.83-4.37.09-1.92.11-2.53.11-7.42s-.02-5.5-.1-7.42c-.1-1.92-.4-3.23-.84-4.37a8.82 8.82 0 00-2.08-3.19A8.83 8.83 0 0029.79.94a13.2 13.2 0 00-4.37-.83C23.5.02 22.89 0 18 0zm0 3.24c4.8 0 5.38.02 7.27.1 1.76.09 2.71.38 3.35.63.84.32 1.44.71 2.07 1.34a5.57 5.57 0 011.34 2.07c.25.64.54 1.6.62 3.35.09 1.9.1 2.46.1 7.27s-.01 5.38-.1 7.27a9.94 9.94 0 01-.62 3.35 5.58 5.58 0 01-1.34 2.07 5.57 5.57 0 01-2.07 1.34c-.64.25-1.6.54-3.35.62-1.9.09-2.46.1-7.27.1s-5.38-.01-7.27-.1a9.94 9.94 0 01-3.35-.62 5.58 5.58 0 01-2.07-1.34 5.58 5.58 0 01-1.34-2.07 9.94 9.94 0 01-.62-3.35c-.09-1.9-.1-2.46-.1-7.27s.01-5.38.1-7.27c.08-1.76.37-2.71.62-3.35.32-.84.71-1.44 1.34-2.07a5.57 5.57 0 012.07-1.34 9.94 9.94 0 013.35-.62c1.9-.09 2.46-.1 7.27-.1z"></path>
                            <path d="M18 24a6 6 0 110-12 6 6 0 010 12zm0-15.25a9.25 9.25 0 100 18.5 9.25 9.25 0 000-18.5zm11.94-.17a2.19 2.19 0 11-4.37 0 2.19 2.19 0 014.37 0"></path>
                        </g>
                    </svg>
                    <div>Instagram</div>
                </div>
            </a>
        </section>
    </section>

    <!-- MODAL -->
    <div id="modal" class="fixed inset-0 backdrop-blur-sm bg-black/50" style="display: none;">
        <section class="bg-white absolute bottom-0 left-0 right-0 rounded-t-3xl py-4 px-5 z-10 contact">
            <form method="POST" id="form" action="https://www.qode.cards/contact">
                <input type="hidden" name="user_id" value="1155">
                <input type="hidden" name="profile_id" value="107">
                <input type="hidden" name="merchant_id" value="39">
                <h6 class="text-center">Exchange contact</h6>
                <div class="text-sm text-center text-gray-400">Get in touch by sharing your information</div>
                <hr class="my-2">
                <div class="mb-4 mt-3">
                    <input type="text" name="fullname" class="form-field" placeholder="Your name" required="">
                </div>
                <div class="mb-4">
                    <input type="tel" name="phone" class="form-field" placeholder="Your contact number" required="">
                </div>
                <div class="mb-4">
                    <input type="email" name="usermail" class="form-field" placeholder="Your email address" required="">
                </div>
                <div class="mb-4">
                    <textarea name="message" class="form-field" placeholder="Leave me a message"></textarea>
                </div>
                <div class="text-sm mb-4 text-red-400" id="error" style="display: none;"></div>
                <div class="text-sm mb-4 text-green-400" id="success" style="display: none;"></div>
                <div>
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white bg-black hover:bg-indigo-400 transition ease-in-out duration-150 w-full">
                        Submit
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="send-icon ml-3 h-5 w-5 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"></path>
                        </svg>
                        <svg style="display: none;" class="load-icon animate-spin ml-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </section>
    </div>

    <div id="modal-contact" class="fixed inset-0 backdrop-blur-sm bg-black/50" style="display: none;">
        <section class="bg-white absolute bottom-0 left-0 right-0 rounded-t-3xl py-4 px-5 z-10 contact">
            <a href="tel:{{ $sales->whatsapp }}" class="mb-4 inline-flex items-center justify-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white bg-black hover:bg-indigo-400 transition ease-in-out duration-150 w-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-2 w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"></path>
                </svg>
                Call
            </a>
            <a href="mailto:{{ $sales->email }}" class="inline-flex items-center justify-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white bg-black hover:bg-indigo-400 transition ease-in-out duration-150 w-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-2 w-4 h-4">
                    <path stroke-linecap="round" d="M16.5 12a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 10-2.636 6.364M16.5 12V8.25"></path>
                </svg>
                Send E-mail
            </a>
        </section>
    </div>

    <div id="phone-number-form" class="relative hidden">
        <div style="z-index: 20;--tw-bg-opacity: 0.7;backdrop-filter: blur(10px);" class="fixed top-0 w-screen h-screen bg-black flex items-center justify-center">
            <div class="p-7 rounded-lg bg-white w-[400px]">
                <div class="font-bold text-[16px] mb-4">
                    Masukkan Nomor HP anda
                </div>
                <div class="relative border-2 pt-5 rounded-xl mb-4">
                    <div class="form-group">
                        <input type="text" id="phone-number" style="font-weight: 400;" class="w-full h-11 p-3 text-[16px] rounded-xl" required>
                        <label for="phone-number" style="font-weight: 400;" class="w-full h-7 p-1 flex items-center text-[#6A6A75] text-[14px]">No HP</label>
                    </div>
                </div>
                <div class="w-full flex justify-end items-center">
                    <div onclick="submitPhoneNumber()" class="px-3 py-2 rounded-lg bg-blue-400 text-white no-select cursor-pointer">
                        Submit
                    </div>
                </div>
            </div>
        </div>
    </div>


        <script src="{{ asset('template/app.js.download') }}"></script>
		<script src="{{ asset('template/jquery.cookie.min.js.download') }}"></script>
		<script src="{{ asset('template/jquery.cookie.min.js.download') }}" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#download').click(function(event) {
					$("#modal").show();
				});

				$('#contact').click(function(event) {
					event.preventDefault();
					$("#modal-contact").show();
				});

				$('#modal').click(function(event) {
					if ( $(event.target).is('#modal') ) {
						$(this).hide();
					}
				});

				$('#modal-contact').click(function(event) {
					if ( $(event.target).is('#modal-contact') ) {
						$(this).hide();
					}
				});

				$('#form').submit(function(event) {
					event.preventDefault();

					const form = $(this);
					const formData = new FormData(form[0]);
					const save = $('#submit');
					const error = $('#error');
					const success = $('#success');
					save.attr('disabled', 'disabled');

					$('.send-icon').hide();
					$('.load-icon').show();

					$.ajax({
						url: form.attr('action'),
						type: 'POST',
						data: formData,
						contentType: false,
						cache: false,
						processData:false,
					})
					.done(function( data, textStatus, jqXHR ) {
						$('.load-icon').hide();
						$('.send-icon').show();

						success.show().html(data.message);
					})
					.fail(function( jqXHR, textStatus, errorThrown ) {
						$('.load-icon').hide();
						$('.send-icon').show();
						alert(jqXHR.responseJSON.message);
					});
				});

				const page_view = $.cookie('page_view');
				if (page_view == undefined) {
					var date = new Date();
					date.setTime(date.getTime() + (10 * 1000));
					$.cookie('page_view', '1', { expires: date, path: '/;SameSite=Lax' });
				}
				else {

				}
			});
		</script>

        <script>

            function submitPhoneNumber(){
                var path = window.location.pathname;
                var username = path.replace(/^\//, '');
                var formData = {
                    phone_number: $('#phone-number').val()
                };

                $.ajax({
                    type: 'POST',
                    url: '{{ env('APP_URL').'/api/v1/submit-phone-number/' }}' + username,
                    data: formData,
                    headers: {
                        "secret": '{{ base64_encode(env('JWT_SECRET')) }}'
                    },
                    success: function(response) {
                        // console.log(response);
                        setCookie('sales-web-cookie', response.dataCookie, 100);
                        if(response.message == "Success add phone number"){
                            window.location.href = '{{ env('APP_URL')."/register?reference_sales_uuid=" }}' + response.reference_sales_uuid
                            location.reload();
                        }else if(response.message == "Redirect"){
                            // console.log(response);
                            window.location.href = '{{ env('APP_URL')."/" }}' + response.username
                        }
                    },
                    error: function(error) {
                        console.log(error)
                    }
                });
            }

            $(document).ready(function() {
                var path = window.location.pathname;
                var username = path.replace(/^\//, '');
                const cookieValue = getCookie('sales-web-cookie');
                if (cookieValue !== null) {
                    myCookie = cookieValue;
                } else {
                    myCookie = '';
                }
                var formData = {
                    userCookie: myCookie
                };

                $.ajax({
                    type: 'POST',
                    url: '{{ env('APP_URL').'/api/v1/' }}' + username,
                    data: formData,
                    headers: {
                        "secret": '{{ base64_encode(env('JWT_SECRET')) }}'
                    },
                    success: function(response) {
                        if(response.message == "Input phone number"){
                            document.getElementById('phone-number-form').classList.remove('hidden')
                        }else if(response.message == "Redirect"){
                            if(response.username != username){
                                window.location.href = '{{ env('APP_URL')."/" }}' + response.username
                            }
                        }
                    },
                    error: function(error) {

                    }
                });
            });
        </script>
    @endsection
