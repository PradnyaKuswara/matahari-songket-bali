@props(['elements' => [], 'title' => 'Create', 'route' => '', 'idModal' => '', 'idRoute' => ''])


<input type="checkbox" id="modal_edit_{{ $idModal }}" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box w-12/12 md:max-w-3xl">
        <form method="dialog">
            <label for="modal_edit_{{ $idModal }}" @click="toggle()"
                class="btn btn-sm btn-circle border-none outline-none btn-ghost absolute right-2 top-2">✕</label>
        </form>
        <h2 class="text-lg font-semibold mb-4">{{ $title }}</h2>
        <form action="{{ route($route, $idRoute) }}" method="POST" id="form-edit-{{ $idModal }}"
            @if (array_search('file', array_column($elements, 'type'))) enctype="multipart/form-data" @endif>
            @csrf
            @method('PATCH')
            <div class="grid {{ count($elements) > 1 ? 'md:grid-cols-2' : 'md:grid-cols-1' }} gap-8">
                @foreach ($elements as $element)
                    <div class="w-full">
                        @if (
                            $element['type'] != 'select' &&
                                $element['name'] != 'phone_number' &&
                                $element['type'] != 'file' &&
                                $element['type'] != 'textarea')
                            <div class="flex">
                                <label for="{{ $element['id'] . $idModal }}">{{ $element['label'] }}</label>
                                @if ($element['is_required'])
                                    <span class="text-red-500">*</span>
                                @endif
                            </div>

                            @if ($element['name'] == 'color')
                                <div class="flex gap-2 items-center">
                                    <input id="{{ $element['id'] . $idModal }}" type="{{ $element['type'] }}"
                                        placeholder="{{ $element['placeholder'] }}" class="form-input"
                                        value="{{ old($element['name']) ?? $element['value'] }}"
                                        name="{{ $element['name'] }}" minlength="1" maxlength="30" />
                                    <button type="button"
                                        class="color-picker-{{ $idModal }} text-white">--</button>
                                </div>

                                @error($element['name'])
                                    <p class="mt-2 text-danger text-xs">{{ $message }}</p>
                                @enderror
                            @else
                                <input id="{{ $element['id'] . $idModal }}" type="{{ $element['type'] }}"
                                    placeholder="{{ $element['placeholder'] }}" class="form-input"
                                    name="{{ $element['name'] }}"
                                    value="{{ old($element['name']) ?? $element['value'] }}" minlength="1"
                                    maxlength="30" />
                                @error($element['name'])
                                    <p class="mt-2 text-danger text-xs">{{ $message }}</p>
                                @enderror
                            @endif
                        @endif

                        @if ($element['type'] == 'select')
                            <div class="flex">
                                <label for="{{ $element['id'] . $idModal }}">{{ $element['label'] }}</label>
                                @if ($element['is_required'])
                                    <span class="text-red-500">*</span>
                                @endif
                            </div>

                            <select id="{{ $element['id'] . $idModal }}" class="form-select font-extralight"
                                name="{{ $element['name'] }}">
                                <option value="" selected disabled>{{ $element['label'] }}</option>
                                @foreach ($element['options'] as $option)
                                    <option value="{{ $option['id'] }}"
                                        {{ $option['id'] == $element['value'] ? 'selected' : '' }}>
                                        {{ $option['name'] }}</option>
                                @endforeach
                            </select>
                            @error($element['name'])
                                <p class="mt-2 text-danger text-xs">{{ $message }}</p>
                            @enderror
                        @endif

                        @if ($element['name'] == 'phone_number')
                            <div class="flex">
                                <label for="{{ $element['id'] . $idModal }}">{{ $element['label'] }}</label>
                                @if ($element['is_required'])
                                    <span class="text-red-500">*</span>
                                @endif
                            </div>

                            <input id="{{ $element['id'] . $idModal }}" type="{{ $element['type'] }}"
                                placeholder="{{ $element['placeholder'] }}" class="form-input"
                                name="{{ $element['name'] }}" value="{{ old($element['name']) ?? $element['value'] }}"
                                minlength="10" maxlength="{{ config('validation.phone_number.maxlength') }}"
                                pattern="{{ config('validation.phone_number.regex') }}"
                                onkeypress="return onlyNumberKey(event)" />
                            @error($element['name'])
                                <p class="mt-2 text-danger text-xs">{{ $message }}</p>
                            @enderror
                        @endif

                        @if ($element['type'] == 'textarea')
                            <div class="flex">
                                <label for="{{ $element['id'] . $idModal }}">{{ $element['label'] }}</label>
                                @if ($element['is_required'] == 'true')
                                    <span class="text-red-500">*</span>
                                @endif
                            </div>

                            <textarea id="{{ $element['id'] . $idModal }}" class="form-textarea" placeholder="{{ $element['placeholder'] }}"
                                name="{{ $element['name'] }}" minlength="1" maxlength="255">{{ old($element['name']) ?? $element['value'] }}</textarea>
                            @error($element['name'])
                                <p class="mt-2 text-danger text-xs">{{ $message }}</p>
                            @enderror
                        @endif

                        @if ($element['type'] == 'file')
                            <div class="flex">
                                <label for="{{ $element['id'] . $idModal }}">{{ $element['label'] }}</label>
                                @if ($element['is_required'] == 'true')
                                    <span class="text-red-500">*</span>
                                @endif
                            </div>

                            <input id="{{ $element['id'] . $idModal }}" type="{{ $element['type'] }}"
                                placeholder="{{ $element['placeholder'] }}"
                                class=" file-input file-input-bordered file-input-ghost file-input-sm h-10 border-gray-200 text-sm"
                                accept="{{ $element['accept'] }}" name="{{ $element['name'] }}" />
                            @error($element['name'])
                                <p class="mt-2 text-danger text-xs">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary w-full btn-sm mt-8 ">Submit</button>
        </form>
    </div>
