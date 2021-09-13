<template>
  <div id="app">
      <b-navbar v-if="!token" style="list-style-type: none; text-decoration: none; color: #fff" type="dark" variant="dark" >
          <b-collapse id="nav-collapse" is-nav>
              <b-navbar-nav class="ml-auto">
                  <b-nav-item  >
                    <router-link class="text-white" :to="{name: 'Login'}" >Login</router-link>
                  </b-nav-item>
                  <b-nav-item  >
                    <router-link class="text-white" :to="{name: 'Registration'}" >Registration</router-link>
                  </b-nav-item>
              </b-navbar-nav>
          </b-collapse>
      </b-navbar>
      <b-navbar v-if="token" style="list-style-type: none; text-decoration: none; color: #fff" type="dark" variant="dark" >
          <b-collapse id="nav-collapse" is-nav>
              <b-navbar-nav class="ml-auto">
                  <b-nav-item>
                      <router-link class="text-white" :to="{name: 'Table'}" >Store</router-link>
                  </b-nav-item>
              </b-navbar-nav>
              <b-nav-item-dropdown  right>
                  <template class="text-white" #button-content>
                      <em>User</em>
                  </template>
                  <b-dropdown-item href="#">Profile</b-dropdown-item>
                  <b-dropdown-item @click="logOut">Sign Out</b-dropdown-item>
              </b-nav-item-dropdown>
          </b-collapse>
      </b-navbar>
    <router-view/>
  </div>
</template>

<script>
export default {
  name: 'App',
    computed: {
      token() {
          return  localStorage.getItem('token');;
        }
    },
    methods: {
        logOut(){
            this.axios.post('/logout').then(res => {
                if(res.status === 200){
                    localStorage.removeItem('user')
                    localStorage.removeItem('token')
                    this.$router.push({name: 'Login'});
                }
            })
        }
    }
}
</script>

<style>

</style>
