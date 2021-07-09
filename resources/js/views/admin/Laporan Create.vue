<template>
  <div style="justify-content:center; margin:50px auto; padding: 0 100px; background-color: white">
    <div class="text-center" style="margin: 50px auto; padding: 0 100px">
      <div class="align-items-center my-4">
        <div class="d-flex align-items-center justify-content-start">
          <!-- Foto Hewan Kurban Anda -->
        <!-- <div class="col-3"> -->
          <h2><b>Buat Laporan</b></h2> 
        <!-- </div> -->
          
          <div class="col" v-if="pembayaranData.proses == 'inqilabi_farm'">
            <div class="row">
              <div class="col">
                <input type="radio" class="btn-check" name="options-outlined" id="foto_hewan" value="foto_hewan" v-model="proses" autocomplete="off" checked>
                <!-- <label class="btn btn-danger font-weight-bold text-light px-4" for="foto_hewan"> -->
                <label class="btn btn-warning font-weight-bold text-light px-4" for="foto_hewan">
                  <span class="d-flex justify-content-center">Foto Hewan</span> 
                  <span class="d-flex justify-content-center">Kurban Anda</span>
                </label>
              </div>
              <!-- Foto Proses Penyembelihan -->
              <div class="col">
                <input type="radio" class="btn-check" name="options-outlined" id="penyembelihan" value="penyembelihan" v-model="proses" autocomplete="off">
                <label class="btn btn-warning font-weight-bold text-light px-4" for="penyembelihan">
                  <span class="d-flex justify-content-center">Foto Proses</span> 
                  <span class="d-flex justify-content-center">Penyembelihan</span>
                </label>
              </div>
              <!-- Foto Pembagian Kurban -->
              <div class="col">
                <input type="radio" class="btn-check" name="options-outlined" id="pembagian" value="pembagian" v-model="proses" autocomplete="off">
                <label class="btn btn-warning font-weight-bold text-light px-4" for="pembagian">
                  <span class="d-flex justify-content-center">Foto Pembagian</span> 
                  <span class="d-flex justify-content-center">Kurban</span>
                </label>
              </div>
            </div>
          </div>
          
          <div class="col" v-else>
            <div class="row">
              <div class="col">
                <input type="radio" class="btn-check" name="options-outlined" id="foto_hewan" value="foto_hewan" v-model="proses" autocomplete="off" checked>
                <!-- <label class="btn btn-danger font-weight-bold text-light px-4" for="foto_hewan"> -->
                <label class="btn btn-warning font-weight-bold text-light px-4" for="foto_hewan">
                  <span class="d-flex justify-content-center">Foto Hewan</span> 
                  <span class="d-flex justify-content-center">Kurban Anda</span>
                </label>
              </div>
              <!-- Foto Proses Pengiriman -->
              <div class="col">
                <input type="radio" class="btn-check" name="options-outlined" id="pengiriman" value="pengiriman" v-model="proses" autocomplete="off">
                <label class="btn btn-warning font-weight-bold text-light px-4" for="pengiriman">
                  <span class="d-flex justify-content-center">Foto Proses</span> 
                  <span class="d-flex justify-content-center">Pengiriman</span>
                </label>
              </div>
              <!-- Foto Hewan Sampai di Lokasi -->
              <div class="col">
                <input type="radio" class="btn-check" name="options-outlined" id="sampai" value="sampai" v-model="proses" autocomplete="off">
                <label class="btn btn-warning font-weight-bold text-light px-4" for="sampai">
                  <span class="d-flex justify-content-center">Foto Hewan</span> 
                  <span class="d-flex justify-content-center">Sampai di Lokasi</span>
                </label>
              </div>
            </div>
          </div>

        </div>
        
        <div class="card my-4">
          <div class="d-flex justify-content-center my-5">
            <span v-if="proses == 'foto_hewan'">
              <h4><b>Foto Hewan Kurban</b></h4>
            </span>
            <span v-if="proses == 'penyembelihan'">
              <h4><b>Foto Proses Penyembelihan Kurban</b></h4>
            </span>
            <span v-if="proses == 'pembagian'">
              <h4><b>Foto Pembagian Kurban</b></h4>
            </span>
            <span v-if="proses == 'pengiriman'">
              <h4><b>Foto Proses Pengiriman</b></h4>
            </span>
            <span v-if="proses == 'sampai'">
              <h4><b>Foto Hewan Sampai di Lokasi</b></h4>
            </span>
          </div>
          <div class="align-items-center mx-auto" style="width: 750px">
            <div class="col">
              <span v-if="proses == 'foto_hewan'">
                <b-form-group >
                  <b-form-input id="nama" v-model="nama" placeholder="Atas Nama" trim required></b-form-input>
                </b-form-group>
                <b-form-group >
                  <b-form-input id="jenis" v-model="jenis" placeholder="Jenis Hewan" trim required></b-form-input>
                </b-form-group>
                <b-form-group >
                  <b-form-input id="berat" v-model="berat" placeholder="Berat" trim required></b-form-input>
                </b-form-group>
              </span>
              <span v-if="proses == 'penyembelihan'">
                <b-form-group >
                  <b-form-input id="penyembelih" v-model="penyembelih" placeholder="Penyembelih" trim required></b-form-input>
                </b-form-group>
                <b-form-group >
                  <b-form-input type="date" id="hari_penyembelihan" v-model="hari_penyembelihan" placeholder="Hari" trim required></b-form-input>
                </b-form-group>
                <b-form-group >
                  <b-form-input type="time" id="pukul_penyembelihan" v-model="pukul_penyembelihan" placeholder="Pukul" trim required></b-form-input>
                </b-form-group>
              </span>
              <span v-if="proses == 'pembagian'">
                <b-form-group >
                  <b-form-input id="lokasi_pembagian" v-model="lokasi_pembagian" placeholder="Lokasi Pembagian" trim required></b-form-input>
                </b-form-group>
                <b-form-group >
                  <b-form-input id="penanggung_jawab" v-model="penanggung_jawab" placeholder="Penanggung Jawab" trim required></b-form-input>
                </b-form-group>
                <b-form-group >
                  <b-form-input type="date" id="hari_pembagian" v-model="hari_pembagian" placeholder="Hari" trim required></b-form-input>
                </b-form-group>
              </span>
              <span v-if="proses == 'pengiriman'">
                <b-form-group >
                  <b-form-input id="supir" v-model="supir" placeholder="Nama Supir" trim required></b-form-input>
                </b-form-group>
                <b-form-group >
                  <b-form-input id="no_supir" v-model="no_supir" placeholder="No. Handphone" trim required></b-form-input>
                </b-form-group>
                <b-form-group >
                  <b-form-input id="mobil_pengirim" v-model="mobil_pengirim" placeholder="Mobil Pengirim" trim required></b-form-input>
                </b-form-group>
              </span>
              <span v-if="proses == 'sampai'">
                <b-form-group >
                  <b-form-input id="penerima" v-model="penerima" placeholder="Nama Penerima" trim required></b-form-input>
                </b-form-group>
                <b-form-group >
                  <b-form-input type="date" id="hari_diterima" v-model="hari_diterima" placeholder="Diterima Hari" trim required></b-form-input>
                </b-form-group>
                <b-form-group >
                  <b-form-input type="time" id="pukul_diterima" v-model="pukul_diterima" placeholder="Direrima Pukul" trim required></b-form-input>
                </b-form-group>
              </span>
              <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" useCustomSlot @vdropzone-complete="afterComplete">
                <div class="dropzone-custom-content" >
                    <img src="require('../../../../img/entypo_upload-to-cloud.svg" alt="Cloud Upload Icon" height="75px">
                    <div class="subtitle">
                      <span v-if="proses == 'foto_hewan'">Upload Foto Hewan</span>
                      <span v-if="proses == 'penyembelihan'">Upload Foto Penyembelihan</span>
                      <span v-if="proses == 'pembagian'">Upload Foto Pembagian Kurban</span>
                      <span v-if="proses == 'pengiriman'">Upload Foto Pengiriman Kurban</span>
                      <span v-if="proses == 'sampai'">Upload Foto Hewan Sampai di Lokasi</span>
                    </div>
                </div>
              </vue-dropzone>
            </div>
          </div>
          <div class="d-flex justify-content-between my-5" style="margin: auto 150px">
            <router-link to="reportDetail">
              <button class="btn btn-outline-danger">Kembali</button>
            </router-link>
            <!-- <router-link to="reportDetail">
              <button class="btn btn-danger ">Simpan</button>
            </router-link> -->
              <button @click="createReport" class="btn btn-danger ">Simpan</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

