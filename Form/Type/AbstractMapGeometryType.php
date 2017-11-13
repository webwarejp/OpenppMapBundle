<?php

namespace Openpp\MapBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

abstract class AbstractMapGeometryType extends AbstractType
{
    /**
     * {@inheritdoc}
     *
     * @todo Remove it when bumping requirements to SF 2.7+
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'map_attr' => [
                'id' => 'map',
                'style' => 'width:500px; height:400px;',
            ],
            'initial_lonlat' => [139.774488, 35.684182], // Japan
            'initial_zoom' => 16,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['map_attr'] = $options['map_attr'];
        $view->vars['initial_lonlat'] = $options['initial_lonlat'];
        $view->vars['initial_zoom'] = $options['initial_zoom'];
    }
}
