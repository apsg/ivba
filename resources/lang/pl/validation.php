<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Atrybut :attribute musi zostać zaakceptowany.',
    'active_url'           => 'Atrybut :attribute nie jest poprawnym adresem URL.',
    'after'                => 'Atrybut :attribute musi być datą późniejszą od :date.',
    'after_or_equal'       => 'Atrybut :attribute musi być datą późniejszą lub równą :date.',
    'alpha'                => 'Atrybut :attribute może zawierać jedynie litery.',
    'alpha_dash'           => 'Atrybut :attribute może zawierać jedynie litery, cyfry i myślniki.',
    'alpha_num'            => 'Atrybut :attribute może zawierać jedynie litery i cyfry.',
    'array'                => 'Atrybut :attribute musi być tablicą.',
    'before'               => 'Atrybut :attribute musi być datą wcześniejszą, niż :date.',
    'before_or_equal'      => 'Atrybut :attribute musi być datą wcześniejszą lub równą :date.',
    'between'              => [
        'numeric' => 'Atrybut :attribute must be between :min and :max.',
        'file'    => 'Atrybut :attribute must be between :min and :max kilobytes.',
        'string'  => 'Atrybut :attribute must be between :min and :max characters.',
        'array'   => 'Atrybut :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'Atrybut :attribute field must be true or false.',
    'confirmed'            => 'Atrybut :attribute confirmation does not match.',
    'date'                 => 'Atrybut :attribute is not a valid date.',
    'date_format'          => 'Atrybut :attribute does not match the format :format.',
    'different'            => 'Atrybut :attribute and :other must be different.',
    'digits'               => 'Atrybut :attribute must be :digits digits.',
    'digits_between'       => 'Atrybut :attribute must be between :min and :max digits.',
    'dimensions'           => 'Atrybut :attribute has invalid image dimensions.',
    'distinct'             => 'Atrybut :attribute field has a duplicate value.',
    'email'                => 'Podany adres email jest niepoprawny.',
    'exists'               => 'Podany :attribute jest niepoprawny (nie istnieje).',
    'file'                 => 'Atrybut :attribute must be a file.',
    'filled'               => 'Atrybut :attribute field must have a value.',
    'image'                => 'Atrybut :attribute must be an image.',
    'in'                   => 'Atrybutselected :attribute is invalid.',
    'in_array'             => 'Atrybut :attribute field does not exist in :other.',
    'integer'              => 'Atrybut :attribute must be an integer.',
    'ip'                   => 'Atrybut :attribute must be a valid IP address.',
    'ipv4'                 => 'Atrybut :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'Atrybut :attribute must be a valid IPv6 address.',
    'json'                 => 'Atrybut :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'Atrybut :attribute nie może być większy niż :max.',
        'file'    => 'Atrybut :attribute may not be greater than :max kilobytes.',
        'string'  => 'Atrybut :attribute may not be greater than :max characters.',
        'array'   => 'Atrybut :attribute may not have more than :max items.',
    ],
    'mimes'                => 'Atrybut :attribute must be a file of type: :values.',
    'mimetypes'            => 'Atrybut :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'Atrybut :attribute musi być większy niż :min.',
        'file'    => 'Atrybut :attribute must be at least :min kilobytes.',
        'string'  => 'Atrybut :attribute must be at least :min characters.',
        'array'   => 'Atrybut :attribute must have at least :min items.',
    ],
    'not_in'               => 'Atrybutselected :attribute is invalid.',
    'numeric'              => 'Atrybut :attribute musi składać się z cyfr.',
    'present'              => 'Atrybut :attribute field must be present.',
    'regex'                => 'Atrybut :attribute ma niepoprawny format.',
    'required'             => 'Atrybut :attribute jest wymagany.',
    'required_if'          => 'Atrybut :attribute field is required when :other is :value.',
    'required_unless'      => 'Atrybut :attribute field is required unless :other is in :values.',
    'required_with'        => 'Atrybut :attribute field is required when :values is present.',
    'required_with_all'    => 'Atrybut :attribute field is required when :values is present.',
    'required_without'     => 'Atrybut :attribute field is required when :values is not present.',
    'required_without_all' => 'Atrybut :attribute field is required when none of :values are present.',
    'same'                 => 'Atrybut :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'Atrybut :attribute must be :size.',
        'file'    => 'Atrybut :attribute must be :size kilobytes.',
        'string'  => 'Atrybut :attribute must be :size characters.',
        'array'   => 'Atrybut :attribute must contain :size items.',
    ],
    'string'               => 'Atrybut :attribute musi być ciągiem znaków.',
    'timezone'             => 'Atrybut :attribute must be a valid zone.',
    'unique'               => 'Podany :attribute już istnie w naszej bazie.',
    'uploaded'             => 'Atrybut :attribute failed to upload.',
    'url'                  => 'Atrybut :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | Atrybutfollowing language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
