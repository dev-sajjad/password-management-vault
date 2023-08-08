<template>
   <nav class="w-full bg-[#175DDC]">
    <div class="max-w-6xl mx-auto flex justify-between  items-center h-[70px] shadow-sm">
      <div class="flex justify-start items-center">
        
        <RouterLink :to="{path: '/'}">
          <Icon class="mr-5" width="30" icon="fontisto:shield" color="white" />
        </RouterLink> 
  
        <ul class="flex justify-end items-center">
          <li>
            <RouterLink class="text-gray-300 text-lg  px-2 hover:text-white" :to="{path: '/'}">Vaults</RouterLink> 
          </li>
         
          <li>
            <RouterLink class="text-gray-300 text-lg ml-4  px-2 hover:text-white" :to="{path: '/tools'}">Tools</RouterLink>
          </li>
        </ul>
      </div>

      <div>
        <ul class="flex justify-center items-center ">
          <li v-if="store.token == 0">
              <RouterLink class="text-gray-300 text-lg  px-2 hover:text-white" :to="{name: 'Login'}">Login</RouterLink> 
            </li>
           <li v-if="store.token != 0">
            <div class="flex justify-center items-center">
              <Icon class=" mr-2" icon="mingcute:user-4-fill" color="white" width="45"/>
              <button @click="logout" class="py-1.5 px-2  rounded outline-none  text-white text-md hover:bg-red-600 bg-red-500 hover:text-white">
                Logout
              </button>
            </div>
          </li>
        </ul>
      </div>

    </div>
   </nav>
</template>

<script setup>
import { RouterLink, useRouter  } from 'vue-router';
import { useUserStore } from '@/store/UserStore';
import { useToast } from 'vue-toastification';
import { Icon } from '@iconify/vue';

const store = useUserStore();
const router = useRouter();
const toast = useToast();

const logout = () => {
    store.removeToken()
    toast.warning('User logged out!')

    setTimeout(() => {
        router.push({name: 'Login'});
    }, 2000)
}
</script>

<style scoped>
a.active {
    color: #fff;
}
</style>