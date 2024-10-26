import { defineStore } from "pinia";

export const common_page_store = defineStore("common_page_store", {
    state: () => ({
        all_cart_data: [],
        all_categories_data: [],
        total_cart_price: 0
    }),
    getters: {
        doubleCount: (state) => state.count * 2,
    },
    actions: {
        get_all_cart_data: async function () {
            this.total_cart_price = 0
            let response = await axios.get("get-all-carts?get_all=true");
            this.all_cart_data = response.data.data;
            if (this.all_cart_data) {
                let itemTotal = this.all_cart_data.map(
                    (item) => item.quantity * item.product?.current_price
                );
                itemTotal.forEach((item2) => {
                    this.total_cart_price = this.total_cart_price + item2;
                });
            }
        },
        get_all_categories: async function () {
            let response = await axios.get("product-categories?get_all=true");
            this.all_categories_data = response.data.data;

        },

        remove_cart_item: async function (cartId) {
            let response = await axios.delete(`remove-cart-item/${cartId}`);
            return response;
        },

    },
});
