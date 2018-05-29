<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'ic_db');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** Nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'niti;eovxO5wt;vM7[^ 5c|lK}>t %Rrf*m})Jq9V04x-#$c3t:TJ^<~|g4CVU!n');
define('SECURE_AUTH_KEY',  'U#b-%An7bDTR8O1)|cp8dXWQ97fmT{(a(}zJuuzYDH*V;14XAJhYfx8X3w)FitQV');
define('LOGGED_IN_KEY',    'jnF,M(HTrzo(|s#AE&gO<GWH)NR.d6RYjASUq/L@f&5^ b|Bm:slEwi`687c;N2*');
define('NONCE_KEY',        'P2fMi<Tvcl6$_0}Eri,@SK)Z#K9aG{OHx-byEq+(yY6#pOm%}4Xq&6.-UG M~k#&');
define('AUTH_SALT',        'W|R_T$,-Fc5Ww R2*xyIl:=I-%2<q074-]t;_e ]yxyCxB[}N4Gx4=Ji]G}8]xTj');
define('SECURE_AUTH_SALT', 'Qk*<;sembv8]1&|F*_V<6!D<`ivY(*Vynsk]io;UXiM(MvLbK*[dnibvEHD5YI~2');
define('LOGGED_IN_SALT',   'M<CGO00m=UB `}gF$vP]+]>bo0@H2l8En9n/%lgeG+4@-2a$!Oyi.<,$-X[rhrAg');
define('NONCE_SALT',       '[f[1wx+7x7*f9U-7|5A9X+~?Swvw*I;qh)LyKOZV;0h}~o.jw9E/24bBnZwZu] )');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix  = 'impcer_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
