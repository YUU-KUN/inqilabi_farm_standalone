<template>
  <div style="justify-content:center; margin:50px auto; padding: 0 100px; background-color: white">
    <h2><b>Dashboard</b></h2> 
      <div class="text-center" style="margin: 50px auto; padding: 0 100px">
        <div class="row align-items-center my-4">
          <div class="col">
            <div class="card">
              <div class="text-center" style="margin: 50px auto; ">
                <div class="row">
                  <div class="col">
                      Total Pemesanan Kurban
                      <h1 class="text-danger font-weight-bold">{{totalPesanan}}</h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="text-center" style="margin: 50px auto; ">
                <div class="row">
                  <div class="col">
                      Proses Kurban Berlangsung
                      <h1 class="text-danger font-weight-bold">{{kurbanBerlangsung}}</h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="text-center" style="margin: 50px auto; ">
                <div class="row">
                  <div class="col">
                      Proses Kurban Terselesaikan
                      <h1 class="text-danger font-weight-bold">{{kurbanTerselesaikan}}</h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row align-items-center my-4">
          <div class="col">
            <div class="card">
              <div class="text-center" style="margin: 50px auto; ">
                <div class="row">
                  <div class="col">
                      Jumlah Pengguna
                      <h1 class="text-danger font-weight-bold">{{totalUser}}</h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="text-center" style="margin: 50px auto; ">
                <div class="row">
                  <div class="col">
                      Pembayaran Menunggu Konfirmasi
                      <h1 class="text-danger font-weight-bold">{{waitingTransaction}}</h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="text-center" style="margin: 50px auto; ">
                <div class="row">
                  <div class="col">
                      Transaksi Berhasil
                      <h1 class="text-danger font-weight-bold">{{successTransaction}}</h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    <div class="d-flex justify-content-center my-5">
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      totalPesanan: '',
      totalUser: '',
      kurbanBerlangsung: '',
      kurbanTerselesaikan: '',
      waitingTransaction: '',
      successTransaction: '',
    };
  },
  methods: {
    getTotalUser() {
      this.axios.get('totalUser').then(response => {
        this.totalUser = response.data
      }).catch(error => {
        console.log(error.response);
      })
    },
    getTotalPesanan() {
      this.axios.get('totalPesanan').then(response => {
        this.totalPesanan = response.data
      }).catch(error => console.log(error.response))
    },
    getKurbanBerlangsung() {
      this.axios.get('kurbanBerlangsung').then(response => {
        this.kurbanBerlangsung = response.data
      }).catch(error => console.log(error.response))
    },
    getWaitingTransaction() {
      this.axios.get('waitingTransaction').then(response => {
        this.waitingTransaction = response.data
      }).catch(error => console.log(error.response))
    },
    getKurbanTerselesaikan() {
      this.axios.get('kurbanTerselesaikan').then(response => {
        this.kurbanTerselesaikan = response.data
      }).catch(error => console.log(error.response))
    },
    getSuccessTransaction() {
      this.axios.get('successTransaction').then(response => {
        this.successTransaction = response.data
      }).catch(error => console.log(error.response))
    }
  },
  created() {
    this.getTotalUser()
    this.getTotalPesanan()
    this.getKurbanBerlangsung()
    this.getWaitingTransaction()
    this.getKurbanTerselesaikan()
    this.getSuccessTransaction()
  }
};
</script>
