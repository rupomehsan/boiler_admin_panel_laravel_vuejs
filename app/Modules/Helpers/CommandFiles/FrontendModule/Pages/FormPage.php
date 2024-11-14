<?php

use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
|
|--------------------------------------------------------------------------
|
*/

if (!function_exists('FormPage')) {
    function FormPage()
    {

        $content = <<<"EOD"
        <template>
            <div>

                <form @submit.prevent="submitHandler">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="text-capitalize">
                                {{ param_id ? `\${setup . edit_page_title}` : `\${setup . create_page_title}` }}

                            </h5>
                            <div>
                                <router-link v-if="item.slug" class="btn btn-outline-info mr-2 btn-sm" :to="{
                                    name: `Details\${setup . route_prefix}`,
                                    params: { id: item.slug },
                                }">
                                    {{ setup.details_page_title }}
                                </router-link>
                                <router-link class="btn btn-outline-warning btn-sm" :to="{ name: `All\${setup . route_prefix}` }">
                                    {{ setup.all_page_title }}
                                </router-link>
                            </div>
                        </div>
                        <div class="card-body card_body_fixed_height">
                            <div class="row">
                                <template v-for="(form_field, index) in form_fields" v-bind:key="index">

                                        <common-input :label="form_field.label" :type="form_field.type" :name="form_field.name"
                                            :multiple="form_field.multiple" :value="form_field.value"
                                            :data_list="form_field.data_list"
                                            :is_visible="form_field.is_visible" :row_col_class="form_field.row_col_class"
                                            />
                                   
                                </template>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-light btn-square px-5">
                                <i class="icon-lock"></i>
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </template>

        <script>
        import { mapActions, mapState } from "pinia";
        import { store } from "../store";
        import setup from "../setup";
        import form_fields from "../setup/form_fields";

        export default {
            data: () => ({
                setup,
                form_fields,
                param_id: null,
            }),
            created: async function () {
                let id = (this.param_id = this.\$route.params.id);
                this.reset_fields();
                if (id) {
                    this.set_fields(id);
                }
            },
            methods: {
                ...mapActions(store, {
                    create: "create",
                    update: "update",
                    details: "details",
                    get_all: "get_all",
                    set_only_latest_data: "set_only_latest_data",
                }),
                reset_fields: function () {
                    this.form_fields.forEach((item) => {
                        item.value = "";
                    });
                },
                set_fields: async function (id) {
                    this.param_id = id;
                    await this.details(id);
                    if (this.item) {
                        this.form_fields.forEach((field, index) => {
                            Object.entries(this.item).forEach((value) => {
                                if (field.name == value[0]) {
                                    this.form_fields[index].value = value[1];
                                }
                            });
                        });
                    }
                },

                submitHandler: async function (\$event) {
                    this.set_only_latest_data(true);
                    if (this.param_id) {
                        let response = await this.update(\$event);
                        // await this.get_all();
                        if ([200, 201].includes(response.status)) {
                            window.s_alert("data updated");
                            this.\$router.push({ name: `Details\${this . setup . route_prefix}` });
                        }
                    } else {
                        let response = await this.create(\$event);
                        // await this.get_all();
                        if ([200, 201].includes(response.status)) {
                            window.s_alert("data created");
                            this.\$router.push({ name: `All\${this . setup . route_prefix}` });
                        }
                    }
                },
            },

            computed: {
                ...mapState(store, {
                    item: "item",
                }),
            },
        };
        </script>

        EOD;

        return $content;
    }
}
