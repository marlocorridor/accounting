import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default {
    store: new Vuex.Store({
        state: {
            accounts: [],
            sites: [],
            entries: [],
        },
        getters: {
            doneEntries: state => {
                // validate
                return state.entries.filter(entry => {
                    return entry.type && entry.amount && entry.account
                })
            },
            allEntries: state => {
                return state.entries
            },
            allAccounts: state => {
                return state.accounts
            },
            getEntryById: (state) => (index) => {
                return state.entries.find(entry => entry.index === index)
            }
        },
        mutations: {
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
