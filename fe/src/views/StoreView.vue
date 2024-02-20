<script lang="ts" setup>
import Header from "@/components/Header.vue";
import {onMounted, reactive, watch} from "vue";
import Filters from "@/app/filters";
import AppService from '@/app';

const appService = new AppService();

const state: {
    filters: Filters,
    wines: Object,
    styles: Object,
    sorts: Object,
    order: Object | null,
} = reactive({
    filters: new Filters(),
    wines: [],
    styles: [],
    sorts: [],
    order: null,
});

const addWine = async (id: number) => {
    state.order = (await (await appService.addToOrder(id, state.order)).json()).data
}

const removeWine = async (id: number) => {
    if (!state.order) return;
    state.order = (await (await appService.removeFromOrder(id, state.order)).json()).data
}

const loadWines = async (filters: Filters) => {
    state.wines = (await (await appService.getWines(filters)).json()).data;
}

const loadStyles = async (filters: Filters) => {
    state.styles = await (await appService.getStyles(filters)).json();
}

const loadSorts = async (filters: Filters) => {
    state.sorts = await (await appService.getSorts(filters)).json();
}

watch(
    () => state.filters,
    (filters) => {
        loadWines(filters);
        loadStyles(filters);
        loadSorts(filters);
    },
    {deep: true}
)

onMounted(() => {
    loadWines(state.filters);
    loadStyles(state.filters);
    loadSorts(state.filters);
});
</script>

<template>
    <div>
        <Header/>

        <div class="tw-grid tw-grid-cols-12">
            <div class="tw-col-span-3 tw-border-r tw-px-4 tw-pt-4">
                <div class="tw-flex tw-flex-col tw-gap-4">
                    <p class="tw-text-2xl">Filteri</p>
                    <div class="tw-rounded tw-bg-slate-100 tw-p-4">
                        <p>Sorta:</p>
                        <div class="tw-flex tw-flex-col tw-gap-2">
                            <label v-for="sort in state.sorts" class="tw-flex tw-gap-2">
                                <input type="checkbox"
                                       :value="sort"
                                       v-model="state.filters.sort"/>
                                <span>{{ sort }}</span>
                            </label>
                        </div>
                    </div>

                    <div class="tw-rounded tw-bg-slate-100 tw-p-4">
                        <p>Stil:</p>
                        <div class="tw-flex tw-flex-col tw-gap-2">
                            <label v-for="style in state.styles" class="tw-flex tw-gap-2">
                                <input type="checkbox"
                                       :value="style"
                                       v-model="state.filters.style"/>
                                <span>{{ style }}</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tw-col-span-6 tw-px-4 tw-pt-4">
                <h1 class="tw-text-3xl tw-text-red-600 tw-mb-4">Prodavnica</h1>
                <div class="tw-grid tw-grid-cols-3 tw-gap-4">
                    <div v-for="wine in state.wines">
                        <img :src="wine.images[0]?.image" alt="wine image"
                             class="tw-h-64 tw-w-full tw-rounded-tl tw-rounded-tr tw-object-cover tw-object-top">
                        <div class="tw-bg-white tw-rounded-bl tw-rounded-br tw-border tw-p-4">
                            <p class="tw-font-bold">{{ wine.name }}</p>
                            <p>{{ wine.sort }} / {{ wine.style }}</p>
                            <p>{{ wine.price }} RSD</p>
                            <button type="button"
                                    @click="addWine(wine.id)"
                                    class="tw-px-4 tw-py-2 tw-rounded tw-bg-red-600 tw-text-white tw-mt-4">
                                Dodaj u korpu +
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tw-col-span-3 tw-border-l tw-px-4 tw-pt-4">
                <p class="tw-text-2xl tw-mb-4">Korpa</p>

                <p v-if="!state.order" class="tw-text-slate-400">Korpa je prazna</p>

                <div class="tw-flex tw-flex-col tw-gap-4">
                    <div v-for="item in state.order?.items ?? []" class="tw-overflow-y-auto">
                        <div class="tw-flex tw-gap-4">
                            <img :src="item.wine.images[0]?.image" alt="wine image"
                                 class="tw-h-32 tw-w-32 tw-object-cover tw-object-top"/>
                            <div>
                                <p class="tw-font-bold">{{ item.wine.name }}</p>
                                <p>{{ item.wine.price }} RSD</p>
                                <div class="tw-flex tw-gap-2 tw-mt-2 tw-pt-2 tw-border-t">
                                    <p>{{ item.qty }} qty</p>
                                    <div>
                                        <button @click="addWine(item.wine.id)" class="tw-bg-red-200 tw-px-2 tw-py-1"
                                                type="button">+
                                        </button>
                                        <button @click="removeWine(item.wine.id)"
                                                class="tw-bg-slate-200 tw-px-2 tw-py-1"
                                                type="button">-
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
