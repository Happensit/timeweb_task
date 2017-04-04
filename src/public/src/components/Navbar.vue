<template>
    <header>
        <div class="header-wrapper">
            <router-link to="/" class="name"><img src="/favicon.png" alt="Ждун" class="logo">Ждуны</router-link>
            <nav class="pull-right">
                <router-link :to="{ name: 'shipping'}">Доставка</router-link>
                <router-link :to="{ name: 'payment'}">Оплата</router-link>
                <router-link :to="{ name: 'contacts'}">Контакты</router-link>
                <router-link @click.native="showCart" to="#">
                    Корзина
                    <span class="round" v-if="items.length > 0">
                        {{ items.length }}
                      </span>
                </router-link>
            </nav>
        </div>
    </header>
</template>

<script>
    export default {
        name: 'navbar',
        props: ['items'],
        methods: {
            showCart: function() {
               return this.$root.$emit('onShowCart');
            }
        }
    }
</script>

<style scoped>
    .header-wrapper {
        padding: 18px 30px 20px;
    }

    .logo {
        display: block;
        height: 40px;
        object-fit: cover;
        float: left;
        margin-right: 20px;
    }

    .name {
        line-height: 45px;
        font-size: 25px;
        font-weight: 800;
        color: #333;
        float: left;
    }

    nav {
        font-size: 16px;
        padding: 10px 0 14px;
        height: 40px;
        font-weight: 500;
    }

    nav a {
        margin: 0 26px 0 0;
        color: rgba(10, 10, 10, 1);
    }

    nav.pull-right {
        text-align: right;
    }
    .cart {
        background: #fff;
        padding: 20px 30px;
        position: absolute;
        right: 30px;
        box-shadow: 2px 2px 6px 0 rgba(0, 0, 0, 0.3);
    }
</style>
