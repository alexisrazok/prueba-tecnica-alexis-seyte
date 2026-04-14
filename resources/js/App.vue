<script setup lang="ts">
import {Search} from 'lucide-vue-next'
import {Button} from '@/components/ui/button'

const appName = import.meta.env.VITE_APP_NAME ?? 'MyApp'
</script>
<template>
    <header class="border-b bg-primary after:border-primary/10 text-primary-foreground">
        <div class="container mx-auto px-4 h-16 flex items-center justify-start gap-3">
            <span class="font-semibold text-lg tracking-tight">
              {{ appName }}
            </span>
            <nav class="flex items-center gap-2">
                <Button variant="ghost" size="sm" as-child>
                    <RouterLink to="/" class="flex items-center gap-2">
                        <Search class="size-4"/>
                        Search
                    </RouterLink>
                </Button>
            </nav>
        </div>
    </header>
    <div class="min-h-screen bg-background text-foreground">
        <main class="container mx-auto px-4 py-8">
            <RouterView/>
        </main>
    </div>
</template>
