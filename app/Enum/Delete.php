<?php

namespace App\Enum;

/**
 *  delete 字段状态
 */
enum Delete: int
{
    // 注意title值的顺序要和case定义一致
    private const title = ['否', '是'];

    case NO = 0; // 否
    case YES = 1; // 是

    /**
     *  通过反射获取所有定义的const和case参数
     * @return array
     */
    public static function toArray()
    {
        $reflection = new \ReflectionClass(self::class);
        return $reflection->getConstants();
    }


    /**
     * 获取所有cases 值
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * 映射title
     * @return array
     */
    public static function titleMap(): array
    {
        return array_combine(self::values(), self::title);
    }

    /**
     * 下拉选择框
     * @return array
     */
    public static function forSelect(): array
    {
        $arr = [];
        foreach (self::titleMap() as $k => $v) {
            $arr[] = array('value' => $k, 'title' => $v);
        }
        return $arr;
    }
}