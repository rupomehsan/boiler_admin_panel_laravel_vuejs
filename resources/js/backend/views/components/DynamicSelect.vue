<template>
    <div>
        <ul class="d-flex mb-1 flex-wrap gap-2">
            <li :class="{ active: selected.title == item.title }" class="btn btn-sm btn-outline-info px-1"
                v-for="(item, index) in component_data" :key="index">
                <div class="d-flex gap-3 align-items-baseline px-1 justify-content-between">
                    <span @click="edit(item)">
                        {{ item.title }}
                    </span>
                    <i @click="remove(index)" class="icon-close text-danger"></i>
                </div>
            </li>
        </ul>
        <input v-on:keydown.enter="onEnter" ref="input_form" v-model="input_value" type="text"
            class="form-control position-relative" @click="show = !show" />
        <div v-if="selectType == 'checkbox'">
            <ul class="select-tools position-absolute" v-if="show">
                <li class="" v-for="(item, index) in search_result" :key="index" @click="selectData(item)">
                    <label :for="'select-' + index">
                        <span class="mx-2">
                            <input :checked="isExist(item)" :id="'select-' + index" type="checkbox" />
                        </span>
                        <span>
                            {{ item.title }}
                        </span>
                    </label>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import { computed } from "vue";
export default {
    props: {
        setValue: Function,
        data: {
            type: Array,
            default: [],
        },
        sourceData: {
            type: Array,
            default: [],
        },
        selectType: {
            type: String,
            data: "",
        },
        tags: {
            type: Boolean,
            default: false,
        },
    },
    data: () => ({
        input_value: "",
        selected: {},
        component_data: [],
        show: false,
        search_result: [],
    }),

    created: function () {
        this.component_data = this.data;

        this.search_result = this.sourceData;
    },

    watch: {
        component_data: {
            handler: function (v) {
                console.log(v);
                this.setValue(v);
            },
            deep: true,
        },
        input_value: {
            handler: function (v) {
                if (!v.length) {
                    this.search_result = this.sourceData;
                    return 0;
                }
                this.search_result = this.sourceData.filter((i) => i.title.toLowerCase().includes(v.toLowerCase()));
            },
            deep: true,
        },
    },

    methods: {
        onEnter: function () {
            event.preventDefault();

            if (this.tags == false) {
                return 0;
            }

            if (this.input_value.length) {
                if (this.selected.title) {
                    this.selected.title = this.input_value;
                    this.selected = {};
                    this.input_value = "";
                    return;
                }
                let check = this.component_data.find(
                    (i) => i.title == this.input_value
                );
                if (check) {
                    check.title = this.input_value;
                } else {
                    this.component_data.push({
                        title: this.input_value,
                    });
                }
                this.input_value = "";
                this.setValue(this.component_data.map((i) => i.title));
            }
            return 0;
        },
        remove: function (index) {
            console.log(index, this.component_data);
            this.component_data.splice(index, 1);
            this.input_value = "";
        },
        edit: function (item) {
            this.input_value = item.title;
            this.$refs.input_form.focus();
            this.selected = item;
        },

        selectData: function (i) {
            let check = this.component_data.find((j) => j.id == i.id);
            if (check) {
                this.component_data = this.component_data.filter(
                    (j) => j.id != i.id
                );
            } else {
                this.component_data.push(i);
            }
        },

        isExist: function (i) {
            return this.component_data.find((j) => j.id == i.id);
        },
    },
};
</script>
