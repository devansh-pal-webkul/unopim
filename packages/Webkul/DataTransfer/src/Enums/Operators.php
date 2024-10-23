<?php

namespace Webkul\DataTransfer\Enums;

enum Operators: string
{
    case STARTS_WITH = 'STARTS WITH';

    case ENDS_WITH = 'ENDS WITH';

    case CONTAINS = 'CONTAINS';

    case DOES_NOT_CONTAIN = 'DOES NOT CONTAIN';

    case IS_EMPTY = 'EMPTY';

    case IS_NOT_EMPTY = 'NOT EMPTY';

    case IN_LIST = 'IN';

    case NOT_IN_LIST = 'NOT IN';

    case EQUAL_TO = 'EQUAL TO';

    case NOT_EQUAL_TO = 'NOT EQUAL TO';

    case IS_TRUE = 'IS TRUE';

    case IS_FALSE = 'IS FALSE';

    /**
     * Get the label for the operator.
     */
    public function label(): string
    {
        return match ($this) {
            self::STARTS_WITH      => trans('data_transfer::app.operators.starts-with'),
            self::ENDS_WITH        => trans('data_transfer::app.operators.ends-with'),
            self::CONTAINS         => trans('data_transfer::app.operators.contains'),
            self::DOES_NOT_CONTAIN => trans('data_transfer::app.operators.does-not-contain'),
            self::IS_EMPTY         => trans('data_transfer::app.operators.is-empty'),
            self::IS_NOT_EMPTY     => trans('data_transfer::app.operators.is-not-empty'),
            self::IN_LIST          => trans('data_transfer::app.operators.in-list'),
            self::NOT_IN_LIST      => trans('data_transfer::app.operators.not-in-list'),
            self::EQUAL_TO         => trans('data_transfer::app.operators.equal-to'),
            self::NOT_EQUAL_TO     => trans('data_transfer::app.operators.not-equal-to'),
            self::IS_TRUE          => trans('data_transfer::app.operators.is-true'),
            self::IS_FALSE         => trans('data_transfer::app.operators.is-false'),
        };
    }

    /**
     * Get operators based on the type.
     */
    public static function getOperatorsByType(string $type): array
    {
        return match ($type) {
            'text', 'textarea' => self::getTextOperators(),
            'price'   => self::getPriceOperators(),
            'boolean' => self::getBooleanOperators(),
            'select', 'multiselect', 'checkbox' => self::getSelectOperators(),
            'datetime', 'date' => self::getDateTimeOperators(),
            'image', 'gallery', 'file' => self::getFileOperators(),
            default => [],
        };
    }

    /**
     * Get operators for text and textarea types.
     */
    public static function getTextOperators(): array
    {
        return [
            self::STARTS_WITH,
            self::ENDS_WITH,
            self::CONTAINS,
            self::DOES_NOT_CONTAIN,
            self::IS_EMPTY,
            self::IS_NOT_EMPTY,
            self::EQUAL_TO,
            self::NOT_EQUAL_TO,
        ];
    }

    /**
     * Get operators for price type.
     */
    public static function getPriceOperators(): array
    {
        return [
            self::EQUAL_TO,
            self::NOT_EQUAL_TO,
            self::IS_EMPTY,
            self::IS_NOT_EMPTY,
        ];
    }

    /**
     * Get operators for boolean type.
     */
    public static function getBooleanOperators(): array
    {
        return [
            self::IS_TRUE,
            self::IS_FALSE,
        ];
    }

    /**
     * Get operators for select types.
     */
    public static function getSelectOperators(): array
    {
        return [
            self::IN_LIST,
            self::NOT_IN_LIST,
            self::EQUAL_TO,
            self::NOT_EQUAL_TO,
        ];
    }

    /**
     * Get operators for datetime and date types.
     */
    public static function getDateTimeOperators(): array
    {
        return [
            self::EQUAL_TO,
            self::NOT_EQUAL_TO,
            self::IS_EMPTY,
            self::IS_NOT_EMPTY,
        ];
    }

    /**
     * Get operators for file types.
     */
    public static function getFileOperators(): array
    {
        return [
            self::IS_EMPTY,
            self::IS_NOT_EMPTY,
        ];
    }

    /**
     * Format operators in value label format
     */
    public static function formatOperators(array $operators)
    {
        $result = [];

        foreach ($operators as $operator) {
            $result[] = [
                'value' => $operator->value,
                'label' => $operator->label(),
            ];
        }

        return $result;
    }

    /**
     * Get all operators with their types and labels.
     */
    public static function getOperatorsWithLabels(string $type): array
    {
        $operators = self::getOperatorsByType($type);

        return self::formatOperators($operators);
    }

    /**
     * Get all operators specified with types
     */
    public static function getOperatorsWithTypes()
    {
        $types = [
            'text'        => self::getTextOperators(),
            'price'       => self::getPriceOperators(),
            'boolean'     => self::getBooleanOperators(),
            'select'      => self::getSelectOperators(),
            'multiselect' => self::getSelectOperators(),
            'checkbox'    => self::getSelectOperators(),
            'datetime'    => self::getDateTimeOperators(),
            'date'        => self::getDateTimeOperators(),
            'image'       => self::getFileOperators(),
            'gallery'     => self::getFileOperators(),
            'file'        => self::getFileOperators(),
        ];

        $result = [];

        foreach ($types as $type => $operators) {
            $result[$type] = self::formatOperators($operators);
        }

        return $result;
    }
}
