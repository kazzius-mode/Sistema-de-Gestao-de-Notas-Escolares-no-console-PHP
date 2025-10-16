<?php
/*
====================================================
    Sistema de Gestão de Notas
----------------------------------------------------
    Descrição:
    Sistema em PHP para registar, visualizar e analisar notas de estudantes.
    Permite:
        - Registrar estudantes e suas notas
        - Listar todos os estudantes cadastrados
        - Calcular média geral da turma
        - Mostrar maior e menor nota
        - Menu interativo com tratamento de erros
----------------------------------------------------
    Requisitos Técnicos:
        • Uso de variáveis e arrays associativos
        • Estruturas de controlo (if, for, foreach, switch)
        • Funções personalizadas e pré-definidas do PHP
        • Código organizado, comentado e fácil de entender
====================================================
*/

// ============================================
// CONSTANTES - NOTAS
// ============================================
define('NOTA_MINIMA', 0);
define('NOTA_MAXIMA', 20);
define('MEDIA_DISPENSADO', 16);
define('MEDIA_APROVADO', 10);

// ============================================
// FUNÇÕES AUXILIARES
// ============================================

/**
 * Determina o estado do aluno baseado na média
 */
function determinarestado($media)
{
    if ($media >= MEDIA_DISPENSADO) {
        return "Dispensado";
    } elseif ($media >= MEDIA_APROVADO) {
        return "Aprovado";
    } else {
        return "Reprovado";
    }
}

/**
 * Valida e solicita uma nota válida
 */
function validarnota($mensagem)
{
    do {
        echo $mensagem;
        $entrada = trim(fgets(STDIN));
        
        if (!is_numeric($entrada) || $entrada < NOTA_MINIMA || $entrada > NOTA_MAXIMA) {
            echo "[ERRO] Nota deve ser um número entre " . NOTA_MINIMA . " e " . NOTA_MAXIMA . ". Tente novamente.\n";
            $valida = false;
        } else {
            $valida = true;
        }
    } while (!$valida);
    
    return (float)$entrada;
}

/**
 * Solicita entrada de texto não vazia
 */
function solicitarTexto($mensagem, $nomeCampo)
{
    do {
        echo $mensagem;
        $texto = trim(fgets(STDIN));
        
        if (empty($texto)) {
            echo "[ERRO] $nomeCampo não pode estar vazio.\n";
        }
    } while (empty($texto));
    
    return $texto;
}

/**
 * Solicita confirmação (S/N)
 */
function solicitarConfirmacao($mensagem)
{
    do {
        echo $mensagem;
        $resposta = strtoupper(trim(fgets(STDIN)));
        
        if ($resposta !== 'S' && $resposta !== 'N') {
            echo "[ERRO] Digite apenas S para Sim ou N para Não.\n";
        }
    } while ($resposta !== 'S' && $resposta !== 'N');
    
    return $resposta === 'S';
}

/**
 * Calcula a média de três notas
 */
function calcularMedia($nota1, $nota2, $nota3)
{
    return round(($nota1 + $nota2 + $nota3) / 3, 1);
}

/**
 * Exibe dados completos de um aluno
 */
function exibirDadosAluno($aluno)
{
    echo "Nome do aluno: {$aluno['Nome']}\n";
    echo "Nome da turma: {$aluno['Turma']}\n";
    echo "Nota 1: {$aluno['Nota 1']}\n";
    echo "Nota 2: {$aluno['Nota 2']}\n";
    echo "Nota 3: {$aluno['Nota 3']}\n";
    echo "Media Final: {$aluno['Media']}\n";
    echo "Estado: {$aluno['Estado']}\n";
}

/**
 * Verifica se existem alunos cadastrados
 */
function verificarAlunosCadastrados($alunos)
{
    if (count($alunos) == 0) {
        echo "Nenhum estudante cadastrado.\n";
        return false;
    }
    return true;
}

// ============================================
// FUNÇÕES PRINCIPAIS DO SISTEMA
// ============================================

/**
 * Registra um novo estudante com suas notas
 */
