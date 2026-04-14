<script setup lang="ts">
import {useForm,Field as VeeField} from "vee-validate";
import {Card, CardContent, CardDescription, CardHeader, CardTitle} from "@/components/ui/card";
import {FieldError, FieldGroup, FieldLabel} from "@/components/ui/field";
import {Input} from "@/components/ui/input";
import {Button} from "@/components/ui/button";
import SuperHeroList from "@/components/super-hero-list/SuperHeroList.vue";
import {Search} from "lucide-vue-next";
import type {SuperHero} from "@/types";

interface SearchForm {
    search: string;
}
const { handleSubmit,values } = useForm<SearchForm>({
    initialValues: {
        search: '',
    }
});
const submitSearch = handleSubmit(values => {
    nameSearch = values.search;
    heroes = [];
});

let nameSearch: string | null = null;
let heroes: SuperHero[] = [];

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
                    <VeeField v-slot="{ field, errors }" name="search">
                        <Field :data-invalid="!!errors.length" orientation="horizontal" class="w-full">
                            <Input
                                id="super-hero-search-name"
                                v-bind="field"
                                placeholder="Type the super hero name"
                                autocomplete="off"
                                :aria-invalid="!!errors.length"
                            />
                            <FieldError v-if="errors.length" :errors="errors" />
                        </Field>
                    </VeeField>
                    <Field orientation="horizontal">
                        <Button variant="secondary" class="flex items-center gap-2">
                            <Search class="size-4"/>
                            Search
                        </Button>
                    </Field>
                </FieldGroup>
            </form>
        </CardContent>
    </Card>
    <Card v-if="nameSearch" class="w-full mt-4">
        <CardHeader>
            <CardTitle>Search results for: <strong>{{ nameSearch }}</strong></CardTitle>
        </CardHeader>
        <CardContent>
            <SuperHeroList :super-heroes="heroes" />
        </CardContent>
    </Card>
</template>
