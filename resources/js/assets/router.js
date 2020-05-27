window.Vue = require("vue");
import VueRouter from "vue-router";

import PostList from "../components/PostListComponent.vue";
import PostDetail from "../components/PostDetailComponent.vue";
import PostCategory from "../components/PostCategoryComponent.vue";

import Contact from "../components/ContactComponent.vue";


Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        { path: "/", component: PostList, name: "list" },
        { path: "/detail/:id", component: PostDetail, name: "detail"  },
        { path: "/post-category/:category_id", component: PostCategory, name: "post-category"  },
        { path: "/contact", component: Contact, name: "contact" },
    ] // short for `routes: routes`
});
