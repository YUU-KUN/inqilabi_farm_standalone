<template>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="main-panel">
          <div class="content-wrapper d-flex align-items-center ">
            <div class="row h-100 w-100">
              <div class="col-lg-4 mx-auto">
                <div class="auth-form-light text-center p-5">
                  <h4>Masuk</h4>
                  <br>
                  <div v-if="message" class="alert" :class="alertType" role="alert">
                    {{message}}
                  </div>
                  <form @keyup.enter="login">
                    <b-form-group>
                      <b-form-input id="emailOrPhone" v-model="emailOrPhone" placeholder="Email / No. Handphone" trim required></b-form-input>
                    </b-form-group>
                    
                    <b-form-group>
                      <b-form-input type="password" id="password" v-model="password" placeholder="Password" trim required></b-form-input>
                    </b-form-group>
                  </form>
                  <br>
                  <b-button
                      @click="login"
                      variant="primary"
                      lg="4"
                      type="submit"
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
</template>
<script>
export default {
    data() {
      return {
        emailOrPhone: '',
        password: '',
        message: '',
        alertType: 'alert-success',
      }
    },
    methods: {
        login(){
          this.$bvToast.show("loadingToast")
          let emailOrPhone = this.emailOrPhone
          let password = this.password
          this.$store.dispatch('login', {emailOrPhone, password})
          .then((response) => {
            if (!response.data.status) {
              this.message = response.data
              console.log(response.data);
              this.$bvToast.hide("loadingToast")
              this.alertType = 'alert-danger'
              return 
            }
            this.alertType = 'alert-success'
            this.message = response.data.message
            this.$bvToast.hide("loadingToast")
            // this.$bvToast.show("message")
            this.$router.push('/')
          })
          .catch(err => console.log(err))
        },
    },
}
</script>