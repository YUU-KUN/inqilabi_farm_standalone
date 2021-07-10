<template>
  <div
    style="text-align:center; justify-content:center; margin:200px auto; background-color: white"
  >
    <div class="row" style="margin: 25px">
        <div class="col" style="margin: 0 350px">
            <h2><b>Pilih Paket</b></h2>
            <br>
            <br>
            <div class="d-flex justify-content-center">
                <!-- Kambing / Domba Betina -->
                <div class="card" style="align-items:center;">
                    <h3 style="margin: 30px"><b>Kambing / Domba Betina</b></h3>
                    <img
                        src="require('../../../img/domba_betina.png"
                        alt="Domba Betina"
                        style=""
                    />
                    <br />
                    <!-- <p class="price">Berat: 25-40 Kg</p> -->
                    <p>Berat: <b>25-40 Kg</b></p>
                    <h5>Mulai dari</h5>
                    <h3><b>Rp 1.850.000</b></h3>
                    <!-- <p><button>Kurban Sekarang</button></p> -->
                    <!-- <p><b-button pill variant="light">Kurban Sekarang</b-button></p> -->
                    <router-link to="choosePackage/kambing_betina">
                        <b-button pill variant="light">Kurban Sekarang</b-button>
                    </router-link>
                </div>

                <!-- Kambing / Domba Jantan -->
                <div class="card" style="align-items:center;">
                    <h3 style="margin: 30px"><b>Kambing / Domba Jantan</b></h3>
                    <img
                        src="require('../../../img/domba_jantan.png"
                        alt="Domba Jantan"
                        style=""
                    />
                    <br />
                    <p v-if="weight">Berat: <b>{{weight.kambing_jantan.min}}-{{weight.kambing_jantan.max}} Kg</b></p>
                    <h5>Mulai dari</h5>
                    <h3><b>Rp 1.850.000</b></h3>
                    <router-link to="choosePackage/kambing_jantan">
                        <b-button pill variant="light">Kurban Sekarang</b-button>
                    </router-link>
                </div>

                <!-- Sapi -->
                <div class="card" style="align-items:center;">
                    <h3 style="margin: 30px"><b>Patungan Sapi</b></h3>
                    <img
                        src="require('../../../img/patungan_sapi.png"
                        alt="Domba Betina"
                        style=""
                    />
                    <br />
                    <p v-if="weight">Berat: <b>{{weight.sapi}} Kg</b></p>
                    <h5>Mulai dari</h5>
                    <h3><b>Rp 1.850.000</b></h3>
                    <p>
                        <router-link to="choosePackage/sapi">
                            <b-button pill variant="light">Kurban Sekarang</b-button>
                        </router-link>
                    </p>
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
      weight: '',
    };
  },
  methods: {
    // kambingJantan() {
    //   this.$router.push({name:'Choose More Packages', params: {type: ''}})
    // },
    getWeight() {
      this.axios.get('weight').then(response => {
        this.weight = response.data
      }).catch(error => console.log(error))
    }
  },
  mounted() { 
    this.getWeight()
  }
};
</script>

<style scoped>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
}

.price {
  color: grey;
  font-size: 22px;
}

.card button {
  border: none;
  outline: 0;
  padding: 12px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

.card button:hover {
  opacity: 0.7;
}
</style>
