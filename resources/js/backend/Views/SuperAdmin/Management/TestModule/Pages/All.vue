<template>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <!-- Title Section -->
                            <div class="col-12 col-md-3 mb-2 mb-md-0">
                                <h5 class="text-capitalize mb-0">{{ setup.all_page_title }} </h5>
                            </div>

                            <!-- Search Input -->
                            <div class="col-12 col-md-6 mb-2 mb-md-0">
                                <input class="form-control" placeholder="Search" />
                            </div>

                            <!-- Sorting Button -->
                            <div class="col-12 col-md-3 text-md-right text-sm-left">
                                <button class="btn btn-outline-success btn-sm " @click="set_show_filter_canvas">
                                    <i class="fa fa-gear mx-2"></i>Filter
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive table_responsive card_body_fixed_height">
                            <table class="table table-hover text-center table-bordered">
                                <thead>
                                    <tr>
                                        <th><i class="zmdi zmdi-settings  zmdi-hc-2x" title="Actions"></i></th>
                                        <th class="w-10 text-center">
                                            <input class="form-check-input ml-0 select_all_checkbox"
                                                @change="($event) => set_all_item_selected($event)" type="checkbox"
                                                :checked="isAllSelected" />
                                        </th>
                                        <th class="w-10">ID</th>
                                        <th>name</th>
                                        <th>email</th>
                                        <th>phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item) in all?.data" :key="item.id"
                                        :class="`table_rows table_row_${item.id}`">
                                        <td>
                                            <span class="icon" @click.prevent="active_row($event)"></span>
                                            <div class="table_action_btns ">
                                                <ul>
                                                    <li>
                                                        <router-link :to="{
                                                            name: `Details${setup.route_prefix}`,
                                                            params: { id: item.slug }
                                                        }" class="border-secondary">
                                                            <i class="fa fa-eye text-secondary"></i>
                                                            Show
                                                        </router-link>
                                                    </li>
                                                    <li>
                                                        <router-link :to="{
                                                            name: `Edit${setup.route_prefix}`,
                                                            params: { id: item.slug }
                                                        }" class="border-secondary">
                                                            <i class="fa fa-pencil-square-o text-info"></i>
                                                            Edit
                                                        </router-link>
                                                    </li>
                                                    <li>
                                                        <a v-if="item.status == 'active'" href=""
                                                            @click.prevent="updateStatus(item)" class="border-warning">
                                                            <i class="fa fa-eye-slash text-warning"></i>
                                                            Inactive
                                                        </a>
                                                        <a v-if="item.status == 'inactive'" href=""
                                                            @click.prevent="updateStatus(item)" class="border-warning">
                                                            <i class="fa fa-eye text-warning"></i>
                                                            Active
                                                        </a>
                                                    </li>
                                                    <li v-if="!is_trashed_data">
                                                        <a @click.prevent="softDelete(item)" href=""
                                                            class="border-danger">
                                                            <i class="fa fa-ban text-warning"></i>
                                                            Soft Delete
                                                        </a>
                                                    </li>
                                                    <li v-if="is_trashed_data">
                                                        <a @click.prevent="restore_data(item)" href=""
                                                            class="border-danger">
                                                            <i class="fa fa-refresh text-warning"></i>
                                                            Restore data
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a @click.prevent="destroy_data(item)" href=""
                                                            class="border-danger">
                                                            <i class="fa fa-trash text-danger"></i>
                                                            Destroy
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            <input @change="set_item_selected(item, $event)" :checked="isSelected(item)"
                                                class="form-check-input ml-0" type="checkbox">
                                        </td>
                                        <td>{{ item.id }}</td>
                                        <td>
                                            <div class="text-warning cursor-pointer">
                                                {{ item.name }}
                                            </div>
                                        </td>
                                        <td>{{ item.email }}</td>
                                        <td>{{ item.phone }}</td>

                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mx-3">

                        <nav aria-label="" class="d-flex gap-2 align-items-center" style="gap: 10px;">
                            <ul class="pagination my-2" style="font-size: 11px;">

                                <template v-for="(link, index) in all?.links" :key="index">
                                    <li class="page-item" :class="{ active: link.active }">
                                        <a class="page-link" :class="(
                                            all?.current_page == all?.last_page &&
                                            all?.links.length - 1 == index
                                        )
                                            ?
                                            'disabled'
                                            : ''
                                            " @click.prevent="set_page_data(link)" :href="link.url"
                                            v-html="`<span>${link.label}</span>`">
                                        </a>
                                    </li>
                                </template>
                            </ul>
                            <div class="d-flex" style="gap: 5px">
                                <span></span>
                                <span>{{ all?.from }}</span>
                                <span>-</span>
                                <span>{{ all?.to }}</span>
                                <span>of</span>
                                <span>{{ all?.total }}</span>
                            </div>
                            <div class="d-flex" style="gap: 5px">
                                <span></span>
                                <span> Limit </span>
                                <select v-model="paginate" @change="set_per_page_limit"
                                    class="bg-transparent text-white rounded-1">
                                    <option value="5">05</option>
                                    <option value="10">10</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                    <option value="300">300</option>
                                    <option value="400">400</option>
                                    <option value="500">500</option>
                                </select>
                            </div>
                        </nav>
                    </div>
                    <div class="card-footer py-2">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="mr-2 mb-2">
                                <a href="http://127.0.0.1:8000/super-admin#/user-managements/create"
                                    class="btn action_btn btn-sm btn-info d-flex align-items-center">
                                    <i class="fa fa-edit mr-2"></i> Create
                                </a>
                            </div>
                            <div class="mr-2 mb-2">
                                <a href="" class="btn action_btn btn-sm btn-primary d-flex align-items-center">
                                    <i class="fa fa-print mr-2"></i> Export All
                                </a>
                            </div>
                            <div class="mr-2 mb-2">
                                <a href="" @click.prevent="change_status(`active`)"
                                    class="btn action_btn btn-sm btn-success d-flex align-items-center">
                                    <i class="fa fa fa fa-eye mr-2"></i> Active
                                    ({{ active_data_count }})
                                </a>
                            </div>
                            <div class="mr-2 mb-2">
                                <a href="" @click.prevent="change_status(`inactive`)"
                                    class="btn action_btn btn-sm btn-warning d-flex align-items-center">
                                    <i class="fa fa fa-eye-slash mr-2"></i> Inactive
                                    ({{ inactive_data_count }})
                                </a>
                            </div>
                            <div class="mr-2 mb-2">
                                <a href="" @click.prevent="change_status(`trased`)"
                                    class="btn action_btn btn-sm btn-danger d-flex align-items-center">
                                    <i class="fa fa-trash mr-2"></i> Trased
                                    ({{ trased_data_count }})
                                </a>
                            </div>
                            <div class="mr-2 mb-2" v-if="this.selected?.length">
                                <a href="" class="btn action_btn btn-sm btn-secondary d-flex align-items-center">
                                    <i class="fa fa-sign-out mr-2"></i> Export ({{ this.selected?.length }})
                                </a>
                            </div>
                            <div class="mr-2 mb-2" v-if="this.selected?.length">
                                <select class="form-control" style="width: 100px;height: 30px;font-size: 12px"
                                    @change="bulkActions">
                                    <option disabled selected>Select action</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="active">Action</option>
                                    <option value="delete">Delete</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="loader export_loader">
            <div class="loader_body">
                <div class="progress"></div>
                <div class="load_amount">
                    <h4>0</h4>
                    <h5>%</h5>
                </div>
            </div>
        </div>
        <div class="off_canvas quick_view d-none">
            <div class="off_canvas_body">
                <div class="header">
                    <h3 class="heading_text">Quick View</h3>
                    <button class="btn btn-sm btn-outline-danger">
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
                                    <img src="/avatar.png" alt="" style="height: 30px" />
                                </th>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <th>:</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <th>:</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <th>:</th>
                                <th></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="off_canvas_overlay"></div>
        </div>
        <div class="off_canvas data_filter " :class="`${show_filter_canvas ? 'active' : ''}`">
            <div class="off_canvas_body">
                <div class="header">
                    <h3 class="heading_text">Filter</h3>
                    <button class="close_button " @click="set_show_filter_canvas(false)">
                        <span class="fa fa-close border p-2"></span>
                    </button>
                </div>
                <div class="data_content">
                    <div class="filter_item">
                        <label for="start_date">Start Date</label><label for="start_date"
                            class="text-capitalize d-block date_custom_control"><input type="date" id="start_date"
                                name="start_date" class="form-control" /></label>
                    </div>
                    <div class="filter_item">
                        <label for="end_date">End Date</label><label for="end_date"
                            class="text-capitalize d-block date_custom_control"><input type="date" id="end_date"
                                name="end_date" class="form-control" /></label>
                    </div>
                    <div class="filter_item">
                        <label for="sort_by_col">Sort By Col</label><label for="sort_by_col"
                            class="text-capitalize d-block date_custom_control"><select class="form-control">
                                <option>id</option>
                                <option>user_code</option>
                                <option>name</option>
                                <option>email</option>
                                <option>phone_number</option>
                                <option>created_at</option>
                                <option>status</option>
                            </select></label>
                    </div>
                    <div class="filter_item">
                        <label for="sort_by_col">Sort Type</label><label for="sort_by_col"
                            class="text-capitalize d-block date_custom_control"><select class="form-control">
                                <option>ASC</option>
                                <option>DESC</option>
                            </select></label>
                    </div>
                    <div class="filter_item">
                        <button type="button" class="btn btn-sm btn-outline-info">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
            <div class="off_canvas_overlay"></div>
        </div>
    </div>
