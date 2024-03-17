function fetchXURL(url, methodType){
    fetch(url, {method: methodType}).then(response => response.json).then(data => data);
}

function admin_view(data){
    let view = document.getElementById('admin_view').innerHTML = '';
    // while(view.firstChild){
    //     view.removeChild(view.firstChild);
    // }

    // for(order in data){
    //     let child = document.createElement('div');

    //     let cliente = document.createElement('p');
    //     cliente.textContent = 'Nome: '+ order.nome_cliente +' Cognome'+ order.cognome_cliente;

    //     let ordine = document.createElement('p');
    //     ordine.id = order.id_ordine;
    //     ordine.textContent = order.numero_ordine;

    //     let data = document.createElement('p');
    //     data.textContent = 'Data: ' + order.data_ordine;

    //     let stato = document.createElement('p');
    //     stato.textContent
    // }

    for(let ordine in data){
        let child = document.createElement('div');
        child.innerHTML = `<p>Nome: ${ordine[2]} Cognome: ${ordine[3]}</p>
        <p> ${ordine[4]}</p>
        <p>Data: ${ordine[5]}</p>
        <p>Stato: ${ordine[6]}</p>
        <p>Quantità: ${ordine[7]}</p>
        <p>Prezzo totale: ${ordine[8]}</p>
        <input type="hidden" name="id_ordine" value="${ordine[0]}">`;
        view.appendChild(child);
    }
}

function user_view(data){
    let view = document.getElementById('user_view').innerHTML = ''; 

    for(let ordine in data){
        let child = document.createElement('div');
        child.innerHTML = `<p>Nome: ${ordine[2]} Cognome: ${ordine[3]}</p>
        <p>Quantità: ${ordine[7]}</p>
        <p>Prezzo totale: ${ordine[8]}</p>
        <input type="hidden" name="id_ordine" value="${ordine[0]}">`;
        view.appendChild(child);
    }
}

function fetch_admin(url, methodType){
    let data = fetchXURL(url, methodType);
    admin_view(data);
}

function fetch_user(url, methodType){
    let data = fetchXURL(url, methodType);
    user_view(data);
}