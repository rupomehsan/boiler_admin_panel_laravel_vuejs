<template>
    <div>
        <input
            @change="preview"
            class="form-control"
            type="file"
            ref="input_files"
            :accept="accept"
            :class="classNames"
            :name="multiple ? name + '[]' : name"
            :multiple="multiple"
        />
        <template v-if="multiple">
            <div  class="uploaded_image_preview my-2 d-flex gap-1 flex-wrap">
             {{ component_images }}
                <template
                    v-for="(image, index) in component_images"
                    :key="image"
                >
                    <div class="position-relative my-1">
                        <img
                            :src="image.url ? image.url : image"
                            :class="image != '' ? 'border' : ''"
                            style="
                                width: 200px;
                                height: 80px;
                                object-fit: contain;
                            "
                            alt="image"
                            target="_black"
                            class="mx-1"
                        />
                        <button
                            class="btn btn-outline-warning btn-roun btn-sm"
                            :class="`id-${image.id} index-${index}`"
                            style="position: absolute; top: 3px; right: 7px"
                            @click.prevent="
                                remove({ id: image.id, index: index })
                            "
                        >
                            X
                        </button>
                    </div>
                </template>
            </div>
        </template>
        <template v-else>
            <img
                v-if="value && value != ''"
                :src="value"
                style="width: 200px; height: 80px; object-fit: contain"
                alt="image"
                target="_black"
                class="mt-2"
            />
        </template>
    </div>
</template>

<script>
export default {
    props: {
        name: {
            required: true,
            default: "selected_images",
        },
        multiple: {
            default: false,
        },
        classNames: {
            default: "form-control",
        },
        accept: {
            required: true,
        },
        images: {
            default: [],
            required: false,
        },
    },
    data: () => ({
        component_images: [],
        value: null,
    }),
    watch: {
        images: function (v) {
            // console.log(v);
            this.component_images = this.images;
            if (!this.multiple) {
                this.value = this.images;
            }
        },
    },
    created() {
        this.value = this.images;
        if (this.multiple) {
            this.component_images = this.images;
        }
    },
    methods: {
        preview: function () {
            let that = this;
            that.component_images = [...that.component_images];
            [...that.$refs.input_files.files].forEach((el) => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const base64String = e.target.result;
                    that.component_images.push(base64String);
                    that.value = base64String;
                };
                reader.readAsDataURL(el);
            });
        },

        remove: async function (data) {
            if (data.id) {
                var confirmation = await window.s_confirm();
                if (confirmation) {
                    let response = await axios.delete(`product-image-delete/${data.id}`);
                    window.s_alert("Image deleted");
                    this.component_images.splice(data.index, 1);
                }
            } else {
                this.component_images.splice(data.index, 1);
            }
        },
    },
};
</script>

<style></style>
