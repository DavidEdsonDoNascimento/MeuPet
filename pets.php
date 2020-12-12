<?php include_once('cabecalho.php'); ?>
<h1>Pets</h1>

<?php
    require_once('./src/DAO/banco.php');
    $cliente_id = $_GET['cliente_id'];
    $tag_id = $_GET['tag_id'];

    if($tag_id == "atd"){
        echo "<p>Atendimentos > Pets</p>";
    }
    else{
        if($tag_id == "cli")
            echo "<p>Cadastros > Clientes > Pets</p>";
            
    }
    
    $pdo = Banco::conectar();
    $sql = "select * from pet where pessoa_id = :cliente_id";
    $q = $pdo->prepare($sql);    
    $q->bindValue(":cliente_id", $cliente_id);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $result = $q->execute();

    $q->execute();
 
    if($q->rowCount() > 0){
        echo '<table class="table table-hover table-bordered table-light">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col">Espécie</th>
            <th scope="col">Raça</th>
            <th></th>
            </tr>
        </thead>
        <tbody>';

        while($row = $q->fetch(PDO::FETCH_ASSOC)){ 

            echo '
                <tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['nome'].'</td>
                    <td>'.$row['especie'].'</td>
                    <td>'.$row['raca'].'</td>
                    <td>
                        <a href="editar-pet.php?pet_id='.$row["id"].'" class="btn btn-warning">
                            Editar
                        </a>
                        <a href="incluir-servico.php?pet_id='.$row["id"].'&tag_id='.$tag_id.'" class="btn btn-info">
                            + Serviços
                        </a>
                        <a href="relatorio.php?pet_id='.$row["id"].'" class="btn btn-default">
                            Relatório
                        </a>
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
    echo '<a class="btn btn-success" href="cadastrar-pet.php?cliente_id='.$cliente_id.'&tag_id='.$tag_id.'">Incluir</a>';
    
    Banco::desconectar();
?>

<?php include_once('rodape.php'); ?>