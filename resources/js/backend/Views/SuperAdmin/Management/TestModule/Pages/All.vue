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
                                <button class="btn btn-outline-success btn-sm "
                                    @click="set_show_filter_canvas">
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
                                            <input class="form-check-input ml-0 select_all_checkbox" type="checkbox" />
                                        </th>
                                        <th class="w-10">ID</th>
                                        <th> name</th>
                                        <th>email</th>
                                        <th>phone</th>
                                        <th>image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table_rows ">
                                        <td>
                                            <span class="icon" @click.prevent="active_row($event)"></span>
                                            <div class="table_action_btns ">
                                                <ul>
                                                    <li>
                                                        <a href="http://127.0.0.1:8000/super-admin#/user-managements/details/rahman-ziaur-57549203"
                                                            class="border-secondary"><i
                                                                class="fa fa-eye text-secondary"></i>
                                                            Show
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="http://127.0.0.1:8000/super-admin#/user-managements/edit/rahman-ziaur-57549203"
                                                            class="border-secondary"><i
                                                                class="fa fa-pencil-square-o text-info"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="/deactive" class="border-warning"><i
                                                                class="fa fa-ban text-warning"></i>
                                                            Deactive </a><!---->
                                                    </li>
                                                    <li>
                                                        <a href="/destroy" class="border-danger"><i
                                                                class="fa fa-trash text-danger"></i>
                                                            Destroy
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            <input class="form-check-input ml-0" type="checkbox" />
                                        </td>
                                        <td>49</td>
                                        <td>
                                            <div class="text-warning cursor-pointer">
                                                Rahman Ziaur
                                            </div>
                                        </td>
                                        <td>imziaur4u@gmail.com</td>
                                        <td></td>
                                        <td>
                                            <img src="https://files.etek.com.bd/uploads/google_user/2024-10-27-09550759639.jpg"
                                                alt="" style="height: 30px" />
                                        </td>
                                    </tr>
                                    <tr class="table_rows ">
                                        <td>
                                            <span class="icon" @click.prevent="active_row($event)"></span>
                                            <div class="table_action_btns ">
                                                <ul>
                                                    <li>
                                                        <a href="#/users/rahman-ziaur-57549203"
                                                            class="border-secondary"><i
                                                                class="fa fa-eye text-secondary"></i>
                                                            Show
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#/users/edit/rahman-ziaur-57549203"
                                                            class="border-secondary"><i
                                                                class="fa fa-pencil-square-o text-info"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="/deactive" class="border-warning"><i
                                                                class="fa fa-ban text-warning"></i>
                                                            Deactive </a><!---->
                                                    </li>
                                                    <li>
                                                        <a href="/destroy" class="border-danger"><i
                                                                class="fa fa-trash text-danger"></i>
                                                            Destroy
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            <input class="form-check-input ml-0" type="checkbox" />
                                        </td>
                                        <td>49</td>
                                        <td>
                                            <div class="text-warning cursor-pointer">
                                                Rahman Ziaur
                                            </div>
                                        </td>
                                        <td>imziaur4u@gmail.com</td>
                                        <td></td>
                                        <td>
                                            <img src="https://files.etek.com.bd/uploads/google_user/2024-10-27-09550759639.jpg"
                                                alt="" style="height: 30px" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mx-3">

                        <nav aria-label="" class="d-flex gap-2 align-items-center flex-wrap py-1" style="gap: 10px">
                            <ul class="pagination my-2" style="font-size: 11px">
                                <li class="page-item">
                                    <a class="page-link"><span>« Previous</span></a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link"
                                        href="https://app.etek.com.bd/api/v1/users?page=1"><span>1</span></a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link"
                                        href="https://app.etek.com.bd/api/v1/users?page=2"><span>2</span></a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="https://app.etek.com.bd/api/v1/users?page=2"><span>Next
                                            »</span></a>
                                </li>
                            </ul>
                            <div class="d-flex" style="gap: 5px">
                                <span></span><span>1</span><span>-</span><span>10</span><span>of</span><span>13</span>
                            </div>
                            <div class="d-flex" style="gap: 5px">
                                <span></span><span> Limit </span>
                                <select class="bg-transparent text-white rounded-1">
                                    <option value="10">10</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                    <option value="300">300</option>
                                    <option value="400">400</option>
                                    <option value="100">500</option>
                                </select>
                            </div>
                        </nav>
                    </div>
                    <div class="card-footer py-2">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="mr-2 mb-2">
                                <a href="http://127.0.0.1:8000/super-admin#/user-managements/create" class="btn action_btn btn-sm btn-info d-flex align-items-center">
                                    <i class="fa fa-edit mr-2"></i> Create
                                </a>
                            </div>
                            <div class="mr-2 mb-2">
                                <a href="" class="btn action_btn btn-sm btn-primary d-flex align-items-center">
                                    <i class="fa fa-print mr-2"></i> Export All
                                </a>
                            </div>
                            <div class="mr-2 mb-2">
                                <a href="" class="btn action_btn btn-sm btn-success d-flex align-items-center">
                                    <i class="fa fa fa fa-eye mr-2" ></i> Active
                                    (9)
                                </a>
                            </div>
                            <div class="mr-2 mb-2">
                                <a href="" class="btn action_btn btn-sm btn-warning d-flex align-items-center">
                                    <i class="fa fa fa-eye-slash mr-2" ></i> Deactive
                                    (0)
                                </a>
                            </div>
                            <div class="mr-2 mb-2">
                                <a href="" class="btn action_btn btn-sm btn-danger d-flex align-items-center">
                                    <i class="fa fa-trash mr-2" ></i> Deleted
                                    (0)
                                </a>
                            </div>
                            <div class="mr-2 mb-2">
                                <a href="" class="btn action_btn btn-sm btn-secondary d-flex align-items-center">
                                    <i class="fa fa-sign-out mr-2"></i> Export (9)
                                </a>
                            </div>
                            <div class="mr-2 mb-2">
                                <select class="form-control" style="width: 100px; height: 25px; font-size: 12px;">
                                    <option value="">Select action</option>
                                    <option value="active">Action</option>
                                    <option value="inactive">Deactive</option>
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
import { store as data_store } from "../Store";
import setup from "../Setup";

export default {
    data: () => ({
        setup,
    }),
    created: async function () {
        this.paginate = 10;
    },
    methods: {

        ...mapActions(data_store, ['set_show_filter_canvas', 'set_show_filter_canvas']),

        active_row(event) {
            const targetRow = event.target.closest('.table_rows');
            if (!targetRow) return;
            document.querySelectorAll('.table_rows.active').forEach(row => {
                if (row !== targetRow) row.classList.remove('active');
            });
            targetRow.classList.toggle('active');
        }
    },
    computed: {

        ...mapWritableState(data_store, ["show_filter_canvas"]),
    },
    components: {},
};
</script>

<style scope>
@media (max-width: 576px) {
    .action_btn i {
        margin-right: 0.5rem;
        font-size: 14px;
        /* Adjust icon size */
    }

    .action_btn {
        padding: 0.3rem 0.6rem;
        font-size: 12px;
        /* Adjust button text size */
    }

    .form-control {
        width: 100%;
        /* Full width on smaller screens */
    }
}
</style>
