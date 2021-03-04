const listItems = document.querySelectorAll(".items");
listItems.forEach(listItem => {
    listItem.addEventListener('click', () => {
        listItem.children[0].classList.add('baught');
        listItem.children[2].classList.add('baught');
    });
    listItem.addEventListener('mouseenter', () => {
        listItem.children[1].classList.remove('hideClass');
    });
    listItem.addEventListener('mouseleave', () => {
        listItem.children[1].classList.add('hideClass');
    });
});