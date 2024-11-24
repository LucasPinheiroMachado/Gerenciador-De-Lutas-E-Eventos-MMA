<?php

// bd
require_once './bd/conexao.php';

// model
require_once './model/Luta.php';
require_once './model/Lutador.php';
require_once './model/Evento.php';
require_once './model/Organizacao.php';

// controler
require_once './controller/Organizacao.php';
require_once './controller/Lutador.php';
require_once './controller/Evento.php';
require_once './controller/Luta.php';

function exibirMenuPrincipal()
{
    echo PHP_EOL, "Menu Principal:", PHP_EOL;
    echo "1. Organizações", PHP_EOL;
    echo "2. Eventos", PHP_EOL;
    echo "3. Lutas", PHP_EOL;
    echo "4. Lutadores", PHP_EOL;
    echo "0. Voltar", PHP_EOL;
    echo "Escolha uma opção: ";
}

function exibirMenuSecundario($titulo)
{
    echo PHP_EOL, "$titulo:", PHP_EOL;
    echo "1. Listar", PHP_EOL;
    echo "2. Adicionar", PHP_EOL;
    echo "3. Editar", PHP_EOL;
    echo "4. Remover", PHP_EOL;
    echo "0. Voltar", PHP_EOL;
    echo "Escolha uma opção: ";
}

$pdo = criarPDO();

$ativo = true;

