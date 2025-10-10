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




