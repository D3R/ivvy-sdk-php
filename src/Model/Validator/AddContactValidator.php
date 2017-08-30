<?php
declare(strict_types=1);

namespace Fcds\Ivvy\Model\Validator;

use Iterator;
use Fcds\Ivvy\Model\Contact;
use Respect\Validation\Validator as RespectValidator;

/**
 * Class: AddContactValidatorTest
 *
 * Contains the business rules for adding a Contact.
 *
 * @see Validator
 */
class AddContactValidator implements Validator
{
    use ProcessBusinessRuleTrait;

    protected function process(Contact $contact): Iterator
    {
        if (! $contact->firstName) {
            yield 'A firstName is needed to add a Contact';
        }

        if (! $contact->lastName) {
            yield 'A lastName is needed to add a Contact';
        }

        if ($contact->id) {
            yield 'Cannot add a Contact that already has an id';
        }

        if ($contact->email && ! RespectValidator::email()->validate($contact->email)) {
            yield 'Contact has an invalid email';
        }

        if ($contact->phone && ! RespectValidator::phone()->validate($contact->phone)) {
            yield 'Contact has an invalid phone';
        }

        yield;
    }
}
