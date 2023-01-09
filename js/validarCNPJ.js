function validarCNPJ() {
 
   // cnpjCons = cnpjCons.replace(/[^\d]+/g,'');
 
    if(cnpjCons == ''){
        alert("CNPJ INVÁLIDO!");
        event.preventDefault();
        return false;
        }

    if (cnpjCons.length != 14) {
        alert("CNPJ INVÁLIDO!");
        event.preventDefault();
        return false;

    }
 
    // Elimina CNPJs invalidos conhecidos
    if (cnpjCons == "00000000000000" || 
        cnpjCons == "11111111111111" || 
        cnpjCons == "22222222222222" || 
        cnpjCons == "33333333333333" || 
        cnpjCons == "44444444444444" || 
        cnpjCons == "55555555555555" || 
        cnpjCons == "66666666666666" || 
        cnpjCons == "77777777777777" || 
        cnpjCons == "88888888888888" || 
        cnpjCons == "99999999999999") {


        alert("CNPJ INVÁLIDO!");
        event.preventDefault();
        return false;

    }

}