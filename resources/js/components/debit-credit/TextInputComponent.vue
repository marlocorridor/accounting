<template>
    <div class="input-group mb-3 pl-0 pr-0">
        <input v-if="isCredit" type="text" class="form-control disabled" disabled>
        <input type="number" step="0.01" class="form-control text-right" placeholder="Amount"
            :value="prop_amount" @change="update_value">
        <input v-if="isDebit" type="text" class="form-control disabled" disabled>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: 'debit-credit-text-input',
                activeClass: 'btn-primary',
                input_name: '',
            }
        },
        props: {
            entry_type: {
                type: String,
                default: 'debit',
            },
            amount: {
                type: Number,
                default: 0.00,
            },
        },
        mounted() {
            console.log('Text Input Component mounted.', this.amount)
        },
        methods: {
            update_value: function (event) {
                this.$emit('input', parseFloat(event.target.value))
            }
        },
        computed: {
            prop_amount: function () {
                return this.amount
            },
            isDebit: function () {
                return this.entry_type == 'debit'
            },
            isCredit: function () {
                return this.entry_type == 'credit'
            },
        }
    }
</script>
