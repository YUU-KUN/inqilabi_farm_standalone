<template>
  <nav
    id="navbar"
    class="navbar justify-content-between"
    style="padding: 10px 100px"
  >
    <router-link to="/">
      <img class="navbar-brand" src="require('../../../../img/logo.svg" height="50px" alt="logo" />
    </router-link>

    <ul class="nav">
      <li v-if="isLoggedIn" class="nav-item">
        <router-link to="/" class="nav-link text-dark">Dashboard</router-link>
      </li>
      <li v-if="isLoggedIn && userDetail.level == 'user'" class="nav-item">
        <router-link to="/choosePackage" class="nav-link text-dark">Paket Kurban</router-link>
      </li>
      <li v-if="!isLoggedIn" class="nav-item">
        <router-link to="/login" class="nav-link text-dark">Login</router-link>
      </li>
      <li v-if="!isLoggedIn" class="nav-item">
        <router-link to="/register" class="nav-link text-dark">Register</router-link>
      </li>
      <li v-if="isLoggedIn" class="nav-item">
        <b-dropdown
          size="lg"
          variant="link"
          toggle-class="text-decoration-none"
          no-caret
        >
          <template #button-content>
            <b-avatar size="sm"></b-avatar>
            <span>{{userDetail.name}}</span>
          </template>

          <span>
            <b-dropdown-item v-if="userDetail.level == 'user'">
              <router-link style="text-decoration: none; color: black" to="/kurbanSaya">
                Kurban Anda
              </router-link>
            </b-dropdown-item>
            <b-dropdown-item v-if="userDetail.level == 'user'">
              <router-link style="text-decoration: none; color: black" to="/pembayaran"
                >Pembayaran
              </router-link>
            </b-dropdown-item>
            <b-dropdown-item v-if="userDetail.level == 'admin'">
              <router-link style="text-decoration: none; color: black" to="/pembayaranKurban">
                Pembayaran Kurban
              </router-link>
            </b-dropdown-item>
            <b-dropdown-item v-if="userDetail.level == 'admin'">
              <router-link style="text-decoration: none; color: black" to="/laporan">
                Laporan Kurban
              </router-link>
            </b-dropdown-item>
            <b-dropdown-item v-if="userDetail.level == 'user'">
              <router-link style="text-decoration: none; color: black" to="/profileCompletion">
                Profile
              </router-link>
            </b-dropdown-item>
            <b-dropdown-item @click="logout">
              <span >Keluar</span>
            </b-dropdown-item>
          </span>

          <span style="text-align:center" v-if="!userDetail.alamat || !userDetail.kecamatan || !userDetail.kota || !userDetail.provinsi">
            <div class="col">
              <b-icon icon="exclamation-triangle" variant="danger"></b-icon>
            </div>
            <div class="col">
              <b-dropdown-text style="width: 240px;">
                Profil anda belum lengkap
              </b-dropdown-text>
            </div>
            <router-link to="profileCompletion">
              <b-button variant="warning" type="button" block class="text-white " style="text-decoration:none"
                >Lengkapi Profile
              </b-button>
            </router-link>
          </span>
        </b-dropdown>
        
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  data() {
    return  {
      admin: false
    }
  },
  methods: {
    logout() {
      this.$store
        .dispatch("logout")
        .then(() => {
          this.$router.push('/login')
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
  },
  computed: {
    userDetail() {
      return this.$store.getters.userDetail;
    },
    isLoggedIn() {
      return this.$store.getters.isLoggedIn;
    },
  },
  // mounted() {
  //   if (this.userDetail.level == 'admin') {
  //     this.admin = true
  //   } else {
  //     this.admin = false
  //   }
  // },
};
</script>

<style></style>
