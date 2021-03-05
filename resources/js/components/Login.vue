<template>
<v-container grid-list-md text-xs-center>

<v-card
  id="main"
  elevation="24"
  class="text-xs-center mt-5"
>
    <v-form
    class="m-5"
    ref="form"
    v-model="valid"
    lazy-validation
  >
    
    <h1 class="title grey--text">Login</h1>

    <v-text-field
      v-model="email"
      prepend-icon="mdi-email-outline"
      :rules="emailRules"
      label="E-mail"
      required
    ></v-text-field>

    <v-text-field
      v-model="password"
      prepend-icon="mdi-key"
      type="password"
      :rules="passwordRules"
      label="Password"
      required
    ></v-text-field>

    <div class="text-xs-center" v-if="errors.data">{{errors.data.message}}</div>
    <v-divider></v-divider>
    <v-spacer></v-spacer>

    <v-btn 
      color="teal"
      dark
      depressed 
      class="mr-4"
      @click="saveForm"
    >
      Submit
    </v-btn>

  </v-form>
</v-card>
</v-container>
</template>

<script>
  export default {
    data: () => ({
        valid: true,
            errors: [],
            email: '',
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
            ],
            password: '',
            passwordRules: [
                v => !!v || 'Password is required',
                v => (v && v.length >= 6) || 'Password must be more than 6 characters',
            ],          
        
    }),

    methods: {

      saveForm(){

          const project = {
                email: this.email,
                password: this.password,
            }
          
        

          axios.post('api/login',project).then(response=>{  
          this.$router.push({ path: "/dashboard" });

          }).catch((error)=>{
              this.errors = error.response
          })

      }
    },
  }
</script>

<style scoped>

#main{
  margin: auto;
  max-width: 500px !important;
  border: 1px teal solid;
}

</style>