<script setup lang="ts">
import {ChevronRight} from "lucide-vue-next";
import type {SuperHero} from '@/types';
import SuperHeroProfileAvatar from "@/components/super-hero-profile/SuperHeroProfileAvatar.vue";
interface Props {
    superHero?: SuperHero | null
}

const props = withDefaults(defineProps<Props>(), {
    superHero: null,
})
</script>

<template>
    <li v-if="props.superHero" class="flex p-4 text-primary hover:bg-primary/30">
        <RouterLink
            :to="{ name: 'super-hero.show', params: { id: props.superHero.id } }"
            class="flex flex-row gap-3 items-center justify-between w-full"
        >
            <div class="flex flex-row justify-start gap-3 items-center">
                <SuperHeroProfileAvatar :imageUrl="props.superHero.imageUrl" :title="props.superHero.name" class="h-10 w-10 flex-none rounded-full"/>
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
