
//MÉTODO GET
$('#buscaRepositorios').click(function(){   
 $.ajax({
      type: 'GET',           
      dataType: 'json',
      url: '/tiago/api/lista',
      async: true,    
      success: function(retorno) {  
        //DEBUG
        //console.log('sucesso'); 
        //console.log(retorno); 
        $("#listaTodos").empty();
        $.each(retorno[0], function(index, value) {
          //console.log(index + ' : ' + value.nome);          
          $('#listaTodos').append('<li> ID: '+value.id + ' NOME: ' + value.nome+'</li>');
        });         
      },
      error: function(erro, er){   
        console.log('error');    
        console.log(erro); 
        console.log(er);                  
      }            
    });
    return false;      
});  

//MÉTODO POST

$('#btnCadastra').click(function(){    
  var nome = $("#nome").val();
  console.log(nome);
  $.ajax({
      type: 'POST',           
      dataType: 'json',
      url: '../api/cadastra/'+nome,      
      async: true,    
      success: function(retorno) {  
        //DEBUG
        //console.log('sucesso'); 
        //console.log(retorno);    
        if (retorno != '') {
          $('#retornoCadastro').html('Repositório cadastrado com sucesso! ID:'+retorno);
          $("#nome").val('');
          $("#buscaRepositorios").trigger("click");
        }      
      },
      error: function(erro, er){   
        console.log('error');    
        console.log(erro); 
        console.log(er);                  
      }            
    });
    return false;      
});     


//MÉTODO DELETE    

$('#btnDelete').click(function(){    
  var id = $("#id").val();
  console.log(id);
  $.ajax({
      type: 'DELETE',           
      dataType: 'json',
      url: '../api/delete/'+id,      
      async: true,    
      success: function(retorno) {  
       console.log('sucesso'); 
       console.log(retorno);    
       if (retorno) {
         $('#retornoDelete').html('Repositório deletado com sucesso!');
         $("#id").val('');
         $("#buscaRepositorios").trigger("click");
       }      
      },
      error: function(erro, er){   
        console.log('error');    
        console.log(erro); 
        console.log(er);                  
      }            
    });
    return false;      
});  


//MÉTODO PUT
$('#btnAltera').click(function(){    
  var id_alterar = $("#id_alterar").val();
  var nome_alterar = $("#nome_alterar").val();
  nome_alterar
  console.log(id);
  $.ajax({
      type: 'PUT',           
      dataType: 'json',
      url: '../api/altera/'+id_alterar+'/'+nome_alterar,      
      async: true,    
      success: function(retorno) {  
       console.log('sucesso'); 
       console.log(retorno);    
       if (retorno) {
         $('#retornoAltera').html('Repositório alterado com sucesso!');
         $("#id_alterar").val('');
         $("#nome_alterar").val('');
         $("#buscaRepositorios").trigger("click");
       }      
      },
      error: function(erro, er){   
        console.log('error');    
        console.log(erro); 
        console.log(er);                  
      }            
    });
    return false;      
}); 