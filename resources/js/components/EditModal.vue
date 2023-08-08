<template>
    <div
        class="fixed inset-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50"
    >
        <div class="w-3/5 relative bg-slate-100 rounded-lg p-4">
            <form @submit.prevent="updateData">
                <!-- Modal Header -->
                <div class="flex justify-between items-center mb-4 p-2">
                    <div class="text-2xl font-thin text-gray-800">
                        Edit Item
                    </div>
                    <button
                        @click="closeModal"
                        class="text-gray-500 hover:text-gray-600"
                    >
                        <svg
                            class="w-7 h-7"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            ></path>
                        </svg>
                    </button>
                </div>
                <div>
                    <hr class="w-full border border-gray-300" />
                </div>
                <!-- Modal body -->
                <div
                    class="overflow-y-auto min-h-[300px] max-h-[550px] h-auto my-4 p-2"
                >
                    <!-- Conditionally render the form based on the data type -->
                    <template v-if="formData.type === 'login'">
                        <!-- Render the login form and bind the formData with v-model -->
                        <EditLoginForm v-model="formData" />
                    </template>
                    <template v-else-if="formData.type === 'card'">
                        <!-- Render the card form and bind the formData with v-model -->
                        <EditCardForm v-model="formData"  />
                    </template>
                    <template v-else-if="formData.type === 'identity'">
                        <!-- Render the identity form and bind the formData with v-model -->
                        <EditIdentityForm v-model="formData" />
                    </template>
                </div>
                <!-- Modal footer -->
                <div>
                    <hr class="w-full mt-4 border border-gray-300" />
                </div>
                <div class="flex justify-start mt-2 p-2">
                    <button
                        type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mr-4"
                    >
                        Save
                    </button>
                    <button
                        @click="closeModal"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded"
                    >
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import axios from "axios";
import { useToast } from "vue-toastification";
import { useUserStore } from "../store/UserStore";

import EditLoginForm from "../components/EditLoginForm.vue";
import EditCardForm from "../components/EditCardForm.vue";
import EditIdentityForm from "../components/EditIdentityForm.vue";

const toast = useToast();
const store = useUserStore();

const formData = ref({});
const { itemData } = defineProps(["itemData"]);

onMounted(() => {
    formData.value = itemData;
});

const emit = defineEmits(["close"]);

const closeModal = () => {
    formData.value = {};
    // Emitting 'close' event to the parent component
    // to trigger closing the modal
    emit("close");
};

const updateData = () => {
    axios
        .post(
            `/api/vault/${formData.value.type}/update/${formData.value.id}`,
            formData.value,
            {
                headers: {
                    Authorization: `Bearer ${store.getToken}`,
                },
            }
        )
        .then((res) => toast.success(res.data.message))
        .catch((err) => toast.error(err.message));

    setTimeout(() => {
        closeModal();
    }, 2000);
};
</script>
