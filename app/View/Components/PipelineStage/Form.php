<?php

namespace App\View\Components\PipelineStage;

use App\Models\PipelineStage;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public PipelineStage $stage;

    /**
     * Create a new component instance.
     */
    public function __construct(?PipelineStage $stage = null)
    {

        $this->stage = $stage ?? new PipelineStage();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pipeline-stage.form');
    }
}
