<template>
    <div class="container-fluid">
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <h4 class="page-title"> Site Settings</h4>
            </div>
        </div>
        <div class="row">


            <div class="col-lg-10">
                <div class="card" id="site_settings">
                    <div class="card-body">
                        <div class="d-flex">
                            <ul class="flex-column nav nav-tabs nav-tabs-primary top-icon nav-justified card">
                                <li class="nav-item" @click="tab = 'bassic_settings'">
                                    <a :class="tab == 'bassic_settings' ? ' active' : ''" href="javascript:void();"
                                        data-target="#bassic_settings" data-toggle="pill" class="nav-link "><i
                                            class="icon-note"></i> <span class="hidden-xs">Basic Settings</span></a>
                                    <hr>
                                </li>
                                <li class="nav-item" @click="tab = 'seo_settings'">
                                    <a :class="tab == 'seo_settings' ? 'active' : ''" href="javascript:void();"
                                        data-target="#seo_settings" data-toggle="pill" class="nav-link "><i
                                            class="icon-note"></i> <span class="hidden-xs">SEO Settings</span></a>
                                    <hr>
                                </li>
                                <li class="nav-item" @click="tab = 'contact_information'">
                                    <a :class="tab == 'contact_information' ? ' active' : ''" href="javascript:void();"
                                        data-target="#contact_information" data-toggle="pill" class="nav-link"><i
                                            class="icon-note"></i> <span class="hidden-xs">contact
                                            information</span></a>
                                    <hr>
                                </li>
                                <li class="nav-item" @click="tab = 'social_link'">
                                    <a :class="tab == 'social_link' ? ' active' : ''" href="javascript:void();"
                                        data-target="#social_link" data-toggle="pill" class="nav-link"><i
                                            class="icon-note"></i> <span class="hidden-xs">Social Links
                                            information</span></a>
                                    <hr>
                                </li>

                            </ul>
                            <div class=" ml-2 flex-grow-1 tab-content p-3 card">
                                <div v-if="tab == 'bassic_settings'" :class="tab == 'bassic_settings' ? ' active' : ''"
                                    class="tab-pane active" id="bassic_settings">
                                    <form @submit.prevent="UpdateProfileHandler" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Site Name</label>
                                            <div class="col-lg-9">
                                                <input v-model="auth_info.name" name="name" class="form-control"
                                                    type="text" value="">
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Site Logo</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" name="image" type="file">
                                                <img v-if="auth_info.image" class="mt-2" :src="auth_info.image"
                                                    height="100" width="100" alt="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label"></label>
                                            <div class="col-lg-9">
                                                <input type="submit" class="btn btn-primary" value="Save Changes">
                                            </div>
                                        </div>

                                    </form>

                                </div>

                                <div v-if="tab == 'seo_settings'" :class="tab == 'seo_settings' ? ' active' : ''"
                                    class="tab-pane" id="seo_settings">
                                    <form @submit.prevent="saveSeoDetails">
                                        <!-- Meta Title -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Meta Title</label>
                                            <div class="col-lg-9">
                                                <input  name="meta_title"
                                                    class="form-control" type="text" placeholder="Enter meta title">
                                            </div>
                                        </div>

                                        <!-- Meta Description -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Meta
                                                Description</label>
                                            <div class="col-lg-9">
                                                <textarea name="meta_description" class="form-control" rows="3"
                                                    placeholder="Enter meta description"></textarea>
                                            </div>
                                        </div>

                                        <!-- Meta Keywords -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Meta
                                                Keywords</label>
                                            <div class="col-lg-9">
                                                <input name="meta_keywords" class="form-control" type="text"
                                                    placeholder="Enter meta keywords (comma-separated)">
                                            </div>
                                        </div>

                                        <!-- Canonical URL -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Canonical
                                                URL</label>
                                            <div class="col-lg-9">
                                                <input name="canonical_url" class="form-control" type="url"
                                                    placeholder="Enter canonical URL">
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label"></label>
                                            <div class="col-lg-9">
                                                <input type="submit" class="btn btn-primary" value="Save Changes">
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <div v-if="tab == 'contact_information'"
                                    :class="tab == 'contact_information' ? ' active' : ''" class="tab-pane"
                                    id="contact_information">
                                    <form @submit.prevent="saveContactDetails">
                                        <!-- Company Name -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Company
                                                Name</label>
                                            <div class="col-lg-9">
                                                <input name="company_name" class="form-control" type="text"
                                                    placeholder="Enter company name">
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                            <div class="col-lg-9">
                                                <input name="email" class="form-control" type="email"
                                                    placeholder="Enter email address">
                                            </div>
                                        </div>

                                        <!-- Phone Number -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Phone
                                                Number</label>
                                            <div class="col-lg-9">
                                                <input name="phone_number" class="form-control" type="text"
                                                    placeholder="Enter phone number">
                                            </div>
                                        </div>

                                        <!-- Address -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Address</label>
                                            <div class="col-lg-9">
                                                <textarea name="address" class="form-control" rows="3"
                                                    placeholder="Enter company address"></textarea>
                                            </div>
                                        </div>

                                        <!-- Website -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Website</label>
                                            <div class="col-lg-9">
                                                <input name="website" class="form-control" type="url"
                                                    placeholder="Enter company website">
                                            </div>
                                        </div>

                                        <!-- Fax Number (Optional) -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Fax Number</label>
                                            <div class="col-lg-9">
                                                <input name="fax_number" class="form-control" type="text"
                                                    placeholder="Enter fax number (optional)">
                                            </div>
                                        </div>

                                        <!-- Save Button -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label"></label>
                                            <div class="col-lg-9">
                                                <input type="submit" class="btn btn-primary"
                                                    value="Save Contact Details">
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <div v-if="tab == 'social_link'" :class="tab == 'social_link' ? ' active' : ''"
                                    class="tab-pane" id="social_link">
                                    <form @submit.prevent="saveSocialLinks">
                                        <!-- Facebook -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Facebook</label>
                                            <div class="col-lg-9">
                                                <input  name="facebook"
                                                    class="form-control" type="url"
                                                    placeholder="https://facebook.com/yourpage">
                                            </div>
                                        </div>
                                        <!-- Twitter -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Twitter</label>
                                            <div class="col-lg-9">
                                                <input name="twitter" class="form-control" type="url"
                                                    placeholder="https://twitter.com/yourprofile">
                                            </div>
                                        </div>
                                        <!-- Instagram -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Instagram</label>
                                            <div class="col-lg-9">
                                                <input name="instagram" class="form-control" type="url"
                                                    placeholder="https://instagram.com/yourprofile">
                                            </div>
                                        </div>
                                        <!-- LinkedIn -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">LinkedIn</label>
                                            <div class="col-lg-9">
                                                <input name="linkedin" class="form-control" type="url"
                                                    placeholder="https://linkedin.com/in/yourprofile">
                                            </div>
                                        </div>
                                        <!-- YouTube -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">YouTube</label>
                                            <div class="col-lg-9">
                                                <input name="youtube" class="form-control" type="url"
                                                    placeholder="https://youtube.com/yourchannel">
                                            </div>
                                        </div>
                                        <!-- Save Button -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label"></label>
                                            <div class="col-lg-9">
                                                <input type="submit" class="btn btn-primary" value="Save Changes">
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
import { settings_store } from "../store/store";
import { mapState, mapActions } from 'pinia';
export default {
    data: () => ({
        tab: 'bassic_settings',

    }),
    methods: {
        ...mapActions(auth_store, {
            check_is_auth: 'check_is_auth',
        }),
        UpdateProfileHandler: async function () {
            let formData = new FormData(event.target);
            let response = await axios.post('user-profile-update', formData);
            if (response.data.status == 'success') {
                window.s_alert(response.data.message)
                this.check_is_auth()
            }
        },
        ChangePasswordHandler: async function () {
            let formData = new FormData(event.target);
            let response = await axios.post('user-change-password', formData);
            if (response.data.status == 'success') {
                window.s_alert(response.data.message)
                this.check_is_auth()
            }
        }
    },
    computed: {
        ...mapState(auth_store, {
            auth_info: 'auth_info',
        }),
    },
}
</script>

<style></style>
