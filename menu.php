<?php 
    if(empty($_SESSION['usuario'])):                
        include_once('componentes/btn-login.php');
    else:                 
?>
<style>
li{
  margin: 15px;
  color: black;
}
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-header">
      <a class="navbar-brand" href="monitoramento.php">Meu Pet</a>
    </div>
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link" href="monitoramento.php" aria-haspopup="true" aria-expanded="false">
          Monitoramento
        </a>
      </li>
      <?php if($_SESSION['nivel'] == 1): ?>
      <li class="nav-item dropdown">
        <a class="nav-link" href="atendimento.php" aria-haspopup="true" aria-expanded="false">
          Atendimento
        </a>
      </li>
      <?php endif;?>
    </ul>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">      
      <?php if($_SESSION['nivel'] == 1): ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Cadastros
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <li class="dropdown-submenu">
            <a class="dropdown-item" href="administradores.php">Administradores</a>
          </li>
          <?php if($_SESSION['empresa_id'] != 1): ?>
          <li class="dropdown-submenu">
            <a class="dropdown-item" href="colaboradores.php">Colaboradores</a>
          </li>
          <li class="dropdown-submenu">
            <a class="dropdown-item" href="clientes.php">Clientes</a>
          </li>
          <li class="dropdown-submenu">
            <a class="dropdown-item" href="servicos.php">Serviços</a>
          </li>
          <?php endif; ?>
        </ul>
      </li>
      <?php endif; ?>
      <ul class="navbar-nav">
      <?php if($_SESSION['empresa_id'] != 1): ?>
        
    </ul>
    <ul class="navbar-nav">
      <?php endif; ?>
      <?php if($_SESSION['nivel'] == 1000):?>
      <li>
        <a href="empresas.php" class="nav-link">
          Empresas
        </a>
      </li>
      <?php endif; ?>
      <li>
        <a href="meus-dados.php" class="nav-link"><span class="glyphicon glyphicon-user">
          <img src="./src/imgs/meus-dados-1.png" width="20" height="22"/>
          Meus Dados
        </a>
      </li>
      
      <li><a href="login.php" class="nav-link"><span class="glyphicon glyphicon-log-in"></span> Sair</a></li>
    </ul>
  </div>
    
</nav>
<?php endif; ?>