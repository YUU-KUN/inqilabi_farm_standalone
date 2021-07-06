<template>
  <div style="justify-content:center; margin:50px auto; padding: 0 100px; background-color: white">
    <h2 v-if="!uploadImagePage"><b>Konfirmasi</b></h2> 
    <h2 v-else><b>Upload Bukti Transfer</b></h2> 
    <!-- <pre>{{profile}}</pre> -->
    <!-- table -->
      <div v-if="packages && !uploadImagePage" class="text-center" style="margin: 50px auto; padding: 0 100px">
          <div class="row">
            <div class="col-3">
                <h4 v-if="confirmPage">Atas Nama</h4>
            </div>
            <div class="col-2">
                <h4>Jenis Hewan</h4>
            </div>
            <div class="col">
                <h4>Tipe</h4>
            </div>
            <div class="col">
                <h4>Harga</h4>
            </div>
            <div class="col">
                <h4>Jumlah</h4>
            </div>
            <div class="col">
                <h4><b>Total</b></h4>
            </div>
        </div>
        <div class="row d-flex align-items-center mb-4">
            <div class="col-3" v-if="!confirmPage">
                <img v-if="packages.tipe == 'kambing_jantan'" src="../../../public/img/domba_jantan.png" alt="Product Image" width="250px">
                <img v-if="packages.tipe == 'kambing_betina'" src="../../../public/img/domba_betina.svg" alt="Product Image" width="250px">
                <img v-if="packages.tipe == 'sapi'" src="../../../public/img/patungan_sapi.svg" alt="Product Image" width="250px">
            </div>
            <div class="col-3" v-if="confirmPage" >
                <h4><b>{{nama}}</b></h4>
            </div>
            <div class="col-2">
                <h4><b>{{packages.nama}} <span class="text-danger">{{packages.variant}}</span></b></h4>
            </div>
            <div class="col">
                <h4><b>{{packages.tipe.replace("_", " ").toUpperCase()}}</b></h4>
            </div>
            <div class="col">
                <h4><b>{{packages.harga | rupiah}}</b></h4>
            </div>
            <div class="col">
                <b-form-spinbutton v-if="!confirmPage" id="sb-inline" v-model="jumlah" inline></b-form-spinbutton>
                <h4 v-if="confirmPage"><b>{{jumlah}}</b></h4>
            </div>
            <div class="col">
                <h4><span class="text-danger"><b>{{totalPrice | rupiah}}</b></span></h4>
            </div>
        </div>
      </div>

    <div v-if="!confirmPage && !uploadImagePage" class=" d-flex justify-content-center" style="margin: 25px">
        <div>
            <div>
                <div class="row">
                    <div class="col-3">
                        <label for="nama" class="col-form-label"><h5>Atas Nama</h5></label>
                    </div>
                    <div class="col-9">
                        <input type="text" id="nama" class="form-control" v-model="nama" placeholder="Nama Lengkap" style="width: 750px" required>
                        <!-- <select name="" id="nama" class="form-control" style="width: 750px">
                            <option value="" selected disabled>Nama</option>
                        </select> -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="mandiri" v-model="mandiri" >
                            <label for="mandiri">
                                Isi dengan data diri
                            </label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-3">
                        <label for="nama" class="col-form-label"><h5>Didedikasikan Untuk</h5></label>
                    </div>
                    <div class="col-9">
                        <input type="text" id="dedikasi" class="form-control" v-model="dedikasi" placeholder="Diri Sendiri / Alm. / Almh. / Nama Masjid" style="width: 750px" required>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-3">
                        <label for="nama" class="col-form-label"><h5>Penyaluran</h5></label>
                    </div>
                    <div class="col-9">
                        <div class="card btn-group btn-group-toggle" style="width: 750px">
                            <div class="row m-2">
                                <div class="col d-flex align-items-center ">
                                    <a class="btn btn-danger btn-sm px-3 mx-2" data-toggle="collapse" href="#option1" role="button" aria-expanded="false" aria-controls="option1">
                                        <b>?</b>
                                    </a>
                                    <b>Biar kami yang menyalurkan ke tempat yang membutuhkan</b>
                                    <!-- <button class="btn btn-outline-danger ml-auto px-4 py-0" type="button">Pilih</button> -->
                                    <div class="btn-group btn-group-toggle ml-auto ">
                                        <label class="btn px-4 py-0" :class="class_option1">
                                            <input type="radio" name="opsi_penyaluran" value="inqilabi_farm" v-model="proses" checked> Pilih
                                        </label>
                                    </div>
                                </div>

                                <!-- DESKRIPSI -->
                                <div class="collapse" id="option1">
                                <p>
                                    <div class="card card-body py-3">
                                        Anda  menyerahkan sepenuhnya amanah kurban anda kepada kami, segala proses
                                    akan kami selesaikan dengan baik dan memberikan laporan kepada anda. Anda
                                    dapat melihat progres terbaru di profil > laporan dan anda juga akan mendapatkan
                                    laporan update secara realtime via nomor whatsapp yang sudah didaftarkan.
                                    </div>
                                </div>
                            </div>

                            <div class="row m-2">
                                <div class="col d-flex align-items-center ">
                                <a class="btn btn-danger btn-sm px-3 mx-2" data-toggle="collapse" href="#option2" role="button" aria-expanded="false" aria-controls="option2">
                                    <b>?</b>
                                </a>
                                <b>Kirim hewan kurban ke tempat anda / masjid pilihan anda</b>

                                <div class="btn-group btn-group-toggle ml-auto " >
                                    <label class="btn px-4 py-0" :class="class_option2">
                                        <input type="radio" name="opsi_penyaluran" value="dikirim" v-model="proses"> Pilih
                                    </label>
                                </div>
                                </div>
                                <!-- DESKRIPSI -->
                                <div class="collapse" id="option2">
                                <p>
                                    <div class="card card-body py-3">
                                        Hewan kurban akan kami kirimkan ke masjid / lokasi yang anda inginkan.  Silahkan mengisi formulir untuk lokasi pengiriman.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <br> -->
                        <!-- <input type="checkbox"> -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="agreement" v-model="isAgree" >
                            <label for="agreement">
                                Saya menyetujui <router-link to="" class="text-warning font-weight-bold text-decoration-none">Syarat dan Ketentuan</router-link>
                            </label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row" v-if="proses == 'dikirim'">
                    <div class="col-3">
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col">
                                <label for="nama_penerima" class="col-form-label"><h5>Formulir Penyaluran</h5></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="defaultData" v-model="fillDefault" >
                                    <label for="defaultData">
                                        Isi data default
                                    </label>
                                </div>
                                <!-- <div class="form-check" v-else>
                                    <input  @click="reset" class="form-check-input" type="reset" id="reset">
                                    <label for="reset"></label>
                                </div> -->
                            </div>
                        </div>
                        <form>
                            <div class="mb-3">
                                <input type="text" id="nama_penerima" class="form-control" v-model="nama_penerima" placeholder="Nama Penerima" style="width: 750px">
                                <!-- <select id="nama" class="form-control" style="width: 750px">
                                    <option value="" selected disabled>Nama Penerima</option>
                                </select> -->
                            </div>
                            <div class="mb-3">
                                <input type="number" class="form-control" style="width: 750px" v-model="noWa_penerima" placeholder="No. Wa">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" style="width: 750px" v-model="masjid_penerima" placeholder="Tempat Penerima (Masjid/Musholla)">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" style="width: 750px" v-model="alamat_penerima" placeholder="Alamat">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" style="width: 750px" v-model="kecamatan_penerima" placeholder="Kecamatan">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" style="width: 750px" v-model="kota_penerima" placeholder="Kota">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" style="width: 750px" v-model="provinsi_penerima" placeholder="Provinsi">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div v-if="confirmPage && !uploadImagePage" class="text-left" style="margin: 50px auto; ">
        <h5 class="text-danger font-weight-bold">
            Cara Pembayaran
        </h5>
        <span class="d-flex">Transfer ke</span>
        <span class="d-flex">Akun Bank : &nbsp; <b>BCA</b></span>
        <span class="d-flex">No. Rekening : &nbsp; <b>7012345678907</b></span>
    </div>

      <!-- UPLOAD BUKTI PEMBAYARAN -->
    <div v-if="uploadImagePage" class="text-center" style="margin: 50px auto; padding: 0 100px">
        <div class="align-items-center my-4">
            <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" useCustomSlot @vdropzone-complete="afterComplete">
                <div class="dropzone-custom-content" >
                    <img src="../../../public/img/entypo_upload-to-cloud.svg" alt="Cloud Upload Icon" height="75px">
                    <div class="subtitle">Upload Foto Hewan</div>
                </div>
              </vue-dropzone>
            <div class="justify-content-center" v-if="uploaded">
                <h4>Terimakasih, Kami akan mengkonfirmasi pembayaran Anda</h4>
                <h4>Silahkan kembali ke dashboard</h4>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center my-5">
        <button v-if="!confirmPage && !uploadImagePage" class="btn btn-danger px-4" @click="confirm">
            Lanjutkan
        </button>
        <button v-if="confirmPage && !uploadImagePage" class="btn btn-danger px-4" @click="bayar">
            Bayar Sekarang
        </button>
        <button v-if="uploadImagePage" class="btn btn-danger px-4" @click="upload">
            Upload
        </button>
    </div>
    {{check}}
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
        dedikasi: '',
        mandiri: false,
        profile: '',
        packages: '',
        class_option1: 'btn-danger',
        class_option2: 'btn-outline-danger',
        confirmPage: false,

        //Penerima
        nama_penerima: '',
        noWa_penerima: '',
        masjid_penerima: '',
        alamat_penerima: '',
        kecamatan_penerima: '',
        kota_penerima: '',
        provinsi_penerima: '',
        
        nama: '',
        jumlah: 1,
        proses: 'inqilabi_farm',
        bukti_transfer: '',
        isAgree: false,
        fillDefault: false,
        uploadImagePage: false,

        uploaded: false,
        dropzoneOptions: {
            url: 'https://httpbin.org/post',
            thumbnailWidth: 150,
            maxFilesize: 0.5,
            headers: { "My-Awesome-Header": "header value" }
        }
    };
  },
  methods: {
        getPackage() {
            this.axios.get(`package/${this.$route.params.package_id}`).then(response => {
                this.packages = response.data
            }).catch(error => {
                console.log(error.response);
            })
        },
        confirm() {
            if (!this.nama || !this.dedikasi) {
                alert("Mohon lengkapi form")
            } else if (!this.isAgree) {
                alert('Mohon setujui Syarat & Ketentuan')
            } else {
                this.confirmPage = !this.confirmPage
            }
        },
        bayar() {
            this.uploadImagePage = true
            // const form = {
            //     package_id: this.$route.params.package_id,
            //     nama: this.nama,
            //     jumlah: this.jumlah,
            //     total: this.packages.harga * this.jumlah,
            //     proses: this.proses,
            //     isAgree: this.isAgree,
            //     bukti_transfer: this.bukti_transfer
            // }
            // this.axios.post('pembayaran', form).then(response => {
            //     console.log(response);
            //     this.uploadImagePage = true
            // }).catch(error => console.log(error.response))
        },
        upload() {
            if (!this.bukti_transfer) {
                alert('Mohon upload bukti pembayaran')
                return
            }
            const formData = new FormData()
            formData.append('package_id', this.$route.params.package_id)
            formData.append('nama', this.nama)
            formData.append('jumlah', this.jumlah)
            formData.append('total', this.packages.harga * this.jumlah)
            formData.append('proses', this.proses)
            formData.append('isAgree', this.isAgree)
            formData.append('bukti_transfer', this.bukti_transfer)
            formData.append('dedikasi', this.dedikasi)

            //Pengiriman
            if (this.proses == 'dikirim') {
                formData.append('nama_penerima', this.nama_penerima)
                formData.append('no_wa', this.noWa_penerima)
                formData.append('tempat_penerima', this.masjid_penerima)
                formData.append('alamat', this.alamat_penerima)
                formData.append('kecamatan', this.kecamatan_penerima)
                formData.append('kota', this.kota_penerima)
                formData.append('provinsi', this.provinsi_penerima)
                
            }
            // const form = {
            //         // id_pembayaran: statis
            //         nama_penerima: this.nama_penerima,
            //         no_wa: this.noWa_penerima,
            //         tempat_penerima: this.masjid_penerima,
            //         alamat: this.alamat_penerima,
            //         kecamatan: this.kecamatan_penerima,
            //         kota: this.kota_penerima,
            //         provinsi: this.provinsi_penerima,
            //     }

            // const form = {
            //     package_id: this.$route.params.package_id,
            //     nama: this.nama,
            //     jumlah: this.jumlah,
            //     total: this.packages.harga * this.jumlah,
            //     proses: this.proses,
            //     isAgree: this.isAgree,
            //     bukti_transfer: this.bukti_transfer
            // }
            this.axios.post('pembayaran', formData).then(response => {
                console.log(response.data);
                this.$router.push('transactionSuccess')
            }).catch(error => console.log(error.response))

            // const form = {
            //     package_id: this.$route.params.package_id,
            //     bukti_transfer: this.bukti_transfer
            // }
            // this.axios.post('uploadBuktiTransfer', form).then(response => {
            //     this.$router.push('transactionSuccess')
            // }).catch(error => {
            //     console.log(error.response);
            // })
        },
        afterComplete(file) {
            this.bukti_transfer = file
            console.log(file);
        },
        getDefaultData() {
            this.axios.get('profile').then(response => {
                this.profile = response.data.user
            }).catch(error => {
                console.log(error.response);
            })
        },
        fillDefaultData() {
            const profile = this.profile
            if (!profile.alamat || !profile.kota || !profile.provinsi) {
                // confirm('Mohon lengkapi profile anda')
                if (confirm('Mohon lengkapi profile anda')) {
                    this.$router.push('profileCompletion')
                } else {
                    this.fillDefault = false
                    return 0
                }
            }
            this.nama_penerima = this.profile.name
            this.noWa_penerima = this.profile.phone
            // this.masjid_penerima = this.profile.name
            this.alamat_penerima = this.profile.alamat
            this.kecamatan_penerima = this.profile.kecamatan
            this.kota_penerima = this.profile.kota
            this.provinsi_penerima = this.profile.provinsi
        },
        reset() {
            // this.fillDefault = false
            this.nama_penerima = ''
            this.noWa_penerima = ''
            // this.masjid_penerima = ''
            this.alamat_penerima = ''
            this.kecamatan_penerima = ''
            this.kota_penerima = ''
            this.provinsi_penerima = ''
        }
  },
  computed: {
      check() {
          if (this.proses === 'dikirim') {
              this.class_option1 = 'btn-outline-danger'
              this.class_option2 = 'btn-danger'
          } else {
              this.class_option1 = 'btn-danger'
              this.class_option2 = 'btn-outline-danger'
          }
      },
      totalPrice() {
          const total = this.packages.harga * this.jumlah
          return total
      },
  },
  watch: {
      mandiri() {
        if (this.mandiri) {
            this.nama = this.profile.name
        } else {
            this.nama = ''
        }
      },
      fillDefault() {
        if (this.fillDefault) {
            this.fillDefaultData()
        } else {
            this.reset()
        }
      }
  },
  mounted() {
      this.getPackage()
      this.getDefaultData()
  }
};
</script>

<style scoped>

.card button:hover {
  opacity: 0.7;
}
</style>
