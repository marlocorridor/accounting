@extends('layouts.app')

@section('title', 'Series | Journal Entries')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-2">
            <div id="app">
                <div class="d-flex align-items-center row text-center font-weight-bold">
                    <div class="col-md-1">Type</div>
                    <div class="col-md-3">Account</div>
                    <div class="col-md-3">Description</div>
                    <div class="col-md-2">Site</div>
                    <div class="col-md-3">
                        <div>Amount</div>
                        <div class="row">
                            <label class="col-md-6">Debit</label>
                            <label class="col-md-6">Credit</label>
                        </div>
                    </div>
                </div>
                <entries-component></entries-component>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-page')
    <script type="text/javascript">
        window.series = JSON.parse('{!! $series !!}');
        window.accounts = JSON.parse('{!! $accounts !!}');
        window.sites = JSON.parse('{!! $sites !!}');
    </script>
@endsection
