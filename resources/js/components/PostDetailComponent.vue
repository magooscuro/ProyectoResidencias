<template>
  <div>
    <div v-if="post">
      <div class="card mt-3">
        <div class="card-header">
          <img :src=" '/images/' + post.image.image" class="card-img-top" />
        </div>
        <div class="card-body">
          <h1 class="card-title">{{ post.title }}</h1>
          <router-link class="btn btn-success mb-3 ml-3" :to="{name: 'post-category', params: {category_id: post.category.id}}">{{ post.category.title }}</router-link>
          <p class="card-text">{{ post.content }}</p>
        </div>
      </div>
    </div>
    <div v-else>
      <h1>Post no existe</h1>
    </div>
  </div>
</template>
<script>
export default {
  created() {
    this.getPost();
  },
  methods: {
    getPost: function() {
      fetch("/api/post/" + this.$route.params.id)
        .then(response => response.json())
        .then(json => (this.post = json.data));
    }
  },
  data: function() {
    return {
      postSelected: "",
      post: ""
    };
  }
};
</script>