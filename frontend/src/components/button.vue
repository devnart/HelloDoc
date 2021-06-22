<template>
  <button :class="color"><i :class="icon"></i>{{ text }}</button>
</template>

<script>
export default {
  props: ["color", "icon", "text"],
};
</script>

<style>
button {
    cursor: pointer;
  border-radius: 5px;
  padding: 10px;
  border: none;
  width: 40px;
  height: 40px;
  font-weight: 700;
}
button.white {
  background: white;
  color: #77acf1;
}
button.primary {
  background: #04009a;
  color: white;
}
</style>