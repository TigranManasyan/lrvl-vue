<template>
    <div>
        <b-container class="mx-auto">
            <h1>{{ name }}</h1>
            <b-row>
                <b-col class="col-md-8">
                    <b-form @submit.stop.prevent="onSubmit" @reset="onReset">
                        <b-form-group
                            id="name"
                            label="Name:"
                            label-for="name"
                        >
                            <b-form-input
                                id="name"
                                v-model="form.name"
                                type="text"
                                placeholder="Enter name"
                                required
                            ></b-form-input>
                        </b-form-group>
<!--                        <b-form-group-->
<!--                            id="last_name"-->
<!--                            label="Last Name:"-->
<!--                            label-for="last_name"-->
<!--                        >-->
<!--                            <b-form-input-->
<!--                                id="last_name"-->
<!--                                v-model="form.last_name"-->
<!--                                type="text"-->
<!--                                placeholder="Enter last name"-->
<!--                                required-->
<!--                            ></b-form-input>-->
<!--                        </b-form-group>-->
                        <b-form-group
                            id="email"
                            label="Email address:"
                            label-for="email"
                        >
                            <b-form-input
                                id="email"
                                v-model="form.email"
                                type="email"
                                placeholder="Enter email"
                                required
                            ></b-form-input>
                        </b-form-group>
                        <b-form-group
                            id="password"
                            label="Password:"
                            label-for="password"
                        >
                            <b-form-input
                                id="password"
                                v-model="form.password"
                                type="password"
                                placeholder="Enter password"
                                required
                            ></b-form-input>
                        </b-form-group>
<!--                        <b-form-group-->
<!--                            id="confirm_password"-->
<!--                            label="Confirm Password:"-->
<!--                            label-for="confirm_password"-->
<!--                        >-->
<!--                            <b-form-input-->
<!--                                id="confirm_password"-->
<!--                                v-model="form.confirm_password"-->
<!--                                type="password"-->
<!--                                placeholder="Confirm your password"-->
<!--                                required-->
<!--                            ></b-form-input>-->
<!--                        </b-form-group>-->
                        <b-button type="submit" variant="success" class="mr-2">Register</b-button>
                        <router-link :to="{name: 'Forgot-Password', params: {email: this.form.email ? this.form.email: ''}}">
                            Forgot your password ?
                        </router-link>
                    </b-form>
                </b-col>
                <b-col class="col-md-4">

                </b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>

export default {
    data() {
        return {
            form: {
                name: 'aaa',
                email: 'testTaza@email.com',
                password: '123456789',
            },
            name: "Registration"
        }
    },
    methods: {
        validateState(ref) {
            if (this.veeFields[ref] && (this.veeFields[ref].dirty || this.veeFields[ref].validated)) {
                return !this.errors.has(ref);
            }
            return null;
        },
        onSubmit() {
            this.$validator.validateAll().then(result => {
                if (!result) {
                    return;
                }
                this.axios.post('/register', this.form)
                    .then(res => {
                        if (res.status === 200) {
                            this.$router.push({name: 'ThankYou', params: {rFrom: 'Registration'}})
                        }
                    }).catch(err => {
                    if (err.status === 422) {
                        let errors = err.data;
                        Object.keys(errors).map(error_key => {
                            this.errors.add({field: error_key, msg: errors[error_key]})
                        })
                    }
                });
            });
        },
        onReset() {
            this.form.name = '';
            this.form.last_name = '';
            this.form.email = '';
            this.form.password = '';
            this.form.confirm_password = '';
        }
    }
}
</script>

<style scoped>

</style>
