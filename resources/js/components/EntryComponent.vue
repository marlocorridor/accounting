<template>
    <div class="entry-row">
        <div class="row">
            <div class="col-md-1">
                <debit-credit-selector v-model="entry_type" :entry_type="entry_type"></debit-credit-selector>
            </div>
            <div class="col-md-3">
                <v-select name="test" :getOptionLabel="getOptionLabel" :options="accounts" v-model="account" label="title" placeholder="Select Accounts">
                    <template slot="option" slot-scope="option">
                        <span class="badge badge-primary">{{ option.code }}</span>
                        {{ option.title }}
                        <small class="float-right text-uppercase">{{ option.type }}</small>
                    </template>
                </v-select>
            </div>
            <div class="col-md-3">
                <input class="form-control" type="text" name="description" v-model.lazy="description">
            </div>
            <div class="col-md-2">
                <select name="site" class="custom-select" v-model="site">
                    <option selected="selected" value="">Select Site</option>
                    <option v-for="site in sites" v-bind:value="site.id">
                        {{site.name}}
                    </option>
                </select>
            </div>
            <div class="col-md-3 position-relative">
                <span class="position-absolute check" v-if="is_done" title="Valid">&#10004;</span>
                <debit-credit-text-input v-model="amount" :amount="amount" :entry_type="entry_type"></debit-credit-text-input>
                <button class="position-absolute close" v-on:click="remove_entry">
                    &times;
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        data() {
            return {
                name: 'entry-row',
                activeClass: 'btn-primary',
                input_name: '',
                value: 0,
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
            if ( series ) {
                this.description = series.description;
            }
            console.log('Entry Entry:', this.entry, sites);
        },
        methods: {
            remove_entry: function () {
                this.$store.commit('REMOVE_ENTRY', this.index)
            },
            select_type: function (entry_type) {
                this.type = entry_type
                this.$store.commit('UPDATE_ENTRY_TYPE', this.get_data())
            },
            get_data: function () {
                return {
                    id: this.id,
                    index: this.index,
                    type: this.type,
                    amount: this.value,
                    account: this.account ? this.account.id: null,
                    site: this.site,
                    description: this.description,
                }
            },
            getOptionLabel: function (option) {
                return option.code + ' - ' + option.title
            },
        },
        computed: {
            ...mapGetters([
                'doneEntries',
            ]),
            amount: {
                get () {
                    return this.$store.getters.getEntryById(this.index).amount
                },
                set (value) {
                    this.$store.commit('UPDATE_ENTRY_AMOUNT', {
                        index: this.index,
                        amount: value
                    })
                }
            },
            entry_type: {
                get () {
                    return this.$store.getters.getEntryById(this.index).type
                },
                set (value) {
                    this.$store.commit('UPDATE_ENTRY_TYPE', {
                        index: this.index,
                        type: value
                    })
                }
            },
            description: {
                get () {
                    return this.$store.getters.getEntryById(this.index).description
                },
                set (value) {
                    this.$store.commit('UPDATE_ENTRY_DESCRIPTION', {
                        index: this.index,
                        description: value
                    })
                }
            },
            site: {
                get () {
                    return this.$store.getters.getEntryById(this.index).site
                },
                set (value) {
                    this.$store.commit('UPDATE_ENTRY_SITE', {
                        index: this.index,
                        site: value
                    })
                }
            },
            account: {
                get () {
                    return this.$store.getters.getEntryById(this.index).account
                },
                set (account) {
                    this.$store.commit('UPDATE_ENTRY_ACCOUNT', {
                        index: this.index,
                        account: account
                    })
                }
            },
            accounts () {
                return this.$store.getters.allAccounts
            },
            is_done () {
                return _.find(this.doneEntries, {index: this.entry.index}) !== undefined
            },
        },
    }
</script>

<style type="text/css">
    button.close {
        top: 0.25em;
        right: -15px;
    }

    span.check {
        left: 1px;
        top: 0.5em;
    }

    .vs__dropdown-toggle {
        height: 37px;
        background: white;
    }
</style>
