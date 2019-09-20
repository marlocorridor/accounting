@extends('layouts.app')

@section('title', 'Series | Journal Entries')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-2">
            <div id="app">
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
        window.series_show_url = '{!! $series_show_url !!}';
    </script>
@endsection
