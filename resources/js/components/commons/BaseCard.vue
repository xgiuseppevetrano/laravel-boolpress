<template>
    <div class="card">
        <h5 class="card__title">{{title}}</h5>
        <p class="card__content">{{content}}</p>
        <router-link class="card__link" :to="{ name: 'single-post', params: {slug: slug} }">Visualizza</router-link>
    </div>
</template>

<script>
    export default {
        name: 'BaseCard',
        props: {
            title: String,
            content: String,
            slug: String,
        }
    }
</script>

<style lang="scss" scoped>
    .card {
        background-color: #efefef;
        border-radius: 1.25rem;
        padding: .625rem;
        height: 100%;
        display: flex;
        flex-direction: column;

        &__content {
            flex-grow: 1;
        }

        &__link {
            text-align: center;
        }
    }
</style>