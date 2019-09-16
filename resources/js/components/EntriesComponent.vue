<template>
    <div class="entries-container">
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
