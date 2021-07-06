<template>
  <div
    style="text-align:center; justify-content:center; margin:200px auto; background-color: white"
  >
    <div class="row" style="margin: 25px">
        <div class="col" style="margin: 0 350px">
            <h2>
                <b v-if="type == 'kambing_jantan'">Paket Kurban Kambing / Domba Jantan</b>
                <b v-if="type == 'kambing_betina'">Paket Kurban Kambing / Domba Betina</b>
                <b v-if="type == 'sapi'">Patungan Kurban Sapi</b>
            </h2>
            <br>
            <br>
            <div class="row justify-content-center align-content-around flex-wrap">
                <div class="col-6" style="margin: 20px auto" v-for="paket in packages" :key="paket.id">
                    <div class="d-flex justify-content-center">
                        <div class="card" style="padding: 0 10px;">
                            <div class="row">
                                <div class="col d-flex align-items-center justify-content-end" style="padding: 0">
                                    <div class="d-flex flex-column" >
                                        <img v-if="$route.params.type == 'kambing_jantan'" src="../../../public/img/domba_jantan.png" alt="" width="150px">
                                        <img v-else-if="$route.params.type == 'sapi'" src="../../../public/img/patungan_sapi.png" alt="" width="150px">
                                        <img v-else src="../../../public/img/domba_betina.png" alt="" width="150px">
                                        <p>Berat: <b>{{paket.berat}} Kg</b></p>
                                    </div>
                                </div>
                                <div class="col d-flex align-items-center justify-content-center" >
                                    <div>
                                        <h5><b>{{paket.nama}} <span class="text-danger">{{paket.variant}}</span></b></h5>
                                        <h4><b>{{paket.harga | rupiah}}</b></h4>
                                        <!-- <router-link to="/checkout">
                                            <b-button pill variant="danger"><b>Kurban Sekarang</b></b-button>
                                        </router-link> -->
                                        <b-button pill variant="danger" @click="checkout(paket.id)"><b>Kurban Sekarang</b></b-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
        packages: [],
        packageImage: '../../../public/img/domba_jantan.png',
        type: this.$route.params.type
    };
  },
  methods: {
    getPackages() {
        this.axios.post('package/'+this.type).then(response => {
            this.packages = response.data
        }).catch(error => {
            console.log(error.response);
        })
    },
    checkout(id) {
        this.$router.push({name:'Checkout', params: {package_id:id }})
    }
  },
  mounted() {
    this.getPackages()
  }
};
</script>

<style scoped>
.card button:hover {
  opacity: 0.7;
}
</style>
