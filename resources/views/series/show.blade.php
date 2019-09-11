@extends('layouts.app')

@section('title', 'Series Details | ' . $series->code)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Series:
                    <a href="{{route('series.show', $series->id)}}">
                        {{ $series->code }}
                    </a>
                    <small>{{ $series->po_description ?? '' }}</small>
                </div>
                <div class="card-body">
                    <h3>{{ $series->description }}</h3>
                    <h4>{{ $series->payee }}</h4>

                    <table class="table">
                        <tr>
                            <th>Type</th>
                            <th>Account</th>
                            <th>Description</th>
                            <th class="text-center" colspan="2">Amount</th>
                        </tr>
                    @foreach( $series->entries as $entry )
                        <tr>
                            @if( $entry->is_debit )
                            <td>
                                <div class="badge badge-success"> DR </div>
                            </td>
                            @else
                            <td>
                                <div class="badge badge-warning"> CR </div>
                            </td>
                            @endif
                            <td>
                                {{ $entry->account->title }}
                                <span class="badge badge-primary float-right">
                                    {{ $entry->account->code }}
                                </span>
                            </td>
                            <td>
                                {{ $entry->description }}
                                <span class="float-right">
                                    {{ $entry->site->name }}
                                </span>
                            </td>
                            <td class="text-right">{{ number_format($entry->debit_amount, 2) }}</td>
                            <td class="text-right">{{ number_format($entry->credit_amount, 2) }}</td>
                        </tr>
                    @endforeach
                        <tr class="text-right">
                            <td colspan="3">
                                <b>Total</b>
                            </td>
                            <td>{{ number_format($series->amount_debit, 2) }}</td>
                            <td>{{ number_format($series->amount_credit, 2) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
