<x-layout
    title="Mohamed M’Kirchel — Automatisation, API et données"
    description="Développeur senior spécialisé en automatisation de processus, intégration API, bases de données et applications web métier."
    :canonical="route('home')"
    :structured-data="[
        '@context' => 'https://schema.org',
        '@type' => 'Person',
        'name' => 'Mohamed M’Kirchel',
        'url' => route('home'),
        'jobTitle' => 'Développeur senior',
        'description' => 'Développeur senior spécialisé en automatisation, intégration API, bases de données et applications web métier.',
        'knowsAbout' => [
            'Automatisation de processus',
            'Intégration API',
            'Bases de données',
            'Applications web métier',
        ],
    ]"
>
    <section class="overflow-hidden bg-white">
        <div class="page-container grid gap-12 py-20 sm:py-24 lg:grid-cols-[1.6fr_0.8fr] lg:items-center lg:py-32">
            <div>
                <p class="eyebrow">Automatisation · Intégration API · Applications métier</p>
                <h1 class="mt-5 max-w-4xl text-4xl font-semibold tracking-[-0.035em] text-slate-950 sm:text-5xl lg:text-6xl lg:leading-[1.08]">
                    J’automatise vos processus, connecte vos systèmes et fiabilise vos données.
                </h1>
                <p class="mt-7 max-w-2xl text-lg leading-8 text-slate-600">
                    J’aide les entreprises à réduire les manipulations manuelles et à mieux faire circuler l’information entre leurs outils avec des solutions métier ciblées.
                </p>
                <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                    <a class="button-primary" href="#contact">Étudier mon besoin</a>
                    <a class="button-secondary" href="#approche">Découvrir mon approche</a>
                </div>
            </div>
            <aside aria-label="Domaines d’intervention" class="rounded-2xl border border-slate-200 bg-slate-50 p-7 sm:p-9">
                <p class="text-sm font-semibold text-slate-500">Trois résultats métier</p>
                <ul class="mt-6 space-y-5 text-xl font-semibold text-slate-950">
                    <li class="border-b border-slate-200 pb-5">Automatiser</li>
                    <li class="border-b border-slate-200 pb-5">Connecter</li>
                    <li>Fiabiliser</li>
                </ul>
            </aside>
        </div>
    </section>

    <section id="expertises" aria-labelledby="expertises-title" class="section-space scroll-mt-8">
        <div class="page-container">
            <p class="eyebrow">Expertises</p>
            <h2 id="expertises-title" class="mt-4 max-w-3xl text-3xl font-semibold tracking-tight text-slate-950 sm:text-4xl">Des interventions ciblées sur vos opérations essentielles</h2>
            <div class="mt-10 grid gap-5 md:grid-cols-3">
                <x-expertise-card number="01" title="Automatiser les processus">
                    Réduire les tâches répétitives, homogénéiser les traitements et limiter les oublis ou erreurs manuelles.
                </x-expertise-card>
                <x-expertise-card number="02" title="Connecter les systèmes">
                    Faire circuler les informations entre applications grâce aux API, webhooks et flux adaptés à l’existant.
                </x-expertise-card>
                <x-expertise-card number="03" title="Fiabiliser les données">
                    Extraire, rapprocher, transformer et contrôler les données pour les rendre plus cohérentes et exploitables.
                </x-expertise-card>
            </div>
        </div>
    </section>

    <section id="approche" aria-labelledby="approche-title" class="section-space scroll-mt-8 bg-slate-950 text-slate-200">
        <div class="page-container">
            <p class="eyebrow text-sky-300">Approche</p>
            <h2 id="approche-title" class="mt-4 max-w-3xl text-3xl font-semibold tracking-tight text-white sm:text-4xl">Comprendre le processus avant de développer la solution</h2>
            <p class="mt-5 max-w-2xl leading-7 text-slate-300">Une démarche structurée pour résoudre le bon problème avec une solution proportionnée.</p>
            <ol class="mt-12 grid gap-px overflow-hidden rounded-2xl bg-slate-700 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['Comprendre', 'Observer le fonctionnement actuel, les outils et les points de friction.'],
                    ['Définir', 'Préciser le résultat attendu avant de choisir une technologie.'],
                    ['Concevoir', 'Construire la réponse la plus simple qui résout correctement le besoin.'],
                    ['Vérifier', 'Tester des scénarios réalistes avant d’étendre l’utilisation.'],
                ] as [$title, $text])
                    <li class="bg-slate-900 p-7">
                        <p class="text-sm font-semibold text-sky-300">0{{ $loop->iteration }}</p>
                        <h3 class="mt-3 text-xl font-semibold text-white">{{ $title }}</h3>
                        <p class="mt-3 leading-7 text-slate-300">{{ $text }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    <section id="a-propos" aria-labelledby="about-title" class="section-space scroll-mt-8 bg-white">
        <div class="page-container grid gap-12 lg:grid-cols-2 lg:gap-20">
            <div>
                <p class="eyebrow">À propos</p>
                <h2 id="about-title" class="mt-4 text-3xl font-semibold tracking-tight text-slate-950 sm:text-4xl">Une approche technique orientée problèmes métier</h2>
                <p class="mt-6 text-lg leading-8 text-slate-600">Je suis Mohamed M’Kirchel, développeur senior spécialisé en automatisation, intégration API, bases de données et applications web métier.</p>
                <p class="mt-5 leading-7 text-slate-600">Avec plus de 10 ans d’expérience, j’aborde un projet au-delà de son interface : origine des données, circulation de l’information, règles à respecter et gestion des erreurs.</p>
                <p class="mt-6 font-semibold text-slate-950">Chaque collaboration est étudiée au cas par cas.</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-7 sm:p-9">
                <h3 class="text-lg font-semibold text-slate-950">Socle technique</h3>
                <p class="mt-3 leading-7 text-slate-600">PHP, Laravel, SQL Server, API et webhooks. Vue.js est utilisé de façon ciblée dans mes projets personnels actuels.</p>
                <h3 class="mt-8 text-lg font-semibold text-slate-950">Langues</h3>
                <p class="mt-3 leading-7 text-slate-600">Arabe langue maternelle, français professionnel et anglais technique.</p>
                <h3 class="mt-8 text-lg font-semibold text-slate-950">Zone d’intervention</h3>
                <p class="mt-3 leading-7 text-slate-600">Basé au Maroc, travail principalement à distance au Maroc et à l’international.</p>
            </div>
        </div>
    </section>

    <section id="contact" aria-labelledby="contact-title" class="section-space scroll-mt-8 border-t border-slate-200">
        <div class="page-container grid gap-12 lg:grid-cols-[0.9fr_1.1fr] lg:gap-20">
            <div>
                <p class="eyebrow">Contact</p>
                <h2 id="contact-title" class="mt-4 text-3xl font-semibold tracking-tight text-slate-950 sm:text-4xl">Étudier mon besoin</h2>
                <p class="mt-6 text-lg leading-8 text-slate-600">Décrivez simplement le processus actuel, les outils concernés, la difficulté rencontrée et le résultat recherché.</p>
                <p id="contact-note" class="mt-5 rounded-xl border border-sky-200 bg-sky-50 p-4 text-sm leading-6 text-sky-950">Les informations sont transmises uniquement par e-mail afin de répondre à votre demande. Aucune demande n’est enregistrée dans une base de données.</p>
            </div>

            <div>
                @if (session('contact_success'))
                    <div data-contact-status tabindex="-1" role="status" class="mb-6 rounded-xl border border-emerald-300 bg-emerald-50 p-4 font-medium text-emerald-950">
                        {{ session('contact_success') }}
                    </div>
                @endif

                @if (session('contact_error'))
                    <div data-contact-status tabindex="-1" role="alert" class="mb-6 rounded-xl border border-red-300 bg-red-50 p-4 font-medium text-red-950">
                        {{ session('contact_error') }}
                    </div>
                @endif

                @if ($errors->contact->any())
                    @php
                        $visibleErrorFields = collect(['name', 'email', 'organization', 'category', 'message', 'consent'])
                            ->filter(fn (string $field) => $errors->contact->has($field));
                    @endphp
                    <div data-contact-status tabindex="-1" role="alert" aria-labelledby="contact-errors-title" class="mb-6 rounded-xl border border-red-300 bg-red-50 p-4 text-red-950">
                        <p id="contact-errors-title" class="font-semibold">Vérifiez les informations du formulaire.</p>
                        @if ($errors->contact->has('website'))
                            <p data-contact-hidden-error class="mt-2 text-sm font-medium">{{ $errors->contact->first('website') }}</p>
                        @endif
                        @if ($visibleErrorFields->isNotEmpty())
                            <ul data-contact-error-list class="mt-2 list-disc space-y-1 pl-5 text-sm">
                                @foreach ($visibleErrorFields as $field)
                                    <li><a class="font-medium underline underline-offset-4" href="#{{ $field }}">{{ $errors->contact->first($field) }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" aria-describedby="contact-note" class="relative rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                    @csrf

                    <div class="honeypot" aria-hidden="true">
                        <label for="website">Site web</label>
                        <input id="website" type="text" name="website" value="" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="grid gap-6 sm:grid-cols-2">
                        <div>
                            <label for="name" class="block font-medium text-slate-900">Nom <span aria-hidden="true">*</span><span class="sr-only"> (obligatoire)</span></label>
                            <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" autocomplete="name" maxlength="100" required @error('name', 'contact') aria-invalid="true" aria-errormessage="name-error" @enderror>
                            @error('name', 'contact')<p id="name-error" class="form-error">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="email" class="block font-medium text-slate-900">E-mail <span aria-hidden="true">*</span><span class="sr-only"> (obligatoire)</span></label>
                            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" autocomplete="email" maxlength="254" required @error('email', 'contact') aria-invalid="true" aria-errormessage="email-error" @enderror>
                            @error('email', 'contact')<p id="email-error" class="form-error">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div class="mt-6">
                        <label for="organization" class="block font-medium text-slate-900">Organisation <span class="text-sm font-normal text-slate-500">(facultatif)</span></label>
                        <input id="organization" class="form-control" type="text" name="organization" value="{{ old('organization') }}" autocomplete="organization" maxlength="150" @error('organization', 'contact') aria-invalid="true" aria-errormessage="organization-error" @enderror>
                        @error('organization', 'contact')<p id="organization-error" class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="mt-6">
                        <label for="category" class="block font-medium text-slate-900">Catégorie du besoin <span aria-hidden="true">*</span><span class="sr-only"> (obligatoire)</span></label>
                        <select id="category" class="form-control" name="category" required @error('category', 'contact') aria-invalid="true" aria-errormessage="category-error" @enderror>
                            <option value="">Sélectionner un besoin</option>
                            @foreach (config('contact.categories') as $value => $label)
                                <option value="{{ $value }}" @selected(old('category') === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('category', 'contact')<p id="category-error" class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="mt-6">
                        <label for="message" class="block font-medium text-slate-900">Message <span aria-hidden="true">*</span><span class="sr-only"> (obligatoire)</span></label>
                        <textarea id="message" class="form-control min-h-36 resize-y" name="message" minlength="20" maxlength="5000" required @error('message', 'contact') aria-invalid="true" aria-errormessage="message-error" @enderror>{{ old('message') }}</textarea>
                        @error('message', 'contact')<p id="message-error" class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="mt-6">
                        <label for="consent" class="flex items-start gap-3 text-sm leading-6 text-slate-700">
                            <input id="consent" class="mt-1 size-5 shrink-0 rounded border-slate-300 text-sky-800 focus:ring-sky-700" type="checkbox" name="consent" value="1" required @error('consent', 'contact') aria-invalid="true" aria-errormessage="consent-error" @enderror>
                            <span>J’accepte l’utilisation de ces informations pour répondre à ma demande <span class="sr-only">(obligatoire)</span>. Voir la <a class="font-semibold text-sky-800 underline underline-offset-4" href="{{ route('privacy') }}">politique de confidentialité</a>.</span>
                        </label>
                        @error('consent', 'contact')<p id="consent-error" class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <button data-contact-submit type="submit" class="button-primary mt-7 w-full sm:w-auto">Étudier mon besoin</button>
                    <p class="mt-4 text-sm text-slate-600">Les champs marqués d’un astérisque sont obligatoires. N’envoyez aucun secret ni aucune donnée confidentielle.</p>
                </form>
            </div>
        </div>
    </section>
</x-layout>
