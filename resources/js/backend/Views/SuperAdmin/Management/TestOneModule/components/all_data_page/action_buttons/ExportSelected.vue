<template lang="">
    <a v-if="selected.length" @click.prevent="export_selected_csv(selected)" href=""
        class="btn action_btn mr-2 btn-sm btn-secondary d-flex align-content-center align-items-center">
        <i class="fa fa-sign-out mr-2"></i>
        Export ( {{ selected.length }} )
    </a>
</template>
<script>
import { mapState } from 'pinia';
import { store } from '../../../store';
import export_selected_csv from "../../../helpers/export_selected_csv"
export default {
    computed: {
        ...mapState(store,[
            'selected'
        ])
    },
    methods: {
        export_selected_csv,
    }
}
</script>
<style lang="">

</style>
