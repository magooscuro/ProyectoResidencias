<template>
  <div>
    <div class="card mt-3" v-for="post in posts" :key="post.title">
      <img :src=" '/images/' + post.image" class="card-img-top" />
      <div class="card-body">
        <h5 class="card-title">{{ post.title }}</h5>
        <p class="card-text">{{ post.content }}</p>
        <button class="btn btn-primary" v-on:click="postClick(post)">Ver resumen</button>
        <router-link class="btn btn-success" :to="{name: 'detail', params: {id: post.id}}">Ver</router-link>
      </div>
    </div>
    <modal-post :post="postSelected"></modal-post>

    <v-pagination
      class="mt-3"
      v-model="currentPage"
      :page-count="total"
      :classes="bootstrapPaginationClasses"
      :labels="paginationAnchorTexts"
    ></v-pagination>
  </div>
</template>
<script>
import vPagination from "vue-plain-pagination";

export default {
  props: ["posts","total","pCurrentPage"],
  created() {
    this.currentPage = this.pCurrentPage;
    
  },
  methods: {
    postClick: function(p) {
      this.postSelected = p;
    }
  },
  data: function() {
    return {
      postSelected: "",
      currentPage: 1,
      bootstrapPaginationClasses: {
        ul: "pagination",
        li: "page-item",
        liActive: "active",
        liDisable: "disabled",
        button: "page-link"
      },
      paginationAnchorTexts: {
        first: "",
        prev: "&laquo;",
        next: "&raquo;",
        last: ""
      }
    };
  },
  components: { vPagination },
  watch:{
     currentPage: function(newVal, oldVal){
       console.log(newVal);
       this.$emit('getCurrentPage',newVal);
     }
  }
};
</script>