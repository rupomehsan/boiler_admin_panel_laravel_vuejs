<template>
    <div :class="row_col_class">
        <div class="form-group" v-if="is_visible">
            <label for="">
                {{ label || name }}
            </label>
            <div v-if="
                [
                    'text',
                    'number',
                    'password',
                    'email',
                    'date',
                    'month',
                    'radio',
                    'checkbox',
                ].includes(type)
            " class="mt-1 mb-3">
                <template v-if="name == 'tags'">
                    <!-- <input type="text" class="form-control" :value="tags" :name="name" data-role="tagsinput"> -->
                    <div class="bootstrap-tagsinput" style="min-height: 40px">

                        <input type="text" placeholder="" v-on:keydown.enter="onEnter" v-model="tag_input_value" />
                    </div>
                </template>
                <template v-else>
                    <input class="form-control form-control-square mb-2" :type="type" :name="name" :id="name"
                        :value="value" @change="errorReset" />
                </template>
            </div>

            <div v-if="type === 'textarea'" class="mt-1 mb-3">
                <!-- <textarea class="form-control form-control-square" rows="10"  type="text" :name="name" :value="value"
                @change="errorReset"></textarea> -->
                <!-- <div :id="name"></div> -->
                <text-editor :name="name" />
            </div>

            <div v-if="type === 'select'" class="mt-1 mb-3">
                <select :name="name" class="form-control" :id="name" @change="errorReset">
                    <option value="">Select item</option>
                    <option v-for="data in data_list" :key="data" :value="data.value" :selected="data.value == value">
                        {{ data.label }}
                    </option>
                </select>
            </div>
            <div v-if="type === 'file'" class="mt-1 mb-3">
                {{ images_list }}
                <image-component :name="name" :multiple="multiple" :accept="`.jpg,.jpeg,.png`"
                    :images="multiple ? images_list : value"></image-component>
            </div>
        </div>
    </div>
</template>

<script>
import TextEditor from "./TextEditor.vue";
import ImageComponent from "./ImageComponent.vue";
import { mapActions, mapState } from "pinia";
/**
 * props:
 */
export default {
    components: { TextEditor, ImageComponent },
    data: () => ({
        tag_input_value: "",
    }),
    props: {
        is_visible: {
            type: [Boolean, String],
            default: true
        },
        name: {
            required: true,
            type: String,
        },
        label: {
            required: true,
            type: String,
        },
        type: {
            required: true,
            type: String,
        },
        multiple: {
            required: false,
            type: [Boolean, String],
        },
        value: {
            required: false,
            type: String,
        },
        data_list: {
            required: false,
            type: Array,
        },
        images_list: {
            required: false,
            type: Array,
        },
        row_col_class: {
            required: false,
            type: String,
            default: 'col-md-6'
        },
    },

    methods: {

        errorReset(event) {
            let currentElement = event.target;
            let nextElement = currentElement.nextElementSibling;
            if (nextElement) {
                currentElement.classList.remove("border-warning");
                nextElement.remove();
            }
        },
        onEnter: function () {
            event.preventDefault();
            this.set_tags(this.tag_input_value);
            this.tag_input_value = "";
        },
        removeTag: function (item) {
            this.remove_tag(item);
        },
    },
    created: async function () { },

};
</script>

<style>
.bootstrap-tagsinput {
    background-color: rgba(255, 255, 255, 0.2);
    border: 0px solid #ccc;
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    display: inline-block;
    padding: 4px 6px;
    color: #555;
    vertical-align: middle;
    border-radius: 4px;
    width: 100%;
    line-height: 22px;
    cursor: text;
}

.bootstrap-tagsinput input {
    border: none;
    box-shadow: none;
    outline: none;
    background-color: transparent;
    padding: 0 6px;
    margin: 0;
    color: #fff;
    width: auto;
    max-width: inherit;
}

.bootstrap-tagsinput.form-control input::-moz-placeholder {
    color: #777;
    opacity: 1;
}

.bootstrap-tagsinput.form-control input:-ms-input-placeholder {
    color: #777;
}

.bootstrap-tagsinput.form-control input::-webkit-input-placeholder {
    color: #777;
}

.bootstrap-tagsinput input:focus {
    border: none;
    box-shadow: none;
}

.bootstrap-tagsinput .tag {
    margin-right: 2px;
}

.bootstrap-tagsinput .tag [data-role="remove"] {
    margin-left: 8px;
    cursor: pointer;
}

.bootstrap-tagsinput .tag [data-role="remove"]:after {
    content: "x";
    padding: 0px 2px;
}

.bootstrap-tagsinput .tag [data-role="remove"]:hover {
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2),
        0 1px 2px rgba(0, 0, 0, 0.05);
}

.bootstrap-tagsinput .tag [data-role="remove"]:hover:active {
    box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
}
</style>
