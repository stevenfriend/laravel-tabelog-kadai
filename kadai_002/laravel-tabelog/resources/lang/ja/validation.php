<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions, such
    | as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted' => ':attributeを承認してください。',
    'active_url' => ':attributeは、有効なURLではありません。',
    'after' => ':attributeは、:dateより後の日付である必要があります。',
    'after_or_equal' => ':attributeは、:date以降の日付である必要があります。',
    'alpha' => ':attributeには、文字のみ使用できます。',
    'alpha_dash' => ':attributeには、文字、数字、ダッシュ、アンダースコアのみ使用できます。',
    'alpha_num' => ':attributeには、文字と数字のみ使用できます。',
    'array' => ':attributeは、配列である必要があります。',
    'before' => ':attributeは、:dateより前の日付である必要があります。',
    'before_or_equal' => ':attributeは、:date以前の日付である必要があります。',
    'confirmed' => ':attributeの確認が一致しません。',
    'email' => ':attributeは、有効なメールアドレスである必要があります。',
    'exists' => '選択された:attributeは、無効です。',
    'min' => [
        'numeric' => ':attributeは、少なくとも:minである必要があります。',
        'file' => ':attributeは、少なくとも:minキロバイトである必要があります。',
        'string' => ':attributeは、少なくとも:min文字である必要があります。',
        'array' => ':attributeは、少なくとも:min項目を含む必要があります。',
    ],
    'not_in' => '選択された:attributeは、無効です。',
    'numeric' => ':attributeは、数値である必要があります。',
    'required' => ':attributeは、必須項目です。',
    'unique' => ':attributeは、すでに使用されています。',
    
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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader-friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        "name" => "名前",
        "password" => "パスワード",
        "password_confirmation" => "パスワード(確認用)",
        "email" => "メールアドレス",
    ],

];