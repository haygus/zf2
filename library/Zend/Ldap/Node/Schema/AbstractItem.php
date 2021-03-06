<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Ldap
 * @subpackage Schema
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend\Ldap\Node\Schema;

use Zend\Ldap\Exception;

/**
 * This class provides a base implementation for managing schema
 * items like objectClass and attributeType.
 *
 * @category   Zend
 * @package    Zend_Ldap
 * @subpackage Schema
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class AbstractItem implements \ArrayAccess, \Countable
{
    /**
     * The underlying data
     *
     * @var array
     */
    protected $data;

    /**
     * Constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data);
    }

    /**
     * Sets the data
     *
     * @param  array $data
     * @return AbstractItem Provides a fluid interface
     */
    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Gets the data
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Gets a specific attribute from this item
     *
     * @param  string $name
     * @return mixed
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        } else {
            return null;
        }
    }

    /**
     * Checks whether a specific attribute exists.
     *
     * @param  string $name
     * @return boolean
     */
    public function __isset($name)
    {
        return (array_key_exists($name, $this->data));
    }

    /**
     * Always throws Zend\Ldap\Exception\BadMethodCallException
     * Implements ArrayAccess.
     *
     * This method is needed for a full implementation of ArrayAccess
     *
     * @param  string $name
     * @param  mixed  $value
     * @throws \Zend\Ldap\Exception\BadMethodCallException
     */
    public function offsetSet($name, $value)
    {
        throw new Exception\BadMethodCallException();
    }

    /**
     * Gets a specific attribute from this item
     *
     * @param  string $name
     * @return mixed
     */
    public function offsetGet($name)
    {
        return $this->__get($name);
    }

    /**
     * Always throws Zend\Ldap\Exception\BadMethodCallException
     * Implements ArrayAccess.
     *
     * This method is needed for a full implementation of ArrayAccess
     *
     * @param  string $name
     * @throws \Zend\Ldap\Exception\BadMethodCallException
     */
    public function offsetUnset($name)
    {
        throw new Exception\BadMethodCallException();
    }

    /**
     * Checks whether a specific attribute exists.
     *
     * @param  string $name
     * @return boolean
     */
    public function offsetExists($name)
    {
        return $this->__isset($name);
    }

    /**
     * Returns the number of attributes.
     * Implements Countable
     *
     * @return int
     */
    public function count()
    {
        return count($this->data);
    }
}
