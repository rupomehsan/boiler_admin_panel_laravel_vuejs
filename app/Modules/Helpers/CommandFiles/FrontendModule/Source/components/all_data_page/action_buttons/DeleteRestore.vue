<template>
    <a
        v-if="!item.deleted_at"
        @click.prevent="softDelete(item)"
        href=""
        class="border-danger"
    >
        <i class="fa fa-ban text-warning"></i>
        Soft Delete
    </a>

    <a
        v-if="item.deleted_at"
        @click.prevent="restore_data(item)"
        href=""
        class="border-danger"
    >
        <i class="fa fa-ban text-warning"></i>
        Restore data
    </a>
</template>
<script>
import { mapActions } from "pinia";
import { store } from "../../../store";

export default {
    props: {
        item: {
            slug: "",
        },
    },
    data: () => ({
        is_trashed_data: false,
    }),
    methods: {
        ...mapActions(store, [
            `restore`,
            `destroy`,
            `get_all`,
            `set_only_latest_data`,
            `set_item`,
            `soft_delete`,
        ]),
        softDelete: async function (item) {
            let con = await window.s_confirm(
                "Are you sure want to soft delete ?"
            );
            if (con) {
                this.set_item(item);
                this.set_only_latest_data(true);

                let response = await this.soft_delete();
                if (response.data.status === "success") {
                    await this.get_all();
                    window.s_alert(response.data?.message);
                    this.set_only_latest_data(true);
                } else {
                    window.s_warning(response.data?.message);
                }
            }
        },
        restore_data: async function (item) {
            let con = await window.s_confirm("Restore");
            if (con) {
                this.set_item(item);
                this.set_only_latest_data(true);
                let response = await this.restore();
                if (response.data.status === "success") {
                    await this.get_all();
                    window.s_alert("Permanently deleted.");
                    this.set_only_latest_data(true);
                } else {
                    window.s_warning(response.data?.message);
                }
            }
        },
    },
};
</script>
<style lang=""></style>
