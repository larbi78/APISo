<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 10/10/18
 * Time: 16:39
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class OptionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $statusChoices = [
            'à faire' => 'à faire',
            'en cours' => 'en cours',
            'terminée' => 'terminée'
        ];
        $triChoices = [
            'asc' => 'asc',
            'desc' => 'desc'
        ];
        $builder
            ->add('status', ChoiceType::class,
                [
                    'choices' => $statusChoices,
                    'label' => 'Filter by status',
                    'required' => false,
                ])
            ->add('tri', ChoiceType::class,
                [
                    'required' => false,
                    'label' => 'Order by creationDate',
                    'choices' => $triChoices,
                    'expanded' => true,
                    'multiple' => false
                ])
            ->add('Search',SubmitType::class);
    }
}