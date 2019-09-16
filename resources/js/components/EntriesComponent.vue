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
                <div class="row">
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
            v-on:remove="entries.splice(index, 1)"
            :series="series"
            :accounts="accounts"
            :sites="sites"
            >
        </entry-component>
        <button v-on:click="addNewEntry" class="btn btn-primary float-right">Add Entry</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: 'entries-component',
                series: {},
                accounts: [],
                entries: [{
                    id: 1,
                    series: null,
                    accounts: null,
                }],
                sites: [],
                nextEntryId: 2,
            }
        },
        mounted() {
            console.log('Entries Component mounted.')
            // set data from global
            this.series = window.series
            this.accounts = window.accounts
            this.sites = window.sites
        },
        methods: {
            addNewEntry: function () {
                this.entries.push({
                    id: this.nextEntryId++,
                    series: this.series,
                    accounts: this.accounts,
                })
            }
        }
    }
</script>
