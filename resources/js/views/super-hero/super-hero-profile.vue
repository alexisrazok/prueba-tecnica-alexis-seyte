<script setup lang="ts">
import {onMounted} from 'vue'
import {useRoute} from 'vue-router'
import {useSuperHero} from '@/composables/useSuperHero'
import {Skeleton} from '@/components/ui/skeleton'
import {Badge} from '@/components/ui/badge'
import {Separator} from '@/components/ui/separator'
import {Progress} from '@/components/ui/progress'
import {BookOpen, Brain, Briefcase, Flame, Shield, Swords, User, Users, Wind, Zap, SearchX} from 'lucide-vue-next'
import SuperHeroProfileHeader from "@/components/super-hero-profile/SuperHeroProfileHeader.vue";
import SuperHeroProfileAvatar from "@/components/super-hero-profile/SuperHeroProfileAvatar.vue";
import SuperHeroProfileSection from "@/components/super-hero-profile/SuperHeroProfileSection.vue";

const route = useRoute()
const {hero, loading, error, getById} = useSuperHero()

onMounted(() => getById(route.params.id as string))

const statIcons = {
    intelligence: Brain,
    strength: Flame,
    speed: Wind,
    durability: Shield,
    power: Zap,
    combat: Swords,
}

const alignmentVariant = (alignment: string) => ({
    good: 'default',
    bad: 'destructive',
    neutral: 'secondary',
}[alignment.toLowerCase()]) as 'default' | 'destructive' | 'secondary';

const progressVariant = (statValue: number) => {
    if (statValue <= 20) return 'bg-red-500/20 *:data-[slot=progress-indicator]:bg-red-500';
    if (statValue <= 40) return 'bg-amber-500/20 *:data-[slot=progress-indicator]:bg-amber-500';
    if (statValue <= 60) return 'bg-yellow-200/20 *:data-[slot=progress-indicator]:bg-yellow-200';
    if (statValue <= 80) return 'bg-green-500/20 *:data-[slot=progress-indicator]:bg-green-500';
    return 'bg-indigo-500/20 *:data-[slot=progress-indicator]:bg-indigo-500';
};
</script>

