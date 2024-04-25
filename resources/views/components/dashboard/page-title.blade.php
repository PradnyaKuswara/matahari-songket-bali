@props(['header','title', 'subtitle', 'linkTitle', 'linkSubTitle'])

<div class="flex justify-between items-center mb-6 no-print">
    <h4 class="text-slate-900 text-3xl font-bold animate-fade-right">{{ $header }}</h4>

    <div class="md:flex hidden items-center gap-3 text-sm font-semibold animate-fade-left">
        @if (auth()->user()->role->name == 'admin')
            <a href="{{ route('admin.dashboard.index') }}" class="text-sm font-medium text-slate-700">Dashboard</a>
        @endif

        @if (auth()->user()->role->name == 'customer')
            <a href="{{ route('customer.dashboard.index') }}" class="text-sm font-medium text-slate-700">Dashboard</a>
        @endif
        <span class="mdi mdi-chevron-right"></span>
        <a href="{{ $linkSubTitle }}" class="text-sm font-medium text-slate-700">{{ $subtitle }}</a>
        <span class="mdi mdi-chevron-right"></span>
        <a href="{{ $linkTitle }}" class="text-sm font-medium text-slate-700" aria-current="page">{{ $title }}</a>
    </div>
</div>
