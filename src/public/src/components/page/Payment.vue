<template>
    <div class="payment">
        <h1>{{ msg }}</h1>
        <p>
            В связи с нестабильным курсом рубля и экономики в целом, мы вынуждены сообщить, что принимаем к оплате только ракушки Каури.
        </p>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                msg: 'Оплата'
            }
        }
    }
</script>
