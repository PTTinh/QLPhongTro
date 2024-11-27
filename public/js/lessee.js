const btnShowEdit = document.getElementsByClassName('js-show-edit-lessee');
const modalUpdate = new bootstrap.Modal("#showLesseeModal");

for (const element of btnShowEdit) {
    element.addEventListener('click', async function () {
        let urlGet = element.getAttribute('data-urlGet');
        let urlPut = element.getAttribute('data-urlPut');
        let urlImage1 = element.getAttribute('data-urlimage1');
        let urlImage2 = element.getAttribute('data-urlimage2');
        let response = await fetch(urlGet);
        let data = await response.json();
      
        document.getElementById('name-update').value = data.name;
        document.getElementById('email-update').value = data.email;
        document.getElementById('phone-update').value = data.phone;
        document.getElementById('address-update').value = data.address;
        document.getElementById('dob-update').value = data.dob;
        document.getElementById('job-update').value = data.job;
        document.getElementById('cccd_number-update').value = data.cccd_number;
        document.getElementById('cccd_front_image-update').src = urlImage1;
        document.getElementById('cccd_back_image-update').src = urlImage2;

        document.getElementById('f-update-lessee').action = urlPut;
        modalUpdate.show();
    });
}

