<template>
  {{ updateProduct }}
</template>

<script>


export default {
  name: 'example-component',
  data() {
    return {}
  },
  mounted: function () {
    this.$store.commit('extracted')
  },
  methods: {},
  computed: {
    updateProduct() {

      return this.$store.state.countProducts
    }
  }
}

</script>
