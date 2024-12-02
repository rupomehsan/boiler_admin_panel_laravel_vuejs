<template lang="">
    <span @click.prevent="active_row($event)" class="icon"></span>
    <div class="table_action_btns">
        <ul>
            <li>
                <details-btn :item="item" />
            </li>
            <li>
                <edit :item="item"/>
            </li>
            <li>
                <status-button :item="item"/>
            </li>
            <li>
                <delete-restore :item="item"/>
            </li>
            <li>
                <destroy :item="item"/>
            </li>

            <slot />
        </ul>
    </div>
</template>
<script>
import active_row from '../../helpers/table_active_row';
import Details from './action_buttons/Details.vue';
import Edit from './action_buttons/Edit.vue';
import StatusButton from './action_buttons/StatusButton.vue';
import DeleteRestore    from './action_buttons/DeleteRestore.vue';
import Destroy from './action_buttons/Destroy.vue';
export default {
    props: {
        item: {
            type: Object,
            default: {},
        }
    },
    components: {
        DetailsBtn: Details,
        Edit,
        StatusButton,
        Destroy,
        DeleteRestore,
    },
    methods: {
        active_row,
    }
}
</script>
<style lang="">

</style>
