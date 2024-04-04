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
        try {
          const response = await fetch('index.php?action=updatePhotoForm');
          const html = await response.text();
          const parser = new DOMParser();
          const doc = parser.parseFromString(html, 'text/html');
          const form = doc.querySelector('form');
          if (form) {
            return form.outerHTML; // Convertit le formulaire en HTML
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
        try {
          const response = await fetch('index.php?action=uploadProfilPicture', {
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
    }

    window.addEventListener("load", event => {
      const photoUpdate = new updatePhoto();
      let link = document.getElementById('getFormToLoad');
      let divForm = document.getElementById('formToLoad');
      let img = document.getElementById('profilePicture');
      link.addEventListener('click', async function (e) {
        e.preventDefault();
        let html = await photoUpdate.getFormInfo();
        divForm.innerHTML = html;
        let btnSubmit = document.getElementById('btnSubmitAdmin');
        btnSubmit.addEventListener('click', async function (e) {
          e.preventDefault();
          let html = await photoUpdate.postFormPhoto();
          img.src = html;
          photoUpdate.clearDiv();
        });
      });
    });

})));
