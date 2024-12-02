<template lang="">

    <a href="" @click.prevent="change_status(`active`)"
        class="btn action_btn btn-sm btn-success d-flex align-items-center">
        <i class="fa fa fa fa-eye mr-2"></i> Active
        ({{ active_data_count }})
    </a>

</template>
<script>
import { mapActions, mapWritableState } from 'pinia';
import { store } from '../../../store';

export default {
    props: {
        item: {
            slug: "",
        }
    },
    methods: {
        ...mapActions(store, [
            `restore`,
            `deactive`,
            `get_all`,
            `set_only_latest_data`,
            `set_item`,
            `set_page`,
            `set_status`,
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
            this.set_only_latest_data(true);
        },

    },
    computed: {
        ...mapWritableState(store, [
            'active_data_count',
        ]),
    },
}
</script>
<style lang="">

</style>
