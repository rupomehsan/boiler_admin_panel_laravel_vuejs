<template lang="">
    <div
        @click.prevent="() => {
            set_item(item);
            set_show_details_canvas(true);
        }"
        class="text-warning cursor-pointer">

        <slot/>

    </div>
</template>
<script>
import { mapActions } from 'pinia';
import { store } from '../../store';

export default {
    props: ['item'],
    methods: {
        ...mapActions(store, [
            'set_show_details_canvas',
            'set_item',
        ]),
    }
}
</script>
<style lang="">

</style>
