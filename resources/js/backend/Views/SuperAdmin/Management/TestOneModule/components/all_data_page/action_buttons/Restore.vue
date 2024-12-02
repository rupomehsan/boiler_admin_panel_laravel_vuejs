<template>
    <a
        v-if="!is_trashed_data"
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
       
    },
};
</script>
<style lang=""></style>
