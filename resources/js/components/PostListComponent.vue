<template>
  <div>
    <post-list-default 
    :key="currentPage"
    @getCurrentPage="getCurrentPage"
    v-if="total > 0" 
    :posts="posts" 
    :pCurrentPage="currentPage"
    :total="total"></post-list-default>
  </div>
</template>
<script>
export default {
  created() {
    this.getPosts();
  },
  methods: {
    postClick: function(p) {
      this.postSelected = p;
    },
    getPosts() {
      fetch("/api/post?page="+this.currentPage)
        .then(response => response.json())
        .then(json => {
          this.posts = json.data.data;
          this.total = json.data.last_page;
          console.log("getPosts "+this.total)
        });

      /* fetch('/api/post')
      .then(function(response){
        return response.json()
      })
      .then(function(json){
        this.posts = json.data.data;
       // console.log(json.data.data[0].title);
      })*/
    },
    getCurrentPage:function(val){
      this.currentPage = val
      this.getPosts()
    }
  },
  data: function() {
    return {
      postSelected: "",
      posts: [],
      total: 0,
      currentPage:1
    };
  }
};
</script>