<?php

require_once './model/Organizacao.php';

function listarOrganizacoes( PDO $pdo ){
    echo 'Organizações de MMA:', PHP_EOL, str_repeat( '-', 40 ), PHP_EOL;
    $ps = $pdo->query( 'SELECT id, nome, localidade FROM organizacao' );
    foreach ( $ps as $p ) {
        echo $p[ 'id' ],
            ' - ', $p[ 'nome' ],
            ' - ', $p['localidade' ], PHP_EOL;
    }
}

function adicionarOrganizacao(PDO $pdo, Organizacao $organizacao){
    try {
        $sql = 'INSERT INTO organizacao (nome, localidade) VALUES (:nome, :localidade)';
        
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindValue(':nome', $organizacao->getNome(), PDO::PARAM_STR);
        $stmt->bindValue(':localidade', $organizacao->getLocalidade(), PDO::PARAM_STR);
        
        $stmt->execute();
        
        echo "Organização adicionada com sucesso!" . PHP_EOL;
    } catch (PDOException $e) {
        echo "Erro ao adicionar organização: " . $e->getMessage() . PHP_EOL;
    }
}

function deletarOrganizacao(PDO $pdo, $id) {
    try {
        $sql = 'DELETE FROM organizacao WHERE id = :id';
        
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            echo "Organização com ID $id foi deletada com sucesso!" . PHP_EOL;
        } else {
            echo "Nenhuma organização encontrada com o ID $id." . PHP_EOL;
        }
    } catch (PDOException $e) {
        echo "Erro ao deletar organização: " . $e->getMessage() . PHP_EOL;
    }
}

function editarOrganizacao(PDO $pdo, Organizacao $organizacao) {
    try {
        $sql = 'UPDATE organizacao SET nome = :nome, localidade = :localidade WHERE id = :id';
            
        $stmt = $pdo->prepare($sql);
            
        $stmt->bindValue(':nome', $organizacao->getNome(), PDO::PARAM_STR);
        $stmt->bindValue(':localidade', $organizacao->getLocalidade(), PDO::PARAM_STR);
        $stmt->bindValue(':id', $organizacao->getId(), PDO::PARAM_INT);
            
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erro ao editar organização: " . $e->getMessage() . PHP_EOL;
    }
}