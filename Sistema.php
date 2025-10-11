
<?php
/*
====================================================
    Sistema de Gestão de Notas
----------------------------------------------------
    Autor: Imran Vali Jafar
    Turma: TPW-5
    Data: Outubro 2025
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
// ---------------------------------------------
// Funções principais do sistema
// ---------------------------------------------
// ---------------------------------------------
// Programa principal e menu interativo
// ---------------------------------------------
// Fim do programa
// ---------------------------------------------
// Desenvolvido para fins educativos
// TPW-5 | Outubro 2025

?>


<?php

// Função para registrar um estudante
function registrarEstudante(&$alunos) {
    do {
        echo "Nome Completo: ";
        $nome = trim(fgets(STDIN));

        echo "Turma: ";
        $nome_turma = trim(fgets(STDIN));

        echo "Nota 1: ";
        do {
            $entrada = trim(fgets(STDIN));
            if (!is_numeric($entrada) || $entrada < 0 || $entrada > 20) {
                echo "[ERRO] Nota deve ser um número entre 0 e 20. Tente novamente: ";
            }
        } while (!is_numeric($entrada) || $entrada < 0 || $entrada > 20);
        $nota1 = (float)$entrada;

        echo "Nota 2: ";
        do {
            $entrada = trim(fgets(STDIN));
            if (!is_numeric($entrada) || $entrada < 0 || $entrada > 20) {
                echo "[ERRO] Nota deve ser um número entre 0 e 20. Tente novamente: ";
            }
        } while (!is_numeric($entrada) || $entrada < 0 || $entrada > 20);
        $nota2 = (float)$entrada;

        echo "Nota 3: ";
        do {
            $entrada = trim(fgets(STDIN));
            if (!is_numeric($entrada) || $entrada < 0 || $entrada > 20) {
                echo "[ERRO] Nota deve ser um número entre 0 e 20. Tente novamente: ";
            }
        } while (!is_numeric($entrada) || $entrada < 0 || $entrada > 20);
        $nota3 = (float)$entrada;

        $media = calcularMedia($nota1, $nota2, $nota3);
        // $estado = ($alunos['Media'] >= 10 && "Aprovado")||($alunos['Media'] < 10 && "Reprovado")||($alunos['Media'] >= 16 && "Dispensado");
        // $estado = null;

            $media = calcularMedia($nota1, $nota2, $nota3);
            
                    if ($media >= 16) {
                    $estado = "Dispensado";
                } else if ($media >= 10) {
                    $estado = "Aprovado";
                    } else {
                        $estado = "Reprovado";
                    }

             $alunos[] = [
                "Nome" => $nome,
                "Turma" => $nome_turma,
                "Nota 1" => $nota1,
                "Nota 2" => $nota2,
                "Nota 3" => $nota3,
                "Media" => $media,
                "Estado" => $estado
            ];
        
        echo "Deseja registrar outro estudante? (S/N): ";
        $rep = strtoupper(trim(fgets(STDIN)));
    } while ($rep == "S");
}

// Função para calcular a média
function calcularMedia($nota1, $nota2, $nota3) {
    return round(($nota1 + $nota2 + $nota3) / 3, 1);
}

// Função para listar estudantes
function listarEstudantes($alunos) {
    echo "===============================\n";
    echo "LISTA DOS ALUNOS\n";
    echo "===============================\n";
    foreach ($alunos as $aluno) {
    echo "Nome do aluno: {$aluno['Nome']}\n";
    echo "Nome da turma: {$aluno['Turma']}\n";
    echo "Nota 1: {$aluno['Nota 1']}\n";
    echo "Nota 2: {$aluno['Nota 2']}\n";
    echo "Nota 3: {$aluno['Nota 3']}\n";
    echo "Media Final: {$aluno['Media']}\n";
    echo "Estado: {$aluno['Estado']}\n";
    echo "==============================\n\n";
    }
}
// Função para editar notas de um aluno existente
function editarNotasAluno(&$alunos) {
    if (count($alunos) > 0) {
        echo "Digite o nome do aluno para editar: ";
        $busca = strtolower(trim(fgets(STDIN)));
        $encontrado = false;
        foreach ($alunos as &$aluno) {
            if (strpos(strtolower($aluno['Nome']), $busca) !== false) {
                echo "Aluno encontrado: {$aluno['Nome']}\n";
                echo "Nova Nota 1: ";
                do {
                    $entrada = trim(fgets(STDIN));
                    if (!is_numeric($entrada) || $entrada < 0 || $entrada > 20) {
                        echo "[ERRO] Nota deve ser um número entre 0 e 20. Tente novamente: ";
                    }
                } while (!is_numeric($entrada) || $entrada < 0 || $entrada > 20);
                $nota1 = (float)$entrada;

                echo "Nova Nota 2: ";
                do {
                    $entrada = trim(fgets(STDIN));
                    if (!is_numeric($entrada) || $entrada < 0 || $entrada > 20) {
                        echo "[ERRO] Nota deve ser um número entre 0 e 20. Tente novamente: ";
                    }
                } while (!is_numeric($entrada) || $entrada < 0 || $entrada > 20);
                $nota2 = (float)$entrada;

                echo "Nova Nota 3: ";
                do {
                    $entrada = trim(fgets(STDIN));
                    if (!is_numeric($entrada) || $entrada < 0 || $entrada > 20) {
                        echo "[ERRO] Nota deve ser um número entre 0 e 20. Tente novamente: ";
                    }
                } while (!is_numeric($entrada) || $entrada < 0 || $entrada > 20);
                $nota3 = (float)$entrada;

                $aluno['Nota 1'] = $nota1;
                $aluno['Nota 2'] = $nota2;
                $aluno['Nota 3'] = $nota3;
                $aluno['Media'] = calcularMedia($nota1, $nota2, $nota3);
                
                if ($aluno['Media'] >= 16) {
                   $aluno['Estado'] = "Dispensado";
                    } else if ($aluno['Media'] >= 10) {
                        $aluno['Estado'] = "Aprovado";
                    } else {
                    $aluno['Estado'] = "Reprovado";
                }

                echo "Notas atualizadas com sucesso!\n";
                $encontrado = true;
                break;
            }
        }
        if (!$encontrado) {
            echo "Aluno não encontrado.\n";
        }
    } else {
        echo "Nenhum estudante cadastrado.\n";
    }
}

// Função para listar aprovados e reprovados
function listarAprovadosReprovados($alunos) {
    if (count($alunos) > 0) {
        echo "--- APROVADOS ---\n";
        foreach ($alunos as $aluno) {
            if ($aluno['Estado'] === "Aprovado") {
                echo "{$aluno['Nome']} | Média: {$aluno['Media']}\n\n";
            }
        }
        echo "===== REPROVADOS =====\n";
        foreach ($alunos as $aluno) {
            if ($aluno['Estado'] === "Reprovado") {
                echo "{$aluno['Nome']} | Média: {$aluno['Media']}\n";
            }
        }
    } else {
        echo "Nenhum estudante cadastrado.\n";
    }
}

// Função para salvar alunos em arquivo txt
function salvarAlunosArquivo($alunos, $arquivo) {
    $dados = "";
    foreach ($alunos as $aluno) {
        $dados .= implode("|", $aluno) . "\n";
    }
    file_put_contents($arquivo, $dados);
}

// Função para carregar alunos de arquivo txt
function carregarAlunosArquivo($arquivo) {
    $alunos = [];
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
    return $alunos; 
}

//Lista dos Alunos Dispensados
function listarDispensado($alunos) {
    echo "=============================\n";
    echo "ALUNOS DISPENSADOS (Média > 16)\n";
    echo "=============================\n";
    $temDispensado = false;

    foreach ($alunos as $aluno) {
        if ($aluno['Media'] > 16) {
            echo "Nome: {$aluno['Nome']}\n";
            echo "Turma: {$aluno['Turma']}\n";
            echo "Média: {$aluno['Media']}\n";
            echo "==================================\n";
            $temDispensado = true;
        }
    }

    if (!$temDispensado) {
        echo "Nenhum aluno dispensado.\n";
    }
}

//Lista de pessimos alunos
function listarPessimosalunos($alunos){
    if($alunos > 0){
        echo "=============================\n";
        echo "PESSIMOS ALUNOS (Média < 10)\n";
        echo "=============================\n";
        $temPessi = false;

            foreach($alunos as $aluno){
                if ($aluno["Media"] < 10) {
                    echo "Nome: {$aluno['Nome']}\n";
                    echo "Turma: {$aluno['Turma']}\n";
                    echo "Media: {$aluno['Media']}\n";
                    echo "Estado: {$aluno['Estado']}\n";
                    echo "Situação: Pessima\n";
                    echo "===============================\n\n";
                    $temPessi = true;
                }
            }

            if (!$temPessi){
                echo "Nenhum estudante foi encontrado\n";
            }

        }else{
            echo"Nenhum estudante cadastrado";
        }   
}



function procurarEstudantePorNome($alunos) {
    if (count($alunos) > 0) {
        echo "Digite o nome do estudante para procurar: ";
        $busca = strtolower(trim(fgets(STDIN)));
        $encontrado = false;
        foreach ($alunos as $aluno) {
            if (strpos(strtolower($aluno['Nome']), $busca) !== false) {
                echo "\nEstudante encontrado:\n";
                echo "Nome do aluno: {$aluno['Nome']}\n";
                echo "Nome da turma: {$aluno['Turma']}\n";
                echo "Nota 1: {$aluno['Nota 1']}\n";
                echo "Nota 2: {$aluno['Nota 2']}\n";
                echo "Nota 3: {$aluno['Nota 3']}\n";
                echo "Media Final: {$aluno['Media']}\n";
                echo "==============================\n";
                $encontrado = true;
            }
        }
        if (!$encontrado) {
            echo "Nenhum estudante encontrado com esse nome.\n";
        }
    } else {
        echo "Nenhum estudante cadastrado.\n";
    }
}

// Função para mostrar maior e menor nota
function mostrarMaiorMenorNota($alunos) {
    if (count($alunos) > 0) {
        $maiornota = null;
        $menornota = null;
        $alunomaior = "";
        $alunomenor = "";
        
        foreach($alunos as $aluno){
            // Verifica o aluno com a maior nota e menor nota considerando todas as notas
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
        echo "=============================\n\n";


        
        } else {
      echo "Nenhuma nota cadastrada.\n";
    }
}

function calcularmediageral($alunos){
      if (count($alunos) > 0) {
                $medias = array_column($alunos, 'Media');
                $media_geral = round(array_sum($medias) / count($medias), 1);
                echo "Média geral da turma: $media_geral\n";
            } else {
                echo "Nenhum estudante cadastrado.\n";
            }
}

function listarAlunosPorNota($alunos) {
    if (count($alunos) > 0) {
        echo "=============================\n";
        echo "ALUNOS COM MEDIA MAIOR QUE 16\n";
        echo "=============================\n";
        $temMaior = false;
        foreach ($alunos as $aluno) {
            if ($aluno['Media'] > 16) {
                echo "Nome: {$aluno['Nome']}\n";
                echo "Turma: {$aluno['Turma']}\n";
                echo "Média: {$aluno['Media']}\n";
                echo "-----------------------------\n";
                $temMaior = true;
            }
        }
        
        if (!$temMaior) {
            echo "Nenhum aluno com média maior que 16.\n";
        }

        echo "\n=============================\n";
        echo "ALUNOS COM MEDIA MENOR OU IGUAL A 16\n";
        echo "=============================\n";
        $temMenor = false;
        foreach ($alunos as $aluno) {
            if ($aluno['Media'] <= 16) {
                echo "Nome: {$aluno['Nome']}\n";
                echo "Turma: {$aluno['Turma']}\n";
                echo "Média: {$aluno['Media']}\n";
                echo "-----------------------------\n";
                $temMenor = true;
            }
        }
        if (!$temMenor) {
            echo "Nenhum aluno com média menor ou igual a 16.\n";
        }
    } else {
        echo "Nenhum estudante cadastrado.\n";
    }
}

//Para apagar o aluno pelo nome.
function apagarRegistroEstudante(&$alunos) {
    if (count($alunos) > 0) {
        echo "Digite o nome do estudante que deseja apagar: ";
        $busca = strtolower(trim(fgets(STDIN)));
        $removido = false;

        foreach ($alunos as $i => $aluno) {
            // Procura nome parcial (ex: "ana" encontra "Ana Silva")
            if (strpos(strtolower($aluno['Nome']), $busca) !== false) {
                echo "\nEstudante encontrado: {$aluno['Nome']}\n";
                echo "Deseja realmente apagar este registro? (s/n): ";
                $confirm = strtolower(trim(fgets(STDIN)));

                if ($confirm === 's') {
                    unset($alunos[$i]);
                    echo "Estudante {$aluno['Nome']} removido com sucesso.\n";
                    $removido = true;
                } else {
                    echo "Operação cancelada para {$aluno['Nome']}.\n";
                }
            }
        }

        if (!$removido) {
            echo "\nNenhum estudante encontrado com esse nome.\n";
        } else {
            // Reindexa o array para evitar índices quebrados
            $alunos = array_values($alunos);
        }
    } else {
        echo "Nenhum estudante cadastrado.\n";
    }
}

function listarmelhoresestudantes($alunos){
   if (count($alunos) > 0) {
         $maiornotaa = null;
        $menornotaa = null;
        $alunomaiorr = "";
        $alunomenorr = "";
       
       
        foreach($alunos as $aluno){
            // Verifica o aluno com a maior nota e menor nota considerando todas as notas
            foreach (['Nota 1', 'Nota 2', 'Nota 3'] as $key) {
                if ($maiornotaa === null || $aluno[$key] > $maiornotaa) {
                    $maiornotaa = $aluno[$key];
                    $alunomaiorr = $aluno['Nome'];
                }
              
            }
        }
        
        echo "=============================\n";
        echo "ALUNO COM MAIOR NOTA\n";
        echo "=============================\n";
        echo "Nome do aluno: $alunomaiorr\n";
        echo "Nota do aluno: $maiornotaa\n";
        echo "=============================\n\n";
        
    
        echo "=============================\n";
        echo "MELHORES DOS MELHORES ALUNOS DA TURMA\n";
        echo "=============================\n";
        $temMaiorm = false;
        foreach ($alunos as $aluno) {
            if ($aluno['Media'] > 16) {
                echo "Nome: {$aluno['Nome']}\n";
                echo "Turma: {$aluno['Turma']}\n";
                echo "Nota 1: {$aluno['Nota 1']}\n";
                echo "Nota 2: {$aluno['Nota 2']}\n";
                echo "Nota 3: {$aluno['Nota 3']}\n";
                echo "Média: {$aluno['Media']}\n";
                echo "Estado: {$aluno['Estado']}\n";
                echo "-----------------------------\n";
                $temMaiorm = true;
            }
        }
        
        if (!$temMaiorm) {
            echo "Nenhum aluno com média maior que 18.\n";
        }
         echo "=============================\n";
        echo "MELHORES ALUNOS\n";
        echo "=============================\n";
        $temMaior = false;
        foreach ($alunos as $aluno) {
            if ($aluno['Media'] >= 14 && $aluno['Media'] <= 16) {
                echo "Nome: {$aluno['Nome']}\n";
                echo "Turma: {$aluno['Turma']}\n";
                echo "Nota 1: {$aluno['Nota 1']}\n";
                echo "Nota 2: {$aluno['Nota 2']}\n";
                echo "Nota 3: {$aluno['Nota 3']}\n";
                echo "Média: {$aluno['Media']}\n";
                echo "Estado: {$aluno['Estado']}\n";
                echo "-----------------------------\n";
                $temMaior = true;
            }
        }
        
        if (!$temMaior) {
            echo "Nenhum aluno com média maior que 16.\n";
        }
         echo "=============================\n";
        echo "ALUNOS REGULAR\n";
        echo "=============================\n";
        $temMaiors = false;
        foreach ($alunos as $aluno) {
            if ($aluno['Media'] >= 10 && $aluno['Media'] < 14 ) {
                echo "Nome: {$aluno['Nome']}\n";
                echo "Turma: {$aluno['Turma']}\n";
                echo "Nota 1: {$aluno['Nota 1']}\n";
                echo "Nota 2: {$aluno['Nota 2']}\n";
                echo "Nota 3: {$aluno['Nota 3']}\n";
                echo "Média: {$aluno['Media']}\n";
                echo "Estado: {$aluno['Estado']}\n";
                echo "-----------------------------\n";
                $temMaiors = true;
            }
        }
        
        if (!$temMaiors) {
            echo "Nenhum aluno com média maior que 16.\n";
        }

        echo "\n=============================\n";
        echo "PIORES ALUNOS\n";
        echo "=============================\n";
        $temMenor = false;
        foreach ($alunos as $aluno) {
            if ($aluno['Media'] > 3 && $aluno['Media'] < 9) {
                echo "Nome: {$aluno['Nome']}\n";
                echo "Turma: {$aluno['Turma']}\n";
                echo "Nota 1: {$aluno['Nota 1']}\n";
                echo "Nota 2: {$aluno['Nota 2']}\n";
                echo "Nota 3: {$aluno['Nota 3']}\n";
                echo"Media Final: {$aluno['Media']}\n";
                echo "Estado: {$aluno['Estado']}\n";
                echo "-----------------------------\n";
                $temMenor = true;
            }
        }
        if (!$temMenor) {
            echo "Nenhum Pior Aluno foi encontrado.\n";
        }      
        
        echo "\n=============================\n";
        echo "PIORES DOS PIORES ALUNOS\n";
        echo "=============================\n";
        $temMenora = false;
        foreach ($alunos as $aluno) {
            if ($aluno['Media'] <= 3) {
                echo "Nome: {$aluno['Nome']}\n";
                echo "Turma: {$aluno['Turma']}\n";
                echo "Nota 1: {$aluno['Nota 1']}\n";
                echo "Nota 2: {$aluno['Nota 2']}\n";
                echo "Nota 3: {$aluno['Nota 3']}\n";
                echo "Média: {$aluno['Media']}\n";
                echo "Estado: {$aluno['Estado']}\n";
                echo "-----------------------------\n";
                $temMenora = true;
            }
        }
        if (!$temMenora) {
            echo "Nenhum aluno que é Piores dos piores.\n";
        }      

        
        } else {
      echo "Nenhuma nota cadastrada.\n";
    }
}



//Quantos estudantes existem.
function contarAlunos($alunos){
    $total = count($alunos);
    echo "O total de alunos cadastrados: $total\n";
}

// Array para armazenar os estudantes
$arquivo = __DIR__ . '/alunos.txt';
$alunos = carregarAlunosArquivo($arquivo);

// Loop principal do menu
while (true) {
    // Exibe o menu principal
    echo "=============================\n";
    echo "Sistema de Gestão de Notas\n";
    echo "=============================\n";
    echo "1. Registrar Estudantes e Notas\n";
    echo "2. Listar Estudantes e notas\n";
    echo "3. Calcular Media Geral\n";
    echo "4. Procurar Estudante por nome\n";
    echo "5. Mostrar Maior nota e a Menor Nota\n";
    echo "6. Editar notas de um aluno\n";
    echo "7. Lista dos aprovados e reprovados.\n";
    echo "8. Lista de alunos com Media Que 16 e Menor ou igual que 16;\n";
    echo "9. Apagar o estudante pelo nome.\n";
    echo "10. Mostrar total de alunos cadastrado.\n";
    echo "11. Mostra os estudante Dispensados\n";
    echo "12. Mostrar Lista dos Pessimos Alunos.\n";
    echo "13. Lista dos melhores e dos Piores.\n";
    echo "0. Sair\n\n";

    // Recebe a opção do usuário e valida entrada
    $opcao = null;
    do {
        echo "Escolher uma opção (0-12): ";
        $input = trim(fgets(STDIN));
        if (is_numeric($input) && $input >= 0 && $input <= 13) {
            $opcao = (int)$input;
        } else {
            echo "\n[ERRO] Opção inválida! Digite um número de 0 a 13.\n";
        }
    } while ($opcao === null);

    // Switch para tratar as opções do menu
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
            echo "Opção Invalida! Escolha a opção certa.\n";
            break;
    }
}
?>