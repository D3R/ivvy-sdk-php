<?php
declare(strict_types=1);

namespace Fcds\Ivvy\Model\Validator;

use Iterator;
use Fcds\Ivvy\Model\Contact;

/**
 * Class: UpdateContactValidatorTest
 *
 * Contains the business rules for adding a Contact.
 *
 * @see Validator
 */
class UpdateContactValidator implements Validator
{
    use ProcessBusinessRuleTrait;

    protected function process(Contact $contact): Iterator
    {
        if (! $contact->id) {
            yield 'An id is needed to update a Contact';
        }

        yield;
    }
}
