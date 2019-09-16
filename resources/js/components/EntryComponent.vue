<template>
    <div class="entry-row">
        <div class="row">
            <div class="col-md-1">
                <debit-credit-selector v-on:select_type="select_type" v-bind:entry_type="entry_type"></debit-credit-selector>
            </div>
            <div class="col-md-3">
                <v-select name="test" :getOptionLabel="getOptionLabel" :options="options" v-model="account" label="title" placeholder="Select Accounts">
                    <template slot="option" slot-scope="option">
                        <span class="badge badge-primary">{{ option.code }}</span>
                        {{ option.title }}
                    </template>
                </v-select>
            </div>
            <div class="col-md-3">
                <input class="form-control" type="text" name="description" :value="description">
            </div>
            <div class="col-md-2">
                <select name="site" class="custom-select" :value="site">
                    <option>Select Site</option>
                    <option v-for="site in sites" :value="site.id">
                        {{site.name}}
                    </option>
                </select>
            </div>
            <div class="col-md-3 position-relative">
                <debit-credit-text-input v-on:update_value="update_value" v-bind:entry_type="entry_type"></debit-credit-text-input>
                <button class="position-absolute close" v-on:click="$emit('remove')">
                    &times;
                </button>
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
                account: null,
                site: null,
                // entry: null,
                description: null,
                options: [
                    {
                        description: 'description',
                        code: 'code',
                        title: 'title',
                        value: 0,
                    },
                ]
            }
        },
        props: {
            series: {
                type: Object,
                default: () => ({
                    description: 'Default',
                    id: null,
                }),
            },
            accounts: {
                type: Array,
                default: () => ([]),
            },
            sites: {
                type: Array,
                default: () => ([]),
            },
            entry: {
                type: Object,
                default: {},
            },
            index: {
                type: Number,
                default: 1,
            },
        },
        mounted() {
            console.log('Entry Component mounted.')
            if ( accounts ) {
                this.options = accounts;
            }
            if ( series ) {
                this.description = series.description;
            }
            console.log('Entry Entry:', this.entry, sites);
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
                    account: this.account.value,
                    site: this.site,
                    description: this.description,
                }
            },
            getOptionLabel: function (option) {
                return option.code + ' - ' + option.title
            },
        }
    }
</script>
