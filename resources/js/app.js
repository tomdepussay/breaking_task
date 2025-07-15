import "./bootstrap";
import "./modal";
import "./tabs";
import './project/reload.js';
import './project/leave.js';
import './project/quit.js';
import "./project/store.js";


import Alpine from "alpinejs";

document.addEventListener("keydown", function (event) {
    if (event.key === "Enter" && event.target.tagName === "INPUT") {
        event.preventDefault();
    }
});

window.Alpine = Alpine;

Alpine.start();
