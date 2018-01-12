@php
    $membershipTypesRepository=new \BtyBugHook\Membership\Repository\MembershipTypesRepository();
    $membershipTypes=$membershipTypesRepository->findAllByMultiple(['is_default'=>0]);
@endphp

<section id="hosting-content">
    <div class="container">
        <div class="row">
            @foreach($membershipTypes as $membershipType)
                <div class="col-sm-4">
                    <div class="block-white text-center">
                        <hr>
                        <div class="block-title">
                            {!! $membershipType->title !!}
                        </div>
                        <div class="block-content">
                            <ul class="list-unstyled">
                                <li><b>{!! $membershipType->plan->interval.'ly' !!}</b> interval</li>
                                <li><b>{!! $membershipType->plan->interval_count !!}</b> interval count</li>
                                <li><b></b> </li>
                                <li><b></b> </li>
                            </ul>
                        </div>
                        <div class="block-footer">
                            <b>${!! $membershipType->plan->amount/100 !!}</b>
                            <sup><b>00</b></sup>
                            <sub>month</sub>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>

{!! BBstyle($_this->path."/css/main.css") !!}
{!!  BBscript($_this->path.'/js/main.js') !!}