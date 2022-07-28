<template>
    <div class="container">
        <div class="categories">
            <h1>Categorie</h1>
            <ul class="categories__list" v-if="categories.length > 0">
                <li v-for="category in categories" :key="category.id">
                    <router-link class="categories__link" :to="{ name: 'single-category', params: { slug: category.slug } }">{{category.name}}</router-link>
                </li>
            </ul>
            <h2 v-else>Non sono presenti categorie</h2>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Categories',
        data() {
            return {
                categories: []
            }
        },
        created() {
            axios.get('/api/categories')
            .then((response) => {
                this.categories = response.data;
            })
            .catch((e) => {
                this.$router.push({name: 'page-404'});
            });
        }
    }
</script>

<style lang="scss" scoped>
    .categories {
        margin-top: 5rem;

        &__list {
            margin-top: 1.25rem;
        }

        &__link {
            color: #000;
        }
    }
</style>