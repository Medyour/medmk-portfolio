<footer class="border-t border-slate-200 bg-slate-950 py-10 text-slate-300">
    <div class="page-container flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="font-semibold text-white">Mohamed M’Kirchel</p>
            <p class="mt-1 text-sm">Automatisation · Intégration · Données</p>
        </div>
        <nav aria-label="Navigation de pied de page" class="flex flex-wrap gap-x-6 gap-y-3 text-sm">
            <a class="rounded-sm hover:text-white" href="{{ route('home') }}" @if(request()->routeIs('home')) aria-current="page" @endif>Accueil</a>
            <a class="rounded-sm hover:text-white" href="{{ route('privacy') }}" @if(request()->routeIs('privacy')) aria-current="page" @endif>Confidentialité</a>
            <a class="rounded-sm hover:text-white" href="{{ route('legal') }}" @if(request()->routeIs('legal')) aria-current="page" @endif>Mentions légales</a>
        </nav>
    </div>
</footer>
