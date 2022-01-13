<div class="row m-2">
    <div class="col-md-6">
        <div class="card border-danger">
            <div class="card-header bg-danger">
                <h6 class="m-b-0 text-white">Services</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($services as $service)
                    <div class="col-md-6">
                        <button type="button" class="btn btn-primary btn-lg btn-block m-1"
                            wire:click="addToCard({{ $service->id }})">
                            {{ $loop->iteration }}. {{ $service->name }} ({{ $service->price }})
                        </button>
                    </div>

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
                <select name="" id="" class="form-control" wire:model="selected_appointment"
                    wire:change="select_appointment($event.target.value)">
                    <option value="">Chose appointment</option>
                    @foreach ($appointments as $appointment)
                    <option value="{{ $appointment->id }}">
                        {{ $loop->iteration }}) {{ $appointment->customer->name ?? '#' }} {{ date('h:i A',
                        strtotime($appointment->schedule->starting_time)) ?? '#' }} to {{ date('h:i A',
                        strtotime($appointment->schedule->ending_time)) ?? '#' }} ({{ date('d-M-Y',
                        strtotime($appointment->appointment_data)) }})
                    </option>
                    @endforeach
                </select>
                <form wire:submit.prevent="save_invoice" class="mt-3">
                    @if(count($basket) > 0)
                    <table class="table table-striped table-hover mt-3">
                        <thead class="bg-info text-white">
                            <tr>
                                <td>Service</td>
                                <td>Sub Total</td>
                                <td style="text-align: right;">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($basket as $array_key => $basket_item)
                            <tr>
                                <td>
                                    {{ $basket_item['name'] }}
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="">Price</span>
                                        </div>
                                        <input type="number" step="0.01" min="0" lang="en"
                                            class="form-control form-control-sm" style="width: 80px;"
                                            value="{{ $basket_item['price'] }}"
                                            wire:keydown.enter="chnage_price($event.target.value, {{ $array_key }})">
                                    </div>
                                    <select class="form-control form-control-sm"
                                        wire:keydown.enter="chnage_employee($event.target.value, {{ $array_key }})">
                                        <option value="">Chose employee</option>
                                        @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td style="font-size:16px;">
                                    QTY: {{ $basket_item['qty'] }}
                                    <br> Total: {{ $basket_item['price'] * $basket_item['qty'] }}
                                </td>

                                <td style="text-align: right;">
                                    <i class="fa fa-plus-square fa-lg text-success hoverable"
                                        wire:click="addToCard({{ $basket_item['id'] }})"></i> <br>
                                    <i class="fa fa-minus-square fa-lg text-warning hoverable"
                                        wire:click="removeFromCard({{ $basket_item['id'] }})"></i> <br>
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
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <b>Total Price: </b> {{ $total_price }}
                                </li>
                                <li class="list-group-item">
                                    Price after discount: {{ $price_after_discount }}
                                </li>
                                <li class="list-group-item">
                                    Total Vat: {{ $total_vat }}
                                </li>
                            </ul>
                        </div>
                        <div class="form-group col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    Advance amount: {{ $advance_payment }}
                                </li>
                                <li class="list-group-item">
                                    Have to pay: {{ $have_to_pay }}
                                </li>
                                <li class="list-group-item">
                                    Total include vat: {{ $total_include_vat }}
                                </li>
                            </ul>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">Dis %</span>
                                </div>
                                <input type="number" step="0.01" min="0" lang="en" class="form-control form-control-sm"
                                    value="0" wire:model="discount_percentage">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">Dis Fix</span>
                                </div>
                                <input type="number" step="0.01" min="0" lang="en" class="form-control form-control-sm"
                                    value="0" wire:model="discount_fixed">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <select name="" id="" class="form-control" required wire:model="payment_method">
                                <option value="">Chose payment method</option>
                                @foreach ($payment_methods as $payment_method)
                                <option value="{{ $payment_method->id }}">
                                    {{ $payment_method->name ?? '#' }}
                                </option>
                                @endforeach
                            </select>

                            @error('payment_method')
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