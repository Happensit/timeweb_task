<template>
    <div class="cart" v-show="cartShow">
        <div v-show="items.length > 0">
            <div class="arrow"></div>
            <ul>
                <li v-for="item in items" transition="fade">
                    <p>
                        <strong>{{ item.quantity }}</strong> - {{ item.name }} : {{ getFormatPrice(item) }} ₽
                    </p>
                </li>
            </ul>
            <div>
                <div class="total">
                   Итого: {{ totalPrice }} ₽
                </div>
                <button @click="alertMessage">Оформить</button>
            </div>
        </div>
        <div v-show="items.length === 0">
            <p>Корзина пуста!</p>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'cart',
        props: ['items'],
        data () {
            return {
                verified: false,
                cartShow: false
            }
        },
        created () {
            this.$root.$on('onShowCart', (event) => this.showCart(event))
            this.$root.$on('onAddToCart', (event) => this.addToCart(event))
        },
        computed: {
            totalPrice: function () {
                let total = 0
                for (let i = 0; i < this.items.length; i++) {
                    total += this.items[i].price * this.items[i].quantity
                }
                return parseFloat(total).toFixed(2)
            }
        },
        methods: {
            showCart: function() {
                this.cartShow = (this.cartShow) ? false : true
            },
            addToCart: function(item) {
                for (let i = 0; i < this.items.length; i++) {
                    if (this.items[i].sku === item.sku) {
                        return item.quantity += 1
                    }
                }

                item.quantity = 1
                this.items.push(item)
            },
            getFormatPrice: (product) => {
                return parseFloat(product.price).toFixed(2)
            },
            alertMessage: () => {
                alert('Заказ у нас тоже не работает ¯ \\ _ (ツ) _ / ¯')
            },
        }
    }
</script>

<style>
    .cart {
        position: absolute;
        right: 10%;
        margin-top: 10px;
        background: white;
        max-width: 350px;
        border: 1px solid rgba(0,0,0,.2);
        box-shadow: 0 5px 10px rgba(0,0,0,.2);
        padding: 5px 10px;
        border-radius: 4px;
    }

    .cart .total {
        float: left;
    }

    .cart button {
        height: 36px;
        float: right;
        border: 1px solid #3457c0;
        border-radius: 4px;
        padding: 10px 15px;
        background-color: rgba(255,255,255,.2);
    }

</style>