
import axios from "axios";
import { defineStore } from "pinia";

export const auth_store = defineStore("auth_store", {
    state: () => ({
        is_auth: 0,
        auth_info: {},
        role: {},
    }),
    getters: {
        get_auth_info: function () {
            return this.auth_info
        },
    },
    actions: {

        set_is_auth: function (status) {
            this.is_auth = status;
        },
        log_out: async function () {
            var data = await window.s_confirm("Are you sure want to logout?")
            if (data) {
                axios.post(window.location.origin + "/logout", {});
                localStorage.removeItem("token");
                return (location.href = "/login");
            }
        },
        check_is_auth: async function () {
            try {
                let response = await axios.get("/check_user");
                console.log("data", response);

                if (response.data?.status === 'success') {
                    this.auth_info = response.data?.data;
                    this.is_auth = 1;
                    this.role = response.data.role;
                }
                return response;
            } catch (error) {
                console.error("Error:", error);
                if (error.response) {
                    console.log("Error response data:", error.response.data);
                } else if (error.request) {
                    console.log("Error request:", error.request);
                } else {
                    console.log("Error message:", error.message);
                }

                return error;
            }
        },
        auth_check: async function () {
            let response = await axios.get("/auth_check");
            if (response.status == 'success') {
                this.auth_info = response.data;
                this.is_auth = 1;
                this.role = response.data.role;
            }
        },


    },
});
