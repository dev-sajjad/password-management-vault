import { defineStore } from "pinia";
import axios from "axios";
import { useToast } from "vue-toastification";

export const useVaultStore = defineStore("vault", {
    state: () => ({
        token: localStorage.getItem("token") || 0,
        addedNew: {},
        allData: [],
        isLoading: false,
    }),

    actions: {
        addNewData(data) {
            this.allData.push(data.data);
            this.createOrUpdateItem(data.type, data.data);
        },


        getSpecificData(type) {
            return this.allData.filter((item) => item.type === type);
        },


       async fetchAllData() {
            this.isLoading = true;
            try {
                const response = await axios.get("/api/vault/all", {
                    headers: {
                        Authorization: `Bearer ${this.token}`,
                    },
                });
                const formattedData = [
                    ...response.data.logins,
                    ...response.data.cards,
                    ...response.data.identities,
                ];
                this.allData = formattedData;
                this.isLoading = false;
            } catch (error) {
                console.error(error.message);
                this.isLoading = false;
            }
        },
       
       
        async createOrUpdateItem(type, data) {
            try {
                const endpoint = `api/vault/${type}/${
                    data.id ? "update" : "create"
                }`;
                const response = await axios.post(endpoint, data, {
                    headers: {
                        Authorization: `Bearer ${this.token}`,
                    },
                });

                // Update allData with the new data after successful response
                const index = this.allData.findIndex(
                    (item) => item.id === data.id
                );
                if (index !== -1) {
                    this.allData[index] = { ...data };
                } else {
                    this.allData.push({ ...data });
                }

                this.toastSuccess(response.data.message);
            } catch (error) {
                console.error(error.message);
                this.toastError("Failed to save the item.");
            }

            this.fetchAllData();
        },

        async deleteItem(item) {
            try {
                const index = this.allData.findIndex(
                    (data) => data.id === item.id
                );
                if (index !== -1) {
                    this.allData.splice(index, 1);
                    const endpoint = `api/vault/${item.type}/delete/${item.id}`;
                    const response = await axios.delete(endpoint, {
                        headers: {
                            Authorization: `Bearer ${this.token}`,
                        },
                    });
                    this.toastSuccess(response.data.message);
                }
            } catch (error) {
                console.error(error.message);
                this.toastError("Failed to delete the item.");
            }
        },

        toastSuccess(message) {
            const toast = useToast();
            toast.success(message);
        },

        toastError(message) {
            const toast = useToast();
            toast.error(message);
        },
    },
});
