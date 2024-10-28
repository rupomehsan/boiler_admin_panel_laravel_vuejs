<template>
    <Layout>
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6">
                <form @submit.prevent="LoginSubmitHandler">
                    <h3>Verify Code</h3>

                    <div class="form-group d-flex gap-1">
                        <input
                            class="text-center fw-bold"
                            v-for="(value, index) in codeFields"
                            :key="index"
                            ref="codeInput"
                            type="text"
                            v-model="codeFields[index]"
                            @input="moveFocus(index)"
                            @keydown="handleKeydown($event, index)"
                            @paste="handlePaste($event)"
                            maxlength="1"
                        />
                    </div>

                    <button class="my-4 btn btn-outline-success" type="submit" id="spiner">
                        <span>Verify</span>
                        <span class="spinner-border spinner-border-sm d-none mx-2" role="status" aria-hidden="true"></span>
                        <span class="visually-hidden">Loading...</span>
                    </button>

                    <Link href="/" class="text-primary">Go to home page</Link> <br />
                    <Link href="/reset-password" class="text-info">Reset password</Link> <br />
                </form>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from "../Layout/Layout.vue";

export default {
    components: { Layout },
    data() {
        return {
            codeFields: Array(6).fill(""),
        };
    },
    methods: {
        moveFocus(index) {
            if (this.codeFields[index] && index < 5) {
                this.$refs.codeInput[index + 1].focus();
            }
        },
        handleKeydown(event, index) {
            if (event.key === "Backspace" && this.codeFields[index] === "" && index > 0) {
                this.$refs.codeInput[index - 1].focus();
            }
        },
        handlePaste(event) {
            const pastedData = event.clipboardData.getData("Text");
            if (pastedData.length === 6 && /^\d+$/.test(pastedData)) {
                this.codeFields = pastedData.split("");
                this.$nextTick(() => {
                    this.$refs.codeInput[5].focus();
                });
            }
            event.preventDefault();
        },
        LoginSubmitHandler() {
            console.log("Submitted code:", this.codeFields.join(""));
        }
    }
};
</script>
