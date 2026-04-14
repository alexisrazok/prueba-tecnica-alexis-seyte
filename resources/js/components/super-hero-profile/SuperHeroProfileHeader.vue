<script setup lang="ts">

import {Skeleton} from "@/components/ui/skeleton";
import {useSuperHero} from "@/composables/useSuperHero";

const {hero, loading} = useSuperHero();
</script>

<template>
    <div class="relative h-64 sm:h-80 w-full overflow-hidden rounded-xl">
        <Skeleton v-if="loading" class="absolute inset-0"/>
        <template v-else-if="hero">
            <img
                :src="hero.imageUrl ?? ''"
                :alt="hero.name"
                class="absolute inset-0 w-full h-full object-cover object-center scale-110 blur-sm brightness-50"
            />
            <div class="absolute inset-0 bg-linear-to-t from-background via-background/40 to-transparent"/>
        </template>
    </div>
</template>
