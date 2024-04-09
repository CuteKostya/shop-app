<template>
  {{ countProducts }}
</template>

<script>


export default {
  name: 'example-component',
  data() {
    return {
      countProducts: 0,
    }
  },
  mounted: function () {
    this.extracted();
  },
  methods: {
    extracted: function () {
      axios.post('/helper/countProduct', {
        params: {
          "_token": "{{ csrf_token() }}",
        }
      })
          .then(res => {
            this.countProducts = res.data['countProducts'];
          })
          .catch(function (error) {
            console.log(error);
          })
          .finally(function () {
            // выполняется всегда
          });
    },
  },
}

</script>
