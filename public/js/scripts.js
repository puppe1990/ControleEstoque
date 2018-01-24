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

	$('#listagemProdutos').dataTable( {
		"language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
        },
       	columnDefs: [
	       { type: 'formatted-num', targets: 0 }
	    ]
    } );

    $('#listagem').dataTable( {
		"language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
        }
    } );

    $("#categoria").select2(); 
    
});