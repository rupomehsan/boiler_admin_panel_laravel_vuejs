<?php

use Illuminate\Support\Str;

if (!function_exists('viewAll')) {
    function viewAll($moduleName, $fields)
    {

        $moduleName = Str::singular((Str::snake($moduleName)));

        $content = <<<"EOD"
                    <template>
                    <div class="container-fluid">
                        <!-- Container-fluid starts -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <h5 class="text-capitalize"> {{ page_title }}</h5>
                                        <div v-if="child_items.length" class="btn-group m-1 "
                                            onclick="document.getElementById('table-actions').classList.toggle('show')">
                                            <button type="button" class="btn btn-light waves-effect waves-light">Actions</button>
                                            <button type="button"
                                                class="btn btn-light split-btn-light dropdown-toggle dropdown-toggle-split waves-effect waves-light"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <span class="caret"></span>
                                            </button>
                                            <div class="dropdown-menu" style="" id="table-actions">
                                                <a href="javaScript:void();" class="dropdown-item" @click="bulkActions('delete')">Delete</a>
                                                <a href="javaScript:void();" class="dropdown-item" @click="bulkActions('active')">Active</a>
                                                <a href="javaScript:void();" class="dropdown-item"
                                                    @click="bulkActions('inactive')">Inactive</a>

                                            </div>
                                        </div>
                                        <div>
                                            <router-link class="btn btn-outline-warning btn-sm"
                                                :to="{ name: `Create\${route_prefix}` }">Create</router-link>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive h-80vh">
                                        <table class="table table-hover text-center table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="w-10"><input type="checkbox" v-model="parent_item"
                                                    @click="toggleParentCheckbox"></th>
                                                    <th class="text-start">SL</th>
                EOD;
        if (count($fields)) {
            foreach ($fields as $fieldName) {
                $label = Str::of($fieldName[0])->snake()->replace('_', ' ');
                $content .=  "<th>  $label </th> \n";
            }
        }
        $content .= <<<"EOD"
                                                    <th>status</th>
                                                    <th class="text-end">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody v-if="all_data.data?.length">
                                                <tr v-for="(item, index) in all_data.data" :key="item.id">
                                                    <td class="w-10">
                                                       <input @click="toggleChildCheckbox(item.id)"
                                                      :checked="child_items.includes(item.id)" type="checkbox">
                                                    </td>
                                                    <td class="text-start">{{ index + 1 }}</td>
            EOD;
        if (count($fields)) {
            foreach ($fields as $fieldName) {
                $content .=  "<th> {{ item.$fieldName[0]}} </th> \n";
            }
        }
        $content .= <<<"EOD"
                                                    <td>{{ item.status }}</td>
                                                    <td style="width: 100px;">
                                                        <div class="d-flex justify-content-between gap-2">
                                                            <!-- <router-link class="btn btn-sm btn-outline-success "
                                                                :to="{ name: `Create\${route_prefix}` }">
                                                                <i class="fa fa-eye"></i>
                                                            </router-link> -->
                                                            <router-link class="btn btn-sm btn-outline-warning mx-2" :to="{
                                                                name: `Create\${route_prefix}`, query: {
                                                                    id: item.id,
                                                                },
                                                            }">
                                                                <i class="fa fa-pencil"></i>
                                                            </router-link>
                                                            <a @click.prevent="delete_data(item.id)" class="btn btn-sm btn-outline-danger ">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tbody v-else>
                                            <tr>
                                                <td colspan="8" class="alert alert-success">
                                                    No Data found
                                                </td>
                                            </tr>
                                        </tbody>
                                        </table>
                                        <hr>

                                    </div>
                                    <div class="mx-5">
                                        <pagination :data="all_data" :method="get_all_data" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Container-fluid starts -->
                    </div>
                    </template>

                    <script>
                    import { mapActions, mapState } from 'pinia'
                    import { {$moduleName}_setup_store } from './setup/store';
                    import setup from "./setup";
                    export default {
                        data: () => ({
                            route_prefix: '',
                            page_title: '',
                            parent_item: false,
                            child_items: []
                        }),
                        created: function () {
                            this.route_prefix = setup.route_prefix;
                            this.page_title = setup.page_title;
                            this.get_all_data()
                        },
                        methods: {
                            ...mapActions({$moduleName}_setup_store, {
                                get_all_data: 'all',
                                delete_data: 'delete',
                                bulk_action: 'bulk_action',
                            }),
                            toggleParentCheckbox() {
                                this.child_items = event.target.checked ? this.all_data.data.map(item => item.id) : []
                            },

                            toggleChildCheckbox(id) {
                                let isChecked = event.target.checked
                                if (isChecked) {
                                    this.child_items.push(id)
                                } else {
                                    this.child_items = this.child_items.filter(item => item != id)
                                }

                            },
                            bulkActions(action) {
                                this.bulk_action(action, this.child_items)
                                this.parent_item = false
                                this.child_items = []
                            }

                        },
                        computed: {
                            ...mapState({$moduleName}_setup_store, {
                                all_data: 'all_data',
                            })
                        }
                    }
                    </script>

                    <style></style>

        EOD;

        return $content;
    }
}


