<?php
namespace FS\SolrBundle\Query;

use FS\SolrBundle\Doctrine\Mapper\MetaInformationInterface;
use FS\SolrBundle\Solr;
use FS\SolrBundle\SolrInterface;
use Solarium\QueryType\Select\Query\Query as SolariumQuery;
use Solarium\QueryType\Update\Query\Document\Document;

abstract class AbstractQuery extends SolariumQuery
{
    /**
     * @var Document
     */
    protected $document = null;

    /**
     *
     * @var SolrInterface
     */
    protected $solr = null;

    /**
     * @var string
     */
    protected $index = null;

    /**
     * @var array
     */
    private $entity = array();

    /**
     * @var MetaInformationInterface
     */
    private $metaInformation;

    /**
     * @return MetaInformationInterface
     */
    public function getMetaInformation()
    {
        return $this->metaInformation;
    }

    /**
     * @param MetaInformationInterface $metaInformation
     */
    public function setMetaInformation($metaInformation)
    {
        $this->metaInformation = $metaInformation;

        $this->addEntity($metaInformation->getEntity());
        $this->index = $metaInformation->getIndex();
    }

    /**
     * @return array
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param array $entity
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
    }

    /**
     * @param object $entity
     */
    public function addEntity($entity)
    {
        if(empty($this->entity) || !in_array($entity, $this->entity)) {
            $this->entity[] = $entity;
        }
    }

    /**
     * @param \Solarium\QueryType\Update\Query\Document\Document $document
     */
    public function setDocument($document)
    {
        $this->document = $document;
    }

    /**
     * @return Document
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @param SolrInterface $solr
     */
    public function setSolr(SolrInterface $solr)
    {
        $this->solr = $solr;
    }

    /**
     * @return SolrInterface
     */
    public function getSolr()
    {
        return $this->solr;
    }

    /**
     * modes defined in FS\SolrBundle\Doctrine\Hydration\HydrationModes
     *
     * @param string $mode
     */
    public function setHydrationMode($mode)
    {
        $this->getSolr()->getMapper()->setHydrationMode($mode);
    }

    /**
     * @return string
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @param string $index
     */
    public function setIndex($index)
    {
        $this->index = $index;
    }
}
