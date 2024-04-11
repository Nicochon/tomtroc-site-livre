class popupVerification{
    constructor() {
    }
    init(){
    }
    async getPopupInfo(){

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

    async postDeleteBook(urlPost){

        try {
            const response =  await fetch(urlPost, {
                method: 'DELETE',
            });
            if (response.ok) {
                console.error('ok')
            } else {
                console.error('Get cart request error', response.statusText);
            }
        } catch (error) {
            console.error('Get cart request error', error);
        }
    };

    getIdBook(name, url) {
        name = name.replace(/[\[\]]/g, "\\$&");
        let regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    };

    clearPopupDiv(){
        let divElements = document.getElementById('popup');
        if (divElements){
            divElements.innerHTML='';
        };
    };

    displayPopup(element, isOpen){
        console.log(element)
        console.log(isOpen)
        if (isOpen) {
            console.log('toto')
            element.style.display = 'block';
        } else {
            element.style.display = 'none';
        }
    };


}

export default popupVerification;