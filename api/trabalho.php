<!DOCTYPE html>
<html lang="br">
  <head>
    <meta charset="utf-8">    
    <title>CRUD via API</title>  
  </head>
  <body>	
    <form>  
      <input type="button" id="buscaRepositorios" value="Listar todos Repositorios (GET)">
    </form>
    <br><br><br>
    <form>   
    	<input type="text" placeholder="Nome do repositório" autofocus="" id="nome">
      <input type='button' value="Cadastrar repositorio (POST)" id="btnCadastra">    	
    </form>
    <div id="retornoCadastro"></div>
    <br><br><br>
    <form>   
      <input type="text" placeholder="ID do repositório" autofocus="" id="id">
      <input type='button' value="Delete repositorio (DELETE)" id="btnDelete">      
    </form>
    <div id="retornoDelete"></div>
    <br><br><br>
    <form>   
      <input type="text" placeholder="ID do repositório" autofocus="" id="id_alterar">
      <input type="text" placeholder="Novo nome repositório" autofocus="" id="nome_alterar">
      <input type='button' value="Alterar repositorio (PUT)" id="btnAltera">      
    </form>
    <div id="retornoAltera"></div>
    <br><br><br>
    <div id="listaTodos"></div>  
    <script src="../js/jquery-3.2.1.min.js"></script> 
    <script src="../js/jquey.js"></script> 
  </body>
</html>