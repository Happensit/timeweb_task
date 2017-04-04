import Vue from 'vue'
import Router from 'vue-router'
import Hello from '../components/page/Hello.vue'
import Shipping from '../components/page/Shipping.vue'
import Payment from '../components/page/Payment.vue'
import Contacts from '../components/page/Contacts.vue'

Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Hello
        },
        {
            path: '/shipping',
            name: 'shipping',
            component: Shipping
        },
        {
            path: '/payment',
            name: 'payment',
            component: Payment
        },
        {
            path: '/contacts',
            name: 'contacts',
            component: Contacts
        }
    ]
})
