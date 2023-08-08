<template>
  <div class="grid grid-cols-1 md:grid-cols-2 w-full gap-7" >
       <div>
            <label for="name" class="block mb-1 text-lg font-mono  text-gray-900 ">Name</label>
            <input v-model="identityData.name" type="text"  id="name" class=" bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-3 " placeholder="Name" required>
        </div>
       <div>
            <label for="name" class="block mb-1 text-lg font-mono  text-gray-900 ">Username</label>
            <input  v-model="identityData.username" type="text"  id="name" class=" bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-3 " placeholder="Username">
        </div>
       <div>
            <label for="name" class="block mb-1 text-lg font-mono  text-gray-900 ">First name</label>
            <input v-model="identityData.first_name" type="text"  id="name" class=" bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-3 " placeholder="First name">
        </div>
       <div>
            <label for="name" class="block mb-1 text-lg font-mono  text-gray-900 ">Last name</label>
            <input v-model="identityData.last_name" type="text"  id="name" class=" bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-3 " placeholder="Last name">
        </div>
        <div>
            <label for="name" class="block mb-1 text-lg font-mono  text-gray-900 ">Passport number</label>
            <input v-model="identityData.passport_number" type="number"  id="name" class=" bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-3 " placeholder="Passport number">
        </div>
        <div>
            <label for="name" class="block mb-1 text-lg font-mono  text-gray-900 ">License number</label>
            <input v-model="identityData.license_number" type="number"  id="name" class=" bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-3 " placeholder="License number">
        </div>
        <div class="grid grid-cols-3 gap-x-7 col-span-2">
            <div>
                 <label for="name" class=" mb-1 text-lg font-mono  text-gray-900 ">Company</label>
                 <input v-model="identityData.company" type="text"  id="name" class=" bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500  w-full p-3 " placeholder="Company">
            </div>
           <div>
                <label for="name" class=" mb-1 text-lg font-mono  text-gray-900 ">Email</label>
                <input v-model="identityData.email" type="email"  id="name" class=" bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 w-full p-3 " placeholder="Email">
            </div>
           <div>
                <label for="name" class=" mb-1 text-lg font-mono  text-gray-900 ">Phone</label>
                <input v-model="identityData.phone" type="number"  id="name" class=" bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 w-full p-3 " placeholder="Phone">
            </div>
        </div>
        <div class="grid grid-cols-3 gap-x-7 col-span-2">
            <div>
                 <label for="name" class=" mb-1 text-lg font-mono  text-gray-900 ">Address</label>
                 <input v-model="identityData.address" type="text"  id="name" class=" bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500  w-full p-3 " placeholder="Address">
            </div>
           <div>
                <label for="name" class=" mb-1 text-lg font-mono  text-gray-900 ">City</label>
                <input v-model="identityData.city" type="text"  id="name" class=" bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 w-full p-3 " placeholder="City">
            </div>
           <div>
                <label for="name" class=" mb-1 text-lg font-mono  text-gray-900 ">Country</label>
                <input v-model="identityData.country" type="text"  id="name" class=" bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 w-full p-3 " placeholder="Country">
            </div>
        </div>
         <div class="col-span-2" >
            <label for="name" class="block mb-1 text-lg font-mono  text-gray-900 ">Notes</label>
            <textarea v-model="identityData.notes" id="name" rows="8" class=" bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-3 " placeholder="Notes"></textarea>
        </div>
    </div>
</template>

<script setup>
import { watchEffect, ref } from 'vue';

const props = defineProps(['modelValue']);
const formData = ref(props.modelValue);

const emit = defineEmits(['update:modelValue'])

// Emit the updated formData when form fields change
watchEffect(() => {
  emit('update:modelValue', formData.value);
});

</script>