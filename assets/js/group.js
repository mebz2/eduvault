const parent = document.getElementById('parent')

// invite member popup
const invite_button = document.getElementById('invite-members-btn')
const close_member = document.getElementById('close-member-button')
const member_popup = document.getElementById('member-popup');
const member_form = document.getElementById('invite-member-form')

// upload file popup
const upload_button = document.getElementById('upload-file-button')
const close_file = document.getElementById('close-file-button')
const file_popup = document.getElementById('file-popup');
const file_form = document.getElementById('file-upload-form')


invite_button.addEventListener('click', () => {
    member_popup.style.display = "block"
    parent.classList.add('blur')
})

close_member.addEventListener('click', () => {
    member_popup.style.display = "none"
    parent.classList.remove('blur')
})



upload_button.addEventListener('click', () => {
    file_popup.style.display = "block"
    parent.classList.add('blur')
})

close_file.addEventListener('click', () => {
    file_popup.style.display = "none"
    parent.classList.remove('blur')
})



// to get the file name 
const fileInput = document.getElementById('choose-file')
const filename = document.getElementById('filename')

fileInput.addEventListener('change', () => {
    const name = fileInput.files[0].name
    filename.textContent = name
})
