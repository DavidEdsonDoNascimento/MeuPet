<?php
include_once('cabecalho.php'); 
    
if(empty($_SESSION['usuario']))
    header('location:login.php');
?>

<h1>Monitoramento</h1>
<script>
    
/* caixa-confirmacao representa a id onde o caixa de confirmação deve ser criada no html */
function Abrir_Janela(servico_id, status, pet_id, pessoa_id, dono_id){
    
$( "#caixa-confirmacao" ).dialog({
      resizable: false,
      height:280,

      /* 
       * Modal desativa os demais itens da tela, impossibilitando interação com eles,
       * forçando usuário a responder à pergunta da caixa de confirmação
       */ 
      modal: true,

      /* Os botões que você quer criar */
      buttons: {
        "Sim": function() {
          $( this ).dialog( "close" );
           $.ajax({
                url: "src/server-incluir-relatorio.php",
                type: "post",
                dataType: "json",
                data: {
                    pet_id: pet_id,
                    servico_id: servico_id,
                    status: status,
                    pessoa_id: pessoa_id,
                    dono_id: dono_id                
                },
                success: function(result){
                    alert("Status alterado com sucesso");
                    location.reload();
                },
                error: function(er){
                    console.log("Erro:");
                    console.log(er);
                }
            });
        },
        "Não": function() {
          $( this ).dialog( "close" );
          alert("Você clicou em Não");
        }
      }
    });
}
function Incluir_Atendimento(servico_id, status, pet_id, pessoa_id, dono_id, pet, nivel){
    if(nivel == 2){
        return false;
    }
    else{

        var d = document.createElement("div");
        d.setAttribute('id', 'caixa-confirmacao');
        //d.setAttribute('title', 'Quer testar isso?');
        var p = document.createElement("p");
        var texto = "Você deseja alterar o status de " + pet + " para " + ((status == 1) ? "Aguardando" : (status == 2)? "Em atendimento": (status == 3) ? "Pronto" : "Atendimento finalizado") + " ? ";
        p.appendChild(document.createTextNode(texto));
        d.appendChild(p);


        $("#janelas")[0].appendChild(d);

        Abrir_Janela(servico_id, status, pet_id, pessoa_id, dono_id);
        return true;
    }
}
</script>
<?php 
require_once('./src/DAO/banco.php');


$sql = '
select
r.pet_id,
(select p.nome from pet as p where p.id = r.pet_id) pet,
(select p.raca from pet as p where p.id = r.pet_id) raca,
(select p.especie from pet as p where p.id = r.pet_id) especie,
r.dono_id,
(select ps.nome from pessoa as ps where ps.id = r.dono_id) dono,
r.servico_id,
(select s.nome from servico as s where s.id = r.servico_id) servico,
r.status,
r.data as horario
from relatorio as r 
inner join
(
	select 
        r.pet_id as pet_id,
        r.servico_id as servico_id,
		max(data) as ultimaData
	from relatorio as r
	group by r.pet_id, r.servico_id
	order by data desc, status
) as ideultimadata
on ideultimadata.pet_id = r.pet_id and ideultimadata.ultimaData = r.data and ideultimadata.servico_id = r.servico_id
';

//encontrar um jeito disso ser dinamico 
//(talvez criar uma tabela integrando cargo e servico ou 
//jogar a chave de servico para a tabela cargo)
if($_SESSION['nivel'] == 2){
    $sql = $sql." where r.dono_id = ".$_SESSION['id'];
}

if($_SESSION['nivel'] == 3){ //3 = Banho
    $sql = $sql." where r.servico_id = 1";
}

if($_SESSION['nivel'] == 4){ //4 = Tosa
    $sql = $sql." where r.servico_id = 2";
}

if($_SESSION['nivel'] == 5){ //5 = Veterinario
    $sql = $sql." where r.servico_id = 3";
}

$sql = $sql." order by data desc, pet";

$pdo = Banco::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);    

$q->execute();

if($q->rowCount() > 0){
        echo '
        <div id="janelas"></div>
        <table class="table table-hover table-bordered table-light">
        <thead>
            <tr>
            <th scope="col">Pet</th>
            <th scope="col">Raça</th>
            <th scope="col">Espécie</th>
            <th scope="col">Dono</th>
            <th scope="col">Serviço</th>         
            <th scope="col">Data</th>      
            <th scope="col"></th>         
            <th scope="col"></th>         
            </tr>
        </thead>
        <tbody>';

        while($row = $q->fetch(PDO::FETCH_ASSOC)){ 

            echo '            
                <tr>
                    <td>'.$row['pet'].'</td>
                    <td>'.$row['raca'].'</td>
                    <td>'.$row['especie'].'</td>
                    <td>'.$row['dono'].'</td>
                    <td>'.$row['servico'].'</td>
                    <td>'.date("d/m/Y H:i:s", strtotime($row['horario'])).'</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            '.(($row['status'] == 1) ? 
                            "<button type='button' class='btn btn-success' id='aguardando' disabled>Aguardando</button>": 
                            "<button type='button' class='btn btn-secondary' id='aguardando' onclick='Incluir_Atendimento(".$row['servico_id'].", 1, ".$row['pet_id'].", ".$_SESSION['id'].", ". $row['dono_id'] .", \"".$row['pet']."\", ".$_SESSION['nivel'].")'>Aguardando</button>").'
                            
                            '.(($row['status'] == 2) ? 
                            "<button type='button' class='btn btn-success' id='ematendimento' disabled>Em atendimento</button>":
                            "<button type='button' class='btn btn-secondary' id='ematendimento' onclick='Incluir_Atendimento(".$row['servico_id'].", 2, ".$row['pet_id'].", ".$_SESSION['id'].",". $row['dono_id'] .", \"".$row['pet']."\", ".$_SESSION['nivel'].")'>Em atendimento</button>").'
                            
                            '.(($row['status'] == 3) ? 
                            "<button type='button' class='btn btn-success' id='pronto' disabled>Pronto</button>":
                            "<button type='button' class='btn btn-secondary' id='pronto' onclick='Incluir_Atendimento(".$row['servico_id'].", 3, ".$row['pet_id'].", ".$_SESSION['id'].", ". $row['dono_id'] .", \"".$row['pet']."\", ".$_SESSION['nivel'].")'>Pronto</button>").'
                        </div>
                        
                    </td>
                    <td>
                    '.(($row['status'] == 10)?
                    "<span class='alert-warning'>Atendimento Finalizado!</span>":
                    "<button type='button' class='btn btn-secundary' id='entregue' onclick='Incluir_Atendimento(".$row['servico_id'].", 10, ".$row['pet_id'].", ".$_SESSION['id'].", ". $row['dono_id'] .", \"".$row['pet']."\", ".$_SESSION['nivel'].")'>Finalizar Atendimento</button>").'
                    </td>
                </tr>
                ';
                
        }
        echo '
                </tbody>
            </table>
            ';


    }
    else{
        echo '<p>Nenhum registro encontrado</p>';
    }
    Banco::desconectar();
?>
<?php include_once('rodape.php'); ?>