let boton = document.getElementById("aniadir");
console.log(boton)
boton.addEventListener("click", ()=>{
    let elemento = document.getElementById("formulario");
    let posicion = elemento.childElementCount;
    elemento.innerHTML+=`
    <div class="row mt-2">
        <input class="col-2" class="w-100" name="aniadir[${posicion}][nombre]" class="col-3" type="text" placeholder="Nombre">
        <input class="col-7" class="w-100" name="aniadir[${posicion}][descripcion]" class="col" type="text" placeholder="Descripcion">
        <input class="col" class="w-100" name="aniadir[${posicion}][precio]" class="col-1" type="text" placeholder="Precio">
        <input class="col" class="w-100" name="aniadir[${posicion}][stock]" class="col-1" type="text" placeholder="Stock">
    </div>
    `;
})