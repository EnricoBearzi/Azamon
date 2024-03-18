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
        <p>Prezzo totale: ${ordine[8]}</p>`;
        child.addEventListener("click", (e)=>{
            window.location="dettagliOrdine.php?id_ordine="+encodeURIComponent(ordine[0]);
        })
        view.appendChild(child); 
    });

}

function user_view(data){
    let view = document.getElementById('user_view'); 
    view.innerHTML = '';
    console.log(data)
    data.forEach(ordine => {
        let child = document.createElement('div');
        child.innerHTML = `<p>Nome: ${ordine.nome_cliente} Cognome: ${ordine.cognome_cliente}</p>
        <p>Quantità: ${ordine.quantita_totale}</p>
        <p>Prodotti: ${ordine.prodotti}</p>
        <p>Prezzo totale: ${ordine.totale_ordine}</p>`;
        
        child.addEventListener("click", (e)=>{
            window.location="dettagliOrdine.php?id_ordine="+encodeURIComponent(ordine.id_ordine);
        })
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
        child.innerHTML = `<img src="${ordine[11]}">
        <p>Nome prodotto: ${ordine[8]}</p>
        <p>Descrizione prodotto: ${ordine[9]}</p>
        <p>Prezzo totale: ${ordine[10]}</p>
        <p>Quantità: ${ordine[12]}</p>`;
        view.appendChild(child); 
    });
}

function dettagli_ordine_user_view(data) {
    let view = document.getElementById('user_view');
    view.innerHTML = '';
    console.log(data)
    let child = document.createElement('div');
    child.innerHTML = `<p>ID ordine: ${data[0][0]}</p>
    <p>Nome cliente: ${data[0][2]}</p>
    <p>Cognome cliente: ${data[0][3]}</p>
    <p>Data e ora: ${data[0][5]}</p>
    <p>Stato: ${data[0][6]}</p>`;
    view.appendChild(child); 
        
    data.forEach(ordine => {
        let child = document.createElement('div');
        child.innerHTML = `<img src="${ordine[11]}">
        <p>Nome prodotto: ${ordine[8]}</p>
        <p>Descrizione prodotto: ${ordine[9]}</p>
        <p>Prezzo totale: ${ordine[10]}</p>
        <p>Quantità: ${ordine[12]}</p>`;
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

async function search_fetch_admin(){
    var action = document.getElementById('opzioniDiRicerca').value;
    var keyword = document.getElementById('barraDiRicerca').value;
    let data = await fetchXURL(`API/ordini/search.php?action=${action}&keyword=${keyword}`,'GET');
    admin_view(data);
}

async function search_fetch_user(){
    var action = document.getElementById('opzioniDiRicerca').value;
    var keyword = document.getElementById('barraDiRicerca').value;
    let data = await fetchXURL(`API/ordini/search.php?action=${action}&keyword=${keyword}`,'GET');
    user_view(data);
}

async function fetch_dettagli_ordine_admin(url, methodType) {
    let data = await fetchXURL(url, methodType);
    dettagli_ordine_admin_view(data);
}

async function fetch_dettagli_ordine_user(url, methodType) {
    let data = await fetchXURL(url, methodType);
    dettagli_ordine_user_view(data);
}