<?php /** @noinspection PhpUnused */

declare(strict_types=1);

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Exen Class.
 *
 * @since 0.1.0
 */
class Exen
{
    /**
     * Is the application debuggable.
     *
     * @var boolean $debuggable
     */
    protected bool $debuggable = false;

    /**
     * Exen Class Constructor.
     */
    function __construct()
    {
        @ini_set('display_errors', 'On');
        @ini_set('error_reporting', 'E_ALL');
        @ini_set('include_path', @ini_get('include_path') . PATH_SEPARATOR . APPPATH . 'libraries');

        // require_once APPPATH . 'helpers/common_helper.php';
    }

    /**
     * Load the given class file `class`.
     *
     * @param string $class Class file to load.
     *
     * @return void
     *
     * @since 0.1.0
     *
     * @access private
     */
    function load(string $class): void
    {
        require_once $class . EXT;
    }

    /**
     * @return boolean
     */
    function isDebuggable(): bool
    {
        return $this->getDebuggable() === true;
    }

    /**
     * @return boolean
     */
    function getDebuggable(): bool
    {
        return $this->debuggable;
    }

    /**
     * @param boolean $boolean
     *
     * @return $this
     */
    function setDebuggable(bool $boolean = false): self
    {
        $this->debuggable = $boolean;

        return $this;
    }

    /**
     * Exen Class Destructor.
     */
    function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

    /**
     * Exen Class Debug Info.
     */
    function __debugInfo()
    {
        // TODO: Implement __debugInfo() method.
    }

    /**
     * Returns a string representation of the current object.
     *
     * @return string
     */
    function __toString(): string
    {
        return '<Exen>';
    }
}
