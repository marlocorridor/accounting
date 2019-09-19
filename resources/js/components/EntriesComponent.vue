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
        <button v-on:click="addNewEntry" class="btn btn-primary float-right">Add Entry</button>
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
                // nextEntryId: 1,
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
            }
        },
        computed: {
            ...mapGetters({
                entries: 'allEntries',
                nextEntryId: 'allEntriesLength',
                entry_factory: 'entryFactory'
            }),
            ...mapGetters([
                'accounts',
                'totalDebit',
                'totalDebitMoney',
                'totalCredit',
                'totalCreditMoney',
            ]),
        },
    }
</script>
