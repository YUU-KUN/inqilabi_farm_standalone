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
                          <h5 class="font-weight-normal" v-if="data.item.package.tipe == 'kambing_betina'">Betina</h5>
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
                      <template #cell(bukti_transfer)="data">
                          <span v-if="data.item.bukti_transfer">
                            <a data-fancybox :href="baseurl + data.item.bukti_transfer" class="btn btn-primary btn-sm font-weight-bold">Lihat</a>
                          </span>
                          <span v-else>-</span>
                      </template>
                      <template #cell(status)="data">
                          <span v-if="data.item.status == 'pending'" class="d-flex">
                              <button data-toggle="modal" @click="modalApprove" :data-target="'#confirmation'+data.index" class="btn btn-success btn-sm mx-1">V</button>
                              <button @click="modalReject" :data-target="'#confirmation'+data.index" class="btn btn-danger btn-sm mx-1">X</button>
                          </span>
                          <!-- <span v-else> -->
                            <button v-if="data.item.status == 'success'" class="btn btn-success btn-sm text-light font-weight-bold">Success</button>
                            <button v-else-if="data.item.status == 'failed'" class="btn btn-danger btn-sm text-light font-weight-bold">Failed</button>
                          <!-- </span> -->

                          <!-- Modal -->
                          <div class="modal fade" :id="'confirmation'+data.index" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <!-- <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5> -->
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                          <h6>Anda yakin ingin <span v-if="action == 'approve'">menerima</span><span v-if="action == 'reject'">menolak</span> pembayaran atas nama <b class="text-danger">{{data.item.nama}}</b>?</h6>
                                          <!-- <p v-if="pembayaran.user">Kami akan mengirim pesan WhatsApp ke nomor <b class="text-danger">{{pembayaran.user.phone}}</b></p> -->
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                          <button v-if="action == 'approve'" @click="approve(data.item.id)" type="button" data-dismiss="modal" class="btn btn-success">Terima</button>
                                          <button v-if="action == 'reject'" @click="reject(data.item.id)" type="button" data-dismiss="modal" class="btn btn-danger">Tolak</button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- End Modal -->

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
export default {
  data() {
    return {
      baseurl: 'http://127.0.0.1:8000/bukti_transfer/',
      pembayarans: [],
      currentPage: 1,
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
      action: ''
    };
  },
  methods: {
    getPembayarans() {
      this.axios.get('pembayaran').then(response => {
        this.pembayarans = response.data
      }).catch(error => {
        console.log(error.response);
      })
    },
    modalApprove() {
      this.action = 'approve'
    },
    modalReject() {
      this.action = 'reject'
    },
    approve(pembayaran_id){
        this.axios.put(`approve_pembayaran/${pembayaran_id}`)
        .then(this.getPembayarans())
        .catch(error => {
            console.log(error.response);
        })
    },
    reject(pembayaran_id){
        this.axios.put(`reject_pembayaran/${pembayaran_id}`)
        .then(this.getPembayarans())
        .catch(error => {
            console.log(error.response);
        })
    }
  },
  computed: {
    rows() {
        return this.pembayarans.length
    },
  },
  mounted() {
    this.getPembayarans()
  }
};
</script>
