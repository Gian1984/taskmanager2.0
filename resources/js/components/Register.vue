<template>
  <v-container grid-list-md text-xs-center>

    <v-card
      id="main"
      elevation="24"
      class="text-xs-center mt-5"
    >
        <v-form
        ref="form"
        v-model="valid"
        lazy-validation
        class="m-5"
      >
        
        <h1 class="title grey--text">Register</h1>

        <v-text-field
          v-model="name"
          prepend-icon="mdi-face"
          :rules="nameRules"
          label="Name"
          required
        ></v-text-field>

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

        <div class="text-xs-center" v-if="errors.data">{{errors.data.errors.email[0]}}</div>
        <v-divider></v-divider>
        <v-spacer></v-spacer>

        <v-btn  
          color="teal"
          depressed 
          dark
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
            name: '',
            nameRules: [
                v => !!v || 'Name is required',
            ],
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
                name: this.name,
                email: this.email,
                password: this.password,
            }
          
        //   console.log(project);

          axios.post('api/register',project).then(response=>{
            //   console.log(response.data)
            this.$router.push({ path: "/login" });

          }).catch((error)=>{
                this.errors = error.response
          })

      }
    },
  }
</script>

<style scoped>
  #main{
    margin:auto;
    max-width: 500px !important;
    border: 1px teal solid;
  }
</style>