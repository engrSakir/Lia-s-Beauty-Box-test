<div class="row">
    <div class="col-md-6">
        <div class="card border-info">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">Create appointment</h4></div>
            <div class="card-body">
                <input type="date" wire:model='date'>
                <h2>{{ collect($schedules) }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-danger">
            <div class="card-header bg-danger">
                <h4 class="m-b-0 text-white">Card Title</h4></div>
            <div class="card-body">
                <h3 class="card-title">Special title treatment</h3>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="javascript:void(0)" class="btn btn-dark">Go somewhere</a>
            </div>
        </div>
    </div>
</div>
