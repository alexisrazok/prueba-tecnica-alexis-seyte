@props(['superHero'])
@if(isset($superHero) && !is_null($superHero))
    <li class="flex p-4 my-2">
        <a class="flex flex-row gap-3 items-center" href="{{ route('super-hero.show',['id'=>$superHero->id]) }}">
            <img src="{{ $superHero->imageUrl}}" alt="{{$superHero->name}}"
                 class="h-10 w-10 flex-none rounded-full bg-gray-800 outline -outline-offset-1 outline-white/10"
                 onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCIgdmlld0JveD0iMCAwIDQwIDQwIj48cmVjdCB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIGZpbGw9IiMxZjI5MzciLz48L3N2Zz4=';"
            />
            <div class="min-w-0 flex-auto">
                <p class="text-sm/6 font-semibold text-white">{{ $superHero->name }}</p>
            </div>
        </a>
    </li>
@else
    <li class="flex p-4 my-2">
        <div class="min-w-0 flex-auto items-center text-center">
            <p class="text-lg font-semibold text-white">No results found.</p>
        </div>
    </li>
@endif
