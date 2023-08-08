<template>
    <div>
      <Header />

      <RouterView></RouterView>
    </div>
</template>

<script setup>
import { RouterView } from 'vue-router';
import  Header from '../pages/Header.vue';

</script>