function registrarEstudante(&$alunos)
{
    do {
        $nome = solicitarTexto("Nome Completo: ", "Nome");
        $nome_turma = solicitarTexto("Turma: ", "Turma");
        
        $nota1 = validarnota("Nota 1: ");
        $nota2 = validarnota("Nota 2: ");
        $nota3 = validarnota("Nota 3: ");
        
        $media = calcularMedia($nota1, $nota2, $nota3);
        $estado = determinarestado($media);
        
        $alunos[] = [
            "Nome" => $nome,
            "Turma" => $nome_turma,
            "Nota 1" => $nota1,
            "Nota 2" => $nota2,
            "Nota 3" => $nota3,
            "Media" => $media,
            "Estado" => $estado
        ];
        
        echo "\n[SUCESSO] Estudante registrado com sucesso!\n\n";
        
    } while (solicitarConfirmacao("Deseja registrar outro estudante? (S/N): "));
}

/**
 * Edita as notas de um aluno existente
 */
function editarNotasAluno(&$alunos)
{
    if (!verificarAlunosCadastrados($alunos)) return;
    
    $busca = solicitarTexto("Digite o nome do aluno para editar: ", "Nome");
    $busca = strtolower($busca);
    $encontrado = false;
    
    foreach ($alunos as &$aluno) {
        if (strpos(strtolower($aluno['Nome']), $busca) !== false) {
            echo "\nAluno encontrado: {$aluno['Nome']}\n\n";
            
            $nota1 = validarnota("Nova nota 1: ");
            $nota2 = validarnota("Nova nota 2: ");
            $nota3 = validarnota("Nova nota 3: ");
            
            $aluno['Nota 1'] = $nota1;
            $aluno['Nota 2'] = $nota2;
            $aluno['Nota 3'] = $nota3;
            $aluno['Media'] = calcularMedia($nota1, $nota2, $nota3);
            $aluno['Estado'] = determinarestado($aluno['Media']);
            
            echo "\n[SUCESSO] Notas atualizadas com sucesso!\n";
            $encontrado = true;
            break;
        }
    }
    
    if (!$encontrado) {
        echo "[ERRO] Aluno não encontrado.\n";
    }
}

/**
 * Lista todos os estudantes cadastrados
 */
function listarEstudantes($alunos)
{
    if (!verificarAlunosCadastrados($alunos)) return;
    
    echo "===============================\n";
    echo "LISTA DOS ALUNOS\n";
    echo "===============================\n";
    
    foreach ($alunos as $aluno) {
        exibirDadosAluno($aluno);
        echo "==============================\n\n";
    }
}

/**
 * Lista aprovados e reprovados separadamente
 */
function listarAprovadosReprovados($alunos)
{
    if (!verificarAlunosCadastrados($alunos)) return;
    
    echo "=================================\n";
    echo "APROVADOS\n";
    echo "=================================\n";
    
    $temAprovado = false;
    foreach ($alunos as $aluno) {
        if ($aluno['Estado'] === "Aprovado") {
            echo "{$aluno['Nome']} | Média: {$aluno['Media']}\n";
            $temAprovado = true;
        }
    }
    
    if (!$temAprovado) {
        echo "Nenhum aluno aprovado.\n";
    }
    
    echo "\n=================================\n";
    echo "REPROVADOS\n";
    echo "=================================\n";
    
    $temReprovado = false;
    foreach ($alunos as $aluno) {
        if ($aluno['Estado'] === "Reprovado") {
            echo "{$aluno['Nome']} | Média: {$aluno['Media']}\n";
            $temReprovado = true;
        }
    }
    
    if (!$temReprovado) {
        echo "Nenhum aluno reprovado.\n";
    }
}

/**
 * Lista estudantes dispensados (média >= 16)
 */
function listarDispensado($alunos)
{
    if (!verificarAlunosCadastrados($alunos)) return;
    
    echo "=============================\n";
    echo "ALUNOS DISPENSADOS (Média >= 16)\n";
    echo "=============================\n";
    
    $temDispensado = false;
    
    foreach ($alunos as $aluno) {
        if ($aluno['Media'] >= MEDIA_DISPENSADO) {
            exibirDadosAluno($aluno);
            echo "==================================\n";
            $temDispensado = true;
        }
    }
    
    if (!$temDispensado) {
        echo "Nenhum aluno dispensado.\n";
    }
}

/**
 * Lista alunos com média inferior a 10
 */
