<template>
  <div style="justify-content:center; margin:50px auto; padding: 0 100px; background-color: white">
    <div class="text-center" style="margin: 50px auto; padding: 0 100px">
      <div class="align-items-center my-4">
        <div class="d-flex align-items-center justify-content-start">
          <!-- Foto Hewan Kurban Anda -->
        <!-- <div class="col-3"> -->
          <h2><b>Edit Laporan</b></h2> 
          <!-- <pre>{{report}}</pre> -->
        <!-- </div> -->
        </div>
        
        <div class="card my-4">
          <div class="d-flex justify-content-center my-5">
            <span v-if="report.proses == 'foto_hewan'">
              <h4><b>Foto Hewan Kurban</b></h4>
            </span>
            <span v-if="report.proses == 'penyembelihan'">
              <h4><b>Foto Proses Penyembelihan Kurban</b></h4>
            </span>
            <span v-if="report.proses == 'pembagian'">
              <h4><b>Foto Pembagian Kurban</b></h4>
            </span>
            <span v-if="report.proses == 'pengiriman'">
              <h4><b>Foto Proses Pengiriman</b></h4>
            </span>
            <span v-if="report.proses == 'sampai'">
              <h4><b>Foto Hewan Sampai di Lokasi</b></h4>
            </span>
          </div>
          <div class="align-items-center mx-auto" style="width: 750px">
            <div class="col">
              <span v-if="report.proses == 'foto_hewan'">
                <b-form-group >
                  <b-form-input id="nama" v-model="report.nama" placeholder="Atas Nama" trim required></b-form-input>
                </b-form-group>
                <b-form-group >
                  <b-form-input id="jenis" v-model="report.jenis_hewan" placeholder="Jenis Hewan" trim required></b-form-input>
                </b-form-group>
                <b-form-group >
                  <b-form-input id="berat" v-model="report.berat_hewan" placeholder="Berat" trim required></b-form-input>
                </b-form-group>
              </span>
              <span v-if="report.proses == 'penyembelihan'">
                <b-form-group >
                  <b-form-input id="penyembelih" v-model="report.penyembelih" placeholder="Penyembelih" trim required></b-form-input>
                </b-form-group>
                <b-form-group >
                  <b-form-input type="date" id="hari_penyembelihan" v-model="report.hari_penyembelihan" placeholder="Hari" trim required></b-form-input>
                </b-form-group>
                <b-form-group >
                  <b-form-input type="time" id="pukul_penyembelihan" v-model="report.pukul_penyembelihan" placeholder="Pukul" trim required></b-form-input>
                </b-form-group>
              </span>
              <span v-if="report.proses == 'pembagian'">
                <b-form-group >
                  <b-form-input id="lokasi_pembagian" v-model="report.lokasi_pembagian" placeholder="Lokasi Pembagian" trim required></b-form-input>
                </b-form-group>
                <b-form-group >
                  <b-form-input id="penanggung_jawab" v-model="report.penanggung_jawab" placeholder="Penanggung Jawab" trim required></b-form-input>
                </b-form-group>
                <b-form-group >
                  <b-form-input type="date" id="hari_pembagian" v-model="report.hari_pembagian" placeholder="Hari" trim required></b-form-input>
                </b-form-group>
              </span>
              <span v-if="report.proses == 'pengiriman'">
                <b-form-group >
                  <b-form-input id="supir" v-model="report.supir" placeholder="Nama Supir" trim required></b-form-input>
                </b-form-group>
                <b-form-group >
                  <b-form-input id="no_supir" v-model="report.no_supir" placeholder="No. Handphone" trim required></b-form-input>
                </b-form-group>
                <b-form-group >
                  <b-form-input id="mobil_pengirim" v-model="report.mobil_pengirim" placeholder="Mobil Pengirim" trim required></b-form-input>
                </b-form-group>
              </span>
              <span v-if="report.proses == 'sampai'">
                <b-form-group >
                  <b-form-input id="penerima" v-model="report.penerima" placeholder="Nama Penerima" trim required></b-form-input>
                </b-form-group>
                <b-form-group >
                  <b-form-input type="date" id="hari_diterima" v-model="report.hari_diterima" placeholder="Diterima Hari" trim required></b-form-input>
                </b-form-group>
                <b-form-group >
                  <b-form-input type="time" id="pukul_diterima" v-model="report.pukul_diterima" placeholder="Direrima Pukul" trim required></b-form-input>
                </b-form-group>
              </span>
              <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" useCustomSlot @vdropzone-complete="afterComplete">
                <div class="dropzone-custom-content" >
                    <img src="../../../../public/img/entypo_upload-to-cloud.svg" alt="Cloud Upload Icon" height="75px">
                    <div class="subtitle">
                      <span v-if="report.proses == 'foto_hewan'">Upload Foto Hewan</span>
                      <span v-if="report.proses == 'penyembelihan'">Upload Foto Penyembelihan</span>
                      <span v-if="report.proses == 'pembagian'">Upload Foto Pembagian Kurban</span>
                      <span v-if="report.proses == 'pengiriman'">Upload Foto Pengiriman Kurban</span>
                      <span v-if="report.proses == 'sampai'">Upload Foto Hewan Sampai di Lokasi</span>
                    </div>
                </div>
              </vue-dropzone>
            </div>
          </div>
          <div class="d-flex justify-content-between my-5" style="margin: auto 150px">
              <button @click="redirectReportDetail()" class="btn btn-outline-danger">Kembali</button>
            <!-- <router-link to="/reportDetail">
            </router-link> -->
            <!-- <router-link to="reportDetail">
              <button class="btn btn-danger ">Simpan</button>
            </router-link> -->
              <button @click="editReport" class="btn btn-danger ">Edit</button>
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
      report: '',
      formData: {},
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
        console.log(file);
    },
    redirectReportDetail() {
      this.$router.push({name: 'reportDetail', params: {id_pembayaran: this.$route.params.id_pembayaran}})
    },
    getReportDetail() {
      this.axios.get(`report/${this.$route.params.id_laporan}`).then(response => {
        this.report = response.data
      }).catch(error => {
        console.log(error.response);
      })
    },
    // getpembayaranData() {
    //   const id_pembayaran = this.$route.params.id_pembayaran
    //   this.axios.get(`pembayaran/${id_pembayaran}`).then(response => {
    //     this.pembayaranData = response.data
    //     this.nama = this.pembayaranData.nama
    //     this.jenis = `${this.pembayaranData.package.nama} ${this.pembayaranData.package.variant}`
    //     this.berat = this.pembayaranData.package.berat
    //   }).catch(error => {
    //     console.log(error);
    //   })
    // },
    editReport() {
      const formData = new FormData()
      // if (this.foto) {
        formData.append('foto', this.foto)
      // }
      if (this.report.proses == 'foto_hewan') {
        formData.append('nama', this.report.nama)
        formData.append('jenis_hewan', this.report.jenis_hewan)
        formData.append('berat_hewan', this.report.berat_hewan)
      } else if (this.report.proses == 'penyembelihan') {
        formData.append('penyembelih', this.report.penyembelih)
        formData.append('hari_penyembelihan', this.report.hari_penyembelihan)
        formData.append('pukul_penyembelihan', this.report.pukul_penyembelihan)
      } else if (this.report.proses == 'pembagian'){
        formData.append('lokasi_pembagian', this.report.lokasi_pembagian)
        formData.append('penanggung_jawab', this.report.penanggung_jawab)
        formData.append('hari_pembagian', this.report.hari_pembagian)
      } else if (this.report.proses == 'pengiriman'){
        formData.append('supir', this.report.supir)
        formData.append('no_supir', this.report.no_supir)
        formData.append('mobil_pengirim', this.report.mobil_pengirim)
      } else {
        formData.append('penerima', this.report.penerima)
        formData.append('hari_diterima', this.report.hari_diterima)
        formData.append('pukul_diterima', this.report.pukul_diterima)
      }
      const config = {
        headers: {
            'Content-type': 'multipart/form-data'
        }
      }

      // this.axios.put(`report/${this.$route.params.id_laporan}`, this.formData).then(response => {
      //   console.log(response.data);
      //   this.redirectReportDetail()
      // }).catch(error => {
      //   console.log(error.response);
      // })

      this.axios.post(`updateReport/${this.$route.params.id_laporan}`, formData).then(response => {
        console.log(response.data);
        this.redirectReportDetail()
      }).catch(error => {
        console.log(error.response);
      })
    },

  },
  mounted() {
    this.getReportDetail()
    // this.getpembayaranData()
  }
};
</script>

<style scoped>
.btn-check{
  display:none
}
</style>