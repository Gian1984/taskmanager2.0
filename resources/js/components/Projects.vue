<template>
  <div class="projects">
    <h1 class="title grey--text">Projects</h1>
    <p>{{user}}</p>
    <v-container fluid class="my-5">
      
      <v-row justify="center" class="px-5"> 
        <v-expansion-panels accordion>
          <v-expansion-panel
            v-for="project in myProjects" :key="project.id">
            <v-expansion-panel-header color="teal lighten-5">{{project.title}}</v-expansion-panel-header>
            <v-expansion-panel-content class="px-4 grey--text" color="grey lighten-4">
              <div class="font-weight-bold mt-2 ">Due by {{project.date}}</div>
              {{project.content}}
            </v-expansion-panel-content>
          </v-expansion-panel>
        </v-expansion-panels>
      </v-row>

    </v-container>    
  </div>
</template>

<script>


export default {

  props: ['user'],

  data() {
    return {
      projects: []
    }
  },
  computed:{


    myProjects(){
      return this.projects.filter(project => {
        console.log(this.user)
        return project.name === 'Gianluca Tiengo'
      })
    } 
  },
  
  methods:{

    getList(){
      axios.get('/api/getProject').then(response=>{  
      this.projects = response.data;
      }, (error) => {
      console.log(error);  
      })
    },
  },
  created(){
        this.getList();
  }
  
}
</script>