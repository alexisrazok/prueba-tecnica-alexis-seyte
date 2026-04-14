<script setup lang="ts">
import { Skeleton } from '@/components/ui/skeleton'

interface Props {
    rows?: number
}

withDefaults(defineProps<Props>(), {
    rows: 5,
})
</script>

<template>
    <ul role="list" class="divide-y divide-y-white my-6">
        <li v-for="i in rows" :key="i" class="flex p-4 my-2">
            <div class="flex flex-row gap-3 items-center w-full">
                <Skeleton class="h-10 w-10 rounded-full flex-none" />
                <Skeleton class="h-4 w-48" />
            </div>
        </li>
    </ul>
</template>
