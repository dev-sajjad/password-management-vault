<template>
   <div class="grid grid-cols-1 md:grid-cols-2 w-full gap-7" >
       <div >
            <label for="name" class="block mb-1 text-lg font-mono  text-gray-900 ">Name</label>
            <input v-model="cardData.name" type="text"  id="name" class=" bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-3 " placeholder="Name" required>
        </div>
       <div >
            <label for="name" class="block mb-1 text-lg font-mono  text-gray-900 ">Cardholder name</label>
            <input v-model="cardData.holder_name" type="text"  id="name" class=" bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-3 " placeholder="Cardholder name">
        </div>
        <div>
           <label for="name" class="block mb-1 text-lg font-mono  text-gray-900 ">Brand</label>
           <Select v-model="cardData.brand" class="block w-full p-3 border-gray-500 mb-1  focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 border rounded-lg">
                <option v-for="brand in brandOptions" :key="brand.value" :value="brand.value">
                    {{ brand.text }}
                </option>
           </Select >
        </div>
        <div>
             <label for="name" class="block mb-1 text-lg font-mono  text-gray-900 ">Number</label>
             <input v-model="cardData.number" type="number"  id="name" class=" bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-3 " placeholder="Number">
         </div>
         <div>
          <label for="name" class="block mb-1 text-lg font-mono  text-gray-900">Expiration month</label>
          <select v-model="cardData.exp_month" class="block w-full p-3 border-gray-500 mb-1  focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 border rounded-lg">
            <option v-for="month in monthOptions" :key="month.text" :value="month.value">
                {{ month.text }}
            </option>
          </select>
         </div>
        <div >
             <label for="name" class="block mb-1 text-lg font-mono  text-gray-900 ">Expiration year</label>
             <input v-model="cardData.exp_year" type="number"  id="name" class=" bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-3 " placeholder="e.g. 2023">
         </div>
         <div class="col-span-2">
           <label for="name" class="block mb-1 text-lg font-mono  text-gray-900 ">Notes</label>
               <textarea v-model="cardData.notes" id="name" rows="8" class=" bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-3 " placeholder="Notes"></textarea>
         </div>
    </div>
</template>

<script setup>
import { onUpdated, ref } from 'vue';

const brandOptions = ref([
    {text: '--Select--', value: ''},
    { text: 'Visa', value: 'Visa' },
    { text: 'Debit', value: 'Debit' },
    { text: 'Credit', value: 'Credit' },
    { text: 'Discover', value: 'Discover' },
    { text: 'Mastercard', value: 'Mastercard' },
    { text: 'American Express', value: 'American Express'}
])

const monthOptions = ref([
    { text: '--Select--', value: '' },
    { text: 'January', value: 'January' },
    { text: 'February', value: 'February' },
    { text: 'March', value: 'March' },
    { text: 'April', value: 'April' },
    { text: 'May', value: 'May' },
    { text: 'June', value: 'June' },
    { text: 'July', value: 'July' },
    { text: 'August', value: 'August' },
    { text: 'September', value: 'September' },
    { text: 'October', value: 'October' },
    { text: 'November', value: 'November' },
    { text: 'December', value: 'December' },
])

const cardData = ref({
    name: '',
    holder_name: '',
    brand: '',
    number: '',
    exp_month: '',
    exp_year: '',
    notes: '',
})

const emit = defineEmits(['formData']);

onUpdated(() => {
    emit('formData', {type: 'card', data: cardData.value});
})
  
</script>