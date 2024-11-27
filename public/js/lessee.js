const btnShowEdit = document.getElementsByClassName('js-show-edit-lessee');
const modalUpdate = new bootstrap.Modal("#showLesseeModal");

for (const element of btnShowEdit) {
    element.addEventListener('click', async function () {
        let urlGet = element.getAttribute('data-urlGet');
        let urlPut = element.getAttribute('data-urlPut');

        let response = await fetch(urlGet);
        let data = await response.json();
      
        document.getElementById('name-update').value = data.name;
        document.getElementById('email-update').value = data.email;
        document.getElementById('phone-update').value = data.phone;
        document.getElementById('address-update').value = data.address;
        document.getElementById('dob-update').value = data.dob;
        document.getElementById('job-update').value = data.job;
        document.getElementById('cccd_number-update').value = data.cccd_number;
        document.getElementById('cccd_front_image-update').src = data.cccd_front_image;
        document.getElementById('cccd_back_image-update').src = data.cccd_back_image;

        document.getElementById('f-update-lessee').action = urlPut;
        modalUpdate.show();
    });
}