<template>
    <div v-if="!loading && error" class="flex flex-col gap-5 w-full items-center justify-center h-full min-h-dvh">
        <SearchX class="size-28" />
        <h1 class="text-4xl">Super Hero Not Found</h1>
    </div>
    <div v-else-if="!loading && hero" class="pb-16">
        <SuperHeroProfileHeader/>
        <div class="relative px-4 sm:px-8 -mt-20">
            <div class="flex flex-col sm:flex-row items-start sm:items-end gap-4">
                <SuperHeroProfileAvatar :loading="loading" :title="hero?.name" :imageUrl="hero?.imageUrl"/>
                <div class="flex flex-col gap-1 pb-2">
                    <Skeleton v-if="loading" class="h-8 w-48"/>
                    <h1 v-else-if="hero" class="text-3xl font-bold tracking-tight">
                        {{ hero.name }}
                    </h1>
                    <Skeleton v-if="loading" class="h-4 w-32 mt-1"/>
                    <template v-else-if="hero && hero.biography">
                        <p class="text-muted-foreground text-sm">{{ hero.biography.fullName }}</p>
                        <div class="flex items-center gap-2 mt-1">
                            <Badge variant="outline" v-if="hero.biography.publisher">{{
                                    hero.biography.publisher
                                }}
                            </Badge>
                            <Badge v-if="hero.biography?.alignment"
                                   :variant="alignmentVariant(hero.biography?.alignment)" class="capitalize">
                                {{ hero.biography.alignment }}
                            </Badge>
                        </div>
                    </template>
                </div>
            </div>
        </div>
        <div class="mt-8 px-4 sm:px-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="flex flex-col gap-6">
                <SuperHeroProfileSection title="Biography" :icon="BookOpen">
                    <template #skeleton>
                        <Skeleton v-for="i in 5" :key="i" class="h-4 w-full"/>
                    </template>
                    <template v-if="hero && hero.biography">
                        <div class="flex justify-between gap-2">
                            <span class="text-muted-foreground">Alter egos</span>
                            <span class="text-right font-medium">{{ hero.biography.alterEgos ?? '-' }}</span>
                        </div>
                        <Separator/>
                        <div class="flex justify-between gap-2">
                            <span class="text-muted-foreground">Place of birth</span>
                            <span class="text-right font-medium">{{ hero.biography.placeOfBirth ?? '-' }}</span>
                        </div>
                        <Separator/>
                        <div class="flex justify-between gap-2">
                            <span class="text-muted-foreground">First appearance</span>
                            <span class="text-right font-medium">{{ hero.biography.firstAppearance ?? '-' }}</span>
                        </div>
                        <Separator/>
                        <div class="flex flex-col gap-1">
                            <span class="text-muted-foreground">Aliases</span>
                            <div class="flex flex-wrap gap-1 mt-1">
                                <Badge
                                    v-if="hero.biography.aliases"
                                    v-for="alias in hero.biography.aliases"
                                    :key="alias"
                                    variant="secondary"
                                    class="text-xs"
                                >
                                    {{ alias }}
                                </Badge>
                                <template v-else>-</template>
                            </div>
                        </div>
                    </template>
                </SuperHeroProfileSection>
                <SuperHeroProfileSection title="Appearance" :icon="User">
                    <template #skeleton>
                        <Skeleton v-for="i in 5" :key="i" class="h-4 w-full"/>
                    </template>
                    <template v-if="hero && hero.appearance">
                        <div class="flex justify-between">
                            <span class="text-muted-foreground">Gender</span>
                            <span class="font-medium">{{ hero.appearance.gender ?? '-' }}</span>
                        </div>
                        <Separator/>
                        <div class="flex justify-between">
                            <span class="text-muted-foreground">Race</span>
                            <span class="font-medium">{{ hero.appearance.race ?? '-' }}</span>
                        </div>
                        <Separator/>
                        <div class="flex justify-between">
                            <span class="text-muted-foreground">Height</span>
                            <span class="font-medium">{{ hero.appearance.heightMetric ?? '-' }}</span>
                        </div>
                        <Separator/>
                        <div class="flex justify-between">
                            <span class="text-muted-foreground">Weight</span>
                            <span class="font-medium">{{ hero.appearance.weightMetric ?? '-' }}</span>
                        </div>
                        <Separator/>
                        <div class="flex justify-between">
                            <span class="text-muted-foreground">Eye color</span>
                            <span class="font-medium">{{ hero.appearance.eyeColor ?? '-' }}</span>
                        </div>
                        <Separator/>
                        <div class="flex justify-between">
                            <span class="text-muted-foreground">Hair color</span>
                            <span class="font-medium">{{ hero.appearance.hairColor ?? '-' }}</span>
                        </div>
                    </template>
                </SuperHeroProfileSection>
            </div>
            <div class="lg:col-span-2 flex flex-col gap-6">
                <SuperHeroProfileSection title="Power Stats" :icon="Zap">
                    <template #skeleton>
                        <div v-for="i in 6" :key="i" class="mb-4">
                            <Skeleton class="h-4 w-24 mb-2"/>
                            <Skeleton class="h-2 w-full"/>
                        </div>
                    </template>
                    <template v-if="hero && hero.powerStats">
                        <div
                            v-for="(icon, stat) in statIcons"
                            :key="stat"
                            class="mb-4 last:mb-0"
                        >
                            <div class="flex items-center justify-between mb-1">
                                <div class="flex items-center gap-2 text-sm font-medium capitalize">
                                    <Component :is="icon" class="size-4 text-muted-foreground"/>
                                    {{ stat }}
                                </div>
                                <span class="text-sm font-bold tabular-nums">
                                    {{ hero.powerStats[stat] }}
                                </span>
                            </div>
                            <Progress :model-value="hero.powerStats[stat]" class="h-2"
                                      :class="progressVariant(hero.powerStats[stat])"/>
                        </div>
                    </template>
                </SuperHeroProfileSection>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <SuperHeroProfileSection title="Work" :icon="Briefcase">
                        <template #skeleton>
                            <Skeleton v-for="i in 2" :key="i" class="h-4 w-full"/>
                        </template>
                        <template v-if="hero">
                            <div class="flex flex-col gap-1">
                                <span class="text-muted-foreground">Occupation</span>
                                <span class="font-medium">{{ hero.work?.occupation ?? '-' }}</span>
                            </div>
                            <Separator/>
                            <div class="flex flex-col gap-1">
                                <span class="text-muted-foreground">Base</span>
                                <span class="font-medium">{{ hero.work?.base ?? '-' }}</span>
                            </div>
                        </template>
                    </SuperHeroProfileSection>

                    <SuperHeroProfileSection title="Connections" :icon="Users">
                        <template #skeleton>
                            <Skeleton v-for="i in 2" :key="i" class="h-4 w-full"/>
                        </template>
                        <template v-if="hero">
                            <div class="flex flex-col gap-1">
                                <span class="text-muted-foreground">Group affiliation</span>
                                <span class="font-medium">{{ hero.connections?.groupAffiliation ?? '-' }}</span>
                            </div>
                            <Separator/>
                            <div class="flex flex-col gap-1">
                                <span class="text-muted-foreground">Relatives</span>
                                <span class="font-medium">{{ hero.connections?.relatives ?? '-' }}</span>
                            </div>
                        </template>
                    </SuperHeroProfileSection>
                </div>
            </div>
        </div>
    </div>
</template>
