<?php

return [
    'without_placeholder' => 'Quite sure we don\'t have a placeholder in this sentence.',
    'with_placeholder' => 'Quite sure we have a ":placeholder" and a :different_placeholder and another in brackets (Something:something_placeholder).',
    'html' => 'Thank-you <strong>:name</strong> for your <a href=":order_url">purchase (Order ID: :order_id)</a>.',
    'nested' => [
        'without_placeholder' => 'Quite sure we don\'t have a placeholder in this sentence in nested array.',
        'with_placeholder' => 'Quite sure we have a ":placeholder" and a :different_placeholder and another in brackets (Something:something_placeholder) in nested array.',
        'html' => 'Thank-you <strong>:name</strong> for your <a href=":order_url">purchase (Order ID: :order_id)</a> in nested array.',
    ],
];
