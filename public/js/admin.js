$( document ).ready( function(  ) {
 
    $( '#form-add-setting' ).on( 'submit', function() {
 
        //.....
        //show some spinner etc to indicate operation in progress
       // alert("GUARDANDO");
        //.....
 
     		$.post("/ajax/lista",
				{
				
					"_token": $( this ).find( 'input[name=_token]' ).val(),
                
                "categoria": $( '#categoria' ).val()
				},

				function(data)
				{
					//alert(data);

				},'json'

			).success (

				function ( data )
				{
					
					alert("categoria creada");
					
				}
			);
 
        //.....
        //do anything else you might want to do
        $('#categoria').val("");
        //.....
 
        //prevent the form from actually submitting in browser
        return false;
    } );
 
} );

/*
   $.post("/ajax/lista",
            
            {
                "_token": $( this ).find( 'input[name=_token]' ).val(),
                
                "categoria": $( '#categoria' ).val()
            },
            function( data ) {
                //do something with data/response returned by server
            },
            'json'
        );

*/