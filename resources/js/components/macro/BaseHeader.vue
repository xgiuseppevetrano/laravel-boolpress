<template>
    <header>
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    <h1>Boolpress</h1>
                </div>
                <div class="col">
                    <nav>
                        <ul class="d-flex">
                            <li><router-link :to="{ name: 'home' }">Home</router-link></li>
                            <li><router-link :to="{ name: 'about' }">Chi Siamo</router-link></li>
                            <li><a href="/admin/home">Area Riservata</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
    export default {
        name: 'BaseHeader',
    }
</script>

<style lang="scss" scoped>
    .col {
        ul {
            margin-top: 1rem;
            
            li {
                list-style-type: none;
                margin: 0 1.25rem;

                a {
                    text-decoration: none;
                    color: #000;
                }
            }
        }
    }
</style>