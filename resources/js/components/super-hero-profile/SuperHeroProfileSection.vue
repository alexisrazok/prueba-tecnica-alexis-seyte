<script setup lang="ts">

import {cn} from "@/lib/utils";
import type {HTMLAttributes} from "vue";
import {useSuperHero} from "@/composables/useSuperHero";
import {type LucideIcon} from "lucide-vue-next";
import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card";

interface Props {
    icon?: LucideIcon,
    title: string,
    class?: HTMLAttributes['class'];
}

const props = defineProps<Props>();
const {loading} = useSuperHero();
</script>

<template>
    <Card>
        <template v-if="props.title || props.icon">
            <CardHeader>
                <CardTitle class="flex items-center gap-2 text-base">
                    <Component v-if="props.icon" :is="props.icon" class="size-6"/>
                    {{ props.title.toUpperCase() }}
                </CardTitle>
            </CardHeader>
        </template>
        <CardContent :class="cn('flex flex-col gap-3 text-sm', props.class)">
            <template v-if="loading">
                <slot name="skeleton"/>
            </template>
            <template v-else>
                <slot/>
            </template>
        </CardContent>
    </Card>
</template>
