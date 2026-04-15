<script setup lang="ts">
import {useForm,Field as VeeField} from "vee-validate";
import {Card, CardContent, CardDescription, CardHeader, CardTitle} from "@/components/ui/card";
import {Field,FieldError, FieldGroup} from "@/components/ui/field";
import {Input} from "@/components/ui/input";
import {Button} from "@/components/ui/button";
import SuperHeroList from "@/components/super-hero-list/SuperHeroList.vue";
import {Search, Loader2} from "lucide-vue-next";
import {ref} from "vue";
import {useSuperHero} from "@/composables/useSuperHero";
import SuperHeroListSkeleton from "@/components/super-hero-list/SuperHeroListSkeleton.vue";

interface SearchForm {
    search: string;
}
const { handleSubmit } = useForm<SearchForm>({
    initialValues: {
        search: '',
    }
});

const { heroes, loading, error, searchByName, validationErrors } = useSuperHero();
const nameSearch = ref<string | null>(null);

const submitSearch = handleSubmit(async (values) => {
    if (!values.search.trim()) return
    nameSearch.value = values.search
    await searchByName(values.search)
});

</script>

<template>
    <Card class="w-full">
        <CardHeader>
            <CardTitle class="text-lg font-semibold">Search</CardTitle>
            <CardDescription>
                Search a superhero by name
            </CardDescription>
        </CardHeader>
        <CardContent>
            <form id="form-super-hero-search" @submit="submitSearch">
                <FieldGroup class="flex flex-col sm:flex-row gap-4 w-full">
                    <VeeField v-slot="{ field, errors }" name="search" class="w-full">
                        <Field :data-invalid="!!errors.length || validationErrors.search?.length" class="w-full">
                            <Input
                                id="super-hero-search-name"
                                v-bind="field"
                                placeholder="Type the super hero name"
                                autocomplete="off"
                                :aria-invalid="!!errors.length"
                                :disabled="loading"
                                required
                            />
                            <FieldError v-if="errors.length || validationErrors.search?.length" :errors="validationErrors.search?.concat(errors)" />
                        </Field>
                    </VeeField>
                    <Button type="submit" class="flex items-center gap-2" :disabled="loading">
                        <Loader2 v-if="loading" class="size-4 animate-spin" />
                        <Search v-else class="size-4"/>
                        Search
                    </Button>
                </FieldGroup>
            </form>
        </CardContent>
    </Card>
    <Card v-if="nameSearch && !validationErrors.search?.length" class="w-full mt-4">
        <CardHeader>
            <CardTitle class="font-medium text-xl">Search results for: <strong>{{ nameSearch }}</strong></CardTitle>
        </CardHeader>
        <CardContent>
            <SuperHeroListSkeleton v-if="loading" :rows="5" />
            <SuperHeroList v-else :super-heroes="heroes" />
        </CardContent>
    </Card>
</template>
