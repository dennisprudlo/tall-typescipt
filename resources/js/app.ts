import Alpine from 'alpinejs';
import { app } from './common/Application';
import { Modal } from './common/Modal';

app.bind({ Alpine, Modal }).ready(() => {
    //
});

Alpine.start();
