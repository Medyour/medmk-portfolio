<header class="relative z-40 border-b border-slate-200 bg-white/95 backdrop-blur">
    <div class="page-container flex min-h-18 items-center justify-between gap-6">
        <a href="{{ route('home') }}" @if(request()->routeIs('home')) aria-current="page" @endif class="rounded-sm text-base font-semibold tracking-tight text-slate-950 hover:text-sky-800">
            Mohamed M’Kirchel
        </a>

        <nav aria-label="Navigation principale" class="hidden items-center gap-7 md:flex">
            <a class="rounded-sm text-sm font-medium hover:text-sky-800" href="{{ route('home') }}#expertises">Expertises</a>
            <a class="rounded-sm text-sm font-medium hover:text-sky-800" href="{{ route('home') }}#approche">Approche</a>
            <a class="rounded-sm text-sm font-medium hover:text-sky-800" href="{{ route('home') }}#a-propos">À propos</a>
            <a class="button-primary min-h-11 px-5 py-2 text-sm" href="{{ route('home') }}#contact">Étudier mon besoin</a>
        </nav>

        <div id="mobile-navigation"></div>
    </div>
</header>
