<template>
    <div class="grid sm:grid-cols-1 md:grid-cols-2 w-full gap-7" >
        <div >
            <label for="name" class="block mb-1 text-lg font-mono  text-gray-900 ">Name</label>
            <input v-model="loginData.name" type="text"  id="name" class=" bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-3 " placeholder="Name" required>
        </div>
        <div >
            <label for="name" class="block mb-1 text-lg font-mono  text-gray-900 ">Username</label>
            <input v-model="loginData.username" type="text"  id="name" class=" bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-3 " placeholder="Username">
        </div>
        <div >
            <label for="name" class="block mb-1 text-lg font-mono  text-gray-900 ">Password</label>
            <input v-model="loginData.password" type="text"  id="name" class=" bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-3 " placeholder="Password">
        </div>
        <div >
            <label for="name" class="block mb-1 text-lg font-mono  text-gray-900 ">URL</label>
            <input v-model="loginData.url" type="text"  id="name" class=" bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-3 " placeholder="e.g. https://google.com">
        </div>
        <div class="col-span-2" >
            <label for="name" class="block mb-1 text-lg font-mono  text-gray-900 ">Notes</label>
            <textarea v-model="loginData.notes" id="name" rows="8" class=" bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-3 " placeholder="Notes"></textarea>
        </div>
    </div>
</template>

<script setup>
import { ref, onUpdated} from "vue";

const loginData = ref({
    name: '',
    username: '',
    password: '',
    url: '',
    notes: '',
})

const emit = defineEmits(['formData'])

onUpdated(() => {
    emit("formData", {type: 'login', data: loginData.value});
})

</script>