if (!function_exists('viewForm')) {
    function viewForm($moduleName)
    {

        $moduleName = Str::singular((Str::snake($moduleName)));
        $content = <<<"EOD"
                    <template>
                    <div>
                        <form @submit.prevent="submitHandler">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h5 class="text-capitalize">{{ param_id ? 'Update' : 'Create' }} new {{ route_prefix }}</h5>
                                    <div>
                                        <router-link class="btn btn-outline-warning btn-sm" :to="{ name: `All\${route_prefix}` }">All {{
                                            route_prefix }}</router-link>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12" v-for="(form_field, index) in form_fields" :key="index">
                                            <common-input :label="form_field.label" :type="form_field.type" :name="form_field.name"
                                                :multiple="form_field.multiple" :value="form_field.value"
                                                :data_list="form_field.data_list" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-light btn-square px-5"><i class="icon-lock"></i>
                                            Submit</button>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </template>

                <script>
                import { mapActions, mapState } from 'pinia'
                import { {$moduleName}_setup_store } from './setup/store';
                import setup from "./setup";
                import form_fields from "./setup/form_fields";

                export default {
                    data: () => ({
                        route_prefix: '',
                        form_fields,
                        param_id: null,
                    }),
                    created: async function () {
                        let id = this.\$route.query.id;
                        this.route_prefix = setup.route_prefix;
                        await this.get_all_data()
                        if (id) {
                            this.param_id = id;
                            await this.get_single_data(id);
                            if (this.single_data) {
                                this.form_fields.forEach((field, index) => {
                                    Object.entries(this.single_data).forEach((value) => {
                                        if (field.name == value[0]) {
                                            this.form_fields[index].value = value[1];
                                        }


                                    });
                                });
                            }
                        } else {
                            this.form_fields.forEach((item) => {
                                item.value = "";
                            });
                        }
                    },
                    methods: {
                        ...mapActions({$moduleName}_setup_store, {
                            get_all_data: 'all',
                            get_single_data: 'get',
                            store_data: 'store',
                            update_data: 'update',
                        }),

                        submitHandler: async function (\$event) {
                            if (this.param_id) {
                                let response = await this.update_data(\$event.target, this.param_id);
                                if (response.data.status === "success") {
                                    window.s_alert(response.data.message);
                                    this.\$router.push({ name: `All\${this . route_prefix}` });
                                }
                            } else {
                                let response = await this.store_data(\$event.target);
                                if (response.data.status === "success") {
                                    window.s_alert(response.data.message);
                                    this.\$router.push({ name: `All\${this . route_prefix}` });
                                }
                            }
                        },


                    },

                    computed: {
                        ...mapState({$moduleName}_setup_store, {
                            single_data: "single_data",
                            all_data: 'all_data',
                        }),
                    },


                }
                </script>
        EOD;

        return $content;
    }
}


