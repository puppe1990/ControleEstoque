$(document).ready(function(){

	$.ajax({url: "Produtos/maiorProduto", success: function(result){
		let resultado = result[0].codigo_produto;
		$("#textinputcadastro").val(resultado);
    }});


	jQuery.extend( jQuery.fn.dataTableExt.oSort, {
	    "formatted-num-pre": function ( a ) {
	        a = (a === "-" || a === "") ? 0 : a.replace( /[^\d\-\.]/g, "" );
	        return parseFloat( a );
	    },
	 
	    "formatted-num-asc": function ( a, b ) {
	        return a - b;
	    },
	 
	    "formatted-num-desc": function ( a, b ) {
	        return b - a;
	    }
	} );

	jQuery.extend( jQuery.fn.dataTableExt.oSort, {
	    "date-uk-pre": function ( a ) {
	        if (a == null || a == "") {
	            return 0;
	        }
	        var ukDatea = a.split('/');
	        return (ukDatea[2] + ukDatea[1] + ukDatea[0]) * 1;
	    },
	 
	    "date-uk-asc": function ( a, b ) {
	        return ((a < b) ? -1 : ((a > b) ? 1 : 0));
	    },
	 
	    "date-uk-desc": function ( a, b ) {
	        return ((a < b) ? 1 : ((a > b) ? -1 : 0));
	    }
	} );

	$('#listagemVendas').dataTable( {
		"language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
        },
        columnDefs: [
       		{ type: 'formatted-num', targets: 6 }
		 ],
		responsive: true,
     	"order": [[ 6, "desc" ]],
     	stateSave: true
    } );

	$('#listagemProdutos').dataTable( {
		"language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
        },
       	columnDefs: [
	       { type: 'formatted-num', targets: 0 }
	    ],
		"order": [[ 0, "desc" ]],
		responsive: true,
     	stateSave: true
    } );

    $('#listagem').dataTable( {
		"language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
        },
        columnDefs: [
       		{ type: 'date-uk', targets: 4 }
     	],
		"order": [[ 4, "desc" ]],
		responsive: true,
     	stateSave: true
    } );   

    $("#categoria").select2(); 
	$("#nomeClientes").select2(); 

});

function listaVenda() {
	let $ = document.querySelector.bind(document);
	let idProduto = $("#categoria").value;
	let valorProduto = $("#categoria");
	valorProduto = valorProduto.options[valorProduto.selectedIndex].label;
	let nomeProduto = $("#select2-categoria-container").innerHTML;

	construirDiv(nomeProduto,idProduto,valorProduto);
}

var idCont = $("#cont");

if(idCont.val() != undefined){
	var cont = idCont.val();
}else{
	var cont = 0;	
}


function construirDiv(produto,id,valor){

	let $ = document.querySelector.bind(document);
	
	//Div para o grid
	let colDiv = document.createElement("div");
	colDiv.setAttribute("class", "col-md-3");

	//entorno div
	let linhaDiv = document.createElement("div");
	linhaDiv.setAttribute("id","row"+cont); 

	//criação do input produto
	let input = $("#lista");
	let elementoProduto = document.createElement("input");
	elementoProduto.value =  produto;
	elementoProduto.setAttribute("type", "text");
	elementoProduto.setAttribute("class", "form-control input-md");
	elementoProduto.disabled = true;

	let elementoProduto2 = document.createElement("label");
	let conteudo = document.createTextNode("Produto");
	elementoProduto2.appendChild(conteudo);

	colDiv.appendChild(elementoProduto2);
	colDiv.appendChild(elementoProduto);
	input.appendChild(linhaDiv);
	linhaDiv.appendChild(colDiv);	

	//hidden produto
	let hiddenProduto = document.createElement("input");
	hiddenProduto.value = id; 
	hiddenProduto.setAttribute("id", "fk_produto");
	hiddenProduto.setAttribute("name", "saida[fk_produto][]");
	hiddenProduto.setAttribute("type", "hidden");
	linhaDiv.appendChild(hiddenProduto);

	//criação input quantidade
	let colDiv2 = document.createElement("div");
	colDiv2.setAttribute("class", "col-md-3");
	let elementoQuantidade = document.createElement("input");
	// elementoQuantidade.value =  1;
	elementoQuantidade.setAttribute("type", "text");
	elementoQuantidade.setAttribute("class", "form-control input-md");
	elementoQuantidade.setAttribute("name", "saida[quantidade][]");
	elementoQuantidade.setAttribute("id", cont);
	elementoQuantidade.setAttribute("pattern", "[0-9]+$");
	elementoQuantidade.setAttribute("onkeyup", "atualizaSubTotal(this.value,this.id)");
	elementoQuantidade.setAttribute("onfocus", "this.value=''");

	let elementoQuantidade2 = document.createElement("label");
	let conteudo2 = document.createTextNode("Quantidade");
	elementoQuantidade2.appendChild(conteudo2);
	colDiv2.appendChild(elementoQuantidade2);

	colDiv2.appendChild(elementoQuantidade);
	linhaDiv.appendChild(colDiv2);	


	//criação input valor
	let colDiv3 = document.createElement("div");
	colDiv3.setAttribute("class", "col-md-2");
	let elementoValor = document.createElement("input");
	elementoValor.value =  valor;
	elementoValor.setAttribute("type", "text");
	elementoValor.setAttribute("class", "form-control input-md");
	elementoValor.setAttribute("id", "valor"+cont);
	elementoValor.disabled = true;

	let elementoValor2 = document.createElement("label");
	let conteudo3 = document.createTextNode("Valor");
	elementoValor2.appendChild(conteudo3);
	colDiv3.appendChild(elementoValor2);

	colDiv3.appendChild(elementoValor);
	linhaDiv.appendChild(colDiv3);	

	//criação input subtotal
	let colDiv4 = document.createElement("div");
	colDiv4.setAttribute("class", "col-md-2");
	let elementoSubTotal = document.createElement("input");
	elementoSubTotal.setAttribute("type", "text");
	elementoSubTotal.setAttribute("class", "form-control input-md subtotal");
	elementoQuantidade.setAttribute("onchange", "atualizaTotal('geral')");
	elementoSubTotal.setAttribute("id", "subtotal"+cont);
	elementoSubTotal.disabled = true;

	let elementoSubTotal2 = document.createElement("label");
	let conteudo4 = document.createTextNode("Sub Total");
	elementoSubTotal2.appendChild(conteudo4);
	colDiv4.appendChild(elementoSubTotal2);

	colDiv4.appendChild(elementoSubTotal);
	linhaDiv.appendChild(colDiv4);

	//botão deletar
	let colDiv5 = document.createElement("div");
	colDiv5.setAttribute("class", "col-md-1");
	let elementoDelete = document.createElement("button");
	elementoDelete.setAttribute("type", "button");
	elementoDelete.setAttribute("class", "btn btn-danger btn-sm");
	elementoDelete.setAttribute("id", cont);
	elementoDelete.setAttribute("onclick", "deletaProduto(this.id)");
	elementoDelete.innerHTML = "Deletar Produto";

	let elementoSubTotal3 = document.createElement("label");
	let conteudo5 = document.createTextNode("Deletar");
	elementoSubTotal3.appendChild(conteudo5);
	colDiv5.appendChild(elementoSubTotal3);

	colDiv5.appendChild(elementoDelete);
	linhaDiv.appendChild(colDiv5);

	cont++;

}

