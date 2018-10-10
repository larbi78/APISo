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
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $statusChoices = [
            'à faire' => 'à faire',
            'en cours' => 'en cours',
            'terminée' => 'terminée'
        ];
        $builder
            ->add('Title', TextType::class)
            ->add('Description', TextType::class)
            ->add('Status', ChoiceType::class,
                [
                    'choices' => $statusChoices
                ])
            ->add('Save',SubmitType::class);
    }
}