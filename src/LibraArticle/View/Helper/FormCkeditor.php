<?php

/*
 * eJoom.com
 * This source file is subject to the new BSD license.
 */

namespace LibraArticle\View\Helper;

use Zend\Form\View\Helper\FormTextarea;
use Zend\Form\ElementInterface;
use Zend\Form\Exception;


/**
 * Description of FormCkeditor
 *
 * @author duke
 */
class FormCkeditor extends FormTextarea
{
    public $basePath        = '/vendor/ckeditor/';
    public $basePathFinder  = '/vendor/ckfinder/';

    /**
     * Render a form <textarea> element from the provided $element
     *
     * @param  ElementInterface $element
     * @return string
     */
    public function render(ElementInterface $element)
    {
        $name   = $element->getName();
        if (empty($name) && $name !== 0) {
            throw new Exception\DomainException(sprintf(
                '%s requires that the element has an assigned name; none discovered',
                __METHOD__
            ));
        }

        if (!class_exists('CKEditor')) {
            return parent::render($element);
        }
        
        $content = (string) $element->getValue();
        $ckeditor = new \CKEditor($this->basePath);
        if (class_exists('CKFinder')) {
            $_SESSION['IsAuthorized'] = true;
            \CKFinder::SetupCKEditor($ckeditor, $this->basePathFinder);
        }
        ob_start();
        $ckeditor->editor($name, $content);
        $xhtml = ob_get_clean();

        return $xhtml;

        /*return sprintf(
            '<textarea %s>%s</textarea>',
            $this->createAttributesString($attributes),
            $escapeHtml($content)
        );*/
    }

    /**
     * Invoke helper as functor
     *
     * Proxies to {@link render()}.
     *
     * @param  ElementInterface|null $element
     * @return string|FormTextarea
     */
    public function __invoke(ElementInterface $element = null)
    {
        if (!$element) {
            return $this;
        }

        return $this->render($element);
    }

}
