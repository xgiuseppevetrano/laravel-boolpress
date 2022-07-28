<template>
    <div v-if="category" class="container">
        <div class="category">
            <h1 class="category__name">{{category.name}}</h1>
            <div class="category__post" v-if="category.posts.length > 0">
                <h4>Post associati:</h4>
                <ul>
                    <li v-for="post in category.posts" :key="post.id">
                        <router-link class="category__post-link" :to="{ name: 'single-post', params: { slug: post.slug } }">{{post.title}}</router-link>
                    </li>
                </ul>
            </div>
            <div v-else class="category__post">
                <h4>Non ci sono post associati</h4>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'SingleCategory',
        data() {
            return {
                category: null,
            }
        },
        created() {
            axios.get(`/api/categories/${this.$route.params.slug}`)
            .then((response) => {
                this.category = response.data
            })
            .catch((e) => {
                this.$router.push({name: 'page-404'});
            });
        }
    }
</script>

<style lang="scss" scoped>
    .category {
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