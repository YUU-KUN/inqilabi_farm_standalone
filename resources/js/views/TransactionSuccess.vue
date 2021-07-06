<template>
  <div class="justify-content-center" style="justify-content:center; margin:50px auto; padding: 0 100px; background-color: white">
    <!-- <h2 v-if="!uploaded"><b>Upload Bukti Transfer</b></h2>  -->
      <div class="text-center">
        <div class="align-items-center my-4">
            <div class="justify-content-center">
                <h4>Terimakasih, Kami akan mengkonfirmasi pembayaran Anda</h4>
                <h4>Silahkan kembali ke dashboard</h4>
            </div>
        </div>
      </div>

    <div class="d-flex justify-content-center my-5">
        <router-link to="/" class="text-light text-decoration-none">
            <button class="btn btn-danger px-4">
                Dashboard
            </button>
        </router-link>
    </div>
  </div>
</template>

<script>
export default {
    
  data() {
    return {
    };
  },
  methods: {
      
  }
};
</script>
