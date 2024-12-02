<template>
    <a v-if="item.status == 'active'" href="" @click.prevent="updateStatus(item)" class="border-warning">
        <i class="fa fa-eye-slash text-warning"></i>
        Inactive
    </a>
    <a v-if="item.status == 'inactive'" href="" @click.prevent="updateStatus(item)" class="border-warning">
        <i class="fa fa-eye text-warning"></i>
        Active
    </a>
</template>
<script>
import { mapActions } from 'pinia';
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
            `update_status`,
        ]),
        updateStatus: async function (item) {
            console.log(item);

            let action = item.status == 'active' ? 'deactive' : 'active';
            let con = await window.s_confirm('Are you sure want to ' + action + ' ?');
            if (con) {
                this.set_item(item);
                this.set_only_latest_data(true);
                let response = await this.update_status();
                if (response.data.status === "success") {
                    await this.get_all();
                    window.s_alert(response.data?.message);
                    this.set_only_latest_data(true);
                } else {
                    window.s_warning(response.data?.message);
                }
            }
        },
    }
}
</script>
<style lang="">

</style>
