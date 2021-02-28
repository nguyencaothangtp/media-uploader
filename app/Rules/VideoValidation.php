<?php

namespace App\Rules;

use App\Models\Provider;
use FFMpeg\FFProbe;
use Illuminate\Contracts\Validation\Rule;

class VideoValidation implements Rule
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
        // Get rules from Provider
        $provider = Provider::find($this->providerId);
        if (!$provider) {
            return true;
        }

        $mediaRules = json_decode($provider->getAttribute('media_rules'));
        if ($mediaRules && property_exists($mediaRules, 'video')) {

            // Extension validation
            if (strpos($mediaRules->video->extension, $value->extension()) === false) {
                $this->errorMessage = 'Video extension "' . $value->extension() . '" is not allowed';
                return false;
            }

            foreach ($mediaRules->video->rules as $rule) {
                $operator = $rule->operator;

                switch ($rule->name) {
                    case 'size':
                        if (!version_compare($value->getSize(), $rule->value, $operator)) {
                            $this->errorMessage = $rule->description;
                            return false;
                        }
                        break;

                    case 'duration':
                        $ffprobe = FFProbe::create();
                        $duration = $ffprobe
                            ->format($value->getRealPath())
                            ->get('duration');

                        if (!version_compare($duration, $rule->value, $operator)) {
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
