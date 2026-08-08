@props(['number', 'title'])

<article class="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm">
    <p class="text-sm font-semibold text-sky-800">{{ $number }}</p>
    <h3 class="mt-4 text-xl font-semibold tracking-tight text-slate-950">{{ $title }}</h3>
    <p class="mt-3 leading-7 text-slate-600">{{ $slot }}</p>
</article>
