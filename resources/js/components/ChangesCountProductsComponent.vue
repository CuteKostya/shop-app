<template>
  <div v-if="! isLoading">
  <div v-if="! productCount">
    <input type="button" style="display: {{productCount ? 'none': 'block'}}"
           class="btn btn-lg btn-secondary"
           @click.prevent="addToBasket" id="buttonAddProduct{{product_id}}"
           value='Добавить'/>
  </div>
  <div class="position-absolute pt-5" id="formAddProduct{{product_id}}"
       style="display: {{product_count ? 'block': 'none'}}"
  v-else>

    <div class="row justify-content-start">
      <div class="col-4">
        <button type="submit" class="btn btn-lg btn-secondary" name="action"
                  @click="updateToBasket('decrease')"
                  value="decrease">
          -
        </button>
      </div>
      <div class="col-2">
        <h4 id="countProduct{{product_id}}" class="text-center">
          {{ productCount }}
        </h4>
      </div>
      <div class="col-3">
        <button class="btn btn-lg btn-secondary"
                  name="action"
                  @click="updateToBasket('increase')"
                  value="increase">+
        </button>
      </div>

    </div>
  </div>
  </div>
  <div v-else>
    <div class="loader"></div>
  </div>
</template>

<script>
export default {
  name: 'changes-count-products-component',
  data() {
    return {
      productCount: 0,
      isLoading: false,
    };
  },
  props: {
    product_id: {
      type: Number,
    },
    product_count: {
      type: Number,
    },
  },
  mounted: function () {
    this.productCount = this.product_count;
  },
  methods: {
    addToBasket () {
      this.isLoading = true;
      axios.post( "/basket/store", {
        params: {
          "_token": "{{ csrf_token() }}",
          productId: this.product_id,
        }
      })
          .then(res => {
            this.productCount = res.data['count'];
            this.$store.commit('extracted');
            this.isLoading = false;
          })
          .catch(function (error) {
            console.log(error);
          })
          .finally(function () {
            // выполняется всегда
          });
    },
    updateToBasket (sign) {
      this.isLoading = true;
      axios.put( "/products/" + this.product_id, {
        params: {
          "_token": "{{ csrf_token() }}",
          productId: this.product_id,
          sign: sign,
        }
      })
          .then(res => {
            this.productCount = res.data['count'];
            this.$store.commit('extracted')
            this.isLoading = false;
          })
          .catch(function (error) {
            console.log(error);
          })
          .finally(function () {
            // выполняется всегда
          });
    }
  }
}
</script>
<style>
.loader {
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 50px;
  height: 50px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>