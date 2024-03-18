function next() {
    let list = document.querySelectorAll(".nextPage div")
    list.forEach((element) => {
        element.addEventListener("click", (e)=>{
            let input = element.querySelector("input")
            window.location="dettagliOrdine.php?id_ordine="+encodeURIComponent(input.value);
        })
    });
}