<?php
/**
 * Created by PhpStorm.
 * User: darksy
 * Date: 14/12/2015
 * Time: 10:32
 */

namespace MovieUser\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

use DoctrineORMModule\Form\Annotation\AnnotationBuilder as DoctrineAnnotationBuilder;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use DoctrineModule\Validator\NoObjectExists as NoObjectExistsValidator;

use MovieUser\Entity\User;

class UserFormFactory implements FactoryInterface
{
    protected $serviceLocator;
    protected $em;
    protected $form;
    protected $options;

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    public function createUserForm($userEntity, $formName = 'LogIn')
    {
        $em = $this->getEntityManager();
        $builder = DoctrineAnnotationBuilder($em);
        $this->form = $builder->createForm($userEntity);
        $this->form->setHydrator(new DoctrineHydrator($em));
        $this->form->setAttribute('method', 'post');

        $this->addCommonFields();

        switch($formName) {
            case 'Register':
                $this->addRegistrationFields();
                $this->addRegistrationFilters();
                $this->form->setAttributes(array(
                    'action' => $this->getUrlPlugin()->fromRoute('register'),
                    'name'   => 'register'
                ));
                break;

            default:
                $this->addLoginFields();
                $this->addLoginFilters();
                $this->form->setAttributes(array(
                    'action' => $this->getUrlPlugin()->fromRoute('login', array('action' => 'login')),
                    'name'  => 'login'
                ));
                break;
        }
    }

    /**
     * Add common fields such as CSRF, CAPTCHA and Submit
     */
    private function addCommonFields()
    {
        $this->form->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 600,
                )
            )
        ));

        $this->form->add(array(
            'name' => 'captcha',
            'type' => 'Zend\Form\Element\Captcha',
            'options' => array(
                'captcha' => new \Zend\Captcha\Figlet(array(
                    'wordLen' => $this->getOptions()->getCaptchaCharNum(),
                ))
            )
        ));

        $this->form->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'class' => 'btn btn-md btn-mov-den'
            )
        ));
    }

    /**
     *
     * Input filters for User Log In
     *
     */
    private function addLoginFilters()
    {
        $this->form->getInputFilter()->add($this->form->getInputFilter()->getFactory()->createInput(array(
            'name'     => 'usernameOrEmail',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
        )));

        $this->form->getInputFilter()->add($this->form->getInputFilter()->getFactory()->createInput(array(
            'name'     => 'rememberme',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'InArray',
                    'options' => array(
                        'haystack' => array('0', '1'),
                    ),
                ),
            )
        )));
    }

    /**
     *
     * Fields for User Log In
     *
     */
    private function addLoginFields()
    {
        $this->form->add(array(
            'name' => 'usernameOrEmail',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'type'  => 'text',
            ),
        ));

        $this->form->add(array(
            'name' => 'rememberme',
            'type' => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'label' => $this->getTranslatorHelper()->translate('Remember me?'),
            ),
        ));
    }



    /**
     * get options
     *
     * @return ModuleOptions
     */
    private function getOptions()
    {
        if(null === $this->options) {
            $this->options = $this->serviceLocator->get('movieuser_options');
        }

        return $this->options;
    }

    /**
     *
     * get EntityManager $em
     *
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        if(null === $this->em) {
            $this->em = $this->serviceLocator->get('doctrine.entitymanager.orm_default');
        }

        return $this->em;
    }
}