<script setup lang="ts">
import type { SuperHero } from '@/types'
import SuperHeroItem from '@/components/super-hero-list/SuperHeroItem.vue'
import {
    Pagination,
    PaginationContent,
    PaginationEllipsis, PaginationFirst,
    PaginationItem, PaginationLast,
    PaginationNext,
    PaginationPrevious,
} from '@/components/ui/pagination'
import {computed, ref} from "vue";
interface Props {
    superHeroes: SuperHero[]
}
const props = defineProps<Props>();

const currentPage = ref(1)
const itemsPerPage = 10

const paginatedItems = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage
    return props.superHeroes.slice(start, start + itemsPerPage)
})
</script>

<template>
    <ul role="list" class="divide-y divide-y-white">
        <template v-if="props.superHeroes.length">
            <SuperHeroItem
                v-for="hero in paginatedItems"
                :key="hero.id"
                :super-hero="hero"
            />
        </template>
        <SuperHeroItem v-else />
    </ul>
    <div class="flex flex-col gap-6 mt-2">
        <Pagination v-slot="{ page }" show-edges :items-per-page="itemsPerPage" :total="props.superHeroes.length" :default-page="1" @update:page="currentPage = $event" :sibling-count="1">
            <PaginationContent v-slot="{ items }">
                <PaginationFirst />
                <PaginationPrevious />
                <template v-for="(item, index) in items" :key="index">
                    <PaginationItem
                        v-if="item.type === 'page'"
                        :value="item.value"
                        :is-active="item.value === page"
                    >
                        {{ item.value }}
                    </PaginationItem>
                    <PaginationEllipsis v-else :index="index" />
                </template>
                <PaginationNext />
                <PaginationLast />
            </PaginationContent>
        </Pagination>
    </div>
</template>
