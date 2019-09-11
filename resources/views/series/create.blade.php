@extends('layouts.app')

@section('title', 'Series | Create')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Create Series
                </div>
                <div class="card-body">
                    <form action="{{ route('series.store') }}" method="POST">
                        @csrf()
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="series_number">Series No.</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="series_number" name="series_number" title="Series Number" placeholder="Series Number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="reference_number">Reference No. | SI No.</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="reference_number" name="reference_number" title="Reference No./ SI No." placeholder="Reference No./ SI No.">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="po_number">P.O. No.</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="po_number" name="po_number" title="PO No. (Optional)" placeholder="PO No. (Optional)">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="payee">Payee</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="payee" name="payee" title="Payee" placeholder="Payee">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Describe Series</label>
                            <textarea class="form-control" id="description" name="description" maxlength="250" title="Description" placeholder="Description"></textarea>
                        </div>
                        <div class="float-right">
                            <button class="btn btn-primary" role="submit" type="submit">
                                Next
                            </button>
                        </div>

                        {{--
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="is_debit" name="type[1]" value="debit" class="custom-control-input">
                            <label class="custom-control-label" for="is_debit">DR</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="is_credit" name="type[1]" value="credit" class="custom-control-input">
                            <label class="custom-control-label" for="is_credit">CR</label>
                        </div>
                        --}}

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
