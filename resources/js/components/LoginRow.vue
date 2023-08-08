<template>
    <tr
        @click="handleClick"
        class="border-b cursor-pointer border-gray-300 mt-4">
        <td class="p-5">
            <input
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                type="checkbox"
            />
        </td>
        <td>
            <span class="flex justify-start items-center gap-x-4">
                <Icon icon="ph:globe-light" width="25" />
                <h3>{{ item?.name }}</h3>
            </span>
        </td>
        <td>me</td>
        <td
            @click.stop="openPopupModal"
            class="p-2 hover:border text-center hover:bg-red-600 hover:text-white cursor-pointer bg-transparent">
            <span class="flex justify-center items-center">
                <Icon width="28" icon="fluent-mdl2:delete" />
            </span>
        </td>
    </tr>
    <EditModal
        v-if="isModalOpen"
        @close="closeModal"
        :item-data="item"
        :key="item.id"
    />

    <DeletePopupModal
        v-if="isDeleteModalOpen"
        @confirm="deleteItem"
        @cancel="closePopupModal"
    />
</template>

<script setup>
import { Icon } from "@iconify/vue";
import { ref } from "vue";

import EditModal from "./EditModal.vue";
import DeletePopupModal from "./DeletePopupModal.vue";
import { useVaultStore } from "../store/VaultStore";

const vaultStore = useVaultStore();

const isModalOpen = ref(false);
const isDeleteModalOpen = ref(false);

const { item } = defineProps(["item"]);

const handleClick = () => {
    isModalOpen.value = true;
};

const closeModal = () => {
    isModalOpen.value = false;
};

const openPopupModal = () => {
    isDeleteModalOpen.value = true;
};

const closePopupModal = () => {
    isDeleteModalOpen.value = false;
};


const deleteItem = () => {
    vaultStore.deleteItem(item);

    setTimeout(() => {
        closePopupModal();
    }, 2000);
};
</script>
