import updatePhoto from "./components/updatePhoto";

window.addEventListener("load", (event) => {
    const photoUpdate = new updatePhoto;


    let link =  document.getElementById('getFormToLoad');
    let divForm =  document.getElementById('formToLoad');
    let img = document.getElementById('profilePicture')

    link.addEventListener('click', async function(e) {
        e.preventDefault();
        let html = await photoUpdate.getFormInfo();
        divForm.innerHTML = html;
        let btnSubmit = document.getElementById('btnSubmitAdmin');

        btnSubmit.addEventListener('click', async function(e) {
            e.preventDefault();
            let html = await photoUpdate.postFormPhoto();
            img.src = html
            photoUpdate.clearDiv();
        })
    })
});