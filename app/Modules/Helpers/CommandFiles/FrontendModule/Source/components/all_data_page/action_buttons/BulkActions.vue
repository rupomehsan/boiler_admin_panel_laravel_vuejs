<template>

    <div class="" v-if="this.selected?.length">
        <select @change="bulkActions">
            <option disabled selected>Select action</option>
            <option value="inactive">Inactive</option>
            <option value="active">Action</option>
            <!-- <option value="soft_delete">Soft Delete</option> -->
            <!-- <option value="restore">Restore</option> -->
            <option value="destroy">Destroy</option>
        </select>
    </div>

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
            `clear_selected`,
            `bulk_action`,
        ]),
        bulkActions: async function () {
            let action = event.target.value;
            let con = await window.s_confirm('Are you sure want to ' + action + ' items ?');
            if (con) {

                let selected_data = this.selected;
                selected_data = selected_data.map((item => item.id))
                this.set_only_latest_data(true);
                let response = await this.bulk_action(action, selected_data);
                if (response.data.status === "success") {
                    await this.get_all();
                    document.querySelector('.select_all_checkbox').checked = false;
                    this.clear_selected();
                    this.set_only_latest_data(false);
                    window.s_alert('You have ' + action + ' items ?');
                } else {
                    window.s_warning(response.data?.message);
                }

            }

        },
    },
    computed: {
        ...mapWritableState(store, [
            'selected',
        ]),
    }
}
</script>
<style></style>
