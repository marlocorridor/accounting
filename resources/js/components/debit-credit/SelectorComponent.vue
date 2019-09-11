<template>
    <div>
        <div class="btn-group btn-group-toggle">
            <label class="btn" v-bind:class="isDebit ? activeClass : 'btn-secondary'">
                <input v-model="type" value="debit" type="radio" name="type" autocomplete="off"> DR
            </label>
            <label class="btn" v-bind:class="isCredit ? activeClass : 'btn-secondary'">
                <input v-model="type" value="credit" type="radio" name="type" autocomplete="off"> CR
            </label>
        </div>
        <span>Picked: {{ type }}</span>
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
            console.log('Component mounted.')
            this.type = this.entry_type;
            console.log('Component mounted.', this.type, this.entry_type)
        },
        watch: {
            type: function (newVal, oldVal) {
                // if false
                if (newVal) {
                    console.log(newVal, 'newVal')
                }
                this.$emit('select_type', newVal)
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
