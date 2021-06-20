<template>

  <div class="container">
    
  <Card  title="Make an Appoienment" icon="fa fa-plus-circle" />
  <Card title="Check Appoientement"  icon="fas fa-search"/>
  </div>
</template>

<script>

import Card from '../components/card.vue'

export default {
  data(){
    return {
      name : 'This is about Page'
    }
  },
  components: {
    Card
  }
  
}
</script>

<style>
  a {
    text-decoration: none;
    color: inherit;
  }
  .container {
    display: flex;
    justify-content: center;
    gap: 15px;
    height: 100vh;
    align-items: center;
  }

</style>