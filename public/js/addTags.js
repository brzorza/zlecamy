document.addEventListener('DOMContentLoaded', () => {
    let inputTags = document.getElementById('tags');
    let ul = document.getElementById('tagsContainer');
    let err = document.getElementById('errorBox');
    let hiddenTags = document.getElementById('hiddenTags');

    let allTags = [];

    function updateHiddenInput() {
        hiddenTags.value = allTags.join(',');
    }

    function createLi(){
        ul.querySelectorAll('li').forEach(li => li.remove());
        allTags.slice().reverse().forEach(tag =>{
            let liTag = `<li onClick="removeTag(this, '${tag}')" class="cursor-pointer mt-2">${tag} <i class="fa-solid fa-xmark"></i></li>`;
            ul.insertAdjacentHTML('afterbegin', liTag);
        })
        updateHiddenInput();
    }

    window.removeTag = function(element, tag){
        let index = allTags.indexOf(tag);

        if (index !== -1) {
            allTags = [...allTags.slice(0, index), ...allTags.slice(index + 1)];
            element.remove(); // Remove the element from the DOM
            console.log(allTags);
            updateHiddenInput();
        }
    }

    function addTag(e) {
        if (e.key === 'Enter') {
            let tag = e.target.value.replace(/\s+/g, ' ').trim().toUpperCase();

            if(allTags.includes(tag) && !document.getElementById('duplicate-err')){
                let errText = '<p id="duplicate-err" class="mt-2" x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">Tag już istnieje</p>';
                err.insertAdjacentHTML('afterbegin', errText);
            }else{
                if (allTags.length < 5 && tag.length > 1) {
                    allTags.push(tag);
                    console.log(allTags);
                    e.target.value = '';
                    createLi();
                } else {
                    if(!document.getElementById('tags-err')){
                        let errText = '<p id="tags-err" class="mt-2" x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">Nie można dodać więcej niż 5 tagów</p>';
                        err.insertAdjacentHTML('afterbegin', errText);
                    }
                }
            }
        }   
    }       

    inputTags.addEventListener('keyup', addTag);

    inputTags.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
        }
    });
});