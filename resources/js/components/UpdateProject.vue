<template>

<div >
    <v-dialog
      v-model="dialog"
      width="500"
    >
      
            <template v-slot:activator="{ on, attrs }">
              <v-tooltip bottom>
                <template v-slot:activator="{ on: tooltip }">
                <v-btn
                  icon
                  color="green"
                >
                    <v-icon
                        v-bind="attrs"
                        v-on="{ ...tooltip, ...on }"
                        small
                    >
                    mdi-update
                    </v-icon>
                </v-btn>
                </template>
                <span>Update</span>
              </v-tooltip>
            </template>
        

      <v-card class="mt-4">
        <v-card-title class="headline teal lighten-5"> 
          Change status
        </v-card-title>

        <v-card-text>
          <v-form ref="form">

                <v-combobox
                      v-model="status"
                      prepend-icon="mdi-clock"
                      :items="items"
                      label="Status"
                      clearable
                      persistent-hint
                ></v-combobox>

                <v-divider></v-divider>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        :loading="loading"
                        depressed small dark color="teal"
                        text
                        @click="updateProject(project.id)"
                        >
                        Submit
                    </v-btn> 
                </v-card-actions>
            </v-form>  
        </v-card-text>
         
      </v-card>
      
    </v-dialog>
</div>

</template>

<script>


export default {

    props: ['project'],

       data () {
      return {
        status:null,
        inputRules:[
            v=> v.length >=3 || 'Minimum is 3 character'
        ],
        loading:false,
        dialog:false,
        items: [
          'ongoing',
          'complete',
          'overdue',
        ],
      }
    },    
    methods:{
        updateProject(projectId){
            if (this.$refs.form.validate()){
                this.loading=true;
            const project = {
                status: this.status
            }
        console.log(this.status)

            axios.put('/api/'+ projectId, project).then(response=>{
            this.loading=false;
            this.dialog=false;
            window.location.reload()
            })

            .catch(error =>{
            console.log(error);
            })

            }
        },
        
    },

    computed: {
      computedDateFormattedDatefns () {
        return this.date ? format(parseISO(this.date), 'EEEE, MMMM do yyyy') : ''
      },
    },
}
</script>