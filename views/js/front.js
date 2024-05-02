(function (factory) {
    typeof define === 'function' && define.amd ? define('index', factory) :
    factory();
}((function () { 'use strict';

    class updatePhoto {
      constructor() {}
      init() {
        this.displayFileUpload();
      }
      displayFileUpload() {
        document.querySelector('.custom-file-upload').addEventListener('click', function () {});
      }
      async getFormInfo() {
        let id = this.getParameterByName('id');
        let urlPost = '';
        if (id !== null) {
          urlPost = 'index.php?action=updatePhotoForm&key=book&id=' + id;
        } else {
          urlPost = 'index.php?action=updatePhotoForm&key=profile';
        }
        try {
          const response = await fetch(urlPost);
          const html = await response.text();
          const parser = new DOMParser();
          const doc = parser.parseFromString(html, 'text/html');
          const form = doc.querySelector('form');
          if (form) {
            return form.outerHTML;
          } else {
            throw new Error('Le formulaire est introuvable dans le contenu HTML.');
          }
        } catch (err) {
          console.warn('Something went wrong.', err);
          throw err; // Rethrow the error to propagate it further
        }
      }
      async postFormPhoto() {
        let inputForm = document.getElementById('fileUpload');
        let valueInput = inputForm.files[0];
        let data = new FormData();
        data.append('photo', valueInput);
        let id = this.getParameterByName('id');
        let urlPost = '';
        if (id !== null) {
          urlPost = 'index.php?action=uploadBookPicture&id=' + id;
        } else {
          urlPost = 'index.php?action=uploadProfilPicture';
        }
        try {
          const response = await fetch(urlPost, {
            method: 'POST',
            body: data
          });
          if (response.ok) {
            const html = await response.text();
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            let img = doc.getElementById('profilePicture');
            if (img) {
              return img.src;
            } else {
              throw new Error('La photo est introuvable dans le contenu HTML.');
            }
          } else {
            console.error('Get cart request error', response.statusText);
          }
        } catch (error) {
          console.error('Get cart request error', error);
        }
      }
      clearDiv() {
        let divElements = document.getElementById('formToLoad');
        if (divElements) {
          divElements.innerHTML = '';
        }
      }
      getParameterByName(name) {
        let queryString = window.location.search;
        name = name.replace(/[\[\]]/g, "\\$&");
        let regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
          results = regex.exec(queryString);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
      }
    }

    class popupVerification {
      constructor() {}
      init() {}
      async getPopupInfo() {
        let urlPost = 'index.php?action=deleteBookVerification';
        try {
          const response = await fetch(urlPost);
          const html = await response.text();
          const parser = new DOMParser();
          const doc = parser.parseFromString(html, 'text/html');
          const div = doc.querySelector('.deleteBook');
          if (div) {
            return div.outerHTML;
          } else {
            throw new Error('La popup est introuvable');
          }
        } catch (err) {
          console.warn('Something went wrong.', err);
          throw err; // Rethrow the error to propagate it further
        }
      }
      async postDeleteBook(urlPost) {
        try {
          const response = await fetch(urlPost, {
            method: 'DELETE'
          });
          if (response.ok) {
            console.error('ok');
          } else {
            console.error('Get cart request error', response.statusText);
          }
        } catch (error) {
          console.error('Get cart request error', error);
        }
      }
      getIdBook(name, url) {
        name = name.replace(/[\[\]]/g, "\\$&");
        let regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
          results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
      }
      clearPopupDiv() {
        let divElements = document.getElementById('popup');
        if (divElements) {
          divElements.innerHTML = '';
        }
      }
      displayPopup(element, isOpen) {
        console.log(element);
        console.log(isOpen);
        if (isOpen) {
          console.log('toto');
          element.style.display = 'block';
        } else {
          element.style.display = 'none';
        }
      }
    }

    class messages {
      constructor() {}
      async getConversationInfo(url) {
        try {
          const response = await fetch(url);
          const html = await response.text();
          const parser = new DOMParser();
          const doc = parser.parseFromString(html, 'text/html');
          const div = doc.getElementById('newConversation');
          if (div) {
            return div.outerHTML;
          } else {
            throw new Error('Le formulaire est introuvable dans le contenu HTML.');
          }
        } catch (err) {
          console.warn('Something went wrong.', err);
          throw err; // Rethrow the error to propagate it further
        }
      }
      clearDiv() {
        let divElements = document.getElementById('conversation');
        if (divElements) {
          divElements.innerHTML = '';
        }
      }
    }

    window.addEventListener("load", event => {
      //gestion photo update
      const photoUpdate = new updatePhoto();
      let link = document.getElementById('getFormToLoad');
      let divForm = document.getElementById('formToLoad');
      let img = document.getElementById('profilePicture');
      if (link !== null) {
        link.addEventListener('click', async function (e) {
          e.preventDefault();
          let html = await photoUpdate.getFormInfo();
          divForm.innerHTML = html;
          let btnSubmit = document.getElementById('btnSubmitAdmin');
          btnSubmit.addEventListener('click', async function (e) {
            e.preventDefault();
            let src = await photoUpdate.postFormPhoto();
            img.src = src;
            photoUpdate.clearDiv();
          });
        });
      }

      //gestion popup confirmDelete
      const verificationPopup = new popupVerification();
      let deleteBooks = document.querySelectorAll('#deleteBook');
      let popupDiv = document.getElementById('popup');
      deleteBooks.forEach(function (deleteBook) {
        deleteBook.addEventListener('click', async function (e) {
          e.preventDefault();
          let htmlPopup = await verificationPopup.getPopupInfo();
          popupDiv.innerHTML = htmlPopup;
          let confirmLink = document.querySelector('.confirm');
          confirmLink.href = 'index.php?action=deleteBook&id=' + verificationPopup.getIdBook('id', deleteBook.href);
          let closeLink = document.querySelector('.close');
          verificationPopup.displayPopup(popupDiv, true);
          confirmLink.addEventListener('click', async function (e) {
            e.preventDefault();
            verificationPopup.postDeleteBook(confirmLink.href);
            verificationPopup.displayPopup(popupDiv, false);
            location.reload();
          });
          closeLink.addEventListener('click', function (e) {
            e.preventDefault();
            verificationPopup.displayPopup(popupDiv, false);
          });
        });
      });

      //gestion de la messagerie
      const conversation = new messages();
      let displayConversation = document.querySelectorAll('#displayConversation');
      let div = document.getElementById('conversation');
      displayConversation.forEach(function (displayConversation) {
        displayConversation.addEventListener('click', async function (e) {
          e.preventDefault();
          let url = displayConversation.getAttribute('href');
          let htmlConversation = await conversation.getConversationInfo(url);
          conversation.clearDiv();
          div.innerHTML = htmlConversation;
        });
      });
    });

})));
