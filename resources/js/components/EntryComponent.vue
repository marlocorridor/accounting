<template>
    <div class="entry-row">
        <div class="row">
            <div class="col-md-1">
                <debit-credit-selector v-on:select_type="select_type" v-bind:entry_type="entry_type"></debit-credit-selector>
            </div>
            <div class="col-md-3">
                <debit-credit-text-input v-on:update_value="update_value" v-bind:entry_type="entry_type"></debit-credit-text-input>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: 'entry-row',
                activeClass: 'btn-primary',
                input_name: '',
                entry_type: 'debit',
                amount: 0,
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            select_type: function (entry_type) {
                this.entry_type = entry_type
            },
            update_value: function (amount) {
                this.amount = amount
            },
            get_data: function () {
                return {
                    type: this.type,
                    amount: this.amount,
                }
            }
        }
    }
</script>
