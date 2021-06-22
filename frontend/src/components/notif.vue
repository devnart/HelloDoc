<template>
  <div id="notification">
    <p>
      Your Refrence is <span>{{ refrence }}</span>
    </p>
  </div>
</template>

<script>
export default {
  props: ["ref"],
  data() {
    return {
      refrence : localStorage.getItem('key')
        
    };
  },
};
</script>

<style scoped>
#notification {
  position: absolute;
    bottom: 0;


}
p {
    border-radius: 5px;
  background: #1cd1355e;
  color: white;
  font-size: 19px;
  padding: 10px;
}
</style>