$(document).ready(function(){

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

	$('#listagemProdutos').dataTable( {
		"language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
        },
       	columnDefs: [
	       { type: 'formatted-num', targets: 0 }
	    ],
     	"order": [[ 0, "desc" ]],
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
     	stateSave: true
    } );

    $("#categoria").select2(); 


	//Tive que usar este trecho pois não consegui converter o html_entities que estava retornando
    $("td:nth-child(2)").each(function(){
	    var $this = $(this);
	    var t = $this.text();
	    $this.html(t.replace('&lt','<').replace('&gt', '>'));
	}); 

});

function listaVenda() {
	let $ = document.querySelector.bind(document);
	let idProduto = $("#categoria").value;
	let valorProduto = $("#categoria");
	valorProduto = valorProduto.options[valorProduto.selectedIndex].label;
	let nomeProduto = $("#select2-categoria-container").innerHTML;

	construirDiv(nomeProduto,idProduto,valorProduto);
}


var cont = 0;
function construirDiv(produto,id,valor){

	let $ = document.querySelector.bind(document);
	
	//Div para o grid
	let colDiv = document.createElement("div");
	colDiv.setAttribute("class", "col-md-3");

	//criação do input produto
	let input = $("#lista");
	let elementoProduto = document.createElement("input");
	elementoProduto.value =  produto;
	elementoProduto.setAttribute("type", "text");
	elementoProduto.setAttribute("name", "fk_produto");
	elementoProduto.setAttribute("value", id);
	elementoProduto.setAttribute("class", "form-control input-md");
	elementoProduto.disabled = true;

	let elementoProduto2 = document.createElement("label");
	let conteudo = document.createTextNode("Produto");
	elementoProduto2.appendChild(conteudo);

	colDiv.appendChild(elementoProduto2);
	colDiv.appendChild(elementoProduto);
	input.appendChild(colDiv);	

	//criação input quantidade
	let colDiv2 = document.createElement("div");
	colDiv2.setAttribute("class", "col-md-3");
	let elementoQuantidade = document.createElement("input");
	elementoQuantidade.value =  1;
	elementoQuantidade.setAttribute("type", "text");
	elementoQuantidade.setAttribute("class", "form-control input-md");
	elementoQuantidade.setAttribute("id", cont);
	elementoQuantidade.setAttribute("pattern", "[0-9]+$");
	elementoQuantidade.setAttribute("onkeyup", "atualizaSubTotal(this.value,this.id)");
	elementoQuantidade.setAttribute("onfocus", "this.value=''");

	let elementoQuantidade2 = document.createElement("label");
	let conteudo2 = document.createTextNode("Quantidade");
	elementoQuantidade2.appendChild(conteudo2);
	colDiv2.appendChild(elementoQuantidade2);

	colDiv2.appendChild(elementoQuantidade);
	input.appendChild(colDiv2);	


	//criação input valor
	let colDiv3 = document.createElement("div");
	colDiv3.setAttribute("class", "col-md-3");
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
	input.appendChild(colDiv3);	

	//criação input subtotal
	let colDiv4 = document.createElement("div");
	colDiv4.setAttribute("class", "col-md-3");
	let elementoSubTotal = document.createElement("input");
	elementoSubTotal.value =  $("#valor"+cont).value;
	elementoSubTotal.setAttribute("type", "text");
	elementoSubTotal.setAttribute("class", "form-control input-md");
	elementoSubTotal.setAttribute("id", "subtotal"+cont);
	elementoSubTotal.disabled = true;

	let elementoSubTotal2 = document.createElement("label");
	let conteudo4 = document.createTextNode("Valor");
	elementoSubTotal2.appendChild(conteudo4);
	colDiv4.appendChild(elementoSubTotal2);

	colDiv4.appendChild(elementoSubTotal);
	input.appendChild(colDiv4);
	cont++;

}

function atualizaSubTotal(id,cont) {
	let $ = document.querySelector.bind(document);
	let subtotal = $("#subtotal"+cont);
	let quantidade = id;
	// console.log(quantidade);
	// console.log(cont);
	let valor = $("#valor"+cont).value;
	// console.log($("#valor"+cont));

	let total = valor * quantidade;
	// console.log(total.toFixed(2));
	subtotal.value = total.toFixed(2);
}