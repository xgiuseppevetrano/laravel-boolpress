<template>
    <div v-if="tag" class="container">
        <div class="tag">
            <h1 class="tag__name">{{tag.name}}</h1>
            <div class="tag__post" v-if="tag.posts.length > 0">
                <h4>Post associati:</h4>
                <ul>
                    <li v-for="post in tag.posts" :key="post.id">
                        <router-link class="tag__post-link" :to="{ name: 'single-post', params: { slug: post.slug } }">{{post.title}}</router-link>
                    </li>
                </ul>
            </div>
            <div class="tag__post">
                <h4>Non ci sono post associati</h4>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'SingleTag',
        data() {
            return {
                tag: null
            }
        },
        created() {
            axios.get(`/api/tags/${this.$route.params.slug}`)
            .then((response) => {
                this.tag = response.data;
            })
            .catch((e) => {
                this.$router.push({name: 'page-404'});
            });
        }
    }
</script>

<style lang="scss" scoped>
    .tag {
        margin-top: 5rem;

        &__name {
            text-transform: uppercase;
        }

        &__post {
            margin-top: 2.5rem;

            &-link {
                color: #000;
            }
        }
    }
</style>