</div>

@push('scripts')
    @if (array_search('color', array_column($elements, 'name')))
        <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
    @endif
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('modalEdit{{ $idModal }}', () => ({
                init() {
                    this.status = localStorage.getItem('x_modal_edit') == 'true' ? true : false;
                    this.modalId = localStorage.getItem('x_modal_edit_id') == this.idModal ? this
                        .idModal : 0;

                    if (this.status && this.modalId == this.idModal) {
                        document.getElementById(`modal_edit_${this.idModal}`).checked = true;
                    } else {
                        document.getElementById(`modal_edit_${this.idModal}`).checked = false;
                    }

                    if (document.getElementById('inputColor{{ $idModal }}') == null) return

                    this.pickr = Pickr.create({
                        el: `.color-picker-{{ $idModal }}`,
                        theme: 'classic', // or 'monolith', or 'nano'
                        default: '#42445a',

                        components: {

                            // Main components
                            preview: true,
                            opacity: true,
                            hue: true,

                            // Input / output Options
                            interaction: {
                                hex: true,
                                input: true,
                                clear: true,
                                save: true
                            }
                        }
                    });

                    this.pickr.on('change', (color, instance) => {
                        const hexColor = color.toHEXA().toString();

                        document.getElementById('inputColor{{ $idModal }}').value =
                            hexColor;
                    });
                },
                modalId: 0,
                idModal: {{ $idModal }},
                status: false,
                pickr: null,

                toggle() {
                    this.status = localStorage.getItem('x_modal_edit') == 'true' ? false : true;
                    this.modalId = localStorage.getItem('x_modal_edit_id') == this.idModal ? 0 : this
                        .idModal;
                    localStorage.setItem('x_modal_edit', this.status);
                    localStorage.setItem('x_modal_edit_id', this.modalId);
                },
            }));
        });
    </script>
    @if (array_search('phone_number', array_column($elements, 'name')))
        <script type="text/javascript" src="{{ asset('assets/js/max-input.js') }}"></script>
        <script>
            function onlyNumberKey(event) {
                const ASCIICode = (event.which) ? event.which : event.keyCode

                return !(ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57));
            }

            const inputPhoneNumber = document.getElementById('telp')
            const maxlength = inputPhoneNumber.getAttribute('maxlength')

            maxInputValue(inputPhoneNumber, maxlength)
        </script>
    @endif
@endpush
