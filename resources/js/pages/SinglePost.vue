<template>
    <div v-if="post" class="container">
        <div class="post">
            <div>
                <h3 class="post__title">{{post.title}}</h3>
                <h6 class="post__author">Autore: {{post.user.name}}</h6>
            </div>
            <div class="post__content">
                <p>{{post.content}}</p>
                <img width="100" height="100" v-if="post.image" :src="`/storage/${post.image}`" :alt="post.title">
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
                <div class="mt-3" v-if="post.comments.length > 0">
                    <h5>Commenti</h5>
                    <div v-for="comment in post.comments" :key="comment.id">
                        <span><strong>{{comment.name ? comment.name : 'Anonimo'}}:</strong> {{comment.content}}</span>
                    </div>
                </div>
                <div class="mt-3 post__comments">
                    <h6>Lascia un commento</h6>
                    <form @submit.prevent="addComment()">
                        <div class="mb-1">
                            <input class="post__comments-input" type="text" name="name" placeholder="Inserisci il nome" v-model="formData.name">
                            <ul v-if="errors.name" style="color:red">
                                <li v-for="(err, index) in errors.name" :key="index">{{err}}</li>
                            </ul>
                        </div>
                        <div class="mb-1">
                            <textarea class="post__comments-textarea" name="content" id="content" cols="30" rows="2" placeholder="Inserisci il testo del commento" v-model="formData.content"></textarea>
                            <ul v-if="errors.content" style="color:red">
                                <li v-for="(err, index) in errors.content" :key="index">{{err}}</li>
                            </ul>
                        </div>
                        <div>
                            <button class="post__btn btn btn-outline-secondary" type="submit">Aggiungi commento</button>
                        </div>
                        <div v-if="commentSent" class="mt-3" style="color: green; border: 1px solid green">
                            Commento inserito in fase di approvazione
                        </div>
                    </form>
                </div>                
                <button class="post__btn btn btn-outline-secondary mt-3">
                    <router-link class="post__link" :to="{name: 'home'}">Home Page</router-link>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'SinglePost',
        data() {
            return {
                post: null,
                formData: {
                    name: '',
                    content: '',
                },
                commentSent: false,
                errors: {}
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
        },
        methods: {
            addComment() {
                axios.post(`/api/comments/${this.post.id}`, this.formData)
                .then((resp) => {
                    this.commentSent = true;
                    this.formData.name = "";
                    this.formData.content = "";
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
            }
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
        height: 34.375rem;
        width: 21.875rem;

        &__content {
            flex-grow: 1;
        }

        &__category {
            display: block;
            font-size: .875rem;
        }

        &__tag {
            font-size: .875rem;

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

        &__comments {
            &-input,
            &-textarea {
                font-size: .875rem;
            }
        }
    }

</style>