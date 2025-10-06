// create a blur when create group pop up appears
const button = document.getElementById('create-group-button')
const parent = document.getElementById('parent')
const close = document.getElementById('close-button')
const popup = document.getElementById('popup');
button.addEventListener('click', () => {
    popup.style.display = "block"
    parent.classList.add('blur')
})

close.addEventListener('click', () => {
    popup.style.display = "none"
    parent.classList.remove('blur')
})

//make the arrow appear when the group card is hovered on
const cards = Array.from(document.getElementsByClassName('group')) // because it returns a collection, i do this to change it into a normal array

cards.forEach(card => {
    card.addEventListener('mouseenter', () => {
    })
})



