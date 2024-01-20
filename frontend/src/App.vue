<template>
  <v-app>
    <v-main>
      <IndexPage/>
    </v-main>
  </v-app>
</template>

<script>
import IndexPage from './components/IndexPage.vue'

export default {
  name: 'App',

  components: {
    IndexPage,
  },

  data: () => ({
    //
  }),
}
</script>
