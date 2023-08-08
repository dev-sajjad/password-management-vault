<template>
     <!-- if there is no data  -->
    <tr v-if="allCardData.length === 0">
        <td class="text-center" colspan="4">
            <div class="text-gray-500 text-xl italic py-8">There is no card item!</div>
        </td>
    </tr>

    <CardRow v-for="item in allCardData" :item="item" :key="item.id" />
</template>

<script setup>
import { ref, onMounted, watchEffect } from "vue";
import { useVaultStore } from "../store/VaultStore"; 

import CardRow from '../components/CardRow.vue'

const vaultStore = useVaultStore();

const allCardData = ref([]);

watchEffect(() => {
    allCardData.value = vaultStore.getSpecificData('card'); 
})

// Fetch data from API when the component is mounted
onMounted(() => {
    allCardData.value = vaultStore.getSpecificData('card');
});

</script>
