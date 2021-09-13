<template>
    <div>
        <b-container>
            <b-row align-h="center">
                <b-col class="mt-3" cols="4">
                    <h5>Hey you are almost there</h5>
                    <h6>Enter Your Password To Finnish Verification</h6>
                    <b-form  @submit.prevent="finishVerification">
                        <b-form-group id="input-group-1" label="Email" label-for="email">
                            <b-form-input
                                disabled
                                type="text"
                                id="email"
                                name="email"
                                data-vv-as="email"
                                v-model="verifyForm.email"
                                v-validate="'required|email'"
                                :state="validateState('email')"
                                aria-describedby="email-live-feedback"
                            ></b-form-input>
                            <b-form-invalid-feedback id="email-live-feedback">{{ errors.first('email') }}</b-form-invalid-feedback>
                        </b-form-group>
                        <b-form-group id="input-group-2" label="Password" label-for="password">
                            <b-form-input
                                id="password"
                                name="password"
                                v-model="verifyForm.password"
                                type="password"
                                v-validate="'required|min:6|alpha_dash'"
                                :state="validateState('password')"
                                aria-describedby="password-live-feedback"
                                data-vv-as="password"
                            ></b-form-input>
                            <b-form-invalid-feedback id="password-live-feedback">{{ errors.first('password') }}</b-form-invalid-feedback>
                        </b-form-group>
                        <b-button class="mt-2" variant="success" type="submit">Done</b-button>
                    </b-form>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>
export default {
    title:"Finishing Verification",
    data() {
        return {
            verifyForm: {
                email: '',
                password: '',
                token: ''
            },
        }
    },
    mounted() {
        this.verifyForm.email = this.$route.params.email
        this.verifyForm.token = this.$route.params.token
    },
    methods: {
        finishVerification() {
            this.$validator.validateAll().then(result => {
                if (!result) {
                    return;
                }
                this.axios.post('/verify', this.verifyForm).then(res => {
                  if(res.status === 200){
                    this.$router.push({name: 'ThankYou', params: {rFrom: 'Verification'}})
                  }
                }).catch(err => {
                    if(err.status === 422 ){
                        let errors = err.data.errors;
                        Object.keys(errors).map(error_key => {
                            this.errors.add({field: error_key, msg: errors[error_key][0]})
                        })
                    }
                });
            });

        },
        validateState(ref) {
            if (this.veeFields[ref] &&(this.veeFields[ref].dirty || this.veeFields[ref].validated)) {
                return !this.errors.has(ref);
            }
            return null;
        },
    }
}
</script>

<style scoped>

</style>
