<?php

require_once './model/Organizacao.php';
require_once './model/Lutador.php';

function listarLutadores(PDO $pdo) {
    echo 'Lutadores:', PHP_EOL, str_repeat('-', 40), PHP_EOL;

    $ps = $pdo->query('SELECT l.id AS id_lutador, l.nome AS nome_lutador, l.localidade AS localidade_lutador, o.nome AS nome_organizacao 
                        FROM lutador l 
                        JOIN organizacao o ON o.id = l.organizacao_id');

    foreach ($ps as $p) {
        echo $p['id_lutador'],
             '- ', $p['nome_lutador'], 
             ' - Localização: ', $p['localidade_lutador'], 
             ' - Organização: ', $p['nome_organizacao'], PHP_EOL;
    }
}

function adicionarLutador(PDO $pdo, Lutador $lutador){
    try {
        $sql = 'INSERT INTO lutador (nome, localidade, organizacao_id) VALUES (:nome, :localidade, :organizacao_id)';

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue('nome', $lutador->getNome(), PDO::PARAM_STR);
        $stmt->bindValue('localidade', $lutador->getLocalidade(), PDO::PARAM_STR);
        $stmt->bindValue('organizacao_id', $lutador->getOrganizacao()->getId(), PDO::PARAM_INT);

        $stmt->execute();

        echo "Lutador adicionado com sucesso!" . PHP_EOL;
    } catch (PDOException $e){
        echo "Erro ao adicionar lutador: " . $e->getMessage() . PHP_EOL;
    }
}

function removerLutador(PDO $pdo, $id){
    try {
        $sql = 'DELETE FROM lutador WHERE id = :id';
        
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            echo "Lutador com ID $id foi deletado com sucesso!" . PHP_EOL;
        } else {
            echo "Nenhum lutador encontrado com o ID $id." . PHP_EOL;
        }
    } catch (PDOException $e) {
        echo "Erro ao deletar lutador: " . $e->getMessage() . PHP_EOL;
    }
}

function editarLutador(PDO $pdo, Lutador $lutador){
    try {
        $sql = 'UPDATE lutador SET nome = :nome, localidade = :localidade, organizacao_id = :organizacao_id WHERE id = :id';

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue('nome', $lutador->getNome(), PDO::PARAM_STR);
        $stmt->bindValue('localidade', $lutador->getLocalidade(), PDO::PARAM_STR);
        $stmt->bindValue('organizacao_id', $lutador->getOrganizacao()->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':id', $lutador->getId(), PDO::PARAM_INT);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Lutador com ID ". $lutador->getId(). " foi atualizada com sucesso!" . PHP_EOL;
        } else {
            echo "Nenhuma alteração realizada. Verifique se o lutador com o ID ".$lutador->getId(). " existe." . PHP_EOL;
        }
    } catch (PDOException $e){
        echo "Erro ao editar lutador: " . $e->getMessage() . PHP_EOL;
    }
}