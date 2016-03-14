<?php
/**
 * Plugin noprint: Disables printing section of pages
 *
 * Syntax: <noprint>...</noprint> encloses the hidden part of the page when printed
 * 
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Dennis Ploeger (<develop@dieploegers.de>)
 */

if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');

class syntax_plugin_noprint extends DokuWiki_Syntax_Plugin {

   /**
    * Get the type of syntax this plugin defines.
    *
    * @param none
    * @return String 
    * @public
    * @static
    */
    function getType(){
        return 'substition';
    }

    /**
     * What modes are allowed within our mode?
     */
    function getAllowedTypes() {
        return array('substition','protected','disabled','formatting');
    }

   /**
    * Define how this plugin is handled regarding paragraphs.
    *
    * @param none
    * @return String <tt>'block'</tt>.
    * @public
    * @static
    */
    function getPType(){
        return 'block';
    }
 
   /**
    * Where to sort in?
    *
    * @param none
    * @return Integer <tt>6</tt>.
    * @public
    * @static
    */
    function getSort(){
        return 999;
    }
 
 
   /**
    * Connect lookup pattern to lexer.
    *
    * @param $aMode String The desired rendermode.
    * @return none
    * @public
    * @see render()
    */
    function connectTo($mode) {

        $this->Lexer->addSpecialPattern('<noprint>',$mode,'plugin_noprint');
        $this->Lexer->addSpecialPattern('</noprint>',$mode,'plugin_noprint');

    }
 
   /**
    * Handler to prepare matched data for the rendering process.
    *
    * @param $aMatch String The text matched by the patterns.
    * @param $aState Integer The lexer state for the match.
    * @param $aPos Integer The character position of the matched text.
    * @param $aHandler Object Reference to the Doku_Handler object.
    * @return Integer The current lexer state for the match.
    * @public
    * @see render()
    * @static
    */
    function handle($match, $state, $pos, Doku_Handler $handler){

        return array($match, $state);

    }
 
   /**
    * Handle the actual output creation.
    *
    * @param $aFormat String The output format to generate.
    * @param $aRenderer Object A reference to the renderer object.
    * @param $aData Array The data created by the <tt>handle()</tt>
    * method.
    * @return Boolean <tt>TRUE</tt> if rendered successfully, or
    * <tt>FALSE</tt> otherwise.
    * @public
    * @see handle()
    */
    function render($mode, Doku_Renderer $renderer, $data) {

        if ($mode == 'xhtml'){

            $open = true;

            if (preg_match("/<\//", $data[0])) {

                $open = false;

            }

            switch ($open) {
                case true:
                    $renderer->doc .= "<span id=\"noprint\">";
                    break;
                case false:
                    $renderer->doc .= "</span>";
                    break;
            }
            return true;
        }
        return false;
    }
}
 
//Setup VIM: ex: et ts=4 enc=utf-8 :
?>