if (!function_exists('ViewFormField')) {
    function ViewFormField($moduleName, $fields)
    {

        $content = <<<EOD
        export default [
        EOD;

        if (count($fields)) {
            foreach ($fields as $fieldName) {
                // dd($fieldName);
                $label = Str::of($fieldName[0])->snake()->replace('_', ' ');
                $content .= "\n\t{\n";
                $content .= "\t\tname: \"$fieldName[0]\",\n";
                $content .= "\t\tlabel: \"Enter your $label\",\n";

                if (count($fieldName) > 1) {
                    $type = $fieldName[1];
                    switch ($type) {
                        case 'longtext':
                            $content .= "\t\ttype: \"textarea\",\n";
                            break;
                        case 'date':
                            $content .= "\t\ttype: \"date\",\n";
                            break;
                        case 'number':
                        case 'integer':
                            $content .= "\t\ttype: \"number\",\n";
                            break;
                        case 'file':
                            $content .= "\t\ttype: \"file\",\n";
                            $content .= "\t\tmultiple: \"false\",\n";
                            break;
                        case 'select':
                        case 'boolean':
                        case 'tinyint':
                            $content .= "\t\ttype: \"select\",\n";
                            $content .= "\t\tlabel: \"Select default  $label\",\n";
                            $content .= "\t\tmultiple: false,\n";
                            $content .= "\t\tdata_list: [\n";
                            $content .= "\t\t\t{\n";
                            $content .= "\t\t\t\tlabel: \"Active\",\n";
                            $content .= "\t\t\t\tvalue: \"active\",\n";
                            $content .= "\t\t\t},\n";
                            $content .= "\t\t\t{\n";
                            $content .= "\t\t\t\tlabel: \"Inactive\",\n";
                            $content .= "\t\t\t\tvalue: \"inactive\",\n";
                            $content .= "\t\t\t},\n";
                            $content .= "\t\t],\n";
                            break;
                        case 'password':
                            $content .= "\t\ttype: \"password\",\n";
                            break;
                        default:
                            $content .= "\t\ttype: \"text\",\n";
                    }
                } else {
                    $content .= "\t\ttype: \"text\",\n";
                }
                $content .= "\t\tvalue: \"\",\n";
                $content .= "\t},\n";
            }
        }

        $content .= "];\n";


        return $content;
    }
}

if (!function_exists('ViewIndex')) {
    function ViewIndex($moduleName, $role)
    {
        $prefix = Str::singular((ucfirst($moduleName)));

        $content = <<<"EOD"
        let setup = {
            page_title: `{$prefix} Management`,
            route_prefix: `{$prefix}`,
            role_prefix:`{$role}`
        }
        export default setup;
        EOD;
        return $content;
    }
}

if (!function_exists('ViewLayout')) {
    function ViewLayout($module)
    {
        $content = <<<"EOD"
        <template>
            <router-view></router-view>
        </template>

        <script>
        import setup from ".";

        let page_title = setup.page_title;
        export default {
            data: () => ({
                page_title,
            })
        }
        </script>

        <style></style>

        EOD;

        return $content;
    }
}

if (!function_exists('ViewRoute')) {
    function ViewRoute($moduleName)
    {


        $moduleName = Str::singular((Str::kebab($moduleName)));

        $content = <<<"EOD"
        import setup from ".";
        import All from "../All.vue";
        import Form from "../Form.vue";
        import Layout from "./Layout.vue";

        let route_prefix = setup.route_prefix;

        const routes =
        {
            path: '{$moduleName}',
            component: Layout,
            children: [
                {
                    path: '',
                    name: "All" + route_prefix,
                    component: All,
                },
                {
                    path: "create",
                    name: "Create" + route_prefix,
                    component: Form,
                },

            ]
        };


        export default routes;

        EOD;

        return $content;
    }
}

if (!function_exists('ViewStore')) {
    function ViewStore($moduleName)
    {
        $apiName = Str::plural((Str::kebab($moduleName)));
        $store = Str::singular((Str::snake($moduleName)));
        $content = <<<"EOD"
        import { defineStore } from "pinia";

        export const {$store}_setup_store = defineStore("{$store}_setup_store", {
            state: () => ({
                all_data: {},
                single_data: {},
                role_data: {},
                api:"{$apiName}/"
            }),
            getters: {
                doubleCount: (state) => state.count * 2,
            },
            actions: {

                all: async function (url) {
                    let response;
                    if (url) {
                        response = await axios.get(url);
                    } else {
                        response = await axios.get(this.api);
                    }
                    this.all_data = response.data.data;
                },

                get: async function (id) {
                    let response = await axios.get(this.api+id);
                    response = response.data.data;
                    this.single_data = response;
                },

                store: async function (form) {
                    let formData = new FormData(form);
                    let response = await axios.post(this.api, formData);
                    return response;
                },

                update: async function (form, id) {
                    let formData = new FormData(form);
                    let response = await axios.post(`\${this.api}\${id}?_method=PATCH`, formData);
                    return response;
                },

                delete: async function (id) {
                    var data = await window.s_confirm();
                    if (data) {
                        let response = await axios.delete(this.api+id);
                        window.s_alert("Data deleted");
                        this.all();
                        console.log(response.data);
                    }
                },
                bulk_action: async function (action, data) {
                    let response = await axios.post(`\${this.api}bulk-action`, { action, data })
                    if (response.data.status === "success") {
                        window.s_alert(response.data.message);
                        this.all();
                    }
                },

                // additional function
                // additional function


            },
        });

        EOD;

        return $content;
    }
}
