<template>
<v-app>
    <nav>

        <v-snackbar
            :timeout="4000"
            color="blue-grey"
            absolute
            center
            rounded="pill"
            top
            >
            Awsome ! You added a new project succesfully !
            <v-btn x-small right v-on:click="snackbar = false">Close</v-btn>
        </v-snackbar>

        <v-toolbar flat top>

            <v-btn  class="mx-2" depressed fab dark x-small color="teal" @click.stop="drawer = !drawer">               
                <v-icon dark>
                    mdi-format-list-bulleted-square
                </v-icon>
            </v-btn>

            <v-toolbar-title class="text-uppercase grey--text">
                <span class="font-weight-light">Task</span>
                <span>Manager</span>
            </v-toolbar-title>
            <v-spacer></v-spacer>

            <router-link to="/login" exact-path>
                <v-btn depressed small text dark color="teal">
                    <span id="name">Login</span>
                    <v-icon>mdi-account-check</v-icon>
                </v-btn>
            </router-link>

            <v-btn depressed small text dark color="teal" @click="logout">
                <span>Sign out</span>
                <v-icon>mdi-exit-to-app</v-icon>
            </v-btn>
        </v-toolbar>

        <v-navigation-drawer
            dark
            color="teal"
            v-model="drawer"
            absolute
            temporary
            >
            <v-list-item>
                <!-- <v-list-item-avatar>
                <v-img src="/img/sdengo.png"></v-img>
                </v-list-item-avatar> -->

                <v-list-item-content align="center">
                <v-list-item-title justify="center">{{user.name}}</v-list-item-title>
                </v-list-item-content>
            </v-list-item>

            <v-divider></v-divider>

            <Popup @projectAdded="snackbar=true"/>

            <v-list dense>
                <v-list-item
                v-for="item in items"
                :key="item.title"
                link
                router :to="item.route"
                >
                <v-list-item-icon>
                    <v-icon>{{ item.icon }}</v-icon>
                </v-list-item-icon>

                <v-list-item-content>
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

    </nav>

    <v-main>
        <router-view class="mx-5 mb-5 my-3"></router-view>
    </v-main>

</v-app>    
</template>

<script>

import Popup from './Popup'

export default {

    components: {Popup},
    data () {
      return {
        drawer: null,
        items: [
          { title: 'Register', icon: 'mdi-account-edit', route:'/register' },
          { title: 'Login', icon: 'mdi-account-check', route:'/login' }, 
          { title: 'Dashboard', icon: 'mdi-view-dashboard', route:'/dashboard' },
          { title: 'Projects', icon: 'mdi-forum', route:'/projects' },
          { title: 'Team', icon: 'mdi-account-group-outline', route:'/team' },
        ],
        snackbar : false,
        user:'',
      }
    },

    methods:{
        logout(){
            axios.post('api/logout').then(response=>{
            this.$router.push({ path: "/" });

          })
        }
    },

    mounted(){
        axios.get('/api/user').then(res=>{
            this.user=res.data
        })
    }
}
</script>

