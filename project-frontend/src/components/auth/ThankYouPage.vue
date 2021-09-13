<template>
    <div>
        <b-container class="mt-3" fluid="md">
            <b-row align-h="center">
                <b-col class="align-content-center" v-if="rdr === 'Registration'" cols="4">
                    <b-img src="https://i1.wp.com/nahbnow.com/wp-content/uploads/2018/08/iStock-692279620.jpg"
                           alt="check" fluid center width="100" height="100"></b-img>
                    <h3>Thank you for registration</h3>
                    <h4>Please check your email for verification</h4>
                </b-col>
                <b-col class="align-content-center" v-if="rdr === 'Verification'" cols="4">
                    <b-img src="https://i1.wp.com/nahbnow.com/wp-content/uploads/2018/08/iStock-692279620.jpg"
                           alt="check" fluid center width="100" height="100"></b-img>
                    <h4>You are fully Registered</h4>
                    <h5>You can now login to our page</h5>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>
export default {
    title: "Thank You",
    data(){
        return{
            rdr: '',
        }
    }, mounted() {
        this.rdr = this.$route.params.rFrom
    }
}
</script>

<style scoped>

</style>
