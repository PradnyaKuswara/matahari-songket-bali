@props(['title', 'subtitle'])

<div class="flex justify-between items-center mb-6 no-print">
    <h4 class="text-slate-900 text-3xl font-bold animate-fade-right">{{ $title }}</h4>

    <div class="md:flex hidden items-center gap-3 text-sm font-semibold">
        <a href="#" class="text-sm font-medium text-slate-700">Dashboard</a>
        <i class="bx bx-chevron-right text-lg flex-shrink-0 text-slate-400"></i>
        <a href="#" class="text-sm font-medium text-slate-700">{{ $subtitle }}</a>
        <i class="bx bx-chevron-right text-lg flex-shrink-0 text-slate-400"></i>
        <a href="#" class="text-sm font-medium text-slate-700" aria-current="page">{{ $title }}</a>
    </div>
</div>
