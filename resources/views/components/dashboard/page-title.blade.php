@props(['title', 'subtitle'])

<div class="flex justify-between items-center mb-6 no-print">
    <h4 class="text-slate-900 text-3xl font-bold animate-fade-right">{{ $title }}</h4>

    <div class="md:flex hidden items-center gap-3 text-sm font-semibold animate-fade-left">
        <a href="#" class="text-sm font-medium text-slate-700">Dashboard</a>
        <span class="mdi mdi-chevron-right"></span>
        <a href="#" class="text-sm font-medium text-slate-700">{{ $subtitle }}</a>
        <span class="mdi mdi-chevron-right"></span>
        <a href="#" class="text-sm font-medium text-slate-700" aria-current="page">{{ $title }}</a>
    </div>
</div>
