<script setup lang="ts">
import {ChevronRight} from "lucide-vue-next";
import type {SuperHero} from '@/types';

const FALLBACK_IMAGE = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCIgdmlld0JveD0iMCAwIDQwIDQwIj48cmVjdCB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIGZpbGw9IiMxZjI5MzciLz48L3N2Zz4='

interface Props {
    superHero?: SuperHero | null
}

const props = withDefaults(defineProps<Props>(), {
    superHero: null,
})
</script>

<template>
    <li v-if="props.superHero" class="flex p-4 text-primary">
        <RouterLink
            :to="{ name: 'super-hero.show', params: { id: props.superHero.id } }"
            class="flex flex-row gap-3 items-center justify-between w-full"
        >
            <div class="flex flex-row justify-start gap-3 items-center">
                <img
                    :src="props.superHero.imageUrl ?? FALLBACK_IMAGE"
                    :alt="props.superHero.name"
                    class="h-10 w-10 flex-none rounded-full"
                    @error="(e) => ((e.target as HTMLImageElement).src = FALLBACK_IMAGE)"
                />
                <div class="min-w-0 flex-auto">
                    <p class="text-base font-semibold">{{ props.superHero.name }}</p>
                </div>
            </div>
            <ChevronRight class="size-10"/>
        </RouterLink>
    </li>
    <li v-else class="flex p-4 my-2">
        <div class="min-w-0 flex-auto items-center text-center">
            <p class="text-lg font-semibold">No results found.</p>
        </div>
    </li>
</template>
