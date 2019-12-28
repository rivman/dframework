<?php
/**
 * dFramework
 *
 * The simplest PHP framework for beginners
 * Copyright (c) 2019, Dimtrov SARL
 * This content is released under the Mozilla Public License 2 (MPL-2.0)
 *
 * @package	    dFramework
 * @author	    Dimitric Sitchet Tomkeu <dev.dimitrisitchet@gmail.com>
 * @copyright	Copyright (c) 2019, Dimtrov SARL. (https://dimtrov.hebfree.org)
 * @copyright	Copyright (c) 2019, Dimitric Sitchet Tomkeu. (https://www.facebook.com/dimtrovich)
 * @license	    https://opensource.org/licenses/MPL-2.0 MPL-2.0 License
 * @link	    https://dimtrov.hebfree.org/works/dframework
 * @version 2.0
 */

/**
 * Layout
 *
 * Responsible for sending final output to the browser.
 *
 * @class       Layout
 * @package		dFramework
 * @subpackage	Core
 * @category    Output
 * @author		Dimitri Sitchet Tomkeu <dev.dimitrisitchet@gmail.com>
 * @link		https://dimtrov.hebfree.org/works/dframework/docs/systemcore/renderer
 * @file		/system/core/output/Layout.php
 */

namespace dFramework\core\output;

use \dFramework\core\Config;
use \dFramework\core\route\Dispatcher;
use dFramework\core\utilities\Tableau;
use phpDocumentor\Reflection\Types\Void_;

/**
 * Class Layout
 */
class Layout
{
    /**
     * @var string
     */
    private static $_layout = 'default';

    private static $_output = '';

    private static $_vars = [];



    private $class = '';


    /**
     * Layout constructor.
     * @param string $layout
     * @param array|null $vars
     */
    public function __construct(string $layout = 'default', ?array $vars = [])
    {
        self::$_layout = $layout;
        $this->putVar($vars);

        $controller = Dispatcher::getController();
        $class = Dispatcher::getClass();
        $method = Dispatcher::getMethod();

        $class = (!empty($class)) ? $class : Config::get('route.default_controller');
        $method = (!empty($method)) ? $method : 'Index';
        $controller = (empty($controller)) ? '' : $controller . '/';

        $this->class = $class;

        self::$_vars['pageTitle'] = ucfirst($method) . ' - ' . ucfirst($class);

    }

    /**
     * Ajoute une vue au template
     *
     * @param $view
     * @param array $vars
     * @return Layout
     */
    public function add($view, array $vars = []) : self
    {
        $view = new View($view, array_merge(self::$_vars, $vars), $this->class);
        self::$_output .=  $view->get(false);
        return $this;
    }

    /**
     * Lance la page finale
     */
    public function launch()
    {
        $view = new View('..'.DS.'layouts'.DS.self::$_layout, self::$_vars);
        $view->render();
    }

    /**
     * Injecte du contenu au code final
     *
     * @param string $content
     * @return Layout
     */
    public function inject(string $content) : self
    {
        self::$_output .= $content;
        return $this;
    }

    /**
     * Ajoutr une variable globale accessible au layout et aux vues
     *
     * @param array $vars
     * @return Layout
     */
    public function putVar(array $vars) : self
    {
        self::$_vars = array_merge(self::$_vars, $vars);
        return $this;
    }
    /**
     * Recupere une variable globale depuis une vue
     *
     * @param null|string $var
     * @return array
     */
    public static function vars(?string $var = null)
    {
        $vars = self::$_vars;
        $vars = Tableau::remove($vars, 'css');
        $vars = Tableau::remove($vars, 'js');
        $vars = Tableau::remove($vars, 'lib_css');
        $vars = Tableau::remove($vars, 'lib_js');

        if(null !== $var)
        {
            return $vars[$var] ?? [];
        }
        return $vars;
    }

    /**
     * @param string ...$src
     * @return Layout
     */
    public function putCss(string ...$src) : self
    {
        foreach ($src As $var)
        {
            if(!isset(self::$_vars['css']) OR (isset(self::$_vars['css']) AND !in_array($var, self::$_vars['css'])))
            {
                self::$_vars['css'][] = $var;
            }
        }
        return $this;
    }
    /**
     * @param string|string[] $src
     * @return void
     */
    public static function addCss($src) : void
    {
        $src = (array) $src;
        $instance = self::instance();
        foreach ($src As $value)
        {
            $instance->putCss($value);
        }
    }

    /**
     * @param string ...$src
     * @return Layout
     */
    public function putLibCss(string ...$src) : self
    {
        foreach ($src As $var)
        {
            if(!isset(self::$_vars['lib_css']) OR (isset(self::$_vars['lib_css']) AND !in_array($var, self::$_vars['lib_css'])))
            {
                self::$_vars['lib_css'][] = $var;
            }
        }
        return $this;
    }
    /**
     * @param string|string[] $src
     * @return void
     */
    public static function addLibCss($src) : void
    {
        $src = (array) $src;
        $instance = self::instance();
        foreach ($src As $value)
        {
            $instance->putLibCss($value);
        }
    }

