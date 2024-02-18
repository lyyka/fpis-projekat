<script lang="ts" setup>
import Header from "@/components/Header.vue";
</script>

<template>
    <div>
        <Header/>
        <div class="tw-bg-[url('../assets/images/img_1.png')] tw-h-screen tw-bg-no-repeat tw-bg-cover tw-relative">
            <div
                class="tw-bg-white/60 tw-rounded tw-text-dark tw-p-5 tw-text-center
                tw-absolute tw-top-1/2 tw-left-1/2 tw-transform -tw-translate-x-1/2 -tw-translate-y-1/2">
                <h1 class="tw-text-3xl tw-mb-4">Podrum vina</h1>
                <p>
                    Dobrodošli u našu ekskluzivnu prodavnicu vina, gde se susreću istinski ljubitelji vrhunskih sorti.
                    Naša pažljivo odabrana kolekcija vina pruža nezaboravna degustacijska iskustva za sva čula. Uz
                    stručni tim spremni smo vam pružiti personalizovane preporuke. Prepustite se čaroliji sveta vina u
                    našoj prodavnici.
                </p>
                <RouterLink :to="{name: 'store'}" class="tw-text-white tw-p-4 tw-bg-red-600 tw-inline-flex tw-mt-4">Vidi
                    prodavnicu
                </RouterLink>
            </div>
        </div>
    </div>
</template>
