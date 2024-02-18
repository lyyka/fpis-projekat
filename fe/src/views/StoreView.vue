<script lang="ts" setup>
import Header from "@/components/Header.vue";
import {onMounted, reactive} from "vue";
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

onMounted(async () => {
    state.wines = (await (await appService.getWines(state.filters)).json()).data;
    state.styles = await (await appService.getStyles()).json();
    state.sorts = await (await appService.getSorts()).json();
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
                                       :value="sort"/>
                                <span v-text="sort"></span>
                            </label>
                        </div>
                    </div>

                    <div class="tw-rounded tw-bg-slate-100 tw-p-4">
                        <p>Stil:</p>
                        <div class="tw-flex tw-flex-col tw-gap-2">
                            <label v-for="style in state.styles" class="tw-flex tw-gap-2">
                                <input type="checkbox"
                                       :value="style"/>
                                <span v-text="style"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tw-col-span-6 tw-px-4 tw-pt-4">
                <h1 class="tw-text-3xl tw-text-red-600">Prodavnica</h1>
                <div class="tw-grid tw-grid-cols-3 tw-gap-4">
                    <div v-for="wine in state.wines">
                        <img :src="wine.images[0]?.image" alt="wine image"
                             class="tw-h-64 tw-rounded-tl tw-rounded-tr tw-object-scale-down">
                        <div class="tw-bg-white tw-rounded-bl tw-rounded-br tw-border tw-p-4">
                            <p>{{ wine.name }}</p>
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
                <p class="tw-text-2xl">Korpa</p>

                <p v-if="!state.order" class="tw-text-slate-400">Korpa je prazna</p>

                <div class="tw-flex tw-flex-col tw-gap-4">
                    <div v-for="item in state.order?.items ?? []">
                        <div class="tw-flex tw-gap-2">
                            <img :src="item.wine.images[0]?.image" alt="wine image" class="tw-h-32"/>
                            <div>
                                <p>{{ item.wine.name }}</p>
                                <p>{{ item.wine.price }} RSD</p>
                                <hr/>
                                <div class="tw-flex tw-gap-2">
                                    <p>{{ item.qty }} qty</p>
                                    <button @click="addWine(item.wine.id)" class="tw-bg-red-200 tw-p-1 tw-rounded"
                                            type="button">+
                                    </button>
                                    <button @click="removeWine(item.wine.id)" class="tw-bg-slate-200 tw-p-1 tw-rounded"
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
</template>
