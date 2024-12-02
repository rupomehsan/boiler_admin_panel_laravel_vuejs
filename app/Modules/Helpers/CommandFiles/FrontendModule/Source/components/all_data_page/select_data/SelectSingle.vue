<template lang="">
    <input
        @change="set_item_selectd(data, $event)"
        :checked="exists"
        class="form-check-input ml-0"
        type="checkbox">
</template>
<script>
import { mapState } from "pinia";
import set_item_selectd from "../../../store/actions/set_item_selected"
import { store } from "../../../store";
export default {
    props: ['data'],
    created: function () {

    },
    methods: {
        set_item_selectd,
    },
    computed: {
        ...mapState(store,[
            'selected'
        ]),
        exists: function(){
            return this.selected.find(i=>i.id === this.data.id);
        }
    }
}
</script>
<style lang="">

</style>
