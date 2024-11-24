<?php
/**
 * Cria uma conexão com o banco de dados.
 *
 * @return PDO
 * @throws PDOException
 */
function criarPDO() {
    return new PDO( 'mysql:dbname=mma;host=localhost;charset=utf8', 'root', '',
        [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ] );
}