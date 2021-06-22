<template>
  <div class="home">
    <div class="container">
      <Notif v-if="isKey" />
      <router-link to="/register"
        ><Card title="Create An Account" icon="fa fa-plus-circle"
      /></router-link>
      <router-link to="/check"
        ><Card title="Check Appoientement" icon="fas fa-search"
      /></router-link>
    </div>
  </div>
</template>

<script>
import Card from "../components/card.vue";
import Notif from "../components/notif.vue";

export default {
  name: "Home",
  created() {
    if (this.ref == null) {
      this.isKey = false;
    } else {
      setTimeout(() => {
        this.isKey = false;
        localStorage.removeItem("key");
      }, 6000);
      
    }
  },
  components: {
    Card,
    Notif,
  },
  data() {
    return {
      isKey: true,
      ref: localStorage.getItem("key"),
    };
  },
};
</script>
