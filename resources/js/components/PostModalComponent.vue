<template>
  <div
    class="modal fade"
    id="postModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ post.title }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">{{post.content}}</div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["post"],
  created() {
    console.log("modal created");
    // setTimeout(function() {
    //   $("#postModal").modal("show");
    // }, 4000);
  },
  watch: {
      post: function(newVal, oldVal){
 $("#postModal").modal("show");
      }
  }
};
</script>