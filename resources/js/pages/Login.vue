<template>
    <div class="w-full -mt-10 h-screen flex items-center justify-center">
        <div class="w-2/5  shadow-md p-5 bg-gray-200 border-2 rounded-xl">

            <h2 class="text-center py-3 font-bold text-4xl">Login</h2>

            <form @submit.prevent="login">
                <div class="w-full drop-shadow p-4">
                    <label class="block text-grey-darker text-xl font-semibold mb-2" for="email">Email:</label>
                    <input class="appearance-none border rounded-md w-full py-3 px-4 text-xl text-grey-darker"  v-model="form.email"  id="email" type="email" placeholder="Your email" required>
                </div>
                <div class="w-full drop-shadow p-4">
                    <label class="block text-grey-darker text-xl font-semibold mb-2" for="password"> Password:</label>
                    <input class="appearance-none border rounded-md w-full py-3 px-4 text-xl text-grey-darker" v-model="form.password" type="password" placeholder="Your password"  required>
                </div>
                <div class="text-center my-3">
                    <button class="py-2 px-3 text-center border-2 border-gray-800 bg-gray-800 rounded-xl outline-none  text-white text-lg hover:bg-transparent hover:text-gray-800" type="submit">Submit</button>
                </div>
            </form>
            
            <hr class="w-full border rounded-xl border-gray-300 my-4">

            <div class="text-center">
                <h5 class="text-gray-800 text-lg mb-2 font-thin">Don't have an account?</h5>
                <RouterLink :to="{name: 'Register'}">
                    <button type="submit" class="py-2 px-3 border-2 border-green-600 rounded-xl outline-none bg-green-600  text-white text-lg hover:bg-transparent hover:text-green-600">
                        Register
                    </button>
                </RouterLink>
            </div>
        </div>
    </div>
</template>


<script setup>
import { reactive } from 'vue';
import { RouterLink, useRouter } from 'vue-router';
import { useToast } from "vue-toastification";
import { useUserStore } from '../store/UserStore';

const toast = useToast();
const router = useRouter();
const store = useUserStore();

const form = reactive({
    email: '',
    password: '',
})


const login = async () => {
    await axios.post('/api/login', form)
        .then((res) => {
            if (res.status === 200)  {
                // store user token 
                store.setToken(res.data.data.api_token)

                toast.success(res.data.message);

                setTimeout(() => {
                    router.push('/')
                }, 2000);
        }  
        })
        .catch(() => toast.error('Something went wrong!'))
}

</script>

