<?php

namespace AppBundle\Admin\Export;

use Doctrine\ORM\Query;
use Exporter\Source\DoctrineORMQuerySourceIterator as BaseDoctrineORMQuerySourceIterator;
use Symfony\Component\Translation\DataCollectorTranslator;

/**
 * DoctrineORMQuerySourceIterator
 */
class DoctrineORMQuerySourceIterator extends BaseDoctrineORMQuerySourceIterator
{
    /**
     * @var DataCollectorTranslator $translator Translator
     */
    private $translator;

    /**
     * DoctrineORMQuerySourceIterator constructor.
     *
     * @param Query                   $query          Query
     * @param array                   $fields         Fields
     * @param DataCollectorTranslator $translator     Translator
     * @param string                  $dateTimeFormat Datetime format
     */
    public function __construct(Query $query, array $fields, DataCollectorTranslator $translator, $dateTimeFormat = 'r')
    {
        parent::__construct($query, $fields, $dateTimeFormat);

        $this->translator = $translator;
    }

    /**
     * {@inheritdoc}
     */
    protected function getValue($value)
    {
        if (is_array($value) || $value instanceof \Traversable) {
            $value = null;
        } elseif ($value instanceof \DateTime) {
            $value = $value->format($this->dateTimeFormat);
        } elseif (is_object($value)) {
            $value = (string) $value;
        } elseif (is_bool($value)) {
            $value == true
                ? $value = $this->translator->trans('label_type_yes', [], 'SonataAdminBundle')
                : $value = $this->translator->trans('label_type_no', [], 'SonataAdminBundle');
        } else {
            $value = $this->translator->trans($value);
        }

        return $value;
    }
}
