<script lang="ts" setup>

</script>

<template>
    <header>
        <div class="tw-px-4 tw-py-2 tw-border-b tw-bg-white">
            <div>
                <nav>
                    <ul class="tw-list-none tw-flex tw-items-center tw-gap-4">
                        <li>
                            <RouterLink class="hover:tw-text-red-600" :to="{name: 'home'}">Home</RouterLink>
                        </li>
                        <li>
                            <RouterLink class="hover:tw-text-red-600" :to="{name: 'store'}">Store</RouterLink>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
</template>
