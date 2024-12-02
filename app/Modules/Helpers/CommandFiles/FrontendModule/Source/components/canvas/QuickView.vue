<template lang="">
    <div class="off_canvas quick_view" :class="{active: show_details_canvas}">
        <div class="off_canvas_body">
            <div class="header">
                <h3 class="heading_text">Quick View</h3>
                <button @click.prevent="set_show_details_canvas(false)"
                    class="btn btn-sm btn-outline-danger">
                    <i class="fa fa-close"></i>
                </button>
            </div>
            <div class="data_content">
                <table class="table quick_modal_table">
                    <tbody>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>
                                <img v-if="item.image" :src="item.image" alt="" style="height: 130px;">
                            </th>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <th>:</th>
                            <th>
                                {{ item.title }}
                            </th>
                        </tr>
                        <tr>
                            <th>Total Product</th>
                            <th>:</th>
                            <th>
                                {{ item.total_product }}
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="off_canvas_overlay"></div>
    </div>
</template>
<script>
import { mapActions, mapWritableState } from 'pinia';
import { store } from '../../store';

export default {
    methods: {
        ...mapActions(store, [
            'set_show_details_canvas'
        ]),
    },
    computed:{
        ...mapWritableState(store, [
            'show_details_canvas',
            'item',
        ])
    }
};
</script>
<style>
.off_canvas.active{
    box-shadow:  0px 0px 0px 100000px rgba(0, 0, 0, 0.5);
}
</style>
