<?php declare(strict_types=1);

namespace Mkioschi\Types;

use Exception;
use Throwable;

class InvalidTypeException extends Exception
{
    /** @var ?string[] */
    private ?array $errors;

    public function __construct(
        string $message = 'Invalid value.',
        ?array $errors = null,
        ?Throwable $previous = null,
    )
    {
        $this->errors = $errors;
        parent::__construct(
            message: $message,
            previous: $previous
        );
    }

    public function getErrors(): ?array
    {
        return $this->errors;
    }
}