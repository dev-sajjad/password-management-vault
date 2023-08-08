<template>
    <div class="max-w-6xl mx-auto">
        <div class="flex flex-row gap-x-3 my-6">
            <div
                class="flex-none w-72 h-[400px] border-2 border-gray-300 rounded-md"
            >
                <h3 class="block text-left text-2xl pl-3 py-2 bg-gray-200 font-semibold border-b-2 border-gray-300">Filters</h3>
                <div class="p-2 mt-3">
                    <input
                        v-model="searchText"
                        @keyup.enter="searchVault"
                        ref="isSearch"
                        type="search"
                        class="w-full p-3 text-gray-500 border border-gray-500 rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                        placeholder="Search vault..."
                    />
                </div>
                <VaultSideNavbar />
            </div>
            <div class="flex-auto h-4/5 rounded-lg p-5">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl text-gray-700">All Vaults</h2>
                    <button
                        @click="openModal"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
                    >
                        Add New
                    </button>
                    <VaultModal
                        v-if="isModalOpen"
                        @close="closeModal"
                        @save="saveFormData"
                    />
                </div>
                <div class="overflow-y-auto">
                    <table class="w-full text-lg display-table table-fixed text-gray-500">
                        <thead class="text-md text-gray-500 uppercase">
                            <tr class="border-b-2 border-gray-300">
                                <th class="p-5 w-[20%]">
                                    <span
                                        class="flex justify-start items-center">
                                        <input
                                            class="w-5 h-5 text-blue-600 mr-2.5 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                            type="checkbox"
                                        />
                                        <h3>All</h3>
                                    </span>
                                </th>
                                <th class="w-[40%] text-left">Name</th>
                                <th class="w-[30%] text-left">Owner</th>
                                <th class="w-[10%]">
                                    <Icon icon="ph:dots-three-vertical-bold" width="26" />
                                </th>
                            </tr>
                        </thead>
                        <tbody v-if="searchText === ''">

                             <template v-if="addedNew.type === 'login'">
                                    <LoginRow :item="addedNew.data" :key="addedNew.data.id" />
                                </template>
                                <template v-else-if="addedNew.type === 'card'">
                                    <CardRow :item="addedNew.data" :key="addedNew.data.id" />
                                </template>
                                <template v-else-if="addedNew.type === 'identity'">
                                    <IdentityRow :item="addedNew.data" :key="addedNew.data.id" />
                                </template>

                            <RouterView></RouterView>

                        </tbody>
                        <tbody v-else>
                             <!-- if there is no data  -->
                            <tr v-if="allData.length === 0">
                                <td class="text-center" colspan="4">
                                    <div class="text-gray-500 text-xl italic py-8">There is no item found in the vault!</div>
                                </td>
                            </tr>
                            <!-- Render filtered rows when search text is not empty -->
                            <template v-for="item in allData">
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      
    </div>
</template>

<script setup>
import { onMounted, ref, watchEffect } from "vue";
import { storeToRefs } from "pinia";
import { Icon } from "@iconify/vue";
import { RouterView } from "vue-router";
import { useVaultStore } from "../store/VaultStore";
import { useUserStore } from "../store/UserStore";

import VaultSideNavbar from "../components/VaultSideNavbar.vue";
import VaultModal from "../components/VaultModal.vue";
import LoginRow from "../components/LoginRow.vue";
import CardRow from "../components/CardRow.vue";
import IdentityRow from "../components/IdentityRow.vue";

const store = useUserStore();
const vaultStore = useVaultStore();
const { isLoading, addedNew, allData } =storeToRefs(vaultStore);

// Search input text
const searchText = ref("");
const isSearch = ref(null);

const isModalOpen = ref(false);

const openModal = () => {
    isModalOpen.value = true;
};

const closeModal = () => {
    isModalOpen.value = false;
};


const saveFormData = (formData) => {
    vaultStore.addNewData(formData);
   
    closeModal(); 
};

// Fetch data from the backend based on search text and pagination
const fetchSearchData = async () => {
//   isLoading.value = true;
  try {
    const response = await axios.get("/api/vault/search", {
      params: {
        search: searchText.value,
      },
      headers: {
        Authorization: `Bearer ${store.getToken}`,
      },
    });
    const searchData = [
      ...response.data.logins,
      ...response.data.cards,
      ...response.data.identities,
    ];
    allData.value = searchData;
    // totalPageCount.value = Math.ceil(searchData.length / perPage);
    // isLoading.value = false;
  } catch (error) {
    console.log(error.message);
    // isLoading.value = false;
  }
};
const searchVault = () => {
    if (searchText.value === '') {
        return;
    } {
        fetchSearchData();
    }
}


onMounted(() => {
    isSearch.value.focus();
    // vaultStore.fetchAllData();
});
</script>

