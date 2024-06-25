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
                        <p class="text-muted text-xs">* Courier: SICEPAT</p>
                        <p class="text-muted text-xs">* RSI / AWB : 004297830890 </p>
                        <p class="text-muted text-xs">* Please wait one minute after your send request tracking to send
                            request again </p>
                    </div>
                    <div class="flex flex-col lg:flex-row justify-between items-center gap-4 mt-4">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text text-black dark:text-white">Shipping Number/ RSI / Awb</span>
                            </div>
                            <input type="text" id="shipping_number" placeholder="Type here"
                                class="input input-bordered w-full max-w-xs bg-white dark:bg-black border border-primary focus:border-primary" />
                        </label>
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text text-black dark:text-white">Courier</span>
                            </div>
                            <select class="select select-bordered bg-white dark:bg-black border border-primary focus:border-primary" id="courier">
                                <option value="" disabled selected>Pick one</option>
                                <option value="jne">JNE</option>
                                <option value="jnt">JNT</option>
                                <option value="sicepat">SICEPAT</option>
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
        const endpoint = `{{ route('customer.dashboard.resultTrackingOrder') }}`;
        const apiKey = "{{ config('shipping.api_key') }}";
        const trackButton = document.getElementById('track');
        const trackingResult = document.getElementById('tracking-result');
        const trackingDetail = document.getElementById('tracking-detail');
        const shippingNumber = document.getElementById('shipping_number');
        const courier = document.getElementById('courier');
        const cooldownTime = 60000; // 30 seconds cooldown

        trackButton.addEventListener('click', () => {
            let shippingNumberValue = shippingNumber.value;
            let courierValue = courier.value;

            $.ajax({
                url: endpoint,
                type: 'get',
                data: {
                    key: apiKey,
                    courier: courierValue,
                    waybill: shippingNumberValue,
                },
                beforeSend: () => {
                    trackingResult.innerHTML = '';
                    trackingDetail.innerHTML = '';
                    trackButton.innerText = 'Loading...';
                },
            }).done((response) => {
                console.log(response.rajaongkir);

                //response data summary
                trackingDetail.innerHTML += `
                    <div class="flex flex-col md:flex-row justify-between gap-2">
                        <div class="flex flex-col">
                            <h2 class="text-lg font-semibold">Summary</h2>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">AWB:</span>
                                <span class="text-sm">${response.rajaongkir.result.summary.waybill_number}</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">Courier:</span>
                                <span class="text-sm">${response.rajaongkir.result.summary.courier_name}</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">Service:</span>
                                <span class="text-sm">${response.rajaongkir.result.summary.service_code}</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">Status:</span>
                                <span class="text-sm">${response.rajaongkir.result.summary.status}</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">Date:</span>
                                <span class="text-sm">${response.rajaongkir.result.summary.waybill_date}</span>
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <h2 class="text-lg font-semibold">Detail</h2>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">Origin:</span>
                                <span class="text-sm">${response.rajaongkir.result.details.origin}</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">Destination:</span>
                                <span class="text-sm">${response.rajaongkir.result.details.destination}</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">Shipper:</span>
                                <span class="text-sm">${response.rajaongkir.result.details.shippper_name}</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">Receiver:</span>
                                <span class="text-sm">${response.rajaongkir.result.details.receiver_name}</span>
                            </div>
                        </div>
                    </div>
                `;


                //response data history map from last to first

                response.rajaongkir.result.manifest.reverse().forEach((manifest) => {
                    trackingResult.innerHTML += `
                        <div class="flex flex-col gap-2">
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">Manifest Code:</span>
                                <span class="text-sm">${manifest.manifest_code}</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">Manifest Description:</span>
                                <span class="text-sm">${manifest.manifest_description}</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">Manifest Date:</span>
                                <span class="text-sm">${manifest.manifest_date}</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-sm font-semibold">City Name:</span>
                                <span class="text-sm">${manifest.city_name}</span>
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
