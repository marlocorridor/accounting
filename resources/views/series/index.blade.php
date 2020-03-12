@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span class="h3">Series</span>
                    <a href="{{route('series.create')}}" class="btn btn-sm btn-outline-secondary float-right">
                        &#43; New Series
                    </a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Series No.</th>
                            <th>PO No.</th>
                            <th>Description</th>
                            <th>Payee</th>
                            <th>Amount</th>
                        </tr>
                    @foreach( $series as $series )
                        <tr>
                            <td class="text-left">
                                <a href="{{route('series.show', $series->id)}}">
                                    {{ $series->code }}
                                </a>
                            </td>
                            <td>{{ $series->po_description }}</td>
                            <td>{{ $series->description }}</td>
                            <td>{{ $series->payee }}</td>
                            <td>{{ $series->amount_debit }} | {{ $series->amount_credit }}</td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
