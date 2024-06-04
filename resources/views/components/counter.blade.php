@props(['counter'])

@php
    extract($counter);
@endphp

<article id="{{ $value }}">
    <div class="flex flex-col gap-3">
        <div class="text-2xl lg:text-4xl text-black font-bold rounded-md bg-white w-42 font-sans" x-data="animatedCounter({{ $value }}, 200)"
            x-intersect:enter="updatecounter" x-intersect:leave="current = 0"
            x-text="Math.round(current) + '{{ $valueLabel }}'"></div>
        <div>{{ $label }}</div>
    </div>

</article>

@push('scripts')
    <script>
        function animatedCounter(targer, time = 200, start = 0) {
            return {
                current: 0,
                target: targer,
                time: time,
                start: start,
                updatecounter: function(temp = 10) {
                    start = this.start;
                    const increment = (this.target - start) / this.time;
                    const handle = setInterval(() => {
                        if (this.current < this.target)
                            this.current += increment
                        else {
                            clearInterval(handle);
                            this.current = this.target
                        }
                    }, temp);
                }
            };
        }
    </script>
@endpush
