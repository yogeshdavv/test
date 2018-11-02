<template>
    <div class="box">
        <div class="box__section box__section--header">Create Transaction</div>
        <div class="box__section">
            <div class="input input-small">
                <label>Happened On</label>
                <input type="text" v-model="happened_on" />
            </div>
            <div class="input input-small">
                <label>Description</label>
                <input type="text" v-model="description" />
            </div>
            <div class="input input-small">
                <label>Amount</label>
                <input type="text" v-model="amount" />
            </div>
            <button class="button" @click="create">
                <span v-show="!creating">Create {{ type.slice(0, 1).toUpperCase() + type.slice(1) }}</span>
                <span v-show="creating">
                    <i class="fas fa-spinner-third fa-spin"></i>
                </span>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            type: 'earning',
            creating: false,
            happened_on: new Date().toISOString().slice(0, 10),
            description: '',
            amount: ''
        }
    },

    methods: {
        create() {
            this.creating = true

            axios.post('/api/' + this.type + 's', {
                happened_on: this.happened_on,
                description: this.description,
                amount: this.amount
            }).then(() => {
                this.happened_on = new Date().toISOString().slice(0, 10)
                this.description = ''
                this.amount = ''

                this.creating = false
            }).catch(() => {
                this.creating = false
            })
        }
    }
}
</script>