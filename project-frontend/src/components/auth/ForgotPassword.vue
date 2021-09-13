<template>
    <div>
        <h1>{{name}}</h1>
        <p>{{email}}</p>
    </div>
</template>

<script>
export default {
    props: {
        email: String,
    },
    data(){
        return{
            forgot_form: {
              forgot_email: this.email,
              forgot_password_code: ''
            },
            name: "Forgot Password"
        }
    }
}
</script>

<style scoped>

</style>
