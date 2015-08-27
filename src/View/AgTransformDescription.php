<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\Apigility\Documentation\View;

use \Michelf\MarkdownExtra;

use Zend\View\Helper\AbstractHelper;

/**
 * View helper used to transform a raw Apigility description into a specific format (only Markdown is currently
 * supported).
 *
 * @see https://github.com/michelf/php-markdown
 */
class AgTransformDescription extends AbstractHelper
{
    /**
     * Transform an Apigility raw description into a specific format (only Markdown is currently supported).
     *
     * @param  string $string The raw Apigility description.
     * @return string The resulting transformed description.
     */
    public function __invoke($description)
    {
        return MarkdownExtra::defaultTransform($description);
    }
}
