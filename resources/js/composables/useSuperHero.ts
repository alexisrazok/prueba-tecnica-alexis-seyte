import { ref } from 'vue'
import api from '@/api/index'
import type {ApiValidationError, SuperHero} from '@/types'
import {isAxiosError} from "axios";

const hero = ref<SuperHero | null>(null);
const heroes = ref<SuperHero[]>([]);
const loading = ref(false);
export function useSuperHero() {
    const error = ref<string | null>(null);
    const validationErrors = ref<Record<string, string[]>>({});

    async function searchByName(name: string) {
        loading.value = true;
        error.value = null;
        heroes.value = [];

        try {
            const { data } = await api.get<SuperHero[]>('super-hero', {
                params: { search:name },
            })
            heroes.value = data
        } catch (e) {
            if (isAxiosError(e) && e.response?.status === 422) {
                const validationData = e.response.data as ApiValidationError;
                error.value = validationData.message
                validationErrors.value = validationData.errors
            } else {
                error.value = 'Error fetching heroes'
            }
        } finally {
            loading.value = false
        }
    }

    async function getById(id: string) {
        loading.value = true
        error.value = null
        hero.value = null

        try {
            const { data } = await api.get<SuperHero>(`/super-hero/${id}`)
            if(Object.keys(data).length === 0){
                error.value = 'Hero not found'
            }else{
                hero.value = data
            }
        } catch (e) {
            if (isAxiosError(e) && e.response?.status === 404) {
                error.value = 'Hero not found'
            }else{
                error.value = 'Error fetching hero'
            }
        } finally {
            loading.value = false
        }
    }

    return { heroes, hero, loading, error, searchByName, getById, validationErrors }
}
