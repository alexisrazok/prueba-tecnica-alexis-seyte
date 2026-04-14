<script setup lang="ts">

import {Skeleton} from "@/components/ui/skeleton";
import type {HTMLAttributes} from "vue";
import {cn} from "@/lib/utils";
const FALLBACK_IMAGE = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCIgdmlld0JveD0iMCAwIDQwIDQwIj48cmVjdCB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIGZpbGw9IiMxZjI5MzciLz48L3N2Zz4='

interface Props {
    loading?: boolean,
    imageUrl?: string | null,
    title?: string,
    class?: HTMLAttributes['class'];
}

const props = withDefaults(defineProps<Props>(),{
    loading: false,
});
</script>

<template>
    <div v-if="loading">
        <Skeleton :class="cn('h-32 w-32 rounded-full ring-4 ring-background',props.class)"/>
    </div>
    <img v-else-if="imageUrl"
        :src="props.imageUrl ?? FALLBACK_IMAGE"
        :alt="props.title ?? 'SuperHero Avatar Image'"
        :class="cn('h-32 w-32 rounded-full ring-4 ring-background object-cover object-top flex-none',props.class)"
        @error="(e) => ((e.target as HTMLImageElement).src = FALLBACK_IMAGE)"
    />
</template>
