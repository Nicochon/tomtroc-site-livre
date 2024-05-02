import updatePhoto from "./components/updatePhoto";
import popupVerifcation from "./components/popupVerification";
import messages from "./components/messages";

window.addEventListener("load", (event) => {

//gestion photo update
    const photoUpdate = new updatePhoto;

    let link =  document.getElementById('getFormToLoad');
    let divForm =  document.getElementById('formToLoad');
    let img = document.getElementById('profilePicture')

    if(link !== null){
        link.addEventListener('click', async function(e) {
            e.preventDefault();
            let html = await photoUpdate.getFormInfo();

            divForm.innerHTML = html;
            let btnSubmit = document.getElementById('btnSubmitAdmin');

            btnSubmit.addEventListener('click', async function(e) {
                e.preventDefault();
                let src = await photoUpdate.postFormPhoto();
                img.src = src;
                photoUpdate.clearDiv();
            })
        })
    }


//gestion popup confirmDelete
    const verificationPopup = new popupVerifcation;
    let deleteBooks = document.querySelectorAll('#deleteBook');
    let popupDiv = document.getElementById('popup');

    deleteBooks.forEach(function (deleteBook){
        deleteBook.addEventListener('click',async function (e){
            e.preventDefault();
            let htmlPopup = await verificationPopup.getPopupInfo();
            popupDiv.innerHTML = htmlPopup;

            let confirmLink = document.querySelector('.confirm');
            confirmLink.href = 'index.php?action=deleteBook&id='+ verificationPopup.getIdBook('id', deleteBook.href );

            let closeLink = document.querySelector('.close');

            verificationPopup.displayPopup(popupDiv, true);

            confirmLink.addEventListener('click', async function(e){
                e.preventDefault();
                verificationPopup.postDeleteBook(confirmLink.href);
                verificationPopup.displayPopup(popupDiv, false);
                location.reload();
            })

            closeLink.addEventListener('click',  function(e){
                e.preventDefault();
                verificationPopup.displayPopup(popupDiv, false);
            });
        })
    });

//gestion de la messagerie
    const conversation = new messages;

    let displayConversation = document.querySelectorAll('#displayConversation');
    let div = document.getElementById('conversation')

    displayConversation.forEach(function (displayConversation){
        displayConversation.addEventListener('click', async function (e){
            e.preventDefault();
            let url = displayConversation.getAttribute('href');
            let htmlConversation = await conversation.getConversationInfo(url);
            conversation.clearDiv();
            div.innerHTML = htmlConversation;
        });
    });

});