<template lang="">
   <div class="">
            <a href="" @click.prevent="change_status(`trased`)"
                class="btn action_btn btn-sm btn-danger d-flex align-items-center">
                <i class="fa fa-trash mr-2"></i> Trased
                ({{ trased_data_count }})
            </a>
        </div>
</template>
<script>
import { mapActions, mapState } from 'pinia';
import { store } from '../../../store';

export default {
    methods: {
        ...mapActions(store, [
            'set_status',
            'get_all',
            'set_only_latest_data',
            'set_page',
        ]),
        change_status: function (status = 'active') {
            if (status == 'trased') {
                this.is_trashed_data = true;
            } else {
                this.is_trashed_data = false
            }
            this.set_only_latest_data(true);
            this.set_status(status);
            this.set_page(1);

            this.get_all();

            this.set_only_latest_data(false);
        }
    },
    computed: {
        ...mapState(store, [
            'trased_data_count',
        ]),
    }
}
</script>
<style lang="">

</style>
