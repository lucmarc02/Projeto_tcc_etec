//selecionar o input

const input = document.querySelector("#cnpjCons");


//adicionar evento - paste

input.addEventListener("paste", function() {

	const regex = new RegExp("^[0-9a-zA-Z\b]+$");
	const self = this;


//precisa ser colocado
	setTimeout(function(){
   const text = self.value;


   if (!regex.test(text)) {

   	self.value = "";
   }

	},500);

});