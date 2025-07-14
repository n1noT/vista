<?php

declare(strict_types=1);
use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->in(__DIR__)
    ->exclude('var')
    ->exclude('vendor')
    ->exclude('tests')
;

return (new Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PhpCsFixer' => true,
        'array_push' => true,
        'concat_space' => ['spacing' => 'one'],
        'declare_strict_types' => true,
        'dir_constant' => true,
        'native_function_invocation' => ['include' => ['@all'], 'exclude' => ['dd']],
        'no_superfluous_elseif' => false,
        'no_superfluous_phpdoc_tags' => false,
        'php_unit_test_class_requires_covers' => false,
        'phpdoc_add_missing_param_annotation' => false,
        'phpdoc_order' => false,
        'phpdoc_order_by_value' => false,
        'phpdoc_var_annotation_correct_order' => false,
        'standardize_increment' => false,
        'yoda_style' => false,
        'blank_line_before_statement' => ['statements' => ['return']],
        'increment_style' => ['style' => 'post'],
        'function_declaration' => ['closure_function_spacing' => 'none'],
    ])
    ->setLineEnding("\n")
;
