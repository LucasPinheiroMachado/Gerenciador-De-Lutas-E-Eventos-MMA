<?php

require_once './model/Evento.php';
require_once './model/Organizacao.php';

function listarEventos(PDO $pdo) {
    echo 'Eventos:', PHP_EOL, str_repeat('-', 40), PHP_EOL;

    $ps = $pdo->query('SELECT e.id AS id_evento, e.nome AS nome_evento, e.data AS data_evento, o.nome AS nome_organizacao
                        FROM evento e
                        JOIN organizacao o ON o.id = e.organizacao_id');

    foreach ($ps as $p) {
        $dataFormatada = DateTime::createFromFormat('Y-m-d', $p['data_evento'])->format('d/m/Y');

        echo $p['id_evento'], ' - ',
             $p['nome_evento'], ' - Data: ', $dataFormatada,
             ' - Organização: ', $p['nome_organizacao'], PHP_EOL;
    }
}

function adicionarEvento(PDO $pdo, Evento $evento) {
    try {
        $sql = 'INSERT INTO evento (nome, data, organizacao_id) VALUES (:nome, :data, :organizacao_id)';
        $stmt = $pdo->prepare($sql);

        $dataFormatada = DateTime::createFromFormat('d/m/Y', $evento->getData())->format('Y-m-d');

        $stmt->bindValue(':nome', $evento->getNome(), PDO::PARAM_STR);
        $stmt->bindValue(':data', $dataFormatada, PDO::PARAM_STR);
        $stmt->bindValue(':organizacao_id', $evento->getOrganizacao()->getId(), PDO::PARAM_INT);

        $stmt->execute();

        echo "Evento adicionado com sucesso!" . PHP_EOL;
    } catch (PDOException $e) {
        echo "Erro ao adicionar evento: " . $e->getMessage() . PHP_EOL;
    }
}

function removerEvento(PDO $pdo, $id) {
    try {
        $sql = 'DELETE FROM evento WHERE id = :id';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Evento com ID $id foi deletado com sucesso!" . PHP_EOL;
        } else {
            echo "Nenhum evento encontrado com o ID $id." . PHP_EOL;
        }
    } catch (PDOException $e) {
        echo "Erro ao deletar evento: " . $e->getMessage() . PHP_EOL;
    }
}

function editarEvento(PDO $pdo, Evento $evento) {
    try {
        $sql = 'UPDATE evento SET nome = :nome, data = :data, organizacao_id = :organizacao_id WHERE id = :id';

        $stmt = $pdo->prepare($sql);

        $dataFormatada = DateTime::createFromFormat('d/m/Y', $evento->getData())->format('Y-m-d');

        $stmt->bindValue(':nome', $evento->getNome(), PDO::PARAM_STR);
        $stmt->bindValue(':data', $dataFormatada, PDO::PARAM_STR);
        $stmt->bindValue(':organizacao_id', $evento->getOrganizacao()->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':id', $evento->getId(), PDO::PARAM_INT);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Evento com ID " . $evento->getId() . " foi atualizado com sucesso!" . PHP_EOL;
        } else {
            echo "Nenhuma alteração realizada. Verifique se o evento com o ID " . $evento->getId() . " existe." . PHP_EOL;
        }
    } catch (PDOException $e) {
        echo "Erro ao editar evento: " . $e->getMessage() . PHP_EOL;
    }
}
