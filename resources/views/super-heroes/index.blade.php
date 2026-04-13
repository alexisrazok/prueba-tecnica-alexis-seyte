<x-layout.default>
    <div class="grid">
        <form action="{{ route('super-hero.index') }}">
            <div class="grid bg-gray-800 rounded-md border-2 shadow p-4 my-2">
                <h2 class="text-lg font-semibold text-white">Search</h2>
                <div class="flex flex-row gap-4 w-full">
                    <div
                        class="flex grow items-center rounded-md bg-white/5 pl-3 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2">
                        <input id="search" type="text" name="search" value="{{request()->input('search', '')}}" autocomplete="off" placeholder="Type the super hero name"
                               class="block min-w-0 grow bg-transparent py-1.5 pr-3 pl-1 text-base text-white placeholder:text-gray-500 focus:outline-none sm:text-sm/6" required/>
                    </div>
                    <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">Search</button>
                </div>
                @if($errors->has('search'))
                    @foreach($errors->get('search') as $error)
                        <p class="text-sm/6 font-semibold text-red-500">{{ $error }}</p>
                    @endforeach
                @endif
            </div>
        </form>
        <div class="results-container bg-gray-800 shadow rounded-md p-2 ">
            <x-super-hero-list.list
                :super-heroes="$superHeroes"
                :results-for="request()->input('search')"
            />
        </div>
    </div>
</x-layout.default>
