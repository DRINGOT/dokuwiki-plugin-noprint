<?php
/**
 * Insert Toolbar for noprint-Plugin
 * The toolbar image is a compound of images found at http://www.famfamfam.com
 *
 * @author Dennis Ploeger <develop@dieploegers.de>
 */
 
if (!defined('DOKU_INC')) die();
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN', DOKU_INC . 'lib/plugins/');
require_once (DOKU_PLUGIN . 'action.php');
 
class action_plugin_noprint extends DokuWiki_Action_Plugin {
 
    /**
     * Return some info
     */
    function getInfo() {
        return array (
            'author' => 'Dennis Ploeger',
            'email' => 'develop@dieploegers.de',
            'date' => '2009-11-20',
            'name' => 'noprint Plugin (Action Component)',
            'desc' => 'Inserts a button into the toolbar for the noprint-Plugin',
            'url'    => 'http://www.dokuwiki.org/plugin:noprint',
        );
    }
 
    /**
     * Register the eventhandlers
     */
    function register(&$controller) {
        $controller->register_hook('TOOLBAR_DEFINE', 'AFTER', $this, 'insert_button', array ());
    }
 
    /**
     * Inserts the toolbar button
     */
    function insert_button(& $event, $param) {
        $event->data[] = array (
            'type' => 'format',
            'title' => $this->getLang('qb_noprint'),
            'icon' => '../../plugins/noprint/toolbar.png',
            'open' => '<noprint>',
            'close' => '</noprint>',
        );
    }
 
}
