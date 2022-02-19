/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './scss/app.scss';

// TODO : Découpage JS
const addItemLink = document.querySelector("button.add_item_link");
if(addItemLink) {
    addItemLink.addEventListener("click", function(e) {
        const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);
        const item = document.createElement('li');
        item.classList.add('flex', 'items-center', 'justify-between')
        item.innerHTML = collectionHolder.dataset.prototype.replace(/__name__/g, collectionHolder.dataset.index);
        collectionHolder.appendChild(item);
        addTagFormDeleteLink(item)
        collectionHolder.dataset.index ++;
    }, false);
}

const seriesList = document.querySelector('ul.series');
if (seriesList) {
    for (let series of seriesList.getElementsByTagName('li')) {
        addTagFormDeleteLink(series)
    }
}

function addTagFormDeleteLink (tagFormLi) {
    const removeFormButton = document.createElement('button')
    removeFormButton.classList.add('text-indigo-500')
    removeFormButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewbox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>'

    tagFormLi.append(removeFormButton);

    removeFormButton.addEventListener('click', (e) => {
        e.preventDefault()
        tagFormLi.remove();
    });
}

// Session mood field value
const allRanges = document.querySelectorAll(".range-wrap");
allRanges.forEach(wrap => {
  const range = wrap.querySelector("input[type='range']");
  const output = wrap.querySelector("output");

  range.addEventListener("input", () => {
    setOutput(range, output);
  });
  setOutput(range, output);
});

function setOutput(range, output) {
  const val = range.value;
  const min = range.min ? range.min : 0;
  const max = range.max ? range.max : 100;
  const newVal = Number(((val - min) * 100) / (max - min));
  output.innerHTML = val;
  output.style.left = `calc(${newVal}% + (${8 - newVal * 0.15}px))`;
}