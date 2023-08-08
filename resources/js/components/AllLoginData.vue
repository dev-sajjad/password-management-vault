<template>
    <!-- if there is no data  -->
    <tr v-if="allLoginsData.length === 0">
        <td class="text-center" colspan="4">
            <div class="text-gray-500 text-xl italic py-8">There is no login item!</div>
        </td>
    </tr>

    <LoginRow v-for="item in allLoginsData" :item="item" :key="item.id" />
</template>

<script setup>
import { ref, onMounted, watchEffect } from "vue";
import { useVaultStore } from "../store/VaultStore";

import LoginRow from "../components/LoginRow.vue";

const vaultStore = useVaultStore();
const allLoginsData = ref([]);

watchEffect(() => {
    allLoginsData.value = vaultStore.getSpecificData("login");
});

// Fetch data from API when the component is mounted
onMounted(() => {
    allLoginsData.value = vaultStore.getSpecificData("login");
});
</script>
