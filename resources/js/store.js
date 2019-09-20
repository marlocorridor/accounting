import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default {
    store: new Vuex.Store({
        state: {
            accounts: [],
            sites: [],
            entries: [],
            series: {},
        },
        getters: {
            series: state => {
                return state.series
            },
            doneEntries: state => {
                // validate
                return state.entries.filter(entry => {
                    return entry.type &&    // selected
                        entry.description.length && // description not empty
                        entry.account &&    // selected
                        entry.site &&       // selected
                        entry.amount >= 0   // atleast zero
                })
            },
            allEntries: state => {
                return state.entries
            },
            allEntriesLength: (state, getters) => {
                return getters.allEntries.length
            },
            allAccounts: state => {
                return state.accounts
            },
            getEntryById: (state) => (index) => {
                return state.entries.find(entry => entry.index === index)
            },
            totals: (state, getters) => (type) => {
                var debits, total

                debits = getters.doneEntries.filter(entry => {
                    return entry.type == type
                })

                total = _.sumBy(debits, (entry) => {
                    return entry.amount
                })

                return parseFloat(total)
            },
            totalDebit: (state, getters) => {
                return getters.totals('debit')
            },
            totalCredit: (state, getters) => {
                return getters.totals('credit')
            },
            formatter: () => {
                return new Intl.NumberFormat( undefined, {
                    style: 'currency',
                    currency: 'PHP',
                })
            },
            totalDebitMoney: (state, getters) => {
                return getters.formatter.format( getters.totalDebit )
            },
            totalCreditMoney: (state, getters) => {
                return getters.formatter.format( getters.totalCredit )
            },
            entryFactory: (state, getters) => (is_credit) => {
                var _type = is_credit ? 'credit' :'debit'
                return {
                    index: getters.allEntriesLength,
                    amount: 0,
                    account: null,
                    type: _type,
                    site: null,
                    description: '',
                }
            },
        },
        mutations: {
            SET_SERIES(state, series) {
                Vue.set(state, 'series', series)
            },
            SET_ACCOUNTS(state, accounts) {
                Vue.set(state, 'accounts', [...accounts])
            },
            SET_SITES(state, sites) {
                Vue.set(state, 'sites', [...sites])
            },
            ADD_ENTRY(state, entry) {
                state.entries.push( entry )
            },
            REMOVE_ENTRY(state, index) {
                state.entries.splice( index, 1 )
            },
            UPDATE_ENTRY_AMOUNT(state, entry) {
                state.entries[entry.index].amount = entry.amount
            },
            UPDATE_ENTRY_TYPE(state, entry) {
                state.entries[entry.index].type = entry.type
            },
            UPDATE_ENTRY_ACCOUNT(state, entry) {
                state.entries[entry.index].account = entry.account
            },
            UPDATE_ENTRY_DESCRIPTION(state, entry) {
                state.entries[entry.index].description = entry.description
            },
            UPDATE_ENTRY_SITE(state, entry) {
                state.entries[entry.index].site = entry.site
            },
        }
    })
}
