<template>
  <div style="justify-content:center; margin:50px auto; padding: 0 100px; background-color: white">
    <h2><b>Laporan</b></h2> 
      <div class="text-center" style="margin: 50px auto; ">
        <div class="align-items-center my-4">
          <div class="card p-3">
            <div class="table-responsive">
                  <b-table
                    borderless
                    id="my-table"
                    class="table table-bordered"
                    :items="reports"
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
                      </template>>
                      <template #head(proses_kurban)="data">
                        <h4>{{ data.label}}</h4>
                      </template>
                      <template #head(sertifikat)="data">
                        <h4>{{ data.label}}</h4>
                      </template>
                      <template #head(aksi)="data">
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
                          <h5 class="font-weight-normal" v-if="data.item.package.tipe == 'kambing_betina'">Betina</h5>
                          <h5 class="font-weight-normal" v-if="data.item.package.tipe == 'sapi'">Sapi</h5>
                      </template>
                      <template #cell(jumlah)="data">
                        <h5 class="font-weight-normal">{{data.item.jumlah}}</h5>
                      </template>
                      <template #cell(proses_kurban)="data">
                        <h5 class="font-weight-normal" v-if="data.item.proses == 'inqilabi_farm'">Inqilabi Farm</h5>
                        <h5 class="font-weight-normal" v-else>Dikirim</h5>
                      </template>
                      <template #cell(sertifikat)="data">
                        <!-- <a href="#" @click="generateSertfikat(data.item.id)" data-toggle="modal" :data-target="'#modalSertifikat'+data.item.id"> -->
                        <img @click="generateSertfikat(data.item.id)" style="cursor: pointer" src="require('../../../img/ant-design_download-outlined.svg" alt="download sertifikat button">

                        <!-- Modal -->
                        <div class="modal fade" :id="'modalSertifikat'+data.item.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                {{data.item.id}}
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <vue-html2pdf
                          :filename="'Sertifikat Kurban '+ data.item.created_at"
                          :show-layout="false"
                          :float-layout="true"
                          :enable-download="true"
                          :preview-modal="false"
                          :paginate-elements-by-height="1400"
                          :pdf-quality="2"
                          :manual-pagination="true"
                          pdf-format="a4"
                          pdf-orientation="landscape"
                          pdf-content-width="3508px"
                          @hasStartedGeneration="hasStartedGeneration()"
                          @hasGenerated="hasGenerated($event)"
                          htmlToPdfOptions: options

                          ref="sertifikat"
                          >
                            <section slot="pdf-content" class="px-0">
                              <p style="z-index: 3; position: absolute; top: 340px; left: 220px"><b>{{returnID(data.item.id)}}/QB/IC/{{returnMonthRomawi(data.item.created_at)}}/{{returnYear(data.item.created_at)}}</b></p>
                              <h1 style="z-index: 2; position: absolute; top: 390px; left: 140px"><b>{{data.item.nama}}</b></h1>
                              <h1 style="z-index: 2; position: absolute; top: 480px; left: 140px"><b>{{data.item.total | rupiah}}</b></h1>
                              <p style="z-index: 3; position: absolute; top: 515px; left: 635px" class="text-white font-weight-bold">Malang, {{data.item.created_at | formatDate}}</p>
                              <p style="z-index: 3; position: absolute; top: 590px; left: 325px"><b>{{data.item.dedikasi}}</b></p>
                              <img src="require('../../../img/SERTIFIKAT.png" width="90%" class="mx-5" alt="Sertifikat Kurban">
                                <!-- PDF Content Here -->
                            </section>
                        </vue-html2pdf>
                        <!-- <button @click="generateSertifikat(data.item.id)" class="btn btn-success">
                        </button> -->
                          <!-- <span v-if="data.item.report">
                            <h5 class="font-weight-normal" v-if="data.item.report.status == 'Foto Hewan'">Foto Hewan</h5>
                            <h5 class="font-weight-normal" v-else>-</h5>
                          </span>
                          <span v-else>-</span> -->
                      </template>
                      <template #cell(aksi)="data">
                            <button @click="detailReport(data.item.id)" class="btn btn-danger text-light font-weight-bold">Detail</button>
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
import VueHtml2pdf from 'vue-html2pdf'
import moment from 'moment'
export default {
  components: {
      VueHtml2pdf
  },
  data() {
    return {
      reports: [],
      dataPembayaran: '',
      currentPage: 1,
      perPage: 10,
      fields: [
        {key: 'tanggal', label: 'Tanggal'},
        {key: 'atas_nama', label: 'Atas Nama'},
        {key: 'jenis_hewan', label: 'Jenis Hewan'},
        {key: 'tipe', label: 'Tipe'},
        {key: 'jumlah', label: 'Jumlah'},
        {key: 'proses_kurban', label: 'Proses Kurban'},
        {key: 'sertifikat', label: 'Sertifikat'},
        {key: 'aksi', label: 'Aksi'},
      ],
      monthRomawi: ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII']
      // filename="Sertifikat Kurban"
      // filename = filename + data.item.created_at | formatDate
    };
  },
  methods: {
    getReports() {
      this.axios.get('myReport').then(response => {
        this.reports = response.data
      }).catch(error => {
        console.log(error.response);
      })
    },
    detailReport(id) {
        this.$router.push({name: 'Report', params: {id_pembayaran: id}})
    },
    generateSertfikat(id) {
      this.$refs.sertifikat.generatePdf()
    },
    returnYear(date) {
      return moment(date).year()
    },
    returnMonthRomawi(date) {
      return this.monthRomawi[moment(date).month()-1]
    },
    returnID(id){
      return 183 + id
    }
  },
  computed: {
    rows() {
        return this.reports.length
    },
  },
  mounted() {
    this.getReports()
  }
};
</script>
