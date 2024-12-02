<template>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <!-- Title Section -->
                            <div class="col-12 col-md-3 mb-2 mb-md-0">
                                <h5 class="text-capitalize mb-0">
                                    {{ setup.all_page_title }}
                                </h5>
                            </div>

                            <!-- Search Input -->
                            <div class="col-12 col-md-6 mb-2 mb-md-0">
                                <input
                                    class="form-control"
                                    @keyup="(e) => set_search_key(e)"
                                    placeholder="Search"
                                />
                            </div>

                            <!-- Sorting Button -->
                            <div
                                class="col-12 col-md-3 text-md-right text-sm-left"
                            >
                                <button
                                    class="btn btn-outline-success btn-sm"
                                    @click="set_show_filter_canvas"
                                >
                                    <i class="fa fa-gear mx-2"></i>Filter
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div
                            class="table-responsive table_responsive card_body_fixed_height"
                        >
                            <table
                                class="table table-hover text-center table-bordered"
                            >
                                <thead>
                                    <table-head />
                                </thead>
                                <tbody v-if="all?.data?.length">
                                    <table-body :data="all?.data" />
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mx-3">
                        <nav
                            aria-label=""
                            class="d-flex gap-2 align-items-center"
                            style="gap: 10px"
                        >
                            <ul class="pagination my-2" style="font-size: 11px">
                                <template
                                    v-for="(link, index) in all?.links"
                                    :key="index"
                                >
                                    <li
                                        class="page-item"
                                        :class="{ active: link.active }"
                                    >
                                        <a
                                            class="page-link"
                                            :class="
                                                all?.current_page ==
                                                    all?.last_page &&
                                                all?.links.length - 1 == index
                                                    ? 'disabled'
                                                    : ''
                                            "
                                            @click.prevent="set_page_data(link)"
                                            :href="link.url"
                                            v-html="
                                                `<span>${link.label}</span>`
                                            "
                                        >
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
                                <select
                                    v-model="paginate"
                                    @change="set_per_page_limit"
                                    class="bg-transparent text-white rounded-1"
                                >
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
                                <router-link
                                    :to="{
                                        name: `Create${setup.route_prefix}`,
                                    }"
                                    class="btn action_btn mr-2 btn-sm btn-info d-flex align-content-center align-items-center"
                                >
                                    <i class="fa fa-edit mr-2"></i>
                                    Create
                                </router-link>
                            </div>
                            <div class="mr-2 mb-2">
                                <a
                                    href=""
                                    @click.prevent="() => export_all_csv()"
                                    class="btn action_btn mr-2 btn-sm btn-primary d-flex align-content-center align-items-center"
                                >
                                    <i class="fa fa-print mr-2"></i>
                                    Export All
                                </a>
                            </div>
                            <div class="mr-2 mb-2" v-if="this.selected?.length">
                                <a
                                    href=""
                                    @click.prevent="
                                        export_selected_csv(selected)
                                    "
                                    class="btn action_btn btn-sm btn-secondary d-flex align-items-center"
                                >
                                    <i class="fa fa-sign-out mr-2"></i> Export
                                    ({{ this.selected?.length }})
                                </a>
                            </div>
                            <div class="mr-2 mb-2">
                                <a
                                    href=""
                                    @click.prevent="
                                        import_csv_modal_show = true
                                    "
                                    class="btn action_btn btn-sm btn-secondary d-flex align-items-center"
                                >
                                    <i class="fa fa-download mr-2"></i> Import
                                </a>
                            </div>
                            <div class="mr-2 mb-2">
                                <a
                                    href=""
                                    @click.prevent="change_status(`active`)"
                                    class="btn action_btn btn-sm btn-success d-flex align-items-center"
                                >
                                    <i class="fa fa fa fa-eye mr-2"></i> Active
                                    ({{ active_data_count }})
                                </a>
                            </div>
                            <div class="mr-2 mb-2">
                                <a
                                    href=""
                                    @click.prevent="change_status(`inactive`)"
                                    class="btn action_btn btn-sm btn-warning d-flex align-items-center"
                                >
                                    <i class="fa fa fa-eye-slash mr-2"></i>
                                    Inactive ({{ inactive_data_count }})
                                </a>
                            </div>
                            <div class="mr-2 mb-2">
                                <a
                                    href=""
                                    @click.prevent="change_status(`trased`)"
                                    class="btn action_btn btn-sm btn-danger d-flex align-items-center"
                                >
                                    <i class="fa fa-trash mr-2"></i> Trased ({{
                                        trased_data_count
                                    }})
                                </a>
                            </div>

                            <div class="mr-2 mb-2" v-if="this.selected?.length">
                                <select
                                    class="form-control"
                                    style="
                                        width: 100px;
                                        height: 30px;
                                        font-size: 12px;
                                    "
                                    @change="bulkActions"
                                >
                                    <option disabled selected>
                                        Select action
                                    </option>
                                    <option value="inactive">Inactive</option>
                                    <option value="active">Action</option>
                                    <option value="soft_delete">
                                        Soft Delete
                                    </option>
                                    <option value="restore">Restore</option>
                                    <option value="destroy">Destroy</option>
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
                            {$tableRows}
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="off_canvas_overlay"></div>
        </div>
        <div
            class="off_canvas data_filter"
            :class="`${show_filter_canvas ? 'active' : ''}`"
        >
            <div class="off_canvas_body">
                <div class="header">
                    <h3 class="heading_text">Filter</h3>
                    <button
                        class="close_button"
                        @click="set_show_filter_canvas(false)"
                    >
                        <span class="fa fa-close border p-2"></span>
                    </button>
                </div>
                <div class="data_content">
                    <div class="filter_item">
                        <label for="start_date">Start Date</label>
                        <label
                            for="start_date"
                            class="text-capitalize d-block date_custom_control"
                        >
                            <input
                                v-model="start_date"
                                type="date"
                                id="start_date"
                                name="start_date"
                                class="form-control"
                            />
                            <!-- <div class="form-control preview"></div> -->
                        </label>
                    </div>
                    <div class="filter_item">
                        <label for="end_date">End Date</label>
                        <label
                            for="end_date"
                            class="text-capitalize d-block date_custom_control"
                        >
                            <input
                                v-model="end_date"
                                type="date"
                                id="end_date"
                                name="end_date"
                                class="form-control"
                            />
                            <!-- <div class="form-control preview"></div> -->
                        </label>
                    </div>
                    <div class="filter_item">
                        <label for="sort_by_col">Sort By Col</label
                        ><label
                            for="sort_by_col"
                            class="text-capitalize d-block date_custom_control"
                        >
                            <select v-model="sort_by_col" class="form-control">
                                <option v-for="col in sort_by_cols" :key="col">
                                    {{ col }}
                                </option>
                            </select>
                        </label>
                    </div>
                    <div class="filter_item">
                        <label for="sort_by_col">Sort Type</label
                        ><label
                            for="sort_by_col"
                            class="text-capitalize d-block date_custom_control"
                        >
                            <select v-model="sort_type" class="form-control">
                                <option
                                    v-for="col in ['ASC', 'DESC']"
                                    :key="col"
                                >
                                    {{ col }}
                                </option>
                            </select>
                        </label>
                    </div>
                    <div class="filter_item">
                        <button
                            @click.prevent="get_all()"
                            type="button"
                            class="btn btn-sm btn-outline-info"
                        >
                            Submit
                        </button>
                    </div>
                </div>
            </div>
            <div class="off_canvas_overlay"></div>
        </div>
        <div
            class="modal fade"
            :class="`${import_csv_modal_show ? 'show d-block' : 'd-none'}`"
            id="primarymodal"
            aria-modal="true"
        >
            <div class="modal-dialog modal-dialog-centered">
                <form @submit.prevent="FileUploadHandler">
                    <div class="modal-content border-primary">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white">
                                Import {{ setup.prefix }}
                            </h5>
                            <button
                                @click="import_csv_modal_show = false"
                                type="button"
                                class="close text-white"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="">
                                <label for="">Upload file</label>
                                <input
                                    type="file"
                                    name="file"
                                    class="form-control"
                                    required
                                />
                            </div>
                            <p class="mt-3">
                                Please check the sample CSV file below to ensure
                                compatibility with the demo data import.
                            </p>
                            <a
                                href=""
                                @click.prevent="export_demo_csv"
                                class="btn btn-sm btn-primary"
                                >Download Demo CSV</a
                            >
                        </div>
                        <div class="modal-footer">
                            <button
                                @click="import_csv_modal_show = false"
                                type="button"
                                class="btn btn-light"
                                data-dismiss="modal"
                            >
                                <i class="fa fa-times"></i> Close
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-download"></i> Import
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
/** plugins */
import { mapActions, mapWritableState } from "pinia";
import setup from "../setup";
import { store as data_store } from "../store";
import export_all_csv from "../helpers/export_all_csv";
import export_selected_csv from "../helpers/export_selected_csv";
import export_demo_csv from "../helpers/export_demo_csv";
import debounce from "../helpers/debounce";

