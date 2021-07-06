<template>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="main-panel">
          <div class="content-wrapper d-flex align-items-center ">
            <div class="row w-100">
              <div class="col-lg-4 mx-auto">
                <div class="auth-form-light text-center p-5">
                  <h4>Data Pengiriman</h4>
                  <br>
                    <form>
                        <div class="mb-3">
                            <input type="text" id="nama_penerima" class="form-control" v-model="pengiriman.nama_penerima" placeholder="Nama Penerima">
                        </div>
                        <div class="mb-3">
                            <input type="number" class="form-control" v-model="pengiriman.no_wa" placeholder="No. Wa">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" v-model="pengiriman.tempat_penerima" placeholder="Tempat Penerima (Masjid/Musholla)">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" v-model="pengiriman.alamat" placeholder="Alamat">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" v-model="pengiriman.kecamatan" placeholder="Kecamatan">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" v-model="pengiriman.kota" placeholder="Kota">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" v-model="pengiriman.provinsi" placeholder="Provinsi">
                        </div>
                    </form>
                        <div class="d-flex justify-content-end">
                            <b-button
                                @click="sendToDriver"
                                variant="success"
                                lg="4"
                                type="button"
                                >Kirim ke Driver
                            </b-button>
                        </div>
                    <br>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
    </div>
</template>
<script>
export default {
    data() {
      return {
        pengiriman: '',
      }
    },
    methods: {
        getDataPengiriman() {
            const id_pembayaran = this.$route.params.id_pembayaran
            this.axios.get(`getPengirimanUser/${id_pembayaran}`).then(response => {
                this.pengiriman = response.data
                console.log(response.data);
            }).catch(error => {
                console.log(error.response);
            })
        },
        sendToDriver() {
            this.axios.post('').then(response => {
                console.log(response.data);
            }).catch(error => {
                console.log(error.response);
            })
        }
    },
    mounted() {
        this.getDataPengiriman()
    }
}
</script>