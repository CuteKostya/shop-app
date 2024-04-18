<template>
  <div class="stars">
    <label class="stars__label stars_id" v-for="i in [5,4,3,2,1]">
      <input type="radio" name="star"  v-bind:value="i" class="stars__input">
    </label>
  </div>
  <div>
    <textarea class="form-control" aria-label="With textarea" id="textComment"></textarea>
    </br>
    <button type="submit" class="btn btn-primary" @click="addComment()">Отправить</button>
  </div>
</template>

<script>
export default {
  name: 'adding-comment-component',
  data() {
    return {
      textComment: null,
      grade: null,
    }
  },
  props: {
    product_id: {
      type: Number,
    },
  },
  methods: {
    addComment() {
      this.textComment = $("#textComment").val();
      this.grade = $(".stars").children(".checked").children().val();

      axios.post( "/comment/store", {
        params: {
          "_token": "{{ csrf_token() }}",
          productId: this.product_id,
          textComment: this.textComment,
          grade: this.grade,
        }
      })
          .then(res => {
            console.log(res);
            location.reload();
          })
          .catch(function (error) {
            alert(error)
            console.log(error);
          })
          .finally(function () {
            // выполняется всегда
          });
    }
  },
}

</script>
