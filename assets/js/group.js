function showContent(id, button) {
    //hide all content
    document.querySelectorAll('.contents').forEach(div => {
        div.classList.remove('active')
    })

    //have the selected div be active(visible)
    document.getElementById(id).classList.add('active');

    //remove active button styles from all buttons
    document.querySelectorAll('.button').forEach(btn => {
        btn.classList.remove('active-btn')
    })

    //make the clicked button have active button styling
    button.classList.add('active-btn')
}

const parent = document.getElementById('parent')

// create blur when invite member popup appears
const invite_button = document.getElementById('invite-members-btn')
const close_member = document.getElementById('close-member-button')
const member_popup = document.getElementById('member-popup');
// const member_form = document.getElementById('invite-member-form')

invite_button.addEventListener('click', () => {
    member_popup.style.display = "block"
    parent.classList.add('blur')
})

close_member.addEventListener('click', () => {
    member_popup.style.display = "none"
    parent.classList.remove('blur')
})

// create blur when upload file popup appears
const upload_button = document.getElementById('upload-file-button')
const close_file = document.getElementById('close-file-button')
const file_popup = document.getElementById('file-popup');
// const file_form = document.getElementById('file-upload-form')

upload_button.addEventListener('click', () => {
    file_popup.style.display = "block"
    parent.classList.add('blur')
})

close_file.addEventListener('click', () => {
    file_popup.style.display = "none"
    parent.classList.remove('blur')
})


// edit group popup
const edit_button = document.getElementById('edit-group-btn')
const close_edit = document.getElementById('close-edit-button')
const edit_popup = document.getElementById('edit-popup');
// const edit_form = document.getElementById('edit-group-form')

edit_button.addEventListener('click', () => {
    console.log('clicked')
    edit_popup.style.display = "block"
    parent.classList.add('blur')
})

close_edit.addEventListener('click', () => {
    edit_popup.style.display = "none"
    parent.classList.remove('blur')
})



// to get the file name to display in the popup after file selection
const fileInput = document.getElementById('choose-file')
const filename = document.getElementById('filename')

fileInput.addEventListener('change', () => {
    const name = fileInput.files[0].name
    filename.textContent = name
})

// delete group popup
const delete_button = document.getElementById('delete-group-btn')
const close_delete = document.getElementById('close-delete-btn')
const confirmation = document.getElementById('delete-group-confirmation-popup');

delete_button.addEventListener('click', () => {
    console.log('delete clicked')
    confirmation.style.display = 'block'
    parent.classList.add('blur')
})

close_delete.addEventListener('click', () => {
    confirmation.style.display = 'none'
    parent.classList.remove('blur')
})

// leave group popup
const leave_button = document.getElementById('leave-group-btn')
const close_leave = document.getElementById('close-leave-btn')
const leave_conf = document.getElementById('leave-group-confirmation-popup')

leave_button.addEventListener('click', () => {
    leave_conf.style.display = 'block'
    parent.classList.add('blur')
})

close_leave.addEventListener('click', () => {
    leave_conf.style.display = 'none'
    parent.classList.remove('blur')
})
