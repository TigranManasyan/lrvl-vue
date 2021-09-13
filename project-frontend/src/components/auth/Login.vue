<template>
    <div>
        <b-container class="mx-auto">
        <h1>{{name}}</h1>
            <b-row>
                <b-col class="col-md-8">
                    <b-form @submit.stop.prevent="onSubmit" @reset="resetForm">
                        <small class="text-danger font-weight-bold">
                            {{  errors.first('incorrect') }}
                        </small>
                        <b-form-group id="input-group-1" label="Email" label-for="email">
                            <b-form-input
                                id="email"
                                name="email"
                                v-model="form.email"
                                type="text"
                                v-validate="'required|email'"
                                :state="validateState('email')"
                                aria-describedby="email-live-feedback"
                                data-vv-as="email"
                            ></b-form-input>
                            <small class="text-danger font-weight-bold">
                                {{  errors.first('email') }}
                            </small>
                        </b-form-group>
                        <b-form-group id="input-group-2" label="Password" label-for="password">
                            <b-form-input
                                id="password"
                                name="password"
                                v-model="form.password"
                                type="password"
                                v-validate="'required|min:6|alpha_dash'"
                                :state="validateState('password')"
                                aria-describedby="password-live-feedback"
                                data-vv-as="password"
                            ></b-form-input>
                            <small class="text-danger font-weight-bold">
                                {{  errors.first('password') }}
                            </small>
                        </b-form-group>
                        <b-button type="submit">Log In</b-button>
                    </b-form>
                </b-col>
                <b-col class="col-md-4"></b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>
export default {
    data(){
        return{
            form: {
                email: 'testtaza@gmail.com',
                password: '123456'
            },
            name: "Login"
        }
    },
    methods: {
        validateState(ref) {
            if (this.veeFields[ref] && (this.veeFields[ref].dirty || this.veeFields[ref].validated)) {
                return !this.errors.has(ref);
            }
            return null;
        },
        resetForm() {
            this.form = {
                email: null,
                password: null
            };
            this.$nextTick(() => {
                this.$validator.reset();
            });
        },
        onSubmit() {
            this.$validator.validateAll().then(result => {
                if (!result) {
                    return;
                }
                this.axios.post('/login', this.form).then(res => {
                    if(res.status === 200){
                        localStorage.setItem('user', JSON.stringify(res.data.data))
                        localStorage.setItem('token', JSON.stringify(res.data.token.name))
                        this.$router.push({name: 'Profile'});
                    }
                }).catch(err => {
                    if(err.response.status === 422){
                        let errors = err.response.data;
                        Object.keys(errors).map(error_key => {
                            this.errors.add({field: error_key, msg: errors[error_key]})
                        })
                    }
                })
            });
        }
    }
}
</script>

<style scoped>

</style>
