<template>
     <!-- if there is no data  -->
    <tr v-if="allIdentityData.length === 0">
        <td class="text-center" colspan="4">
            <div class="text-gray-500 text-xl italic py-8">There is no identity item!</div>
        </td>
    </tr>

        <IdentityRow v-for="item in allIdentityData" :item="item" :key="item.id" />
</template>

<script setup>
import { ref, onMounted, watchEffect } from "vue";
import { useVaultStore } from "../store/VaultStore";

import IdentityRow from '../components/IdentityRow.vue'

const vaultStore = useVaultStore();

const allIdentityData = ref([]);

watchEffect(() => {
     allIdentityData.value = vaultStore.getSpecificData('identity');
})

// Fetch data from API when the component is mounted
onMounted(() => {
    allIdentityData.value = vaultStore.getSpecificData('identity');
});
</script>
