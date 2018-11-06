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
    },

    getters: {
        recentTransactions: state => {
            return state.transactions.sort(function (a, b) {
                if (a.happened_on == b.happened_on) {
                    if (a.created_at > b.created_at) {
                        return -1
                    }

                    if (a.created_at < b.created_at) {
                        return 1
                    }
                }

                if (a.happened_on > b.happened_on) {
                    return -1
                }

                if (a.happened_on < b.happened_on) {
                    return 1
                }

                return 0
            }).slice(0, 5)
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
