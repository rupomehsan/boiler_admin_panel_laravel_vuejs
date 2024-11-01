<template>
    <div>
        <form @submit.prevent="submitHandler">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="text-capitalize">
                        Details {{ setup.route_prefix }}
                    </h5>
                    <div>
                        <router-link
                            class="btn btn-outline-warning btn-sm"
                            :to="{ name: `All${setup.route_prefix}` }"
                        >
                            All {{ setup.route_prefix }}
                        </router-link>
                    </div>
                </div>
                <div class="card-body card_body_fixed_height">
                    <div class="row">
                        <div class="col-lg-8">
                            <table class="table quick_modal_table">
                                <tbody>
                                    <tr>
                                        <th colspan="3">
                                            <img
                                                height="200"
                                                class="w-100"
                                                :src="item.image"
                                                alt=""
                                            />
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Title</th>
                                        <th>:</th>
                                        <th>
                                            {{ item.title }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Short des</th>
                                        <th>:</th>
                                        <th>
                                            {{ item.short_des }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Offer title</th>
                                        <th>:</th>
                                        <th>
                                            {{ item.offer_title }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Button url</th>
                                        <th>:</th>
                                        <th>
                                            {{ item.button_url }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Is show</th>
                                        <th>:</th>
                                        <th>
                                            {{
                                                item.is_show == 1 ? "Yes" : "No"
                                            }}
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <router-link
                        class="btn btn-outline-warning btn-sm"
                        :to="{
                            name: `Edit${setup.route_prefix}`,
                            params: { id: item.slug },
                        }"
                    >
                        Edit {{ setup.route_prefix }}
                    </router-link>

                    <a
                        href=""
                        v-if="item.prev_slug"
                        @click.prevent="get_data(item.prev_slug)"
                        class="btn btn-secondary btn-sm ml-2"
                    >
                        <i class="fa fa-angle-left"></i>
                        Previous {{ setup.route_prefix }} ({{
                            item.prev_count
                        }})
                    </a>

                    <a
                        href=""
                        v-if="item.next_slug"
                        @click.prevent="get_data(item.next_slug)"
                        class="btn btn-secondary btn-sm ml-2"
                    >
                        Next {{ setup.route_prefix }} ({{ item.next_count }})
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { mapActions, mapState, mapWritableState } from "pinia";
import { store } from "../Store";
import setup from "../Setup";

export default {
    data: () => ({
        setup,
    }),
    created: async function () {
        let id = (this.param_id = this.$route.params.id);
        await this.get_data(id);
    },
    methods: {
        ...mapActions(store, {
            details: "details",
        }),
        get_data: async function (slug) {
            this.item = {};
            await this.details(slug);
        },
    },
    computed: {
        ...mapWritableState(store, {
            item: "item",
        }),
    },
};
</script>