function listarPessimosalunos($alunos)
{
    if (!verificarAlunosCadastrados($alunos)) return;
    
    echo "=============================\n";
    echo "PESSIMOS ALUNOS (Média < 10)\n";
    echo "=============================\n";
    
    $temPessimo = false;
    
    foreach ($alunos as $aluno) {
        if ($aluno["Media"] < 10) {
            echo "Nome: {$aluno['Nome']}\n";
            echo "Turma: {$aluno['Turma']}\n";
            echo "Media: {$aluno['Media']}\n";
            echo "Estado: {$aluno['Estado']}\n";
            echo "Situação: Pessima\n";
            echo "===============================\n\n";
            $temPessimo = true;
        }
    }
    
    if (!$temPessimo) {
        echo "Nenhum estudante nesta categoria.\n";
    }
}

/**
 * Procura estudante por nome
 */
function procurarEstudantePorNome($alunos)
{
    if (!verificarAlunosCadastrados($alunos)) return;
    
    $busca = solicitarTexto("Digite o nome do estudante para procurar: ", "Nome");
    $busca = strtolower($busca);
    $encontrado = false;
    
    foreach ($alunos as $aluno) {
        if (strpos(strtolower($aluno['Nome']), $busca) !== false) {
            echo "\nEstudante encontrado:\n";
            exibirDadosAluno($aluno);
            echo "==============================\n";
            $encontrado = true;
        }
    }
    
    if (!$encontrado) {
        echo "[ERRO] Nenhum estudante encontrado com esse nome.\n";
    }
}

/**
 * Mostra aluno com maior e menor nota
 */
function mostrarMaiorMenorNota($alunos)
{
    if (!verificarAlunosCadastrados($alunos)) return;
    
    $maiornota = null;
    $menornota = null;
    $alunomaior = "";
    $alunomenor = "";
    
    foreach ($alunos as $aluno) {
        foreach (['Nota 1', 'Nota 2', 'Nota 3'] as $key) {
            if ($maiornota === null || $aluno[$key] > $maiornota) {
                $maiornota = $aluno[$key];
                $alunomaior = $aluno['Nome'];
            }
            if ($menornota === null || $aluno[$key] < $menornota) {
                $menornota = $aluno[$key];
                $alunomenor = $aluno['Nome'];
            }
        }
    }
    
    echo "=============================\n";
    echo "ALUNO COM MAIOR NOTA\n";
    echo "=============================\n";
    echo "Nome do aluno: $alunomaior\n";
    echo "Nota do aluno: $maiornota\n";
    echo "=============================\n\n";
    
    echo "=============================\n";
    echo "ALUNO COM MENOR NOTA\n";
    echo "=============================\n";
    echo "Nome do aluno: $alunomenor\n";
    echo "Nota do aluno: $menornota\n";
    echo "=============================\n";
}

/**
 * Calcula e exibe a média geral da turma
 */
function calcularmediageral($alunos)
{
    if (!verificarAlunosCadastrados($alunos)) return;
    
    $medias = array_column($alunos, 'Media');
    $media_geral = round(array_sum($medias) / count($medias), 1);
    
    echo "=============================\n";
    echo "Média geral da turma: $media_geral\n";
    echo "=============================\n";
}

/**
 * Lista alunos por faixa de nota (>= 16 e < 16)
 */
function listarAlunosPorNota($alunos)
{
    if (!verificarAlunosCadastrados($alunos)) return;
    
    echo "=============================\n";
    echo "ALUNOS COM MEDIA MAIOR OU IGUAL A 16\n";
    echo "=============================\n";
    
    $temMaior = false;
    foreach ($alunos as $aluno) {
        if ($aluno['Media'] >= 16) {
            echo "Nome: {$aluno['Nome']}\n";
            echo "Turma: {$aluno['Turma']}\n";
            echo "Média: {$aluno['Media']}\n";
            echo "-----------------------------\n";
            $temMaior = true;
        }
    }
    
    if (!$temMaior) {
        echo "Nenhum aluno com média maior ou igual a 16.\n";
    }
    
    echo "\n=============================\n";
    echo "ALUNOS COM MEDIA MENOR QUE 16\n";
    echo "=============================\n";
    
    $temMenor = false;
    foreach ($alunos as $aluno) {
        if ($aluno['Media'] < 16) {
            echo "Nome: {$aluno['Nome']}\n";
            echo "Turma: {$aluno['Turma']}\n";
            echo "Média: {$aluno['Media']}\n";
            echo "-----------------------------\n";
            $temMenor = true;
        }
    }
    
    if (!$temMenor) {
        echo "Nenhum aluno com média menor que 16.\n";
    }
}

