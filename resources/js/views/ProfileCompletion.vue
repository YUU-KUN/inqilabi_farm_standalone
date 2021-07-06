<template>
    <div>
        <div class="container-scroller">
          <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="main-panel">
              <div class="content-wrapper d-flex align-items-center ">
                <div class="row w-100">
                  <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-center p-5">
                      <h4>Lengkapi Profil</h4>
                      <br>
                      <form>
                          <b-form-group>
                            <b-form-input id="nama" v-model="profile.name" placeholder="Nama" trim required></b-form-input>
                          </b-form-group>
                          
                          <b-form-group>
                            <b-form-input id="nomor_wa" v-model="profile.phone" placeholder="No. Wa" trim required></b-form-input>
                          </b-form-group>

                          <b-form-group>
                            <b-form-input id="email" v-model="profile.email" placeholder="Email" trim required></b-form-input>
                          </b-form-group>

                          <b-form-group>
                            <b-form-input id="alamat" v-model="profile.alamat" placeholder="Alamat" trim required></b-form-input>
                          </b-form-group>

                          <b-form-group>
                            <b-form-input id="kecamatan" v-model="profile.kecamatan" placeholder="Kecamatan" trim required></b-form-input>
                          </b-form-group>
                          
                          <b-form-group>
                            <b-form-input id="kota" v-model="profile.kota" placeholder="Kota" trim required></b-form-input>
                          </b-form-group>

                          <b-form-group>
                            <b-form-input id="provinsi" v-model="profile.provinsi" placeholder="Provinsi" trim required></b-form-input>
                          </b-form-group>
                        </form>
                        <br>
                        <b-button
                          @click="profileCompletion"
                          variant="primary"
                          type="button"
                          >Lanjutkan
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
        profile: '',
        message: '',
      }
    },
    methods: {
      getProfile() {
        this.axios.get('profile').then(response => {
          this.profile = response.data.user
          console.log(response.data.message);
        }).catch(error => console.log(error))
      },
      profileCompletion(){
          this.$bvToast.show("loadingToast")
          const form = {
            name: this.profile.name,
            phone: this.profile.phone,
            email: this.profile.email,
            alamat: this.profile.alamat,
            kecamatan: this.profile.kecamatan,
            kota: this.profile.kota,
            provinsi: this.profile.provinsi
          }
          this.axios.post('profileCompletion', form)
          .then((response) => {
              this.message = response.data.message
              this.$bvToast.hide("loadingToast")
              this.$bvToast.show("message")
              this.$router.push('/')
          })
          .catch(err => console.log(err.response))
      },
    },
    mounted() {
      this.getProfile()
    }
}
</script>