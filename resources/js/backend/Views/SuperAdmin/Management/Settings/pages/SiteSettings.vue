<template>
    <div class="container-fluid">
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <h4 class="page-title">Site Settings</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10">
                <div class="card" id="site_settings">
                    <div class="card-body">
                        <div class="d-flex">
                            <ul
                                class="flex-column nav nav-tabs nav-tabs-primary top-icon nav-justified card"
                            >
                                <li
                                    class="nav-item"
                                    @click="tab = 'bassic_settings'"
                                >
                                    <a
                                        :class="
                                            tab == 'bassic_settings'
                                                ? ' active'
                                                : ''
                                        "
                                        href="javascript:void();"
                                        data-target="#bassic_settings"
                                        data-toggle="pill"
                                        class="nav-link"
                                        ><i class="icon-note"></i>
                                        <span class="hidden-xs"
                                            >Basic Settings</span
                                        ></a
                                    >
                                    <hr />
                                </li>
                                <li
                                    class="nav-item"
                                    @click="tab = 'seo_settings'"
                                >
                                    <a
                                        :class="
                                            tab == 'seo_settings'
                                                ? 'active'
                                                : ''
                                        "
                                        href="javascript:void();"
                                        data-target="#seo_settings"
                                        data-toggle="pill"
                                        class="nav-link"
                                        ><i class="icon-note"></i>
                                        <span class="hidden-xs"
                                            >SEO Settings</span
                                        ></a
                                    >
                                    <hr />
                                </li>

                                <li
                                    class="nav-item"
                                    @click="tab = 'social_link'"
                                >
                                    <a
                                        :class="
                                            tab == 'social_link'
                                                ? ' active'
                                                : ''
                                        "
                                        href="javascript:void();"
                                        data-target="#social_link"
                                        data-toggle="pill"
                                        class="nav-link"
                                        ><i class="icon-note"></i>
                                        <span class="hidden-xs"
                                            >Social Links information</span
                                        ></a
                                    >
                                    <hr />
                                </li>
                                <li class="nav-item" @click="tab = 'smtp'">
                                    <a
                                        :class="tab == 'smtp' ? ' active' : ''"
                                        href="javascript:void();"
                                        data-target="#smtp"
                                        data-toggle="pill"
                                        class="nav-link"
                                        ><i class="icon-note"></i>
                                        <span class="hidden-xs"
                                            >SMTP Settings</span
                                        ></a
                                    >
                                    <hr />
                                </li>
                            </ul>
                            <div class="ml-2 flex-grow-1 tab-content p-3 card">
                                <div
                                    v-if="tab == 'bassic_settings'"
                                    :class="
                                        tab == 'bassic_settings'
                                            ? ' active'
                                            : ''
                                    "
                                    class="tab-pane active"
                                    id="bassic_settings"
                                >
                                    <form @submit.prevent="SiteSettingsHandler"
                                        enctype="multipart/form-data"
                                    >
                                        <div class="form-group row">
                                            <label
                                                class="col-lg-3 col-form-label form-control-label"
                                                >Site Name</label
                                            >
                                            <div class="col-lg-9">
                                                <input
                                                    name="site_name"
                                                    class="form-control"
                                                    type="text"
                                                    :value="`${get_setting_value(
                                                        'site_name'
                                                    )}`"
                                                    placeholder="Enter site name"
                                                />
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group row">
                                            <label
                                                class="col-lg-3 col-form-label form-control-label"
                                                >Email</label
                                            >
                                            <div class="col-lg-9">
                                                <input
                                                    name="email"
                                                    class="form-control"
                                                    type="email"
                                                    placeholder="Enter email address"
                                                    :value="`${get_setting_value(
                                                        'email'
                                                    )}`"
                                                />
                                            </div>
                                        </div>

                                        <!-- Phone Number -->
                                        <div class="form-group row">
                                            <label
                                                class="col-lg-3 col-form-label form-control-label"
                                                >Phone Number</label
                                            >
                                            <div class="col-lg-9">
                                                <input
                                                    name="phone_number"
                                                    class="form-control"
                                                    type="text"
                                                    placeholder="Enter phone number"
                                                    :value="`${get_setting_value(
                                                        'phone_numbers'
                                                    )}`"
                                                />
                                            </div>
                                        </div>

                                        <!-- Website -->
                                        <div class="form-group row">
                                            <label
                                                class="col-lg-3 col-form-label form-control-label"
                                                >Website</label
                                            >
                                            <div class="col-lg-9">
                                                <input
                                                    name="website"
                                                    class="form-control"
                                                    type="text"
                                                    placeholder="Enter company website"
                                                    :value="`${get_setting_value(
                                                        'website'
                                                    )}`"
                                                />
                                            </div>
                                        </div>

                                        <!-- Fax Number (Optional) -->
                                        <div class="form-group row">
                                            <label
                                                class="col-lg-3 col-form-label form-control-label"
                                                >Fax Number</label
                                            >
                                            <div class="col-lg-9">
                                                <input
                                                    name="fax_number"
                                                    class="form-control"
                                                    type="text"
                                                    placeholder="Enter fax number (optional)"
                                                    :value="`${get_setting_value(
                                                        'fax_number'
                                                    )}`"
                                                />
                                            </div>
                                        </div>
                                        <!-- Address -->
                                        <div class="form-group row">
                                            <label
                                                class="col-lg-3 col-form-label form-control-label"
                                                >Address</label
                                            >
                                            <div class="col-lg-9">
                                                <textarea
                                                    name="address"
                                                    class="form-control"
                                                    rows="3"
                                                    placeholder="Enter company address"
                                                    :value="`${get_setting_value(
                                                        'address'
                                                    )}`"
                                                ></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label
                                                class="col-lg-3 col-form-label form-control-label"
                                                >Site Logo</label
                                            >
                                            <div class="col-lg-9">
                                                <input
                                                    class="form-control"
                                                    name="image"
                                                    type="file"
                                                />
                                                <img
                                                    v-if="auth_info.image"
                                                    class="mt-2"
                                                    :src="`${get_setting_value(
                                                        'image'
                                                    )}`"
                                                    height="100"
                                                    width="100"
                                                    alt=""
                                                />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label
                                                class="col-lg-3 col-form-label form-control-label"
                                            ></label>
                                            <div class="col-lg-9">
                                                <input
                                                    type="submit"
                                                    class="btn btn-primary"
                                                    value="Save Changes"
                                                />
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div
                                    v-if="tab == 'seo_settings'"
                                    :class="
                                        tab == 'seo_settings' ? ' active' : ''
                                    "
                                    class="tab-pane"
                                    id="seo_settings"
                                >
                                    <form @submit.prevent="SiteSettingsHandler">
                                        <!-- Meta Title -->
                                        <div class="form-group row">
                                            <label
                                                class="col-lg-3 col-form-label form-control-label"
                                                >Meta Title</label
                                            >
                                            <div class="col-lg-9">
                                                <input
                                                    name="meta_title"
                                                    class="form-control"
                                                    type="text"
                                                    placeholder="Enter meta title"
                                                    :value="`${get_setting_value(
                                                        'meta_title'
                                                    )}`"
                                                />
                                            </div>
                                        </div>

                                        <!-- Meta Description -->
                                        <div class="form-group row">
                                            <label
                                                class="col-lg-3 col-form-label form-control-label"
                                                >Meta Description</label
                                            >
                                            <div class="col-lg-9">
                                                <textarea
                                                    name="meta_description"
                                                    class="form-control"
                                                    rows="3"
                                                    placeholder="Enter meta description"
                                                    :value="`${get_setting_value(
                                                        'meta_description'
                                                    )}`"
                                                >
                                                </textarea>
                                            </div>
                                        </div>

                                        <!-- Meta Keywords -->
                                        <div class="form-group row">
                                            <label
                                                class="col-lg-3 col-form-label form-control-label"
                                                >Meta Keywords</label
                                            >
                                            <div class="col-lg-9">
                                                <input
                                                    name="meta_keywords"
                                                    class="form-control"
                                                    type="text"
                                                    placeholder="Enter meta keywords (comma-separated)"
                                                    :value="`${get_setting_value(
                                                        'meta_keywords'
                                                    )}`"
                                                />
                                            </div>
                                        </div>

                                        <!-- Canonical URL -->
                                        <div class="form-group row">
                                            <label
                                                class="col-lg-3 col-form-label form-control-label"
                                                >Canonical URL</label
                                            >
                                            <div class="col-lg-9">
                                                <input
                                                    name="canonical_url"
                                                    class="form-control"
                                                    type="text"
                                                    placeholder="Enter canonical URL"
                                                    :value="`${get_setting_value(
                                                        'canonical_url'
                                                    )}`"
                                                />
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="form-group row">
                                            <label
                                                class="col-lg-3 col-form-label form-control-label"
                                            ></label>
                                            <div class="col-lg-9">
                                                <input
                                                    type="submit"
                                                    class="btn btn-primary"
                                                    value="Save Changes"
                                                />
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div
                                    v-if="tab == 'social_link'"
                                    :class="
                                        tab == 'social_link' ? ' active' : ''
                                    "
                                    class="tab-pane"
                                    id="social_link"
                                >
                                    <form @submit.prevent="SiteSettingsHandler">
                                        <!-- Facebook -->
                                        <div class="form-group row">
                                            <label
                                                class="col-lg-3 col-form-label form-control-label"
                                                >Facebook</label
                                            >
                                            <div class="col-lg-9">
                                                <input
                                                    name="facebook"
                                                    class="form-control"
                                                    type="text"
                                                    placeholder="https://facebook.com/yourpage"
                                                    :value="`${get_setting_value(
                                                        'facebook'
                                                    )}`"
                                                />
                                            </div>
                                        </div>
                                        <!-- Twitter -->
                                        <div class="form-group row">
                                            <label
                                                class="col-lg-3 col-form-label form-control-label"
                                                >Twitter</label
                                            >
                                            <div class="col-lg-9">
                                                <input
                                                    name="twitter"
                                                    class="form-control"
                                                    type="text"
                                                    placeholder="https://twitter.com/yourprofile"
                                                    :value="`${get_setting_value(
                                                        'twitter'
                                                    )}`"
                                                />
                                            </div>
                                        </div>
                                        <!-- Instagram -->
                                        <div class="form-group row">
                                            <label
                                                class="col-lg-3 col-form-label form-control-label"
                                                >Instagram</label
                                            >
                                            <div class="col-lg-9">
                                                <input
                                                    name="instagram"
                                                    class="form-control"
                                                    type="text"
                                                    placeholder="https://instagram.com/yourprofile"
                                                    :value="`${get_setting_value(
                                                        'instagram'
                                                    )}`"
                                                />
                                            </div>
                                        </div>
                                        <!-- LinkedIn -->
                                        <div class="form-group row">
                                            <label
                                                class="col-lg-3 col-form-label form-control-label"
                                                >LinkedIn</label
                                            >
                                            <div class="col-lg-9">
                                                <input
                                                    name="linkedin"
                                                    class="form-control"
                                                    type="text"
                                                    placeholder="https://linkedin.com/in/yourprofile"
                                                    :value="`${get_setting_value(
                                                        'linkedin'
                                                    )}`"
                                                />
                                            </div>
                                        </div>
                                        <!-- YouTube -->
                                        <div class="form-group row">
                                            <label
                                                class="col-lg-3 col-form-label form-control-label"
                                                >YouTube</label
                                            >
                                            <div class="col-lg-9">
                                                <input
                                                    name="youtube"
                                                    class="form-control"
                                                    type="text"
                                                    placeholder="https://youtube.com/yourchannel"
                                                    :value="`${get_setting_value(
                                                        'youtube'
                                                    )}`"
                                                />
                                            </div>
                                        </div>
                                        <!-- Save Button -->
                                        <div class="form-group row">
                                            <label
                                                class="col-lg-3 col-form-label form-control-label"
                                            ></label>
                                            <div class="col-lg-9">
                                                <input
                                                    type="submit"
                                                    class="btn btn-primary"
                                                    value="Save Changes"
                                                />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div
                                    v-if="tab == 'smtp'"
                                    :class="tab == 'smtp' ? ' active' : ''"
                                    class="tab-pane"
                                    id="smtp"
                                >
                                    <form @submit.prevent="SiteSettingsHandler">
                                        <div class="form-group row">
                                            <label
                                                class="col-lg-3 col-form-label form-control-label"
                                                >Host</label
                                            >
                                            <div class="col-lg-9">
                                                <input
                                                    name="mail_host"
                                                    class="form-control"
                                                    type="text"
                                                    placeholder="mail.example.com"
                                                    :value="`${get_setting_value(
                                                        'mail_host'
                                                    )}`"
                                                />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label
                                                class="col-lg-3 col-form-label form-control-label"
                                                >Port</label
                                            >
                                            <div class="col-lg-9">
                                                <input
                                                    name="mail_port"
                                                    class="form-control"
                                                    type="text"
                                                    placeholder="465"
                                                    :value="`${get_setting_value(
                                                        'mail_port'
                                                    )}`"
                                                />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label
                                                class="col-lg-3 col-form-label form-control-label"
                                                >Username</label
                                            >
                                            <div class="col-lg-9">
                                                <input
                                                    name="mail_username"
                                                    class="form-control"
                                                    type="text"
                                                    placeholder="mainaccount@example.com"
                                                    :value="`${get_setting_value(
                                                        'mail_username'
                                                    )}`"
                                                />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label
                                                class="col-lg-3 col-form-label form-control-label"
                                                >Password</label
                                            >
                                            <div class="col-lg-9">
                                                <input
                                                    name="mail_password"
                                                    class="form-control"
                                                    type="text"
                                                    placeholder="*********"
                                                    :value="`${get_setting_value(
                                                        'mail_password'
                                                    )}`"
                                                />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                class="col-lg-3 col-form-label form-control-label"
                                                >Encryption</label
                                            >
                                            <div class="col-lg-9">
                                                <select
                                                    name="mail_encryption"
                                                    class="form-control"
                                                    :value="`${get_setting_value(
                                                        'mail_encryption'
                                                    )}`"
                                                >
                                                    <option value="ssl">
                                                        SSL
                                                    </option>
                                                    <option value="tls">
                                                        TLS
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Save Button -->
                                        <div class="form-group row">
                                            <label
                                                class="col-lg-3 col-form-label form-control-label"
                                            ></label>
                                            <div class="col-lg-9">
                                                <input
                                                    type="submit"
                                                    class="btn btn-primary"
                                                    value="Save Details"
                                                />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End container-fluid-->
</template>

<script>
import { auth_store } from "../../../../../GlobalStore/auth_store";
import { site_settings_store } from "../../../../../GlobalStore/site_settings_store";
import { mapState, mapActions } from "pinia";
export default {
    data: () => ({
        tab: "bassic_settings",
    }),

    methods: {
        ...mapActions(auth_store, {
            check_is_auth: "check_is_auth",
        }),
        ...mapActions(site_settings_store, {
            get_all_website_settings: "get_all_website_settings",
            get_setting_value: "get_setting_value",
        }),
        SiteSettingsHandler: async function () {
            let formData = new FormData(event.target);
            let response = await axios.post("website-settings/store", formData);
            if (response.data.status == "success") {
                window.s_alert(response.data.message);
                this.get_all_website_settings();
            }
        },

    },
    computed: {
        ...mapState(auth_store, {
            auth_info: "auth_info",
        }),
        ...mapState(site_settings_store, {
            website_settings_data: "website_settings_data",
        }),
    },
    watch: {
        website_settings_data: {
            handler: function () {
                // this.get_all_website_settings();
            },
        },
    },
};
</script>

<style></style>
