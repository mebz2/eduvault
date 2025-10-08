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

