import { defineStore } from "pinia"

export const auth_store = defineStore('auth_store', {
    state: () => ({ count: 0, name: 'Eduardo' }),
    getters: {
        doubleCount: (state) => state.count * 2,
    },
    actions: {
        logout: function() {
            this.count++
        },
    },
})
