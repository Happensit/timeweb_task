<template>
    <div class="main-wrapper">
        <navbar :items="items"></navbar>
        <cart :items="items"></cart>
        <section>
            <div id="app">
                <router-view></router-view>
            </div>
        </section>
    </div>
</template>

<script>

    import Navbar from './components/Navbar.vue'
    import Cart from "./components/Cart.vue";
    export default {
        data () {
            return {
                items: []
            }
        },
        components: {
            Cart, Navbar,
        }
    }
</script>

<style>
    @font-face {
        font-family: "Helvetica Neue";
        src: url("/static/fonts/helveticaneuecyr-thin.otf");
    }

    * {
        box-sizing: border-box;
    }

    html {
        text-rendering: optimizeLegibility !important;
        -webkit-font-smoothing: antialiased !important;
        -moz-osx-font-smoothing: grayscale;
    }

    body {
        font-family: "Helvetica Neue";
        color: #333;
        background-color: rgba(255, 255, 255, 0.1);
        line-height: 20px;
        letter-spacing: 0.5px;
    }

    h1 {
        text-align: center;
    }

    a {
        text-decoration: none;
        color: #3457c0;
    }

    ul, li {
        list-style-type: none;
        padding: 0;
    }

    #app {
        margin-top: 30px;
    }

    .main-wrapper {
        width: 80%;
        margin: 0 auto;
    }

    section {
        display: flex;
        justify-content: center;
        align-items: center;
    }

</style>
