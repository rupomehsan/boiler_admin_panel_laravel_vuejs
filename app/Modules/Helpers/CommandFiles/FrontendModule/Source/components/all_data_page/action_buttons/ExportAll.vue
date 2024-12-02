<template lang="">
    <a href=""
        @click.prevent="()=>export_all_csv()"
        class="btn action_btn mr-2 btn-sm btn-primary d-flex align-content-center align-items-center">
        <i class="fa fa-print mr-2"></i>
        Export All
    </a>
</template>
<script>
import export_all_csv from "../../../helpers/export_all_csv"
export default {
    methods: {
        export_all_csv,
    }
}
</script>
<style lang="">

</style>