export default {
  components: {
    vueDropzone: vue2Dropzone
  },
  data() {
    return {
      pembayaranData: '',
      proses: 'foto_hewan',
      nama: '',
      jenis: '',
      berat: '',
      penyembelih: '',
      hari_penyembelihan: '',
      pukul_penyembelihan: '',
      lokasi_pembagian: '',
      penanggung_jawab: '',
      hari_pembagian: '',
      supir: '',
      no_supir: '',
      mobil_pengirim: '',
      penerima: '',
      hari_diterima: '',
      pukul_diterima: '',
      foto: '',
      dropzoneOptions: {
        url: 'https://httpbin.org/post',
        thumbnailWidth: 150,
        maxFilesize: 0.5,
        headers: { "My-Awesome-Header": "header value" }
      }
    };
  },
  methods: {
    afterComplete(file) {
        this.foto = file
        // console.log(file);
    },
    getpembayaranData() {
      const id_pembayaran = this.$route.params.id_pembayaran
      this.axios.get(`pembayaran/${id_pembayaran}`).then(response => {
        this.pembayaranData = response.data
        this.nama = this.pembayaranData.nama
        this.jenis = `${this.pembayaranData.package.nama} ${this.pembayaranData.package.variant}`
        this.berat = this.pembayaranData.package.berat
      }).catch(error => {
        console.log(error.response);
      })

    },
    createReport() {
      if (!this.foto) {
          alert('Mohon upload bukti pembayaran')
          return
      }
      const formData = new FormData()
      formData.append('id_pembayaran', this.$route.params.id_pembayaran)
      formData.append('foto', this.foto)
      formData.append('proses', this.proses)
      if (this.proses == 'foto_hewan') {
        formData.append('nama', this.nama)
        formData.append('jenis_hewan', this.jenis)
        formData.append('berat_hewan', this.berat)
      } else if (this.proses == 'penyembelihan') {
        formData.append('penyembelih', this.penyembelih)
        formData.append('hari_penyembelihan', this.hari_penyembelihan)
        formData.append('pukul_penyembelihan', this.pukul_penyembelihan)
      } else if (this.proses == 'pembagian'){
        formData.append('lokasi_pembagian', this.lokasi_pembagian)
        formData.append('penanggung_jawab', this.penanggung_jawab)
        formData.append('hari_pembagian', this.hari_pembagian)
      } else if (this.proses == 'pengiriman'){
        formData.append('supir', this.supir)
        formData.append('no_supir', this.no_supir)
        formData.append('mobil_pengirim', this.mobil_pengirim)
      } else {
        formData.append('penerima', this.penerima)
        formData.append('hari_diterima', this.hari_diterima)
        formData.append('pukul_diterima', this.pukul_diterima)
      }

      this.axios.post('report', formData).then(response => {
        console.log(response.data);
        this.$router.push({name: 'reportDetail'})
      }).catch(error => {
        console.log(error.response);
      })
    }
  },
  mounted() {
    this.getpembayaranData()
  }
};
</script>

<style scoped>
.btn-check{
  display:none
}
</style>