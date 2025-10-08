const button = document.getElementById('invite-members-btn')
const parent = document.getElementById('parent')
const close = document.getElementById('close-button')
const popup = document.getElementById('member-popup');
button.addEventListener('click', () => {
    console.log('clicked');
    popup.style.display = "block"
    parent.classList.add('blur')
})

close.addEventListener('click', () => {
    popup.style.display = "none"
    parent.classList.remove('blur')
})



