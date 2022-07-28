<template>
    <section class="posts">
        <div class="container">
            <div class="row">
                <div class="col-4 mb-5" v-for="post in posts" :key="post.slug">
                    <BaseCard :title="post.title" :content="post.content" :slug="post.slug"/>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import BaseCard from '../commons/BaseCard.vue';

    export default {
        name: 'PostsSection',
        data() {
            return {
                posts: []
            };
        },
        components: {
            BaseCard,
        },
        created() {
            axios.get('/api/posts')
            .then((response) => {
                this.posts = response.data;
            })
        },
    }
</script>

<style lang="scss" scoped>
    .posts {
        padding: 3.125rem 0;
    }
</style>