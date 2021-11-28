/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './scss/app.scss';

// start the Stimulus application
import './bootstrap';

// TODO : Découpage JS
const el = document.querySelector("button.add_item_link");
el.addEventListener("click", function(e) {
    const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);
    const item = document.createElement('li');
    item.innerHTML = collectionHolder.dataset.prototype.replace(/__name__/g, collectionHolder.dataset.index);
    collectionHolder.appendChild(item);
    collectionHolder.dataset.index ++;
}, false);