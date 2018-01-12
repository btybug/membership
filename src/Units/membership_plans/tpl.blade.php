@php
    $membershipTypesRepository=new \BtyBugHook\Membership\Repository\PlansRepository();
    $plans=$membershipTypesRepository->findAllByMultiple(['is_active'=>1]);
@endphp
@if((isset($settings['grid_system']) && $settings['grid_system']!=2 ) || $settings['grid_system']==1)
<section id="starter">
    <div class="container">
        <div class="row">
            @foreach($plans as $plan)
            <div class="col-sm-4 block">
                <div class="block-black text-center">
                    <div class="title">
                        {!! $plan->name !!}
                    </div>
                    <div class="header-content text-center">
                        <b> {!! $plan->amount.' '.$plan->currency !!}</b><br>
                        <small>{!! $plan->interval.'ly' !!}</small>
                    </div>
                    <div class="block-content">
                        <ul class="list-unstyled">
                            <li>Full access</li>
                            <li>Documentation</li>
                            <li>Costumers support</li>
                            <li>Free updates</li>
                            <li>Unlimited domains</li>
                        </ul>
                    </div>
                    <div class="text-center">
                        <button class="btn select-plan">select plan</button>
                    </div>
                </div>
            </div>
                @endforeach
        </div>
    </div>
</section>

{!! BBstyle($_this->path."/css/main1.css") !!}
@else
<section id="hosting-content">
    <div class="container">
        <div class="row">
            @foreach($plans as $plan)
                <div class="col-sm-4 block">
                    <div class="block-white text-center">
                        <hr>
                        <div class="block-title">
                            {!! $plan->name !!}
                        </div>
                        <div class="block-content">
                            <ul class="list-unstyled">
                                <li><b>{!! $plan->interval.'ly' !!} </b> Interval</li>
                                <li><b>{!! $plan->interval_count !!}</b> Interval Count</li>
                                <li><b>100tb</b> transfer</li>
                                <li><b>200</b> address e-mail</li>
                            </ul>
                        </div>
                        <div class="block-footer">
                            <b>${!! $plan->amount !!}</b>
                            <sup><b>00</b></sup>
                            <sub>{!! $plan->intrval_count.' '.$plan->interval !!}</sub>
                        </div>
                        <div class="buy btn">
                            buy
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
{!! BBstyle($_this->path."/css/main2.css") !!}
{!!  BBscript($_this->path.'/js/main.js') !!}
    @endif