<?php

namespace Openpp\MapBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;

class MapGeometryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'map_attr' => array(
                'id' => 'map',
                'style' => 'width:500px; height:400px;',
            ),
            'initial_lonlat' => array(138.75, 35.999887), // Japan
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('geometry', 'text', array('label' => false, 'read_only' => true));
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['map_attr'] = $options['map_attr'];
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'openpp_type_map_geometry';
    }
}