
function toggleEditLinks() {
    var editLinks = document.getElementsByClassName('edit-link');

    for (var i = 0; i < editLinks.length; i++) {
        editLinks[i].style.display = (editLinks[i].style.display === 'none' || editLinks[i].style.display === '') ? 'table-cell' : 'none';
    }
}
