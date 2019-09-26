<template>
    <div class="entries-container">
        <div class="h1">
            <span>{{ series.payee }}</span> | <small>{{ series.description }}</small>
        </div>
        <div class="d-flex align-items-center row text-center font-weight-bold">
            <div class="col-sm-1">Type</div>
            <div class="col-sm-3">Account</div>
            <div class="col-sm-3">Description</div>
            <div class="col-sm-2">Site</div>
            <div class="col-sm-3">
                <div>Amount</div>
                <div class="row pl-0 pr-0">
                    <label class="col-sm-6">Debit</label>
                    <label class="col-sm-6">Credit</label>
                </div>
            </div>
        </div>
        <entry-component
            v-for="(entry, index) in entries"
            v-bind:entry="entry"
            v-bind:index="index"
            v-bind:key="entry.id"
            v-bind:amount="entry.amount"
            :series="series"
            :sites="sites"
            >
        </entry-component>
        <div class="row text-center font-weight-bold">
            <div class="offset-md-9 col-sm-3 pl-0 pr-0">
                <div class="row font-weight-bold text-monospace" v-bind:class="totalDebit !== totalCredit ? 'text-danger' : ''">
                    <label class="col-sm-6">{{ totalDebitMoney }}</label>
                    <label class="col-sm-6">{{ totalCreditMoney }}</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div v-if="!is_sent" class="offset-md-9 col-md-3 text-right">
                <button class="btn btn-outline-secondary" v-on:click="addNewEntry" accesskey="A">
                    &#43; <u>A</u>dd Entry
                </button>
                <button class="btn btn-primary"
                    v-on:click="saveEntries"
                    :disabled="!(all_entries_valid && all_entries_balance)">
                    Save Entries
                </button>
            </div>
            <div v-else class="offset-md-9 col-md-3 text-right">
                <a class="btn btn-success" :href="series_show_url">
                    View Series Data
                </a>
            </div>
        </div>
        <div v-if="errors.message" class="row">
            <div class="col-md-12">
                <h4>
                    <b>System Message/s: <span class="badge badge-danger">Error</span></b> <small class="text-upper">{{errors.message}}</small>
                    <button class="position-absolute ml-2 btn btn-outline-secondary btn-sm" v-on:click="clearErrors">
                        &times;
                    </button>
                </h4>
                <ul>
                    <li v-for="(error, index) in errors.errors">
                        #{{++(index.split('.')[0])}} {{error.join(', ')}}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        data() {
            return {
                name: 'entries-component',
                series: {},
                sites: [],
                totals: {
                    debit: 0,
                    credit: 0,
                }
            }
        },
        beforeMount() {
            console.log('Entries Component Before mounted.')
            // set data from global
            this.series = window.series
            this.sites = window.sites
            this.series_show_url = window.series_show_url

            this.$store.commit('SET_SERIES', window.series)
            this.$store.commit('SET_ACCOUNTS', window.accounts)
        },
        mounted() {
            console.log('Entries Component mounted.')
            this.$nextTick(function () {
                this.$store.commit('ADD_ENTRY', this.entry_factory())
                this.$store.commit('ADD_ENTRY', this.entry_factory(true))
            })
        },
        methods: {
            addNewEntry: function () {
                this.$store.commit('ADD_ENTRY', this.entry_factory())
            },
            saveEntries: function () {
                if(confirm("Submit Entries?")){
                    this.$store.dispatch('saveEntries')
                }
            },
            clearErrors: function () {
                this.$store.commit('CLEAR_ERRORS')
            }
        },
        computed: {
            ...mapGetters({
                all_entries_balance: 'balancedEntries',
                all_entries_valid: 'allEntriesValid',
                entries: 'allEntries',
                accounts: 'allAccounts',
                entry_factory: 'entryFactory',
                is_sent: 'isSuccess',
                errors: 'errorMessages',
            }),
            ...mapGetters([
                'totalDebit',
                'totalDebitMoney',
                'totalCredit',
                'totalCreditMoney',
            ]),
        },
    }
</script>
