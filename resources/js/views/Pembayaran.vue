<template>
  <div style="justify-content:center; margin:50px auto; padding: 0 100px; background-color: white">
    <h2><b>Pembayaran</b></h2> 
      <div class="text-center" style="margin: 50px auto; ">
        <div class="align-items-center my-4">
          <div class="card p-3">
            <div class="table-responsive">
                  <b-table
                  borderless
                    id="my-table"
                    class="table table-bordered"
                    :items="pembayarans"
                    :per-page="perPage"
                    :current-page="currentPage"
                    :fields="fields"
                  >

                      <template #head(tanggal)="data">
                        <h4>{{ data.label}}</h4>
                      </template>
                      <template #head(atas_nama)="data">
                        <h4>{{ data.label}}</h4>
                      </template>
                      <template #head(jenis_hewan)="data">
                        <h4>{{ data.label}}</h4>
                      </template>
                      <template #head(tipe)="data">
                        <h4>{{ data.label}}</h4>
                      </template>
                      <template #head(jumlah)="data">
                        <h4>{{ data.label}}</h4>
                      </template>
                      <template #head(total)="data">
                        <h4>{{ data.label}}</h4>
                      </template>
                      <template #head(proses_kurban)="data">
                        <h4>{{ data.label}}</h4>
                      </template>
                      <template #head(bukti_transfer)="data">
                        <h4>{{ data.label}}</h4>
                      </template>
                      <template #head(status)="data">
                        <h4>{{ data.label}}</h4>
                      </template>

                      <template v-slot:cell(tanggal)="data">
                          <h5 class="font-weight-normal">{{data.item.created_at | formatDate}}</h5>
                      </template>
                      <template #cell(atas_nama)="data">
                          <h5 class="font-weight-normal">{{ data.item.nama}}</h5>
                      </template>
                      <template #cell(jenis_hewan)="data">
                          <h5><span class="font-weight-normal">{{data.item.package.nama}}</span> <span class="text-danger font-weight-bold"> {{data.item.package.variant}}</span></h5>
                      </template>
                      <template #cell(tipe)="data">
                          <h5 class="font-weight-normal" v-if="data.item.package.tipe == 'kambing_jantan'">Jantan</h5>
                          <h5 class="font-weight-normal" v-if="data.item.package.tipe == 'sapi'">Sapi</h5>
                      </template>
                      <template #cell(jumlah)="data">
                        <h5 class="font-weight-normal">{{data.item.jumlah}}</h5>
                      </template>
                      <template #cell(total)="data">
                        <h5 class="font-weight-normal">{{data.item.total | rupiah}}</h5>
                      </template>
                      <template #cell(proses_kurban)="data">
                        <h5 class="font-weight-normal" v-if="data.item.proses == 'inqilabi_farm'">Inqilabi Farm</h5>
                        <h5 class="font-weight-normal" v-else>Dikirim</h5>
                      </template>
                      <template #cell(bukti_transfer)='data'>
                        <!-- <button v-if="data.item.bukti_transfer" data-toggle="modal" :data-target="'#modalBuktiTransfer'+data.index" class="btn btn-primary btn-sm font-weight-bold">Lihat</button> -->
                        <a v-if="data.item.bukti_transfer" data-fancybox :href="'require(`../../../bukti_transfer/${data.item.bukti_transfer}'" class="btn btn-primary btn-sm font-weight-bold">Lihat</a>
                        <!-- <img v-if="data.item.bukti_transfer" :src="baseurl + data.item.bukti_transfer" alt="Bukti Pembayaran" class="img-thumbnail"> -->
                        <!-- <button v-else data-toggle="modal" :data-target="'#modalUploadBukti'+data.index" class="btn btn-primary btn-sm font-weight-bold">Upload Bukti Transfer</button> -->
                        <span v-else>-</span>

                        <div class="modal fade" :id="'modalUploadBukti'+data.index" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Form Bukti Pembayaran</h5>
                              </div>
                              <div class="modal-body">
                                <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" useCustomSlot @vdropzone-complete="afterComplete">
                                  <div class="dropzone-custom-content" >
                                      <img src="require('../../../img/entypo_upload-to-cloud.svg" alt="Cloud Upload Icon" height="75px">
                                      <div class="subtitle">
                                        Upload Bukti Pembayaran
                                      </div>
                                  </div>
                                </vue-dropzone>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tutup</button>
                                <button @click="uploadBukti(data.index)" type="button" class="btn btn-success">Upload</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      
                      </template>
                      <template #cell(status)="data">
                        <button v-if="data.item.status == 'success'" class="btn btn-success btn-sm text-light font-weight-bold">Berhasil</button>
                        <button v-else-if="data.item.status == 'failed'" class="btn btn-danger btn-sm text-light font-weight-bold">Gagal</button>
                        <button v-else class="btn btn-warning btn-sm text-light font-weight-bold">Pending</button>
                      </template>
                  </b-table>
                  <br>
                  <b-pagination
                    v-model="currentPage"
                    :total-rows="rows"
                    :per-page="perPage"
                    aria-controls="my-table"
                    align="center"
                  ></b-pagination>
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
      baseurl: 'http://127.0.0.1:8000/bukti_transfer/',
      pembayarans: [],
      currentPage: 1,
      bukti_transfer: '',
      perPage: 5,
      fields: [
        {key: 'tanggal', label: 'Tanggal'},
        {key: 'atas_nama', label: 'Atas Nama'},
        {key: 'jenis_hewan', label: 'Jenis Hewan'},
        {key: 'tipe', label: 'Tipe'},
        {key: 'jumlah', label: 'Jumlah'},
        {key: 'total', label: 'Total'},
        {key: 'proses_kurban', label: 'Proses Kurban'},
        {key: 'bukti_transfer', label: 'Bukti Transfer'},
        {key: 'status', label: 'Status'},
      ],
      dropzoneOptions: {
          url: 'https://httpbin.org/post',
          maxFilesize: 1,
        //   headers: { "My-Awesome-Header": "header value" }
      }
      // fields: ['tanggal', 'atas_nama', 'jenis_hewan', 'tipe', 'jumlah', 'total', 'proses_kurban', 'bukti_transfer', 'status'],
    };
  },
  methods: {
    getPembayaranUser() {
      this.axios.get('getPembayaranUser').then(response => {
        this.pembayarans = response.data.data
        // console.log(this.pembayarans);
      }).catch(error => {
        console.log(error.response);
      })
    },
    afterComplete(file) {
        this.bukti_transfer = file
        console.log(file);
    },
    uploadBukti(index) {
      const formData = new FormData()
      // formData.append('package_id', this.pembayarans[index].package_id)
      formData.append('bukti_transfer', this.bukti_transfer)

      const form = {
        package_id: this.pembayarans[index].package_id,
        bukti_transfer: this.bukti_transfer
      }
      // const id = this.pembayarans[index].id
      this.axios.post('uploadBuktiTransfer', form).then(response => {
        console.log(response.data)
        this.getPembayaranUser()
      }).catch(error => {
        console.log(error.response)
      })
    }
  },
  computed: {
    rows() {
        return this.pembayarans.length
    },
  },
  mounted() {
    this.getPembayaranUser()
  }
};
</script>
