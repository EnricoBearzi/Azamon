async function fetchXURL(url,methodType) {
    /*try {*/
        const response = await fetch(url, {
            method: methodType,
            credentials: 'same-origin'
        });
/*
        if (!response.ok) {
            throw new Error('Errore nella chiamata API');
        }
*/
        const data = await response.json();
        return data
    /*} catch (error) {
        console.error('Errore:', error);
    }*/
}


function admin_view(data){
    let view = document.getElementById('admin_view');
    view.innerHTML = '';
    console.log(data)
    data.forEach(ordine => {
        let child = document.createElement('div');
        child.innerHTML = `<p>Nome: ${ordine[2]} Cognome: ${ordine[3]}</p>
        <p>Codice dell'ordine: ${ordine[4]}</p>
        <p>Data e ora: ${ordine[5]}</p>
        <p>Stato: ${ordine[6]}</p>
        <p>Quantità: ${ordine[7]}</p>
        <p>Prezzo totale: ${ordine[8]}</p>
        <input type="hidden" name="id_ordine" value="${ordine[0]}">`;
        view.appendChild(child); 
    });
}

function user_view(data){
    let view = document.getElementById('user_view'); 
    view.innerHTML = '';
    data.forEach(ordine => {
        let child = document.createElement('div');
        child.innerHTML = `<p>Nome: ${ordine[2]} Cognome: ${ordine[3]}</p>
        <p>Quantità: ${ordine[7]}</p>
        <p>Prezzo totale: ${ordine[8]}</p>
        <input type="hidden" name="id_ordine" value="${ordine[0]}">`;
        view.appendChild(child);
    });

}

function dettagli_ordine_admin_view(data) {
    let view = document.getElementById('admin_view');
    view.innerHTML = '';
    console.log(data)
    let child = document.createElement('div');
    child.innerHTML = `<p>ID ordine: ${data[0][0]}</p>
    <p>ID cliente: ${data[0][1]}</p>
    <p>Nome cliente: ${data[0][2]}</p>
    <p>Cognome cliente: ${data[0][3]}</p>
    <p>Email cliente: ${data[0][4]}</p>
    <p>Data e ora: ${data[0][5]}</p>
    <p>Stato: ${data[0][6]}</p>
    <p>Numero ordine: ${data[0][7]}</p>`;
    view.appendChild(child); 
        
    data.forEach(ordine => {
        let child = document.createElement('div');
        child.innerHTML = `<p>Nome prodotto: ${ordine[8]}</p>
        <p>Descrizione prodotto: ${ordine[9]}</p>
        <p>Prezzo totale: ${ordine[10]}</p>
        <p>Quantità: ${ordine[11]}</p>`;
        view.appendChild(child); 
    });
}

async function fetch_admin(url, methodType){
    let data = await fetchXURL(url,methodType);
    admin_view(data);
}

async function fetch_user(url, methodType){
    let data = await fetchXURL(url, methodType);
    user_view(data);
}

async function fetch_dettagli_ordine_admin(url, methodType) {
    let data = await fetchXURL(url, methodType);
    dettagli_ordine_admin_view(data);
}