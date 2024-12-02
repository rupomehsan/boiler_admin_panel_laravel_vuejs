<template>

    <!-- {{ item }} -->

    <template v-for="(row_item, index) in setup.table_row_data" :key="index">
        <tr >
            <th>{{ row_item }}</th>
            <th class="text-center">:</th>
            <th class="text-trim">
                {{ trim_content(item[row_item]) }}
            </th>
        </tr>
    </template>



</template>

<script>
import setup from '../../setup';
import SelectAll from './select_data/SelectAll.vue';
import TableRowAction from './TableRowAction.vue';
import SelectSingle from './select_data/SelectSingle.vue';
export default {
    props: ['item'],
    data: () => ({
        setup,
    }),
    components: {
        SelectAll,
        TableRowAction,
        SelectSingle,
    },

    methods: {
        trim_content(content) {
            if (typeof content == 'string') {
                return content;
            }
            return content;
        },
    }
}
</script>

<style scoped>
.max-w-120 {
    max-width: 120px;
}
</style>
