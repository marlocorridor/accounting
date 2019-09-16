<template>
    <div class="input-group mb-3">
        <input v-if="isCredit" type="text" class="form-control disabled" disabled>
        <input type="number" step="0.01" class="form-control text-right" placeholder="Amount" v-model.lazy="value">
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
                value: 0.00,
            }
        },
        props: {
            entry_type: {
                type: String,
                default: 'debit',
            },
        },
        mounted() {
            console.log('Text Input Component mounted.')
        },
        watch: {
            value: function (newVal, oldVal) {
                // if false
                if (newVal) {
                    console.log(newVal, 'newVal')
                }
                this.$emit('update_value', newVal)
            }
        },
        computed: {
            isDebit: function () {
                return this.entry_type == 'debit'
            },
            isCredit: function () {
                return this.entry_type == 'credit'
            }
        }
    }
</script>
