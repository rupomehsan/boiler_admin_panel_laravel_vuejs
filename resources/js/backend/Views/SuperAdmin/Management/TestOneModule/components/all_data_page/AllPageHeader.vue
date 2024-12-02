<template lang="">
    <h5 class="text-capitalize mb-0"> {{ setup.all_page_title }} </h5>
    <div>
        <search/>
    </div>
    <div>
        <button @click.prevent="set_show_filter_canvas(true)"
            class="btn btn-outline-success btn-sm">
            <i class="fa fa-gear"></i>
        </button>
    </div>
</template>
<script>
import Search from './Search.vue';
import setup from '../../setup';
import { mapActions } from 'pinia';
import { store } from '../../store';
export default {
    components: { Search },
    data: () => ({
        setup,
    }),
    methods: {
        ...mapActions(store, ['set_show_filter_canvas'])
    }
}
</script>
