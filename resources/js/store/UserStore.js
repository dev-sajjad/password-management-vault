import { defineStore } from "pinia";

export  const useUserStore = defineStore('userStore', {
    state: () => {
        return {
        token: localStorage.getItem('token') || 0,
    }
    },

    getters: {
        getToken: state => state.token,
    },


    actions: {
        setUser(name) {
            localStorage.setItem('user', name);
        },
        removeUser() {
            localStorage.removeItem('user');  
        },

        setToken(token) {
            this.token = token,
            localStorage.setItem('token', token)
        },

        removeToken(){
            this.token = 0
            localStorage.removeItem('token')
        }
    }

})