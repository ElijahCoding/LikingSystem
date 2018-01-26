<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Timeline</div>

                    <div class="panel-body">
                        <post-form></post-form>
                        <hr>
                        <post v-for="post in posts" :post="post" :key="post.id"></post>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import eventHub from '../event'
    import Post from './Post.vue'
    import PostForm from './PostForm.vue'

    export default {
        components: {
          Post, PostForm
        },

        data() {
          return {
            posts: []
          }
        },

        methods: {
          addPost (post) {
            this.posts.unshift(post)
          }
        },

        mounted() {
            eventHub.$on('post-added', this.addPost)

            this.$http.get('/posts').then((response) => {
              this.posts = response.data
              // console.log(response.data);
            })
        }
    }
</script>