while($ativo){
    exibirMenuPrincipal();
    $opcao = readline();

    switch ($opcao) {
        case '1': // Organização
            do {
                exibirMenuSecundario("Organização");
                $subOpcao = readline();

                switch ($subOpcao) {
                    case '1':
                        echo PHP_EOL;
                        listarOrganizacoes($pdo);
                        echo PHP_EOL;
                        break;
                    case '2':
                        echo "Opção: Adicionar Organização", PHP_EOL, "Digite o nome da Organização: ";
                        $nome = readline();
                        echo PHP_EOL, "Digite o país da organização: ";
                        $localidade = readline();
                        $organizacao = new Organizacao(null, $nome, $localidade);
                        adicionarOrganizacao($pdo, $organizacao);
                        echo PHP_EOL;
                        break;
                    case '3':
                        echo "Opção: Editar Organização", PHP_EOL, "Digite o id da Organização: ";
                        $id = readline();
                        echo PHP_EOL, "Digite o novo nome: ";
                        $nome = readline();
                        echo PHP_EOL, "Digite o novo país: ";
                        $localidade = readline();
                        $organizacao = new Organizacao($id, $nome, $localidade);
                        editarOrganizacao($pdo, $organizacao);
                        echo PHP_EOL;
                        break;
                    case '4':
                        echo "Opção: Remover Organização", PHP_EOL, "Digite o id da Organização: ";
                        $id = readline();
                        deletarOrganizacao($pdo, $id);
                        break;
                }
            } while ($subOpcao !== '0');
            break;

        case '2': // Evento
            do {
                exibirMenuSecundario("Evento");
                $subOpcao = readline();

                switch ($subOpcao) {
                    case '1':
                        echo PHP_EOL;
                        listarEventos($pdo);
                        echo PHP_EOL;
                        break;
                    case '2':
                        echo "Opção: Adicionar Evento", PHP_EOL, "Digite o nome do evento: ";
                        $nome = readline();
                        echo PHP_EOL, "Digite a data do evento no formato (DD/MM/AAAA): ";
                        $data = readline();
                        echo PHP_EOL, "Digite o ID da organização do evento: ";
                        $organizacao_id = readline();
                        $organizacao = new Organizacao($organizacao_id, null, null);
                        $evento = new Evento(null, $nome, $data, $organizacao);
                        adicionarEvento($pdo, $evento);
                        echo PHP_EOL;
                        break;
                    case '3':
                        echo "Opção: Editar Evento", PHP_EOL,  "Digite o id do evento: ";
                        $id = readline();
                        echo "Digite o nome do evento: ";
                        $nome = readline();
                        echo PHP_EOL, "Digite a data do evento no formato (DD/MM/AAAA): ";
                        $data = readline();
                        echo PHP_EOL, "Digite o ID da organização do evento: ";
                        $organizacao_id = readline();
                        $organizacao = new Organizacao($organizacao_id, null, null);
                        $evento = new Evento($id, $nome, $data, $organizacao);
                        editarEvento($pdo, $evento);
                        echo PHP_EOL;
                        break;
                    case '4':
                        echo "Opção: Remover Evento", PHP_EOL, "Digite o id do evento: ";
                        $id = readline();
                        removerEvento($pdo, $id);
                        echo PHP_EOL;
                        break;
                }
            } while ($subOpcao !== '0');
            break;

        case '3': // Lutas
            do {
                exibirMenuSecundario("Lutas");
                $subOpcao = readline();

                switch ($subOpcao) {
                    case '1':
                        echo PHP_EOL;
                        listarLutas($pdo);
                        echo PHP_EOL;
                        break;
                    case '2':
                        echo "Opção: Adicionar Luta", PHP_EOL, "Digite o id do lutador 1: ";
                        $lutador1_id = readline();
                        echo PHP_EOL, "Digite o id do lutador 2: ";
                        $lutador2_id = readline();
                        echo PHP_EOL, "Digite o id do evento: ";
                        $evento_id = readline();
                        $organizacao = new Organizacao(null, null, null);
                        $lutador1 = new Lutador($lutador1_id, null, null, $organizacao);
                        $lutador2 = new Lutador($lutador2_id, null, null, $organizacao);
                        $evento = new Evento($evento_id, null, null, $organizacao);
                        $luta = new Luta(null, $lutador1, $lutador2, $evento);
                        adicionarLuta($pdo, $luta);
                        echo PHP_EOL;
                        break;
                    case '3':
                        echo "Opção: Editar Luta", PHP_EOL, "Digite o id da Luta: ";
                        $id = readline();
                        echo PHP_EOL, "Digite o id do lutador 1: ";
                        $lutador1_id = readline();
                        echo PHP_EOL, "Digite o id do lutador 2: ";
                        $lutador2_id = readline();
                        echo PHP_EOL, "Digite o id do evento: ";
                        $evento_id = readline();
                        $organizacao = new Organizacao(null, null, null);
                        $lutador1 = new Lutador($lutador1_id, null, null, $organizacao);
                        $lutador2 = new Lutador($lutador2_id, null, null, $organizacao);
                        $evento = new Evento($evento_id, null, null, $organizacao);
                        $luta = new Luta(12, $lutador1, $lutador2, $evento);
                        editarLuta($pdo, $luta);
                        echo PHP_EOL;
                        break;
                    case '4':
                        echo "Opção: Remover Luta", PHP_EOL, "Digite o id da luta: ";
                        $id = readline();
                        removerLuta($pdo, $id);
                        echo PHP_EOL;
                        break;
                }
            } while ($subOpcao !== '0');
            break;

        case '4': // Lutadores
            do {
                exibirMenuSecundario("Lutadores");
                $subOpcao = readline();

                switch ($subOpcao) {
                    case '1':
                        echo PHP_EOL;
                        listarLutadores($pdo);
                        echo PHP_EOL;
                        break;
                    case '2':
                        echo "Opção: Adicionar Lutador", PHP_EOL, "Digite o nome do Lutador: ";
                        $nome = readline();
                        echo PHP_EOL, "Digite o país do Lutador: ";
                        $localidade = readline();
                        echo PHP_EOL, "Digite id da organização do Lutador: ";
                        $organizacao_id = readline();
                        $organizacao = new Organizacao($organizacao_id, null, null);
                        $lutador = new Lutador(null, $nome, $localidade, $organizacao);
                        adicionarLutador($pdo, $lutador);
                        echo PHP_EOL;
                        break;
                    case '3':
                        echo "Opção: Editar Lutador", PHP_EOL, "Digite o id do Lutador: ";
                        $id = readline();
                        echo PHP_EOL, "Digite o novo nome: ";
                        $nome = readline();
                        echo PHP_EOL, "Digite o novo país: ";
                        $localidade = readline();
                        echo PHP_EOL, "Digite id da Organização: ";
                        $organizacao_id = readline();
                        $organizacao = new Organizacao($organizacao_id, null, null);
                        $lutador = new Lutador($id, $nome, $localidade, $organizacao);
                        editarLutador($pdo, $lutador);
                        echo PHP_EOL;
                        break;
                    case '4':
                        echo "Opção: Remover Lutador", PHP_EOL, "Digite o id do lutador: ";
                        $id = readline();
                        removerLutador($pdo, $id);
                        echo PHP_EOL;
                        break;
                }
            } while ($subOpcao !== '0');
            break;

        case '0': // Sair
            echo "Programa encerrado.", PHP_EOL;
            break;

        default:
            echo "Opção inválida, tente novamente.", PHP_EOL;
            break;
    }
}