@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Subscribe</div>
                <div class="card-body">
                    <form action="{{route('subscribe.store')}}" method="POST" id="subscriptionForm">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-sm-4">
                                <label> Select your plan</label>
                                <div class="form-group">
                                    <div class="btn-group btn-group-toggle">
                                        @foreach ($plans as $p)
                                            <label class="btn btn-outline-info rounded m-2 p-3">
                                                <input type="radio" name="plan" value="{{$p->slug}}" class="d-none" required>
                                                <p class="h2 font-weight-bold text-capitalize">{{$p->slug}}</p>
                                                <p class="display-4 text-capitalize">{{$p->visual_price}}</p>
                                            </label>

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4">
                                <label> Select the desired platform</label>
                                <div class="form-group">
                                    <div class="btn-group btn-group-toggle">
                                        @foreach ($paymentPlatforms as $p)
                                            <label class="btn btn-outline-secondary rounded m-2 p-1">
                                                <input type="radio" name="payment_platform" value="{{$p->name}}" class="d-none" required>
                                                <img class="img-thumbnail" src="{{asset($p->image)}}" alt="image">
                                            </label>

                                        @endforeach
                                    </div>
                                    @foreach ($paymentPlatforms as $p)
                                        <div id="{{$p->name}}Collapse" class="collapse" data-bs-parent="#toggler">
                                            @includeIf('components.' . strtolower($p->name) . '-collapse')
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button id="payButton" class="btn btn-primary btn-lg">
                                Subscribe
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection