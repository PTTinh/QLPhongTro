const btnEdit = document.getElementsByClassName('js-edit-contract');
const modalUpdate = new bootstrap.Modal("#editContractModal");

for (const element of btnEdit) {
    element.addEventListener('click', async function () {
        let urlGet = element.getAttribute('data-urlGet');
        let urlPut = element.getAttribute('data-urlPut');
        let urlGetRoom = element.getAttribute('data-urlGetRoom');
        

        let response = await fetch(urlGetRoom);
        let dataRoom = await response.json();

        response = await fetch(urlGet);
        let data = await response.json();

        let select = document.getElementById('room_id-update');
        select.innerHTML = '';
        for(const room of dataRoom) {
            let option = document.createElement('option');
            option.value = room.id;
            option.text = room.name;
            if(data.room_id == room.id) {
                option.selected = true;
            }
            select.appendChild(option);
        }

        document.getElementById('start_date-update').value = data.start_date;
        document.getElementById('end_date-update').value = data.end_date;
        document.getElementById('month-update').value = data.month;
        document.getElementById('price_eletric-update').value = data.price_eletric;
        document.getElementById('price_water-update').value = data.price_water;
        document.getElementById('other_fees-update').value = data.other_fees;

        document.getElementById('f-edit-contract').action = urlPut;
        modalUpdate.show();
    });
}