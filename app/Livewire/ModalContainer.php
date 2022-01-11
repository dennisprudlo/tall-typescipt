<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class ModalContainer extends Component {

    /**
     * The id of the currently active component
     *
     * @var string|null
     */
    public ?string $activeComponent;

    /**
     * The list of the components currently in the stack
     *
     * @var array<string, array<mixed>>
     */
    public array $components = [];

    /**
     * Resets the modal state
     *
     * @return void
     */
    public function resetState () : void {
        $this->components = [];
        $this->activeComponent = null;
    }

    /**
     * Opens a new modal
     *
     * @param string|class-string $component
     * @param array<mixed> $componentAttributes
     * @param array<mixed> $modalAttributes
     * @return void
     */
    public function openModal ($component, $componentAttributes = [], $modalAttributes = []) : void {

        //
        // Get the relative path to the component class
        $path = implode('\\', array_map(function ($pathPart) {
            return implode('', array_map(fn ($filePart) => ucfirst($filePart), explode('-', $pathPart)));
        }, explode('.', $component)));

        $class = config('livewire.class_namespace').'\\'.$path;

        //
        // If the modal class to open does not exist
        // prevent further execution
        if (! \class_exists($class)) {
            return;
        }

        //
        // Check if the component class grants access
        if (! $class::accessGranted((object) $componentAttributes)) {
            return;
        }

        $id = md5($component.serialize($componentAttributes).str()->uuid());
        $this->components[$id] = [
            'name'            => $component,
            'attributes'      => $componentAttributes,
            'modalAttributes' => $modalAttributes,
        ];

        $this->activeComponent = $id;

        $this->emit('activeModalComponentChanged', $id);
    }

    /**
     * Defines the modal container component listeners
     *
     * @return array<string>
     */
    public function getListeners () : array {
        return [ 'openModal' ];
    }

    /**
     * Renders the component
     *
     * @return View
     */
    public function render () : View {
        return view('modal-container');
    }
}
