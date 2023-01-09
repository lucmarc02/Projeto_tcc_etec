//selecionar o input

const $campoCNPJ = document.querySelector('#cnpjCons')

 $campoCNPJ.addEventListener('focusin', (event) => {
   $valorDoCNPJ = event.target.value;
   $campoCNPJ.value = $valorDoCNPJ.replace(/[^0-9]+/g,'');
 })
  
 $campoCNPJ.addEventListener('focusout', () => {
   $valorDoCNPJ = event.target.value;
   $campoCNPJ.value = $valorDoCNPJ.replace(/[^0-9]+/g,'');
 })

/*
const input = document.querySelector("#cnpjCons");




//adicionar evento - paste

input.addEventListener("paste", function() {

	const regex = new RegExp("^[0-9\b]+$");
	const self = this;

 




//precisa ser colocado
	setTimeout(function(){
   const text = self.value;


   if (!regex.test(text)) {

   	cnpjCons = regex.replace(/[^0-9]+/g,'');

   	self.value = cnpjCons;
   //	self.value = cnpjCons;


   }

	},500);

});

*/