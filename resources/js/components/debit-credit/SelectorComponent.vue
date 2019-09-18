<template>
    <div class="btn-group btn-group-toggle">
        <label class="btn" v-bind:class="isDebit ? activeClass : 'btn-secondary'">
            <input @change="update_value" value="debit" type="radio" name="type" autocomplete="off"> DR
        </label>
        <label class="btn" v-bind:class="isCredit ? activeClass : 'btn-secondary'">
            <input @change="update_value" value="credit" type="radio" name="type" autocomplete="off"> CR
        </label>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: 'debit-credit-selector',
                activeClass: 'btn-primary',
                input_name: '',
                type: '',
            }
        },
        props: {
            entry_type: {
                type: String,
                default: 'debit',
            },
        },
        mounted() {
            console.log('Debit Credit Selector Component mounted.')
            this.type = this.entry_type;
        },
        methods: {
            update_value: function (event) {
                this.$emit('input', event.target.value)
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
