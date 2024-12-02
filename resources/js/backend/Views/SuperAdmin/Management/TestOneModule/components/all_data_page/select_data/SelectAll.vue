<template lang="">
    <input class="form-check-input ml-0 select_all_checkbox"
        @change="($event)=>set_all_item_selectd($event)"
        type="checkbox" />
</template>
<script>
import set_all_item_selectd from "../../../store/actions/set_all_item_seleted"
export default {
    methods: {
        set_all_item_selectd,
    }
}
</script>
<style lang="">

</style>
