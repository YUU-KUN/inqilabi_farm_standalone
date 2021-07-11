<template>
  <!-- <div> -->
    <footer class="footer">
        <img src="require('../../../../img/footer.png" style="width:100%" alt="" srcset="">
    </footer>
    <!-- <div id="add" style="background-color:green; heigth: 100px; width: 100px"></div> -->
  <!-- </div> -->
</template>
<script>
export default {
  props: {
    backgroundColor: String,
    type: String
  },
  data() {
    return {
      year: new Date().getFullYear()
    };
  }
};
</script>
<style>
#add {
  background-color: red
}
</style>
