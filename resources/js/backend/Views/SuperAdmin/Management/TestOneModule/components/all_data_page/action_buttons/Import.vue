<template>
    <a href="" @click.prevent="set_import_csv_modal(true)"
        class="btn action_btn btn-sm btn-secondary d-flex align-items-center">
        <i class="fa fa-download mr-2"></i> Import
    </a>
</template>
<script>

import { mapActions, mapWritableState } from 'pinia';
import { store } from '../../../store';
import export_all_csv from "../../../helpers/export_all_csv"
export default {
    methods: {
        ...mapActions(store, [
            'set_import_csv_modal'
        ]),
        export_all_csv,
    }
}
</script>
<style></style>
