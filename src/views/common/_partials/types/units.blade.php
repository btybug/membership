<p>Units</p>

@if(count($units))
    @foreach($units as $unit)
        <div class="col-md-2" style="height: 50px; border: 1px solid black;padding: 5px;">
            <p>
                {{ $unit->title }}
            </p>
        </div>
    @endforeach
@else
    No Available Units
@endif