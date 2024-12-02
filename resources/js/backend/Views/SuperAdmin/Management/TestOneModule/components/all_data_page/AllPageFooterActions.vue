<template lang="">
    <div class="d-flex align-items-center gap-2">
        <create />
        <export-all />
        <export-selected />
        <import />
        <active />
        <inactive />
        <!-- <trash /> -->
        <bulk-actions />
    </div>
</template>
<script>
import Create from "./action_buttons/Create.vue"
import ExportAll from "./action_buttons/ExportAll.vue"
import ExportSelected from "./action_buttons/ExportSelected.vue"
import Import from "./action_buttons/Import.vue"
import Active from "./action_buttons/Active.vue"
import Inactive from "./action_buttons/Inactive.vue"
import BulkActions from "./action_buttons/BulkActions.vue"
import Trash from "./action_buttons/Trash.vue"


export default {
    components: {
        Create,
        ExportAll,
        ExportSelected,
        Import,
        Active,
        Inactive,
        BulkActions,
        Trash,
    }
}
</script>
<style lang="">

</style>
