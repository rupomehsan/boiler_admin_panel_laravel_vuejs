<template>
    <li v-for="item in children" :key="item.id">
        <div class="details">
            <input :type="type" :name="type == 'radio' ? 'parent_id' : 'blog_category_id[]'"
                :class="type == 'radio' ? 'form-check-input' : ''" :value="item.id"
                @click="type == 'checkbox' ? setCategory(item) : ''" :checked="child_parent_id.includes(item.id)">
            <div class="title">
                {{ item.title }}
            </div>
            <div class="collpse" v-if="item.child_cateogories?.length" @click="showSubCategory"><i
                    class="fa fa-minus fa-plus"></i>
            </div>
        </div>
        <ul class="list " v-if="item.child_cateogories?.length">
            <div class="left_line"></div> <!---->
            <nested-category :children="item.child_cateogories" :child_parent_id="child_parent_id"
                :type="type"></nested-category>
        </ul>
    </li>
</template>

<script>
import { mapActions, mapState } from 'pinia'
import { blog_setup_store } from '../pages/admin/management/BlogManagement/Blog/setup/store';

export default {

    props: [
        "children",
        "child_parent_id",
        "type",
    ],

    methods: {
        ...mapActions(blog_setup_store, {
            set_categories: 'set_categories',
        }),
        showSubCategory() {
            let target = event.target
            target.parentNode.parentNode.nextSibling.classList.toggle('d-block');
        },
        setCategory: function (item) {
            this.set_categories(item)
        }
    },
    computed: {
        ...mapState(blog_setup_store, {
            set_categories_data: 'set_categories_data',
        }),
    },

}
</script>

<style>
.category_card_dropdown .list {
    list-style-type: none;
    padding-left: 35px;
    position: relative;
    margin-left: 0px;
    margin-top: 0px;
}

.category_card_dropdown .list .left_line {
    position: absolute;
    height: calc(100% - 7px);
    width: 1px;
    left: 6px;
    top: -4px;
}

.category_card_dropdown .list .collpse {
    position: absolute;
    height: 15px;
    width: 15px;
    z-index: 999;
    background-color: #818181;
    border-radius: 50%;
    text-align: center;
    left: -36px;
    top: 10px;
    cursor: pointer;
}

.category_card_dropdown .list .collpse:hover {
    background-color: #0d4c51;
}

.category_card_dropdown .list .collpse i {
    font-size: 9px;
    color: white;
    position: absolute;
    top: 50%;
    left: calc(50% - 0.2px);
    transform: translate(-50%, -50%);
}

.fa-plus:before {
    content: "\2b";
}

.category_card_dropdown .list .left_line,
.category_card_dropdown .list li::before {
    background-color: #882d2d;
}

.category_card_dropdown .list ul li::before,
.category_card_dropdown .list ul .left_line {
    background-color: #1d9aad;
}

.category_card_dropdown .list ul ul li::before,
.category_card_dropdown .list ul ul .left_line {
    background-color: #8b1bbf;
}

.category_card_dropdown .list ul ul ul li::before,
.category_card_dropdown .list ul ul ul .left_line {
    background-color: #1bbf88;
}

.category_card_dropdown .list ul ul ul ul li::before,
.category_card_dropdown .list ul ul ul ul .left_line {
    background-color: #bfb11b;
}

.category_card_dropdown .list .details {
    display: flex;
    gap: 10px;
    padding: 5px 10px;
    border-radius: 5px;
}

.category_card_dropdown .list .details input[type="checkbox"] {
    margin-top: 4px;
    position: relative;
    z-index: 9;
}

.category_card_dropdown .list .details input:focus {
    box-shadow: none;
}

.category_card_dropdown .list .details .title {
    flex: 1;
    line-height: 26px;
}

.category_card_dropdown .list .details:hover {
    background-color: #808080 29;
}

.category_card_dropdown .list .details .append_sub_btn {
    border: 0;
    background-color: transparent;
    outline: 0;
    color: #b4b7bd;
    cursor: pointer;
    display: none;
}

.category_card_dropdown .list .details:hover .append_sub_btn {
    display: block;
}

.category_card_dropdown .list li {
    position: relative;
    font-size: 14px;
}

.category_card_dropdown .list li::before {
    position: absolute;
    content: "";
    width: 38px;
    height: 1px;
    top: 17px;
    left: -28px;
}

.category_card_dropdown .list li>ul {
    display: none;
    padding-left: 29px;
}

.category_card_dropdown .list li>ul .left_line {
    left: 0px;
    top: -8px;
}

.category_card_dropdown .list li .form-check-input {
    border: 1px solid #7c81a1;
    position: relative;
}

.category_card_dropdown .list li .form-check-input[type=radio] {
    top: 2px;
}

.category_card_dropdown .list li .form-check-input:checked[type=radio] {
    background-color: #ad0000e3;
}

.category_card_dropdown .list li .form-check-input:checked[type=radio]::after {
    content: "\f058";
    font-family: "Font Awesome 6 Free";
    font-size: 18px;
    position: absolute;
    top: -5px;
    left: 0px;
    height: 100%;
    width: 100%;
    border-radius: 50%;
    color: #cda832;
}

.category_card_dropdown .list .details:hover {
    background-color: hsl(0deg 0% 50% / 52%);
}

.category_card_dropdown .list .new_cat_li {
    display: none;
}

.category_card_dropdown .list .new_cat_li.active {
    display: block !important;
}


.dark-layout .form-check-input:not(:checked):not(:indeterminate):not(:focus) {
    border-color: #404656;
}

.dark-layout .form-check-input:not(:checked):not(:indeterminate) {
    background-color: #283046;
}

.dark-layout .form-check-input:not(:checked) {
    background-color: #283046;
    border-color: #404656;
}

.form-check-input {
    width: 1.285rem;
    height: 1.285rem;
    margin-top: 0.0825rem;
    vertical-align: top;
    background-color: #FFF;
    background-repeat: no-repeat;
    background-position: center;
    background-size: contain;
    border: 1px solid #D8D6DE;
    appearance: none;
    -webkit-print-color-adjust: exact;
    color-adjust: exact;
}

.form-check-input[type=radio] {
    border-radius: 50%;
}
</style>

