export const Modal = (path?: string, params?: any) => {
    if (path) {
        return (window as any).Livewire.emit('openModal', `modals.${ path }`, params || []);
    }

    return {
        show:                   false,
        showActiveComponent:    true,
        activeComponent:        false,
        componentHistory:       [] as Array<any>,
        hide (event: Event) {

            //
            // Do not close if a datepicker was clicked from within a modal
            if (!!event.target && ((event.target as HTMLElement).closest('.pika-lendar') !== null || (event.target as HTMLElement).closest('.pika-time-container') !== null)) {
                return;
            }

            this.show = false;
        },
        setActiveModalComponent (id: any, skip = false) {
            this.show = true;

            if (this.activeComponent !== false && skip === false) {
                this.componentHistory.push(this.activeComponent);
            }

            if (this.activeComponent === false) {
                this.activeComponent = id
                this.showActiveComponent = true;
            } else {
                this.showActiveComponent = false;

                setTimeout(() => {
                    this.activeComponent = id;
                    this.showActiveComponent = true;
                }, 300);
            }
        },
        focusables () {
            let selector = 'a, button, input, textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'

            return [...(this as any).$el.querySelectorAll(selector)]
                .filter(el => !el.hasAttribute('disabled'))
        },
        firstFocusable () {
            return this.focusables()[0]
        },
        lastFocusable () {
            return this.focusables().slice(-1)[0]
        },
        nextFocusable () {
            return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable()
        },
        prevFocusable () {
            return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable()
        },
        nextFocusableIndex () {
            return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1)
        },
        prevFocusableIndex () {
            return Math.max(0, this.focusables().indexOf(document.activeElement)) - 1
        },
        init () {
            (this as any).$watch('show', (value: any) => {
                if (value) {
                    document.body.classList.add('overflow-y-hidden');
                } else {
                    document.body.classList.remove('overflow-y-hidden');

                    setTimeout(() => {
                        this.activeComponent = false;
                        (this as any).$wire.resetState();
                    }, 300);
                }
            });

            (window as any).Livewire.on('closeModal', (force = false, skipPreviousModals = 0) => {

                if (skipPreviousModals > 0) {
                    for ( var i = 0; i < skipPreviousModals; i++ ) {
                        this.componentHistory.pop();
                    }
                }

                const id = this.componentHistory.pop();

                if (id && force === false) {
                    if (id) {
                        this.setActiveModalComponent(id, true);
                    } else {
                        this.show = false;
                    }
                } else {
                    this.show = false;
                }
            });

            (window as any).Livewire.on('activeModalComponentChanged', (id) => {
                this.setActiveModalComponent(id);
            });
        }
    };
}
