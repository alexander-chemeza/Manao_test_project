// This class has been made to switch forms on main page
class FormSwitcher {
    constructor(btn) {
        this.btn = document.getElementById(btn);
        this.marker = btn;
    }

    init() {
        // clean name to find id of the box
        const aim = this.marker.substring(4);
        // find all the boxes
        const boxes = document.getElementsByClassName('box');
        // action on click
        this.btn.addEventListener('click', e => {
            e.preventDefault();
            // target box
            const shown_box = document.getElementById(aim);
            // hide all the boxes
            for (let box of boxes) {
                box.classList.add('hidden');
            }
            // show target box
            shown_box.classList.remove('hidden');
        });
    }
}

// current class usage
const home = new FormSwitcher('btn-homepage');
const registration = new FormSwitcher('btn-registration');
const login = new FormSwitcher('btn-authentification');

home.init();
registration.init();
login.init();