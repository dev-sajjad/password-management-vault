<template>
  <div class="p-4 bg-white rounded-lg shadow">
    <h1 class="text-2xl font-semibold mb-5 text-center">Password Generator</h1>
    <label class="block mb-2 font-semibold text-xl">Password Options:</label>
    <div class=" flex justify-center gap-x-3">
      <label class="inline-flex items-center">
        <input
          type="checkbox"
          v-model="options.uppercase"
          class="mr-2 text-blue-500"
        />
        <span class="text-gray-600">Uppercase Letters (A-Z)</span>
      </label>
      <label class="inline-flex items-center">
        <input
          type="checkbox"
          v-model="options.lowercase"
          class="mr-2 text-blue-500"
        />
        <span class="text-gray-600">Lowercase Letters (a-z)</span>
      </label>
      <label class="inline-flex items-center">
        <input
          type="checkbox"
          v-model="options.specialChars"
          class="mr-2 text-blue-500"
        />
        <span class="text-gray-600">Special Characters (!@#$%^&*-_+=)</span>
      </label>
      <label class="inline-flex items-center">
        <input
          type="checkbox"
          v-model="options.numbers"
          class="mr-2 text-blue-500"
        />
        <span class="text-gray-600">Numbers (0-9)</span>
      </label>
    </div>
    <label class="block mt-4 mb-2 font-semibold text-xl">Password Length:</label>
    <input
      type="number"
      v-model.number="options.length"
      class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
    />
    <button
      @click="generatePassword"
      class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300"
    >
      Generate Password
    </button>
    <div v-if="password" class="mt-4">
      <label class="block mb-2 font-semibold text-xl">Generated Password:</label>
      <div class="p-2 border border-gray-300 rounded text-gray-800">
        {{ password }}
      </div>
      <button
        @click="copyToClipboard"
        class="mt-2 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 focus:outline-none focus:ring focus:ring-green-300"
      >
        Copy Password
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useUserStore } from "../store/UserStore";

const store = useUserStore();

const options = ref({
    uppercase: true,
    lowercase: true,
    specialChars: true,
    numbers: true,
    length: 12,
});

const password = ref("");

// Make a request to the backend API to generate the password
const generatePassword = async () => {
    try {
        const response = await axios.post('/api/password/generate', options.value, {
            headers: {
                'Authorization': `Bearer ${store.getToken}`
            }
        });
        password.value = await response.data.password;
    } catch (error) {
        console.error(error);
    }
};

const copyToClipboard = async () => {
    try {
        await navigator.clipboard.writeText(password.value);
        window.alert("Password copied to clipboard!");
    } catch (error) {
        console.error("Failed to copy password:", error);
        window.alert("Failed to copy password. Please try again.");
    }
};
</script>