/**
 * Remove um estudante do sistema
 */
function apagarRegistroEstudante(&$alunos)
{
    if (!verificarAlunosCadastrados($alunos)) return;
    
    $busca = solicitarTexto("Digite o nome do estudante que deseja apagar: ", "Nome");
    $busca = strtolower($busca);
    $removido = false;
    
    foreach ($alunos as $i => $aluno) {
        if (strpos(strtolower($aluno['Nome']), $busca) !== false) {
            echo "\nEstudante encontrado: {$aluno['Nome']}\n";
            
            if (solicitarConfirmacao("Deseja realmente apagar este registro? (S/N): ")) {
                unset($alunos[$i]);
                echo "[SUCESSO] Estudante {$aluno['Nome']} removido com sucesso.\n";
                $removido = true;
            } else {
                echo "Operação cancelada para {$aluno['Nome']}.\n";
            }
            break;
        }
    }
    
    if (!$removido) {
        echo "[ERRO] Nenhum estudante encontrado com esse nome.\n";
    } else {
        $alunos = array_values($alunos);
    }
}

/**
 * Lista melhores estudantes por categorias de desempenho
 */
function listarmelhoresestudantes($alunos)
{
    if (!verificarAlunosCadastrados($alunos)) return;
    
    // Encontrar aluno com maior nota individual
    $maiornota = null;
    $alunomaior = "";
    
    foreach ($alunos as $aluno) {
        foreach (['Nota 1', 'Nota 2', 'Nota 3'] as $key) {
            if ($maiornota === null || $aluno[$key] > $maiornota) {
                $maiornota = $aluno[$key];
                $alunomaior = $aluno['Nome'];
            }
        }
    }
    
    echo "\n=================================\n";
    echo "ALUNO COM MAIOR NOTA\n";
    echo "=================================\n";
    echo "Nome do aluno: $alunomaior\n";
    echo "Nota do aluno: $maiornota\n";
    echo "=================================\n";
    
    // Definir categorias
    $categorias = [
        ['nome' => 'EXCELENTES', 'min' => 18, 'max' => 20],
        ['nome' => 'MUITO BOM', 'min' => 16, 'max' => 18],
        ['nome' => 'BOM', 'min' => 14, 'max' => 16],
        ['nome' => 'REGULAR', 'min' => 10, 'max' => 14],
        ['nome' => 'FRACO', 'min' => 7, 'max' => 10],
        ['nome' => 'MUITO FRACO', 'min' => 4, 'max' => 7],
        ['nome' => 'PESSIMO', 'min' => 0, 'max' => 4]
    ];
    
    // Listar alunos por categoria
    foreach ($categorias as $categoria) {
        echo "\n=================================\n";
        echo "{$categoria['nome']}\n";
        echo "=================================\n";
        
        $temAluno = false;
        
        foreach ($alunos as $aluno) {
            $media = $aluno['Media'];
            
            // Verifica se está na faixa da categoria
            if ($media >= $categoria['min'] && $media < $categoria['max']) {
                echo "Nome: {$aluno['Nome']}\n";
                echo "Turma: {$aluno['Turma']}\n";
                echo "Nota 1: {$aluno['Nota 1']}\n";
                echo "Nota 2: {$aluno['Nota 2']}\n";
                echo "Nota 3: {$aluno['Nota 3']}\n";
                echo "Media: {$aluno['Media']}\n";
                echo "Estado: {$aluno['Estado']}\n";
                echo "===============================\n";
                $temAluno = true;
            }
        }
        
        if (!$temAluno) {
            echo "Nenhum aluno nesta categoria\n";
        }
    }
}

/**
 * Exibe o total de alunos cadastrados
 */
function contarAlunos($alunos)
{
    $total = count($alunos);
    echo "=============================\n";
    echo "Total de alunos cadastrados: $total\n";
    echo "=============================\n";
}

