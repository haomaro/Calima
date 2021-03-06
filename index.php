<?php

/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * @category   
 * @package    root
 * @copyright  Copyright (c) 2006 - 2014 webcol.net (http://www.webcol.net/calima)
 * @license	https://github.com/webcol/Calima/blob/master/LICENSE	MIT
 * @version	##BETA 1.0##, ##2014 - 2015##
 * <http://www.calimaframework.com>.
 */

require_once __DIR__.'/vendor/autoload.php';

use Sistema\Nucleo;
use Sistema\Ayudantes;
//use mvc\controladores;

//lenguaje

/*session_start();
$sesion=new Sistema\Nucleo\CFSesion();
$sesion->iniciarSesion('_s', false);
header('Cache-control: private'); // IE 6 FIX
 */



/** Cf directorio separador */
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
/** Cf raiz del sitio */
defined('SITE_ROOT')? null: define('SITE_ROOT', realpath(dirname(__FILE__)).DS);
/** Cf PATH del sitio */
defined('SITE_PATH') ? NULL : define ('SITE_PATH', realpath(dirname(__FILE__) . DS . '..' . DS) . DS);

/** Cf definimos constante Ruta directa al nucleo de framework  */
define('RUTA_NUCLEO', SITE_ROOT . 'Sistema'.DS.'Nucleo' . DS);

# define para mvc erp

/** Cf definimos constante  directa a la vista del framework  */
define('VIEW_PATH', SITE_ROOT . 'mvc'.DS.'vistas' . DS);
/** Cf definimos constante  directa a los controladores del framework  */
define('CONTR_PATH', SITE_ROOT . 'mvc'.DS.'controladores' . DS);
/** Cf definimos constante  directa a los modelos del framework  */
define('RUTA_MOD', SITE_ROOT . 'mvc'.DS.'modelos' . DS);

# define ruta a los stilos del public

/** Cf definimos constante  directa a los css dentro del directorio public_ del framework  */
define('CSS_PATH', SITE_ROOT . 'public_'.DS.'css' . DS);
/** Cf definimos constante  directa a los css dentro del directorio public_ del framework  */
define('IMG_PATH', SITE_ROOT . 'public_'.DS.'img' . DS);
/** Cf definimos constante  directa a los js dentro del directorio public_ del framework  */
define('JS_PATH', SITE_ROOT . 'public_'.DS.'js' . DS);
/** Cf definimos constante  directa a las librerias dentro  del framework  */
define('RUTA_LIBS', SITE_ROOT . 'Sistema'.DS.'librerias' . DS);
/** Cf definimos constante  directa a los ayudantes del framework  */
define('RUTA_AYUDANTES', SITE_ROOT . 'Sistema'.DS.'ayudantes' . DS);

/** Cf definimos constante  directa a los lenguajes del framework  */
define('RUTA_LENGUAJES', SITE_ROOT . 'Sistema'.DS.'lenguajes' . DS);


//LENGUAJES
//En el directorio sistema lenguajes hay varios archivos php cada uno para crear las constantes en el idioma especifico
//luego por get capturamos la variable lan al inicio de la aplicacion asi: www.tuapp.com/?lang=de

if(isSet($_GET['lang']))
{
    $lang = $_GET['lang'];
 
// register the session and set the cookie
    $_SESSION['lang'] = $lang;
 
    setcookie('lang', $lang, time() + (3600 * 24 * 30));
}
else if(isSet($_SESSION['lang']))
{
    $lang = $_SESSION['lang'];
}
else if(isSet($_COOKIE['lang']))
{
    $lang = $_COOKIE['lang'];
}
else
{
    $lang = 'es'; // por defecto el idioma para el app es español puede ser en, bt, de, zh
}
 
switch ($lang) {
  case 'en':
  $lang_file = 'lang.en.php';
  break;
 
  case 'de':
  $lang_file = 'lang.de.php';
  break;

  case 'zh':
  $lang_file = 'lang.zh.php';
  break;

  case 'pt':
  $lang_file = 'lang.pt.php';
  break;

  case 'pt':
  $lang_file = 'lang.pt.php';
  break;

  case 'es':
  $lang_file = 'lang.es.php';
  break;
 
  default:
  $lang_file = 'lang.en.php';
 
}
 
include_once RUTA_LENGUAJES . $lang_file;

//FIN LENGUAJES



#Firewall desactivado

/*define('PHP_FIREWALL_REQUEST_URI', strip_tags( $_SERVER['REQUEST_URI'] ) );
define('PHP_FIREWALL_ACTIVATION', true );
if ( is_file( @dirname(__FILE__).'RUTA_LIBS'.DS.'php-firewall'.DS.'firewall.php' ) )
	include_once( @dirname(__FILE__).'RUTA_LIBS'.DS.'php-firewall'.DS.'firewall.php' );*/

# Cargamos la autocarga dinamica y configuraciones
//require_once RUTA_NUCLEO . 'Cf_Autocarga.php';
require_once RUTA_NUCLEO . 'CFConfiguracion.php';

try{
   
    Nucleo\CFBootstrap::actuar(new Nucleo\CFSolicitud);
    //CFBootstrap::actuar(new CFSolicitud);
   
} catch (Exception $e) {
    echo $e->getMessage();
}

/*try{
  CfBootstrap::actuar(new Cf_Solicitud);
}
catch(Exception $e){
   
}*/