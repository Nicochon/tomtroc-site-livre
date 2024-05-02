class messages{
    constructor() {
    }
    async getConversationInfo(url){
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

    clearDiv(){
        let divElements = document.getElementById('conversation');
        if (divElements){
            divElements.innerHTML='';
        }
    }

}

export default messages;