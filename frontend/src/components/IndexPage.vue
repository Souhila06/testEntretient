<template>
    <v-app id="inspire">
      <v-app-bar :elevation="2">
        <img class="ml-8" width="100px" src="logo.png"/>
      </v-app-bar>
      <!-- https://vif.fr/wp-content/uploads/2023/02/cropped-LogoVIF_Petit.png -->
      <v-navigation-drawer v-model="drawer">
        
  
        <v-divider></v-divider>
  
        <v-list>
          <v-list-item
          style="background-color: #ea560d; color: white;"
            v-for="[icon, text] in links"
            :key="icon"
            :prepend-icon="icon"
            :title="text"
            link
          ></v-list-item>
        </v-list>
      </v-navigation-drawer>
  
      <v-main>
        <v-container
          class="py-8 px-6"
          fluid
        >
        <CRUDComponent/>
        
        
        </v-container>
      </v-main>
    </v-app>
  </template>
  
  <script setup>

  import CRUDComponent from './CRUDComponent.vue'
    import { ref } from 'vue'

    const links = [
      ['mdi-inbox-arrow-down', 'CRUD'],
    ]
  
    const drawer = ref(null)
  </script>
  
  <script>
    export default {
      data: () => ({
        cards: ['Today', 'Yesterday'],
        name:'IndexPage',
        drawer: null,
        links: [
          ['mdi-inbox-arrow-down', 'CRUD'],
        ],
      }),
    }
  </script>