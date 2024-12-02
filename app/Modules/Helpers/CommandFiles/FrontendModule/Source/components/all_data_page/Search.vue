<template lang="">
    <input
        @keyup="(e) => set_search_key(e)"
        class="form-control  ml-4 all_page_search py-1"/>
</template>
<script>
import { mapActions, mapWritableState } from 'pinia';
import { store } from '../../store';
import debounce from '../../helpers/debounce';
import get_all from '../../store/async_actions/all'
export default {
    methods: {
        get_all,
        set_search_key: debounce(async function (event) {
            let value = event.target.value;
            this.search_key = value;

            this.only_latest_data = true;
            await this.get_all();
            this.only_latest_data = false;
        }, 500),
    },
    computed: {
        ...mapWritableState(store, [
            'search_key',
            'only_latest_data',
        ])
    }
}
</script>
<style scoped>
.all_page_search {
    width: 300px;
    height: 35px;
}
</style>
