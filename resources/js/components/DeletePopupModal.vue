<template>
  <div class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-800 bg-opacity-50">
    <div class="bg-white w-96 h-1/4 rounded-lg p-4  shadow-lg">
      <h2 class="text-2xl tracking-normal text-center font-mono my-6">Are you sure you want to delete this item?</h2>
      <div class="flex mt-6 justify-center gap-x-4">
        <button class="bg-red-500 text-white px-4 py-2 rounded mr-2" @click="onConfirm">Confirm</button>
        <button class="bg-gray-500 text-white px-4 py-2 rounded" @click="onCancel">Cancel</button>
      </div>
    </div>
  </div>
</template>

<script setup>

const emit  = defineEmits();

const onConfirm = () => emit('confirm');
const onCancel = () => emit('cancel');
</script>