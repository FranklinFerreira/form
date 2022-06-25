<?php
/**
 * Teste 05:
 * 
 * Este teste requer o uso de banco de dados e a importaзгo do arquivo "db_teste_5.sql"
 * 
 * Este banco de dados possui uma ъnica tabela chamada "categorias" com alguns registros inseridos nela.
 * 
 * Essa tabela representa categorias de uma loja online.
 * 
 * Essa tabela possui a coluna "dona" que serve como "chave estrangeira" para si mesmo.
 * Quando o valor de "dona" for 0, significa que o registro й de uma categoria primбria. 
 * 
 * Por Exemplo:
 * Categoria 01 (id = 1, dona = 0 - categoria primбria)
 * Categoria 02 (id = 2, dona = 0 - categoria primбria)
 * 
 * SubCategoria A (id = 3, dona = 1 - categoria secundбria ou subcategoria de "Categoria 01")
 * SubCategoria B (id = 4, dona = 1 - categoria secundбria ou subcategoria de "Categoria 01")
 * 
 * SubCategoria X (id = 5, dona = 2 - categoria secundбria ou subcategoria de "Categoria 02")
 * SubCategoria Y (id = 6, dona = 2 - categoria secundбria ou subcategoria de "Categoria 02")
 * 
 * SubDeSubCategoria Y1 (id = 7, dona = 6 - subcategoria de "SubCategoria Y" que por sua vez jб й subcategoria de "Categoria 02")
 * 
 * ##
 * 
 * Essa representaзгo do exemplo gera uma бrvore com a seguinte estrutura
 * 
 * | - Categoria 01
 * |       |------- SubCategoria A 
 * |       |------- SubCategoria B 
 * | - Categoria 02
 * |       |------- SubCategoria X
 * |       |------- SubCategoria Y
 * |                    | ---------- SubDeSubCategoria Y1
 * 
 * 
 * 
 * Essa tabela possui a coluna "ativa" que recebe o valor de "s" para categorias ativas, e "n" para categorias inativas.
 * Quando uma categoria for desativada, todas as suas subcategorias, indiferente do "nнvel de profundidade" da бrvore tambйm sгo consideradas inativas
 * 
 * 
 * O objetivo deste teste й escrever o cуdigo da funзгo "ArvoreCategoriasAtivas", que retorne as categorias do banco de dados jб estruturadas como uma бrvore.
 * Essa funзгo deve:
 *  - Fazer o mнnimo de consultas possнveis no banco de dados
 *  - Somente considerar categorias ativas
 *  - Ordenar categorias pelo nome
 * 
 */


//a variavel abaixo mostra um retorno esperado para o exemplo acima:
// var_dump($indice_turmas);
// $arvore_exemplo = array(
//     array(
//         'nome'=>'Categoria 01',
//         'categorias'=>array(
//             array(
//                 'nome'=>'SubCategoria A',
//                 'categorias'=>array()
//             ),
//             array(
//                 'nome'=>'SubCategoria B',
//                 'categorias'=>array()
//             )
//         )
//     ),
//     array(
//         'nome'=>'Categoria 02',
//         'categorias'=>array(
//             array(
//                 'nome'=>'SubCategoria X',
//                 'categorias'=>array()
//             ),
//             array(
//                 'nome'=>'SubCategoria Y',
//                 'categorias'=>array(
//                     array(
//                         'nome'=>'SubDeSubCategoria Y1',
//                         'categorias'=>array()
//                     )
//                 )
//             )
//         )
//     )
// );


//Obs: Todas as categorias inseridas no banco de dados estгo ativas, vocк pode desativar elas como preferir para testar sua funзгo
//Funзгo a ser escrita:
function ArvoreCategoriasAtivas(){

    $host = "localhost";
    $usuario = "root";
    $senha = "";
    $conexao = mysql_connect($host, $usuario, $senha) or die("A conexao falhou"); //conexao banco servidor
    mysql_select_db("teste_ideaGood", $conexao) or die ("A conexao com o banco falhou");//conexao banco da aplicaзгo
    
    $sql = "SELECT * FROM categorias WHERE ativa='s' ORDER BY nome";
    $resultado = mysql_query($sql) or die ("erro BD");
    $arvore_cat = array();
    $i = 1;
    while ( $registro = mysql_fetch_array($resultado) )
    {
        $arvore_cat[$i]['id'] = $registro["id"];
        $arvore_cat[$i]['id_pai'] = $registro["dona"];
        $arvore_cat[$i]['nome'] = $registro["nome"];
        $i++;
    }
    mysql_free_result($resultado);
    return $arvore_cat;
}
$arvore_resultado = ArvoreCategoriasAtivas();
print_r($arvore_resultado);
?>