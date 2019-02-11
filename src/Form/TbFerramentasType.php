<?php

namespace App\Form;

use App\Entity\TbFerramentas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TbFerramentasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome_ferramenta', TextType::class, [
                'constraints' => new NotBlank([
                    'message' => 'name.not_blank',
                ])
            ])
            ->add('marca_ferramenta', TextType::class, [
                'constraints' => new NotBlank([
                    'message' => 'name.not_blank',
                ])
            ])
            ->add('aluguel_hora', TextType::class, [
                'constraints' => new NotBlank([
                    'message' => 'name.not_blank',
                ])
            ])
        ;

        $builder->get('aluguel_hora')
                ->addModelTransformer(new CallbackTransformer(
                    function ($toInt) {
                        if(!empty($toInt)){
                            return str_replace('.','', $toInt);
                        }
                    },
                    function ($toFloat) {
                        if(!empty($toFloat)){
                            $number = str_replace('.','', $toFloat);
                            $number = str_replace(',','.', $number);
                            return $number;
                        }
                    }
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TbFerramentas::class,
        ]);
    }
}
