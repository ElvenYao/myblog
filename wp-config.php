<?php
/**
 * WordPress基础配置文件。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以不使用网站，您需要手动复制这个文件，
 * 并重命名为“wp-config.php”，然后填入相关信息。
 *
 * 本文件包含以下配置选项：
 *
 * * MySQL设置
 * * 密钥
 * * 数据库表名前缀
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
define('DB_NAME', 'myblog');

/** MySQL数据库用户名 */
define('DB_USER', 'root');

/** MySQL数据库密码 */
define('DB_PASSWORD', 'MycentosMysql1989');

/** MySQL主机 */
define('DB_HOST', 'localhost');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8mb4');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/
 * WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'G{[JP`CO as:(SYXnS~xltisEZ~2!%5<UTEZ^gGvm?l[NcNy^-P>) >/`4EmS) (');
define('SECURE_AUTH_KEY',  '5Vrn=Zy/F7V<Ak}tHN=#q>^Oa=46ROjq=e7(^Dk7m2CC,ykb]b[GM+:Hf)bAs[Dp');
define('LOGGED_IN_KEY',    '.Otl&.EyZn*m4^M<4&hO8OCI5`B-Gyi(>7k ;#(O@z%v_`[$8oY&VPd.vtF-p{:;');
define('NONCE_KEY',        '|8z,J+n~eKOrXMCE:(*b~<>F?M16?+k 8msp*XSx pI]81AjIa/jh8.H7/>FIk3M');
define('AUTH_SALT',        'whMNn._&L,(Y+I0C5e[(0-rN%J0Lvwr0c7OS_+PE}a6ydKkQN%/iE`!*:xZ=.6_z');
define('SECURE_AUTH_SALT', 'b*&}(dxy*~J*.Vh*s8(%j(MvSq^sX{-%=S%Pa*$L`.=GEAOxH*@3:io(m`&x(dQ@');
define('LOGGED_IN_SALT',   '}eh]Al052hG:V*HX@%abKH@h[spQi-=XLD*ux#C3D Q0|/L$I=U,|-`OrN2Ri2g7');
define('NONCE_SALT',       'Ne:pt Qpv**sDX4OtWhSQ%:Zs%taUT.Btlc/MTBueP[R-J+ JzC}ND2{YKw^8,b[');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'blog_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *
 * 要获取其他能用于调试的信息，请访问Codex。
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/**
 * zh_CN本地化设置：启用ICP备案号显示
 *
 * 可在设置→常规中修改。
 * 如需禁用，请移除或注释掉本行。
 */
define('WP_ZH_CN_ICP_NUM', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');

/** Override default file permissions */
if(is_admin()) {
add_filter('filesystem_method', create_function('$a', 'return "direct";' ));
define( 'FS_CHMOD_DIR', 0751 );
}

define('FTP_BASE', 'wwwroot');
define('FTP_CONTENT_DIR', 'wwwroot/wp-content');
define('FTP_PLUGIN_DIR', 'wwwroot/wp-content/plugins/');
define('FTP_THEMES_DIR', 'wwwroot/wp-content/themes/');
define('FS_METHOD', 'direct');
