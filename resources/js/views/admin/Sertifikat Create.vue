<template>
  <div style="justify-content:center; margin:50px auto; padding: 0 100px; background-color: white">
    <div class="text-center" style="margin: 50px auto; padding: 0 100px">
      <div class="align-items-center my-4">
        <div class="d-flex align-items-center justify-content-start">
          <!-- Foto Hewan Kurban Anda -->
        <!-- <div class="col-3"> -->
          <h2><b>Upload Sertifikat</b></h2> 
        <!-- </div> -->

        </div>
        
        <div class="card my-4">
          <div class="align-items-center mx-auto my-5" style="width: 750px">
            <div class="col">
                <b-form-group >
                    <b-form-input id="nama" v-model="nama" placeholder="Atas Nama" trim required></b-form-input>
                </b-form-group>
                <b-form-group >
                    <b-form-input id="jenis" v-model="jenis" placeholder="Jenis Hewan" trim required></b-form-input>
                </b-form-group>
                <b-form-group >
                    <b-form-input id="berat" v-model="berat" placeholder="Berat" trim required></b-form-input>
                </b-form-group>
                <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" useCustomSlot @vdropzone-complete="afterComplete">
                    <div class="dropzone-custom-content" >
                        <img src="../../../../public/img/entypo_upload-to-cloud.svg" alt="Cloud Upload Icon" height="75px">
                        <div class="subtitle">
                            Upload Sertifikat
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
    getpembayaranData() {
      const id_pembayaran = this.$route.params.id_pembayaran
      this.axios.get(`pembayaran/${id_pembayaran}`).then(response => {
        this.pembayaranData = response.data
        this.nama = this.pembayaranData.nama
        this.jenis = `${this.pembayaranData.package.nama} ${this.pembayaranData.package.variant}`
        this.berat = this.pembayaranData.package.berat
      }).catch(error => {
        console.log(error);
      })
    },
    uploadCertificate() {
        const form = {
            file: this.file
        }
        this.axios.put(`sertifikat/${this.$route.params.id}`, form).then(response => {
            this.$router.push({name: 'Sertifikat'})
            console.log(response.data);
        }).catch(error => {
            console.log(error.response);
        })
    },
    createReport() {
      const formData = new FormData()
      formData.append('id_pembayaran', this.$route.params.id_pembayaran)
      formData.append('foto', this.foto)
      formData.append('proses', this.proses)

        formData.append('nama', this.nama)
        formData.append('jenis_hewan', this.jenis)
        formData.append('berat_hewan', this.berat)

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