<script setup lang="ts">

import {Skeleton} from "@/components/ui/skeleton";
import {useSuperHero} from "@/composables/useSuperHero";
const FALLBACK_IMAGE = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCIgdmlld0JveD0iMCAwIDQwIDQwIj48cmVjdCB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIGZpbGw9IiMxZjI5MzciLz48L3N2Zz4='

const {hero, loading} = useSuperHero();
</script>

<template>
    <div class="relative h-64 sm:h-80 w-full overflow-hidden rounded-xl">
        <Skeleton v-if="loading" class="absolute inset-0"/>
        <template v-else-if="hero">
            <img
                :src="hero.imageUrl ?? FALLBACK_IMAGE"
                :alt="hero.name"
                class="absolute inset-0 w-full h-full object-cover object-center scale-110 blur-sm brightness-50"
                @error="(e) => ((e.target as HTMLImageElement).src = FALLBACK_IMAGE)"
            />
            <div class="absolute inset-0 bg-linear-to-t from-background via-background/40 to-transparent"/>
        </template>
    </div>
</template>
