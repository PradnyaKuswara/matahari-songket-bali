@extends('layouts.dashboard')

@section('title')
    Tracking Order
@endsection

@section('content')
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Tracking</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Index</span>
            </li>
        </ul>

        <div class="grid grid-cols-12 gap-4 mt-5">
            <div class="col-span-12">
                <div class="panel">
                    <div class="flex flex-col gap-2">
                        <h2>Note For Testing:</h2>
                        <p class="text-muted text-xs">* Courier: JNE</p>
                        <p class="text-muted text-xs">* RSI / AWB : 582230008329223 </p>
                        <p class="text-muted text-xs">* Please wait one minute after your send request tracking to send
                            request again </p>
                    </div>
                    <div class="flex flex-col lg:flex-row justify-between items-center gap-4 mt-4">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Shipping Number/ RSI / Awb</span>
                            </div>
                            <input type="text" id="shipping_number" placeholder="Type here"
                                class="input input-bordered w-full max-w-xs" />
                        </label>
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Courier</span>
                            </div>
                            <select class="select select-bordered" id="courier">
                                <option value="" disabled selected>Pick one</option>
                                <option value="jne">JNE</option>
                                <option value="jnt">JNT</option>
                                <option value="spx">SPX</option>
                            </select>
                        </label>
                        <button type="button" id="track"
                            class="btn btn-primary text-white border-none w-full lg:w-32 btn-md rounded-md">Track
                            Order</button>
                    </div>
                </div>

                <div class="panel mt-4">
                    <div class="flex flex-col gap-4" id="tracking-detail">
                        <h2 class="text-lg font-semibold">Tracking Detail</h2>
                    </div>
                </div>

                <div class="panel mt-4">
                    <div class="flex flex-col gap-4" id="tracking-result">
                        <h2 class="text-lg font-semibold">Tracking Result</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        const endpoint = "https://api.binderbyte.com/v1/track";
        const apiKey = "{{ config('tracking.api_key') }}";
        const trackButton = document.getElementById('track');
        const trackingResult = document.getElementById('tracking-result');
        const trackingDetail = document.getElementById('tracking-detail');
        const shippingNumber = document.getElementById('shipping_number');
        const courier = document.getElementById('courier');
        const cooldownTime = 60000; // 30 seconds cooldown

        trackButton.addEventListener('click', () => {
            let shippingNumberValue = shippingNumber.value;
            let courierValue = courier.value;
            const lastTrackTime = localStorage.getItem('etsauaq');
            const now = Date.now();

            if (lastTrackTime && now - lastTrackTime < cooldownTime) {
                alert(
                    `Please wait ${Math.ceil((cooldownTime - (now - lastTrackTime)) / 1000)} seconds before trying again.`
                    );
                return;
            }

            if (!shippingNumberValue || !courierValue) {
                alert('Please fill the form');
                return;
            }

            $.ajax({
                url: endpoint,
                type: 'get',
                data: {
                    api_key: apiKey,
                    courier: courierValue,
                    awb: shippingNumberValue,
                },
                beforeSend: () => {
                    trackingResult.innerHTML = '';
                    trackingDetail.innerHTML = '';
                    trackButton.innerText = 'Loading...';
                },
            }).done((response) => {
                localStorage.setItem('etsauaq', now);

                //response data summary
                trackingDetail.innerHTML += `
                    <div class="flex flex-col md:flex-row justify-between gap-2">
                        <div class="flex flex-col">
                            <h2 class="text-lg font-semibold">Summary</h2>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">AWB:</span>
                                <span class="text-sm">${response.data.summary.awb}</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">Courier:</span>
                                <span class="text-sm">${response.data.summary.courier}</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">Service:</span>
                                <span class="text-sm">${response.data.summary.service}</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">Status:</span>
                                <span class="text-sm">${response.data.summary.status}</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">Date:</span>
                                <span class="text-sm">${response.data.summary.date}</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">Desc:</span>
                                <span class="text-sm">${response.data.summary.desc}</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">Amount:</span>
                                <span class="text-sm">${response.data.summary.amount}</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">Weight:</span>
                                <span class="text-sm">${response.data.summary.weight}</span>
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <h2 class="text-lg font-semibold">Detail</h2>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">Origin:</span>
                                <span class="text-sm">${response.data.detail.origin}</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">Destination:</span>
                                <span class="text-sm">${response.data.detail.destination}</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">Shipper:</span>
                                <span class="text-sm">${response.data.detail.shipper}</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">Receiver:</span>
                                <span class="text-sm">${response.data.detail.receiver}</span>
                            </div>
                        </div>
                    </div>
                `;

                response.data.history.forEach((history) => {
                    trackingResult.innerHTML += `
                        <div class="flex flex-col gap-2">
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">Date:</span>
                                <span class="text-sm">${history.date}</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">Description:</span>
                                <span class="text-sm">${history.desc}</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">Location:</span>
                                <span class="text-sm">${history.location}</span>
                            </div>
                        </div>
                    `;
                });
                trackButton.innerText = 'Track Order';
            }).fail((jqXHR, ajaxOptions, thrownError) => {
                trackingDetail.innerHTML = `
                    <div class="flex flex-col gap-2">
                        <div class="flex gap-2">
                            <span class="text-sm font-semibold">Error:</span>
                            <span class="text-sm">${jqXHR.responseJSON.message}</span>
                        </div>
                    </div>
                `;

                trackingResult.innerHTML = `
                    <div class="flex flex-col gap-2">
                        <div class="flex gap-2">
                            <span class="text-sm font-semibold">Error:</span>
                            <span class="text-sm">${jqXHR.responseJSON.message}</span>
                        </div>
                    </div>
                `;
                trackButton.innerText = 'Track Order';
            });
        });
    </script>
@endpush
