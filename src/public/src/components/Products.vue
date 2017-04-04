<template>
    <div class="products-list">
        <div class="products" v-for="product in products">
            <img :src="product.image" alt="">
            <h3>{{ product.name }}</h3>
            <span>{{ getFormatPrice(product) }} ₽</span>
            <button @click="onAddToCart(product)">В корзину</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'products',
        props: ['item'],
        data () {
            return {
                products: [],
            }
        },
        methods: {
            onAddToCart(product) {
                this.$root.$emit('onAddToCart', product);
            },
            getProducts() {
                this.$http.get('/products').then(response => {
                    this.products = response.body;

                }, response => {
                    throw new Error('Network response was not ok.');
                });
            },
            getFormatPrice(product) {
                return parseFloat(product.price).toFixed(2)
            }
        },
        created: function () {
            this.getProducts();
        }
    }
</script>

<style>

    img {
        max-width: 100%;
    }

    .products-list {
        display: inline-flex;
        align-items: center;
        flex-direction: row;
        flex-wrap: wrap;
        padding-top: 80px;
    }

    .products {
        position: relative;
        float: left;
        height: 350px;
        width: 25%;
        min-width: 220px;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        border: 1px solid rgb(255, 255, 255);
    }

    .products img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        position: absolute;
        z-index: 1;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        filter: brightness(70%);
    }

    .products h3 {
        font-size: 32px;
        line-height: 32px;
        color: #fff;
        font-weight: 300;
        text-align: center;
        z-index: 2;
    }

    .products span {
        color: white;
        font-weight: 300;
        text-align: center;
        z-index: 2;
    }

    .products button {
        height: 38px;
        border: 1px solid #fff;
        border-radius: 4px;
        color: #fff;
        font-size: 16px;
        display: block;
        z-index: 2;
        padding: 0 48px;
        text-align: center;
        background-color: transparent;
        cursor: pointer;
    }

    .products button:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }

</style>