// ============================================
// FUNÇÕES DE PERSISTÊNCIA
// ============================================

/**
 * Salva alunos em arquivo
 */
function salvarAlunosArquivo($alunos, $arquivo)
{
    try {
        $dados = "";
        foreach ($alunos as $aluno) {
            $dados .= implode("|", $aluno) . "\n";
        }
        
        if (file_put_contents($arquivo, $dados) === false) {
            throw new Exception("Erro ao salvar arquivo.");
        }
        
        echo "[SUCESSO] Dados salvos com sucesso.\n";
    } catch (Exception $e) {
        echo "[ERRO] Não foi possível salvar os dados: {$e->getMessage()}\n";
    }
}

/**
 * Carrega alunos de arquivo
 */
function carregarAlunosArquivo($arquivo)
{
    $alunos = [];
    
    try {
        if (file_exists($arquivo)) {
            $linhas = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            
            foreach ($linhas as $linha) {
                $partes = explode("|", $linha);
                
                if (count($partes) >= 7) {
                    $alunos[] = [
                        "Nome" => $partes[0],
                        "Turma" => $partes[1],
                        "Nota 1" => (float)$partes[2],
                        "Nota 2" => (float)$partes[3],
                        "Nota 3" => (float)$partes[4],
                        "Media" => (float)$partes[5],
                        "Estado" => $partes[6]
                    ];
                }
            }
        }
    } catch (Exception $e) {
        echo "[ERRO] Erro ao carregar dados: {$e->getMessage()}\n";
    }
    
    return $alunos;
}

// ============================================
// PROGRAMA PRINCIPAL
// ============================================

$arquivo = __DIR__ . '/alunos.txt';
$alunos = carregarAlunosArquivo($arquivo);

while (true) {
    echo "\n=============================\n";
    echo "Sistema de Gestão de Notas\n";
    echo "=============================\n";
    echo "1. Registrar Estudantes e Notas\n";
    echo "2. Listar Estudantes e notas\n";
    echo "3. Calcular Media Geral\n";
    echo "4. Procurar Estudante por nome\n";
    echo "5. Mostrar Maior nota e a Menor Nota\n";
    echo "6. Editar notas de um aluno\n";
    echo "7. Lista dos aprovados e reprovados\n";
    echo "8. Lista de alunos com Media >= 16 e < 16\n";
    echo "9. Apagar o estudante pelo nome\n";
    echo "10. Mostrar total de alunos cadastrado\n";
    echo "11. Mostra os estudantes Dispensados\n";
    echo "12. Mostrar Lista dos Pessimos Alunos\n";
    echo "13. Lista dos melhores e dos Piores\n";
    echo "0. Sair\n";
    echo "=============================\n";
    
    $opcao = null;
    do {
        echo "Escolher uma opção (0-13): ";
        $input = trim(fgets(STDIN));
        
        if (is_numeric($input) && $input >= 0 && $input <= 13) {
            $opcao = (int)$input;
        } else {
            echo "\n[ERRO] Opção inválida! Digite um número de 0 a 13.\n";
        }
    } while ($opcao === null);
    
    echo "\n";
    
    switch ($opcao) {
        case 1:
            registrarEstudante($alunos);
            break;
        case 2:
            listarEstudantes($alunos);
            break;
        case 3:
            calcularmediageral($alunos);
            break;
        case 4:
            procurarEstudantePorNome($alunos);
            break;
        case 5:
            mostrarMaiorMenorNota($alunos);
            break;
        case 6:
            editarNotasAluno($alunos);
            break;
        case 7:
            listarAprovadosReprovados($alunos);
            break;
        case 8:
            listarAlunosPorNota($alunos);
            break;
        case 9:
            apagarRegistroEstudante($alunos);
            break;
        case 10:
            contarAlunos($alunos);
            break;
        case 11:
            listarDispensado($alunos);
            break;
        case 12:
            listarPessimosalunos($alunos);
            break;
        case 13:
            listarmelhoresestudantes($alunos);
            break;
        case 0:
            salvarAlunosArquivo($alunos, $arquivo);
            echo "Saindo do Programa...\n";
            exit;
        default:
            echo "[ERRO] Opção Invalida! Escolha a opção certa.\n";
            break;
    }
}
?>