import TableHead from '../components/all_data_page/TableHead.vue';
import TableBody from '../components/all_data_page/TableBody.vue';
export default {
    
    components: {
        TableHead,
        TableBody,
    },

    data: () => ({
        setup,
        is_trashed_data: false,
        import_csv_modal_show: false,
        filePath:
            "resources/js/backend/Views/SuperAdmin/Management/TestModule/helpers/demo.csv",
    }),
    created: async function () {
        await this.get_all();
    },
    methods: {
        export_all_csv,
        export_selected_csv,
        export_demo_csv,
        ...mapActions(data_store, [
            "get_all",
            `restore`,
            `soft_delete`,
            `update_status`,
            "destroy",
            "bulk_action",
            "clear_selected",
            "import_data",
            "set_show_filter_canvas",
            `set_only_latest_data`,
            `set_item`,
            "set_filter_criteria",
            "set_page",
            "set_status",
            "set_paginate",
        ]),

        active_row(event) {
            const targetRow = event.target.closest(".table_rows");
            if (!targetRow) return;
            document.querySelectorAll(".table_rows.active").forEach((row) => {
                if (row !== targetRow) row.classList.remove("active");
            });
            targetRow.classList.toggle("active");
        },

        updateStatus: async function (item) {
            let action = item.status == "active" ? "deactive" : "active";
            let con = await window.s_confirm(
                "Are you sure want to " + action + " ?"
            );
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
            let con = await window.s_confirm("Are you sure want to delete ?");
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
            let con = await window.s_confirm("Restore");
            if (con) {
                this.set_item(item);
                this.set_only_latest_data(true);
                let response = await this.restore();
                if (response.data.status === "success") {
                    await this.get_all();
                    window.s_alert("Permanently deleted.");
                    this.set_only_latest_data(true);
                } else {
                    window.s_warning(response.data?.message);
                }
            }
        },

        destroy_data: async function (item) {
            let con = await window.s_confirm("Permanently delete");
            if (con) {
                this.set_item(item);
                this.set_only_latest_data(true);
                let response = await this.destroy();
                if (response.data.status === "success") {
                    await this.get_all();
                    window.s_alert("Permanently deleted.");
                    this.set_only_latest_data(true);
                } else {
                    window.s_warning(response.data?.message);
                }
            }
        },
        change_status: function (status = "active") {
            if (status == "trased") {
                this.is_trashed_data = true;
            } else {
                this.is_trashed_data = false;
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
                let page = url.searchParams.get("page");
                link.url ? this.set_page(parseInt(page)) : "";
                this.get_all();
            } catch (error) {}
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
            return this.selected.some(
                (selectedItem) => selectedItem.id === item.id
            );
        },

        bulkActions: async function () {
            let action = event.target.value;
            let con = await window.s_confirm(
                "Are you sure want to " + action + " items ?"
            );
            if (con) {
                let selected_data = this.selected;
                selected_data = selected_data.map((item) => item.id);
                this.set_only_latest_data(true);
                let response = await this.bulk_action(action, selected_data);
                if (response.data.status === "success") {
                    await this.get_all();
                    document.querySelector(
                        ".select_all_checkbox"
                    ).checked = false;
                    this.clear_selected();
                    this.set_only_latest_data(false);
                    window.s_alert("You have " + action + " items ?");
                } else {
                    window.s_warning(response.data?.message);
                }
            }
        },

        FileUploadHandler: async function ($event) {
            let response = await this.import_data($event);
            if (response.data.status === "success") {
                await this.get_all();
                window.s_alert(response.data.message);
                this.set_only_latest_data(true);
                this.import_csv_modal_show = false;
            } else {
                window.s_warning(response.data?.message);
            }
        },

        set_search_key: debounce(async function (event) {
            let value = event.target.value;
            this.search_key = value;
            this.page = 1;

            this.only_latest_data = true;
            await this.get_all();
            this.only_latest_data = false;
        }, 500),
    },
    computed: {
        ...mapWritableState(data_store, [
            "all",
            "show_filter_canvas",
            "active_data_count",
            "inactive_data_count",
            "trased_data_count",
            "status",
            "selected",
            "paginate",
            "sort_type",
            "sort_by_cols",
            "sort_by_col",
            "start_date",
            "end_date",
            "search_key",
            "page",
        ]),
        isAllSelected() {
            return (
                this.all?.data?.length > 0 &&
                this.all.data?.every((item) =>
                    this.selected.some((s) => s.id === item.id)
                )
            );
        },
    },

    watch: {
        is_trashed_data: {
            handler: function (newValue, oldValue) {
                this.is_trashed_data = newValue;
            },
            immediate: true,
        },

        start_date: {
            handler: function (v) {
                let data = {
                    start_date: v,
                };
                this.set_filter_criteria(data);
            },
            deep: true,
        },
        end_date: {
            handler: function (v) {
                let data = {
                    end_date: v,
                };
                this.set_filter_criteria(data);
            },
            deep: true,
        },
    },
};
</script>
