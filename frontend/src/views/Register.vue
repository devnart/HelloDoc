<template>
  <div class="container">
    <form @submit="fetching">
      <div class="input">
        <label for="name">Name :</label>
        <input type="text" name="name" id="name" v-model="name" />
      </div>
      <div class="input">
        <label for="dob">Date of Birth :</label>
        <input type="date" name="dob" id="dob" v-model="dob" />
      </div>
      <div class="input">
        <label for="password">Password :</label>
        <input type="password" name="password" id="password" v-model="password" />
      </div>
      <Button color="primary" text="Register"/>
    </form>
  </div>
</template>
<script>

import Button from "../components/button.vue";

export default {
  components: {
    Button,
  },
  data() {
    return {
      name: "",
      dob: "",
      password: "",
    };
  },
  methods: {
    async fetching(e) {
      e.preventDefault()
      const resp = await fetch(
        "http://localhost/vueapp/UserController/register",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
          },
          body: JSON.stringify({
            name: this.name,
            dob: this.dob,
            password: this.password,
          }),
        }
      )
      const key  = await resp.json();
      localStorage.setItem('key', key);
      // console.log(key);
  this.$router.push('/');

  },
  }
};
</script>

<style>

form {
    text-align: left;
}
button {
    width: auto;
}
.input {
    display: flex;
flex-direction: column;
align-items: start;
text-align: left;
margin: 10px 0;
}
input {
    padding: 10px;
margin-top: 5px;
border: none;
border-radius: 5px;
outline: none;
box-shadow: 0 5px 10px #00000017;
width: 100%;
}
</style>