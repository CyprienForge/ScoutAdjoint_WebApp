import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static values = { message: String }

    connect() {
        console.log("✅ Stimulus ConfirmController connecté !");
    }

    confirm(event) {
        if (!confirm(this.messageValue)) {
            event.preventDefault();
        }
    }
}
