<div class="row m-2">
    <div class="col-md-6">
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
                        <small>{{ $service->price }}</small>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-danger">
            <div class="card-header bg-danger">
                <h6 class="m-b-0 text-white">Invoice</h6>
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
                <select name="" id="" class="form-control" wire:change="select_appointment($event.target.value)">
                    <option value="" disabled>Chose appointment</option>
                    @foreach ($appointments as $appointment)
                    <option value="{{ $appointment->id }}">
                        {{ $loop->iteration }}) {{ $appointment->customer->name ?? '#' }} {{ date('h:i A', strtotime($appointment->schedule->starting_time)) ?? '#' }} to {{ date('h:i A', strtotime($appointment->schedule->ending_time)) ?? '#' }} ({{ date('d-M-Y', strtotime($appointment->appointment_data)) }})
                    </option>
                    @endforeach
                </select>
                <form wire:submit.prevent="store" class="mt-3">
                    @if(count($basket) > 0)
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
                                    STAFF
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
                    @endif
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
                                placeholder="Transaction Id">
                            @error('transaction_id')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input wire:model="advance_amount" type="number" class="form-control" id="advance_amount"
                                placeholder="Advance Amount">
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
</div>