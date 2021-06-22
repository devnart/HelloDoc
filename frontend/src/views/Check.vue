<template>
  <div class="container">
    <div class="inner">
      <input type="text" placeholder="Reference" name="ref" v-model="ref" />
      <Button @click="setRef" color="primary" icon="fas fa-chevron-right"
      />
    </div>
  </div>
</template>

<script>
import Button from "../components/button.vue";

export default {
  data() {
    return {
      ref: "",
    };
  },
  components: {
    Button,
  },
  methods : {
    setRef : function(e){
      e.preventDefault()
      localStorage.setItem('userkey', this.ref);
      localStorage.removeItem('key');
  this.$router.push('/result');

    }
  }
};
</script>

<style scoped>
.inner {
  width: 400px;
  box-shadow: 0 5px 14px #0000001c;
  border-radius: 10px;
  height: 200px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 5px;
}

.inner input {
  padding: 10px;
  border-radius: 5px;
  border: 2px solid #c2c2c2;
  outline: none;
  margin-top: 0;
  width: auto;
  box-shadow: none;
}
</style>