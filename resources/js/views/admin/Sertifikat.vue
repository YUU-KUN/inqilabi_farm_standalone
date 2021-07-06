<template>
  <div style="justify-content:center; margin:50px auto; padding: 0 100px; background-color: white">
    <h2><b>Sertifikat</b></h2> 
      <div class="text-center" style="margin: 50px auto; ">
        <div class="align-items-center my-4">
          <div class="card p-3">
            <div class="table-responsive">
                  <b-table
                    borderless
                    id="my-table"
                    class="table table-bordered"
                    :items="sertifikats"
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
                      <template #head(proses_kurban)="data">
                        <h4>{{ data.label}}</h4>
                      </template>
                      <template #head(aksi)="data">
                        <h4>{{ data.label}}</h4>
                      </template>

                      <template v-slot:cell(tanggal)="data">
                          <h5 class="font-weight-normal">{{data.item.pembayaran.created_at | formatDate}}</h5>
                      </template>
                      <template #cell(atas_nama)="data">
                          <h5 class="font-weight-normal">{{ data.item.pembayaran.nama}}</h5>
                      </template>
                      <template #cell(jenis_hewan)="data">
                          <h5><span class="font-weight-normal">{{data.item.pembayaran.package.nama}}</span> <span class="text-danger font-weight-bold"> {{data.item.pembayaran.package.variant}}</span></h5>
                      </template>
                      <template #cell(tipe)="data">
                          <h5 class="font-weight-normal" v-if="data.item.pembayaran.package.tipe == 'kambing_jantan'">Jantan</h5>
                          <h5 class="font-weight-normal" v-if="data.item.pembayaran.package.tipe == 'sapi'">Sapi</h5>
                      </template>
                      <template #cell(jumlah)="data">
                        <h5 class="font-weight-normal">{{data.item.pembayaran.jumlah}}</h5>
                      </template>
                      <template #cell(total)="data">
                        <h5 class="font-weight-normal">{{data.item.pembayaran.total | rupiah}}</h5>
                      </template>
                      <template #cell(proses_kurban)="data">
                        <h5 class="font-weight-normal" v-if="data.item.pembayaran.proses == 'inqilabi_farm'">Inqilabi Farm</h5>
                        <h5 class="font-weight-normal" v-else>Dikirim</h5>
                      </template>
                      <template #cell(aksi)="data">
                        <span v-if="data.item.file">
                          <a data-fancybox :href="baseurl + data.item.file" class="btn btn-danger btn-sm font-weight-bold">Lihat</a>
                        </span>
                        <span v-else>
                          <button @click="addCertificate(data.item.id)" class="btn btn-success btn-sm">Tambah</button>
                        </span>
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
      sertifikats: [],
      currentPage: 1,
      perPage: 5,
      fields: [
        {key: 'tanggal', label: 'Tanggal'},
        {key: 'atas_nama', label: 'Atas Nama'},
        {key: 'jenis_hewan', label: 'Jenis Hewan'},
        {key: 'tipe', label: 'Tipe'},
        {key: 'jumlah', label: 'Jumlah'},
        {key: 'proses_kurban', label: 'Proses Kurban'},
        {key: 'aksi', label: 'Aksi'},
      ],
    };
  },
  methods: {
    getSertifikat() {
      this.axios.get('sertifikat').then(response => {
        this.sertifikats = response.data
      }).catch(error => {
        console.log(error.response);
      })
    },
    addCertificate(id) {
      this.$router.push({name: 'Create Certificate', params: id})
    }
  },
  computed: {
    rows() {
        return this.sertifikats.length
    },
  },
  mounted() {
    this.getSertifikat()
  }
};
</script>
