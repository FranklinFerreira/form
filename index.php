<?php
/**
 * Teste 05:
 * 
 * Este teste requer o uso de banco de dados e a importa��o do arquivo "db_teste_5.sql"
 * 
 * Este banco de dados possui uma �nica tabela chamada "categorias" com alguns registros inseridos nela.
 * 
 * Essa tabela representa categorias de uma loja online.
 * 
 * Essa tabela possui a coluna "dona" que serve como "chave estrangeira" para si mesmo.
 * Quando o valor de "dona" for 0, significa que o registro � de uma categoria prim�ria. 
 * 
 * Por Exemplo:
 * Categoria 01 (id = 1, dona = 0 - categoria prim�ria)
 * Categoria 02 (id = 2, dona = 0 - categoria prim�ria)
 * 
 * SubCategoria A (id = 3, dona = 1 - categoria secund�ria ou subcategoria de "Categoria 01")
 * SubCategoria B (id = 4, dona = 1 - categoria secund�ria ou subcategoria de "Categoria 01")
 * 
 * SubCategoria X (id = 5, dona = 2 - categoria secund�ria ou subcategoria de "Categoria 02")
 * SubCategoria Y (id = 6, dona = 2 - categoria secund�ria ou subcategoria de "Categoria 02")
 * 
 * SubDeSubCategoria Y1 (id = 7, dona = 6 - subcategoria de "SubCategoria Y" que por sua vez j� � subcategoria de "Categoria 02")
 * 
 * ##
 * 
 * Essa representa��o do exemplo gera uma �rvore com a seguinte estrutura
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
 * Quando uma categoria for desativada, todas as suas subcategorias, indiferente do "n�vel de profundidade" da �rvore tamb�m s�o consideradas inativas
 * 
 * 
 * O objetivo deste teste � escrever o c�digo da fun��o "ArvoreCategoriasAtivas", que retorne as categorias do banco de dados j� estruturadas como uma �rvore.
 * Essa fun��o deve:
 *  - Fazer o m�nimo de consultas poss�veis no banco de dados
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


//Obs: Todas as categorias inseridas no banco de dados est�o ativas, voc� pode desativar elas como preferir para testar sua fun��o
//Fun��o a ser escrita:
function ArvoreCategoriasAtivas(){

    $host = "localhost";
    $usuario = "root";
    $senha = "";
    $conexao = mysql_connect($host, $usuario, $senha) or die("A conexao falhou"); //conexao banco servidor
    mysql_select_db("teste_ideaGood", $conexao) or die ("A conexao com o banco falhou");//conexao banco da aplica��o
    
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