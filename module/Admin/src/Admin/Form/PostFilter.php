<?php

namespace Admin\Form;

use Zend\InputFilter\InputFilter;

class PostFilter extends InputFilter {

    public function __construct() {

        $this->add(array(
            'name' => 'email',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Email is required'
                        ),
                    ),
                ),
                array(
                    'name' => 'EmailAddress',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'hostname' => true,
                        'messages' => array(                           
                            'emailAddressInvalid'           => 'Invalid email address provided.',
                            'emailAddressInvalidFormat'     => 'Invalid email address provided.',
                            'emailAddressInvalidHostname'   => 'Invalid email address provided.',
                            'hostnameInvalidHostname'       => 'Invalid email address provided.',
                            'hostnameLocalNameNotAllowed'   => 'Invalid email address provided.',
                            'hostnameUnknownTld'            => 'Invalid email address provided.',
                            'hostnameInvalidLocalName'      => 'Invalid email address provided.',
                            'hostnameInvalidHostnameSchema' => 'Invalid email address provided.',
                            'emailAddressDotAtom'           => 'Invalid email address provided.',
                        ),
                    ),
                ),

            ),
        ));
        
        $this->add(array(
            'name' => 'pwd',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Password is required'
                        ),
                    ),
                ),
            ),
        ));

    }

}