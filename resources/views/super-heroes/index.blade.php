<x-layout.default>
    <div class="grid">
        <form action="{{ route('super-hero.index') }}">
            <div class="grid bg-gray-800 rounded-md border-2 shadow p-4 my-4 ">
                <h2 class="text-lg font-semibold text-white">Search</h2>
                <div class="flex flex-row gap-2 w-full">
                    <div
                        class="flex items-center rounded-md bg-white/5 pl-3 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2">
                        <input id="search" type="text" name="search" placeholder="Type the super hero name"
                               class="block min-w-0 grow bg-transparent py-1.5 pr-3 pl-1 text-base text-white placeholder:text-gray-500 focus:outline-none sm:text-sm/6"/>
                    <button type="submit" class="">Search</button>
                </div>
            </div>
        </form>
        <div class="results-container bg-gray-800 space-y-14 shadow rounded-md mt-6">
            <ul role="list" class="divide-y divide-y-white  my-6">
                @foreach ($superHeroes as $superHero)
                    <li class="flex p-4 my-2">
                        <a class="flex flex-row gap-3 items-center" href="{{ route('super-hero.show',['id'=>$superHero->id]) }}">
                            <img src="{{ $superHero->image?->url ?? ""}}" alt="{{$superHero->name}}"
                                 class="h-10 w-10 flex-none rounded-full bg-gray-800 outline -outline-offset-1 outline-white/10"/>
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm/6 font-semibold text-white">{{ $superHero->name }}</p>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-layout.default>
