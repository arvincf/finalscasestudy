<template>
  <div class="login-container">
    <h1>Login</h1>
    <form @submit.prevent="login" class="login-form">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" v-model="email" id="email" required />
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" v-model="password" id="password" required />
      </div>
      <button type="submit">Login</button>
    </form>
    <div v-if="error" class="error">{{ error }}</div>
    <div class="bottom">
      <p class="bottom__no-account">No Account?</p>
      <router-link to="/register" class="register">Register Here</router-link>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      email: "",
      password: "",
      error: "",
    };
  },
  methods: {
    async login() {
      try {
        const response = await axios.post("http://127.0.0.1:8000/api/login", {
          email: this.email,
          password: this.password,
        });
        const token = response.data.token;
        const user = response.data.user;
        localStorage.setItem("token", token);
        localStorage.setItem("user", JSON.stringify(user));
        this.$router.push("/dashboard"); // Redirect to dashboard or another page
      } catch (err) {
        this.error =
          "Login failed. Please check your credentials and try again.";
      }
    },
  },
};
</script>

<style>
.login-container {
  max-width: 400px;
  margin: 100px auto;
  padding: 32px;
  border: 1px solid #b4b4b4;
  border-radius: 8px;
  background-color: #cbcbcb;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 10px 0 rgba(0, 0, 0, 0.19);
}
h1 {
  margin: 16px auto;
  font-weight: 700;
}
label {
  font-weight: 500;
  font-size: 18px;
}
.login-form {
  display: grid;
  grid-template-columns: 1fr 2fr;
  grid-gap: 24px;
}
.form-group {
  display: contents;
}
input {
  border: var(--bs-border-width) solid var(--bs-border-color);
  outline: none;
  border-radius: var(--bs-border-radius);
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
button {
  grid-column: span 2;
  padding: 10px 15px;
  background-color: #58f870;
  color: white;
  border: none;
  outline: none;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: #30ef4c;
}
div.bottom {
  margin: 24px auto;
  display: flex;
  flex-wrap: nowrap;
  flex-direction: row;
  justify-content: center;
  align-items: center;
}
.register {
  text-decoration: none;
}
.bottom__no-account {
  margin-right: 8px;
  margin-bottom: 0rem;
}
.error {
  color: red;
  margin-top: 10px;
  text-align: center;
}
</style>
