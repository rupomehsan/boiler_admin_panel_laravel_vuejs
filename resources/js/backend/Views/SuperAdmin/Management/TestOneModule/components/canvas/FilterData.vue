<template lang="">
    <div class="off_canvas data_filter" :class="{active: show_filter_canvas,}">
        <div class="off_canvas_body">
            <div class="header">
                <h3 class="heading_text">Filter</h3>
                <button @click.prevent="set_show_filter_canvas(false)" class="close_button">
                    <span class="fa fa-close"></span>
                </button>
            </div>
            <hr class="m-0 p-0">
            <div class="data_content">
                <div class="filter_item">
                    <label for="start_date">Start Date</label>
                    <label for="start_date" class="text-capitalize d-block date_custom_control">
                        <input v-model="filter.start_date" type="date" id="start_date" name="start_date" class="form-control">
                        <!-- <div class="form-control preview"></div> -->
                    </label>
                </div>
                <div class="filter_item">
                    <label for="end_date">End Date</label>
                    <label for="end_date" class="text-capitalize d-block date_custom_control">
                        <input v-model="filter.end_date" type="date" id="end_date" name="end_date" class="form-control">
                        <!-- <div class="form-control preview"></div> -->
                    </label>
                </div>
                <div class="filter_item">
                    <label for="sort_by_col">Sort By Col</label>
                    <label for="sort_by_col" class="text-capitalize d-block date_custom_control">
                        <select v-model="sort_by_col" class="form-control">
                            <option v-for="col in sort_by_cols">
                                {{ col }}
                            </option>
                        </select>
                    </label>
                </div>
                <div class="filter_item">
                    <label for="sort_by_col">Sort Type</label>
                    <label for="sort_by_col" class="text-capitalize d-block date_custom_control">
                        <select v-model="sort_type" class="form-control">
                            <option v-for="col in ['ASC', 'DESC']">
                                {{ col }}
                            </option>
                        </select>
                    </label>
                </div>
                <div class="filter_item">
                    <button @click.prevent="get_all();" type="button" class="btn btn-sm btn-outline-info">
                        Submit
                    </button>
                </div>
            </div>
        </div>
        <div class="off_canvas_overlay"></div>
    </div>
</template>
<script>
import { mapActions, mapWritableState } from 'pinia';
import { store } from '../../store';

export default {
    data: () => ({
        filter: {
            start_date: '',
            end_date: '',
        },
    }),
    watch: {
        filter: {
            handler: function(v){
                this.set_filter_criteria(v);
            },
            deep: true,
        }
    },
    methods: {
        ...mapActions(store, [
            'set_show_filter_canvas',
            'set_filter_criteria',
            'get_all',
        ]),
    },
    computed:{
        ...mapWritableState(store, [
            'show_filter_canvas',
            'item',
            'sort_by_cols',
            'sort_by_col',
            'sort_type',
        ])
    }
}
</script>
<style lang="">

</style>