</template>

<script>
/** plugins */
import { mapActions, mapWritableState } from "pinia";
import { store as data_store } from "../store";
import setup from "../setup";


export default {

    data: () => ({
        setup,
        is_trashed_data: false,

    }),
    created: async function () {
        await this.get_all();
    },
    methods: {

        ...mapActions(data_store, [
            'set_show_filter_canvas',
            'get_all',
            `restore`,
            `soft_delete`,
            `update_status`,
            `set_only_latest_data`,
            `set_item`,
            'set_status',
            'destroy',
            'set_page',
            'set_paginate',
            'bulk_action',
            'clear_selected',
        ]),

        active_row(event) {
            const targetRow = event.target.closest('.table_rows');
            if (!targetRow) return;
            document.querySelectorAll('.table_rows.active').forEach(row => {
                if (row !== targetRow) row.classList.remove('active');
            });
            targetRow.classList.toggle('active');
        },

        updateStatus: async function (item) {
            let action = item.status == 'active' ? 'deactive' : 'active';
            let con = await window.s_confirm('Are you sure want to ' + action + ' ?');
            if (con) {
                this.set_item(item);
                this.set_only_latest_data(true);

                let response = await this.update_status();
                if (response.data.status === "success") {
                    await this.get_all();
                    window.s_alert(response.data?.message);
                    this.set_only_latest_data(true);
                } else {
                    window.s_warning(response.data?.message);
                }
            }
        },
        softDelete: async function (item) {
            let con = await window.s_confirm('Are you sure want to delete ?');
            if (con) {
                this.set_item(item);
                this.set_only_latest_data(true);

                let response = await this.soft_delete();
                if (response.data.status === "success") {
                    await this.get_all();
                    window.s_alert(response.data?.message);
                    this.set_only_latest_data(true);
                } else {
                    window.s_warning(response.data?.message);
                }
            }
        },
        restore_data: async function (item) {
            let con = await window.s_confirm('Restore');
            if (con) {
                this.set_item(item);
                this.set_only_latest_data(true);
                let response = await this.restore();
                if (response.data.status === "success") {
                    await this.get_all();
                    window.s_alert('Permanently deleted.');
                    this.set_only_latest_data(true);
                } else {
                    window.s_warning(response.data?.message);
                }
            }
        },


        destroy_data: async function (item) {
            let con = await window.s_confirm('Permanently delete');
            if (con) {
                this.set_item(item);
                this.set_only_latest_data(true);
                let response = await this.destroy();
                if (response.data.status === "success") {
                    await this.get_all();
                    window.s_alert('Permanently deleted.');
                    this.set_only_latest_data(true);
                } else {
                    window.s_warning(response.data?.message);
                }

            }
        },
        change_status: function (status = 'active') {
            if (status == 'trased') {
                this.is_trashed_data = true;
                console.log("dd", this.is_trashed_data);

            }
            this.set_only_latest_data(true);
            this.set_status(status);
            this.set_page(1);
            this.get_all();
            this.set_only_latest_data(true);
        },
        set_page_data: function (link) {
            try {
                let url = new URL(link.url);
                let page = url.searchParams.get('page')
                link.url ? this.set_page(parseInt(page)) : '';
                this.get_all();
            } catch (error) {

            }
        },
        set_per_page_limit: function () {
            this.set_paginate(event.target.value);
            this.get_all();
        },


        set_all_item_selected(event) {
            this.selected = event.target.checked ? [...this.all.data] : [];
        },

        set_item_selected(item, event) {
            const isChecked = event.target.checked;
            const selectedItems = new Set(this.selected);
            if (isChecked) {
                selectedItems.add(item);
            } else {
                selectedItems.delete(item);
            }
            this.selected = [...selectedItems];
        },
        isSelected(item) {
            return this.selected.some(selectedItem => selectedItem.id === item.id);
        },


        bulkActions: async function () {
            let action = event.target.value;
            let con = await window.s_confirm('Are you sure want to ' + action + ' items ?');
            if (con) {

                let selected_data = this.selected;
                selected_data = selected_data.map((item => item.id))
                this.set_only_latest_data(true);
                let response = await this.bulk_action(action, selected_data);
                if (response.data.status === "success") {
                    await this.get_all();
                    document.querySelector('.select_all_checkbox').checked = false;
                    this.clear_selected();
                    this.set_only_latest_data(false);
                    window.s_alert('You have ' + action + ' items ?');
                } else {
                    window.s_warning(response.data?.message);
                }

            }

        }


    },
    computed: {
        ...mapWritableState(data_store, [
            'all',
            "show_filter_canvas",
            'active_data_count',
            'inactive_data_count',
            'trased_data_count',
            'status',
            'selected',
            'paginate',
        ]),
        isAllSelected() {
            return (
                this.all?.data?.length > 0 &&
                this.all.data?.every(item => this.selected.some(s => s.id === item.id))
            );
        },

    },

    watch: {
        is_trashed_data: {
            handler: function (newValue, oldValue) {
                this.is_trashed_data = newValue;
            },
            immediate: true
        },
    }

};
</script>
