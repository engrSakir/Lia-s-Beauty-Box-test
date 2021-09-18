<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ColumnChartWithAxisBreak extends Component
{
    public $chart_id, $data_set;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($chart = null, $data = null)
    {
        $this->chart_id = $chart;
        $this->data_set = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.column-chart-with-axis-break');
    }
}
