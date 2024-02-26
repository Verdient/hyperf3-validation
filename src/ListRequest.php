<?php

namespace Verdient\Hyperf3\Validation;

/**
 * 列表请求
 * @author Verdient。
 */
class ListRequest extends QueryRequest
{
    /**
     * 最大分页大小
     * @author Verdient。
     */
    protected function maxPageSize(): int
    {
        return 500;
    }

    /**
     * @inheritdoc
     * @author Verdient。
     */
    protected function getRules(): array
    {
        return array_merge([
            'page' => ['int', ['min', '1']],
            'page_size' => ['int', ['min', '1'], ['max', strval($this->maxPageSize())]]
        ], parent::getRules());
    }
}