    /**
     * @param string ...$src
     * @return Layout
     */
    public function putJs(string ...$src) : self
    {
        foreach ($src As $var)
        {
            if(!isset(self::$_vars['js']) OR (isset(self::$_vars['js']) AND !in_array($var, self::$_vars['js'])))
            {
                self::$_vars['js'][] = $var;
            }
        }
        return $this;
    }
    /**
     * @param $src
     * @return void
     */
    public static function addJs($src) : void
    {
        $src = (array) $src;
        $instance = self::instance();
        foreach ($src As $value)
        {
            $instance->putJs($value);
        }
    }

    /**
     * @param string ...$src
     * @return Layout
     */
    public function putLibJs(string ...$src): self
    {
        foreach ($src As $var)
        {
            if(!isset(self::$_vars['lib_js']) OR (isset(self::$_vars['lib_js']) AND !in_array($var, self::$_vars['lib_js'])))
            {
                self::$_vars['lib_js'][] = $var;
            }
        }
        return $this;
    }
    /**
     * @param $src
     * @return void
     */
    public static function addLibJs($src) : void
    {
        $src = (array) $src;
        $instance = self::instance();
        foreach ($src As $value)
        {
            $instance->putLibJs($value);
        }
    }

    /**
     * @param string $title
     * @return Layout
     */
    public function setPageTitle(string $title) : self
    {
        if (!empty($title) AND is_string($title))
        {
            self::$_vars['pageTitle'] = trim(htmlspecialchars($title));
        }
        return $this;
    }

    /**
     * @param string $title
     * @return void
     */
    public static function setTitle(string $title) : void
    {
        self::instance()->setPageTitle($title);
    }
    
    /**
     * @param string $layout
     * @return Layout
     */
    public function setLayout(string $layout) : self
    {
        if(!empty($layout) AND is_string($layout))
        {
            self::$_layout = trim(htmlspecialchars($layout));
        }
        return $this;
    }



    private static $_instance = null;
    private static function instance()
    {
        if(null === self::$_instance)
        {
            self::$_instance = new Layout();
        }
        return self::$_instance;
    }

    /**
     *  Rend le code de la vue dans le layout
     */
    public static function output()
    {
        echo self::$_output;
    }
    public static function renderView()
    {
        self::output();
    }





    /**
     * @var string[]
     */
    private static $_blocks = [];

    const B_APPEND = 1;
    const B_PREPEND = 2;

    /**
     * @param string $name Le nom du block a demarrer
     * @param int $concat
     */
    public static function block(string $name, int $concat = self::B_APPEND) : void
    {
        $name = strtolower($name);
        ob_start(function ($buffer) use ($name, $concat) {
            if(isset(self::$_blocks[$name]))
            {
                if($concat == self::B_PREPEND)
                {
                    self::$_blocks[$name] = $buffer . self::$_blocks[$name] ;
                }
                else
                {
                    self::$_blocks[$name] .= $buffer;
                }
            }
            else
            {
                self::$_blocks[$name] = $buffer;
            }
        });
    }
    /**
     *
     */
    public static function end()
    {
        ob_end_clean();
    }
    /**
     * @param string $name Le nom du bloc a afficher
     * @return void
     */
    public static function show(string $name) : void
    {
        $name = strtolower($name);
        if(!empty(self::$_blocks[$name]) AND $name == 'css')
        {
            echo "<style type=\"text/css\">\n".self::$_blocks[$name]."</style>\n";
        }
        else if(!empty(self::$_blocks[$name]) AND $name = 'js')
        {
            echo "<script type=\"text/javascript\">\n".self::$_blocks[$name]."</script>\n";
        }
        else
        {
            echo self::$_blocks[$name] ?? null;
        }
    }


    /**
     * @param null|string $config
     * @return void
     */
    public static function stylesBundle(?string $config = null) : void
    {
        $config = ($config === null) ? self::$_layout : $config;
        $lib_styles = array_merge((array) Config::get('layout.'.$config.'.lib_styles'), self::$_vars['lib_css'] ?? []);
        if(!empty($lib_styles))
        {
            lib_styles($lib_styles);
        }
        $styles = array_merge((array) Config::get('layout.'.$config.'.styles'), self::$_vars['css'] ?? []);
        if(!empty($styles))
        {
            styles($styles);
        }
        self::show('css');
    }

    /**
     * @param null|string $config
     * @return void
     */
    public static function scriptsBundle(?string $config = null) : void
    {
        $config = ($config === null) ? self::$_layout : $config;
        $lib_scripts = array_merge((array) Config::get('layout.'.$config.'.lib_scripts'), self::$_vars['lib_js'] ?? []);
        if(!empty($lib_scripts))
        {
            lib_scripts($lib_scripts);
        }
        $scripts = array_merge((array) Config::get('layout.'.$config.'.scripts'), self::$_vars['js'] ?? []);
        if(!empty($scripts))
        {
            scripts($scripts);
        }
        self::show('js');
    }
}