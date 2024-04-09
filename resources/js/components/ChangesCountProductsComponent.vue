<template>
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
</template>

<script>
export default {
  name: 'changes-count-products-component',
  data() {
    return {
      productCount: 0,
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
  computed:{

  },
  methods: {
    addToBasket () {
      axios.post( "/basket/store", {
        params: {
          "_token": "{{ csrf_token() }}",
          productId: this.product_id,
        }
      })
          .then(res => {
            this.productCount = res.data['count'];
            // this.countProducts = res.data;
            // if (res['count'] > 0) {
            //   $("#buttonAddProduct" + res['productId']).css("display", "none");
            //   $("#formAddProduct" + res['productId']).css("display", "block");
            //   $("#countProduct" + res['productId']).text(res['count']);
            // }
          })
          .catch(function (error) {
            console.log(error);
          })
          .finally(function () {
            // выполняется всегда
          });
    },
    updateToBasket (sign) {
      axios.put( "/products/" + this.product_id, {
        params: {
          "_token": "{{ csrf_token() }}",
          productId: this.product_id,
          sign: sign,
        }
      })
          .then(res => {
            this.productCount = res.data['count'];
            // this.countProducts = res.data;
            // $("#countProduct" + this.productId).text(res['count']);
            // if (res['count'] <= 0) {
            //   $("#buttonAddProduct" + this.productId).css("display", "block");
            //   $("#formAddProduct" + this.productId).css("display", "none");
            // }
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
