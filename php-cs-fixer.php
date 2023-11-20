<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$rules = [
    '@PSR2' => true,
    'binary_operator_spaces' => [
        'operators' => [
            '=' => 'align_single_space_minimal',
            '=>' => 'align_single_space_minimal',
        ],
    ],
    'array_syntax' => ['syntax' => 'short'],
    'method_argument_space' => [
        'on_multiline' => 'ensure_fully_multiline',
        'keep_multiple_spaces_after_comma' => true,
    ],
    'not_operator_with_successor_space' => true,
    'not_operator_with_space' => false,
    'trailing_comma_in_multiline' => ['elements' => ['arrays']],
    'phpdoc_scalar' => true,
    'unary_operator_spaces' => true,
    'object_operator_without_whitespace' => true,
    'phpdoc_single_line_var_spacing' => true,
    'phpdoc_var_without_name' => true,
    'class_attributes_separation' => [
        'elements' => ['method' => 'one'],
    ],
    'method_chaining_indentation' => true,
    'align_multiline_comment' => true,
    'phpdoc_align' => true,
    'phpdoc_annotation_without_dot' => true,
    'phpdoc_indent' => true,
    'phpdoc_inline_tag_normalizer' => true,
    'phpdoc_line_span' => true,
    'phpdoc_no_empty_return' => true,
    'phpdoc_no_useless_inheritdoc' => true,
    'phpdoc_return_self_reference' => true,
    'phpdoc_summary' => true,
    'phpdoc_to_comment' => true,
    'phpdoc_trim' => true,
    'phpdoc_types' => true,
    'phpdoc_var_annotation_correct_order' => true,
    'return_type_declaration' => ['space_before' => 'none'],
    'single_trait_insert_per_statement' => true,
];

$finder = Finder::create()
    ->in([
        __DIR__ . '/app',
        __DIR__ . '/config',
        __DIR__ . '/database',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ])
    ->name('*.php')
    ->exclude('bootstrap')
    ->exclude('storage')
    ->exclude('vendor')
    ->notPath('resources/views')
    ->notPath('node_modules');

$config = new Config();
return $config->setRules($rules)
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setUsingCache(true);
