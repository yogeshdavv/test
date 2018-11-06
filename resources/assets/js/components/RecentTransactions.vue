<template>
    <div class="box">
        <div class="box__section box__section--header">Recent Transactions</div>
        <div class="box__section row" v-for="transaction in transactions">
            <div class="row__column row__column--compact">{{ new Date(transaction.happened_on).toISOString().slice(5, 10) }}</div>
            <div class="row__column mx-15">{{ transaction.description }}</div>
            <div class="row__column row__column--compact" :class="{ 'color-green': transaction.type == 'earning', 'color-red': transaction.type == 'spending' }">{{ currency}} {{ new Intl.NumberFormat().format(transaction.amount / 100) }}</div>
        </div>
        <div class="box__section text-center" v-show="fetching">
            <i class="fas fa-spinner-third fa-spin"></i>
        </div>
    </div>
</template>

<script>
export default {
    props: ['currency'],

    data() {
        return {
            fetching: false
        }
    },

    computed: {
        transactions() {
            return this.$store.getters.recentTransactions
        }
    },

    methods: {
        fetch: function () {
            this.fetching = true

            axios.get('/api/transactions?limit=5').then(response => {
                this.fetching = false

                response.data.forEach(transaction => {
                    this.$store.commit('addTransaction', transaction)
                })
            }).catch(() => {
                this.fetching = false
            })
        }
    },

    mounted() {
        this.fetch()
    }
}
</script>