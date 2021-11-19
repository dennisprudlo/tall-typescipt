<?php

namespace App\Livewire\Extensions;

use Livewire\Component;

abstract class StateAwareModal extends Component {

    /**
     * Whether to force close the whole chain when closing the modal
     */
    public bool $forceClose = false;

    /**
     * The amount of modals to skip in the chain when closing
     */
    public int $skipModals = 0;

    /**
     * Check whether the authenticated user has access to the modal
     *
     * @param object $attributes
     * @return boolean
     */
    public static function accessGranted (object $attributes) : bool {
        return true;
    }

    /**
     * Sets the skip previous modals count
     *
     * @param integer $count
     * @return self
     */
    public function skipPrevious ($count = 1) : self {
        $this->skipModals = $count;
        return $this;
    }

    /**
     * Sets the force close property
     *
     * @return self
     */
    public function forceClose () : self {
        $this->forceClose = true;
        return $this;
    }

    /**
     * Emits the open modal event
     *
     * @param string $component The component name or class
     * @param array<mixed> $attributes Component attributes to pass
     * @return void
     */
    public function openModal (string $component, array $attributes = []) : void {
        if (class_exists($component)) {
            $component = (string) str($component)->replaceFirst(config('livewire.class_namespace').'\\Modals', '')->kebab();
        }

        $this->emit('openModal', 'modals.'.$component, $attributes);
    }

    /**
     * Emits the close modal event
     *
     * @return void
     */
    public function closeModal () : void {
        $this->emit('closeModal', $this->forceClose, $this->skipModals);
    }

    /**
     * Emits the close modal event and emits additional events for the modal
     *
     * @param array<mixed> $events
     * @return void
     */
    public function closeModalWithEvents (array $events) : void {
        $this->closeModal();
        $this->emitModalEvents($events);
    }

    /**
     * Emits modal events collected from the passed array
     *
     * @param array<mixed> $events
     * @return void
     */
    private function emitModalEvents (array $events) : void {
        foreach ($events as $component => $event) {
            if (is_array($event)) {
                [$event, $params] = $event;
            }

            if (is_numeric($component)) {
                $this->emit($event, ...$params ?? []);
            } else {
                $this->emitTo($component, $event, ...$params ?? []);
            }
        }
    }
}
