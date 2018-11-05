window.axios = require('axios')
window.Vuex = require('vuex')
window.Vue = require('vue')

const store = new Vuex.Store({
    state: {
        transactions: []
    },

    mutations: {
        addTransaction: (state, payload) => {
            state.transactions.push(payload)
        }
    }
})

Vue.component('datepicker', require('./components/DatePicker.vue'))
Vue.component('barchart', require('./components/BarChart.vue'))
Vue.component('dropdown', require('./components/Dropdown.vue'))
Vue.component('recent-transactions', require('./components/RecentTransactions.vue'))
Vue.component('transaction-wizard', require('./components/TransactionWizard.vue'))

const app = new Vue({
    el: '#app',
    store
})
