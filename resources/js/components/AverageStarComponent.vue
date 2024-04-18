<template>
  <div class="stars float-right" v-if="product_grade !== 0">
    <label v-for="i in [5,4,3,2,1]" class="stars__label" :class="(product_grade === i) ? ' checked' : ''">
      <input type="radio" name="star" v-bind:value="i" class="stars__input">
    </label>
  </div>
</template>

<script>
export default {
  name: 'example-component',
  data() {
    return {
      product_grad: 0,
    }
  },
  props: {
    product_grade: {
      type: Number,
    },
  },
}
</script>
