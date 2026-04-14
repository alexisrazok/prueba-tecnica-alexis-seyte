<script setup lang="ts">
import type { SuperHero } from '@/types'
import SuperHeroItem from '@/components/super-hero-list/SuperHeroItem.vue'

interface Props {
    superHeroes: SuperHero[]
}

const props = defineProps<Props>();
</script>

<template>
    <ul role="list" class="divide-y divide-y-white my-6">
        <template v-if="props.superHeroes.length">
            <SuperHeroItem
                v-for="hero in props.superHeroes"
                :key="hero.id"
                :super-hero="hero"
            />
        </template>
        <SuperHeroItem v-else />
    </ul>
</template>
