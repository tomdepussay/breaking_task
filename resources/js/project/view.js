let views = [];

document.querySelectorAll('.views').forEach((el) => {
    views.push(el);
})

document.querySelectorAll('.change-view').forEach((button) => {
    button.addEventListener('click', (e) => {
        let view = button.getAttribute('data-view');

        views.forEach((el) => {
            if(el.getAttribute('data-view') === view) {
                el.classList.remove('hidden');
            } else {
                el.classList.add('hidden');
            }
        })

        document.querySelectorAll('.change-view').forEach((el) => {
            if(el.getAttribute('data-view') === view) {
                el.classList.add('underline');
            } else {
                el.classList.remove('underline');
            }
        })

    })  
})