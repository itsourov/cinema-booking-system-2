import './dark-mode';
import './filepond.js';
import './show-cd.js';
import 'flowbite';
import '../../node_modules/flowbite/dist/datepicker'
import 'spotlight.js';




import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()

import jQuery from 'jquery';
window.$ = jQuery;

$(".accordation").click(function () {
    $(this).next().slideToggle(100)

});