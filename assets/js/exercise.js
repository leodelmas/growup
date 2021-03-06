document.addEventListener('DOMContentLoaded', (event) => {
    // Autocomplete name field
    let recordedExerciceType = document.getElementById("exercise_recorded_exercise")
    let exerciceNameType = document.getElementById("exercise_name")
    if (null !== recordedExerciceType) {
        recordedExerciceType.addEventListener("change", function() {
            exerciceNameType.value = this.options[this.selectedIndex].text
        }, false)
    }

    // Series field collection
    let addItemLink = document.querySelector("button.add_item_link");
    if(addItemLink) {
        addItemLink.addEventListener("click", function(e) {
            let collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);
            let item = document.createElement('li');
            item.classList.add('flex', 'items-center', 'justify-between')
            item.innerHTML = collectionHolder.dataset.prototype.replace(/__name__/g, collectionHolder.dataset.index);
            collectionHolder.appendChild(item);
            addTagFormDeleteLink(item)
            collectionHolder.dataset.index ++;
        }, false);
    }
    let seriesList = document.querySelector('ul.series');
    if (seriesList) {
        for (let series of seriesList.getElementsByTagName('li')) {
            addTagFormDeleteLink(series)
        }
    }
    function addTagFormDeleteLink (tagFormLi) {
        let removeFormButton = document.createElement('button')
        removeFormButton.classList.add('text-indigo-500')
        removeFormButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewbox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>'
        tagFormLi.append(removeFormButton);
        removeFormButton.addEventListener('click', (e) => {
            e.preventDefault()
            tagFormLi.remove();
        });
    }
})