const btnEdit = document.getElementsByClassName('js-edit-room');
const modalUpdate = new bootstrap.Modal("#editRoomModal");

for (const element of btnEdit) {
    element.addEventListener('click', async function () {
        let urlGet = element.getAttribute('data-urlGet');
        let urlPut = element.getAttribute('data-urlPut');

        let response = await fetch(urlGet);
        let data = await response.json();
      
        document.getElementById('name-update').value = data.name;
        document.getElementById('area-update').value = data.area;
        document.getElementById('usable_area-update').value = data.usable_area;
        document.getElementById('price-update').value = data.price;
        document.getElementById('capacity-update').value = data.capacity;
        document.getElementById('description-update').value = data.description;

        document.getElementById('f-update-room').action = urlPut;
        modalUpdate.show();
    });
}