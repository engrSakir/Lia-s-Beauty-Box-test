<?php
use App\Http\Controllers\Frontend\FrontEndController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Frontend Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', [FrontEndController::class, 'index'])->name('index');
Route::get('/booking', function () {
    if(request()->ajax() && request()->appointment_data){
        $weekMap = [
            0 => 'sunday',
            1 => 'monday',
            2 => 'tuesday',
            3 => 'wednesday',
            4 => 'thursday',
            5 => 'friday',
            6 => 'saturday',
        ];

        $day_name = $weekMap[date('w', strtotime(request()->appointment_data))];
        $date = request()->appointment_data;

        return [
            'day_name' => $weekMap[date('w', strtotime(request()->appointment_data))],
            'date' => request()->appointment_data,
            'schedules' => \App\Models\Schedule::where('schedule_day', $day_name)->get()
        ];
    }

    return view('frontend.booking');
})->name('booking');

