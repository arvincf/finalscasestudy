<template>
  <nav>
    <router-link v-if="isAdmin" to="/doctors" class="text" exact-active-class="active-link"
      >Doctor Management</router-link
    >
    <router-link v-if="isAdmin" to="/patients" class="text" exact-active-class="active-link"
      >Patient Management</router-link
    >
    <router-link v-if="isAdmin" to="/appointments" class="text" exact-active-class="active-link">
      Appointment Management</router-link
    >
    <router-link v-if="isAdmin" to="/medicalrecords" class="text" exact-active-class="active-link">
      Medical Record Management</router-link
    >
    <router-link v-if="isAdmin" to="/users" class="text" exact-active-class="active-link">
      Admin View</router-link
    >

    <router-link v-if="isDoctor" to="/patients" class="text" exact-active-class="active-link">
      My Patients</router-link
    >
    <router-link v-if="isDoctor || isPatient" to="/appointments" class="text" exact-active-class="active-link">
      My Appointments</router-link
    >
    <router-link v-if="isDoctor || isPatient" to="/medicalrecords" class="text" exact-active-class="active-link">
      My Medical Records</router-link
    >

    <!-- <router-link v-if="isDoctor || isPatient">My Profile</router-link> -->
    <router-link to="/logout" class="text"> Logout</router-link>
    <div class="profile">
      <button type="submit" class="btn btn-primary m-1" @click="viewprofile()">
        My Profile
      </button>
    </div>
  </nav>

  <Modal v-if="showeditUserModal" @close="showeditUserModal = false">
    <template v-slot:header>
      <h5>Edit Profile Details</h5>
    </template>
    <template v-slot:body>
      <form @submit.prevent="updateUser()" class="registration-form">
        <div class="form-group">
          <label for="name">Name:</label>
          <input
            class="form-control"
            type="text"
            v-model="editUserData.name"
            id="name"
            required
          />
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input
            class="form-control"
            type="text"
            v-model="editUserData.email"
            id="email"
            required
          />
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input
            class="form-control"
            type="password"
            v-model="editUserData.password"
            id="password"
            required
          />
        </div>
        <div class="form-group">
          <label for="userType">User Type:</label>
          <select
            class="form-control"
            id="userType"
            v-model="editUserData.userType"
            required
          >
            <option value="admin">Administrator</option>
            <option value="doctor">Doctor</option>
            <option value="patient">Patient</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary m-1">Update</button>
      </form>
    </template>
  </Modal>

  <router-view />
</template>

<script>
import Modal from "@/components/PopUpModal.vue";
import axios from "axios";

export default {
  name: "DashBoard",
  components: {
    Modal,
  },
  data() {
    return {
      user: null,
      showeditUserModal: false,
      editUserData: {
        id: "",
        name: "",
        email: "",
        password: "",
        userType: "",
        updated_at: "",
      },
    };
  },
  computed: {
    isAdmin() {
      return this.user && this.user.userType === "admin";
    },
    isDoctor() {
      return this.user && this.user.userType === "doctor";
    },
    isPatient() {
      return this.user && this.user.userType === "patient";
    },
  },
  created() {
    this.loadUserFromLocalStorage();
  },
  methods: {
    loadUserFromLocalStorage() {
      const user = localStorage.getItem("user");
      if (user) {
        this.user = JSON.parse(user);
        this.editUserData = { ...this.user };
      }
    },
    viewprofile() {
      this.showeditUserModal = true;
    },
    async updateUser() {
      this.editUserData.updated_at = new Date().toISOString();
      await axios.put(
        `http://127.0.0.1:8000/api/doctor/${this.editUserData.id}`,
        this.editUserData,
        {
          headers: {
            "Content-Type": "application/json",
            Authorization: "Bearer " + localStorage.getItem("token"),
          },
        }
      );
      this.showeditUserModal = false;
    },
  },
};
</script>

<style scoped>
nav {
  height: 100px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
}
.text {
  text-decoration: none;
  margin: 0 16px;
}
.text:hover {
  background: #42b983;
  color: white;
  padding: 8px 12px;
  border-radius: 24px;
}

.active-link {
  background: #42b983;
  color: white;
  padding: 8px 12px;
  border-radius: 24px;
}
</style>
