<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Discipline;

class QuestionsSeeder extends Seeder
{
    public function run(): void
    {
        // Buscar todas as disciplinas
        $disciplines = Discipline::all();

        // Questões reais por disciplina
        $questionsBank = [
            'Banco de Dados' => [
                ['question' => 'O que significa a sigla SQL?', 'options' => ['Structured Query Language', 'Simple Question Language', 'Standard Query List'], 'correct' => 0],
                ['question' => 'Qual comando SQL é usado para recuperar dados de um banco de dados?', 'options' => ['SELECT', 'GET', 'FETCH'], 'correct' => 0],
                ['question' => 'O que é uma chave primária (Primary Key)?', 'options' => ['Identificador único de um registro', 'Campo obrigatório', 'Campo numérico'], 'correct' => 0],
                ['question' => 'Qual comando é usado para adicionar novos dados em uma tabela?', 'options' => ['INSERT', 'ADD', 'CREATE'], 'correct' => 0],
                ['question' => 'O que faz o comando DELETE em SQL?', 'options' => ['Remove registros de uma tabela', 'Apaga o banco de dados', 'Cria uma tabela'], 'correct' => 0],
                ['question' => 'Para que serve a cláusula WHERE?', 'options' => ['Filtrar resultados', 'Ordenar resultados', 'Agrupar resultados'], 'correct' => 0],
                ['question' => 'O que é normalização de banco de dados?', 'options' => ['Processo de organizar dados para reduzir redundância', 'Processo de backup', 'Processo de indexação'], 'correct' => 0],
                ['question' => 'Qual tipo de relacionamento conecta uma tabela a si mesma?', 'options' => ['Auto-relacionamento', 'Relacionamento circular', 'Relacionamento reverso'], 'correct' => 0],
                ['question' => 'O que é um índice em banco de dados?', 'options' => ['Estrutura que melhora a velocidade de consultas', 'Tipo de dado', 'Comando SQL'], 'correct' => 0],
                ['question' => 'Qual comando atualiza dados existentes em uma tabela?', 'options' => ['UPDATE', 'MODIFY', 'CHANGE'], 'correct' => 0],
            ],
            'Algoritmos' => [
                ['question' => 'O que é um algoritmo?', 'options' => ['Sequência de passos para resolver um problema', 'Linguagem de programação', 'Tipo de dado'], 'correct' => 0],
                ['question' => 'Qual estrutura de dados funciona como LIFO (Last In, First Out)?', 'options' => ['Pilha (Stack)', 'Fila (Queue)', 'Lista'], 'correct' => 0],
                ['question' => 'O que é complexidade de tempo Big O?', 'options' => ['Medida de eficiência de um algoritmo', 'Tempo de execução real', 'Tamanho do código'], 'correct' => 0],
                ['question' => 'Qual algoritmo de ordenação é mais eficiente na média?', 'options' => ['Quick Sort', 'Bubble Sort', 'Selection Sort'], 'correct' => 0],
                ['question' => 'O que é recursão?', 'options' => ['Função que chama a si mesma', 'Loop infinito', 'Erro de programação'], 'correct' => 0],
                ['question' => 'Qual estrutura de dados funciona como FIFO (First In, First Out)?', 'options' => ['Fila (Queue)', 'Pilha (Stack)', 'Árvore'], 'correct' => 0],
                ['question' => 'O que é busca binária?', 'options' => ['Algoritmo de busca em lista ordenada', 'Conversão para binário', 'Tipo de ordenação'], 'correct' => 0],
                ['question' => 'Qual a complexidade do Bubble Sort no pior caso?', 'options' => ['O(n²)', 'O(n)', 'O(log n)'], 'correct' => 0],
                ['question' => 'O que é uma árvore binária?', 'options' => ['Estrutura onde cada nó tem no máximo 2 filhos', 'Árvore com valores binários', 'Tipo de grafo'], 'correct' => 0],
                ['question' => 'Para que serve o algoritmo de Dijkstra?', 'options' => ['Encontrar o caminho mais curto em grafos', 'Ordenar arrays', 'Buscar elementos'], 'correct' => 0],
            ],
        ];

        foreach ($disciplines as $discipline) {
            // Pegar as questões da disciplina ou usar questões genéricas
            $questions = $questionsBank[$discipline->name] ?? $questionsBank['Banco de Dados'];
            
            foreach ($questions as $index => $q) {
                // Criar resposta temporária
                $tempResponseId = DB::table('responses')->insertGetId([
                    'response' => 'TEMP',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Criar a questão
                $questionId = DB::table('questions')->insertGetId([
                    'question' => $q['question'],
                    'correct_response_id' => $tempResponseId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $correctResponseId = null;

                // Criar as 3 opções
                foreach ($q['options'] as $optIndex => $optText) {
                    $responseId = DB::table('responses')->insertGetId([
                        'response' => $optText,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Marcar a resposta correta
                    if ($optIndex === $q['correct']) {
                        $correctResponseId = $responseId;
                    }

                    // Relacionar questão com resposta
                    $questionResponseId = DB::table('question_response')->insertGetId([
                        'question_id' => $questionId,
                        'response_id' => $responseId,
                        'score' => $optIndex === $q['correct'] ? 1.0 : 0.0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Vincular à disciplina via A2 (apenas a resposta correta)
                    if ($optIndex === $q['correct']) {
                        DB::table('a2')->insert([
                            'discipline_id' => $discipline->id,
                            'question_response_id' => $questionResponseId,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }

                // Atualizar a questão com a resposta correta
                DB::table('questions')
                    ->where('id', $questionId)
                    ->update(['correct_response_id' => $correctResponseId]);

                // Deletar a resposta temporária
                DB::table('responses')->where('id', $tempResponseId)->delete();
            }
        }
    }
}
