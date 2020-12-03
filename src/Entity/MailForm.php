<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

final class MailForm
{
    #[Assert\NotBlank]
    #[Assert\Email]
    #[SerializedName('e-mail')]
    public ?string $email = null;
}
