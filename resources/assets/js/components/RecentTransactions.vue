<template>
    <div class="box">
        <div class="box__section box__section--header">Recent Transactions</div>
        <div class="box__section row" v-for="transaction in transactions">
            <div class="row__column">{{ transaction.description }}</div>
            <div class="row__column row__column--compact" :class="{ 'color-green': transaction._type == 'earning', 'color-red': transaction._type == 'spending' }">{{ currency}} {{ transaction.amount }}</div>
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
            fetching: false,
            transactions: []
        }
    },

    methods: {
        fetch: function () {
            this.fetching = true

            axios.get('/api/transactions?limit=5').then(response => {
                this.fetching = false
                this.transactions = response.data
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