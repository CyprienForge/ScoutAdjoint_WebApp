import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["form"]

    connect() {
        console.log("✅ Stimulus ResetController connecté !");
    }

    reset(event) {
        event.preventDefault();
        const inputs = document.querySelectorAll("#form input")

        inputs.forEach((input) => {
            input.value = ""
            input.checked = false
        })
    }


}
