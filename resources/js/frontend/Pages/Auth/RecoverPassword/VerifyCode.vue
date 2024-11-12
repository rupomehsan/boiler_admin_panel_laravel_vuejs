<template>

    <div v-if="step_one" class="row justify-content-center align-items-center vh-100">
        <div class="col-md-6">
            <form @submit.prevent="VerifyCodeSubmitHandler">
                <h3>Verify Code</h3>
                <p>Please enter the verification code sent to your email : <span class="fw-bold text-warning">{{ email
                        }}</span></p>
                <div class="form-group d-flex gap-1">
                    <input class="text-center fw-bold" v-for="(value, index) in codeFields" :key="index" ref="codeInput"
                        type="text" v-model="codeFields[index]" @input="moveFocus(index)"
                        @keydown="handleKeydown($event, index)" @paste="handlePaste($event)" maxlength="1" />
                </div>

                <button class="my-4 btn btn-outline-success" type="submit" id="spiner">
                    <span v-if="!loading">Verify</span>
                    <template v-if="loading">
                        <span class="spinner-border spinner-border-sm mx-2" role="status"
                            aria-hidden="true"></span>
                        <span class="">Loading...</span>
                    </template>
                </button>

                <!-- <Link href="/" class="text-primary">Go to home page</Link> <br />
                <Link href="/reset-password" class="text-info">Reset password</Link> <br /> -->
            </form>
        </div>
    </div>

    <template v-if="step_two">
        <reset-password :email="email"></reset-password>
    </template>

</template>

<script>
import ResetPassword from './ResetPassword.vue';


export default {
    components: { ResetPassword },

    props: ['email'],

    data() {

        return {
            codeFields: Array(6).fill(""),
            step_one: true,
            step_two: false,
            loading: false
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
        VerifyCodeSubmitHandler: async function () {
            try {
                this.loading = true
                let formData = {
                    "code": this.codeFields,
                    "email": this.email,
                };
                let response = await axios.post('/verify-otp', formData);
                if (response.data?.status === 'success') {
                    window.s_alert(response.data?.message);
                    this.step_one = false;
                    this.step_two = true;
                }
            } catch (error) {
                console.error("Login error", error);
            } finally {
                this.loading = false
            }
        }
    }
};
</script>
