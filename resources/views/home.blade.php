@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Make a payment</div>

                <div class="card-body">
                    <form action="{{route('pay')}}" method="POST" id="paymentForm">
                        @csrf
                        <div class="row">
                            <div class="col-auto">
                                <label>How much do you want to pay?</label>
                                <input type="number" min="5" step="0.01" class="form-control" name="value"
                                    value="{{mt_rand(500, 100000) / 100}}">
                                <small class=" form-text text-muted"> Use values with up to two decimal positions, using
                                    a "."</small>
                            </div>
                            <div class="col-auto">
                                <label>Currency</label>
                                <select class="form-select" name="currency" required>
                                    @foreach ($currencies as $currency)
                                        <option value="{{$currency->iso}}">{{strtoupper($currency->iso)}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4">
                                <label> Select the desired platform</label>
                                <div class="form-group" id="toggler">
                                    <div class="btn-group btn-group-toggle" data-bs-toggle="buttons">
                                        @foreach ($paymentPlatforms as $p)
                                            <label class="btn btn-outline-secondary rounded m-2 p-1"  data-bs-target="#{{$p->name}}Collapse" data-bs-toggle="collapse">
                                                <input type="radio" name="payment_platform" value="{{$p->name}}" required>
                                                <img class="img-thumbnail" src="{{asset($p->image)}}" alt="image">
                                            </label>

                                        @endforeach
                                    </div>
                                    @foreach ($paymentPlatforms as $p)
                                            <div id="{{$p->name}}Collapse" class="collapse" data-bs-parent="#toggler">
                                                @includeIf('components.'.strtolower($p->name).'-collapse')
                                            </div>

                                        @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button id="payButton" class="btn btn-primary btn-lg">
                                Pay
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection