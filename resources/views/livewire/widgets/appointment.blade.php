<div class="row m-2">
    <div class="col-md-3">
        <div class="card border-info">
            <div class="card-header bg-info">
                <h6 class="m-b-0 text-white">Create appointment</h6>
            </div>
            <div class="card-body">
                <input type="date" wire:model='date'>
                @if ($schedules)
                <div class="alert alert-success text-center my-2" role="alert">
                    <h6 class="alert-heading">{{ $schedules['day_name'] }}</h6>
                    <hr>
                    <p class="mb-0">{{ $schedules['date'] }}</p>
                </div>
                <div class="list-group">
                    @foreach ($schedules['data_set'] as $key => $schedule)
                    <a href="javascript:void(0)" wire:click="select_schedule('{{ $schedule->id }}')"
                        class="list-group-item list-group-item-action flex-column align-items-start @if ($selected_schedule == $schedule) active @endif">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">{{ $loop->iteration }} .
                                {{ $schedule->title }}</h6>
                        </div>
                        <small>{{ $schedule->starting_time }}-{{ $schedule->ending_time }}</small>
                    </a>
                    @endforeach
                </div>
                @else
                <div class="alert alert-danger mt-3 text-center">
                    <h6>Please Choose a date.</h6>
                </div>
                @endif
            </div>
        </div>
    </div>
    @if ($selected_schedule)
    <div class="col-md-3">
        <div class="card border-danger">
            <div class="card-header bg-danger">
                <h6 class="m-b-0 text-white">Services</h6>
            </div>
            <div class="card-body">
                <div class="list-group">
                    @foreach ($services as $service)
                    <a href="javascript:void(0)" wire:click="addToCard({{ $service->id }})"
                        class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">{{ $loop->iteration }} .
                                {{ $service->name }}</h6>
                        </div>
                        <small>{{ $service->price }} BDT</small>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-danger">
            <div class="card-header bg-danger">
                <h6 class="m-b-0 text-white">{{ $selected_schedule->title }}</h6>
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form wire:submit.prevent="store">
                    <table class="table table-striped table-hover mt-3">
                        <thead class="bg-info text-white">
                            <tr>
                                <td>Service</td>
                                <td>Staff</td>
                                <td style="text-align: right;">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($basket as $array_key => $basket_item)
                            <tr>
                                <td style="font-size:12px;">{{ $basket_item['name'] }} -
                                    {{ $basket_item['staff_id'] }}
                                    <br> Price: {{ $basket_item['price'] }}
                                    <br> QTY: {{ $basket_item['qty'] }}
                                    <br> Total: {{ $basket_item['price'] * $basket_item['qty'] }}
                                </td>
                                <td style="font-size:12px;">
                                    <select class="form-control" required
                                        wire:change="staff_assign($event.target.value, {{ $array_key }})">
                                        <option value="">Please Choose Staff</option>
                                        @foreach ($staffs as $staff)
                                        <option value="{{ $staff->id }}">
                                            {{ $staff->name }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td style="text-align: right;">
                                    <i class="fa fa-plus-square fa-lg text-success hoverable"
                                        wire:click="addToCard({{ $basket_item['id'] }})"></i>
                                    <i class="fa fa-minus-square fa-lg text-warning hoverable"
                                        wire:click="removeFromCard({{ $basket_item['id'] }})"></i>
                                    <i class="fa fa-trash fa-lg text-danger hoverable"
                                        wire:click="allRemoveFromCard({{ $basket_item['id'] }})"></i>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input wire:model="name" type="text" class="form-control" id="name" placeholder="Name"
                                required>
                            @error('name')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input wire:model="email" type="email" class="form-control" id="email"
                                placeholder="Enter Email">
                            @error('email')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input wire:model="phone" type="text" class="form-control" id="phone" placeholder="Phone"
                                required>
                            @error('phone')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input wire:model="address" type="text" class="form-control" id="address"
                                placeholder="Address" required>
                            @error('address')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input wire:model="transaction_id" type="text" class="form-control" id="transaction_id"
                                placeholder="Transaction Id" @if(!$admin_mode) required @endif>
                            @error('transaction_id')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input wire:model="advance_amount" type="number" class="form-control" id="advance_amount"
                                placeholder="Advance Amount" @if(!$admin_mode) required @endif>
                            @error('advance_amount')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary col-md-12">Submit</button>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>