<?php
namespace Craft;

/**
 * Variant record.
 *
 * @property int $id
 * @property int $productId
 * @property bool $isImplicit
 * @property string $sku
 * @property float $price
 * @property float $width
 * @property float $height
 * @property float $length
 * @property float $weight
 * @property int $stock
 * @property bool $unlimitedStock
 * @property int $minQty
 * @property int $maxQty
 *
 * @property Commerce_ProductRecord $product
 *
 * @author    Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @copyright Copyright (c) 2015, Pixel & Tonic, Inc.
 * @license   http://craftcommerce.com/license Craft Commerce License Agreement
 * @see       http://craftcommerce.com
 * @package   craft.plugins.commerce.records
 * @since     1.0
 */
class Commerce_VariantRecord extends BaseRecord
{

    /**
     * @return string
     */
    public function getTableName()
    {
        return 'commerce_variants';
    }

    /**
     * @return array
     */
    public function defineIndexes()
    {
        return [
            ['columns' => ['sku'], 'unique' => true],
        ];
    }

    /**
     * @return array
     */
    public function defineRelations()
    {
        return [
            'product' => [
                self::BELONGS_TO,
                'Commerce_ProductRecord',
                'onDelete' => self::SET_NULL,
                'onUpdate' => self::CASCADE
            ],
            'element' => [
                static::BELONGS_TO,
                'ElementRecord',
                'id',
                'required' => true,
                'onDelete' => static::CASCADE
            ]
        ];
    }

    /**
     * @return array
     */
    protected function defineAttributes()
    {
        return [
            'isImplicit' => [
                AttributeType::Bool,
                'default' => 0,
                'required' => true
            ],
            'sku' => [AttributeType::String, 'required' => true, 'label' => 'SKU'],
            'price' => [
                AttributeType::Number,
                'decimals' => 4,
                'required' => true
            ],
            'width' => [AttributeType::Number, 'decimals' => 4],
            'height' => [AttributeType::Number, 'decimals' => 4],
            'length' => [AttributeType::Number, 'decimals' => 4],
            'weight' => [AttributeType::Number, 'decimals' => 4],
            'stock' => [
                AttributeType::Number,
                'unsigned' => true,
                'required' => true,
                'default' => 0
            ],
            'unlimitedStock' => [
                AttributeType::Bool,
                'default' => 0,
                'required' => true
            ],
            'minQty' => [AttributeType::Number, 'unsigned' => true],
            'maxQty' => [AttributeType::Number, 'unsigned' => true]
        ];
    }

}