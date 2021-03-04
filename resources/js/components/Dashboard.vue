<template>
  <div class="dashboard">
    <h1 class="title grey--text">Dashboard</h1>

    <v-container fluid class="my-5 mt-2">

      <v-row class="mb-5">
    
        <v-tooltip bottom small>
          <template v-slot:activator="{ on }">  
            <v-btn small color="grey lighten-4" v-on="on" @click="sortBy('title')">
              <v-icon left small>mdi-folder</v-icon>
              <div class="span caption text-lowercase">By project name</div>
            </v-btn>
          </template>
          <span>Sort projects by project name</span>
        </v-tooltip>

         <v-tooltip bottom small>
          <template v-slot:activator="{ on }">  
            <v-btn small color="grey lighten-4 ml-3" v-on="on" @click="sortBy('person')">
              <v-icon left small>mdi-account</v-icon>
              <div class="span caption text-lowercase">By person</div>
            </v-btn>
        </template>
          <span>Sort projects by person</span>
        </v-tooltip>

        <v-tooltip bottom small>
          <template v-slot:activator="{ on }">  
            <v-btn small color="grey lighten-4 ml-3" v-on="on" @click="sortBy('status')">
              <v-icon left small>mdi-clock</v-icon>
              <div class="span caption text-lowercase">By status</div>
            </v-btn>
        </template>
          <span>Sort projects by status</span>
        </v-tooltip>

      </v-row>

      <v-card flat color="teal lighten-5"  v-for="(project, index) in projects" :key="project.id">
        <v-row class="mb-2" no-gutters :class="`pa-3 project ${project.status}`">
          

          <v-col>
            <div class="caption grey--text">Project title</div>
            <div>{{project.title}}</div>
          </v-col>

          <v-col>
            <div class="caption grey--text">Person</div>
            <div>{{project.name}}</div>
          </v-col>

          <v-col>
            <div class="caption grey--text">Due by</div>
            <div>{{project.date}}</div>
          </v-col>

          <v-col>
            <div>
                <v-chip small :class="`${project.status} white--text mt-3 caption m-auto`">{{ project.status }}</v-chip>
            </div>

            <v-btn
              icon
              color="red"
            >
                <v-icon
                    small
                    @click="removeProject(project.id, index)"
                >
                mdi-trash-can-outline
                </v-icon>
            </v-btn>  
          </v-col>

        </v-row>
        <v-divider></v-divider>
        
      </v-card>
    </v-container>

  </div>
</template>

<script>

export default {
  data() {
    return {
      projects: []
    }
  },
   

  methods:{
    sortBy(prop){
      this.projects.sort((a,b)=> a[prop] < b[prop] ? -1 : 1)
    },
    
  

    getList(){
        axios.get('/api/getProject').then(response=>{     
        this.projects = response.data;
        }, (error) => {
        console.log(error);  
        })
    },   

    updateCheck(){
        axios.put('/api/'+ this.project.id, {
        project : this.project
        })
        .then(response=>{
            if (response.status == 200){
                this.$emit('itemchanged');
                }
            })
            .catch(error =>{
                console.log(error);
            })
    },

    removeProject(projectId, index){
            axios.delete('/api/'+ projectId)
            .then( response =>{
              this.$delete(this.projects, index)
        })

        .catch(error =>{
        console.log(error);
        })
    },
    
  },

  created(){
        this.getList();
    }
  
}
</script>

<style scoped>

  .project.complete{
    border-left: 4px solid green;
  }

  .project.ongoing{
    border-left: 4px solid orange;
  }

  .project.overdue{
    border-left: 4px solid red;
  }

  .v-chip.complete{
  background: green !important; 
  }

  .v-chip.ongoing{
  background: orange !important;
  }

  .v-chip.overdue{
  background: red !important;
  }

</style>
