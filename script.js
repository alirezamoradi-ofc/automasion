// scripts for normal-user.html
const li_containers = document.querySelectorAll('li.container');

for (let li of li_containers) {
    li.addEventListener('click', togglePanelItem);
}

function togglePanelItem(e) {
    let liContainer = e.target.closest('li.container');
    liContainer.classList.toggle("expand")
}
const panel_opener = document.querySelectorAll('.panel-opener');
for(let item of panel_opener) {
    item.addEventListener('click', openContextTarget);
}
function openContextTarget(e) {
    e.stopPropagation();
    let prev_activePanelContent = document.querySelector('.context > .show');
    prev_activePanelContent ? prev_activePanelContent.classList.remove('show') : null;

    let target_context = e.target.dataset.contextTarget;
    document.querySelector(`.${target_context}`).classList.add('show');
}

// show date 
let today = new Date().toLocaleDateString('fa-IR');
const date_cell = document.querySelector('.date-cell')
date_cell.textContent = today;

//log-out from normal-user
const logout_button = document.querySelector('button.log-out');
logout_button.addEventListener('click', function() {
    window.location = 'login.html';
})


// remove letter item by click on 'حذف' button
const removeLetter_buttons = document.querySelectorAll('button.remove-letter');
for(let button of removeLetter_buttons) {
    button.addEventListener('click', removeLetter)
}
function removeLetter(e) {
    let letter = e.target.closest('.letter');
    letter.remove();
}

// remove member  by click on 'حذف عضو' button
const removeMember_buttons = document.querySelectorAll('button.remove-member');
for(let button of removeMember_buttons) {
    button.addEventListener('click', removeMember)
}
function removeMember(e) {
    let member = e.target.closest('.member');
    member.remove();
}
