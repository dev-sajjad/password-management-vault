<template>
    <template v-for="item in allData">
        <!-- Conditionally render the rows based on item.type -->
        <template v-if="item.type === 'login'">
            <LoginRow :item="item" :key="item.id" />
        </template>
        <template v-else-if="item.type === 'card'">
            <CardRow :item="item" :key="item.id" />
        </template>
        <template v-else-if="item.type === 'identity'">
            <IdentityRow :item="item" :key="item.id" />
        </template>
    </template>
</template>

<script setup>
import {ref, onMounted, watchEffect } from "vue";
import { useVaultStore } from "../store/VaultStore";

import LoginRow from "../components/LoginRow.vue";
import IdentityRow from "../components/IdentityRow.vue";
import CardRow from "../components/CardRow.vue";

const vaultStore = useVaultStore();
const allData = ref([])

watchEffect(() => {
    allData.value = vaultStore.allData;
})

// Fetch data from API when the component is mounted
onMounted(() => {
    vaultStore.fetchAllData();
});
</script>
