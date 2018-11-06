s<?php
require_once "../controller/Uteis.php";
class CautelaDao {
    function adiciona(conexao $conn, Cautela $cautela) {
          
        $query = "INSERT INTO cautela(
            id,
            permanente,
            aberta,
            dataRetirada,
            vencimento,
            dataEntrega,
            idPolicial,
            idDespachante,
            idRecebedor
        )VALUES(
            NULL,
            {$cautela->getPermanente()},
            {$cautela->getAberta()},
            NOW(),
            NOW(),
            NOW(),
            {$cautela->getIdPolicial()},
            {$cautela->getIdDespachante()},
            {$cautela->getIdRecebedor()})";
        
        if (mysqli_query($conn->conecta(), $query)) {
            echo "Novo cadastro realizado com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }

    function listaSelect(conexao $conn) {
        $query = "SELECT id FROM cautela";
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<option value='. $row["id"].'>'. $row["id"].'</option>';

            }
        } else {
            echo "0 results";
        }
    }

    //ok
    function recuperaId(conexao $conn) {
        $query = "SELECT * FROM cautela";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                return $id;  
            }
        } else {
            echo "0 results";
        }      
    }
    //Funçao que irá recuperar o Id do operador a partir do nome funcional do mesmo, para logo após esse id ser cadastrado na cautela.
    function recuperaIdOperador(conexao $conn, $nome_funcional) {
        $query = "SELECT * FROM operador WHERE nome_funcional = ".$nome_funcional;
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                return $id;  
            }
        } else {
            echo "0 results";
        }      
    }
    //ok
    function recuperaPolicial(conexao $conn) {
        $query = "SELECT * FROM cautela";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $policial = $row['policial'];
                return $policial;  
            }
        } else {
            echo "0 results";
        }      
    }
    //ok
    function recuperaArmamento(conexao $conn) {
        $query = "SELECT * FROM cautela";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $armamento = $row['armamento'];
                return $armamento;  
            }
        } else {
            echo "0 results";
        }      
    }
    //ok
    function recuperaQuantidade(conexao $conn) {
        $query = "SELECT * FROM cautela";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $quantidade = $row['quantidade'];
                return $quantidade;  
            }
        } else {
            echo "0 results";
        }      
    }
    //ok
    function recuperaTipo_cautela(conexao $conn) {
        $query = "SELECT * FROM cautela";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $tipo_cautela = $row['tipo_cautela'];
                return $tipo_cautela;  
            }
        } else {
            echo "0 results";
        }      
    }
    //ok
    function recuperaVencimento(conexao $conn) {
        $query = "SELECT * FROM cautela";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $vencimento = $row['vencimento'];
                return $vencimento;  
            }
        } else {
            echo "0 results";
        }      
    }
    //ok
    function exclui(conexao $conn, Cautela $cautela) {
        $query = "DELETE FROM cautela WHERE id = '{$cautela->getId()}'";

        if (mysqli_query($conn->conecta(), $query)) {
            echo "Registro excluído com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }
    //funçao que exclui o item de uma cautela
    function excluiItemCautela(conexao $conn, $id) {
        $query = "DELETE FROM item_cautela WHERE idCautela = $id";

        if (mysqli_query($conn->conecta(), $query)) {
            echo "Registro excluído com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }
    //done
    function edita(conexao $conn, Cautela $cautela) {
        $query = "";
        
        if (mysqli_query($conn->conecta(), $query)) {
            echo "Registro editado com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }
    
    //done
    function lista(conexao $conn) {
        
      $query = "SELECT c.id AS id, 
      c.permanente AS permanente, 
      c.aberta AS aberta, 
      c.dataRetirada AS dataRetirada, 
      c.vencimento AS vencimento, 
      c.dataEntrega AS dataEntrega, 
      p1.nome_funcional AS policial,
      p2.nome_funcional AS despachante,
      p3.nome_funcional AS recebedor
      
      FROM cautela c, policial p1, policial p2, policial p3
      
      WHERE c.idPolicial = p1.id and c.idDespachante = p2.id and c.idRecebedor = p3.id"; 
        
       /* $query = "SELECT FROM cautela c, policial p1, 
                  WHERE c.idPolicial = p1.id and c.idDespachante = p2.id and c.idDespachante = p3.id";*/
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            //while($row = mysqli_fetch_assoc($result)) {  
            while($row = mysqli_fetch_assoc($result)) { 
                echo '<tr>';
                //$uteis = new Uteis();
               // $stringModal = $uteis->sanitizeString($row["nome_funcional"]);        
                    echo '<td>' . $row["permanente"] . '</td>';
                    echo '<td>' . $row["aberta"] . '</td>';
                    echo '<td>' . $row["dataRetirada"] . '</td>';
                    echo '<td>' . $row["vencimento"] . '</td>';
                    echo '<td>' . $row["dataEntrega"] . '</td>';
                    echo '<td>' . $row["policial"] . '</td>';
                    echo '<td>' . $row["despachante"] . '</td>';
                    echo '<td>' . $row["recebedor"] . '</td>';
                    
                    echo    '<td align="center">
                                <form name="formCautela1" action="../view/CautelaViewEditar.php" method="POST">
                                    <button type="submit" name="editar1" value="" class="btn btn-primary btn-xs">Editar</button>
                                    <input type="hidden" name="id" value="'.$row["id"].'">
                                </form>
                            </td>';       
                }
            } else {
                echo "0 results";
            }    

        }

    function listaCautelaItemDao(conexao $conn, $id) {
        $query = "SELECT * FROM item_cautela WHERE id = $id";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row["idItem"] . '</td>';
                echo '<td>' . $row["quantidade"] . '</td>';             
                echo    '<td align="center">
                                <form name="formpolicial1" action="../view/CautelaController.php" method="POST">
                                    <button type="submit" name="excluiritem" value="" class="btn btn-primary btn-xs">Excluir</button>
                                    <input type="hidden" name="id" value="'.$row["id"].'">
                                </form>
                            </td>';
                echo '</tr>';                
            }
        } else {
            echo "0 results";
        }
        
    }
}
