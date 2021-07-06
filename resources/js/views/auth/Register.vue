<template>
  <div>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="main-panel">
          <div class="content-wrapper d-flex align-items-center ">
            <div class="row w-100">
              <div class="col-lg-4 mx-auto">
                <div class="auth-form-light text-center p-5">
                  <!-- <div class="navbar-brand brand-logo">
                        <img src="../../public/img/logo.svg">
                      </div> -->
                  <h4>Buat Akun</h4>
                  <!-- <h6 class="font-weight-light"></h6> -->
                  <br>
                  <form>
                    <div v-if="!next">
                      <b-form-group>
                        <b-form-input
                          id="name"
                          v-model="name"
                          placeholder="Nama"
                          trim
                          required
                        ></b-form-input>
                      </b-form-group>

                      <b-form-group>
                        <b-form-input
                          type="email"
                          id="email"
                          v-model="email"
                          placeholder="Email"
                          trim
                          required
                        ></b-form-input>
                      </b-form-group>

                      <b-form-group>
                        <b-form-input
                          type="password"
                          id="password"
                          v-model="password"
                          placeholder="Password"
                          trim
                          required
                        ></b-form-input>
                      </b-form-group>

                      <b-form-group>
                        <b-form-input
                          type="password"
                          id="password_confirmation"
                          v-model="password_confirmation"
                          placeholder="Konfirmasi Password"
                          trim
                          required
                        ></b-form-input>
                      </b-form-group>
                    </div>
                    <div v-if="next">
                      <b-form-group>
                        <b-form-input
                          id="phone"
                          v-model="phone"
                          placeholder="No. Handphone (Whatsapp)"
                          required
                        ></b-form-input>
                      </b-form-group>

                      <b-form-checkbox v-model="isAgree"
                        >Kami akan memberikan laporan secara berkala kepada
                        Anda</b-form-checkbox
                      >
                    </div>

                    <!-- <b-button
                                variant="primary"
                                block
                                type="submit"
                                >Masuk
                            </b-button> -->
                    <br>
                    <!-- <br> -->
                  </form>
                  <b-button
                    @click="nextStep"
                    v-if="!next"
                    variant="primary"
                    lg="4"
                    type="button"
                    >Lanjutkan
                  </b-button>
                  <!-- <router-link to="/">
                              <b-button
                                  v-if="next"
                                  variant="primary"
                                  lg="4"
                                  type="button"
                                  >Daftar
                              </b-button>
                            </router-link> -->
                  <b-button
                    v-if="next"
                    @click="register"
                    variant="primary"
                    lg="4"
                    type="button"
                    >Daftar
                  </b-button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <b-toast id="loadingToast" title="Processing Data" no-auto-hide>
        <b-spinner label="Spinning" variant="success"></b-spinner>
        <strong class="text-success">Loading...</strong>
      </b-toast>
      <!-- toast untuk tampilan message box -->
      <b-toast id="message" title="Message">
        <strong class="text-success">{{ message }}</strong>
      </b-toast>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
      phone: "",
      next: false,
      isAgree: false,
      message: "",
    };
  },
  methods: {
    nextStep() {
      if (
        !this.name ||
        !this.email ||
        !this.password ||
        !this.password_confirmation
      ) {
        this.next = false;
        alert("Mohon lengkapi formnya");
        // console.log('Mohon lengkapi formnya');
      } else {
        this.next = true;
      }
      // this.next = !this.next
    },
    register() {
      const form = {
        name: this.name,
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation,
        phone: this.phone,
        isAgree: this.isAgree,
      };
      this.axios
        .post("register", form)
        .then((response) => {
          console.log(response.data.message);
          this.$router.push("/login");
        })
        .catch((error) => {
          console.log(error.response);
        });
      // this.$store.dispatch('register', form)
      // .then(response => console.log(response)))
      // .catch(err => console.log(err))
    },
  },
  mounted() {
    console.log(this.next);
  },
};
</script>
