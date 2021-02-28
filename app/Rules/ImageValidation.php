<?php

namespace App\Rules;

use App\Helpers\ImageHelper;
use App\Models\Provider;
use Illuminate\Contracts\Validation\Rule;

class ImageValidation implements Rule
{
    private $providerId;
    private $errorMessage = '';

    /**
     * Create a new rule instance.
     *
     * @param $providerId
     */
    public function __construct($providerId)
    {
        $this->providerId = $providerId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Get rules from provider
        $provider = Provider::find($this->providerId);
        if (!$provider) {
            return true;
        }

        $mediaRules = json_decode($provider->getAttribute('media_rules'));
        if ($mediaRules && property_exists($mediaRules, 'image')) {

            // Extension validation
            if (strpos($mediaRules->image->extension, $value->extension()) === false) {
                $this->errorMessage = 'Image extension "' . $value->extension() . '" is not allowed';
            }

            foreach ($mediaRules->image->rules as $rule) {
                switch ($rule->name) {
                    case 'size':
                        $operator = $rule->operator;
                        if (!version_compare($value->getSize(), $rule->value, $operator)) {
                            $this->errorMessage = $rule->description;
                            return false;
                        }
                        break;

                    case 'ratio':
                        $operator = $rule->operator;

                        $imageDetail = getimagesize($value);
                        $width = $imageDetail[0];
                        $height = $imageDetail[1];

                        $ratio = ImageHelper::calculateRatio($width, $height);

                        if (!version_compare($ratio, $rule->value, $operator)) {
                            $this->errorMessage = $rule->description;
                            return false;
                        }
                        break;
                }
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->errorMessage;
    }
}
