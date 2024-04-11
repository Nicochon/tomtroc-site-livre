class updatePhoto{
    constructor() {
    }
    init(){
        this.displayFileUpload();
    }

    displayFileUpload(){
        document.querySelector('.custom-file-upload').addEventListener('click', function() {
        });
    }

    async getFormInfo(){
        let id = this.getParameterByName('id');
        let urlPost = '';
        if(id !== null){
            urlPost = 'index.php?action=updatePhotoForm&key=book&id='+id;
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

    async postFormPhoto(){
        let inputForm = document.getElementById('fileUpload');
        let valueInput = inputForm.files[0];

        let data = new FormData();
        data.append('photo', valueInput);
        let id = this.getParameterByName('id');
        let urlPost = '';

        if(id !== null){
            urlPost = 'index.php?action=uploadBookPicture&id='+id;
        } else {
            urlPost = 'index.php?action=uploadProfilPicture';
        }

        try {
            const response =  await fetch(urlPost, {
                method: 'POST',
                body: data,
            });
            if (response.ok) {
                const html = await response.text();
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                let img = doc.getElementById('profilePicture')
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
    };

    clearDiv(){
        let divElements = document.getElementById('formToLoad');
        if (divElements){
            divElements.innerHTML='';
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

export default updatePhoto;
