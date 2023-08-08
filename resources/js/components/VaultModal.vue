<template>
  <div class="fixed inset-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50">
    <div class="w-3/5 relative  bg-slate-100 rounded-lg p-4">
    <form @submit.prevent="saveData">
      <!-- Modal Header -->
      <div class="flex justify-between items-center mb-4 p-2">
        <div class="text-2xl font-thin text-gray-800">New Item</div>
        <button @click="closeModal" class="text-gray-500 hover:text-gray-600">
          <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
        <hr class="w-full border border-gray-300">
      </div>
      <!-- Modal body -->
      <div class=" overflow-y-auto min-h-[300px] max-h-[550px] h-auto my-4 p-2" >
        <label class="block mb-2 text-lg text-gray-800">What type of item is this?</label>
        <select v-model="selectedType" class="block w-1/2 p-3 border-gray-500 mb-4  focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500 border rounded-lg">
          <option value="login">Login</option>
          <option value="card">Card</option>
          <option value="identity">Identity</option>
        </select>
        <!-- Dynamically load form based on selected type -->
        <template v-if="selectedType === 'login'">
          <VaultLoginForm @form-data="getFormData"/>
        </template>
        <template v-else-if="selectedType === 'card'">
          <VaultCardForm @form-data="getFormData" />
        </template>
        <template v-else-if="selectedType === 'identity'">
          <VaultIdentityForm @form-data="getFormData" />
        </template>
      </div>
      <!-- Modal footer -->
      <div>
        <hr class="w-full mt-4 border border-gray-300">
      </div>
      <div class="flex justify-start mt-2 p-2">
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mr-4">
          Save
        </button>
        <button @click="closeModal" class="bg-gray-300  hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
          Cancel
        </button>
      </div>
    </form>

    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

import VaultLoginForm from '../components/VaultLoginForm.vue';
import VaultCardForm from '../components/VaultCardForm.vue';
import VaultIdentityForm from '../components/VaultIdentityForm.vue';

 const selectedType = ref('login')
const formData = ref({});


  const emit = defineEmits(['close', 'save'])

   const closeModal = () => {
      formData.value = {};
      // Emitting 'close' event to the parent component
      // to trigger closing the modal
      emit('close');
    };
    
    const getFormData = (data) => {
      formData.value = data;
    };
    
    const saveData = () => {
      // Emitting 'save' event with the form data
      emit('save', formData.value);
    };

</script>

