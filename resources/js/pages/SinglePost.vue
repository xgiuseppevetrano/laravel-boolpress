<template>
    <div v-if="post" class="container">
        <div class="post">
            <div>
                <h3 class="post__title">{{post.title}}</h3>
                <h6 class="post__author">Autore: {{post.user.name}}</h6>
            </div>
            <div class="post__content">
                <p>{{post.content}}</p>
                <img v-if="post.image_path" :src="post.image_path" :alt="post.title">
                <img v-if="post.image" :src="`/storage/${post.image}`" :alt="post.title">
            </div>
            <div class="post__box">
                <span class="post__category" v-if="post.category">Categoria: {{post.category.name}}</span>
                <div class="post__tag" v-if="post.tags.length > 0">
                    <span class="post__tag-name">Tags:</span>
                    <ul>
                        <li v-for="tag in post.tags" :key="tag.id">
                            <router-link class="post__tag-link" :to="{ name: 'single-tag', params: {slug: tag.slug} }">{{tag.name}}</router-link>
                        </li>
                    </ul>
                </div>
                <button class="post__btn btn btn-outline-secondary mt-3"><router-link class="post__link" :to="{name: 'home'}">Home Page</router-link></button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'SinglePost',
        data() {
            return {
                post: null
            }
        },
        created() {
            axios.get(`/api/posts/${this.$route.params.slug}`)
            .then((response) => {
                this.post = response.data;
            })
            .catch((e) => {
                this.$router.push({name: 'page-404'});
            });
        }
    }
</script>

<style lang="scss" scoped>
    .container {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .post {
        background-color: #efefef;
        border-radius: .625rem;
        padding: .625rem;
        display: flex;
        flex-direction: column;
        height: 21.875rem;

        &__content {
            flex-grow: 1;
        }

        &__box {
            text-align: center;
        }

        &__category {
            display: block;
            font-size: .875rem;
            text-align: left;
        }

        &__tag {
            font-size: .875rem;
            text-align: left;

            &-link {
                color: #000;
            }
        }

        &__btn {
            text-align: center;
            padding: .0625rem .3125rem;
        }

        &__link {
            color: #000;
            text-decoration: none;
        }
    }

</style>