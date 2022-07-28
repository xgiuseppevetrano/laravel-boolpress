<template>
    <div class="app">
        <BaseHeader/>
        <BaseMain class="main"/>
        <BaseFooter/>
    </div>
</template>

<script>
    import BaseHeader from "../components/macro/BaseHeader";
    import BaseMain from "../components/macro/BaseMain";
    import BaseFooter from '../components/macro/BaseFooter';

    export default {
        name: 'App',
        components: {
            BaseHeader,
            BaseMain,
            BaseFooter
        }
    }
</script>

<style  lang="scss" scoped>
    .app {
        height: 100vh;
        display: flex;
        flex-direction: column;
        
        .main {
            flex-grow: 1;
        }
    }

</style>