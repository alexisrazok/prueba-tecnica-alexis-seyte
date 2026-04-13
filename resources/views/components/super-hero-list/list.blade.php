@props(['superHeroes', 'resultsFor'])
<h3 class="text-white font-medium text-lg ">Search results for: <strong>{{$resultsFor}}</strong></h3>
<ul role="list" class="divide-y divide-y-white my-6">
    @forelse($superHeroes as $superHero)
        <x-super-hero-list.item :super-hero="$superHero" />
    @empty
        <x-super-hero-list.item />
    @endforelse
</ul>
