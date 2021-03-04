const listItems = document.querySelectorAll(".items");
listItems.forEach(listItem => {
    listItem.addEventListener('click', () => {
        listItem.children[0].classList.toggle('baught');
    });
});