function atualizaSubTotal(id,cont) {
	let $ = document.querySelector.bind(document);
	let subtotal = $("#subtotal"+cont);
	let quantidade = id;
	let valor = $("#valor"+cont).value;
	let total = valor * quantidade;
	subtotal.value = total.toFixed(2);
}


function atualizaTotal(param = 0) {
	let $ = document.querySelector.bind(document);
	let tamanho = document.querySelectorAll(".subtotal").length;
	let total = $("#total");
	
	if(param == "geral"){
		$("#desconto").value = 0;
		$("#descontoPorcent").value = 0;	
	}
		
	total.value = 0;

	for(let i = 0; i < tamanho;i++){
		let subtotal = document.querySelectorAll(".subtotal")[i].value;

		total.value = Number(total.value) + Number(subtotal);
	}

}

function calcularDesconto() {
	let $ = document.querySelector.bind(document);
	let valorDesconto = $("#desconto").value;
	atualizaTotal();
	let totalValor = $("#total").value == ""? 0 : $("#total").value;
	console.log(totalValor);
	console.log(valorDesconto);

	if(totalValor > 0 && Number(totalValor) > Number(valorDesconto)){
		let total = $("#total");
		total.value = totalValor - valorDesconto; 
		let desconto = $("#descontoPorcent");
		let valorPorcent = (valorDesconto * 100) / totalValor ;
		desconto.value = valorPorcent;
	}else{
		alert("Desconto em dinheiro não pôde ser aplicado");
		$("#desconto").value = "";
	}

}

function calcularDescontoPorcent() {
	let $ = document.querySelector.bind(document);
	let valorDesconto = $("#descontoPorcent").value;
	atualizaTotal();
	let totalValor = $("#total").value == ""? 0 : $("#total").value;

	if(totalValor > 0 && valorDesconto < 100){
		let total = $("#total");
		let valorDinheiro = (totalValor * (valorDesconto / 100));
		let desconto = $("#desconto");
		desconto.value = valorDinheiro.toFixed(2);
		total.value = totalValor - (totalValor * (valorDesconto / 100)); 
	}else{
		alert("Desconto em porcentagem não pôde ser aplicado");
		$("#descontoPorcent").value = "";
	}

}

function valorTotal(){
	let $ = document.querySelector.bind(document);
	let valorVenda = $("#valorVenda");
	let total = $("#total");
	valorVenda.value = total.value;	        
}

function deletaProduto(valor){
	let $ = document.querySelector.bind(document);
	let elemento = $("#row"+valor);
	elemento.remove();
	$("#desconto").value = 0;
	$("#descontoPorcent").value = 0;	
	atualizaTotal();
}

function inserirHoraAtual(){
	return document.getElementById("datetime").value = moment().format("YYYY-MM-DDTHH:mm");  
}

function inserirDataAtualRelatorio(){
	return document.getElementById("datetime").value = moment().format("YYYY-MM-DD");  
}

function inserirUltimosSeteDias(){
	return document.getElementById("datetime").value = moment().subtract("7", "days").format("YYYY-MM-DD");  
}

function inserirUltimosQuinzeDias(){
	return document.getElementById("datetime").value = moment().subtract("15", "days").format("YYYY-MM-DD");  
}

function inserirPrimeiroDiaMes(){
	return document.getElementById("datetimeinital").value = moment().format("YYYY-MM-01");  
}

atualizaTotal();
