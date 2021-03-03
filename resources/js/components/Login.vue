<template>

    <v-form
    ref="form"
    v-model="valid"
    lazy-validation
    class="ma-4"
  >
    
    <h1 class="title grey--text">Login</h1>

    <v-text-field
      v-model="email"
      :rules="emailRules"
      label="E-mail"
      required
    ></v-text-field>

    <v-text-field
      v-model="password"
      :rules="passwordRules"
      label="Password"
      required
    ></v-text-field>

    <v-btn
      :disabled="!valid"
      color="success"
      class="mr-4"
      @click="saveForm"
    >
      Submit
    </v-btn>

  </v-form>
</template>

<script>
  export default {
    data: () => ({
        valid: true,
          
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
          
        //   console.log(project);

          axios.post('api/login',project).then(response=>{
            //   console.log(response.data)
            this.$router.push({ path: "/dashboard" });

          }).catch((error)=>{
              console.log(error)
          })

      }
    },
  }
</script>