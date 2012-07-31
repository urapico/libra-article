<?php
return array(
    'alias' => array(
    ),
    'LibraArticle\Controller\IndexController' => array(
        'parameters' => array(
            //'em'      => 'Doctrine\ORM\EntityManager',
            //'mapper' => 'LibraArticle\Mapper\ArticleDoctrineMapper',
            //'repository' => 'LibraArticle\Repository\ArticleRepository',
            'model' => 'LibraArticle\Model\ArticleModel',
        ),
    ),
/*    'LibraArticle\Repository\ArticleRepository' => array(
        'parameters' => array(
            'em'    => 'Doctrine\ORM\EntityManager',
            'class' => 'LibraArticle\Entity\Article', //@todo need remake to send string instead of object
        ),
    ),
/*    'LibraArticle\Model\ArticleModel' => array(
        'parameters' => array(
            'repository' => 'LibraArticle\Repository\ArticleRepository',
        ),
    ),*/
    'orm_driver_chain' => array(
        'parameters' => array(
            'drivers' => array(
                /*
                'libra_article_xml_driver' => array(
                    'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                    'namespace' => 'LibraArticle\Entity',
                    'paths' => array(__DIR__ . '/xml'),
                    //'file_extension' => '.dcm.xml', // by default '.dcm.xml'
                ),
                */
                'libra_article_annotation_driver' => array(
                    'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                    'cache' => 'array',
                    'namespace' => 'LibraArticle\Entity',
                    'paths' => array(__DIR__ . '/../src/LibraArticle/Entity'),
                ),
            ),
        )
    ),
);