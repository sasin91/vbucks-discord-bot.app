<section id="welcome">
    <article id="welcome_hero" class="overflow-hidden isolate">
        <div class="absolute inset-x-0 overflow-hidden -top-40 -z-10 transform-gpu blur-3xl sm:-top-80"
            aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
        <div class="max-w-2xl py-32 mx-auto sm:py-48 lg:py-56">
            <div class="text-center">
                <x-headline class="text-4xl font-bold tracking-tight sm:text-6xl">{{ __('Tired of not having VBucks for that skin or emote?') }}</x-headline>
                <a href="https://discord.gg/vyMEBJjzMh" target="_blank" class="mt-6 text-lg font-medium leading-8 text-gray-600 transition-all duration-300 ease-in-out border-transparent dark:text-white group">
                    <x-underline class="text-indigo-600 group-hover:text-purple-500">
                        {{ __('We hear ya, join our discord and hit up that /vbucks command') }}
                    </x-underline>
                </a>
            </div>
        </div>
        <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
            aria-hidden="true">
            <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
    </article>

    <article id="welcome_pricing" class="isolate">
        <div class="flow-root pt-24 pb-16 dark:bg-base-900 sm:pt-32 lg:pb-0">
            <div class="px-6 mx-auto max-w-7xl lg:px-8">
                <div class="relative z-10">
                    <x-headline
                        class="max-w-4xl mx-auto text-5xl font-bold tracking-tight text-center">
                        {{ __('Simple & affordable pricing') }}</x-headline>
                    <p class="max-w-2xl mx-auto mt-4 text-lg leading-8 text-center text-base-900 dark:text-white/60">
                        {{ __(':price per 100 vbucks', ['price' => '5 kr.']) }}</p>
                </div>
                <div
                    class="relative grid max-w-md grid-cols-1 mx-auto mt-10 gap-y-8 lg:mx-0 lg:-mb-14 lg:max-w-none lg:grid-cols-3">
                    <svg viewBox="0 0 1208 1024" aria-hidden="true"
                        class="absolute -bottom-48 left-1/2 h-[64rem] -translate-x-1/2 translate-y-1/2 [mask-image:radial-gradient(closest-side,white,transparent)] lg:-top-48 lg:bottom-auto lg:translate-y-0">
                        <ellipse cx="604" cy="512" fill="url(#d25c25d4-6d43-4bf9-b9ac-1842a30a4867)"
                            rx="604" ry="512" />
                        <defs>
                            <radialGradient id="d25c25d4-6d43-4bf9-b9ac-1842a30a4867">
                                <stop stop-color="#7775D6" />
                                <stop offset="1" stop-color="#E935C1" />
                            </radialGradient>
                        </defs>
                    </svg>
                    <div class="hidden lg:absolute lg:inset-x-px lg:bottom-0 lg:top-4 lg:block lg:rounded-t-2xl lg:bg-base-900-800/80 lg:ring-1 lg:ring-white/10"
                        aria-hidden="true"></div>
                    <div
                        class="relative rounded-2xl bg-base-900-800/80 ring-1 ring-white/10 lg:bg-transparent lg:pb-14 lg:ring-0">
                        <div class="p-8 lg:pt-12 xl:p-10 xl:pt-14">
                            <h3 id="tier-starter" class="text-sm font-semibold leading-6 text-indigo-600 dark:text-white">{{ __('Single skin') }}</h3>
                            <div
                                class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between lg:flex-col lg:items-stretch">
                                <div class="flex items-center mt-2 gap-x-4">
                                    <!-- Price, update based on frequency toggle state -->
                                    <p class="text-4xl font-bold tracking-tight dark:text-white">100kr</p>
                                    <div class="text-sm leading-5">
                                        <p class="dark:text-white">DKK</p>
                                    </div>
                                </div>
                                <x-button aria-describedby="tier-starter"
                                    class="transition-all duration-300 ease-in-out border-transparent btn-primary group">
                                    <x-underline class="text-white group-hover:text-lg">/vbucks 2000</x-underline>
                                </x-button>
                            </div>
                            <div class="flow-root mt-8 sm:mt-10">
                                <ul role="list"
                                    class="-my-2 text-sm leading-6 text-white border-t divide-y lg:border-t-0 divide-white/5 border-white/5">
                                    <li class="flex py-2 gap-x-3">
                                        <svg class="flex-none w-5 h-6 text-base-900-500" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ __('A single skin or maybe a discounted bundle') }}
                                    </li>
                                    <li class="flex py-2 gap-x-3">
                                        <svg class="flex-none w-5 h-6 text-base-900-500" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ __('A few emotes') }}
                                    </li>
                                    <li class="flex py-2 gap-x-3">
                                        <svg class="flex-none w-5 h-6 text-base-900-500" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ __('Maybe some soundtracks') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="relative z-10 bg-white shadow-xl rounded-2xl ring-1 ring-base-900/10">
                        <div class="p-8 lg:pt-12 xl:p-10 xl:pt-14">
                            <h3 id="tier-scale" class="text-sm font-semibold leading-6 text-base-900">{{ __('Big bundle') }}</h3>
                            <div
                                class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between lg:flex-col lg:items-stretch">
                                <div class="flex items-center mt-2 gap-x-4">
                                    <!-- Price, update based on frequency toggle state -->
                                    <p
                                        class="text-4xl font-bold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-pink-300">
                                        400 kr.</p>
                                    <div class="text-sm leading-5">
                                        <p class="text-base-900">DKK</p>
                                    </div>
                                </div>
                                <a href="#" aria-describedby="tier-scale"
                                    class="px-3 py-2 text-sm font-semibold leading-6 text-center text-white bg-indigo-600 rounded-md shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 hover:bg-indigo-500 focus-visible:outline-indigo-600">
                                    /vbucks 8000
                                </a>
                            </div>
                            <div class="flow-root mt-8 sm:mt-10">
                                <ul role="list"
                                    class="-my-2 text-sm leading-6 border-t divide-y text-base-900-600 lg:border-t-0 divide-base-900/5 border-base-900/5">
                                    <li class="flex py-2 gap-x-3">
                                        <svg class="flex-none w-5 h-6 text-indigo-600" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ __('A bundle') }}
                                    </li>
                                    <li class="flex py-2 gap-x-3">
                                        <svg class="flex-none w-5 h-6 text-indigo-600" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ __('Bunch of emotes & dances') }}
                                    </li>
                                    <li class="flex py-2 gap-x-3">
                                        <svg class="flex-none w-5 h-6 text-indigo-600" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ __('and probably still a few left over') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div
                    class="relative rounded-2xl bg-base-900-800/80 ring-1 ring-white/10 lg:bg-transparent lg:pb-14 lg:ring-0">
                    <div class="p-8 lg:pt-12 xl:p-10 xl:pt-14">
                        <h3 id="tier-starter" class="text-sm font-semibold leading-6 text-indigo-600 dark:text-white">{{ __('Small bundle') }}</h3>
                        <div
                            class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between lg:flex-col lg:items-stretch">
                            <div class="flex items-center mt-2 gap-x-4">
                                <!-- Price, update based on frequency toggle state -->
                                <p class="text-4xl font-bold tracking-tight dark:text-white">200kr</p>
                                <div class="text-sm leading-5">
                                    <p class="dark:text-white">DKK</p>
                                </div>
                            </div>
                            <x-button aria-describedby="tier-starter"
                                class="transition-all duration-300 ease-in-out border-transparent btn-primary group">
                                <x-underline class="text-white group-hover:text-lg">/vbucks 4000</x-underline>
                            </x-button>
                        </div>
                        <div class="flow-root mt-8 sm:mt-10">
                            <ul role="list"
                                class="-my-2 text-sm leading-6 text-white border-t divide-y lg:border-t-0 divide-white/5 border-white/5">
                                <li class="flex py-2 gap-x-3">
                                    <svg class="flex-none w-5 h-6 text-base-900-500" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Basic invoicing
                                </li>
                                <li class="flex py-2 gap-x-3">
                                    <svg class="flex-none w-5 h-6 text-base-900-500" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Easy to use accounting
                                </li>
                                <li class="flex py-2 gap-x-3">
                                    <svg class="flex-none w-5 h-6 text-base-900-500" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Mutli-accounts
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </article>
</section>
