<?php

require_once './model/Luta.php';

function listarLutas(PDO $pdo) {
    echo 'Lutas:', PHP_EOL, str_repeat('-', 40), PHP_EOL;

    $ps = $pdo->query(
        'SELECT luta.id AS id, 
                lutador1.nome AS lutador1_nome, 
                lutador2.nome AS lutador2_nome, 
                evento.nome AS evento_nome
         FROM luta
         JOIN lutador AS lutador1 ON luta.lutador1_id = lutador1.id
         JOIN lutador AS lutador2 ON luta.lutador2_id = lutador2.id
         JOIN evento ON luta.evento_id = evento.id'
);

    foreach ($ps as $p) {
        echo $p['id'], ' - ',
             'Lutador 1: ', $p['lutador1_nome'], ' - ',
             'Lutador 2: ', $p['lutador2_nome'], ' - ',
             'Evento: ', $p['evento_nome'], PHP_EOL;
    }
}

function adicionarLuta(PDO $pdo, Luta $luta){
    try{
        $sql = 'INSERT INTO luta (lutador1_id, lutador2_id, evento_id) VALUES (:lutador1_id, :lutador2_id, :evento_id)';

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue('lutador1_id', $luta->getLutador1()->getId(), PDO::PARAM_INT);
        $stmt->bindValue('lutador2_id', $luta->getLutador2()->getId(), PDO::PARAM_INT);
        $stmt->bindValue('evento_id', $luta->getEvento()->getId(), PDO::PARAM_INT);

        $stmt->execute();

        echo "Luta adicionada com sucesso!" . PHP_EOL;
    } catch(PDOException $e){
        echo "Erro ao adicionar evento: " . $e->getMessage() . PHP_EOL;
    }
}

function editarLuta(PDO $pdo, Luta $luta) {
    try {
        $sql = 'UPDATE luta 
                SET lutador1_id = :lutador1_id, 
                    lutador2_id = :lutador2_id, 
                    evento_id = :evento_id 
                WHERE id = :id';

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':lutador1_id', $luta->getLutador1()->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':lutador2_id', $luta->getLutador2()->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':evento_id', $luta->getEvento()->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':id', $luta->getId(), PDO::PARAM_INT);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Luta com ID " . $luta->getId() . " foi atualizada com sucesso!" . PHP_EOL;
        } else {
            echo "Nenhuma alteração realizada. Verifique se a luta com o ID " . $luta->getId() . " existe." . PHP_EOL;
        }
    } catch (PDOException $e) {
        echo "Erro ao editar luta: " . $e->getMessage() . PHP_EOL;
    }
}

function removerLuta(PDO $pdo, $id) {
    try {
        $sql = 'DELETE FROM luta WHERE id = :id';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Luta com ID $id foi deletada com sucesso!" . PHP_EOL;
        } else {
            echo "Nenhuma luta encontrada com o ID $id." . PHP_EOL;
        }
    } catch (PDOException $e) {
        echo "Erro ao deletar luta: " . $e->getMessage() . PHP_EOL;
    }
}
