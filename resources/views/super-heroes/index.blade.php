<x-layout.default>
    Listado de Héroes
    <ul role="list" class="divide-y divide-white/5">
        @foreach ($superHeroes as $superHero)
            <li class="flex justify-between gap-x-6 py-5">
                <div class="flex min-w-0 gap-x-4">
                    <img src="{{ $superHero->image }}" alt="{{$superHero->name}}" class="size-12 flex-none rounded-full bg-gray-800 outline -outline-offset-1 outline-white/10" />
                    <div class="min-w-0 flex-auto">
                        <p class="text-sm/6 font-semibold text-white">{{ $superHero->name }}</p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</x-layout.default>
